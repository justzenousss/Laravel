<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        Brand::insert([
            [
                'name' => 'Dell',
                'description' => 'Laptop Dell chính hãng',
                'logo' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'HP',
                'description' => 'Laptop HP chính hãng',
                'logo' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Asus',
                'description' => 'Laptop Asus chính hãng',
                'logo' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Lenovo',
                'description' => 'Laptop Lenovo chính hãng',
                'logo' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}