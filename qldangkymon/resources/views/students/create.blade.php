@extends('layouts.app')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white">
        <h4 class="mb-0">Thêm sinh viên</h4>
    </div>

    <div class="card-body">
        <form action="{{ route('students.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Tên sinh viên</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Lưu</button>
            <a href="{{ route('students.index') }}" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
</div>
@endsection