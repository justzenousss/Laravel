<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Quản lý nhân viên')</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: #f5f6fa;
        }
        header, footer {
            background: #2f3640;
            color: white;
            text-align: center;
            padding: 16px;
        }
        .container {
            width: 90%;
            max-width: 1100px;
            margin: 20px auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
        }
        .btn {
            display: inline-block;
            padding: 8px 14px;
            text-decoration: none;
            border-radius: 6px;
            border: none;
            cursor: pointer;
        }
        .btn-primary { background: #0984e3; color: white; }
        .btn-success { background: #00b894; color: white; }
        .btn-warning { background: #fdcb6e; color: black; }
        .btn-danger  { background: #d63031; color: white; }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 16px;
        }
        table, th, td {
            border: 1px solid #dcdde1;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        th {
            background: #273c75;
            color: white;
        }
        input, select, textarea {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        .error {
            color: red;
            font-size: 14px;
            margin-top: -8px;
            margin-bottom: 10px;
        }
        nav a {
            color: white;
            margin: 0 10px;
            text-decoration: none;
        }
        .card-box {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }
        .card {
            flex: 1;
            min-width: 220px;
            background: #f1f2f6;
            padding: 16px;
            border-radius: 10px;
        }
    </style>
</head>
<body>

<header>
    <h1>HỆ THỐNG QUẢN LÝ NHÂN VIÊN</h1>
    <nav>
        <a href="{{ route('dashboard') }}">Dashboard</a>
        <a href="{{ route('employees.index') }}">Nhân viên</a>
        <a href="{{ route('employees.create') }}">Thêm nhân viên</a>
    </nav>
</header>

<div class="container">
    @yield('content')
</div>

<footer>
    <p>Laravel Employee Management</p>
</footer>

</body>
</html>