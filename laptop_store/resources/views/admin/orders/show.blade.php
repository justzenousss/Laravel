@extends('layouts.app')

@section('title', 'Chi tiết đơn hàng')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <div>
            <h2 class="fw-bold mb-1">Chi tiết đơn hàng #{{ $order->id }}</h2>
            <p class="text-muted mb-0">Kiểm tra thông tin khách hàng, sản phẩm và cập nhật trạng thái.</p>
        </div>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-dark">Quay lại</a>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <h4 class="fw-bold mb-3">Danh sách sản phẩm</h4>
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th>Đơn giá</th>
                                    <th>Số lượng</th>
                                    <th>Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->items as $item)
                                    <tr>
                                        <td>{{ $item->product->name ?? 'Sản phẩm đã xóa' }}</td>
                                        <td>{{ number_format($item->price, 0, ',', '.') }}đ</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td class="fw-semibold">{{ number_format($item->price * $item->quantity, 0, ',', '.') }}đ</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-4">
                    <h4 class="fw-bold mb-3">Thông tin khách hàng</h4>
                    <p class="mb-2"><strong>Họ tên:</strong> {{ $order->customer_name }}</p>
                    <p class="mb-2"><strong>Email:</strong> {{ $order->email }}</p>
                    <p class="mb-2"><strong>Số điện thoại:</strong> {{ $order->phone }}</p>
                    <p class="mb-2"><strong>Địa chỉ:</strong> {{ $order->address }}</p>
                    <p class="mb-0"><strong>Ghi chú:</strong> {{ $order->note ?: 'Không có' }}</p>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <h4 class="fw-bold mb-3">Cập nhật trạng thái</h4>
                    <p class="mb-2"><strong>Tổng tiền:</strong> <span class="text-danger">{{ number_format($order->total_price, 0, ',', '.') }}đ</span></p>
                    <p class="mb-3"><strong>Người đặt:</strong> {{ $order->user?->name ?? 'Khách vãng lai' }}</p>

                    <form action="{{ route('admin.orders.update', $order) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <label class="form-label">Trạng thái đơn hàng</label>
                        <select name="status" class="form-select mb-3">
                            @foreach($statuses as $status)
                                <option value="{{ $status }}" {{ $order->status === $status ? 'selected' : '' }}>{{ $status }}</option>
                            @endforeach
                        </select>

                        <button type="submit" class="btn btn-warning w-100">Lưu trạng thái</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
