@extends('layouts.app')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white">
        <h4 class="mb-0">Thêm môn học</h4>
    </div>

    <div class="card-body">
        <form action="{{ route('courses.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Tên môn học</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Số tín chỉ</label>
                <input type="number" name="credits" class="form-control" value="{{ old('credits') }}" min="1">
                @error('credits')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Lưu</button>
            <a href="{{ route('courses.index') }}" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
</div>
@endsection