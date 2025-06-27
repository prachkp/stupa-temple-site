<?php
require_once 'includes/auth.php';
require_once '../includes/db_connect.php';

// ลบบทสวด
if (isset($_GET['delete'])) {
  $id = intval($_GET['delete']);
  mysqli_query($conn, "DELETE FROM suttas WHERE id=$id");
  header("Location: manage-suttas.php");
  exit();
}

// เพิ่มบทสวด
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_sutta'])) {
  $title = mysqli_real_escape_string($conn, $_POST['title']);
  $pali = mysqli_real_escape_string($conn, $_POST['pali_text']);
  $trans = mysqli_real_escape_string($conn, $_POST['translation']);
  $audio = mysqli_real_escape_string($conn, $_POST['audio_link']);

  $sql = "INSERT INTO suttas (title, pali_text, translation, audio_link) VALUES ('$title', '$pali', '$trans', '$audio')";
  mysqli_query($conn, $sql);
  header("Location: manage-suttas.php");
  exit();
}

$result = mysqli_query($conn, "SELECT * FROM suttas ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <title>จัดการบทสวด | แอดมิน</title>
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
    <h2>📜 จัดการบทสวดมนต์</h2>

    <!-- เพิ่มบทสวด -->
    <form method="POST" class="card p-3 shadow-sm mb-4">
      <h5 class="mb-3">เพิ่มบทสวดใหม่</h5>
      <div class="mb-2">
        <label>ชื่อบทสวด</label>
        <input type="text" name="title" required class="form-control">
      </div>
      <div class="mb-2">
        <label>เนื้อบาลี</label>
        <textarea name="pali_text" rows="3" required class="form-control"></textarea>
      </div>
      <div class="mb-2">
        <label>คำแปลไทย</label>
        <textarea name="translation" rows="3" class="form-control"></textarea>
      </div>
      <div class="mb-3">
        <label>ลิงก์เสียง (YouTube/MP3)</label>
        <input type="text" name="audio_link" class="form-control">
      </div>
      <button type="submit" name="add_sutta" class="btn btn-success">➕ เพิ่มบทสวด</button>
    </form>

    <!-- รายการบทสวด -->
    <div class="table-responsive">
      <table class="table table-bordered align-middle">
        <thead class="table-light">
          <tr>
            <th>ชื่อบทสวด</th>
            <th>เนื้อบาลี</th>
            <th>คำแปล</th>
            <th>ลิงก์เสียง</th>
            <th>ลบ</th>
          </tr>
        </thead>
        <tbody>
        <?php while($row = mysqli_fetch_assoc($result)) : ?>
          <tr>
            <td><?= htmlspecialchars($row['title']) ?></td>
            <td><pre><?= htmlspecialchars($row['pali_text']) ?></pre></td>
            <td><?= nl2br(htmlspecialchars($row['translation'])) ?></td>
            <td>
              <?php if ($row['audio_link']) : ?>
                <a href="<?= htmlspecialchars($row['audio_link']) ?>" target="_blank">🔊 ฟัง</a>
              <?php else: ?>
                -
              <?php endif; ?>
            </td>
            <td><a href="?delete=<?= $row['id'] ?>" onclick="return confirm('ลบบทสวดนี้?')" class="btn btn-sm btn-danger">🗑</a></td>
          </tr>
        <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>
