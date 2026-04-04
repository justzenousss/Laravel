@extends('layouts.app')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
            <h4 class="mb-0">Danh sách sản phẩm</h4>
            <a href="{{ route('products.create') }}" class="btn btn-primary">+ Thêm sản phẩm</a>
        </div>
    </div>

    <div class="card-body">
        <form action="{{ route('products.index') }}" method="GET" class="row g-2 mb-3">
            <div class="col-md-8">
                <input type="text" name="keyword" class="form-control" placeholder="Nhập tên sản phẩm..."
                    value="{{ request('keyword') }}">
            </div>

            <div class="col-md-4 d-flex gap-2">
                <button type="submit" class="btn btn-success">Tìm kiếm</button>
                <a href="{{ route('products.index') }}" class="btn btn-secondary">Làm mới</a>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-primary text-center">
                    <tr>
                        <th width="70">STT</th>
                        <th>Tên sản phẩm</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Danh mục</th>
                        <th>Trạng thái</th>
                        <th width="180">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $index => $product)
                        <tr>
                            <td class="text-center">
                                {{ ($products->currentPage() - 1) * $products->perPage() + $index + 1 }}
                            </td>
                            <td>{{ $product->name }}</td>
                            <td>{{ number_format($product->price, 0, ',', '.') }} đ</td>
                            <td class="text-center">{{ $product->quantity }}</td>
                            <td>{{ $product->category }}</td>
                            <td class="text-center">
                                @if($product->quantity == 0)
                                    <span class="badge bg-danger">Hết hàng</span>
                                @elseif($product->quantity < 5)
                                    <span class="badge bg-warning text-dark">Sắp hết hàng</span>
                                @else
                                    <span class="badge bg-success">Còn hàng</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">
                                    Sửa
                                </a>

                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Bạn có chắc muốn xóa sản phẩm này?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">Không có dữ liệu sản phẩm.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center">
            {{ $products->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection