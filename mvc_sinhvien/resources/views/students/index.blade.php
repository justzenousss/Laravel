<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách sinh viên</title>
    <style>
        body {
            font-family: Arial;
            background: #f4f6f9;
            padding: 30px;
        }

        .container {
            max-width: 900px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        h1 {
            margin-bottom: 15px;
        }

        .btn {
            padding: 8px 14px;
            border-radius: 5px;
            text-decoration: none;
            color: white;
            margin-right: 5px;
        }

        .btn-add { background: #28a745; }
        .btn-edit { background: #007bff; }
        .btn-delete { background: #dc3545; }

        input {
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        th {
            background: #343a40;
            color: white;
        }

        tr:hover {
            background: #f1f1f1;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Danh sách sinh viên</h1>

    <!-- 🔎 SEARCH -->
    <form method="GET" action="/" style="margin-bottom: 15px;">
        <input 
            type="text" 
            name="keyword" 
            placeholder="Tìm theo tên..."
            value="{{ $keyword ?? '' }}"
        >
        <button type="submit" class="btn btn-edit">Tìm</button>
        <a href="/" class="btn btn-delete">Reset</a>
    </form>

    <a href="/add" class="btn btn-add">+ Thêm sinh viên</a>

    <table>
        <tr>
            <th>ID</th>
            <th>Tên</th>
            <th>Ngành</th>
            <th>Hành động</th>
        </tr>

        @forelse($students as $s)
        <tr>
            <td>{{ $s->id }}</td>
            <td>{{ $s->name }}</td>
            <td>{{ $s->major }}</td>
            <td>
                <a href="/edit/{{ $s->id }}" class="btn btn-edit">Sửa</a>
                <a href="/delete/{{ $s->id }}" class="btn btn-delete"
                   onclick="return confirm('Xóa sinh viên?')">Xóa</a>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="4">Không tìm thấy kết quả</td>
        </tr>
        @endforelse
    </table>
</div>

</body>
</html>