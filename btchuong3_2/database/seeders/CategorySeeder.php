<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Điện thoại'],
            ['name' => 'Laptop'],
            ['name' => 'Phụ kiện'],
            ['name' => 'Máy tính bảng'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}