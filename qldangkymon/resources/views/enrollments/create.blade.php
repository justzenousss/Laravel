@extends('layouts.app')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white">
        <h4 class="mb-0">Đăng ký môn học</h4>
    </div>

    <div class="card-body">
        <form action="{{ route('enrollments.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Chọn sinh viên</label>
                <select name="student_id" class="form-select">
                    <option value="">-- Chọn sinh viên --</option>
                    @foreach($students as $student)
                        <option value="{{ $student->id }}" {{ old('student_id') == $student->id ? 'selected' : '' }}>
                            {{ $student->name }}
                        </option>
                    @endforeach
                </select>
                @error('student_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Chọn môn học</label>
                <select name="course_id" class="form-select">
                    <option value="">-- Chọn môn học --</option>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
                            {{ $course->name }} ({{ $course->credits }} tín chỉ)
                        </option>
                    @endforeach
                </select>
                @error('course_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-dark">Đăng ký</button>
            <a href="{{ route('enrollments.index') }}" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
</div>
@endsection