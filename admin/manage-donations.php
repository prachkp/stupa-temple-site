<?php
require_once 'includes/auth.php';
require_once '../includes/db_connect.php';

// ดึงข้อมูลการบริจาคทั้งหมด
$sql = "SELECT * FROM donations ORDER BY donation_date DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <title>รายการทำบุญ | แอดมิน</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <nav class="navbar navbar-dark bg-dark">
    <div class="container">
      <span class="navbar-brand">ระบบแอดมิน</span>
      <a href="dashboard.php" class="btn btn-outline-light btn-sm">← กลับแดชบอร์ด</a>
    </div>
  </nav>

  <div class="container py-4">
    <h2>💰 รายการผู้ร่วมบุญ</h2>
    <div class="table-responsive mt-4">
      <table class="table table-bordered align-middle">
        <thead class="table-light">
          <tr>
            <th>วันที่</th>
            <th>ชื่อผู้ร่วมบุญ</th>
            <th>จำนวน (บาท)</th>
            <th>หมายเหตุ</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = mysqli_fetch_assoc($result)) : ?>
          <tr>
            <td><?= date('d/m/Y H:i', strtotime($row['donation_date'])) ?></td>
            <td><?= htmlspecialchars($row['donor_name']) ?></td>
            <td><?= number_format($row['amount'], 2) ?></td>
            <td><?= nl2br(htmlspecialchars($row['note'])) ?></td>
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>
