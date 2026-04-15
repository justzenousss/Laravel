@extends('layouts.app')

@section('title', 'Trang chủ')

@section('content')
<div class="hero">
    <div class="container text-center">
        <h1>Thế giới laptop chính hãng</h1>
        <p>Khám phá những mẫu laptop đẹp, mạnh, hiện đại dành cho học tập, làm việc và giải trí</p>
        <a href="{{ route('products.index') }}" class="btn btn-warning btn-lg mt-3">
            Xem sản phẩm ngay
        </a>
    </div>
</div>

<div class="container">
    <h2 class="section-title">Thương hiệu nổi bật</h2>
    <div class="mb-5">
        @foreach($brands as $brand)
            <a href="{{ route('products.index', ['brand_id' => $brand->id]) }}" class="brand-badge">
                {{ $brand->name }}
            </a>
        @endforeach
    </div>

    <h2 class="section-title">Sản phẩm nổi bật</h2>
    <div class="row">
        @foreach($featuredProducts as $product)
            <div class="col-md-3 mb-4">
                <div class="card product-card shadow-sm h-100">
                    <img src="{{ $product->image_url }}" class="card-img-top" alt="{{ $product->name }}">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="text-muted mb-1">{{ $product->cpu }} | {{ $product->ram }}</p>
                        <div class="mb-3">
                            <span class="price">{{ number_format($product->price, 0, ',', '.') }}đ</span>
                            @if($product->old_price)
                                <span class="old-price">{{ number_format($product->old_price, 0, ',', '.') }}đ</span>
                            @endif
                        </div>

                        <div class="d-grid gap-2 mt-auto">
                            <a href="{{ route('products.show', $product->slug) }}" class="btn btn-dark">Xem chi tiết</a>

                            @if($product->quantity > 0)
                                <form action="{{ route('cart.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="btn btn-warning w-100">
                                        <i class="bi bi-cart-plus"></i> Thêm vào giỏ
                                    </button>
                                </form>
                            @else
                                <button class="btn btn-secondary w-100" disabled>Hết hàng</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <h2 class="section-title mt-4">Laptop mới nhất</h2>
    <div class="row">
        @foreach($latestProducts as $product)
            <div class="col-md-3 mb-4">
                <div class="card product-card shadow-sm h-100">
                    <img src="{{ $product->image_url }}" class="card-img-top" alt="{{ $product->name }}">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="text-muted mb-1">{{ $product->storage }} | {{ $product->screen }}</p>
                        <div class="mb-3">
                            <span class="price">{{ number_format($product->price, 0, ',', '.') }}đ</span>
                        </div>

                        <div class="d-grid gap-2 mt-auto">
                            <a href="{{ route('products.show', $product->slug) }}" class="btn btn-outline-dark">Xem chi tiết</a>

                            @if($product->quantity > 0)
                                <form action="{{ route('cart.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="btn btn-warning w-100">
                                        <i class="bi bi-cart-plus"></i> Thêm vào giỏ
                                    </button>
                                </form>
                            @else
                                <button class="btn btn-secondary w-100" disabled>Hết hàng</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection