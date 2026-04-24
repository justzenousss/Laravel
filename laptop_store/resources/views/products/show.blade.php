@extends('layouts.app')

@section('title', $product->name)

@push('styles')
<link rel="stylesheet" href="{{ asset('css/product-detail.css') }}">
@endpush

@section('content')
@php
    $discountPercent = ($product->old_price && $product->old_price > $product->price)
        ? round((($product->old_price - $product->price) / $product->old_price) * 100)
        : 0;

    $stockLabel = match (true) {
        $product->quantity <= 0 => 'Hết hàng',
        $product->quantity <= 5 => 'Sắp hết hàng',
        $product->quantity <= 15 => 'Còn hàng',
        default => 'Sẵn hàng',
    };

    $galleryUrls = collect([$product->image_url]);

    if ($product->relationLoaded('images') && $product->images->count()) {
        $galleryUrls = $galleryUrls->merge(
            $product->images->map(function ($image) {
                return $image->image_url;
            })
        );
    }

    $galleryUrls = $galleryUrls->filter()->unique()->values();

    $highlights = array_filter([
        $product->cpu ? ['icon' => 'bi-cpu', 'label' => 'Chip', 'value' => $product->cpu] : null,
        $product->ram ? ['icon' => 'bi-memory', 'label' => 'RAM', 'value' => $product->ram] : null,
        $product->storage ? ['icon' => 'bi-device-ssd', 'label' => 'Bộ nhớ', 'value' => $product->storage] : null,
        $product->screen ? ['icon' => 'bi-phone', 'label' => 'Màn hình', 'value' => $product->screen] : null,
    ]);
@endphp

<div class="container py-4 py-lg-5 product-detail-wrapper">
    <nav class="product-breadcrumb mb-3">
        <a href="{{ url('/') }}">Trang chủ</a>
        <span>/</span>
        <a href="{{ route('products.index') }}">Điện thoại</a>
        <span>/</span>
        <a href="{{ route('products.index', ['brand_id' => $product->brand_id]) }}">{{ $product->brand->name }}</a>
        <span>/</span>
        <strong>{{ $product->name }}</strong>
    </nav>

    <div class="row g-4 align-items-start">
        <div class="col-lg-6">
            <div class="detail-main-card h-100">
                <div class="detail-gallery-layout {{ $galleryUrls->count() <= 1 ? 'no-thumbs' : '' }}">
                    @if($galleryUrls->count() > 1)
                        <div class="detail-thumbs">
                            @foreach($galleryUrls as $url)
                                <button
                                    type="button"
                                    class="detail-thumb-btn {{ $loop->first ? 'active' : '' }}"
                                    data-image="{{ $url }}"
                                    data-name="{{ $product->name }}"
                                >
                                    <img src="{{ $url }}" alt="{{ $product->name }} - ảnh {{ $loop->iteration }}">
                                </button>
                            @endforeach
                        </div>
                    @endif

                    <div class="detail-main-preview">
                        <img
                            src="{{ $galleryUrls->first() }}"
                            alt="{{ $product->name }}"
                            id="productMainPreview"
                            class="detail-main-image"
                        >
                    </div>
                </div>

                @if(count($highlights))
                    <div class="detail-highlight-grid">
                        @foreach($highlights as $item)
                            <div class="detail-highlight-item">
                                <div class="detail-highlight-icon">
                                    <i class="bi {{ $item['icon'] }}"></i>
                                </div>
                                <div>
                                    <span>{{ $item['label'] }}</span>
                                    <strong>{{ $item['value'] }}</strong>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <div class="col-lg-6">
            <div class="detail-main-card detail-buy-card h-100">
                <div class="detail-top-tags">
                    <span class="detail-chip">{{ $product->brand->name }}</span>

                    @if($product->is_featured)
                        <span class="detail-chip dark">Nổi bật</span>
                    @endif

                    <span class="detail-chip soft">Chính hãng</span>
                </div>

                <h1 class="detail-product-title">{{ $product->name }}</h1>

                <div class="detail-rating-line">
                    <span class="detail-stock {{ $product->quantity > 0 ? 'in-stock' : 'out-stock' }}">
                        <i class="bi {{ $product->quantity > 0 ? 'bi-patch-check-fill' : 'bi-x-circle-fill' }}"></i>
                        {{ $stockLabel }}
                    </span>

                    <span class="detail-stock-note">
                        {{ $product->quantity > 0 ? 'Còn ' . $product->quantity . ' sản phẩm trong kho' : 'Sản phẩm hiện tạm hết hàng' }}
                    </span>
                </div>

                <div class="detail-price-panel">
                    <div class="detail-price-row">
                        <span class="detail-sale-price">
                            {{ number_format($product->price, 0, ',', '.') }}đ
                        </span>

                        @if($discountPercent > 0)
                            <span class="detail-discount-badge">
                                -{{ $discountPercent }}%
                            </span>
                        @endif
                    </div>

                    @if($product->old_price && $product->old_price > $product->price)
                        <div class="detail-old-price-row">
                            <span class="detail-old-price-label">Giá gốc:</span>
                            <span class="detail-old-price">
                                {{ number_format($product->old_price, 0, ',', '.') }}đ
                            </span>
                        </div>

                        <div class="detail-saving-text">
                            Tiết kiệm {{ number_format($product->old_price - $product->price, 0, ',', '.') }}đ
                        </div>
                    @endif
                </div>

                <div class="detail-info-box">
                    <div class="detail-info-item">
                        <i class="bi bi-shield-check"></i>
                        <div>
                            <strong>Bảo hành chính hãng</strong>
                            <p>Cam kết sản phẩm chính hãng, hỗ trợ nhanh trong quá trình mua hàng.</p>
                        </div>
                    </div>

                    <div class="detail-info-item">
                        <i class="bi bi-truck"></i>
                        <div>
                            <strong>Giao hàng toàn quốc</strong>
                            <p>Đóng gói cẩn thận, tối ưu cho trải nghiệm mua điện thoại online.</p>
                        </div>
                    </div>

                    <div class="detail-info-item">
                        <i class="bi bi-arrow-repeat"></i>
                        <div>
                            <strong>Hỗ trợ đổi trả</strong>
                            <p>Dễ theo dõi tình trạng sản phẩm, giá bán và cấu hình trước khi đặt hàng.</p>
                        </div>
                    </div>
                </div>

                @if($product->quantity > 0)
                    <form action="{{ route('cart.store') }}" method="POST" class="detail-cart-form">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <div class="detail-cart-row">
                            <div class="detail-qty-box">
                                <label for="quantity">Số lượng</label>
                                <input
                                    id="quantity"
                                    type="number"
                                    name="quantity"
                                    min="1"
                                    max="{{ $product->quantity }}"
                                    value="1"
                                    class="form-control detail-qty-input"
                                >
                            </div>

                            <button type="submit" class="btn detail-add-cart-btn">
                                <i class="bi bi-cart-plus me-2"></i> Thêm vào giỏ hàng
                            </button>
                        </div>
                    </form>
                @else
                    <button class="btn btn-secondary w-100 py-3 mt-3" disabled>Hết hàng</button>
                @endif
            </div>
        </div>
    </div>

    <div class="row g-4 mt-1">
        <div class="col-lg-7">
            <div class="detail-content-card">
                <div class="detail-section-head mb-3">
                    <span class="section-tag">
                        <i class="bi bi-lightning-charge"></i> Điểm nổi bật
                    </span>
                    <h3 class="mt-3 mb-0">Lý do sản phẩm này đáng chú ý</h3>
                </div>

                <div class="detail-advantage-list">
                    <div class="detail-advantage-item">
                        <i class="bi bi-check2-circle"></i>
                        <div>
                            <strong>Thiết kế hiện đại cho shop điện thoại</strong>
                            <p class="mb-0">Thông tin được sắp xếp rõ ràng để người mua nhìn vào là thấy ngay giá, cấu hình và tình trạng kho.</p>
                        </div>
                    </div>

                    <div class="detail-advantage-item">
                        <i class="bi bi-check2-circle"></i>
                        <div>
                            <strong>Cấu hình hiển thị trực quan</strong>
                            <p class="mb-0">Chip, RAM, bộ nhớ và màn hình được đẩy lên phần đầu để người dùng xem nhanh hơn.</p>
                        </div>
                    </div>

                    <div class="detail-advantage-item">
                        <i class="bi bi-check2-circle"></i>
                        <div>
                            <strong>Giá và hành động mua nổi bật</strong>
                            <p class="mb-0">Cụm giá, giảm giá, số lượng kho và nút thêm vào giỏ được gom lại thành một khối rõ ràng.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="detail-content-card mt-4">
                <div class="detail-section-head mb-3">
                    <span class="section-tag">
                        <i class="bi bi-list-columns-reverse"></i> Thông số kỹ thuật
                    </span>
                    <h3 class="mt-3 mb-0">Chi tiết cấu hình</h3>
                </div>

                <div class="table-responsive mt-3">
                    <table class="table detail-spec-table align-middle mb-0">
                        <tbody>
                            <tr>
                                <th>Thương hiệu</th>
                                <td>{{ $product->brand->name }}</td>
                            </tr>
                            <tr>
                                <th>Chip</th>
                                <td>{{ $product->cpu ?: 'Đang cập nhật' }}</td>
                            </tr>
                            <tr>
                                <th>RAM</th>
                                <td>{{ $product->ram ?: 'Đang cập nhật' }}</td>
                            </tr>
                            <tr>
                                <th>Bộ nhớ trong</th>
                                <td>{{ $product->storage ?: 'Đang cập nhật' }}</td>
                            </tr>
                            <tr>
                                <th>Màn hình</th>
                                <td>{{ $product->screen ?: 'Đang cập nhật' }}</td>
                            </tr>
                            <tr>
                                <th>GPU / Camera</th>
                                <td>{{ $product->gpu ?: 'Đang cập nhật' }}</td>
                            </tr>
                            <tr>
                                <th>Hệ điều hành</th>
                                <td>{{ $product->os ?: 'Đang cập nhật' }}</td>
                            </tr>
                            <tr>
                                <th>Khối lượng</th>
                                <td>{{ $product->weight ? $product->weight . ' kg' : 'Đang cập nhật' }}</td>
                            </tr>
                            <tr>
                                <th>Số lượng còn</th>
                                <td>{{ $product->quantity }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="detail-content-card mt-4">
                <div class="detail-section-head mb-3">
                    <span class="section-tag">
                        <i class="bi bi-file-text"></i> Mô tả sản phẩm
                    </span>
                    <h3 class="mt-3 mb-0">Thông tin thêm</h3>
                </div>

                <div class="detail-long-description mt-3">
                    {{ $product->description ?: 'Sản phẩm đang được cập nhật nội dung mô tả chi tiết.' }}
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="detail-content-card">
                <div class="detail-section-head mb-3">
                    <span class="section-tag">
                        <i class="bi bi-shield-lock"></i> Cam kết mua hàng
                    </span>
                    <h3 class="mt-3 mb-0">Yên tâm khi đặt máy tại shop</h3>
                </div>

                <div class="detail-policy-list">
                    <div class="detail-policy-item">
                        <i class="bi bi-patch-check-fill"></i>
                        <div>
                            <strong>Sản phẩm chính hãng</strong>
                            <p class="mb-0">Trang hiển thị được tối ưu để làm nổi bật giá trị và độ tin cậy của điện thoại.</p>
                        </div>
                    </div>

                    <div class="detail-policy-item">
                        <i class="bi bi-box-seam"></i>
                        <div>
                            <strong>Đóng gói cẩn thận</strong>
                            <p class="mb-0">Phù hợp cho trải nghiệm mua online, đặc biệt với sản phẩm điện thoại giá trị cao.</p>
                        </div>
                    </div>

                    <div class="detail-policy-item">
                        <i class="bi bi-headset"></i>
                        <div>
                            <strong>Hỗ trợ trước và sau mua</strong>
                            <p class="mb-0">Giao diện mới giúp người dùng thấy nhanh tình trạng kho, thông số và giá bán.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($relatedProducts->count())
        <div class="mt-5">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
                <div>
                    <span class="section-tag">
                        <i class="bi bi-grid"></i> Gợi ý cùng hãng
                    </span>
                    <h3 class="mt-3 mb-0">Điện thoại cùng thương hiệu</h3>
                </div>

                <a href="{{ route('products.index', ['brand_id' => $product->brand_id]) }}" class="section-link">
                    Xem toàn bộ <i class="bi bi-arrow-right-short"></i>
                </a>
            </div>

            <div class="row g-4">
                @foreach($relatedProducts as $item)
                    @php
                        $itemDiscountPercent = ($item->old_price && $item->old_price > $item->price)
                            ? round((($item->old_price - $item->price) / $item->old_price) * 100)
                            : 0;
                    @endphp

                    <div class="col-sm-6 col-xl-3">
                        <div class="card product-card-upgraded h-100">
                            <div class="product-media-wrap product-media-light">
                                <span class="product-badge product-badge-dark">{{ $item->brand->name }}</span>

                                @if($itemDiscountPercent > 0)
                                    <span class="discount-badge">-{{ $itemDiscountPercent }}%</span>
                                @endif

                                <a href="{{ route('products.show', $item->slug) }}" class="product-image-link">
                                    <img src="{{ $item->image_url }}" class="card-img-top" alt="{{ $item->name }}">
                                </a>
                            </div>

                            <div class="card-body d-flex flex-column p-4">
                                <h5 class="card-title product-card-title mb-2">
                                    <a href="{{ route('products.show', $item->slug) }}" class="text-decoration-none text-dark">
                                        {{ $item->name }}
                                    </a>
                                </h5>

                                <div class="product-short-specs mb-3">
                                    <span><i class="bi bi-cpu"></i> {{ $item->cpu ?: 'Đang cập nhật' }}</span>
                                    <span><i class="bi bi-memory"></i> {{ $item->ram ?: 'Đang cập nhật' }}</span>
                                </div>

                                <div class="mb-3">
                                    <span class="price">{{ number_format($item->price, 0, ',', '.') }}đ</span>
                                    @if($item->old_price)
                                        <span class="old-price">{{ number_format($item->old_price, 0, ',', '.') }}đ</span>
                                    @endif
                                </div>

                                <div class="mt-auto d-grid gap-2">
                                    <a href="{{ route('products.show', $item->slug) }}" class="btn btn-dark">Xem chi tiết</a>

                                    @if($item->quantity > 0)
                                        <form action="{{ route('cart.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $item->id }}">
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
        </div>
    @endif
</div>

@if($galleryUrls->count() > 1)
<script>
document.addEventListener('DOMContentLoaded', function () {
    const mainPreview = document.getElementById('productMainPreview');
    const thumbs = document.querySelectorAll('.detail-thumb-btn');

    if (!mainPreview || !thumbs.length) return;

    thumbs.forEach(function (thumb) {
        thumb.addEventListener('click', function () {
            const imageUrl = this.getAttribute('data-image');
            const imageName = this.getAttribute('data-name');

            mainPreview.src = imageUrl;
            mainPreview.alt = imageName;

            thumbs.forEach(function (item) {
                item.classList.remove('active');
            });

            this.classList.add('active');
        });
    });
});
</script>
@endif
@endsection