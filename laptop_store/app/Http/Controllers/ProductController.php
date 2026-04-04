<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('brand');

        if ($request->keyword) {
            $query->where('name', 'like', '%' . $request->keyword . '%');
        }

        if ($request->brand_id) {
            $query->where('brand_id', $request->brand_id);
        }

        $products = $query->latest()->paginate(8);
        $brands = Brand::all();

        return view('products.index', compact('products', 'brands'));
    }

    public function show($slug)
    {
        $product = Product::with('brand')->where('slug', $slug)->firstOrFail();
        $relatedProducts = Product::where('brand_id', $product->brand_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        return view('products.show', compact('product', 'relatedProducts'));
    }
}