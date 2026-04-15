@extends('layouts.app')

@section('title', 'Tài khoản')

@section('content')
    <div class="container auth-page">
        <div class="row justify-content-center w-100">
            <div class="col-12 col-sm-10 col-md-8 col-lg-5">
                <div class="card auth-card">
                    <div class="card-header text-center">
                        <h3 class="mb-1">Laptop Store</h3>
                        <p class="mb-0 opacity-75">Đăng nhập hoặc tạo tài khoản để tiếp tục</p>
                    </div>
                    <div class="card-body p-4 p-md-5">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection