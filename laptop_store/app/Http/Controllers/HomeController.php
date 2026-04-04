<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $brands = Brand::all();
        $featuredProducts = Product::where('is_featured', 1)->latest()->take(8)->get();
        $latestProducts = Product::latest()->take(8)->get();

        return view('home', compact('brands', 'featuredProducts', 'latestProducts'));
    }
}