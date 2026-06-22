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
            'name' => 'Workshop Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
            'phone' => '081234567890',
            'address' => 'Jl. Admin No. 1, Jakarta',
        ]);

        $kasir = User::create([
            'name' => 'Workshop Kasir',
            'email' => 'kasir@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'kasir',
            'phone' => '081234567891',
            'address' => 'Jl. Kasir No. 2, Jakarta',
        ]);

        $mekanik = User::create([
            'name' => 'Workshop Mekanik',
            'email' => 'mekanik@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'mekanik',
            'phone' => '081234567892',
            'address' => 'Jl. Mekanik No. 3, Jakarta',
        ]);

        $owner = User::create([
            'name' => 'Workshop Owner',
            'email' => 'owner@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'owner',
            'phone' => '081234567893',
            'address' => 'Jl. Owner No. 4, Jakarta',
        ]);

        $customer = User::create([
            'name' => 'Workshop Customer',
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

        // 5. Seed Mock Customer Data & Vehicles for reports
        $mockCustomers = [
            [
                'name' => 'Budi Santoso',
                'email' => 'budi@gmail.com',
                'phone' => '089876543210',
                'address' => 'Jl. Sudirman No. 12, Bandung',
                'vehicle' => ['brand' => 'Honda', 'model' => 'Civic Turbo', 'year' => 2019, 'license_plate' => 'D 999 BS', 'color' => 'Merah']
            ],
            [
                'name' => 'Dewi Lestari',
                'email' => 'dewi@gmail.com',
                'phone' => '089876543211',
                'address' => 'Jl. Merdeka No. 45, Bandung',
                'vehicle' => ['brand' => 'Suzuki', 'model' => 'Ertiga', 'year' => 2018, 'license_plate' => 'D 888 DW', 'color' => 'Abu-abu']
            ],
            [
                'name' => 'Eko Prasetyo',
                'email' => 'eko@gmail.com',
                'phone' => '089876543212',
                'address' => 'Jl. Pajajaran No. 3, Bandung',
                'vehicle' => ['brand' => 'Mitsubishi', 'model' => 'Xpander', 'year' => 2020, 'license_plate' => 'D 777 EK', 'color' => 'Putih']
            ],
            [
                'name' => 'Siti Aminah',
                'email' => 'siti@gmail.com',
                'phone' => '089876543213',
                'address' => 'Jl. Gatot Subroto No. 56, Bandung',
                'vehicle' => ['brand' => 'Daihatsu', 'model' => 'Ayla', 'year' => 2017, 'license_plate' => 'D 555 ST', 'color' => 'Silver']
            ]
        ];

        // Let's seed completed transactions over the last 30 days
        $startOfPeriod = Carbon::now()->subDays(30);

        for ($i = 0; $i < 15; $i++) {
            $custData = $mockCustomers[$i % count($mockCustomers)];
            
            // Check if user already exists
            $mCustomer = User::where('email', $custData['email'])->first();
            if (!$mCustomer) {
                $mCustomer = User::create([
                    'name' => $custData['name'],
                    'email' => $custData['email'],
                    'password' => Hash::make('12345678'),
                    'role' => 'customer',
                    'phone' => $custData['phone'],
                    'address' => $custData['address'],
                ]);
            }

            // Create Vehicle
            $mVehicle = Vehicle::create([
                'user_id' => $mCustomer->id,
                'brand' => $custData['vehicle']['brand'],
                'model' => $custData['vehicle']['model'],
                'year' => $custData['vehicle']['year'],
                'license_plate' => $custData['vehicle']['license_plate'],
                'color' => $custData['vehicle']['color'],
            ]);

            // Randomize service & sparepart
            $service = $serviceModels[$i % count($serviceModels)];
            $sparepart = $sparepartModels[$i % count($sparepartModels)];

            // Create Booking
            $bookingDate = (clone $startOfPeriod)->addDays(rand(1, 28));
            $bookingTime = sprintf('%02d:00:00', rand(8, 16));
            
            $booking = Booking::create([
                'user_id' => $mCustomer->id,
                'vehicle_id' => $mVehicle->id,
                'service_id' => $service->id,
                'booking_date' => $bookingDate->format('Y-m-d'),
                'booking_time' => $bookingTime,
                'status' => 'Completed',
                'complaint' => 'Servis rutin berkala, tolong cek kelistrikan.',
                'is_offline' => rand(0, 1) === 1,
            ]);

            // Create Transaction
            $totalService = $service->price;
            $qty = rand(1, 2);
            $totalSparepart = $sparepart->price * $qty;
            $grandTotal = $totalService + $totalSparepart;

            $transaction = Transaction::create([
                'booking_id' => $booking->id,
                'mekanik_id' => $mekanik->id,
                'kasir_id' => $kasir->id,
                'total_service' => $totalService,
                'total_sparepart' => $totalSparepart,
                'grand_total' => $grandTotal,
                'created_at' => $bookingDate,
                'updated_at' => $bookingDate,
            ]);

            // Link sparepart to transaction
            $transaction->spareparts()->attach($sparepart->id, [
                'quantity' => $qty,
                'price' => $sparepart->price,
                'created_at' => $bookingDate,
                'updated_at' => $bookingDate,
            ]);

            // Create Payment
            Payment::create([
                'transaction_id' => $transaction->id,
                'payment_date' => $bookingDate,
                'amount_paid' => $grandTotal,
                'payment_method' => ['Cash', 'Transfer', 'QRIS'][rand(0, 2)],
                'payment_status' => 'Paid',
                'created_at' => $bookingDate,
                'updated_at' => $bookingDate,
            ]);
        }
    }
}
