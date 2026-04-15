@extends('layouts.app')

@section('title', 'Tài khoản của tôi')

@section('content')
    <div class="container py-5">
        <div class="mb-4">
            <h2 class="fw-bold mb-1">Tài khoản của tôi</h2>
            <p class="text-muted mb-0">Quản lý thông tin cá nhân, mật khẩu và bảo mật tài khoản</p>
        </div>

        <div class="row g-4">
            <div class="col-12">
                <div class="card profile-card">
                    <div class="card-body p-4">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card profile-card">
                    <div class="card-body p-4">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card profile-card border border-danger-subtle">
                    <div class="card-body p-4">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection