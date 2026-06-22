<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Sparepart;
use App\Models\Booking;
use App\Models\Transaction;

class AdminController extends Controller
{
    public function dashboard()
    {
        $servicesCount = Service::count();
        $sparepartsCount = Sparepart::count();
        $totalBookings = Booking::count();
        $pendingBookings = Booking::where('status', 'Pending')->count();

        return view('admin.dashboard', compact('servicesCount', 'sparepartsCount', 'totalBookings', 'pendingBookings'));
    }

    // --- Services CRUD ---
    public function servicesIndex()
    {
        $services = Service::latest()->get();
        return view('admin.services.index', compact('services'));
    }

    public function servicesCreate()
    {
        return view('admin.services.create');
    }

    public function servicesStore(Request $request)
    {
        $data = $request->validate([
            'service_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'estimated_time' => 'required|string|max:100',
        ]);

        Service::create($data);

        return redirect()->route('admin.services.index')->with('success', 'Layanan servis berhasil ditambahkan.');
    }

    public function servicesEdit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function servicesUpdate(Request $request, Service $service)
    {
        $data = $request->validate([
            'service_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'estimated_time' => 'required|string|max:100',
        ]);

        $service->update($data);

        return redirect()->route('admin.services.index')->with('success', 'Layanan servis berhasil diperbarui.');
    }

    public function servicesDestroy(Service $service)
    {
        $service->delete();
        return redirect()->route('admin.services.index')->with('success', 'Layanan servis berhasil dihapus.');
    }

    // --- Spareparts CRUD ---
    public function sparepartsIndex()
    {
        $spareparts = Sparepart::latest()->get();
        return view('admin.spareparts.index', compact('spareparts'));
    }

    public function sparepartsCreate()
    {
        return view('admin.spareparts.create');
    }

    public function sparepartsStore(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
        ]);

        Sparepart::create($data);

        return redirect()->route('admin.spareparts.index')->with('success', 'Sparepart berhasil ditambahkan.');
    }

    public function sparepartsEdit(Sparepart $sparepart)
    {
        return view('admin.spareparts.edit', compact('sparepart'));
    }

    public function sparepartsUpdate(Request $request, Sparepart $sparepart)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
        ]);

        $sparepart->update($data);

        return redirect()->route('admin.spareparts.index')->with('success', 'Sparepart berhasil diperbarui.');
    }

    public function sparepartsDestroy(Sparepart $sparepart)
    {
        $sparepart->delete();
        return redirect()->route('admin.spareparts.index')->with('success', 'Sparepart berhasil dihapus.');
    }
}
