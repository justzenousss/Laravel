@extends('layouts.app')

@section('title', 'Đặt hàng thành công')

@section('content')
<div class="container py-5">
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-5">
            <div class="text-center mb-4">
                <i class="bi bi-check-circle-fill text-success" style="font-size: 64px;"></i>
                <h2 class="fw-bold mt-3">Đặt hàng thành công</h2>
                <p class="text-muted mb-0">Cảm ơn bạn đã mua hàng tại Phone Store.</p>
            </div>

            <div class="row g-4">
                <div class="col-md-6">
                    <h5 class="fw-bold mb-3">Thông tin đơn hàng</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between"><span>Mã đơn hàng</span><strong>#{{ $order->id }}</strong></li>
                        <li class="list-group-item d-flex justify-content-between"><span>Khách hàng</span><strong>{{ $order->customer_name }}</strong></li>
                        <li class="list-group-item d-flex justify-content-between"><span>Email</span><strong>{{ $order->email }}</strong></li>
                        <li class="list-group-item d-flex justify-content-between"><span>Điện thoại</span><strong>{{ $order->phone }}</strong></li>
                        <li class="list-group-item d-flex justify-content-between"><span>Trạng thái</span><strong>{{ $order->status }}</strong></li>
                        <li class="list-group-item d-flex justify-content-between"><span>Tổng tiền</span><strong class="text-danger">{{ number_format($order->total_price, 0, ',', '.') }}đ</strong></li>
                    </ul>
                </div>

                <div class="col-md-6">
                    <h5 class="fw-bold mb-3">Sản phẩm trong đơn</h5>
                    @foreach($order->items as $item)
                        <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                            <div>
                                <div class="fw-semibold">{{ $item->product->name ?? 'Sản phẩm đã xóa' }}</div>
                                <div class="text-muted small">Số lượng: {{ $item->quantity }}</div>
                            </div>
                            <div class="fw-semibold">{{ number_format($item->price * $item->quantity, 0, ',', '.') }}đ</div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="mt-4 d-flex gap-2 justify-content-center">
                <a href="{{ route('home') }}" class="btn btn-dark">Về trang chủ</a>
                <a href="{{ route('products.index') }}" class="btn btn-warning">Tiếp tục mua sắm</a>
            </div>
        </div>
    </div>
</div>
@endsection
