@extends('layouts.app')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white">
        <h4 class="mb-0">Cập nhật sinh viên</h4>
    </div>

    <div class="card-body">
        <form action="{{ route('students.update', $student->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Tên sinh viên</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $student->name) }}">
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-warning">Cập nhật</button>
            <a href="{{ route('students.index') }}" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
</div>
@endsection