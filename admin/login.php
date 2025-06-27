<?php
session_start();
require_once '../includes/db_connect.php';

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $sql = "SELECT * FROM admins WHERE username = ?";
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt, "s", $username);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  $admin = mysqli_fetch_assoc($result);

  if ($admin && password_verify($password, $admin['password'])) {
    $_SESSION['admin_user'] = $admin['username'];
    header("Location: dashboard.php");
    exit();
  } else {
    $message = "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง";
  }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <title>เข้าสู่ระบบแอดมิน</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container d-flex align-items-center justify-content-center" style="height: 100vh;">
    <div class="card shadow-sm p-4" style="min-width: 320px; max-width: 420px;">
      <h3 class="mb-3 text-center">เข้าสู่ระบบแอดมิน</h3>

      <?php if ($message): ?>
        <div class="alert alert-danger"><?= $message ?></div>
      <?php endif; ?>

      <form method="POST">
        <div class="mb-3">
          <label>ชื่อผู้ใช้</label>
          <input type="text" name="username" required class="form-control">
        </div>
        <div class="mb-3">
          <label>รหัสผ่าน</label>
          <input type="password" name="password" required class="form-control">
        </div>
        <button type="submit" class="btn btn-primary w-100">เข้าสู่ระบบ</button>
      </form>
    </div>
  </div>
</body>
</html>
