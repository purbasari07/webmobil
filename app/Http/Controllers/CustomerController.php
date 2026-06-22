<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\Booking;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $vehicles = Vehicle::where('user_id', $user->id)->get();
        $bookings = Booking::with(['vehicle', 'service', 'transaction.payment'])
                            ->where('user_id', $user->id)
                            ->latest()
                            ->get();

        return view('customer.dashboard', compact('vehicles', 'bookings'));
    }

    public function storeVehicle(Request $request)
    {
        $data = $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'license_plate' => 'required|string|max:20',
            'color' => 'required|string|max:50',
        ]);

        $data['user_id'] = Auth::id();

        Vehicle::create($data);

        return redirect()->route('customer.dashboard')->with('success', 'Mobil berhasil ditambahkan.');
    }

    public function createBooking()
    {
        $user = Auth::user();
        $vehicles = Vehicle::where('user_id', $user->id)->get();
        $services = Service::all();

        if ($vehicles->isEmpty()) {
            return redirect()->route('customer.dashboard')->with('error', 'Silakan daftarkan minimal 1 mobil terlebih dahulu sebelum melakukan booking.');
        }

        return view('customer.booking', compact('vehicles', 'services'));
    }

    public function storeBooking(Request $request)
    {
        $data = $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'service_id' => 'required|exists:services,id',
            'booking_date' => 'required|date|after_or_equal:today',
            'booking_time' => 'required|string',
            'complaint' => 'nullable|string',
        ]);

        // Check if the vehicle belongs to this user
        $vehicle = Vehicle::where('id', $data['vehicle_id'])->where('user_id', Auth::id())->firstOrFail();

        Booking::create([
            'user_id' => Auth::id(),
            'vehicle_id' => $data['vehicle_id'],
            'service_id' => $data['service_id'],
            'booking_date' => $data['booking_date'],
            'booking_time' => $data['booking_time'],
            'complaint' => $data['complaint'],
            'status' => 'Pending',
            'is_offline' => false,
        ]);

        return redirect()->route('customer.dashboard')->with('success', 'Booking servis berhasil diajukan. Silakan datang sesuai jadwal.');
    }
}
