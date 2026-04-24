@extends('layouts.app')

@section('title', 'Sửa sản phẩm')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Sửa sản phẩm</h2>
            <p class="text-muted mb-0">Có thể thay ảnh chính và thay toàn bộ ảnh phụ nếu muốn.</p>
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
                                        <option value="{{ $brand->id }}" {{ old('brand_id', $product->brand_id) == $brand->id ? 'selected' : '' }}>
                                            {{ $brand->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('brand_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Giá bán</label>
                                <input type="number" min="0" step="1000" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $product->price) }}">
                                @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Giá cũ</label>
                                <input type="number" min="0" step="1000" name="old_price" class="form-control @error('old_price') is-invalid @enderror" value="{{ old('old_price', $product->old_price) }}">
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
                                <label class="form-label">GPU / Camera</label>
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

                            <div class="col-md-6">
                                <label class="form-label">Thay ảnh chính</label>
                                <input type="file" name="image" accept="image/*" class="form-control @error('image') is-invalid @enderror">
                                @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                <div class="form-text">Nếu không chọn file mới thì giữ nguyên ảnh chính hiện tại.</div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Thay ảnh phụ (tối đa 3 ảnh)</label>
                                <input type="file" name="images[]" accept="image/*" multiple class="form-control @error('images') is-invalid @enderror @error('images.*') is-invalid @enderror">
                                @error('images') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                @error('images.*') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                <div class="form-text">Nếu chọn ảnh mới thì ảnh phụ cũ sẽ được thay toàn bộ.</div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-check mt-2">
                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        value="1"
                                        id="remove_gallery"
                                        name="remove_gallery"
                                        {{ old('remove_gallery') ? 'checked' : '' }}
                                    >
                                    <label class="form-check-label" for="remove_gallery">
                                        Xóa toàn bộ ảnh phụ hiện tại
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-6 d-flex align-items-end">
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
                        <div class="border rounded-4 p-3 bg-light h-100">
                            <h5 class="fw-bold mb-3">Ảnh hiện tại</h5>

                            <div class="mb-3">
                                <div class="small text-muted mb-2">Ảnh chính</div>
                                <img
                                    src="{{ $product->image_url }}"
                                    alt="{{ $product->name }}"
                                    class="img-fluid rounded-3 border"
                                    style="width: 100%; height: 220px; object-fit: contain; background: #fff;"
                                >
                            </div>

                            <div>
                                <div class="small text-muted mb-2">Ảnh phụ</div>

                                @if($product->images->count())
                                    <div class="row g-2">
                                        @foreach($product->images as $galleryImage)
                                            <div class="col-6">
                                                <img
                                                    src="{{ $galleryImage->image_url }}"
                                                    alt="Ảnh phụ {{ $loop->iteration }}"
                                                    class="img-fluid rounded-3 border"
                                                    style="width: 100%; height: 120px; object-fit: cover; background: #fff;"
                                                >
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="text-muted">Chưa có ảnh phụ.</div>
                                @endif
                            </div>
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