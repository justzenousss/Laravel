<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $brands = Brand::withCount('products')
            ->orderByDesc('products_count')
            ->get();

        $featuredProducts = Product::with('brand')
            ->where('is_featured', 1)
            ->latest()
            ->take(8)
            ->get();

        $latestProducts = Product::with('brand')
            ->latest()
            ->take(8)
            ->get();

        $stats = [
            'total_products' => Product::count(),
            'featured_products' => Product::where('is_featured', 1)->count(),
            'available_products' => Product::where('quantity', '>', 0)->count(),
            'brand_count' => Brand::count(),
        ];

        $heroSlides = [
            [
                'badge' => 'Flagship cao cấp',
                'title' => 'Thiết kế sang, hiệu năng mạnh, chạm là thấy khác biệt',
                'desc' => 'Màn hình sắc nét, thao tác mượt, camera nổi bật và pin đủ bền cho cả ngày làm việc lẫn giải trí.',
                'button' => 'Xem sản phẩm',
                'link' => route('products.index'),
                'icon' => 'bi-phone-fill',
                'card_title' => 'Flagship Series',
                'card_desc' => 'Khung máy cao cấp, trải nghiệm mượt mà và khả năng xử lý mạnh cho nhu cầu nặng.',
                'sub_title' => 'Màn hình đẹp',
                'sub_desc' => 'Hiển thị sáng, màu sâu',
                'badge_1' => 'Camera nổi bật',
                'badge_2' => 'Pin bền',
            ],
            [
                'badge' => 'Gaming phone',
                'title' => 'Hiệu năng bứt tốc cho game, học tập và đa nhiệm',
                'desc' => 'Chip mạnh, tản nhiệt ổn, tần số quét cao và bộ nhớ lớn giúp mọi thao tác nhanh, gọn, ổn định.',
                'button' => 'Khám phá ngay',
                'link' => route('products.index'),
                'icon' => 'bi-lightning-charge-fill',
                'card_title' => 'Gaming Performance',
                'card_desc' => 'Tối ưu cho tác vụ nặng, phản hồi nhanh và giữ trải nghiệm mượt trong thời gian dài.',
                'sub_title' => 'Hiệu năng tốt',
                'sub_desc' => 'Mượt trong nhiều tác vụ',
                'badge_1' => '120Hz mượt',
                'badge_2' => 'Tản nhiệt tốt',
            ],
            [
                'badge' => 'Camera phone',
                'title' => 'Chụp đẹp mỗi ngày, lưu lại khoảnh khắc theo cách sắc nét hơn',
                'desc' => 'Camera chi tiết, màu sắc nổi bật, hỗ trợ quay chụp tốt cho học tập, công việc và cuộc sống hằng ngày.',
                'button' => 'Xem chi tiết',
                'link' => route('products.index'),
                'icon' => 'bi-camera-fill',
                'card_title' => 'Camera Focus',
                'card_desc' => 'Ưu tiên chất lượng hình ảnh, dễ chụp đẹp trong nhiều điều kiện ánh sáng khác nhau.',
                'sub_title' => 'Chụp ảnh đẹp',
                'sub_desc' => 'Chi tiết rõ, màu tốt',
                'badge_1' => 'Ảnh sắc nét',
                'badge_2' => 'Quay video ổn',
            ],
        ];

        return view('home', compact(
            'brands',
            'featuredProducts',
            'latestProducts',
            'stats',
            'heroSlides'
        ));
    }
}