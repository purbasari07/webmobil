<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class MekanikController extends Controller
{
    public function dashboard()
    {
        // Get bookings sorted by queue status:
        // Pending first, then Confirmed, then In Progress, then Completed
        $bookings = Booking::with(['vehicle', 'service', 'user'])
                            ->orderByRaw("CASE 
                                WHEN status = 'Pending' THEN 1
                                WHEN status = 'Confirmed' THEN 2
                                WHEN status = 'In Progress' THEN 3
                                WHEN status = 'Completed' THEN 4
                                ELSE 5
                            END")
                            ->latest('updated_at')
                            ->get();

        return view('mekanik.dashboard', compact('bookings'));
    }

    public function accBooking(Booking $booking)
    {
        if ($booking->status !== 'Pending') {
            return back()->with('error', 'Booking tidak berada dalam status Pending.');
        }

        $booking->status = 'Confirmed';
        $booking->save();

        // Create transaction record and assign mechanic
        Transaction::updateOrCreate(
            ['booking_id' => $booking->id],
            [
                'mekanik_id' => Auth::id(),
                'total_service' => $booking->service->price,
                'grand_total' => $booking->service->price,
            ]
        );

        return redirect()->route('mekanik.dashboard')->with('success', 'Booking berhasil di-ACC. Antrean dipindahkan ke antrean Confirmed.');
    }

    public function startBooking(Booking $booking)
    {
        if ($booking->status !== 'Confirmed') {
            return back()->with('error', 'Booking harus berstatus Confirmed sebelum dikerjakan.');
        }

        $booking->status = 'In Progress';
        $booking->save();

        return redirect()->route('mekanik.dashboard')->with('success', 'Servis mobil telah dimulai (In Progress).');
    }

    public function completeBooking(Booking $booking)
    {
        if ($booking->status !== 'In Progress') {
            return back()->with('error', 'Booking harus berstatus In Progress sebelum diselesaikan.');
        }

        $booking->status = 'Completed';
        $booking->save();

        return redirect()->route('mekanik.dashboard')->with('success', 'Servis mobil telah selesai (Completed). Silakan arahkan customer ke kasir.');
    }
}
