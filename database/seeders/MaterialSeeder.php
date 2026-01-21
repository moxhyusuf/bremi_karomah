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
                'desain' => 'desain/1.jpg',
            ],
            [
                'order_id' => '2',
                'nama_item' => 'Kain drill putih',
                'desain' => 'desain/2.jpg',
            ],
            [
                'order_id' => '1',
                'nama_item' => 'Kain drill putih',
                'desain' => 'desain/3.png',
            ],
        ];

        foreach ($materials as $material) {
            Material::create($material);
        }
    }
}
