@extends('layouts.app')

@section('title', 'Trang quản trị Admin')

@section('content')
<div class="container py-5">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h2 class="fw-bold mb-1">Trang quản trị Admin</h2>
            <p class="text-muted mb-0">Quản lý sản phẩm và theo dõi tình hình cửa hàng.</p>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('admin.products.index') }}" class="btn btn-dark">
                <i class="bi bi-box-seam me-1"></i> Quản lý sản phẩm
            </a>
            <a href="{{ route('admin.products.create') }}" class="btn btn-warning">
                <i class="bi bi-plus-circle me-1"></i> Thêm sản phẩm
            </a>
        </div>
    </div>

    <div class="alert alert-success">
        Xin chào <strong>{{ auth()->user()->name }}</strong>, bạn đang đăng nhập với quyền Admin.
    </div>

    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="card shadow border-0 rounded-4 text-center p-3 h-100">
                <h5>Tổng sản phẩm</h5>
                <h2 class="fw-bold text-primary">{{ $totalProducts }}</h2>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card shadow border-0 rounded-4 text-center p-3 h-100">
                <h5>Tổng hãng</h5>
                <h2 class="fw-bold text-dark">{{ $totalBrands }}</h2>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card shadow border-0 rounded-4 text-center p-3 h-100">
                <h5>Tổng đơn hàng</h5>
                <h2 class="fw-bold text-success">{{ $totalOrders }}</h2>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card shadow border-0 rounded-4 text-center p-3 h-100">
                <h5>Tổng người dùng</h5>
                <h2 class="fw-bold text-danger">{{ $totalUsers }}</h2>
            </div>
        </div>
    </div>
</div>
@endsection