<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Hiển thị danh sách + tìm kiếm
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $products = Product::when($keyword, function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate(5)
            ->appends([
                'keyword' => $keyword
            ]);

        return view('products.index', compact('products', 'keyword'));
    }

    // Hiển thị form thêm
    public function create()
    {
        return view('products.create');
    }

    // Lưu sản phẩm
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2|max:100',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'category' => 'required|in:Đồ ăn,Đồ uống'
        ], [
            'name.required' => 'Tên sản phẩm không được để trống.',
            'name.min' => 'Tên sản phẩm phải có ít nhất 2 ký tự.',
            'name.max' => 'Tên sản phẩm không được vượt quá 100 ký tự.',

            'price.required' => 'Giá không được để trống.',
            'price.numeric' => 'Giá phải là số.',
            'price.min' => 'Giá phải lớn hơn hoặc bằng 0.',

            'quantity.required' => 'Số lượng không được để trống.',
            'quantity.integer' => 'Số lượng phải là số nguyên.',
            'quantity.min' => 'Số lượng phải lớn hơn hoặc bằng 0.',

            'category.required' => 'Danh mục không được để trống.',
            'category.in' => 'Danh mục không hợp lệ.'
        ]);

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'category' => $request->category
        ]);

        return redirect()->route('products.index')->with('success', 'Thêm sản phẩm thành công!');
    }

    // Hiển thị form sửa
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    // Cập nhật sản phẩm
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|min:2|max:100',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'category' => 'required|in:Đồ ăn,Đồ uống'
        ], [
            'name.required' => 'Tên sản phẩm không được để trống.',
            'name.min' => 'Tên sản phẩm phải có ít nhất 2 ký tự.',
            'name.max' => 'Tên sản phẩm không được vượt quá 100 ký tự.',

            'price.required' => 'Giá không được để trống.',
            'price.numeric' => 'Giá phải là số.',
            'price.min' => 'Giá phải lớn hơn hoặc bằng 0.',

            'quantity.required' => 'Số lượng không được để trống.',
            'quantity.integer' => 'Số lượng phải là số nguyên.',
            'quantity.min' => 'Số lượng phải lớn hơn hoặc bằng 0.',

            'category.required' => 'Danh mục không được để trống.',
            'category.in' => 'Danh mục không hợp lệ.'
        ]);

        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'category' => $request->category
        ]);

        return redirect()->route('products.index')->with('success', 'Cập nhật sản phẩm thành công!');
    }

    // Xóa sản phẩm
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Xóa sản phẩm thành công!');
    }
}