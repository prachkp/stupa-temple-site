<?php
require_once 'includes/db_connect.php';

// ดึงกิจกรรมจากฐานข้อมูล
$query = "SELECT * FROM events ORDER BY event_date ASC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>กิจกรรมธรรมะ | วัดโพธิธรรมาราม</title>
  <link rel="stylesheet" href="assets/css/style.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>

<!-- Header -->
<header class="bg-warning text-white text-center py-5">
  <h1 class="fw-bold">กิจกรรมธรรมะ</h1>
  <p class="lead">ปฏิทินงานบุญ และการเจริญภาวนา</p>
</header>

<!-- Menu -->
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
        <li class="nav-item"><a class="nav-link active" href="events.php">กิจกรรม</a></li>
        <li class="nav-item"><a class="nav-link" href="chant.html">บทสวด</a></li>
        <li class="nav-item"><a class="nav-link" href="donate.php">ทำบุญ</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- กิจกรรมจากฐานข้อมูล -->
<div class="container py-5">
  <h2 class="section-title text-center">กำหนดการกิจกรรม</h2>
  <div class="row">
    <?php while ($event = mysqli_fetch_assoc($result)) : ?>
      <div class="col-md-6 mb-4">
        <div class="card shadow-sm">
          <div class="card-body">
            <h5 class="card-title"><?= htmlspecialchars($event['title']) ?></h5>
            <p class="card-text"><?= nl2br(htmlspecialchars($event['description'])) ?></p>
            <p><i class="bi bi-calendar-event"></i> วันที่ <?= date('d/m/Y', strtotime($event['event_date'])) ?></p>
          </div>
        </div>
      </div>
    <?php endwhile; ?>
  </div>
</div>

<!-- Footer -->
<footer class="bg-dark text-white text-center py-4">
  <p class="mb-0">© 2025 วัดโพธิธรรมาราม | ติดต่อ: 08x-xxx-xxxx</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
