@extends('layouts.app')

@section('title', 'Sửa sản phẩm')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Sửa sản phẩm</h2>
            <p class="text-muted mb-0">Bạn có thể thay ảnh mới, hệ thống sẽ tự xóa ảnh cũ trong storage nếu có.</p>
        </div>
        <a href="{{ route('admin.products.index') }}" class="btn btn-outline-dark">Quay lại danh sách</a>
    </div>

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-4">
            <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-4">
                    <div class="col-md-8">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label">Tên sản phẩm</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $product->name) }}">
                                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Hãng</label>
                                <select name="brand_id" class="form-select @error('brand_id') is-invalid @enderror">
                                    <option value="">-- Chọn hãng --</option>
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}" {{ old('brand_id', $product->brand_id) == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                                @error('brand_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Giá bán</label>
                                <input type="number" min="0" step="1000" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', (int) $product->price) }}">
                                @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Giá cũ</label>
                                <input type="number" min="0" step="1000" name="old_price" class="form-control @error('old_price') is-invalid @enderror" value="{{ old('old_price', $product->old_price ? (int) $product->old_price : '') }}">
                                @error('old_price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Số lượng</label>
                                <input type="number" min="0" step="1" name="quantity" class="form-control @error('quantity') is-invalid @enderror" value="{{ old('quantity', $product->quantity) }}">
                                @error('quantity') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">CPU</label>
                                <input type="text" name="cpu" class="form-control @error('cpu') is-invalid @enderror" value="{{ old('cpu', $product->cpu) }}">
                                @error('cpu') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">RAM</label>
                                <input type="text" name="ram" class="form-control @error('ram') is-invalid @enderror" value="{{ old('ram', $product->ram) }}">
                                @error('ram') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Ổ cứng</label>
                                <input type="text" name="storage" class="form-control @error('storage') is-invalid @enderror" value="{{ old('storage', $product->storage) }}">
                                @error('storage') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Màn hình</label>
                                <input type="text" name="screen" class="form-control @error('screen') is-invalid @enderror" value="{{ old('screen', $product->screen) }}">
                                @error('screen') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">GPU</label>
                                <input type="text" name="gpu" class="form-control @error('gpu') is-invalid @enderror" value="{{ old('gpu', $product->gpu) }}">
                                @error('gpu') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Hệ điều hành</label>
                                <input type="text" name="os" class="form-control @error('os') is-invalid @enderror" value="{{ old('os', $product->os) }}">
                                @error('os') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Khối lượng (kg)</label>
                                <input type="number" min="0" step="0.01" name="weight" class="form-control @error('weight') is-invalid @enderror" value="{{ old('weight', $product->weight) }}">
                                @error('weight') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Ảnh sản phẩm mới</label>
                                <input type="file" name="image" accept="image/*" class="form-control @error('image') is-invalid @enderror">
                                @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                <div class="form-text">Nếu không chọn ảnh mới, hệ thống sẽ giữ ảnh hiện tại.</div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-check form-switch fs-5">
                                    <input class="form-check-input" type="checkbox" role="switch" id="is_featured" name="is_featured" value="1" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_featured">Đánh dấu là sản phẩm nổi bật</label>
                                </div>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Mô tả</label>
                                <textarea name="description" rows="5" class="form-control @error('description') is-invalid @enderror">{{ old('description', $product->description) }}</textarea>
                                @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label d-block">Ảnh hiện tại</label>
                        <div class="border rounded-4 p-3 bg-light text-center">
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="img-fluid rounded-3" style="max-height: 280px; object-fit: cover;">
                            <div class="small text-muted mt-2">{{ $product->image ?: 'Đang dùng ảnh mặc định' }}</div>
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-warning">Cập nhật sản phẩm</button>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">Hủy</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection