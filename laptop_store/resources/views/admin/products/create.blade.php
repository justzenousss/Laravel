@extends('layouts.app')

@section('title', 'Thêm sản phẩm')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Thêm sản phẩm</h2>
            <p class="text-muted mb-0">Mỗi sản phẩm có thể có 1 ảnh chính và tối đa 3 ảnh phụ.</p>
        </div>
        <a href="{{ route('admin.products.index') }}" class="btn btn-outline-dark">Quay lại danh sách</a>
    </div>

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-4">
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label">Tên sản phẩm</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Hãng</label>
                        <select name="brand_id" class="form-select @error('brand_id') is-invalid @enderror">
                            <option value="">-- Chọn hãng --</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                                    {{ $brand->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('brand_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Giá bán</label>
                        <input type="number" min="0" step="1000" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}">
                        @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Giá cũ</label>
                        <input type="number" min="0" step="1000" name="old_price" class="form-control @error('old_price') is-invalid @enderror" value="{{ old('old_price') }}">
                        @error('old_price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Số lượng</label>
                        <input type="number" min="0" step="1" name="quantity" class="form-control @error('quantity') is-invalid @enderror" value="{{ old('quantity', 0) }}">
                        @error('quantity') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">CPU</label>
                        <input type="text" name="cpu" class="form-control @error('cpu') is-invalid @enderror" value="{{ old('cpu') }}">
                        @error('cpu') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">RAM</label>
                        <input type="text" name="ram" class="form-control @error('ram') is-invalid @enderror" value="{{ old('ram') }}">
                        @error('ram') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Ổ cứng</label>
                        <input type="text" name="storage" class="form-control @error('storage') is-invalid @enderror" value="{{ old('storage') }}">
                        @error('storage') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Màn hình</label>
                        <input type="text" name="screen" class="form-control @error('screen') is-invalid @enderror" value="{{ old('screen') }}">
                        @error('screen') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">GPU / Camera</label>
                        <input type="text" name="gpu" class="form-control @error('gpu') is-invalid @enderror" value="{{ old('gpu') }}">
                        @error('gpu') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Hệ điều hành</label>
                        <input type="text" name="os" class="form-control @error('os') is-invalid @enderror" value="{{ old('os') }}">
                        @error('os') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Khối lượng (kg)</label>
                        <input type="number" min="0" step="0.01" name="weight" class="form-control @error('weight') is-invalid @enderror" value="{{ old('weight') }}">
                        @error('weight') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Ảnh chính</label>
                        <input type="file" name="image" accept="image/*" class="form-control @error('image') is-invalid @enderror">
                        @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        <div class="form-text">Ảnh đại diện để hiển thị ở danh sách sản phẩm.</div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Ảnh phụ (tối đa 3 ảnh)</label>
                        <input type="file" name="images[]" accept="image/*" multiple class="form-control @error('images') is-invalid @enderror @error('images.*') is-invalid @enderror">
                        @error('images') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        @error('images.*') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        <div class="form-text">Có thể chọn cùng lúc 2 đến 3 ảnh để làm gallery.</div>
                    </div>

                    <div class="col-md-6 d-flex align-items-end">
                        <div class="form-check form-switch fs-5">
                            <input class="form-check-input" type="checkbox" role="switch" id="is_featured" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_featured">Đánh dấu là sản phẩm nổi bật</label>
                        </div>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Mô tả</label>
                        <textarea name="description" rows="5" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-warning">Lưu sản phẩm</button>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">Hủy</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection