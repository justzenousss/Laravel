@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="section-title">Danh sách laptop</h2>

    <div class="card shadow-sm mb-4 border-0 rounded-4">
        <div class="card-body">
            <form action="{{ route('products.index') }}" method="GET" class="row g-3">
                <div class="col-md-5">
                    <input type="text" name="keyword" class="form-control" placeholder="Nhập tên laptop..." value="{{ request('keyword') }}">
                </div>

                <div class="col-md-4">
                    <select name="brand_id" class="form-select">
                        <option value="">-- Chọn hãng --</option>
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}" {{ request('brand_id') == $brand->id ? 'selected' : '' }}>
                                {{ $brand->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <button class="btn btn-dark w-100">Lọc sản phẩm</button>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        @forelse($products as $product)
            <div class="col-md-3 mb-4">
                <div class="card product-card shadow-sm h-100">
                    <img src="{{ asset('images/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="text-muted">{{ $product->brand->name }}</p>
                        <p class="mb-1"><strong>CPU:</strong> {{ $product->cpu }}</p>
                        <p class="mb-1"><strong>RAM:</strong> {{ $product->ram }}</p>
                        <p class="mb-3"><strong>SSD:</strong> {{ $product->storage }}</p>

                        <div class="mb-3">
                            <span class="price">{{ number_format($product->price, 0, ',', '.') }}đ</span>
                        </div>

                        <a href="{{ route('products.show', $product->slug) }}" class="btn btn-dark mt-auto">Xem chi tiết</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-warning">
                    Không tìm thấy sản phẩm nào.
                </div>
            </div>
        @endforelse
    </div>

    <div class="mt-3">
        {{ $products->withQueryString()->links() }}
    </div>
</div>
@endsection