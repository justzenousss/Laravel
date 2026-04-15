<x-guest-layout>
    <div class="text-center mb-4">
        <h4 class="fw-bold mb-2">Đăng nhập</h4>
        <p class="text-muted mb-0">Nhập thông tin tài khoản của bạn</p>
    </div>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                class="form-control @error('email') is-invalid @enderror"
                required
                autofocus
                autocomplete="username"
            >
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Mật khẩu</label>
            <input
                id="password"
                type="password"
                name="password"
                class="form-control @error('password') is-invalid @enderror"
                required
                autocomplete="current-password"
            >
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember_me">
                <label class="form-check-label" for="remember_me">
                    Ghi nhớ đăng nhập
                </label>
            </div>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-decoration-none">
                    Quên mật khẩu?
                </a>
            @endif
        </div>

        <div class="d-grid mb-3">
            <button type="submit" class="btn btn-dark btn-lg">
                Đăng nhập
            </button>
        </div>

        <div class="text-center">
            <span class="text-muted">Chưa có tài khoản?</span>
            <a href="{{ route('register') }}" class="text-decoration-none fw-semibold">Đăng ký ngay</a>
        </div>
    </form>
</x-guest-layout>