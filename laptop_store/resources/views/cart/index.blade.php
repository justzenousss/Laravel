@extends('layouts.app')

@section('title', 'Giỏ hàng')

@section('content')
<div class="container py-5">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h2 class="fw-bold mb-1">Giỏ hàng của bạn</h2>
            <p class="text-muted mb-0">Kiểm tra lại sản phẩm và số lượng trước khi đặt hàng.</p>
        </div>

        <a href="{{ route('products.index') }}" class="btn btn-outline-dark">
            <i class="bi bi-arrow-left"></i> Tiếp tục mua sắm
        </a>
    </div>

    @if($items->isEmpty())
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body text-center py-5">
                <i class="bi bi-cart-x fs-1 text-muted"></i>
                <h4 class="mt-3">Giỏ hàng đang trống</h4>
                <p class="text-muted">Hãy thêm vài mẫu laptop bạn thích vào giỏ hàng.</p>
                <a href="{{ route('products.index') }}" class="btn btn-warning">
                    Xem sản phẩm
                </a>
            </div>
        </div>
    @else
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table align-middle mb-0">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Sản phẩm</th>
                                        <th class="text-center">Đơn giá</th>
                                        <th class="text-center">Số lượng</th>
                                        <th class="text-center">Thành tiền</th>
                                        <th class="text-center">Xóa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($items as $item)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center gap-3">
                                                    <img
                                                        src="{{ $item['image_url'] }}"
                                                        alt="{{ $item['name'] }}"
                                                        class="rounded"
                                                        style="width: 90px; height: 90px; object-fit: cover;"
                                                    >

                                                    <div>
                                                        <a href="{{ route('products.show', $item['slug']) }}" class="fw-semibold text-dark text-decoration-none">
                                                            {{ $item['name'] }}
                                                        </a>
                                                        <div class="text-muted small mt-1">
                                                            Tồn kho tối đa: {{ $item['max_quantity'] }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="text-center text-danger fw-semibold">
                                                {{ number_format($item['price'], 0, ',', '.') }}đ
                                            </td>

                                            <td class="text-center" style="min-width: 180px;">
                                                <form action="{{ route('cart.update', $item['product_id']) }}" method="POST" class="d-flex justify-content-center gap-2">
                                                    @csrf
                                                    @method('PATCH')

                                                    <input
                                                        type="number"
                                                        name="quantity"
                                                        min="1"
                                                        max="{{ $item['max_quantity'] }}"
                                                        value="{{ $item['quantity'] }}"
                                                        class="form-control"
                                                        style="width: 90px;"
                                                    >

                                                    <button type="submit" class="btn btn-outline-dark btn-sm">
                                                        Cập nhật
                                                    </button>
                                                </form>
                                            </td>

                                            <td class="text-center fw-semibold">
                                                {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}đ
                                            </td>

                                            <td class="text-center">
                                                <form action="{{ route('cart.destroy', $item['product_id']) }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa sản phẩm này khỏi giỏ hàng không?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger btn-sm">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="mt-3 d-flex justify-content-end">
                    <form action="{{ route('cart.clear') }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa toàn bộ giỏ hàng không?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger">
                            <i class="bi bi-trash3"></i> Xóa toàn bộ giỏ hàng
                        </button>
                    </form>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-4">
                        <h4 class="fw-bold mb-4">Tóm tắt đơn hàng</h4>

                        <div class="d-flex justify-content-between mb-3">
                            <span>Tạm tính</span>
                            <strong>{{ number_format($subtotal, 0, ',', '.') }}đ</strong>
                        </div>

                        <div class="d-flex justify-content-between mb-3">
                            <span>Phí vận chuyển</span>
                            <span class="text-success">Miễn phí</span>
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between mb-4">
                            <span class="fw-bold">Tổng cộng</span>
                            <span class="fw-bold text-danger fs-5">{{ number_format($total, 0, ',', '.') }}đ</span>
                        </div>

                        <button class="btn btn-warning w-100 btn-lg" disabled>
                            Thanh toán (làm ở bước tiếp theo)
                        </button>

                        <p class="text-muted small mt-3 mb-0">
                            Bước tiếp theo mình sẽ nối giỏ hàng này sang phần đặt hàng thật.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection