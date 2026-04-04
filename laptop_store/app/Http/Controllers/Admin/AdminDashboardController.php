<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalBrands = Brand::count();
        $totalOrders = Order::count();
        $totalUsers = User::count();

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalBrands',
            'totalOrders',
            'totalUsers'
        ));
    }
}