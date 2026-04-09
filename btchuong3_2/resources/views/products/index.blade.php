@extends('layouts.master')

@section('content')
    <div class="card p-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="mb-0">Danh sách sản phẩm</h3>
            <a href="{{ route('products.create') }}" class="btn btn-primary">+ Thêm sản phẩm</a>
        </div>

        <form method="GET" action="{{ route('products.index') }}" class="row g-3 mb-4">
            <div class="col-md-5">
                <input
                    type="text"
                    name="keyword"
                    class="form-control"
                    placeholder="Nhập tên sản phẩm..."
                    value="{{ request('keyword') }}"
                >
            </div>

            <div class="col-md-4">
                <select name="sort" class="form-select">
                    <option value="">-- Sắp xếp theo giá --</option>
                    <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>
                        Giá tăng dần
                    </option>
                    <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>
                        Giá giảm dần
                    </option>
                </select>
            </div>

            <div class="col-md-3 d-flex gap-2">
                <button class="btn btn-success w-100">Lọc</button>
                <a href="{{ route('products.index') }}" class="btn btn-secondary w-100">Reset</a>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Ảnh</th>
                        <th>Tên</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Danh mục</th>
                        <th width="180">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>
                                @if($product->image)
                                    <img
                                        src="{{ route('product.image', ['path' => $product->image]) }}"
                                        width="80"
                                        height="80"
                                        alt="Ảnh sản phẩm"
                                        style="object-fit: cover; border-radius: 8px;"
                                    >
                                @else
                                    <span class="text-muted">Không có ảnh</span>
                                @endif
                            </td>
                            <td>{{ $product->name }}</td>
                            <td>{{ number_format($product->price, 0, ',', '.') }} đ</td>
                            <td>{{ $product->quantity }}</td>
                            <td>{{ $product->category->name }}</td>
                            <td>
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">
                                    Sửa
                                </a>

                                <form
                                    action="{{ route('products.destroy', $product->id) }}"
                                    method="POST"
                                    class="d-inline"
                                    onsubmit="return confirm('Bạn có chắc muốn xóa sản phẩm này?')"
                                >
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Không có sản phẩm nào.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $products->links() }}
        </div>
    </div>
@endsection