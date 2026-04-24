@extends('layouts.app')

@section('title', 'Thanh toán')

@section('content')
<div class="container py-5">
    <div class="row g-4">
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <h2 class="fw-bold mb-3">Thông tin đặt hàng</h2>
                    <p class="text-muted">Điền đầy đủ thông tin để hoàn tất đơn hàng.</p>

                    <form action="{{ route('orders.store') }}" method="POST">
                        @csrf

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Họ và tên</label>
                                <input type="text" name="customer_name" class="form-control @error('customer_name') is-invalid @enderror" value="{{ old('customer_name', auth()->user()->name ?? '') }}">
                                @error('customer_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', auth()->user()->email ?? '') }}">
                                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Số điện thoại</label>
                                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}">
                                @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Địa chỉ nhận hàng</label>
                                <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address') }}">
                                @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label">Ghi chú</label>
                                <textarea name="note" rows="4" class="form-control @error('note') is-invalid @enderror">{{ old('note') }}</textarea>
                                @error('note') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="d-flex gap-2 mt-4">
                            <button type="submit" class="btn btn-warning">Xác nhận đặt hàng</button>
                            <a href="{{ route('cart.index') }}" class="btn btn-outline-dark">Quay lại giỏ hàng</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <h4 class="fw-bold mb-4">Sản phẩm đã chọn</h4>

                    @foreach($items as $item)
                        <div class="d-flex align-items-center gap-3 mb-3 pb-3 border-bottom">
                            <img src="{{ $item['image_url'] }}" alt="{{ $item['name'] }}" class="rounded" style="width: 72px; height: 72px; object-fit: cover;">
                            <div class="flex-grow-1">
                                <div class="fw-semibold">{{ $item['name'] }}</div>
                                <div class="text-muted small">Số lượng: {{ $item['quantity'] }}</div>
                            </div>
                            <div class="fw-semibold text-danger">{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}đ</div>
                        </div>
                    @endforeach

                    <div class="d-flex justify-content-between mb-2">
                        <span>Tạm tính</span>
                        <strong>{{ number_format($subtotal, 0, ',', '.') }}đ</strong>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Phí vận chuyển</span>
                        <span class="text-success">{{ number_format($shippingFee, 0, ',', '.') }}đ</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <span class="fw-bold">Tổng thanh toán</span>
                        <span class="fw-bold text-danger fs-5">{{ number_format($total, 0, ',', '.') }}đ</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
