<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm sinh viên</title>
    <style>
        body {
            font-family: Arial;
            background: #f4f6f9;
            padding: 30px;
        }

        .container {
            max-width: 500px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        h1 {
            margin-bottom: 20px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .btn {
            padding: 10px;
            border: none;
            border-radius: 5px;
            color: white;
            cursor: pointer;
        }

        .btn-save { background: #28a745; }
        .btn-back {
            background: gray;
            text-decoration: none;
            display: inline-block;
            padding: 10px;
        }

        .error {
            color: red;
            font-size: 14px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Thêm sinh viên</h1>

    <form method="POST" action="/add">
        @csrf

        <input name="name" placeholder="Tên">
        @error('name')
            <div class="error">{{ $message }}</div>
        @enderror

        <input name="major" placeholder="Ngành">
        @error('major')
            <div class="error">{{ $message }}</div>
        @enderror

        <button class="btn btn-save">Thêm</button>
        <a href="/" class="btn btn-back">Quay lại</a>
    </form>
</div>

</body>
</html>