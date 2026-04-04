<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::insert([
            [
                'brand_id' => 1,
                'name' => 'Dell Inspiron 15',
                'slug' => 'dell-inspiron-15',
                'price' => 15990000,
                'old_price' => 17990000,
                'quantity' => 10,
                'image' => 'products/dell-inspiron.jpg',
                'cpu' => 'Intel Core i5',
                'ram' => '8GB',
                'storage' => '512GB SSD',
                'screen' => '15.6 inch FHD',
                'gpu' => 'Intel Iris Xe',
                'os' => 'Windows 11',
                'weight' => 1.75,
                'description' => 'Laptop Dell phù hợp học tập và văn phòng.',
                'is_featured' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'brand_id' => 2,
                'name' => 'HP Pavilion 14',
                'slug' => 'hp-pavilion-14',
                'price' => 16990000,
                'old_price' => 18990000,
                'quantity' => 8,
                'image' => 'products/hp-pavilion.jpg',
                'cpu' => 'Intel Core i5',
                'ram' => '16GB',
                'storage' => '512GB SSD',
                'screen' => '14 inch FHD',
                'gpu' => 'Intel Iris Xe',
                'os' => 'Windows 11',
                'weight' => 1.41,
                'description' => 'Thiết kế đẹp, mỏng nhẹ, phù hợp sinh viên và nhân viên văn phòng.',
                'is_featured' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'brand_id' => 3,
                'name' => 'Asus VivoBook 15',
                'slug' => 'asus-vivobook-15',
                'price' => 14990000,
                'old_price' => 16590000,
                'quantity' => 12,
                'image' => 'products/asus-vivobook.jpg',
                'cpu' => 'AMD Ryzen 5',
                'ram' => '8GB',
                'storage' => '512GB SSD',
                'screen' => '15.6 inch FHD',
                'gpu' => 'AMD Radeon Graphics',
                'os' => 'Windows 11',
                'weight' => 1.80,
                'description' => 'Laptop giá tốt, hiệu năng ổn định.',
                'is_featured' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'brand_id' => 4,
                'name' => 'Lenovo IdeaPad Slim 5',
                'slug' => 'lenovo-ideapad-slim-5',
                'price' => 18990000,
                'old_price' => 20990000,
                'quantity' => 6,
                'image' => 'products/lenovo-ideapad.jpg',
                'cpu' => 'Intel Core i7',
                'ram' => '16GB',
                'storage' => '512GB SSD',
                'screen' => '14 inch 2.2K',
                'gpu' => 'Intel Iris Xe',
                'os' => 'Windows 11',
                'weight' => 1.46,
                'description' => 'Mẫu laptop cao cấp cho công việc và học tập.',
                'is_featured' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}