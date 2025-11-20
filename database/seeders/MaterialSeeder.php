<?php

namespace Database\Seeders;

use App\Models\Material;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MaterialSeeder extends Seeder
{
    public function run(): void
    {
        $materials = [
            [
                'order_id' => '1',
                'nama_item' => 'Kain drill putih',
                'jumlah_diterima' => '50',
            ],
            [
                'order_id' => '2',
                'nama_item' => 'Kain drill putih',
                'jumlah_diterima' => '100',
            ],
            [
                'order_id' => '1',
                'nama_item' => 'Kain drill putih',
                'jumlah_diterima' => '70',
            ],
        ];

        foreach ($materials as $material) {
            Material::create($material);
        }
    }
}
