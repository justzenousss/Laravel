@extends('layouts.app')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white">
        <h4 class="mb-0">Thêm sản phẩm</h4>
    </div>

    <div class="card-body">
        <form action="{{ route('products.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Tên sản phẩm</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Giá</label>
                <input type="number" name="price" class="form-control" value="{{ old('price') }}" min="0" step="0.01">
                @error('price')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Số lượng</label>
                <input type="number" name="quantity" class="form-control" value="{{ old('quantity') }}" min="0">
                @error('quantity')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Danh mục</label>
                <select name="category" class="form-select">
                    <option value="">-- Chọn danh mục --</option>
                    <option value="Đồ ăn" {{ old('category') == 'Đồ ăn' ? 'selected' : '' }}>Đồ ăn</option>
                    <option value="Đồ uống" {{ old('category') == 'Đồ uống' ? 'selected' : '' }}>Đồ uống</option>
                </select>
                @error('category')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Lưu</button>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
</div>
@endsection