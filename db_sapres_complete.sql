-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sapres`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggota_tim`
--

CREATE TABLE `anggota_tim` (
`anggota_id` int(11) NOT NULL AUTO_INCREMENT,
`tim_id` int(11) NOT NULL,
`user_id` int(11) NOT NULL,
`status` enum('menunggu','diterima','ditolak') DEFAULT 'menunggu',
`ktm_path` varchar(255) DEFAULT NULL,
`created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY (`anggota_id`),
KEY `fk_tim` (`tim_id`),
KEY `fk_user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `anggota_tim`
--

INSERT INTO `anggota_tim` (`anggota_id`, `tim_id`, `user_id`, `status`, `ktm_path`, `created_at`) VALUES
(1, 25, 2, 'diterima', NULL, '2025-06-18 10:44:26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `beasiswa`
--

CREATE TABLE `beasiswa` (
`beasiswa_id` int(11) NOT NULL AUTO_INCREMENT,
`judul_beasiswa` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
`jenjang_beasiswa` set('SMP','SMA','S1','S2','S3','D3','D4','Non-degree','Gap-year','Profesi') COLLATE utf8mb4_general_ci DEFAULT NULL,
`mulai_beasiswa` date DEFAULT NULL,
`penutupan_beasiswa` date DEFAULT NULL,
`pemberi_beasiswa` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
`asal_instansi` varchar(500) COLLATE utf8mb4_general_ci DEFAULT NULL,
`tipe_pendanaan` set('Fully Funded','Partially Funded') COLLATE utf8mb4_general_ci DEFAULT NULL,
`benefit_beasiswa` text COLLATE utf8mb4_general_ci,
`syarat_beasiswa` text COLLATE utf8mb4_general_ci,
`booklet_beasiswa` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
`lokasi_beasiswa` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
`daftar_beasiswa` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
`view_count` int(11) DEFAULT 0,
`bookmark_count` int(11) DEFAULT 0,
PRIMARY KEY (`beasiswa_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `beasiswa`
--

INSERT INTO `beasiswa` (`beasiswa_id`, `judul_beasiswa`, `jenjang_beasiswa`, `mulai_beasiswa`, `penutupan_beasiswa`, `pemberi_beasiswa`, `asal_instansi`, `tipe_pendanaan`, `benefit_beasiswa`, `syarat_beasiswa`, `booklet_beasiswa`, `lokasi_beasiswa`, `daftar_beasiswa`, `view_count`, `bookmark_count`) VALUES
(1, 'Beasiswa Unggulan Kemendikbud', 'S1,S2', '2025-01-01', '2025-03-31', 'Kemendikbud', 'Semua instansi', 'Fully Funded', 'Uang kuliah, biaya hidup, tunjangan buku', 'Warga negara Indonesia, IPK min 3.0', 'booklet_unggulan.pdf', 'Indonesia', 'https://beasiswa.kemdikbud.go.id', 150, 25),
(2, 'Swedish Institute Scholarships', 'S2,S3', '2025-09-01', '2025-12-01', 'Swedish Institute', 'Sweden', 'Fully Funded', 'Biaya kuliah, tunjangan hidup, tiket pesawat pulang pergi', 'IPK min 3.0, WNI, usia max 30 tahun', 'swedish_institute.pdf', 'Sweden', 'https://www.si.se/en/apply/scholarships/', 89, 12),
(3, 'Fulbright Foreign Student Program', 'S2,S3', '2025-01-01', '2025-05-01', 'Fulbright Program', 'USA', 'Fully Funded', 'Biaya kuliah, tunjangan hidup, asuransi kesehatan', 'WNI, IPK min 3.0, TOEFL min 550', 'fulbright.pdf', 'USA', 'https://foreign.fulbrightonline.org/', 234, 45),
(4, 'Chevening Scholarships', 'S2', '2025-06-01', '2025-11-01', 'Chevening Secretariat', 'United Kingdom', 'Fully Funded', 'Biaya kuliah, biaya hidup, tiket pesawat', 'IPK min 3.0, pengalaman kerja minimal 2 tahun', 'chevening.pdf', 'United Kingdom', 'https://www.chevening.org/', 178, 32),
(5, 'LPDP Scholarship', 'S1,S2,S3', '2025-05-01', '2025-08-01', 'LPDP', 'Indonesia', 'Fully Funded', 'Biaya kuliah, biaya hidup, tunjangan penelitian', 'WNI, tidak sedang menerima beasiswa lain', 'lpdp.pdf', 'Indonesia', 'https://www.lpdp.kemenkeu.go.id/', 312, 67),
(6, 'DAAD Scholarship', 'S1,S2,S3', '2025-04-01', '2025-09-01', 'DAAD', 'Germany', 'Fully Funded', 'Biaya kuliah, akomodasi, tunjangan hidup', 'IPK min 3.0, wawancara', 'daad.pdf', 'Germany', 'https://www.daad.de/en/', 145, 28);

-- --------------------------------------------------------

--
-- Struktur dari tabel `bookmarks`
--

CREATE TABLE `bookmarks` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`user_id` int(11) NOT NULL,
`item_type` enum('beasiswa','lomba') COLLATE utf8mb4_general_ci NOT NULL,
`item_id` int(11) NOT NULL,
`created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY (`id`),
UNIQUE KEY `unique_bookmark` (`user_id`,`item_type`,`item_id`),
KEY `idx_user_id` (`user_id`),
KEY `idx_item_type` (`item_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `forum`
--

CREATE TABLE `forum` (
`forum_id` int(11) NOT NULL AUTO_INCREMENT,
`user_id` int(11) DEFAULT NULL,
`kategori` enum('lomba','beasiswa','cari tim','umum') COLLATE utf8mb4_general_ci DEFAULT NULL,
`pesan` text COLLATE utf8mb4_general_ci DEFAULT NULL,
`id_penanya` int(11) DEFAULT NULL,
`parent_id` int(11) DEFAULT NULL,
`tanggal_pesan` date DEFAULT NULL,
`waktu_postingan` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
`view_count` int(11) DEFAULT 0,
`reply_count` int(11) DEFAULT 0,
PRIMARY KEY (`forum_id`),
KEY `user_id` (`user_id`),
KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `forum`
--

INSERT INTO `forum` (`forum_id`, `user_id`, `kategori`, `pesan`, `id_penanya`, `parent_id`, `tanggal_pesan`, `waktu_postingan`, `view_count`, `reply_count`) VALUES
(84, 1, 'umum', 'Halo semua, admin disini', 1, NULL, '2025-06-17', '2025-06-17 05:38:02', 45, 2),
(86, 1, 'cari tim', 'aku butuh tim yang ahli dalam pemrograman web', 1, NULL, '2025-06-17', '2025-06-17 05:39:48', 23, 1),
(89, 2, NULL, 'saya bang', 1, 86, NULL, '2025-06-18 02:52:56', 0, 0),
(90, 4, 'cari tim', 'anda bisa mencari atau membuat tim anda dengan fitur cari tim dari sapres', 4, NULL, '2025-06-18', '2025-06-18 03:22:35', 12, 0),
(91, 4, NULL, 'iyakah', NULL, 84, NULL, '2025-06-18 03:25:28', 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `lomba`
--

CREATE TABLE `lomba` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
`cost` varchar(100) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
`organizer` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
`description` text COLLATE utf8mb4_general_ci,
`requirements` text COLLATE utf8mb4_general_ci,
`prizes` text COLLATE utf8mb4_general_ci,
`deadline` date NOT NULL,
`start_date` date NOT NULL,
`level` enum('D3','D4','S1','S2','S3') COLLATE utf8mb4_general_ci NOT NULL,
`category` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
`scope` enum('Lokal','Regional','Nasional','Internasional') COLLATE utf8mb4_general_ci DEFAULT 'Nasional',
`image_url` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
`image_path` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
`external_url` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
`is_active` tinyint(1) DEFAULT '1',
`created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
`updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
`view_count` int(11) DEFAULT 0,
`bookmark_count` int(11) DEFAULT 0,
`participant_count` int(11) DEFAULT 0,
PRIMARY KEY (`id`),
KEY `idx_deadline` (`deadline`),
KEY `idx_level` (`level`),
KEY `idx_scope` (`scope`),
KEY `idx_is_active` (`is_active`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `lomba`
--

INSERT INTO `lomba` (`id`, `title`, `cost`, `organizer`, `description`, `requirements`, `prizes`, `deadline`, `start_date`, `level`, `category`, `scope`, `image_url`, `image_path`, `external_url`, `is_active`, `created_at`, `updated_at`, `view_count`, `bookmark_count`, `participant_count`) VALUES
(1, 'Business Case Competition IYREF 2025', 'Gratis', 'SRE ITB', 'Kompetisi analisis kasus bisnis tingkat nasional', 'Mahasiswa aktif D3/D4/S1, Tim 3-4 orang', 'Juara 1: 15 juta, Juara 2: 10 juta, Juara 3: 5 juta', '2025-03-23', '2025-03-06', 'S1', 'Bisnis', 'Nasional', 'bcc-iyref.jpg', NULL, 'https://iyref.com', 1, '2025-06-15 11:14:57', '2025-06-15 11:14:57', 89, 15, 234),
(2, 'AI Competition Microsoft', 'Gratis', 'Microsoft Indonesia', 'Kompetisi kecerdasan buatan tingkat nasional', 'Mahasiswa aktif, Kemampuan programming', 'Juara 1: 20 juta, Juara 2: 15 juta, Juara 3: 10 juta', '2025-04-15', '2025-03-25', 'S1', 'Teknologi', 'Nasional', 'ai-microsoft.jpg', NULL, 'https://microsoft.com/competition', 1, '2025-06-15 11:14:57', '2025-06-15 11:14:57', 156, 28, 189);

-- --------------------------------------------------------

--
-- Struktur dari tabel `notifikasi`
--

CREATE TABLE `notifikasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `tipe` enum('permintaan_bergabung','diterima','ditolak','info_beasiswa','info_lomba','system') COLLATE utf8mb4_general_ci NOT NULL,
  `pesan` text COLLATE utf8mb4_general_ci,
  `terkait_tim_id` int(11) DEFAULT NULL,
  `dari_user_id` int(11) DEFAULT NULL,
  `status_baca` enum('belum_dibaca','dibaca') COLLATE utf8mb4_general_ci DEFAULT 'belum_dibaca',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_notifikasi_user` (`user_id`),
  KEY `fk_notifikasi_tim` (`terkait_tim_id`),
  KEY `fk_notifikasi_dari_user` (`dari_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `notifikasi`
--

INSERT INTO `notifikasi` (`id`, `user_id`, `tipe`, `pesan`, `terkait_tim_id`, `dari_user_id`, `status_baca`, `created_at`) VALUES
(1, 2, 'permintaan_bergabung', 'Ada permintaan bergabung ke tim Tim Alpha', 25, 3, 'belum_dibaca', '2025-06-18 10:44:26'),
(2, 1, 'info_beasiswa', 'Beasiswa baru telah ditambahkan: LPDP Scholarship', NULL, NULL, 'dibaca', '2025-06-18 03:22:35');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tim`
--

CREATE TABLE `tim` (
`tim_id` int(11) NOT NULL AUTO_INCREMENT,
`nama_tim` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
`jumlah_anggota` int(11) NOT NULL,
`jenjang_tim` set('SMP','SMA','S1','S2','S3','D3','D4','Non-degree','Gap-year','Profesi') COLLATE utf8mb4_general_ci NOT NULL,
`kategori_lomba` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
`judul_lomba` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
`asal_instansi` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
`deskripsi` text COLLATE utf8mb4_general_ci,
`syarat_ketentuan` text COLLATE utf8mb4_general_ci,
`cek_ktm` enum('perlu_ktm','tidak_perlu_ktm') COLLATE utf8mb4_general_ci NOT NULL,
`link` text COLLATE utf8mb4_general_ci NOT NULL,
`created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
`user_id` int(11) DEFAULT NULL,
`status` enum('aktif','nonaktif','penuh') COLLATE utf8mb4_general_ci DEFAULT 'aktif',
`view_count` int(11) DEFAULT 0,
`member_count` int(11) DEFAULT 1,
PRIMARY KEY (`tim_id`),
KEY `fk_tim_user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tim`
--

INSERT INTO `tim` (`tim_id`, `nama_tim`, `jumlah_anggota`, `jenjang_tim`, `kategori_lomba`, `judul_lomba`, `asal_instansi`, `deskripsi`, `syarat_ketentuan`, `cek_ktm`, `link`, `created_at`, `user_id`, `status`, `view_count`, `member_count`) VALUES
(1, 'Tim Pahlawan', 3, 'S1', 'Robotika', 'Lomba Robot Cerdas', 'Universitas Indonesia', 'Tim dari Universitas Indonesia yang mengembangkan robot untuk tugas-tugas cerdas.', 'Harus dapat merakit robot dalam waktu 6 jam.|bisa berbahasa inggris.|paham coding', 'perlu_ktm', '', '2025-06-10 01:30:00', NULL, 'aktif', 45, 2),
(2, 'Tim Akselerasi', 3, 'S1', 'Coding', 'Lomba Koding Cepat', 'Institut Teknologi Bandung', 'Tim pengembang aplikasi yang berkompetisi dalam pemrograman software.', 'Menguasai Python dan JavaScript.', 'tidak_perlu_ktm', '', '2025-06-07 07:15:00', NULL, 'aktif', 32, 3),
(25, 'Tim Alpha', 4, 'S1', 'Programming', 'Hackathon 2025', 'Universitas Teknologi', 'Tim programming yang berfokus pada pengembangan aplikasi web dan mobile', 'Menguasai JavaScript, Python, atau Java | Pengalaman minimal 1 tahun | Mampu bekerja dalam tim', 'perlu_ktm', 'https://chat.whatsapp.com/example123', '2025-06-18 10:44:26', 2, 'aktif', 67, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
`user_id` int(11) NOT NULL AUTO_INCREMENT,
`fullname` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
`email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
`password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
`role` enum('user','admin') COLLATE utf8mb4_general_ci DEFAULT 'user',
`created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
`updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
`last_login` timestamp NULL DEFAULT NULL,
`login_count` int(11) DEFAULT 0,
`activity_score` int(11) DEFAULT 0,
PRIMARY KEY (`user_id`),
UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`user_id`, `fullname`, `email`, `password`, `role`, `created_at`, `updated_at`, `last_login`, `login_count`, `activity_score`) VALUES
(1, 'Syahrul Ramadhan', 'syahrulramadhansr00@gmail.com', '$2y$10$WEVipCxKls6punOsW1eWl.lxvqQrtTd5NjCmAu6jPfnD6cqGJ2I0m', 'admin', '2025-06-15 07:28:14', '2025-06-18 03:21:47', '2025-06-18 10:30:00', 25, 150),
(2, 'John Doe', 'john.doe@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', '2025-06-18 10:44:26', '2025-06-18 10:44:26', '2025-06-18 11:00:00', 12, 85),
(3, 'Jane Smith', 'jane.smith@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', '2025-06-18 10:44:26', '2025-06-18 10:44:26', '2025-06-18 09:15:00', 8, 45),
(4, 'Admin Sapres', 'admin@sapres.com', '$2y$10$WEVipCxKls6punOsW1eWl.lxvqQrtTd5NjCmAu6jPfnD6cqGJ2I0m', 'admin', '2025-06-18 03:21:47', '2025-06-18 03:21:47', '2025-06-18 08:00:00', 15, 120);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_sessions`
--

CREATE TABLE `user_sessions` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`user_id` int(11) NOT NULL,
`session_id` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
`login_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
`last_activity` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
`ip_address` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
`user_agent` text COLLATE utf8mb4_general_ci,
`is_active` tinyint(1) DEFAULT '1',
PRIMARY KEY (`id`),
KEY `idx_user_id` (`user_id`),
KEY `idx_session_id` (`session_id`),
KEY `idx_is_active` (`is_active`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user_sessions`
--

INSERT INTO `user_sessions` (`id`, `user_id`, `session_id`, `login_time`, `last_activity`, `ip_address`, `user_agent`, `is_active`) VALUES
(1, 1, 'session123abc', '2025-06-18 10:44:26', '2025-06-18 10:44:26', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36', 1),
(2, 2, 'session456def', '2025-06-18 10:44:26', '2025-06-18 10:44:26', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `activity_log`
--

CREATE TABLE `activity_log` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`user_id` int(11) DEFAULT NULL,
`activity_type` enum('login','logout','view_beasiswa','view_lomba','create_team','join_team','forum_post','bookmark') COLLATE utf8mb4_general_ci NOT NULL,
`description` text COLLATE utf8mb4_general_ci,
`ip_address` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
`created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY (`id`),
KEY `idx_user_id` (`user_id`),
KEY `idx_activity_type` (`activity_type`),
KEY `idx_created_at` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- FUNCTIONS IMPLEMENTATION
--

DELIMITER //

-- Function 1: Calculate Scholarship Age (Days since start)
CREATE FUNCTION CalculateScholarshipAge(start_date DATE) 
RETURNS INT
READS SQL DATA
DETERMINISTIC
BEGIN
  RETURN DATEDIFF(CURDATE(), start_date);
END //

-- Function 2: Calculate Days Until Deadline
CREATE FUNCTION DaysUntilDeadline(deadline_date DATE) 
RETURNS INT
READS SQL DATA
DETERMINISTIC
BEGIN
  DECLARE days_left INT;
  SET days_left = DATEDIFF(deadline_date, CURDATE());
  RETURN CASE 
      WHEN days_left < 0 THEN 0 
      ELSE days_left 
  END;
END //

-- Function 3: Calculate User Activity Score
CREATE FUNCTION CalculateUserActivityScore(p_user_id INT) 
RETURNS INT
READS SQL DATA
DETERMINISTIC
BEGIN
  DECLARE forum_posts INT DEFAULT 0;
  DECLARE teams_created INT DEFAULT 0;
  DECLARE bookmarks_count INT DEFAULT 0;
  DECLARE total_score INT DEFAULT 0;
    
  SELECT COUNT(*) INTO forum_posts 
  FROM forum WHERE user_id = p_user_id AND parent_id IS NULL;
    
  SELECT COUNT(*) INTO teams_created 
  FROM tim WHERE user_id = p_user_id;
    
  SELECT COUNT(*) INTO bookmarks_count 
  FROM bookmarks WHERE user_id = p_user_id;
    
  SET total_score = (forum_posts * 5) + (teams_created * 10) + (bookmarks_count * 2);
    
  RETURN total_score;
END //

-- Function 4: Check Team Availability
CREATE FUNCTION IsTeamAvailable(p_tim_id INT) 
RETURNS BOOLEAN
READS SQL DATA
DETERMINISTIC
BEGIN
  DECLARE current_members INT DEFAULT 0;
  DECLARE max_members INT DEFAULT 0;
  DECLARE team_status VARCHAR(20);
    
  SELECT member_count, jumlah_anggota, status 
  INTO current_members, max_members, team_status
  FROM tim WHERE tim_id = p_tim_id;
    
  RETURN (current_members < max_members AND team_status = 'aktif');
END //

DELIMITER ;

-- --------------------------------------------------------

--
-- STORED PROCEDURES IMPLEMENTATION
--

DELIMITER //

-- Procedure 1: Update Expired Scholarships and Competitions
CREATE PROCEDURE UpdateExpiredItems()
BEGIN
  DECLARE done INT DEFAULT FALSE;
  DECLARE expired_count INT DEFAULT 0;
    
  -- Update expired beasiswa
  UPDATE beasiswa 
  SET tipe_pendanaan = CONCAT(tipe_pendanaan, ' (EXPIRED)')
  WHERE penutupan_beasiswa < CURDATE() 
  AND tipe_pendanaan NOT LIKE '%EXPIRED%';
    
  -- Update expired lomba
  UPDATE lomba 
  SET is_active = 0 
  WHERE deadline < CURDATE() AND is_active = 1;
    
  -- Get count of expired items
  SELECT ROW_COUNT() INTO expired_count;
    
  -- Log the activity
  INSERT INTO activity_log (user_id, activity_type, description, created_at)
  VALUES (NULL, 'system', CONCAT('Updated ', expired_count, ' expired items'), NOW());
END //

-- Procedure 2: Calculate and Update User Rankings
CREATE PROCEDURE UpdateUserRankings()
BEGIN
  DECLARE done INT DEFAULT FALSE;
  DECLARE user_id_var INT;
  DECLARE new_score INT;
    
  DECLARE user_cursor CURSOR FOR 
      SELECT user_id FROM users WHERE role = 'user';
    
  DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
    
  OPEN user_cursor;
    
  user_loop: LOOP
      FETCH user_cursor INTO user_id_var;
      IF done THEN
          LEAVE user_loop;
      END IF;
        
      -- Calculate new activity score using our function
      SET new_score = CalculateUserActivityScore(user_id_var);
        
      -- Update user activity score
      UPDATE users 
      SET activity_score = new_score 
      WHERE user_id = user_id_var;
        
  END LOOP;
    
  CLOSE user_cursor;
    
  -- Log the ranking update
  INSERT INTO activity_log (user_id, activity_type, description, created_at)
  VALUES (NULL, 'system', 'User rankings updated successfully', NOW());
END //

-- Procedure 3: Clean Old Sessions
CREATE PROCEDURE CleanOldSessions()
BEGIN
  DECLARE cleaned_count INT DEFAULT 0;
    
  -- Deactivate sessions older than 30 days
  UPDATE user_sessions 
  SET is_active = 0 
  WHERE last_activity < DATE_SUB(NOW(), INTERVAL 30 DAY) 
  AND is_active = 1;
    
  SELECT ROW_COUNT() INTO cleaned_count;
    
  -- Delete very old sessions (older than 90 days)
  DELETE FROM user_sessions 
  WHERE last_activity < DATE_SUB(NOW(), INTERVAL 90 DAY);
    
  -- Log the cleanup
  INSERT INTO activity_log (user_id, activity_type, description, created_at)
  VALUES (NULL, 'system', CONCAT('Cleaned ', cleaned_count, ' old sessions'), NOW());
END //

-- Procedure 4: Generate Monthly Report
CREATE PROCEDURE GenerateMonthlyReport(IN report_month INT, IN report_year INT)
BEGIN
  DECLARE total_users INT DEFAULT 0;
  DECLARE new_users INT DEFAULT 0;
  DECLARE active_teams INT DEFAULT 0;
  DECLARE forum_posts INT DEFAULT 0;
    
  -- Get statistics for the month
  SELECT COUNT(*) INTO total_users FROM users;
    
  SELECT COUNT(*) INTO new_users 
  FROM users 
  WHERE MONTH(created_at) = report_month 
  AND YEAR(created_at) = report_year;
    
  SELECT COUNT(*) INTO active_teams 
  FROM tim 
  WHERE status = 'aktif' 
  AND MONTH(created_at) = report_month 
  AND YEAR(created_at) = report_year;
    
  SELECT COUNT(*) INTO forum_posts 
  FROM forum 
  WHERE MONTH(waktu_postingan) = report_month 
  AND YEAR(waktu_postingan) = report_year;
    
  -- Create a temporary result (in real implementation, this could be inserted into a reports table)
  SELECT 
      report_month as 'Month',
      report_year as 'Year',
      total_users as 'Total Users',
      new_users as 'New Users',
      active_teams as 'Active Teams',
      forum_posts as 'Forum Posts';
END //

-- Procedure 5: Process Team Join Request with Conditional Logic
CREATE PROCEDURE ProcessTeamJoinRequest(
  IN p_tim_id INT, 
  IN p_user_id INT, 
  IN p_action ENUM('approve', 'reject')
)
BEGIN
  DECLARE team_full BOOLEAN DEFAULT FALSE;
  DECLARE current_members INT DEFAULT 0;
  DECLARE max_members INT DEFAULT 0;
  DECLARE team_creator_id INT DEFAULT 0;
  DECLARE notification_message TEXT;
    
  -- Start transaction
  START TRANSACTION;
    
  -- Get team information
  SELECT member_count, jumlah_anggota, user_id 
  INTO current_members, max_members, team_creator_id
  FROM tim WHERE tim_id = p_tim_id;
    
  -- Check if team is full
  IF current_members >= max_members THEN
      SET team_full = TRUE;
  END IF;
    
  -- Process based on action and conditions
  IF p_action = 'approve' AND NOT team_full THEN
      -- Approve the request
      UPDATE anggota_tim 
      SET status = 'diterima' 
      WHERE tim_id = p_tim_id AND user_id = p_user_id;
        
      -- Update team member count
      UPDATE tim 
      SET member_count = member_count + 1 
      WHERE tim_id = p_tim_id;
        
      -- Check if team is now full
      IF (current_members + 1) >= max_members THEN
          UPDATE tim SET status = 'penuh' WHERE tim_id = p_tim_id;
      END IF;
        
      SET notification_message = 'Selamat! Permintaan bergabung Anda telah diterima';
        
  ELSEIF p_action = 'reject' THEN
      -- Reject the request
      UPDATE anggota_tim 
      SET status = 'ditolak' 
      WHERE tim_id = p_tim_id AND user_id = p_user_id;
        
      SET notification_message = 'Maaf, permintaan bergabung Anda ditolak';
        
  ELSE
      -- Team is full or invalid action
      ROLLBACK;
      SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Cannot process request: Team is full or invalid action';
  END IF;
    
  -- Create notification
  INSERT INTO notifikasi (user_id, tipe, pesan, terkait_tim_id, dari_user_id)
  VALUES (p_user_id, 
          CASE WHEN p_action = 'approve' THEN 'diterima' ELSE 'ditolak' END,
          notification_message, 
          p_tim_id, 
          team_creator_id);
    
  COMMIT;
END //

DELIMITER ;

-- --------------------------------------------------------

--
-- TRIGGERS IMPLEMENTATION
--

DELIMITER //

-- Trigger 1: Auto-create notification when someone joins a team
CREATE TRIGGER after_team_member_insert
AFTER INSERT ON anggota_tim
FOR EACH ROW
BEGIN
  DECLARE team_name VARCHAR(25);
  DECLARE team_creator_id INT;
    
  -- Get team information
  SELECT nama_tim, user_id INTO team_name, team_creator_id
  FROM tim WHERE tim_id = NEW.tim_id;
    
  -- Create notification for team creator
  IF team_creator_id IS NOT NULL AND team_creator_id != NEW.user_id THEN
      INSERT INTO notifikasi (user_id, tipe, pesan, terkait_tim_id, dari_user_id)
      VALUES (team_creator_id, 'permintaan_bergabung', 
              CONCAT('Ada permintaan bergabung ke tim ', team_name),
              NEW.tim_id, NEW.user_id);
  END IF;
END //

-- Trigger 2: Update bookmark count when bookmark is added/removed
CREATE TRIGGER after_bookmark_insert
AFTER INSERT ON bookmarks
FOR EACH ROW
BEGIN
  IF NEW.item_type = 'beasiswa' THEN
      UPDATE beasiswa 
      SET bookmark_count = bookmark_count + 1 
      WHERE beasiswa_id = NEW.item_id;
  ELSEIF NEW.item_type = 'lomba' THEN
      UPDATE lomba 
      SET bookmark_count = bookmark_count + 1 
      WHERE id = NEW.item_id;
  END IF;
END //

CREATE TRIGGER after_bookmark_delete
AFTER DELETE ON bookmarks
FOR EACH ROW
BEGIN
  IF OLD.item_type = 'beasiswa' THEN
      UPDATE beasiswa 
      SET bookmark_count = bookmark_count - 1 
      WHERE beasiswa_id = OLD.item_id;
  ELSEIF OLD.item_type = 'lomba' THEN
      UPDATE lomba 
      SET bookmark_count = bookmark_count - 1 
      WHERE id = OLD.item_id;
  END IF;
END //

-- Trigger 3: Update reply count in forum when reply is added
CREATE TRIGGER after_forum_reply_insert
AFTER INSERT ON forum
FOR EACH ROW
BEGIN
  IF NEW.parent_id IS NOT NULL THEN
      UPDATE forum 
      SET reply_count = reply_count + 1 
      WHERE forum_id = NEW.parent_id;
  END IF;
END //

-- Trigger 4: Log user activity
CREATE TRIGGER after_user_login_update
AFTER UPDATE ON users
FOR EACH ROW
BEGIN
  IF NEW.last_login != OLD.last_login THEN
      INSERT INTO activity_log (user_id, activity_type, description, created_at)
      VALUES (NEW.user_id, 'login', 
              CONCAT('User logged in: ', NEW.fullname), NOW());
  END IF;
END //

-- Trigger 5: Auto-update team status based on member count
CREATE TRIGGER after_team_member_status_update
AFTER UPDATE ON anggota_tim
FOR EACH ROW
BEGIN
  DECLARE current_members INT;
  DECLARE max_members INT;
    
  IF NEW.status = 'diterima' AND OLD.status != 'diterima' THEN
      -- Get current team info
      SELECT member_count, jumlah_anggota 
      INTO current_members, max_members
      FROM tim WHERE tim_id = NEW.tim_id;
        
      -- Update team status if full
      IF current_members >= max_members THEN
          UPDATE tim SET status = 'penuh' WHERE tim_id = NEW.tim_id;
      END IF;
  END IF;
END //

DELIMITER ;

-- --------------------------------------------------------

--
-- VIEWS FOR RANKING AND ANALYTICS
--

-- View 1: User Ranking by Activity Score
CREATE VIEW user_ranking AS
SELECT 
  u.user_id,
  u.fullname,
  u.email,
  u.activity_score,
  COUNT(f.forum_id) as forum_posts,
  COUNT(t.tim_id) as teams_created,
  COUNT(b.id) as bookmarks_count,
  RANK() OVER (ORDER BY u.activity_score DESC) as user_rank,
  ROW_NUMBER() OVER (ORDER BY u.activity_score DESC) as position
FROM users u
LEFT JOIN forum f ON u.user_id = f.user_id AND f.parent_id IS NULL
LEFT JOIN tim t ON u.user_id = t.user_id
LEFT JOIN bookmarks b ON u.user_id = b.user_id
WHERE u.role = 'user'
GROUP BY u.user_id, u.fullname, u.email, u.activity_score
ORDER BY user_rank;

-- View 2: Popular Scholarships Ranking
CREATE VIEW popular_beasiswa AS
SELECT 
  b.beasiswa_id,
  b.judul_beasiswa,
  b.lokasi_beasiswa,
  b.view_count,
  b.bookmark_count,
  (b.view_count * 0.3 + b.bookmark_count * 0.7) as popularity_score,
  RANK() OVER (ORDER BY (b.view_count * 0.3 + b.bookmark_count * 0.7) DESC) as popularity_rank,
  CASE 
      WHEN b.penutupan_beasiswa < CURDATE() THEN 'Expired'
      WHEN DATEDIFF(b.penutupan_beasiswa, CURDATE()) <= 7 THEN 'Closing Soon'
      ELSE 'Active'
  END as status
FROM beasiswa b
ORDER BY popularity_rank;

-- View 3: Competition Statistics with Ranking
CREATE VIEW lomba_statistics AS
SELECT 
  l.id,
  l.title,
  l.organizer,
  l.level,
  l.scope,
  l.view_count,
  l.bookmark_count,
  l.participant_count,
  (l.view_count * 0.2 + l.bookmark_count * 0.3 + l.participant_count * 0.5) as engagement_score,
  RANK() OVER (ORDER BY (l.view_count * 0.2 + l.bookmark_count * 0.3 + l.participant_count * 0.5) DESC) as engagement_rank,
  CASE 
      WHEN l.deadline < CURDATE() THEN 'Expired'
      WHEN DATEDIFF(l.deadline, CURDATE()) <= 7 THEN 'Closing Soon'
      WHEN l.is_active = 1 THEN 'Active'
      ELSE 'Inactive'
  END as status
FROM lomba l
ORDER BY engagement_rank;

-- View 4: Team Activity Ranking
CREATE VIEW team_ranking AS
SELECT 
  t.tim_id,
  t.nama_tim,
  t.kategori_lomba,
  t.view_count,
  t.member_count,
  t.jumlah_anggota as max_members,
  (t.member_count / t.jumlah_anggota * 100) as fill_percentage,
  RANK() OVER (ORDER BY t.view_count DESC) as popularity_rank,
  RANK() OVER (ORDER BY (t.member_count / t.jumlah_anggota) DESC) as fill_rank,
  t.status
FROM tim t
WHERE t.status IN ('aktif', 'penuh')
ORDER BY popularity_rank;

-- View 5: Forum Activity Statistics
CREATE VIEW forum_statistics AS
SELECT 
  f.forum_id,
  f.kategori,
  f.pesan,
  u.fullname as author,
  f.view_count,
  f.reply_count,
  f.waktu_postingan,
  RANK() OVER (PARTITION BY f.kategori ORDER BY f.reply_count DESC) as category_rank,
  RANK() OVER (ORDER BY (f.view_count + f.reply_count * 2) DESC) as overall_rank
FROM forum f
JOIN users u ON f.user_id = u.user_id
WHERE f.parent_id IS NULL
ORDER BY overall_rank;

-- --------------------------------------------------------

--
-- AUTO_INCREMENT SETTINGS
--

ALTER TABLE `activity_log`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `anggota_tim`
MODIFY `anggota_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `beasiswa`
MODIFY `beasiswa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

ALTER TABLE `bookmarks`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `forum`
MODIFY `forum_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

ALTER TABLE `lomba`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `notifikasi`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `tim`
MODIFY `tim_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

ALTER TABLE `users`
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

ALTER TABLE `user_sessions`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

-- --------------------------------------------------------

--
-- FOREIGN KEY CONSTRAINTS
--

ALTER TABLE `activity_log`
ADD CONSTRAINT `fk_activity_log_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE;

ALTER TABLE `anggota_tim`
ADD CONSTRAINT `fk_anggota_tim_tim` FOREIGN KEY (`tim_id`) REFERENCES `tim` (`tim_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `fk_anggota_tim_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `bookmarks`
ADD CONSTRAINT `bookmarks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

ALTER TABLE `forum`
  ADD CONSTRAINT `fk_forum_parent` FOREIGN KEY (`parent_id`) REFERENCES `forum` (`forum_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_forum_to_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE;

ALTER TABLE `notifikasi`
  ADD CONSTRAINT `fk_notifikasi_dari_user` FOREIGN KEY (`dari_user_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_notifikasi_tim` FOREIGN KEY (`terkait_tim_id`) REFERENCES `tim` (`tim_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_notifikasi_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `tim`
  ADD CONSTRAINT `fk_tim_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE;

ALTER TABLE `user_sessions`
  ADD CONSTRAINT `user_sessions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

-- --------------------------------------------------------

--
-- SAMPLE QUERIES DEMONSTRATING ADVANCED FEATURES
--

-- Query 1: Get Top 10 Users by Activity Score with Ranking
/*
SELECT 
    user_rank,
    fullname,
    activity_score,
    forum_posts,
    teams_created,
    bookmarks_count
FROM user_ranking 
LIMIT 10;
*/

-- Query 2: Get Popular Scholarships with Days Until Deadline
/*
SELECT 
    judul_beasiswa,
    lokasi_beasiswa,
    popularity_rank,
    popularity_score,
    DaysUntilDeadline(penutupan_beasiswa) as days_left,
    status
FROM popular_beasiswa 
WHERE status != 'Expired'
ORDER BY popularity_rank
LIMIT 5;
*/

-- Query 3: Get Team Statistics with Fill Percentage
/*
SELECT 
    nama_tim,
    kategori_lomba,
    CONCAT(member_count, '/', max_members) as members,
    ROUND(fill_percentage, 1) as fill_percent,
    popularity_rank,
    status
FROM team_ranking
WHERE status = 'aktif'
ORDER BY fill_percentage DESC;
*/

-- Query 4: Monthly Activity Report
/*
CALL GenerateMonthlyReport(6, 2025);
*/

-- Query 5: Check Scholarship Age and Status
/*
SELECT 
    judul_beasiswa,
    CalculateScholarshipAge(mulai_beasiswa) as days_since_start,
    DaysUntilDeadline(penutupan_beasiswa) as days_until_deadline,
    CASE 
        WHEN DaysUntilDeadline(penutupan_beasiswa) = 0 THEN 'EXPIRED'
        WHEN DaysUntilDeadline(penutupan_beasiswa) <= 7 THEN 'CLOSING SOON'
        ELSE 'ACTIVE'
    END as status
FROM beasiswa
ORDER BY days_until_deadline;
*/

-- --------------------------------------------------------

--
-- INDEXES FOR PERFORMANCE OPTIMIZATION
--

CREATE INDEX idx_beasiswa_deadline ON beasiswa(penutupan_beasiswa);
CREATE INDEX idx_beasiswa_popularity ON beasiswa(view_count, bookmark_count);
CREATE INDEX idx_lomba_deadline ON lomba(deadline);
CREATE INDEX idx_lomba_popularity ON lomba(view_count, bookmark_count, participant_count);
CREATE INDEX idx_forum_category ON forum(kategori);
CREATE INDEX idx_forum_popularity ON forum(view_count, reply_count);
CREATE INDEX idx_tim_status ON tim(status);
CREATE INDEX idx_users_activity ON users(activity_score);
CREATE INDEX idx_users_role ON users(role);
CREATE INDEX idx_notifikasi_status ON notifikasi(status_baca);
CREATE INDEX idx_activity_log_type_date ON activity_log(activity_type, created_at);

-- --------------------------------------------------------

--
-- EVENTS FOR AUTOMATED MAINTENANCE
--

DELIMITER //

-- Event 1: Daily cleanup of expired items
CREATE EVENT IF NOT EXISTS daily_cleanup
ON SCHEDULE EVERY 1 DAY
STARTS CURRENT_TIMESTAMP
DO
BEGIN
    CALL UpdateExpiredItems();
    CALL CleanOldSessions();
END //

-- Event 2: Weekly ranking update
CREATE EVENT IF NOT EXISTS weekly_ranking_update
ON SCHEDULE EVERY 1 WEEK
STARTS CURRENT_TIMESTAMP
DO
BEGIN
    CALL UpdateUserRankings();
END //

DELIMITER ;

-- Enable event scheduler
SET GLOBAL event_scheduler = ON;

-- --------------------------------------------------------

--
-- SAMPLE DATA FOR TESTING ADVANCED FEATURES
--

-- Insert sample activity logs
INSERT INTO `activity_log` (`user_id`, `activity_type`, `description`, `ip_address`, `created_at`) VALUES
(1, 'login', 'Admin login from dashboard', '127.0.0.1', '2025-06-18 10:30:00'),
(2, 'view_beasiswa', 'Viewed LPDP Scholarship', '127.0.0.1', '2025-06-18 11:15:00'),
(2, 'bookmark', 'Bookmarked Fulbright Program', '127.0.0.1', '2025-06-18 11:20:00'),
(3, 'create_team', 'Created new team for AI Competition', '127.0.0.1', '2025-06-18 09:45:00'),
(3, 'forum_post', 'Posted question about scholarship requirements', '127.0.0.1', '2025-06-18 10:00:00');

-- Insert sample bookmarks to test triggers
INSERT INTO `bookmarks` (`user_id`, `item_type`, `item_id`) VALUES
(2, 'beasiswa', 1),
(2, 'beasiswa', 3),
(2, 'lomba', 1),
(3, 'beasiswa', 5),
(3, 'lomba', 2);

-- --------------------------------------------------------

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
