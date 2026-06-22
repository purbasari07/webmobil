<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\Service;
use App\Models\Sparepart;
use App\Models\Transaction;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class KasirController extends Controller
{
    public function dashboard()
    {
        // Get bookings for Kasir view
        $activeBookings = Booking::with(['vehicle', 'service', 'user', 'transaction'])
                            ->whereIn('status', ['Pending', 'Confirmed', 'In Progress'])
                            ->latest()
                            ->get();

        $completedBookings = Booking::with(['vehicle', 'service', 'user', 'transaction.payment'])
                            ->where('status', 'Completed')
                            ->latest()
                            ->get();

        // Get paid/historical transactions (direct sales or completed bookings)
        $transactions = Transaction::with(['booking.vehicle', 'payment', 'booking.user'])
                            ->whereHas('payment', function($q) {
                                $q->where('payment_status', 'Paid');
                            })
                            ->latest()
                            ->take(15)
                            ->get();

        return view('kasir.dashboard', compact('activeBookings', 'completedBookings', 'transactions'));
    }

    public function createOfflineForm()
    {
        $services = Service::all();
        // Get list of existing customer users for select dropdown option
        $customers = User::where('role', 'customer')->orderBy('name')->get();
        return view('kasir.booking_offline', compact('services', 'customers'));
    }

    public function storeOffline(Request $request)
    {
        $request->validate([
            'customer_type' => 'required|in:new,existing',
            // if existing
            'user_id' => 'required_if:customer_type,existing|exists:users,id',
            // if new
            'name' => 'required_if:customer_type,new|string|max:255',
            'email' => 'nullable|email|unique:users,email',
            'phone' => 'required_if:customer_type,new|string|max:20',
            'address' => 'required_if:customer_type,new|string',
            // vehicle
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'license_plate' => 'required|string|max:20',
            'color' => 'required|string|max:50',
            // booking
            'service_id' => 'required|exists:services,id',
            'booking_date' => 'required|date|after_or_equal:today',
            'booking_time' => 'required|string',
            'complaint' => 'nullable|string',
        ]);

        DB::transaction(function() use ($request) {
            // 1. Get or Create Customer
            if ($request->customer_type === 'existing') {
                $user = User::findOrFail($request->user_id);
            } else {
                $email = $request->email;
                if (!$email) {
                    $cleanPhone = preg_replace('/[^0-9]/', '', $request->phone);
                    $email = 'offline_' . ($cleanPhone ?: uniqid()) . '@webmobil.com';
                    while (User::where('email', $email)->exists()) {
                        $email = 'offline_' . ($cleanPhone ?: uniqid()) . '_' . rand(10, 99) . '@webmobil.com';
                    }
                }

                $user = User::create([
                    'name' => $request->name,
                    'email' => $email,
                    'password' => Hash::make('12345678'), // Default password
                    'role' => 'customer',
                    'phone' => $request->phone,
                    'address' => $request->address,
                ]);
            }

            // 2. Create Vehicle
            $vehicle = Vehicle::create([
                'user_id' => $user->id,
                'brand' => $request->brand,
                'model' => $request->model,
                'year' => $request->year,
                'license_plate' => $request->license_plate,
                'color' => $request->color,
            ]);

            // 3. Create Booking
            Booking::create([
                'user_id' => $user->id,
                'vehicle_id' => $vehicle->id,
                'service_id' => $request->service_id,
                'booking_date' => $request->booking_date,
                'booking_time' => $request->booking_time,
                'complaint' => $request->complaint,
                'status' => 'Pending',
                'is_offline' => true,
            ]);
        });

        return redirect()->route('kasir.dashboard')->with('success', 'Booking offline berhasil didaftarkan.');
    }

    public function checkoutForm(Booking $booking)
    {
        if ($booking->status !== 'Completed') {
            return redirect()->route('kasir.dashboard')->with('error', 'Booking harus diselesaikan mekanik terlebih dahulu sebelum checkout.');
        }

        // Find or create transaction
        $transaction = Transaction::firstOrCreate(
            ['booking_id' => $booking->id],
            [
                'total_service' => $booking->service->price,
                'grand_total' => $booking->service->price,
            ]
        );

        $spareparts = Sparepart::orderBy('name')->get();
        return view('kasir.checkout', compact('booking', 'transaction', 'spareparts'));
    }

    public function addSparepart(Request $request, Booking $booking)
    {
        $request->validate([
            'sparepart_id' => 'required|exists:spareparts,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $sparepart = Sparepart::findOrFail($request->sparepart_id);
        $qty = $request->quantity;

        if ($sparepart->stock < $qty) {
            return back()->with('error', "Stok tidak mencukupi. Stok saat ini: {$sparepart->stock} unit.");
        }

        $transaction = Transaction::where('booking_id', $booking->id)->firstOrFail();

        // Check if sparepart already added to this transaction
        $existing = $transaction->spareparts()->where('sparepart_id', $sparepart->id)->first();

        if ($existing) {
            // Update quantity
            $newQty = $existing->pivot->quantity + $qty;
            if ($sparepart->stock < $qty) {
                return back()->with('error', "Stok tidak mencukupi untuk tambahan ini.");
            }
            $transaction->spareparts()->updateExistingPivot($sparepart->id, [
                'quantity' => $newQty,
                'price' => $sparepart->price
            ]);
        } else {
            // Attach new sparepart
            $transaction->spareparts()->attach($sparepart->id, [
                'quantity' => $qty,
                'price' => $sparepart->price
            ]);
        }

        // Deduct sparepart stock
        $sparepart->stock -= $qty;
        $sparepart->save();

        $this->updateTransactionTotals($transaction);

        return back()->with('success', "Sparepart {$sparepart->name} berhasil ditambahkan.");
    }

    public function removeSparepart(Booking $booking, $sparepart_id)
    {
        $transaction = Transaction::where('booking_id', $booking->id)->firstOrFail();
        $sparepartPivot = $transaction->spareparts()->where('sparepart_id', $sparepart_id)->firstOrFail();

        $qtyToReturn = $sparepartPivot->pivot->quantity;

        // Detach from transaction
        $transaction->spareparts()->detach($sparepart_id);

        // Return stock to sparepart
        $sparepart = Sparepart::findOrFail($sparepart_id);
        $sparepart->stock += $qtyToReturn;
        $sparepart->save();

        $this->updateTransactionTotals($transaction);

        return back()->with('success', "Sparepart {$sparepart->name} berhasil dihapus dari transaksi.");
    }

    public function pay(Request $request, Booking $booking)
    {
        $transaction = Transaction::where('booking_id', $booking->id)->firstOrFail();

        $request->validate([
            'payment_method' => 'required|in:Cash,Transfer,QRIS',
            'amount_paid' => 'required|numeric|min:' . $transaction->grand_total,
        ]);

        DB::transaction(function() use ($request, $transaction, $booking) {
            // Create payment
            Payment::create([
                'transaction_id' => $transaction->id,
                'payment_date' => Carbon::now(),
                'amount_paid' => $request->amount_paid,
                'payment_method' => $request->payment_method,
                'payment_status' => 'Paid',
            ]);

            // Complete transaction by saving cashier ID
            $transaction->kasir_id = Auth::id();
            $transaction->save();
        });

        return redirect()->route('kasir.dashboard')->with('success', 'Pembayaran sukses diproses.');
    }

    public function directSaleForm()
    {
        $spareparts = Sparepart::where('stock', '>', 0)->orderBy('name')->get();
        return view('kasir.direct_sale', compact('spareparts'));
    }

    public function processDirectSale(Request $request)
    {
        $request->validate([
            'spareparts' => 'required|array',
            'spareparts.*.id' => 'required|exists:spareparts,id',
            'spareparts.*.qty' => 'required|integer|min:1',
            'payment_method' => 'required|in:Cash,Transfer,QRIS',
            'amount_paid' => 'required|numeric',
        ]);

        $transaction = DB::transaction(function() use ($request) {
            $totalSparepart = 0;
            $itemsToAttach = [];

            foreach ($request->spareparts as $item) {
                $sparepart = Sparepart::lockForUpdate()->findOrFail($item['id']);
                $qty = (int) $item['qty'];

                if ($sparepart->stock < $qty) {
                    throw new \Exception("Stok sparepart '{$sparepart->name}' tidak cukup. Tersisa: {$sparepart->stock}");
                }

                // Deduct stock
                $sparepart->stock -= $qty;
                $sparepart->save();

                $itemCost = $sparepart->price * $qty;
                $totalSparepart += $itemCost;

                $itemsToAttach[$sparepart->id] = [
                    'quantity' => $qty,
                    'price' => $sparepart->price,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            }

            if ($request->amount_paid < $totalSparepart) {
                throw new \Exception("Jumlah uang yang dibayarkan kurang dari grand total Rp " . number_format($totalSparepart, 0, ',', '.'));
            }

            // Create Transaction (direct sale has no booking_id, total_service = 0)
            $transaction = Transaction::create([
                'booking_id' => null,
                'mekanik_id' => null,
                'kasir_id' => Auth::id(),
                'total_service' => 0,
                'total_sparepart' => $totalSparepart,
                'grand_total' => $totalSparepart,
            ]);

            // Attach pivot items
            $transaction->spareparts()->attach($itemsToAttach);

            // Create Payment
            Payment::create([
                'transaction_id' => $transaction->id,
                'payment_date' => Carbon::now(),
                'amount_paid' => $request->amount_paid,
                'payment_method' => $request->payment_method,
                'payment_status' => 'Paid',
            ]);

            return $transaction;
        });

        return redirect()->route('kasir.dashboard')->with('success', 'Penjualan sparepart langsung berhasil diproses.');
    }

    public function invoice(Transaction $transaction)
    {
        $transaction->load(['booking.vehicle', 'booking.service', 'booking.user', 'spareparts', 'payment', 'mekanik', 'kasir']);
        return view('invoice.print', compact('transaction'));
    }

    protected function updateTransactionTotals(Transaction $transaction)
    {
        $totalSparepart = 0;
        foreach ($transaction->spareparts as $sp) {
            $totalSparepart += $sp->pivot->price * $sp->pivot->quantity;
        }

        $transaction->total_sparepart = $totalSparepart;
        $transaction->grand_total = $transaction->total_service + $totalSparepart;
        $transaction->save();
    }
}
