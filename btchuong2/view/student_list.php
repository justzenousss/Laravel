<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Quản lý sinh viên</title>

<style>
* {
    box-sizing: border-box;
}

body {
    font-family: 'Segoe UI', sans-serif;
    background: linear-gradient(135deg, #74b9ff, #0984e3);
    margin: 0;
    padding: 20px;
}

/* CARD */
.container {
    max-width: 950px;
    margin: auto;
    background: #f8f9fa;
    padding: 25px;
    border-radius: 12px;
}

/* TITLE */
h1 {
    text-align: center;
    margin-bottom: 20px;
}

/* SEARCH */
.search-box {
    margin-bottom: 15px;
}

.search-box input {
    padding: 8px;
    width: 250px;
    border-radius: 6px;
    border: 1px solid #ccc;
}

.search-box button {
    padding: 8px 12px;
    background: #0984e3;
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
}

.search-box a {
    margin-left: 10px;
    text-decoration: none;
    color: #2d3436;
}

/* BUTTON ADD */
.btn-add {
    display: inline-block;
    padding: 8px 14px;
    background: #00b894;
    color: white;
    border-radius: 8px;
    text-decoration: none;
    margin-bottom: 10px;
}

/* TABLE */
table {
    width: 100%;
    border-collapse: collapse;
    background: white;
    border-radius: 8px;
    overflow: hidden;
}

th {
    background: #0984e3;
    color: white;
    padding: 12px;
}

td {
    padding: 10px;
    text-align: center;
}

tr:nth-child(even) {
    background: #f1f2f6;
}

/* ACTION BUTTON */
.action a {
    text-decoration: none;
    padding: 5px 10px;
    border-radius: 5px;
    font-size: 14px;
}

.edit {
    background: #fdcb6e;
    color: black;
}

.delete {
    background: #d63031;
    color: white;
}

.edit:hover {
    background: #e1a73c;
}

.delete:hover {
    background: #b71c1c;
}

.empty {
    padding: 20px;
    color: gray;
}
</style>

</head>
<body>

<div class="container">

    <h1>🎓 Quản lý sinh viên</h1>

    <!-- SEARCH -->
    <div class="search-box">
        <form method="get" action="index.php">
            <input type="hidden" name="action" value="search">

            <input type="text" name="keyword"
                placeholder="🔍 Tìm tên..."
                value="<?= $_GET['keyword'] ?? '' ?>">

            <button>Tìm</button>
            <a href="index.php">Reset</a>
        </form>
    </div>

    <a class="btn-add" href="index.php?action=add">+ Thêm sinh viên</a>

    <table>
        <tr>
            <th>ID</th>
            <th>Tên</th>
            <th>Ngành</th>
            <th>Hành động</th>
        </tr>

        <?php if (!empty($students)) : ?>
            <?php foreach ($students as $s) : ?>
                <tr>
                    <td><?= $s['id'] ?></td>
                    <td><?= htmlspecialchars($s['name']) ?></td>
                    <td><?= htmlspecialchars($s['major']) ?></td>
                    <td class="action">
                        <a class="edit" href="index.php?action=edit&id=<?= $s['id'] ?>">Sửa</a>
                        <a class="delete" href="index.php?action=delete&id=<?= $s['id'] ?>" onclick="return confirm('Xóa?')">Xóa</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else : ?>
            <tr>
                <td colspan="4" class="empty">Không có dữ liệu</td>
            </tr>
        <?php endif; ?>

    </table>

</div>

</body>
</html>