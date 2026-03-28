<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Form</title>

<style>
body{font-family:Arial;background:linear-gradient(135deg,#a29bfe,#6c5ce7);}
.box{width:400px;margin:80px auto;background:white;padding:20px;border-radius:10px;}
input{width:100%;padding:8px;margin:5px 0;}
.error{color:red;font-size:13px;}
button{background:#6c5ce7;color:white;padding:8px;border:none;}
</style>
</head>

<body>

<div class="box">
<h2><?= $action=='store'?'Thêm':'Sửa' ?></h2>

<form method="post" action="index.php?action=<?= $action ?>">

<?php if($action=='update'): ?>
<input type="hidden" name="id" value="<?= $student['id'] ?>">
<?php endif; ?>

Tên:
<input type="text" name="name" value="<?= htmlspecialchars($student['name']) ?>">
<div class="error"><?= $errors['name'] ?? '' ?></div>

Ngành:
<input type="text" name="major" value="<?= htmlspecialchars($student['major']) ?>">
<div class="error"><?= $errors['major'] ?? '' ?></div>

<button>Lưu</button>
<a href="index.php">Quay lại</a>

</form>
</div>

</body>
</html>