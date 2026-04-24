<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['brand', 'images']);

        if ($request->filled('keyword')) {
            $query->where('name', 'like', '%' . $request->keyword . '%');
        }

        if ($request->filled('brand_id')) {
            $query->where('brand_id', $request->brand_id);
        }

        if ($request->filled('min_price')) {
            $query->where('price', '>=', (float) $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', (float) $request->max_price);
        }

        switch ($request->get('sort')) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;

            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;

            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;

            case 'stock_desc':
                $query->orderBy('quantity', 'desc');
                break;

            default:
                $query->latest();
                break;
        }

        $products = $query->paginate(9)->withQueryString();
        $brands = Brand::orderBy('name')->get();

        $priceBounds = [
            'min' => 0,
            'max' => 50000000,
        ];

        return view('products.index', compact('products', 'brands', 'priceBounds'));
    }

    public function show($slug)
    {
        $product = Product::with(['brand', 'images'])->where('slug', $slug)->firstOrFail();

        $relatedProducts = Product::with(['brand', 'images'])
            ->where('brand_id', $product->brand_id)
            ->where('id', '!=', $product->id)
            ->latest()
            ->take(4)
            ->get();

        return view('products.show', compact('product', 'relatedProducts'));
    }
}