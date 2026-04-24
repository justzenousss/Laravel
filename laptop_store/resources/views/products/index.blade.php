@extends('layouts.app')

@section('title', 'Danh sách điện thoại')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/products.css') }}">
@endpush

@section('content')
@php
    $absoluteMin = $priceBounds['min'] ?? 0;
    $absoluteMax = $priceBounds['max'] ?? 50000000;

    $selectedMin = request('min_price') !== null && request('min_price') !== ''
        ? (int) request('min_price')
        : $absoluteMin;

    $selectedMax = request('max_price') !== null && request('max_price') !== ''
        ? (int) request('max_price')
        : $absoluteMax;

    if ($selectedMin < $absoluteMin) $selectedMin = $absoluteMin;
    if ($selectedMax > $absoluteMax) $selectedMax = $absoluteMax;
@endphp

<div class="container py-5 product-list-page">
    <div class="product-list-hero mb-4">
        <div class="row align-items-center g-4">
            <div class="col-lg-7">
                <span class="section-tag mb-3">
                    <i class="bi bi-phone"></i> Bộ sưu tập điện thoại chính hãng
                </span>
                <h1 class="product-list-title mb-3">Chọn điện thoại phù hợp với nhu cầu của bạn</h1>
                <p class="product-list-subtitle mb-0">
                    Giao diện mới ưu tiên trải nghiệm mua nhanh, xem cấu hình rõ ràng, giá nổi bật và cảm giác hiện đại hơn đúng kiểu web bán điện thoại.
                </p>
            </div>

            <div class="col-lg-5">
                <div class="product-list-stats">
                    <div class="product-list-stat-card">
                        <strong>{{ $products->total() }}</strong>
                        <span>Sản phẩm đang hiển thị</span>
                    </div>
                    <div class="product-list-stat-card">
                        <strong>{{ $brands->count() }}</strong>
                        <span>Thương hiệu</span>
                    </div>
                    <div class="product-list-stat-card">
                        <strong>100%</strong>
                        <span>Chính hãng</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 align-items-start">
        <div class="col-lg-3">
            <div class="price-sidebar-card">
                <div class="price-sidebar-head">
                    <h4 class="mb-0">Mức giá</h4>
                </div>

                <form action="{{ route('products.index') }}" method="GET" id="priceFilterForm">
                    <input type="hidden" name="keyword" value="{{ request('keyword') }}">
                    <input type="hidden" name="brand_id" value="{{ request('brand_id') }}">
                    <input type="hidden" name="sort" value="{{ request('sort') }}">

                    <div class="price-range-shell">
                        <div class="dual-range-wrap">
                            <div class="slider-track"></div>
                            <div class="slider-progress" id="sliderProgress"></div>

                            <input
                                type="range"
                                id="rangeMin"
                                class="price-range-slider"
                                min="{{ $absoluteMin }}"
                                max="{{ $absoluteMax }}"
                                step="100000"
                                value="{{ $selectedMin }}"
                            >

                            <input
                                type="range"
                                id="rangeMax"
                                class="price-range-slider"
                                min="{{ $absoluteMin }}"
                                max="{{ $absoluteMax }}"
                                step="100000"
                                value="{{ $selectedMax }}"
                            >
                        </div>

                        <div class="price-input-row">
                            <div class="price-box-dark">
                                <input
                                    type="text"
                                    id="minPriceDisplay"
                                    class="price-display-input"
                                    value=""
                                    readonly
                                >
                                <input
                                    type="hidden"
                                    id="minPriceInput"
                                    name="min_price"
                                    value="{{ $selectedMin }}"
                                >
                            </div>

                            <div class="price-box-dark">
                                <input
                                    type="text"
                                    id="maxPriceDisplay"
                                    class="price-display-input"
                                    value=""
                                    readonly
                                >
                                <input
                                    type="hidden"
                                    id="maxPriceInput"
                                    name="max_price"
                                    value="{{ $selectedMax }}"
                                >
                            </div>
                        </div>

                        <button type="submit" class="price-apply-btn">
                            ÁP DỤNG
                        </button>
                    </div>

                    <div class="price-preset-list">
                        <a class="price-preset-chip" href="{{ route('products.index', array_merge(request()->except(['page', 'min_price', 'max_price']), ['min_price' => 1000000, 'max_price' => 3000000])) }}">
                            1 đến 3 triệu
                        </a>

                        <a class="price-preset-chip" href="{{ route('products.index', array_merge(request()->except(['page', 'min_price', 'max_price']), ['max_price' => 1000000])) }}">
                            Dưới 1 triệu
                        </a>

                        <a class="price-preset-chip" href="{{ route('products.index', array_merge(request()->except(['page', 'min_price', 'max_price']), ['min_price' => 3000000, 'max_price' => 5000000])) }}">
                            3 đến 5 triệu
                        </a>

                        <a class="price-preset-chip" href="{{ route('products.index', array_merge(request()->except(['page', 'min_price', 'max_price']), ['min_price' => 5000000, 'max_price' => 10000000])) }}">
                            5 đến 10 triệu
                        </a>

                        <a class="price-preset-chip" href="{{ route('products.index', array_merge(request()->except(['page', 'min_price', 'max_price']), ['min_price' => 10000000, 'max_price' => 20000000])) }}">
                            10 đến 20 triệu
                        </a>

                        <a class="price-preset-chip" href="{{ route('products.index', array_merge(request()->except(['page', 'min_price', 'max_price']), ['min_price' => 20000000])) }}">
                            Trên 20 triệu
                        </a>
                    </div>

                    <a href="{{ route('products.index') }}" class="price-view-more-btn">
                        XÓA LỌC
                    </a>
                </form>
            </div>
        </div>

        <div class="col-lg-9">
            <div class="card border-0 shadow-sm rounded-4 product-filter-card mb-4">
                <div class="card-body p-4">
                    <form action="{{ route('products.index') }}" method="GET" class="row g-3 align-items-end">
                        <input type="hidden" name="min_price" value="{{ request('min_price') }}">
                        <input type="hidden" name="max_price" value="{{ request('max_price') }}">

                        <div class="col-lg-5">
                            <label class="form-label fw-semibold">Từ khóa</label>
                            <div class="search-input-wrap">
                                <i class="bi bi-search"></i>
                                <input
                                    type="text"
                                    name="keyword"
                                    class="form-control search-input-modern"
                                    placeholder="Tìm iPhone, Samsung, Xiaomi..."
                                    value="{{ request('keyword') }}"
                                >
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <label class="form-label fw-semibold">Thương hiệu</label>
                            <select name="brand_id" class="form-select filter-select-modern">
                                <option value="">Tất cả thương hiệu</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}" {{ request('brand_id') == $brand->id ? 'selected' : '' }}>
                                        {{ $brand->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-lg-4">
                            <label class="form-label fw-semibold">Sắp xếp</label>
                            <select name="sort" class="form-select filter-select-modern">
                                <option value="">Mới nhất</option>
                                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Giá tăng dần</option>
                                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Giá giảm dần</option>
                                <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Tên A-Z</option>
                                <option value="stock_desc" {{ request('sort') == 'stock_desc' ? 'selected' : '' }}>Nhiều hàng trước</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <div class="d-flex flex-wrap gap-2">
                                <button class="btn btn-dark btn-modern-filter">
                                    <i class="bi bi-search me-1"></i> Tìm sản phẩm
                                </button>

                                <a href="{{ route('products.index') }}" class="btn btn-outline-secondary btn-modern-reset">
                                    Xóa tất cả
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            @if(
                request()->filled('keyword') ||
                request()->filled('brand_id') ||
                request()->filled('min_price') ||
                request()->filled('max_price') ||
                request()->filled('sort')
            )
                <div class="active-filter-bar mb-4">
                    <div class="d-flex flex-wrap align-items-center gap-2">
                        <span class="fw-semibold text-dark">Bộ lọc đang áp dụng:</span>

                        @if(request('keyword'))
                            <span class="active-filter-chip">
                                <i class="bi bi-search"></i> {{ request('keyword') }}
                            </span>
                        @endif

                        @if(request('brand_id'))
                            @php
                                $selectedBrand = $brands->firstWhere('id', request('brand_id'));
                            @endphp
                            @if($selectedBrand)
                                <span class="active-filter-chip">
                                    <i class="bi bi-tags"></i> {{ $selectedBrand->name }}
                                </span>
                            @endif
                        @endif

                        @if(request('min_price') || request('max_price'))
                            <span class="active-filter-chip">
                                <i class="bi bi-cash-stack"></i>
                                @if(request('min_price') && request('max_price'))
                                    {{ number_format((float) request('min_price'), 0, ',', '.') }}đ - {{ number_format((float) request('max_price'), 0, ',', '.') }}đ
                                @elseif(request('min_price'))
                                    Từ {{ number_format((float) request('min_price'), 0, ',', '.') }}đ
                                @elseif(request('max_price'))
                                    Dưới {{ number_format((float) request('max_price'), 0, ',', '.') }}đ
                                @endif
                            </span>
                        @endif

                        @if(request('sort'))
                            <span class="active-filter-chip">
                                <i class="bi bi-sort-down"></i>
                                @switch(request('sort'))
                                    @case('price_asc') Giá tăng dần @break
                                    @case('price_desc') Giá giảm dần @break
                                    @case('name_asc') Tên A-Z @break
                                    @case('stock_desc') Nhiều hàng trước @break
                                    @default Mới nhất
                                @endswitch
                            </span>
                        @endif
                    </div>
                </div>
            @endif

            <div class="row g-4">
                @forelse($products as $product)
                    @php
                        $discountPercent = ($product->old_price && $product->old_price > $product->price)
                            ? round((($product->old_price - $product->price) / $product->old_price) * 100)
                            : 0;

                        $stockText = match (true) {
                            $product->quantity <= 0 => 'Hết hàng',
                            $product->quantity <= 5 => 'Sắp hết hàng',
                            $product->quantity <= 15 => 'Còn hàng',
                            default => 'Sẵn hàng',
                        };
                    @endphp

                    <div class="col-sm-6 col-xl-4">
                        <div class="card product-card-upgraded h-100">
                            <div class="product-media-wrap product-media-light">
                                @if($product->is_featured)
                                    <span class="product-badge">Nổi bật</span>
                                @else
                                    <span class="product-badge product-badge-dark">Chính hãng</span>
                                @endif

                                @if($discountPercent > 0)
                                    <span class="discount-badge">-{{ $discountPercent }}%</span>
                                @endif

                                <a href="{{ route('products.show', $product->slug) }}" class="product-image-link">
                                    <img src="{{ $product->image_url }}" class="card-img-top" alt="{{ $product->name }}">
                                </a>
                            </div>

                            <div class="card-body d-flex flex-column p-4">
                                <div class="product-meta mb-2">{{ $product->brand->name }}</div>

                                <h5 class="card-title product-card-title mb-2">
                                    <a href="{{ route('products.show', $product->slug) }}" class="text-decoration-none text-dark">
                                        {{ $product->name }}
                                    </a>
                                </h5>

                                <div class="product-short-specs mb-3">
                                    <span><i class="bi bi-cpu"></i> {{ $product->cpu ?: 'Đang cập nhật' }}</span>
                                    <span><i class="bi bi-memory"></i> {{ $product->ram ?: 'Đang cập nhật' }}</span>
                                    <span><i class="bi bi-device-ssd"></i> {{ $product->storage ?: 'Đang cập nhật' }}</span>
                                </div>

                                <div class="price-block mb-3">
                                    <div class="d-flex align-items-center flex-wrap gap-2">
                                        <span class="price">{{ number_format($product->price, 0, ',', '.') }}đ</span>

                                        @if($product->old_price)
                                            <span class="old-price">{{ number_format($product->old_price, 0, ',', '.') }}đ</span>
                                        @endif
                                    </div>

                                    @if($product->old_price && $product->old_price > $product->price)
                                        <div class="save-price-text">
                                            Tiết kiệm {{ number_format($product->old_price - $product->price, 0, ',', '.') }}đ
                                        </div>
                                    @endif
                                </div>

                                <div class="product-status-row mb-3">
                                    <span class="stock-pill {{ $product->quantity > 0 ? 'in-stock' : 'out-stock' }}">
                                        <i class="bi {{ $product->quantity > 0 ? 'bi-check-circle-fill' : 'bi-x-circle-fill' }}"></i>
                                        {{ $stockText }}
                                    </span>

                                    <span class="quantity-note">
                                        {{ $product->quantity > 0 ? 'Kho: ' . $product->quantity . ' máy' : 'Tạm hết hàng' }}
                                    </span>
                                </div>

                                <div class="product-card-actions mt-auto">
                                    <a href="{{ route('products.show', $product->slug) }}" class="btn btn-dark w-100 mb-2">
                                        <i class="bi bi-eye me-1"></i> Xem chi tiết
                                    </a>

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
                                        <button class="btn btn-secondary w-100" disabled>
                                            Hết hàng
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="empty-product-box">
                            <div class="empty-product-icon">
                                <i class="bi bi-phone"></i>
                            </div>
                            <h4>Không tìm thấy sản phẩm phù hợp</h4>
                            <p class="mb-0">
                                Hãy thử đổi từ khóa, chọn thương hiệu khác, đổi khoảng giá hoặc xóa bộ lọc để xem toàn bộ điện thoại.
                            </p>
                        </div>
                    </div>
                @endforelse
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const minRange = document.getElementById('rangeMin');
    const maxRange = document.getElementById('rangeMax');
    const minInput = document.getElementById('minPriceInput');
    const maxInput = document.getElementById('maxPriceInput');
    const minDisplay = document.getElementById('minPriceDisplay');
    const maxDisplay = document.getElementById('maxPriceDisplay');
    const progress = document.getElementById('sliderProgress');

    if (!minRange || !maxRange || !minInput || !maxInput || !minDisplay || !maxDisplay || !progress) return;

    const absoluteMin = parseInt(minRange.min);
    const absoluteMax = parseInt(maxRange.max);
    const minGap = 100000;

    function formatCurrency(value) {
        return Number(value).toLocaleString('en-US') + 'đ';
    }

    function updateProgress() {
        const minVal = parseInt(minRange.value);
        const maxVal = parseInt(maxRange.value);

        const leftPercent = ((minVal - absoluteMin) / (absoluteMax - absoluteMin)) * 100;
        const rightPercent = ((maxVal - absoluteMin) / (absoluteMax - absoluteMin)) * 100;

        progress.style.left = leftPercent + '%';
        progress.style.width = (rightPercent - leftPercent) + '%';
    }

    function updateDisplay() {
        minDisplay.value = formatCurrency(minRange.value);
        maxDisplay.value = formatCurrency(maxRange.value);
        minInput.value = minRange.value;
        maxInput.value = maxRange.value;
    }

    function syncMinRange() {
        let minVal = parseInt(minRange.value);
        let maxVal = parseInt(maxRange.value);

        if (maxVal - minVal < minGap) {
            minVal = maxVal - minGap;
            minRange.value = minVal;
        }

        updateProgress();
        updateDisplay();
    }

    function syncMaxRange() {
        let minVal = parseInt(minRange.value);
        let maxVal = parseInt(maxRange.value);

        if (maxVal - minVal < minGap) {
            maxVal = minVal + minGap;
            maxRange.value = maxVal;
        }

        updateProgress();
        updateDisplay();
    }

    minRange.addEventListener('input', syncMinRange);
    maxRange.addEventListener('input', syncMaxRange);

    updateProgress();
    updateDisplay();
});
</script>
@endsection