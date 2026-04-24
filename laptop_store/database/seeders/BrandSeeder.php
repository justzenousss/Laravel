<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        Brand::insert([
            [
                'name' => 'Apple',
                'description' => 'Điện thoại iPhone chính hãng, thiết kế cao cấp và hiệu năng mạnh.',
                'logo' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Samsung',
                'description' => 'Điện thoại Samsung đa dạng phân khúc, màn hình đẹp và pin tốt.',
                'logo' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Xiaomi',
                'description' => 'Điện thoại Xiaomi cấu hình tốt, giá hợp lý.',
                'logo' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'OPPO',
                'description' => 'Điện thoại OPPO nổi bật về thiết kế và camera selfie.',
                'logo' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
