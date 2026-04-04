<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa sinh viên</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #e0f2fe, #f8fafc);
            min-height: 100vh;
        }

        .card {
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .btn {
            border-radius: 10px;
        }
    </style>
</head>

<body>

<div class="container mt-5">
    <div class="card p-4">

        <h2 class="mb-4">Sửa sinh viên</h2>

        <!-- VALIDATION -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('students.update', $student->id) }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Tên</label>
                <input type="text"
                       name="name"
                       class="form-control"
                       value="{{ old('name', $student->name) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Ngành</label>
                <input type="text"
                       name="major"
                       class="form-control"
                       value="{{ old('major', $student->major) }}">
            </div>

            <button class="btn btn-primary">Cập nhật</button>
            <a href="{{ route('students.index') }}" class="btn btn-secondary">Quay lại</a>

        </form>

    </div>
</div>

</body>
</html>