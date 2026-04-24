<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminProductController extends Controller
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

        $products = $query->latest()->paginate(10);
        $brands = Brand::orderBy('name')->get();

        return view('admin.products.index', compact('products', 'brands'));
    }

    public function create()
    {
        $brands = Brand::orderBy('name')->get();

        return view('admin.products.create', compact('brands'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'brand_id' => ['required', 'exists:brands,id'],
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'old_price' => ['nullable', 'numeric', 'min:0'],
            'quantity' => ['required', 'integer', 'min:0'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,gif', 'max:2048'],
            'images' => ['nullable', 'array', 'max:3'],
            'images.*' => ['image', 'mimes:jpg,jpeg,png,webp,gif', 'max:2048'],
            'cpu' => ['nullable', 'string', 'max:255'],
            'ram' => ['nullable', 'string', 'max:255'],
            'storage' => ['nullable', 'string', 'max:255'],
            'screen' => ['nullable', 'string', 'max:255'],
            'gpu' => ['nullable', 'string', 'max:255'],
            'os' => ['nullable', 'string', 'max:255'],
            'weight' => ['nullable', 'numeric', 'min:0'],
            'description' => ['nullable', 'string'],
            'is_featured' => ['nullable', 'boolean'],
        ], [
            'brand_id.required' => 'Vui lòng chọn hãng.',
            'brand_id.exists' => 'Hãng không tồn tại.',
            'name.required' => 'Vui lòng nhập tên sản phẩm.',
            'price.required' => 'Vui lòng nhập giá bán.',
            'quantity.required' => 'Vui lòng nhập số lượng.',
            'image.image' => 'Ảnh chính phải là hình ảnh hợp lệ.',
            'images.array' => 'Ảnh phụ không hợp lệ.',
            'images.max' => 'Chỉ được tải tối đa 3 ảnh phụ.',
            'images.*.image' => 'Mỗi ảnh phụ phải là hình ảnh hợp lệ.',
        ]);

        $validated['slug'] = $this->generateUniqueSlug($validated['name']);
        $validated['is_featured'] = $request->boolean('is_featured');

        if (array_key_exists('old_price', $validated) && $validated['old_price'] === null) {
            unset($validated['old_price']);
        }

        DB::transaction(function () use ($request, $validated) {
            $productData = $validated;

            if ($request->hasFile('image')) {
                $productData['image'] = $request->file('image')->store('products', 'public');
            }

            $product = Product::create($productData);

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $index => $imageFile) {
                    $path = $imageFile->store('products/gallery', 'public');

                    $product->images()->create([
                        'image' => $path,
                        'sort_order' => $index + 1,
                    ]);
                }
            }
        });

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Thêm sản phẩm thành công.');
    }

    public function show(string $id)
    {
        return redirect()->route('admin.products.edit', $id);
    }

    public function edit(string $id)
    {
        $product = Product::with('images')->findOrFail($id);
        $brands = Brand::orderBy('name')->get();

        return view('admin.products.edit', compact('product', 'brands'));
    }

    public function update(Request $request, string $id)
    {
        $product = Product::with('images')->findOrFail($id);

        $validated = $request->validate([
            'brand_id' => ['required', 'exists:brands,id'],
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'old_price' => ['nullable', 'numeric', 'min:0'],
            'quantity' => ['required', 'integer', 'min:0'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,gif', 'max:2048'],
            'images' => ['nullable', 'array', 'max:3'],
            'images.*' => ['image', 'mimes:jpg,jpeg,png,webp,gif', 'max:2048'],
            'remove_gallery' => ['nullable', 'boolean'],
            'cpu' => ['nullable', 'string', 'max:255'],
            'ram' => ['nullable', 'string', 'max:255'],
            'storage' => ['nullable', 'string', 'max:255'],
            'screen' => ['nullable', 'string', 'max:255'],
            'gpu' => ['nullable', 'string', 'max:255'],
            'os' => ['nullable', 'string', 'max:255'],
            'weight' => ['nullable', 'numeric', 'min:0'],
            'description' => ['nullable', 'string'],
            'is_featured' => ['nullable', 'boolean'],
        ], [
            'images.max' => 'Chỉ được tải tối đa 3 ảnh phụ.',
            'images.*.image' => 'Mỗi ảnh phụ phải là hình ảnh hợp lệ.',
        ]);

        $validated['slug'] = $this->generateUniqueSlug($validated['name'], $product->id);
        $validated['is_featured'] = $request->boolean('is_featured');

        if (array_key_exists('old_price', $validated) && $validated['old_price'] === null) {
            $validated['old_price'] = null;
        }

        DB::transaction(function () use ($request, $product, $validated) {
            $productData = $validated;
            unset($productData['images'], $productData['remove_gallery']);

            if ($request->hasFile('image')) {
                if ($product->image && Storage::disk('public')->exists($product->image)) {
                    Storage::disk('public')->delete($product->image);
                }

                $productData['image'] = $request->file('image')->store('products', 'public');
            }

            $product->update($productData);

            $shouldReplaceGallery = $request->hasFile('images') || $request->boolean('remove_gallery');

            if ($shouldReplaceGallery) {
                foreach ($product->images as $galleryImage) {
                    if ($galleryImage->image && Storage::disk('public')->exists($galleryImage->image)) {
                        Storage::disk('public')->delete($galleryImage->image);
                    }
                }

                $product->images()->delete();

                if ($request->hasFile('images')) {
                    foreach ($request->file('images') as $index => $imageFile) {
                        $path = $imageFile->store('products/gallery', 'public');

                        $product->images()->create([
                            'image' => $path,
                            'sort_order' => $index + 1,
                        ]);
                    }
                }
            }
        });

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Cập nhật sản phẩm thành công.');
    }

    public function destroy(string $id)
    {
        $product = Product::with('images')->findOrFail($id);

        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        foreach ($product->images as $galleryImage) {
            if ($galleryImage->image && Storage::disk('public')->exists($galleryImage->image)) {
                Storage::disk('public')->delete($galleryImage->image);
            }
        }

        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Xóa sản phẩm thành công.');
    }

    private function generateUniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($name);
        $slug = $baseSlug !== '' ? $baseSlug : 'san-pham';
        $counter = 1;

        while (
            Product::when($ignoreId, function ($query) use ($ignoreId) {
                $query->where('id', '!=', $ignoreId);
            })->where('slug', $slug)->exists()
        ) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}