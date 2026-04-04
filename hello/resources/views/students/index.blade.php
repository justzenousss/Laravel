<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sinh viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #eef2ff, #f8fafc);
            min-height: 100vh;
            font-family: Arial, sans-serif;
        }

        .main-card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            overflow: hidden;
        }

        .header-box {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            color: white;
            padding: 24px;
        }

        .table thead th {
            background-color: #f1f5f9;
            color: #0f172a;
            border-bottom: 2px solid #cbd5e1;
        }

        .table tbody tr:hover {
            background-color: #f8fafc;
            transition: 0.2s;
        }

        .badge-custom {
            background-color: #dbeafe;
            color: #1d4ed8;
            padding: 8px 12px;
            border-radius: 999px;
            font-weight: 600;
        }

        .empty-box {
            padding: 40px;
            text-align: center;
            color: #64748b;
        }

        .btn-sm {
            border-radius: 8px;
            padding: 4px 10px;
        }
    </style>
</head>

<body>

<div class="container py-5">
    <div class="card main-card">

        <div class="header-box d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h2 class="mb-1">Quản lý sinh viên</h2>
                <p class="mb-0">Danh sách sinh viên trong hệ thống</p>
            </div>
            <a href="{{ route('students.create') }}" class="btn btn-light fw-bold px-4">
                + Thêm sinh viên
            </a>
        </div>

        <div class="card-body p-4">

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="mb-3">
                <span class="badge-custom">Tổng sinh viên: {{ $students->count() }}</span>
            </div>

            @if ($students->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered align-middle">

                        <thead>
                            <tr class="text-center">
                                <th width="80">ID</th>
                                <th>Tên sinh viên</th>
                                <th>Ngành học</th>
                                <th width="180">Ngày tạo</th>
                                <th width="180">Hành động</th> <!-- THÊM -->
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($students as $student)
                                <tr>
                                    <td class="text-center">{{ $student->id }}</td>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->major }}</td>
                                    <td class="text-center">
                                        {{ $student->created_at ? $student->created_at->format('d/m/Y H:i') : '' }}
                                    </td>

                                    <!-- 🔥 NÚT SỬA + XÓA -->
                                    <td class="text-center">
                                        <a href="{{ route('students.edit', $student->id) }}"
                                           class="btn btn-warning btn-sm">
                                            Sửa
                                        </a>

                                        <a href="{{ route('students.delete', $student->id) }}"
                                           onclick="return confirm('Bạn có chắc muốn xóa?')"
                                           class="btn btn-danger btn-sm">
                                            Xóa
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>

            @else
                <div class="empty-box">
                    <h5>Chưa có sinh viên nào</h5>
                    <p class="mb-3">Hãy thêm sinh viên đầu tiên vào hệ thống.</p>
                    <a href="{{ route('students.create') }}" class="btn btn-primary">Thêm ngay</a>
                </div>
            @endif

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>