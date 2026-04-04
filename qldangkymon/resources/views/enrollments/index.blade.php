@extends('layouts.app')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Danh sách đăng ký môn học</h4>
        <a href="{{ route('enrollments.create') }}" class="btn btn-dark">+ Đăng ký môn</a>
    </div>

    <div class="card-body">
        <table class="table table-bordered table-hover">
            <thead class="table-dark text-center">
                <tr>
                    <th width="70">STT</th>
                    <th>Sinh viên</th>
                    <th>Môn học</th>
                    <th width="120">Tín chỉ</th>
                    <th width="150">Tổng tín chỉ</th>
                </tr>
            </thead>
            <tbody>
                @forelse($enrollments as $index => $enrollment)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>{{ $enrollment->student->name }}</td>
                        <td>{{ $enrollment->course->name }}</td>
                        <td class="text-center">{{ $enrollment->course->credits }}</td>
                        <td class="text-center">{{ $totalCredits[$enrollment->student_id] }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">Chưa có dữ liệu đăng ký.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection