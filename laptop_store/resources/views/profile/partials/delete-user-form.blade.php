<section>
    <div class="mb-4">
        <h4 class="fw-bold text-danger mb-2">Xóa tài khoản</h4>
        <p class="text-muted mb-0">
            Sau khi xóa, toàn bộ dữ liệu liên quan đến tài khoản này có thể không khôi phục lại được.
        </p>
    </div>

    <button
        type="button"
        class="btn btn-outline-danger"
        data-bs-toggle="modal"
        data-bs-target="#deleteAccountModal"
    >
        Xóa tài khoản
    </button>

    <div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('DELETE')

                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteAccountModalLabel">Xác nhận xóa tài khoản</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                    </div>

                    <div class="modal-body">
                        <p class="text-muted">
                            Hành động này không thể hoàn tác. Vui lòng nhập mật khẩu để xác nhận xóa tài khoản.
                        </p>

                        <div class="mb-3">
                            <label for="delete_password" class="form-label">Mật khẩu</label>
                            <input
                                id="delete_password"
                                name="password"
                                type="password"
                                class="form-control @if($errors->userDeletion->get('password')) is-invalid @endif"
                                placeholder="Nhập mật khẩu của bạn"
                            >
                            @if($errors->userDeletion->get('password'))
                                <div class="invalid-feedback">
                                    {{ $errors->userDeletion->first('password') }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Hủy
                        </button>
                        <button type="submit" class="btn btn-danger">
                            Xóa vĩnh viễn
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@if ($errors->userDeletion->isNotEmpty())
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const deleteModal = new bootstrap.Modal(document.getElementById('deleteAccountModal'));
                deleteModal.show();
            });
        </script>
    @endpush
@endif