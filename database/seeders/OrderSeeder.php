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
                'desain' => 'Logo',
                'warna' => 'Putih',
                'ukuran' => 'XL',
                'posisi' => 'tengah',
                'status' => 'selesai',
            ],
            [
                'customer_id' => '2',
                'kode' => 'KD002',
                'tipe' => 'sablon',
                'jumlah' => '100',
                'desain' => 'Foto',
                'warna' => 'Putih',
                'ukuran' => 'XL',
                'posisi' => 'tengah',
                'status' => 'proses',
            ],
            [
                'customer_id' => '3',
                'kode' => 'KD003',
                'tipe' => 'bordir',
                'jumlah' => '70',
                'desain' => 'Foto',
                'warna' => 'Putih',
                'ukuran' => 'L',
                'posisi' => 'tengah',
            ],
        ];

        foreach ($orders as $order) {
            Order::create($order);
        }
    }
}
