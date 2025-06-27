<?php
require_once 'includes/auth.php';
?>

<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <title>แดชบอร์ดผู้ดูแล</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <nav class="navbar navbar-dark bg-dark">
    <div class="container">
      <span class="navbar-brand">ระบบแอดมิน</span>
      <span class="text-white">ยินดีต้อนรับ, <?= htmlspecialchars($_SESSION['admin_user']) ?></span>
      <a href="logout.php" class="btn btn-outline-light btn-sm">ออกจากระบบ</a>
    </div>
  </nav>

  <div class="container py-4">
    <h1 class="mb-4">แดชบอร์ดผู้ดูแล</h1>
    <div class="row g-4">
      <div class="col-md-4">
        <a href="manage-events.php" class="btn btn-warning w-100">📆 จัดการกิจกรรม</a>
      </div>
      <div class="col-md-4">
        <a href="#" class="btn btn-success w-100">📜 จัดการบทสวด (เร็ว ๆ นี้)</a>
      </div>
      <div class="col-md-4">
        <a href="#" class="btn btn-primary w-100">💰 รายการทำบุญ (เร็ว ๆ นี้)</a>
      </div>
    </div>
  </div>
</body>
</html>
