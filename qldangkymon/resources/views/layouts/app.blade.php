<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký môn học</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-dark bg-primary mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('enrollments.index') }}">
                Hệ thống đăng ký môn học
            </a>
        </div>
    </nav>

    <div class="container">
        <div class="mb-3">
            <a href="{{ route('students.index') }}" class="btn btn-outline-primary btn-sm">Sinh viên</a>
            <a href="{{ route('courses.index') }}" class="btn btn-outline-success btn-sm">Môn học</a>
            <a href="{{ route('enrollments.index') }}" class="btn btn-outline-dark btn-sm">Đăng ký môn</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </div>
</body>
</html>