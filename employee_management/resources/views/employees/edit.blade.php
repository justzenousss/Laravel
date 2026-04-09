@extends('layouts.master')

@section('title', 'Sửa nhân viên')

@section('content')
    <h2>Sửa nhân viên</h2>

    <form method="POST" action="{{ route('employees.update', $employee->id) }}">
        @csrf
        @method('PUT')

        <label>Tên nhân viên</label>
        <input type="text" name="name" value="{{ old('name', $employee->name) }}">
        @error('name')
            <div class="error">{{ $message }}</div>
        @enderror

        <label>Email</label>
        <input type="email" name="email" value="{{ old('email', $employee->email) }}">
        @error('email')
            <div class="error">{{ $message }}</div>
        @enderror

        <label>Chức vụ</label>
        <input type="text" name="position" value="{{ old('position', $employee->position) }}">
        @error('position')
            <div class="error">{{ $message }}</div>
        @enderror

        <label>Phòng ban</label>
        <select name="department_id">
            @foreach($departments as $department)
                <option value="{{ $department->id }}"
                    {{ old('department_id', $employee->department_id) == $department->id ? 'selected' : '' }}>
                    {{ $department->name }}
                </option>
            @endforeach
        </select>
        @error('department_id')
            <div class="error">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn btn-success">Cập nhật</button>
        <a href="{{ route('employees.index') }}" class="btn btn-primary">Quay lại</a>
    </form>
@endsection