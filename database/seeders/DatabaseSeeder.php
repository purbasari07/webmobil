<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Service;
use App\Models\Sparepart;
use App\Models\Vehicle;
use App\Models\Booking;
use App\Models\Transaction;
use App\Models\Payment;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Default Users for Roles
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
            'phone' => '081234567890',
            'address' => 'Jl. Admin No. 1, Jakarta',
        ]);

        $kasir = User::create([
            'name' => 'Kasir',
            'email' => 'kasir@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'kasir',
            'phone' => '081234567891',
            'address' => 'Jl. Kasir No. 2, Jakarta',
        ]);

        $mekanik = User::create([
            'name' => 'Mekanik',
            'email' => 'mekanik@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'mekanik',
            'phone' => '081234567892',
            'address' => 'Jl. Mekanik No. 3, Jakarta',
        ]);

        $owner = User::create([
            'name' => 'Owner',
            'email' => 'owner@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'owner',
            'phone' => '081234567893',
            'address' => 'Jl. Owner No. 4, Jakarta',
        ]);

        $customer = User::create([
            'name' => 'Customer',
            'email' => 'customer@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'customer',
            'phone' => '081234567894',
            'address' => 'Jl. Customer No. 5, Jakarta',
        ]);

        // 2. Create Default Services
        $services = [
            [
                'service_name' => 'Ganti Oli Mesin',
                'description' => 'Ganti oli mesin standard beserta filter oli.',
                'price' => 150000.00,
                'estimated_time' => '30 Menit',
            ],
            [
                'service_name' => 'Servis Rem Paket',
                'description' => 'Pembersihan rem depan dan belakang, ganti minyak rem jika diperlukan.',
                'price' => 200000.00,
                'estimated_time' => '45 Menit',
            ],
            [
                'service_name' => 'Tune-Up Mesin',
                'description' => 'Tune-up menyeluruh, pembersihan throtle body, busi, dan scan ECU.',
                'price' => 350000.00,
                'estimated_time' => '60 Menit',
            ],
            [
                'service_name' => 'Servis AC Ringan',
                'description' => 'Vacuum AC, isi freon baru, dan pembersihan filter kabin.',
                'price' => 250000.00,
                'estimated_time' => '60 Menit',
            ],
            [
                'service_name' => 'Ganti Aki Mobil',
                'description' => 'Jasa penggantian aki beserta backup kelistrikan mobil.',
                'price' => 75000.00,
                'estimated_time' => '20 Menit',
            ],
            [
                'service_name' => 'Servis Kaki-Kaki',
                'description' => 'Pengecekan shockbreaker, tierod, rackend, dan bushing arm.',
                'price' => 300000.00,
                'estimated_time' => '90 Menit',
            ],
        ];

        $serviceModels = [];
        foreach ($services as $srv) {
            $serviceModels[] = Service::create($srv);
        }

        // 3. Create Default Spareparts
        $spareparts = [
            [
                'name' => 'Oli Shell Helix HX7 10W-40 4L',
                'brand' => 'Shell',
                'stock' => 30,
                'price' => 380000.00,
            ],
            [
                'name' => 'Kampas Rem Depan Avanza',
                'brand' => 'Aisin',
                'stock' => 15,
                'price' => 245000.00,
            ],
            [
                'name' => 'Busi Denso Iridium Power',
                'brand' => 'Denso',
                'stock' => 100,
                'price' => 95000.00,
            ],
            [
                'name' => 'Aki GS Astra MF NS60',
                'brand' => 'GS Astra',
                'stock' => 10,
                'price' => 920000.00,
            ],
            [
                'name' => 'Filter Oli Avanza/Xenia',
                'brand' => 'Denso',
                'stock' => 50,
                'price' => 45000.00,
            ],
            [
                'name' => 'Filter Udara Avanza',
                'brand' => 'Toyota Genuine Parts',
                'stock' => 20,
                'price' => 125000.00,
            ],
            [
                'name' => 'Freon R134a 1 Kaleng',
                'brand' => 'Kleas',
                'stock' => 40,
                'price' => 85000.00,
            ],
        ];

        $sparepartModels = [];
        foreach ($spareparts as $sp) {
            $sparepartModels[] = Sparepart::create($sp);
        }

        // 4. Create Customer Vehicle
        $vehicle = Vehicle::create([
            'user_id' => $customer->id,
            'brand' => 'Toyota',
            'model' => 'Avanza Veloz',
            'year' => 2021,
            'license_plate' => 'B 1234 ABC',
            'color' => 'Hitam Metalik',
        ]);
    }
}
