<?php

namespace Database\Seeders;

use App\Models\Delivery;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DeliverySeeder extends Seeder
{
    public function run(): void
    {
        $deliveries = [
            [
                'order_id' => '1',
                'jumlah' => '50',
                'metode' => 'Pickup',
                'nama_penerima' => 'Budi',
                'kontak_penerima' => '085778294113',
            ],
        ];

        foreach ($deliveries as $delivery) {
            Delivery::create($delivery);
        }
    }
}
