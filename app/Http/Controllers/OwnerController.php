<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Payment;
use App\Models\Booking;
use App\Models\Service;
use App\Models\Sparepart;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class OwnerController extends Controller
{
    public function dashboard()
    {
        $today = Carbon::today();
        $startOfMonth = Carbon::now()->startOfMonth();

        // 1. Stats Cards Data
        $todayRevenue = Payment::whereDate('payment_date', $today)->sum('amount_paid');
        $monthRevenue = Payment::where('payment_date', '>=', $startOfMonth)->sum('amount_paid');
        
        $completedBookings = Booking::where('status', 'Completed')
                                      ->whereHas('transaction.payment', function($q) {
                                          $q->where('payment_status', 'Paid');
                                      })
                                      ->count();
                                      
        $activeQueue = Booking::whereIn('status', ['Pending', 'Confirmed', 'In Progress'])->count();

        // Accumulative Financial Report (All-time Paid Transactions)
        $totalServiceRevenue = Transaction::whereHas('payment', function($q) {
            $q->where('payment_status', 'Paid');
        })->sum('total_service');

        $totalSparepartRevenue = Transaction::whereHas('payment', function($q) {
            $q->where('payment_status', 'Paid');
        })->sum('total_sparepart');

        $totalGrandRevenue = Transaction::whereHas('payment', function($q) {
            $q->where('payment_status', 'Paid');
        })->sum('grand_total');

        // 2. Chart Data: Daily Revenue (Last 7 Days)
        $dailyData = Payment::select(
                        DB::raw('DATE(payment_date) as date'),
                        DB::raw('SUM(amount_paid) as total')
                    )
                    ->where('payment_date', '>=', Carbon::now()->subDays(7))
                    ->groupBy('date')
                    ->orderBy('date')
                    ->get();

        $dailyLabels = [];
        $dailyValues = [];
        for ($i = 6; $i >= 0; $i--) {
            $d = Carbon::now()->subDays($i)->format('Y-m-d');
            $label = Carbon::now()->subDays($i)->isoFormat('D MMM');
            $dailyLabels[] = $label;
            
            $found = $dailyData->firstWhere('date', $d);
            $dailyValues[] = $found ? (float)$found->total : 0.0;
        }

        // 3. Chart Data: Monthly Revenue (Last 6 Months)
        $monthlyData = Payment::select(
                        DB::raw("DATE_FORMAT(payment_date, '%Y-%m') as month"),
                        DB::raw('SUM(amount_paid) as total')
                    )
                    ->where('payment_date', '>=', Carbon::now()->subMonths(6)->startOfMonth())
                    ->groupBy('month')
                    ->orderBy('month')
                    ->get();

        $monthlyLabels = [];
        $monthlyValues = [];
        for ($i = 5; $i >= 0; $i--) {
            $m = Carbon::now()->subMonths($i)->format('Y-m');
            $label = Carbon::now()->subMonths($i)->isoFormat('MMMM');
            $monthlyLabels[] = $label;
            
            $found = $monthlyData->firstWhere('month', $m);
            $monthlyValues[] = $found ? (float)$found->total : 0.0;
        }

        // 4. Statistics Tables:
        // A. Popular Services
        $popularServices = Service::select('services.service_name', DB::raw('COUNT(bookings.id) as count'))
                                    ->join('bookings', 'services.id', '=', 'bookings.service_id')
                                    ->groupBy('services.id', 'services.service_name')
                                    ->orderByDesc('count')
                                    ->take(5)
                                    ->get();

        // B. Top Selling Spareparts
        $topSpareparts = Sparepart::select('spareparts.name', 'spareparts.brand', DB::raw('SUM(transaction_spareparts.quantity) as sold_count'))
                                    ->join('transaction_spareparts', 'spareparts.id', '=', 'transaction_spareparts.sparepart_id')
                                    ->groupBy('spareparts.id', 'spareparts.name', 'spareparts.brand')
                                    ->orderByDesc('sold_count')
                                    ->take(5)
                                    ->get();

        // C. Mechanic Performance
        $mechanicPerf = User::select('users.name', DB::raw('COUNT(transactions.id) as jobs_count'))
                            ->where('users.role', 'mekanik')
                            ->join('transactions', 'users.id', '=', 'transactions.mekanik_id')
                            ->groupBy('users.id', 'users.name')
                            ->orderByDesc('jobs_count')
                            ->take(5)
                            ->get();

        return view('owner.dashboard', compact(
            'todayRevenue', 'monthRevenue', 'completedBookings', 'activeQueue',
            'dailyLabels', 'dailyValues', 'monthlyLabels', 'monthlyValues',
            'popularServices', 'topSpareparts', 'mechanicPerf',
            'totalServiceRevenue', 'totalSparepartRevenue', 'totalGrandRevenue'
        ));
    }

    public function exportExcel(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $paymentQuery = Payment::where('payment_status', 'Paid')
            ->with(['transaction.booking.vehicle.user', 'transaction.mekanik']);

        if ($startDate) {
            $paymentQuery->whereDate('payment_date', '>=', $startDate);
        }
        if ($endDate) {
            $paymentQuery->whereDate('payment_date', '<=', $endDate);
        }

        $payments = $paymentQuery->orderBy('payment_date', 'desc')->get();

        $filename = "Laporan_Keuangan_" . ($startDate ?? 'All') . "_to_" . ($endDate ?? 'All') . ".csv";

        $headers = [
            "Content-type"        => "text/csv; charset=UTF-8",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $callback = function() use($payments) {
            $file = fopen('php://output', 'w');
            
            // Add UTF-8 BOM for proper Excel compatibility
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            // CSV headers
            fputcsv($file, ['No', 'Tanggal Pembayaran', 'Pelanggan', 'Mobil', 'Mekanik', 'Pendapatan Jasa Service', 'Pendapatan Sparepart', 'Total Pembayaran', 'Metode Pembayaran']);

            $no = 1;
            foreach ($payments as $payment) {
                $transaction = $payment->transaction;
                $booking = $transaction?->booking;
                $customerName = $booking?->vehicle?->user?->name ?? 'Walk-in';
                $vehicleName = $booking?->vehicle ? ($booking->vehicle->brand . ' ' . $booking->vehicle->model . ' (' . $booking->vehicle->license_plate . ')') : '-';
                $mekanikName = $transaction?->mekanik?->name ?? '-';

                fputcsv($file, [
                    $no++,
                    $payment->payment_date->format('Y-m-d H:i'),
                    $customerName,
                    $vehicleName,
                    $mekanikName,
                    $transaction?->total_service ?? 0,
                    $transaction?->total_sparepart ?? 0,
                    $payment->amount_paid,
                    $payment->payment_method
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportPdf(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $paymentQuery = Payment::where('payment_status', 'Paid')
            ->with(['transaction.booking.vehicle.user', 'transaction.mekanik']);

        if ($startDate) {
            $paymentQuery->whereDate('payment_date', '>=', $startDate);
        }
        if ($endDate) {
            $paymentQuery->whereDate('payment_date', '<=', $endDate);
        }

        $payments = $paymentQuery->orderBy('payment_date', 'desc')->get();

        $totalService = 0;
        $totalSparepart = 0;
        $totalGrand = 0;

        foreach ($payments as $p) {
            $totalService += $p->transaction?->total_service ?? 0;
            $totalSparepart += $p->transaction?->total_sparepart ?? 0;
            $totalGrand += $p->amount_paid;
        }

        return view('owner.pdf_report', compact('payments', 'startDate', 'endDate', 'totalService', 'totalSparepart', 'totalGrand'));
    }
}
