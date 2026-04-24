@extends('layouts.app')

@section('title', 'Trang chủ')

@section('content')
<div class="home-page pb-5">

    {{-- Popup khuyến mãi --}}
    <div class="modal fade" id="promoModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content promo-modal-content border-0">
                <div class="modal-body p-0">
                    <div class="promo-modal-box">
                        <button type="button" class="btn-close btn-close-white promo-modal-close" data-bs-dismiss="modal" aria-label="Close"></button>

                        <div class="promo-modal-inner">
                            <span class="promo-pill">
                                <i class="bi bi-fire"></i> Ưu đãi tuần này
                            </span>

                            <h2 class="promo-modal-title mt-3">
                                Giảm đến <span>20%</span>
                            </h2>

                            <p class="promo-modal-text">
                                Nhiều mẫu điện thoại nổi bật đang có ưu đãi hấp dẫn với mức giá tốt hơn trong thời gian ngắn.
                            </p>

                            <div class="promo-code-box">
                                <small>Mã ưu đãi</small>
                                <strong>PHONE20</strong>
                            </div>

                            <div class="d-flex gap-2 flex-wrap justify-content-center mt-4">
                                <a href="{{ route('products.index') }}" class="btn btn-warning btn-lg px-4">
                                    Xem sản phẩm
                                </a>
                                <button type="button" class="btn btn-outline-light btn-lg px-4" data-bs-dismiss="modal">
                                    Đóng
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Ticker --}}
    <section class="promo-ticker-wrap">
        <div class="promo-ticker">
            <div class="promo-ticker-track">
                <span><i class="bi bi-lightning-charge-fill"></i> Flash Sale điện thoại chính hãng</span>
                <span><i class="bi bi-gift-fill"></i> Mã giảm giá PHONE20 cho nhiều sản phẩm nổi bật</span>
                <span><i class="bi bi-phone"></i> Flagship, gaming phone, camera phone đang được quan tâm</span>
                <span><i class="bi bi-shield-check"></i> Hàng chính hãng, thông tin rõ ràng</span>

                <span><i class="bi bi-lightning-charge-fill"></i> Flash Sale điện thoại chính hãng</span>
                <span><i class="bi bi-gift-fill"></i> Mã giảm giá PHONE20 cho nhiều sản phẩm nổi bật</span>
                <span><i class="bi bi-phone"></i> Flagship, gaming phone, camera phone đang được quan tâm</span>
                <span><i class="bi bi-shield-check"></i> Hàng chính hãng, thông tin rõ ràng</span>
            </div>
        </div>
    </section>

    @php
    $heroImage1 = asset('images/banners/banner1.png');
    $heroImage2 = asset('images/banners/banner2.jpg');
    $heroImage3 = asset('images/banners/banner3.png');
    @endphp

    {{-- Slider --}}
    <section class="hero-slider-section">
        <div id="homeHeroCarousel" class="carousel slide hero-carousel" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#homeHeroCarousel" data-bs-slide-to="0" class="active" aria-current="true"></button>
                <button type="button" data-bs-target="#homeHeroCarousel" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#homeHeroCarousel" data-bs-slide-to="2"></button>
            </div>

            <div class="carousel-inner">
                {{-- Slide 1 --}}
                <div class="carousel-item active">
                    <div class="hero-slide-card">
                        <div class="container hero-slide-inner">
                            <div class="row align-items-center g-4">
                                <div class="col-lg-7">
                                    <span class="hero-kicker">
                                        <i class="bi bi-phone-fill"></i> Flagship cao cấp
                                    </span>

                                    <h1 class="hero-title mt-3">
                                        Thiết kế sang, hiệu năng mạnh, chạm là thấy khác biệt
                                    </h1>

                                    <p class="hero-desc mt-3">
                                        Màn hình sắc nét, thao tác mượt, camera nổi bật và pin đủ bền cho cả ngày làm việc lẫn giải trí.
                                    </p>

                                    <div class="hero-actions mt-4">
                                        <a href="{{ route('products.index') }}" class="btn btn-warning btn-lg px-4">
                                            Xem sản phẩm
                                        </a>
                                        <a href="#featured-products" class="btn btn-outline-light btn-lg px-4">
                                            Sản phẩm nổi bật
                                        </a>
                                    </div>

                                    <div class="row g-3 mt-4">
                                        <div class="col-sm-6 col-xl-3">
                                            <div class="metric-card">
                                                <div class="metric-value">{{ $stats['total_products'] }}+</div>
                                                <div class="metric-label">Sản phẩm</div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-xl-3">
                                            <div class="metric-card">
                                                <div class="metric-value">{{ $stats['brand_count'] }}+</div>
                                                <div class="metric-label">Thương hiệu</div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-xl-3">
                                            <div class="metric-card">
                                                <div class="metric-value">{{ $stats['featured_products'] }}+</div>
                                                <div class="metric-label">Nổi bật</div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-xl-3">
                                            <div class="metric-card">
                                                <div class="metric-value">{{ $stats['available_products'] }}+</div>
                                                <div class="metric-label">Còn hàng</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-5">
                                    <div class="hero-image-wrap">
                                        <span class="hero-floating-pill hero-pill-top">
                                            <i class="bi bi-star-fill"></i> Màn hình đẹp
                                        </span>

                                        <div class="hero-image-card">
                                            <img src="{{ $heroImage1 }}" alt="Flagship phone" class="hero-phone-image">
                                        </div>

                                        <span class="hero-floating-pill hero-pill-left">
                                            <i class="bi bi-lightning-charge-fill"></i> Pin bền
                                        </span>

                                        <div class="hero-info-card">
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="mini-circle">
                                                    <i class="bi bi-stars"></i>
                                                </div>
                                                <div>
                                                    <strong>Màn hình đẹp</strong>
                                                    <div class="text-white-50 small">Hiển thị sáng, màu sâu</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Slide 2 --}}
                <div class="carousel-item">
                    <div class="hero-slide-card">
                        <div class="container hero-slide-inner">
                            <div class="row align-items-center g-4">
                                <div class="col-lg-7">
                                    <span class="hero-kicker">
                                        <i class="bi bi-lightning-charge-fill"></i> Gaming phone
                                    </span>

                                    <h1 class="hero-title mt-3">
                                        Hiệu năng bứt tốc cho game, học tập và đa nhiệm
                                    </h1>

                                    <p class="hero-desc mt-3">
                                        Chip mạnh, tản nhiệt ổn, tần số quét cao và bộ nhớ lớn giúp mọi thao tác nhanh, gọn, ổn định.
                                    </p>

                                    <div class="hero-actions mt-4">
                                        <a href="{{ route('products.index') }}" class="btn btn-warning btn-lg px-4">
                                            Khám phá ngay
                                        </a>
                                        <a href="#featured-products" class="btn btn-outline-light btn-lg px-4">
                                            Sản phẩm nổi bật
                                        </a>
                                    </div>

                                    <div class="row g-3 mt-4">
                                        <div class="col-sm-6 col-xl-3">
                                            <div class="metric-card">
                                                <div class="metric-value">{{ $stats['total_products'] }}+</div>
                                                <div class="metric-label">Sản phẩm</div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-xl-3">
                                            <div class="metric-card">
                                                <div class="metric-value">{{ $stats['brand_count'] }}+</div>
                                                <div class="metric-label">Thương hiệu</div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-xl-3">
                                            <div class="metric-card">
                                                <div class="metric-value">{{ $stats['featured_products'] }}+</div>
                                                <div class="metric-label">Nổi bật</div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-xl-3">
                                            <div class="metric-card">
                                                <div class="metric-value">{{ $stats['available_products'] }}+</div>
                                                <div class="metric-label">Còn hàng</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-5">
                                    <div class="hero-image-wrap">
                                        <span class="hero-floating-pill hero-pill-top">
                                            <i class="bi bi-star-fill"></i> 120Hz mượt
                                        </span>

                                        <div class="hero-image-card">
                                            <img src="{{ $heroImage2 }}" alt="Gaming phone" class="hero-phone-image">
                                        </div>

                                        <span class="hero-floating-pill hero-pill-left">
                                            <i class="bi bi-lightning-charge-fill"></i> Tản nhiệt tốt
                                        </span>

                                        <div class="hero-info-card">
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="mini-circle">
                                                    <i class="bi bi-stars"></i>
                                                </div>
                                                <div>
                                                    <strong>Hiệu năng tốt</strong>
                                                    <div class="text-white-50 small">Mượt trong nhiều tác vụ</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Slide 3 --}}
                <div class="carousel-item">
                    <div class="hero-slide-card">
                        <div class="container hero-slide-inner">
                            <div class="row align-items-center g-4">
                                <div class="col-lg-7">
                                    <span class="hero-kicker">
                                        <i class="bi bi-camera-fill"></i> Camera phone
                                    </span>

                                    <h1 class="hero-title mt-3">
                                        Chụp đẹp mỗi ngày, lưu lại khoảnh khắc theo cách sắc nét hơn
                                    </h1>

                                    <p class="hero-desc mt-3">
                                        Camera chi tiết, màu sắc nổi bật, hỗ trợ quay chụp tốt cho học tập, công việc và cuộc sống hằng ngày.
                                    </p>

                                    <div class="hero-actions mt-4">
                                        <a href="{{ route('products.index') }}" class="btn btn-warning btn-lg px-4">
                                            Xem chi tiết
                                        </a>
                                        <a href="#featured-products" class="btn btn-outline-light btn-lg px-4">
                                            Sản phẩm nổi bật
                                        </a>
                                    </div>

                                    <div class="row g-3 mt-4">
                                        <div class="col-sm-6 col-xl-3">
                                            <div class="metric-card">
                                                <div class="metric-value">{{ $stats['total_products'] }}+</div>
                                                <div class="metric-label">Sản phẩm</div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-xl-3">
                                            <div class="metric-card">
                                                <div class="metric-value">{{ $stats['brand_count'] }}+</div>
                                                <div class="metric-label">Thương hiệu</div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-xl-3">
                                            <div class="metric-card">
                                                <div class="metric-value">{{ $stats['featured_products'] }}+</div>
                                                <div class="metric-label">Nổi bật</div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-xl-3">
                                            <div class="metric-card">
                                                <div class="metric-value">{{ $stats['available_products'] }}+</div>
                                                <div class="metric-label">Còn hàng</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-5">
                                    <div class="hero-image-wrap">
                                        <span class="hero-floating-pill hero-pill-top">
                                            <i class="bi bi-star-fill"></i> Ảnh sắc nét
                                        </span>

                                        <div class="hero-image-card">
                                            <img src="{{ $heroImage3 }}" alt="Camera phone" class="hero-phone-image">
                                        </div>

                                        <span class="hero-floating-pill hero-pill-left">
                                            <i class="bi bi-lightning-charge-fill"></i> Quay video ổn
                                        </span>

                                        <div class="hero-info-card">
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="mini-circle">
                                                    <i class="bi bi-stars"></i>
                                                </div>
                                                <div>
                                                    <strong>Chụp ảnh đẹp</strong>
                                                    <div class="text-white-50 small">Chi tiết rõ, màu tốt</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#homeHeroCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
                <span class="visually-hidden">Trước</span>
            </button>

            <button class="carousel-control-next" type="button" data-bs-target="#homeHeroCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
                <span class="visually-hidden">Sau</span>
            </button>
        </div>
    </section>

    <section class="container quick-strip-section">
        <div class="quick-strip row g-3">
            <div class="col-md-4">
                <div class="quick-card h-100">
                    <div class="quick-icon"><i class="bi bi-phone"></i></div>
                    <div>
                        <h5>Nhiều dòng máy</h5>
                        <p class="mb-0">Từ điện thoại phổ thông đến flagship, dễ chọn theo nhu cầu và ngân sách.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="quick-card h-100">
                    <div class="quick-icon"><i class="bi bi-camera"></i></div>
                    <div>
                        <h5>Camera đẹp</h5>
                        <p class="mb-0">Nhiều mẫu máy tập trung mạnh vào trải nghiệm chụp ảnh và quay video hằng ngày.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="quick-card h-100">
                    <div class="quick-icon"><i class="bi bi-lightning-charge"></i></div>
                    <div>
                        <h5>Hiệu năng ổn</h5>
                        <p class="mb-0">Phù hợp học tập, làm việc, lướt web, giải trí và chơi game ở nhiều mức khác nhau.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="container py-4">
        <div class="section-heading d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div>
                <span class="section-tag">Thương hiệu</span>
                <h2 class="section-title mb-0">Thương hiệu nổi bật</h2>
            </div>
            <a href="{{ route('products.index') }}" class="section-link">Xem tất cả <i class="bi bi-arrow-right"></i></a>
        </div>

        <div class="brand-grid mt-4">
            @foreach($brands->take(8) as $brand)
                <a href="{{ route('products.index', ['brand_id' => $brand->id]) }}" class="brand-chip">
                    <div>
                        <strong>{{ $brand->name }}</strong>
                        <span>{{ $brand->products_count }} sản phẩm</span>
                    </div>
                    <i class="bi bi-chevron-right"></i>
                </a>
            @endforeach
        </div>
    </section>

    <section class="container py-4" id="featured-products">
        <div class="section-heading d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div>
                <span class="section-tag">Nổi bật</span>
                <h2 class="section-title mb-0">Sản phẩm đáng chú ý</h2>
            </div>
            <a href="{{ route('products.index') }}" class="section-link">Mua ngay <i class="bi bi-arrow-right"></i></a>
        </div>

        <div class="row mt-4 g-4">
            @foreach($featuredProducts as $product)
                <div class="col-sm-6 col-lg-3">
                    <div class="card product-card product-card-featured h-100">
                        <div class="product-media-wrap">
                            <span class="product-badge">Nổi bật</span>

                            @php
                                $discountPercent = 0;
                                if (!empty($product->old_price) && $product->old_price > $product->price) {
                                    $discountPercent = round((($product->old_price - $product->price) / $product->old_price) * 100);
                                }
                            @endphp

                            @if($discountPercent > 0)
                                <span class="discount-badge">-{{ $discountPercent }}%</span>
                            @endif

                            <img src="{{ $product->image_url }}" class="card-img-top" alt="{{ $product->name }}">
                        </div>

                        <div class="card-body d-flex flex-column">
                            <div class="product-meta mb-2">{{ $product->brand->name ?? 'Phone Store' }}</div>
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="text-muted small mb-2">{{ $product->cpu }} • {{ $product->ram }} • {{ $product->storage }}</p>
                            <p class="text-muted small mb-2">Màn hình {{ $product->screen }}</p>

                            <div class="rating-row mb-3">
                                <span class="rating-stars">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-half"></i>
                                </span>
                                <span class="rating-text">4.5 (120 đánh giá)</span>
                            </div>

                            <div class="mb-3">
                                <span class="price">{{ number_format($product->price, 0, ',', '.') }}đ</span>
                                @if($product->old_price)
                                    <span class="old-price">{{ number_format($product->old_price, 0, ',', '.') }}đ</span>
                                @endif
                            </div>

                            <div class="d-grid gap-2 mt-auto">
                                <a href="{{ route('products.show', $product->slug) }}" class="btn btn-dark">Xem chi tiết</a>

                                @if($product->quantity > 0)
                                    <form action="{{ route('cart.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="btn btn-warning w-100">
                                            <i class="bi bi-cart-plus me-1"></i> Thêm vào giỏ
                                        </button>
                                    </form>
                                @else
                                    <button class="btn btn-secondary w-100" disabled>Hết hàng</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <section class="container py-4">
        <div class="promo-banner">
            <div class="row align-items-center g-4">
                <div class="col-lg-8">
                    <span class="section-tag section-tag-light">Ưu đãi</span>
                    <h2 class="mb-2">Nhiều lựa chọn điện thoại cho từng nhu cầu sử dụng</h2>
                    <p class="mb-0 text-white-50">
                        Từ máy pin tốt, máy chụp đẹp đến máy hiệu năng cao, bạn có thể chọn nhanh hơn ngay tại đây.
                    </p>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a href="{{ route('products.index') }}" class="btn btn-warning btn-lg px-4">Khám phá ngay</a>
                </div>
            </div>
        </div>
    </section>

    <section class="container py-4">
        <div class="section-heading d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div>
                <span class="section-tag">Mới cập nhật</span>
                <h2 class="section-title mb-0">Điện thoại mới nhất</h2>
            </div>
            <a href="{{ route('products.index') }}" class="section-link">Xem thêm <i class="bi bi-arrow-right"></i></a>
        </div>

        <div class="row mt-4 g-4">
            @foreach($latestProducts as $product)
                <div class="col-sm-6 col-lg-3">
                    <div class="card product-card h-100">
                        <div class="product-media-wrap product-media-light">
                            <span class="product-badge product-badge-dark">Mới</span>
                            <img src="{{ $product->image_url }}" class="card-img-top" alt="{{ $product->name }}">
                        </div>

                        <div class="card-body d-flex flex-column">
                            <div class="product-meta mb-2">{{ $product->brand->name ?? 'Phone Store' }}</div>
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="text-muted small mb-2">{{ $product->storage }} • {{ $product->screen }}</p>
                            <p class="text-muted small mb-2">{{ $product->os }}</p>

                            <div class="rating-row mb-3">
                                <span class="rating-stars">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-half"></i>
                                </span>
                                <span class="rating-text">4.5 (98 đánh giá)</span>
                            </div>

                            <div class="mb-3">
                                <span class="price">{{ number_format($product->price, 0, ',', '.') }}đ</span>
                            </div>

                            <div class="d-grid gap-2 mt-auto">
                                <a href="{{ route('products.show', $product->slug) }}" class="btn btn-outline-dark">Xem chi tiết</a>

                                @if($product->quantity > 0)
                                    <form action="{{ route('cart.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="btn btn-warning w-100">
                                            <i class="bi bi-cart-plus me-1"></i> Thêm vào giỏ
                                        </button>
                                    </form>
                                @else
                                    <button class="btn btn-secondary w-100" disabled>Hết hàng</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modalElement = document.getElementById('promoModal');
        if (!modalElement) return;

        localStorage.removeItem('homePromoShown');

        if (!localStorage.getItem('homePromoShown')) {
            const promoModal = new bootstrap.Modal(modalElement, {
                backdrop: true,
                keyboard: true
            });

            setTimeout(() => {
                promoModal.show();
            }, 1000);

            modalElement.addEventListener('hidden.bs.modal', function () {
                localStorage.setItem('homePromoShown', 'true');
                document.body.classList.remove('modal-open');
                document.body.style.removeProperty('padding-right');
                document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());
            });
        } else {
            document.body.classList.remove('modal-open');
            document.body.style.removeProperty('padding-right');
            document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());
        }
    });
</script>
@endpush