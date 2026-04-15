<section>
    <div class="mb-4">
        <h4 class="fw-bold mb-2">Đổi mật khẩu</h4>
        <p class="text-muted mb-0">
            Hãy dùng mật khẩu mạnh để tăng độ an toàn cho tài khoản.
        </p>
    </div>

    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="update_password_current_password" class="form-label">Mật khẩu hiện tại</label>
            <input
                id="update_password_current_password"
                name="current_password"
                type="password"
                class="form-control @if($errors->updatePassword->get('current_password')) is-invalid @endif"
                autocomplete="current-password"
            >
            @if($errors->updatePassword->get('current_password'))
                <div class="invalid-feedback">
                    {{ $errors->updatePassword->first('current_password') }}
                </div>
            @endif
        </div>

        <div class="mb-3">
            <label for="update_password_password" class="form-label">Mật khẩu mới</label>
            <input
                id="update_password_password"
                name="password"
                type="password"
                class="form-control @if($errors->updatePassword->get('password')) is-invalid @endif"
                autocomplete="new-password"
            >
            @if($errors->updatePassword->get('password'))
                <div class="invalid-feedback">
                    {{ $errors->updatePassword->first('password') }}
                </div>
            @endif
        </div>

        <div class="mb-4">
            <label for="update_password_password_confirmation" class="form-label">Xác nhận mật khẩu mới</label>
            <input
                id="update_password_password_confirmation"
                name="password_confirmation"
                type="password"
                class="form-control @if($errors->updatePassword->get('password_confirmation')) is-invalid @endif"
                autocomplete="new-password"
            >
            @if($errors->updatePassword->get('password_confirmation'))
                <div class="invalid-feedback">
                    {{ $errors->updatePassword->first('password_confirmation') }}
                </div>
            @endif
        </div>

        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn btn-dark">
                Lưu mật khẩu
            </button>

            @if (session('status') === 'password-updated')
                <span class="text-success">Đã cập nhật mật khẩu.</span>
            @endif
        </div>
    </form>
</section>