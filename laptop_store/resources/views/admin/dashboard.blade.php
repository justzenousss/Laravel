@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="fw-bold mb-4">Trang quản trị Admin</h2>

    <div class="alert alert-success">
        Xin chào <strong>{{ auth()->user()->name }}</strong>, bạn đang đăng nhập với quyền Admin.
    </div>

    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="card shadow border-0 rounded-4 text-center p-3">
                <h5>Tổng sản phẩm</h5>
                <h2 class="fw-bold text-primary">{{ $totalProducts }}</h2>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card shadow border-0 rounded-4 text-center p-3">
                <h5>Tổng hãng</h5>
                <h2 class="fw-bold text-dark">{{ $totalBrands }}</h2>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card shadow border-0 rounded-4 text-center p-3">
                <h5>Tổng đơn hàng</h5>
                <h2 class="fw-bold text-success">{{ $totalOrders }}</h2>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card shadow border-0 rounded-4 text-center p-3">
                <h5>Tổng người dùng</h5>
                <h2 class="fw-bold text-danger">{{ $totalUsers }}</h2>
            </div>
        </div>
    </div>
</div>
@endsection