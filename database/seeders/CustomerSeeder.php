<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        $customers = [
            [
                'nama' => 'Juwita',
                'no_telepon' => '081334268446',
                'alamat' => 'Probolinggo',
                'nama_perusahaan' => 'PT Jaya Abadi',
            ],
            [
                'nama' => 'Siti Rahma',
                'no_telepon' => '082233445566',
                'alamat' => 'Kraksaan',
                'nama_perusahaan' => 'CV Maju Bersama',
            ],
            [
                'nama' => 'Dewi Lestari',
                'no_telepon' => '081355778899',
                'alamat' => 'Paiton',
                'nama_perusahaan' => 'PT Sentosa Textile',
            ],
            [
                'nama' => 'Nanda Putri',
                'no_telepon' => '085233119922',
                'alamat' => 'Lumajang',
                'nama_perusahaan' => 'CV Sinar Baru',
            ],
            [
                'nama' => 'Anisa Mahardika',
                'no_telepon' => '081249556677',
                'alamat' => 'Pasuruan',
                'nama_perusahaan' => 'PT Karya Utama',
            ],
        ];

        foreach ($customers as $customer) {
            Customer::create($customer);
        }
    }
}
