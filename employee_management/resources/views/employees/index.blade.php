@extends('layouts.master')

@section('title', 'Danh sách nhân viên')

@section('content')
    <h2>Danh sách nhân viên</h2>

    @if(session('success'))
        <x-alert :message="session('success')" />
    @endif

    <a href="{{ route('employees.create') }}" class="btn btn-success">+ Thêm nhân viên</a>

    <table>
        <tr>
            <th>ID</th>
            <th>Tên</th>
            <th>Email</th>
            <th>Chức vụ</th>
            <th>Phòng ban</th>
            <th>Hành động</th>
        </tr>

        @forelse($employees as $emp)
            <tr>
                <td>{{ $emp->id }}</td>
                <td>{{ $emp->name }}</td>
                <td>{{ $emp->email }}</td>
                <td>{{ $emp->position }}</td>
                <td>{{ $emp->department->name ?? 'Chưa có' }}</td>
                <td>
                    <a href="{{ route('employees.show', $emp->id) }}" class="btn btn-primary">Xem</a>
                    <a href="{{ route('employees.edit', $emp->id) }}" class="btn btn-warning">Sửa</a>

                    <form action="{{ route('employees.destroy', $emp->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6">Không có dữ liệu</td>
            </tr>
        @endforelse
    </table>

    <div style="margin-top: 20px;">
        
    </div>
@endsection