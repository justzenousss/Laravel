<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm sinh viên</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- STYLE đẹp -->
    <style>
        body {
            background: linear-gradient(135deg, #dbeafe, #f8fafc);
            min-height: 100vh;
        }

        .card {
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .btn {
            border-radius: 10px;
        }

        .title {
            font-weight: bold;
            color: #1e3a8a;
        }
    </style>
</head>

<body>

<div class="container mt-5">
    <div class="card p-4">

        <h2 class="mb-4 title">Thêm sinh viên</h2>

        <!-- VALIDATION -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Lỗi nhập liệu:</strong>
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- FORM -->
        <form action="{{ route('students.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Tên sinh viên</label>
                <input type="text"
                       name="name"
                       class="form-control"
                       value="{{ old('name') }}"
                       placeholder="Ví dụ: Nguyễn Văn A">
            </div>

            <div class="mb-3">
                <label class="form-label">Ngành học</label>
                <input type="text"
                       name="major"
                       class="form-control"
                       value="{{ old('major') }}"
                       placeholder="Ví dụ: CNTT">
            </div>

            <button class="btn btn-success">Lưu</button>
            <a href="{{ route('students.index') }}" class="btn btn-secondary">Quay lại</a>

        </form>

    </div>
</div>

</body>
</html>