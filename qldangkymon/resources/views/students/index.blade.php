@extends('layouts.app')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Danh sách sinh viên</h4>
        <a href="{{ route('students.create') }}" class="btn btn-primary">+ Thêm sinh viên</a>
    </div>

    <div class="card-body">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-primary text-center">
                <tr>
                    <th width="70">STT</th>
                    <th>Tên sinh viên</th>
                    <th width="180">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse($students as $index => $student)
                    <tr>
                        <td class="text-center">
                            {{ ($students->currentPage() - 1) * $students->perPage() + $index + 1 }}
                        </td>
                        <td>{{ $student->name }}</td>
                        <td class="text-center">
                            <a href="{{ route('students.edit', $student->id) }}" class="btn btn-warning btn-sm">
                                Sửa
                            </a>

                            <form action="{{ route('students.destroy', $student->id) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Bạn có chắc muốn xóa sinh viên này?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center text-muted">Chưa có sinh viên.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            {{ $students->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection