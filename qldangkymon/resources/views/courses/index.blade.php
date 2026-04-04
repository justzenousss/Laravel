@extends('layouts.app')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Danh sách môn học</h4>
        <a href="{{ route('courses.create') }}" class="btn btn-success">+ Thêm môn học</a>
    </div>

    <div class="card-body">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-success text-center">
                <tr>
                    <th width="70">STT</th>
                    <th>Tên môn học</th>
                    <th width="150">Số tín chỉ</th>
                    <th width="180">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse($courses as $index => $course)
                    <tr>
                        <td class="text-center">
                            {{ ($courses->currentPage() - 1) * $courses->perPage() + $index + 1 }}
                        </td>
                        <td>{{ $course->name }}</td>
                        <td class="text-center">{{ $course->credits }}</td>
                        <td class="text-center">
                            <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-warning btn-sm">
                                Sửa
                            </a>

                            <form action="{{ route('courses.destroy', $course->id) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Bạn có chắc muốn xóa môn học này?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">Chưa có môn học.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            {{ $courses->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection