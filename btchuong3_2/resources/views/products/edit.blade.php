@extends('layouts.master')

@section('content')
    <div class="card p-4">
        <h3 class="mb-4">Cập nhật sản phẩm</h3>

        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Tên sản phẩm</label>
                <input
                    type="text"
                    name="name"
                    class="form-control"
                    value="{{ old('name', $product->name) }}"
                >
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Giá</label>
                <input
                    type="number"
                    name="price"
                    class="form-control"
                    value="{{ old('price', $product->price) }}"
                    step="0.01"
                >
                @error('price')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Số lượng</label>
                <input
                    type="number"
                    name="quantity"
                    class="form-control"
                    value="{{ old('quantity', $product->quantity) }}"
                >
                @error('quantity')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Danh mục</label>
                <select name="category_id" class="form-select">
                    @foreach($categories as $category)
                        <option
                            value="{{ $category->id }}"
                            {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}
                        >
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Ảnh hiện tại</label><br>
                @if($product->image)
                    <img
                        src="{{ route('product.image', ['path' => $product->image]) }}"
                        width="100"
                        height="100"
                        alt="Ảnh sản phẩm"
                        style="object-fit: cover; border-radius: 8px;"
                    >
                @else
                    <span class="text-muted">Chưa có ảnh</span>
                @endif
            </div>

            <div class="mb-3">
                <label class="form-label">Chọn ảnh mới</label>
                <input type="file" name="image" class="form-control">
                @error('image')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-warning">Cập nhật</button>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
@endsection