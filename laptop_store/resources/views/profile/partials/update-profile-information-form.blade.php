<section>
    <div class="mb-4">
        <h4 class="fw-bold mb-2">Thông tin cá nhân</h4>
        <p class="text-muted mb-0">
            Cập nhật tên và địa chỉ email của tài khoản.
        </p>
    </div>

    <form id="send-verification" method="POST" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PATCH')

        <div class="mb-3">
            <label for="name" class="form-label">Họ và tên</label>
            <input
                id="name"
                name="name"
                type="text"
                class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name', $user->name) }}"
                required
                autofocus
                autocomplete="name"
            >
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input
                id="email"
                name="email"
                type="email"
                class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email', $user->email) }}"
                required
                autocomplete="username"
            >
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div class="alert alert-warning">
                <div class="mb-2">Email của bạn chưa được xác minh.</div>

                <button form="send-verification" class="btn btn-sm btn-outline-dark" type="submit">
                    Gửi lại email xác minh
                </button>

                @if (session('status') === 'verification-link-sent')
                    <div class="mt-2 text-success">
                        Một liên kết xác minh mới đã được gửi tới email của bạn.
                    </div>
                @endif
            </div>
        @endif

        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn btn-dark">
                Lưu thay đổi
            </button>

            @if (session('status') === 'profile-updated')
                <span class="text-success">Đã lưu thành công.</span>
            @endif
        </div>
    </form>
</section>