<?php
require_once 'includes/db_connect.php';
$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $amount = floatval($_POST['amount']);
  $note = mysqli_real_escape_string($conn, $_POST['note']);

  $sql = "INSERT INTO donations (donor_name, amount, note) VALUES ('$name', '$amount', '$note')";
  if (mysqli_query($conn, $sql)) {
    $message = "ขอบคุณสำหรับการร่วมบุญ ขอให้คุณมีความสุข ความเจริญ 🙏";
  } else {
    $message = "เกิดข้อผิดพลาด: " . mysqli_error($conn);
  }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <title>ทำบุญออนไลน์ | วัดโพธิธรรมาราม</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<header class="bg-danger text-white text-center py-5">
  <h1 class="fw-bold">ร่วมทำบุญออนไลน์</h1>
  <p class="lead">เปิดใจศรัทธา สนับสนุนกิจกรรมของวัด</p>
</header>

<!-- เมนูนำทาง -->
<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-semibold" href="index.html">วัดโพธิธรรมาราม</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuMain">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="menuMain">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="index.html">หน้าแรก</a></li>
        <li class="nav-item"><a class="nav-link" href="about.html">เกี่ยวกับวัด</a></li>
        <li class="nav-item"><a class="nav-link" href="events.php">กิจกรรม</a></li>
        <li class="nav-item"><a class="nav-link" href="chant.html">บทสวด</a></li>
        <li class="nav-item"><a class="nav-link active" href="donate.php">ทำบุญ</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- เนื้อหา -->
<div class="container py-5">
  <h2 class="section-title text-center">แบบฟอร์มร่วมบุญ</h2>

  <?php if ($message): ?>
    <div class="alert alert-success text-center"><?= $message ?></div>
  <?php endif; ?>

  <div class="row justify-content-center">
    <div class="col-md-6">
      <form method="post" class="card shadow-sm p-4">
        <div class="mb-3">
          <label for="name" class="form-label">ชื่อผู้ร่วมบุญ</label>
          <input type="text" name="name" required class="form-control">
        </div>
        <div class="mb-3">
          <label for="amount" class="form-label">จำนวนเงิน (บาท)</label>
          <input type="number" name="amount" required class="form-control" step="0.01" min="0">
        </div>
        <div class="mb-3">
          <label for="note" class="form-label">อุทิศ/บันทึกเพิ่มเติม</label>
          <textarea name="note" rows="2" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-success w-100">ยืนยันการร่วมบุญ</button>
      </form>
    </div>
  </div>

  <div class="text-center mt-5">
    <h4>หรือสแกนเพื่อร่วมบุญโดยตรง</h4>
    <img src="assets/images/qrcode-donate.png" alt="QR ร่วมบุญ" width="200">
    <p class="text-muted mt-2">ชื่อบัญชี: วัดโพธิธรรมาราม<br>พร้อมเพย์: 08x-xxx-xxxx</p>
  </div>
</div>

<footer class="bg-dark text-white text-center py-4 mt-5">
  <p class="mb-0">© 2025 วัดโพธิธรรมาราม | ขออนุโมทนาบุญกับผู้ร่วมบุญทุกท่าน 🙏</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
