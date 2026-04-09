@extends('layouts.master')

@section('content')
    <div class="row g-4 mb-4">
        <div class="col-md-6">
            <div class="card p-4">
                <h5 class="text-muted">Tổng số sản phẩm</h5>
                <h2 class="fw-bold text-primary">{{ $totalProducts }}</h2>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card p-4">
                <h5 class="text-muted">Tổng số danh mục</h5>
                <h2 class="fw-bold text-success">{{ $totalCategories }}</h2>
            </div>
        </div>
    </div>

    <div class="card p-4">
        <h4 class="mb-3">5 sản phẩm mới nhất</h4>

        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Giá</th>
                        <th>Danh mục</th>
                        <th>Số lượng</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($latestProducts as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>
                                @if($product->image)
                                    <img
                                        src="{{ route('product.image', ['path' => $product->image]) }}"
                                        width="70"
                                        height="70"
                                        alt="Ảnh"
                                        style="object-fit: cover; border-radius: 8px;"
                                    >
                                @else
                                    <span class="text-muted">Không có ảnh</span>
                                @endif
                            </td>
                            <td>{{ $product->name }}</td>
                            <td>{{ number_format($product->price, 0, ',', '.') }} đ</td>
                            <td>{{ $product->category->name }}</td>
                            <td>{{ $product->quantity }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Chưa có sản phẩm nào.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection