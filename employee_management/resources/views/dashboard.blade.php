@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')
    <h2>Dashboard</h2>

    <div class="card-box">
        <div class="card">
            <h3>Tổng nhân viên</h3>
            <p>{{ $totalEmp }}</p>
        </div>

        <div class="card">
            <h3>Tổng phòng ban</h3>
            <p>{{ $totalDep }}</p>
        </div>
    </div>

    <h3>5 nhân viên mới nhất</h3>

    @forelse($newEmp as $e)
        <p>{{ $e->name }} - {{ $e->email }} - {{ $e->position }}</p>
    @empty
        <p>Chưa có dữ liệu</p>
    @endforelse
@endsection