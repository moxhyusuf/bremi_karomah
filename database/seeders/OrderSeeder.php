<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $orders = [
            [
                'customer_id' => '1',
                'kode' => 'KD001',
                'tipe' => 'sablon',
                'jumlah' => '50',
                'warna' => 'Putih',
                'ukuran' => '30',
                'posisi' => 'tengah',
                'status' => 'selesai',
            ],
            [
                'customer_id' => '2',
                'kode' => 'KD002',
                'tipe' => 'sablon',
                'jumlah' => '100',
                'warna' => 'Putih',
                'ukuran' => '35',
                'posisi' => 'tengah',
                'status' => 'proses',
            ],
            [
                'customer_id' => '3',
                'kode' => 'KD003',
                'tipe' => 'bordir',
                'jumlah' => '70',
                'warna' => 'Putih',
                'ukuran' => '50',
                'posisi' => 'tengah',
            ],
            [
                'customer_id' => '4',
                'kode' => 'KD004',
                'tipe' => 'bordir',
                'jumlah' => '20',
                'warna' => 'Putih',
                'ukuran' => '20',
                'posisi' => 'tengah',
            ],
        ];

        foreach ($orders as $order) {
            Order::create($order);
        }
    }
}
