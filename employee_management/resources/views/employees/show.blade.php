@extends('layouts.master')

@section('title', 'Chi tiết nhân viên')

@section('content')
    <h2>Chi tiết nhân viên</h2>

    <p><strong>ID:</strong> {{ $employee->id }}</p>
    <p><strong>Tên:</strong> {{ $employee->name }}</p>
    <p><strong>Email:</strong> {{ $employee->email }}</p>
    <p><strong>Chức vụ:</strong> {{ $employee->position }}</p>
    <p><strong>Phòng ban:</strong> {{ $employee->department->name ?? 'Chưa có' }}</p>

    <a href="{{ route('employees.index') }}" class="btn btn-primary">Quay lại</a>
@endsection