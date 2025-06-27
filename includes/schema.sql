CREATE DATABASE IF NOT EXISTS wat_db;
USE wat_db;

-- ตารางกิจกรรม
CREATE TABLE IF NOT EXISTS events (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  description TEXT,
  event_date DATE,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ตารางบทสวด
CREATE TABLE IF NOT EXISTS suttas (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  pali_text TEXT,
  translation TEXT,
  audio_link VARCHAR(255),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ตารางการทำบุญ
CREATE TABLE IF NOT EXISTS donations (
  id INT AUTO_INCREMENT PRIMARY KEY,
  donor_name VARCHAR(255),
  amount DECIMAL(10,2),
  note TEXT,
  donation_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
