@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="card border-0 shadow rounded-4">
        <div class="row g-0">
            <div class="col-md-5">
                <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid w-100 h-100" style="object-fit: cover; border-radius: 16px 0 0 16px;">
            </div>

            <div class="col-md-7">
                <div class="card-body p-4">
                    <h2 class="mb-3">{{ $product->name }}</h2>
                    <p class="text-muted mb-2">Thương hiệu: {{ $product->brand->name }}</p>

                    <div class="mb-3">
                        <span class="price">{{ number_format($product->price, 0, ',', '.') }}đ</span>
                        @if($product->old_price)
                            <span class="old-price">{{ number_format($product->old_price, 0, ',', '.') }}đ</span>
                        @endif
                    </div>

                    <table class="table table-bordered">
                        <tr>
                            <th>CPU</th>
                            <td>{{ $product->cpu }}</td>
                        </tr>
                        <tr>
                            <th>RAM</th>
                            <td>{{ $product->ram }}</td>
                        </tr>
                        <tr>
                            <th>Ổ cứng</th>
                            <td>{{ $product->storage }}</td>
                        </tr>
                        <tr>
                            <th>Màn hình</th>
                            <td>{{ $product->screen }}</td>
                        </tr>
                        <tr>
                            <th>GPU</th>
                            <td>{{ $product->gpu }}</td>
                        </tr>
                        <tr>
                            <th>Hệ điều hành</th>
                            <td>{{ $product->os }}</td>
                        </tr>
                        <tr>
                            <th>Khối lượng</th>
                            <td>{{ $product->weight }} kg</td>
                        </tr>
                        <tr>
                            <th>Số lượng còn</th>
                            <td>{{ $product->quantity }}</td>
                        </tr>
                    </table>

                    <p class="mt-3">{{ $product->description }}</p>

                    <div class="d-flex gap-2 mt-4">
                        <a href="#" class="btn btn-warning btn-lg">
                            <i class="bi bi-cart-plus"></i> Thêm vào giỏ hàng
                        </a>
                        <a href="{{ route('products.index') }}" class="btn btn-outline-dark btn-lg">
                            Quay lại
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <h3 class="mt-5 mb-4">Sản phẩm cùng hãng</h3>
    <div class="row">
        @foreach($relatedProducts as $item)
            <div class="col-md-3 mb-4">
                <div class="card product-card shadow-sm h-100">
                    <img src="{{ asset('images/' . $item->image) }}" class="card-img-top" alt="{{ $item->name }}">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $item->name }}</h5>
                        <div class="mb-3">
                            <span class="price">{{ number_format($item->price, 0, ',', '.') }}đ</span>
                        </div>
                        <a href="{{ route('products.show', $item->slug) }}" class="btn btn-dark mt-auto">Xem chi tiết</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection