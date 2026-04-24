<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Website bán điện thoại')</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
    :root {
        --bg-soft: #f8f9fa;
        --text-main: #111827;
        --text-soft: #6b7280;
        --dark-1: #0f172a;
        --dark-2: #1e293b;
        --border-soft: rgba(15, 23, 42, 0.08);
        --shadow-soft: 0 16px 40px rgba(15, 23, 42, 0.08);
        --shadow-hover: 0 18px 42px rgba(15, 23, 42, 0.14);
    }

    html {
        scroll-behavior: smooth;
    }

    html, body {
        height: 100%;
    }

    body {
        background: linear-gradient(180deg, #f8f9fa 0%, #eef2f7 100%);
        color: var(--text-main);
        display: flex;
        flex-direction: column;
        overflow-x: hidden;
    }

    main {
        flex: 1;
    }

    .navbar {
        background: rgba(17, 24, 39, 0.94) !important;
        backdrop-filter: blur(10px);
    }

    .navbar-brand {
        font-weight: 800;
        font-size: 24px;
        letter-spacing: 0.3px;
    }

    .navbar .nav-link {
        font-weight: 500;
    }

    .navbar .nav-link.active {
        color: #ffc107 !important;
        font-weight: 700;
    }

    .home-page {
        position: relative;
    }

    .promo-ticker-wrap {
        padding: 18px 0 10px;
    }

    .promo-ticker {
        width: calc(100vw - 60px);
        margin-left: calc(50% - 50vw + 30px);
        margin-right: calc(50% - 50vw + 30px);
        background: linear-gradient(135deg, #111827, #1f2937);
        color: #fff;
        border-radius: 999px;
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.08);
        box-shadow: var(--shadow-soft);
    }

    .promo-ticker-track {
        display: flex;
        gap: 42px;
        width: max-content;
        padding: 12px 20px;
        animation: tickerMove 24s linear infinite;
        white-space: nowrap;
        font-weight: 600;
        font-size: 14px;
    }

    .promo-ticker-track span {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        color: rgba(255, 255, 255, 0.92);
    }

    .promo-ticker-track i {
        color: #ffc107;
    }

    @keyframes tickerMove {
        from {
            transform: translateX(0);
        }
        to {
            transform: translateX(-50%);
        }
    }

    .hero-slider-section {
        padding: 10px 0 18px;
    }

    .hero-carousel {
        width: 100vw;
        margin-left: calc(50% - 50vw);
        margin-right: calc(50% - 50vw);
        border-radius: 0;
        overflow: hidden;
        box-shadow: var(--shadow-soft);
    }

    .hero-slide-card {
        background:
            radial-gradient(circle at top right, rgba(250, 204, 21, 0.16), transparent 28%),
            radial-gradient(circle at bottom left, rgba(59, 130, 246, 0.16), transparent 25%),
            linear-gradient(135deg, #081225, #0f1f45 42%, #1d2c46 100%);
        color: #fff;
        min-height: 680px;
        display: flex;
        align-items: center;
    }

    .hero-slide-inner {
        padding-top: 36px;
        padding-bottom: 36px;
    }

    .carousel-indicators {
        margin-bottom: 1rem;
    }

    .carousel-indicators [data-bs-target] {
        width: 10px;
        height: 10px;
        border-radius: 50%;
    }

    .carousel-control-prev,
    .carousel-control-next {
        width: 7%;
    }

    .hero-kicker,
    .section-tag,
    .promo-pill {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 14px;
        border-radius: 999px;
        font-size: 13px;
        font-weight: 700;
        letter-spacing: 0.2px;
    }

    .hero-kicker {
        background: rgba(255, 255, 255, 0.12);
        color: #fff;
        border: 1px solid rgba(255, 255, 255, 0.16);
    }

    .hero-title {
        font-size: clamp(2.3rem, 5vw, 4.8rem);
        line-height: 1.08;
        font-weight: 800;
        max-width: 780px;
    }

    .hero-desc {
        font-size: 1.18rem;
        color: rgba(255, 255, 255, 0.82);
        max-width: 700px;
    }

    .hero-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
    }

    .metric-card {
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 20px;
        padding: 16px 18px;
        height: 100%;
    }

    .metric-value {
        font-size: 1.65rem;
        font-weight: 800;
        line-height: 1;
        margin-bottom: 6px;
    }

    .metric-label {
        color: rgba(255, 255, 255, 0.72);
        font-size: 0.92rem;
    }

    .hero-image-wrap {
        position: relative;
        width: 100%;
        max-width: 520px;
        margin: 0 auto;
        min-height: 500px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .hero-image-card {
        position: relative;
        z-index: 2;
        width: 360px;
        height: 460px;
        border-radius: 34px;
        overflow: hidden;
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.14);
        box-shadow: 0 28px 60px rgba(0, 0, 0, 0.28);
        backdrop-filter: blur(10px);
    }

    .hero-phone-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .hero-floating-pill {
        position: absolute;
        z-index: 3;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 11px 16px;
        border-radius: 999px;
        font-size: 14px;
        font-weight: 700;
        box-shadow: 0 14px 28px rgba(0, 0, 0, 0.18);
        white-space: nowrap;
    }

    .hero-pill-top {
        top: 26px;
        right: 0;
        background: #fff;
        color: #111827;
    }

    .hero-pill-left {
        left: -10px;
        top: 58%;
        transform: translateY(-50%);
        background: #ffc107;
        color: #111827;
    }

    .hero-info-card {
        position: absolute;
        right: -6px;
        bottom: 18px;
        z-index: 3;
        width: 320px;
        max-width: calc(100% - 60px);
        background: rgba(7, 18, 45, 0.92);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 28px;
        padding: 20px 22px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.25);
    }

    .mini-circle {
        width: 54px;
        height: 54px;
        border-radius: 16px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: rgba(255, 193, 7, 0.16);
        color: #ffc107;
        font-size: 1.2rem;
        flex-shrink: 0;
    }

    .quick-strip-section {
        margin-top: 10px;
        margin-bottom: 8px;
    }

    .quick-card,
    .service-card,
    .brand-chip,
    .product-card,
    .promo-banner {
        border: 1px solid var(--border-soft);
        box-shadow: var(--shadow-soft);
    }

    .quick-card {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 24px;
        padding: 22px;
        display: flex;
        gap: 16px;
        align-items: flex-start;
    }

    .quick-icon,
    .service-card i {
        width: 50px;
        height: 50px;
        border-radius: 16px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #111827;
        color: #ffc107;
        font-size: 1.25rem;
        flex-shrink: 0;
    }

    .section-heading {
        margin-bottom: 4px;
    }

    .section-title {
        font-weight: 800;
        margin-bottom: 0;
        font-size: clamp(1.6rem, 2.2vw, 2.2rem);
    }

    .section-tag {
        background: rgba(255, 193, 7, 0.14);
        color: #d97706;
        border: 1px solid rgba(255, 193, 7, 0.2);
    }

    .section-tag-light {
        background: rgba(255, 255, 255, 0.12);
        color: #fff3bf;
        border-color: rgba(255, 255, 255, 0.16);
    }

    .section-link {
        text-decoration: none;
        color: #111827;
        font-weight: 700;
    }

    .brand-grid,
    .service-grid {
        display: grid;
        gap: 18px;
    }

    .brand-grid {
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    }

    .brand-chip {
        background: rgba(255, 255, 255, 0.94);
        border-radius: 22px;
        padding: 18px 20px;
        text-decoration: none;
        color: inherit;
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: all 0.25s ease;
    }

    .brand-chip strong,
    .brand-chip span {
        display: block;
    }

    .brand-chip span {
        color: var(--text-soft);
        font-size: 0.92rem;
        margin-top: 4px;
    }

    .brand-chip:hover,
    .product-card:hover,
    .service-card:hover {
        transform: translateY(-6px);
        box-shadow: var(--shadow-hover);
    }

    .product-card {
        border: none;
        border-radius: 26px;
        overflow: hidden;
        transition: all 0.25s ease;
        background: rgba(255, 255, 255, 0.96);
    }

    .product-card-featured {
        background: linear-gradient(180deg, #ffffff 0%, #fffdf7 100%);
    }

    .product-media-wrap {
        position: relative;
        padding: 20px;
        background: linear-gradient(180deg, #eef2f7 0%, #ffffff 100%);
        overflow: hidden;
    }

    .product-media-light {
        background: linear-gradient(180deg, #f8fafc 0%, #ffffff 100%);
    }

    .product-card img {
        height: 220px;
        width: 100%;
        object-fit: cover;
        border-radius: 18px;
        transition: transform 0.35s ease;
    }

    .product-card:hover img {
        transform: scale(1.05);
    }

    .product-badge,
    .discount-badge {
        position: absolute;
        top: 14px;
        z-index: 2;
        border-radius: 999px;
        padding: 7px 12px;
        font-size: 12px;
        font-weight: 700;
    }

    .product-badge {
        left: 14px;
        background: #ffc107;
        color: #111827;
    }

    .product-badge-dark {
        background: #111827;
        color: #fff;
    }

    .discount-badge {
        right: 14px;
        background: #dc3545;
        color: #fff;
    }

    .product-meta {
        color: var(--text-soft);
        font-size: 0.88rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.4px;
    }

    .rating-row {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }

    .rating-stars {
        color: #f59e0b;
        display: inline-flex;
        gap: 2px;
        font-size: 0.9rem;
    }

    .rating-text {
        color: var(--text-soft);
        font-size: 0.88rem;
        font-weight: 500;
    }

    .price {
        color: #dc3545;
        font-size: 1.3rem;
        font-weight: 800;
    }

    .old-price {
        color: var(--text-soft);
        text-decoration: line-through;
        margin-left: 8px;
        font-size: 0.95rem;
    }

    .promo-banner {
        background: linear-gradient(135deg, #0f172a, #1f2937);
        color: #fff;
        border-radius: 30px;
        padding: 34px;
        overflow: hidden;
    }

    .service-grid {
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    }

    .service-card {
        background: rgba(255, 255, 255, 0.96);
        border-radius: 24px;
        padding: 24px;
        transition: all 0.25s ease;
    }

    .service-card h5 {
        margin-top: 18px;
        margin-bottom: 10px;
        font-weight: 700;
    }

    .service-card p,
    .quick-card p {
        color: var(--text-soft);
    }

    .promo-modal-content {
        background: transparent;
    }

    .promo-modal-box {
        position: relative;
        border-radius: 28px;
        overflow: hidden;
        background:
            radial-gradient(circle at top right, rgba(250, 204, 21, 0.2), transparent 30%),
            linear-gradient(135deg, #0f172a, #1e293b);
        color: #fff;
        box-shadow: 0 24px 60px rgba(15, 23, 42, 0.34);
    }

    .promo-modal-inner {
        padding: 36px 30px;
        text-align: center;
    }

    .promo-modal-close {
        position: absolute;
        top: 16px;
        right: 16px;
        z-index: 3;
    }

    .promo-pill {
        background: rgba(255, 193, 7, 0.14);
        color: #ffc107;
        border: 1px solid rgba(255, 193, 7, 0.2);
    }

    .promo-modal-title {
        font-size: 2rem;
        font-weight: 800;
    }

    .promo-modal-title span {
        color: #ffc107;
    }

    .promo-modal-text {
        color: rgba(255, 255, 255, 0.78);
        max-width: 420px;
        margin: 0 auto;
    }

    .promo-code-box {
        margin: 22px auto 0;
        width: fit-content;
        min-width: 180px;
        background: rgba(255, 255, 255, 0.08);
        border: 1px dashed rgba(255, 255, 255, 0.22);
        border-radius: 18px;
        padding: 12px 18px;
    }

    .promo-code-box small,
    .promo-code-box strong {
        display: block;
    }

    .promo-code-box small {
        color: rgba(255, 255, 255, 0.7);
        margin-bottom: 4px;
    }

    .promo-code-box strong {
        font-size: 1.25rem;
        letter-spacing: 1px;
        color: #ffc107;
    }

    footer {
        background: #111827;
        color: white;
        margin-top: 60px;
        padding: 30px 0;
    }

    .cart-badge {
        font-size: 12px;
    }

    .modal-backdrop.show {
        opacity: 0.5;
    }

    @media (max-width: 991.98px) {
        .promo-ticker {
            width: calc(100vw - 30px);
            margin-left: calc(50% - 50vw + 15px);
            margin-right: calc(50% - 50vw + 15px);
        }

        .hero-slide-card {
            min-height: auto;
        }

        .hero-slide-inner {
            padding-top: 32px;
            padding-bottom: 32px;
        }

        .hero-image-wrap {
            min-height: 460px;
        }

        .hero-image-card {
            width: 320px;
            height: 410px;
        }

        .hero-info-card {
            width: 280px;
        }
    }

    @media (max-width: 767.98px) {
        .hero-title {
            font-size: 2.5rem;
        }

        .hero-image-wrap {
            min-height: auto;
            padding-top: 18px;
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .hero-image-card,
        .hero-info-card {
            position: relative;
            right: auto;
            bottom: auto;
            width: 100%;
            max-width: 100%;
        }

        .hero-floating-pill {
            position: relative;
            top: auto;
            right: auto;
            left: auto;
            transform: none;
            width: fit-content;
            max-width: 100%;
            white-space: normal;
        }

        .hero-pill-left,
        .hero-pill-top {
            align-self: flex-start;
        }
    }

    @media (max-width: 575.98px) {
        .hero-actions {
            flex-direction: column;
        }

        .hero-actions .btn {
            width: 100%;
        }

        .quick-card,
        .service-card,
        .brand-chip,
        .promo-banner,
        .promo-modal-box {
            border-radius: 20px;
        }

        .promo-ticker {
            border-radius: 18px;
        }

        .hero-slide-card {
            min-height: auto;
        }

        .hero-title {
            font-size: 2.1rem;
        }

        .hero-image-card {
            height: 360px;
        }

        .hero-floating-pill {
            font-size: 12px;
            padding: 8px 12px;
        }
    }
</style>

    @stack('styles')
</head>
<body>

@php
    $cartCount = collect(session('cart', []))->sum('quantity');
@endphp

<nav class="navbar navbar-expand-lg navbar-dark shadow-sm sticky-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <i class="bi bi-phone"></i> Phone Store
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto ms-4">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}"
                       href="{{ route('products.index') }}">
                        Sản phẩm
                    </a>
                </li>
            </ul>

            <form action="{{ route('products.index') }}" method="GET" class="d-flex me-3">
                <input
                    type="text"
                    name="keyword"
                    class="form-control me-2"
                    placeholder="Tìm điện thoại..."
                    value="{{ request('keyword') }}"
                >
                <button class="btn btn-outline-light" type="submit">Tìm</button>
            </form>

            <ul class="navbar-nav align-items-center">
                <li class="nav-item me-2">
                    <a href="{{ route('cart.index') }}" class="btn btn-outline-light position-relative">
                        <i class="bi bi-cart3"></i> Giỏ hàng
                        @if($cartCount > 0)
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning text-dark cart-badge">
                                {{ $cartCount }}
                            </span>
                        @endif
                    </a>
                </li>

                @auth
                    @if(auth()->user()->role === 'admin')
                        <li class="nav-item me-2">
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-warning">
                                Admin
                            </a>
                        </li>
                    @endif

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown">
                            {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a href="{{ route('profile.edit') }}" class="dropdown-item">Tài khoản</a>
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Đăng xuất</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item me-2">
                        <a href="{{ route('login') }}" class="btn btn-outline-light">Đăng nhập</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('register') }}" class="btn btn-warning">Đăng ký</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

@if(session('success'))
    <div class="container mt-3">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    </div>
@endif

@if(session('error'))
    <div class="container mt-3">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    </div>
@endif

<main>
    @yield('content')
</main>

<footer>
    <div class="container text-center">
        <h5>Phone Store</h5>
        <p class="mb-0">Website bán điện thoại bằng Laravel</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>