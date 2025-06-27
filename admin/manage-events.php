<?php
require_once 'includes/auth.php';
require_once '../includes/db_connect.php';

// ฟังก์ชันลบกิจกรรม
if (isset($_GET['delete'])) {
  $id = intval($_GET['delete']);
  mysqli_query($conn, "DELETE FROM events WHERE id=$id");
  header("Location: manage-events.php");
  exit();
}

// ฟังก์ชันเพิ่มกิจกรรม
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_event'])) {
  $title = mysqli_real_escape_string($conn, $_POST['title']);
  $description = mysqli_real_escape_string($conn, $_POST['description']);
  $event_date = $_POST['event_date'];

  $sql = "INSERT INTO events (title, description, event_date) VALUES ('$title', '$description', '$event_date')";
  mysqli_query($conn, $sql);
  header("Location: manage-events.php");
  exit();
}

$result = mysqli_query($conn, "SELECT * FROM events ORDER BY event_date DESC");
?>

<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <title>จัดการกิจกรรม | แอดมิน</title>
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
    <h2>📆 จัดการกิจกรรม</h2>

    <!-- ฟอร์มเพิ่มกิจกรรม -->
    <form method="POST" class="card p-3 shadow-sm mb-4">
      <h5 class="mb-3">เพิ่มกิจกรรมใหม่</h5>
      <div class="mb-2">
        <label>หัวข้อกิจกรรม</label>
        <input type="text" name="title" required class="form-control">
      </div>
      <div class="mb-2">
        <label>รายละเอียดกิจกรรม</label>
        <textarea name="description" rows="3" required class="form-control"></textarea>
      </div>
      <div class="mb-3">
        <label>วันที่จัดกิจกรรม</label>
        <input type="date" name="event_date" required class="form-control">
      </div>
      <button type="submit" name="add_event" class="btn btn-success">➕ เพิ่มกิจกรรม</button>
    </form>

    <!-- รายการกิจกรรม -->
    <div class="table-responsive">
      <table class="table table-bordered align-middle">
        <thead class="table-light">
          <tr>
            <th>วันที่</th>
            <th>หัวข้อ</th>
            <th>รายละเอียด</th>
            <th>ลบ</th>
          </tr>
        </thead>
        <tbody>
        <?php while($row = mysqli_fetch_assoc($result)) : ?>
          <tr>
            <td><?= date('d/m/Y', strtotime($row['event_date'])) ?></td>
            <td><?= htmlspecialchars($row['title']) ?></td>
            <td><?= nl2br(htmlspecialchars($row['description'])) ?></td>
            <td><a href="?delete=<?= $row['id'] ?>" onclick="return confirm('ยืนยันการลบกิจกรรมนี้?')" class="btn btn-sm btn-danger">🗑 ลบ</a></td>
          </tr>
        <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>
