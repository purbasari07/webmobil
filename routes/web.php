<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\MekanikController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\CustomerController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Shared Print Invoice (Kasir & Customer & Owner can access if authenticated)
    Route::get('/invoice/{transaction}', [KasirController::class, 'invoice'])->name('invoice.print');

    // Admin Group
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        
        // Services CRUD
        Route::get('/services', [AdminController::class, 'servicesIndex'])->name('services.index');
        Route::get('/services/create', [AdminController::class, 'servicesCreate'])->name('services.create');
        Route::post('/services', [AdminController::class, 'servicesStore'])->name('services.store');
        Route::get('/services/{service}/edit', [AdminController::class, 'servicesEdit'])->name('services.edit');
        Route::put('/services/{service}', [AdminController::class, 'servicesUpdate'])->name('services.update');
        Route::delete('/services/{service}', [AdminController::class, 'servicesDestroy'])->name('services.destroy');

        // Spareparts CRUD
        Route::get('/spareparts', [AdminController::class, 'sparepartsIndex'])->name('spareparts.index');
        Route::get('/spareparts/create', [AdminController::class, 'sparepartsCreate'])->name('spareparts.create');
        Route::post('/spareparts', [AdminController::class, 'sparepartsStore'])->name('spareparts.store');
        Route::get('/spareparts/{sparepart}/edit', [AdminController::class, 'sparepartsEdit'])->name('spareparts.edit');
        Route::put('/spareparts/{sparepart}', [AdminController::class, 'sparepartsUpdate'])->name('spareparts.update');
        Route::delete('/spareparts/{sparepart}', [AdminController::class, 'sparepartsDestroy'])->name('spareparts.destroy');
    });

    // Kasir Group
    Route::middleware('role:kasir')->prefix('kasir')->name('kasir.')->group(function () {
        Route::get('/dashboard', [KasirController::class, 'dashboard'])->name('dashboard');
        Route::get('/booking/offline', [KasirController::class, 'createOfflineForm'])->name('booking.offline');
        Route::post('/booking/offline', [KasirController::class, 'storeOffline'])->name('booking.offline.store');
        
        Route::get('/checkout/{booking}', [KasirController::class, 'checkoutForm'])->name('checkout');
        Route::post('/checkout/{booking}/sparepart', [KasirController::class, 'addSparepart'])->name('checkout.sparepart');
        Route::delete('/checkout/{booking}/sparepart/{sparepart_id}', [KasirController::class, 'removeSparepart'])->name('checkout.sparepart.remove');
        Route::post('/checkout/{booking}/payment', [KasirController::class, 'pay'])->name('checkout.pay');
        
        Route::get('/direct-sale', [KasirController::class, 'directSaleForm'])->name('direct-sale');
        Route::post('/direct-sale', [KasirController::class, 'processDirectSale'])->name('direct-sale.process');
    });

    // Mekanik Group
    Route::middleware('role:mekanik')->prefix('mekanik')->name('mekanik.')->group(function () {
        Route::get('/dashboard', [MekanikController::class, 'dashboard'])->name('dashboard');
        Route::post('/booking/{booking}/acc', [MekanikController::class, 'accBooking'])->name('booking.acc');
        Route::post('/booking/{booking}/start', [MekanikController::class, 'startBooking'])->name('booking.start');
        Route::post('/booking/{booking}/complete', [MekanikController::class, 'completeBooking'])->name('booking.complete');
    });

    // Owner Group
    Route::middleware('role:owner')->prefix('owner')->name('owner.')->group(function () {
        Route::get('/dashboard', [OwnerController::class, 'dashboard'])->name('dashboard');
        Route::get('/export/excel', [OwnerController::class, 'exportExcel'])->name('export.excel');
        Route::get('/export/pdf', [OwnerController::class, 'exportPdf'])->name('export.pdf');
    });

    // Customer Group
    Route::middleware('role:customer')->prefix('customer')->name('customer.')->group(function () {
        Route::get('/dashboard', [CustomerController::class, 'dashboard'])->name('dashboard');
        Route::post('/vehicles', [CustomerController::class, 'storeVehicle'])->name('vehicles.store');
        Route::get('/booking/new', [CustomerController::class, 'createBooking'])->name('booking.create');
        Route::post('/booking/new', [CustomerController::class, 'storeBooking'])->name('booking.store');
    });
});
