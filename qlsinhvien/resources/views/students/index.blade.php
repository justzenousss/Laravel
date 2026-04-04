@extends('layouts.app')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
            <h4 class="mb-0">Danh sách sinh viên</h4>
            <a href="{{ route('students.create') }}" class="btn btn-primary">+ Thêm sinh viên</a>
        </div>
    </div>

    <div class="card-body">
        <form action="{{ route('students.index') }}" method="GET" class="row g-2 mb-3" id="filterForm">
            <div class="col-md-5">
                <input type="text" name="keyword" class="form-control" placeholder="Nhập tên sinh viên..."
                    value="{{ request('keyword') }}">
            </div>

            <div class="col-md-3">
                <select name="sort" class="form-select" onchange="document.getElementById('filterForm').submit()">
                    <option value="asc" {{ request('sort', 'asc') == 'asc' ? 'selected' : '' }}>
                        Sắp xếp tên A-Z
                    </option>
                    <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>
                        Sắp xếp tên Z-A
                    </option>
                </select>
            </div>

            <div class="col-md-4 d-flex gap-2">
                <button type="submit" class="btn btn-success">Tìm kiếm</button>
                <a href="{{ route('students.index') }}" class="btn btn-secondary">Làm mới</a>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-primary text-center">
                    <tr>
                        <th width="70">STT</th>
                        <th>Tên</th>
                        <th>Ngành</th>
                        <th>Email</th>
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
                            <td>{{ $student->major }}</td>
                            <td>{{ $student->email }}</td>
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
                            <td colspan="5" class="text-center text-muted">Không có dữ liệu sinh viên.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center">
            {{ $students->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection