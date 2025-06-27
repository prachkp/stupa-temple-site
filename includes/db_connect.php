<?php
// db_connect.php
$host = 'localhost';
$user = 'root';
$pass = ''; // ตั้งรหัสผ่านของคุณ
$db   = 'wat_db';

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
  die('ไม่สามารถเชื่อมต่อฐานข้อมูล: ' . mysqli_connect_error());
}
?>
