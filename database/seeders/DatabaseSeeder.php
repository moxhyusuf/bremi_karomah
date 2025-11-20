<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\OrderSeeder;
use Database\Seeders\CustomerSeeder;
use Database\Seeders\DeliverySeeder;
use Database\Seeders\MaterialSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CustomerSeeder::class,
            OrderSeeder::class,
            MaterialSeeder::class,
            DeliverySeeder::class,
        ]);
    }
}
