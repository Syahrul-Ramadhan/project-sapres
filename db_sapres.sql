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
  PRIMARY KEY (`beasiswa_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `beasiswa`
--

INSERT INTO `beasiswa` (`beasiswa_id`, `judul_beasiswa`, `jenjang_beasiswa`, `mulai_beasiswa`, `penutupan_beasiswa`, `pemberi_beasiswa`, `asal_instansi`, `tipe_pendanaan`, `benefit_beasiswa`, `syarat_beasiswa`, `booklet_beasiswa`, `lokasi_beasiswa`, `daftar_beasiswa`) VALUES
(1, 'Beasiswa Unggulan Kemendikbud', 'S1,S2', '2025-01-01', '2025-03-31', 'Kemendikbud', 'Semua instansi', 'Fully Funded', 'Uang kuliah, biaya hidup, tunjangan buku', 'Warga negara Indonesia, IPK min 3.0', 'booklet_unggulan.pdf', 'Indonesia', 'https://beasiswa.kemdikbud.go.id'),
(2, 'Swedish Institute Scholarships', 'S2,S3', '2025-09-01', '2025-12-01', 'Swedish Institute', 'Sweden', 'Fully Funded', 'Biaya kuliah, tunjangan hidup, tiket pesawat pulang pergi', 'IPK min 3.0, WNI, usia max 30 tahun', 'swedish_institute.pdf', 'Sweden', 'https://www.si.se/en/apply/scholarships/'),
(3, 'Fulbright Foreign Student Program', 'S2,S3', '2025-01-01', '2025-05-01', 'Fulbright Program', 'USA', 'Fully Funded', 'Biaya kuliah, tunjangan hidup, asuransi kesehatan', 'WNI, IPK min 3.0, TOEFL min 550', 'fulbright.pdf', 'USA', 'https://foreign.fulbrightonline.org/'),
(4, 'Chevening Scholarships', 'S2', '2025-06-01', '2025-11-01', 'Chevening Secretariat', 'United Kingdom', 'Fully Funded', 'Biaya kuliah, biaya hidup, tiket pesawat', 'IPK min 3.0, pengalaman kerja minimal 2 tahun', 'chevening.pdf', 'United Kingdom', 'https://www.chevening.org/'),
(5, 'LPDP Scholarship', 'S1,S2,S3', '2025-05-01', '2025-08-01', 'LPDP', 'Indonesia', 'Fully Funded', 'Biaya kuliah, biaya hidup, tunjangan penelitian', 'WNI, tidak sedang menerima beasiswa lain', 'lpdp.pdf', 'Indonesia', 'https://www.lpdp.kemenkeu.go.id/'),
(6, 'DAAD Scholarship', 'S1,S2,S3', '2025-04-01', '2025-09-01', 'DAAD', 'Germany', 'Fully Funded', 'Biaya kuliah, akomodasi, tunjangan hidup', 'IPK min 3.0, wawancara', 'daad.pdf', 'Germany', 'https://www.daad.de/en/');

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
  PRIMARY KEY (`forum_id`),
  KEY `user_id` (`user_id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `forum`
--

INSERT INTO `forum` (`forum_id`, `user_id`, `kategori`, `pesan`, `id_penanya`, `parent_id`, `tanggal_pesan`, `waktu_postingan`) VALUES
(84, 1, 'umum', 'Halo semua, admin disini', 1, NULL, '2025-06-17', '2025-06-17 05:38:02'),
(86, 1, 'cari tim', 'aku butuh tim yang ahli dalam pemrograman web', 1, NULL, '2025-06-17', '2025-06-17 05:39:48'),
(89, 2, NULL, 'saya bang', 1, 86, NULL, '2025-06-18 02:52:56'),
(90, 4, 'cari tim', 'anda bisa mencari atau membuat tim anda dengan fitur cari tim dari sapres', 4, NULL, '2025-06-18', '2025-06-18 03:22:35'),
(91, 4, NULL, 'iyakah', NULL, 84, NULL, '2025-06-18 03:25:28');

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
  PRIMARY KEY (`id`),
  KEY `idx_deadline` (`deadline`),
  KEY `idx_level` (`level`),
  KEY `idx_scope` (`scope`),
  KEY `idx_is_active` (`is_active`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `lomba`
--

INSERT INTO `lomba` (`id`, `title`, `cost`, `organizer`, `description`, `requirements`, `prizes`, `deadline`, `start_date`, `level`, `category`, `scope`, `image_url`, `image_path`, `external_url`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Business Case Competition IYREF 2025', 'Gratis', 'SRE ITB', 'Kompetisi analisis kasus bisnis tingkat nasional', 'Mahasiswa aktif D3/D4/S1, Tim 3-4 orang', 'Juara 1: 15 juta, Juara 2: 10 juta, Juara 3: 5 juta', '2025-03-23', '2025-03-06', 'S1', 'Bisnis', 'Nasional', 'bcc-iyref.jpg', NULL, 'https://iyref.com', 1, '2025-06-15 11:14:57', '2025-06-15 11:14:57'),
(2, 'AI Competition Microsoft', 'Gratis', 'Microsoft Indonesia', 'Kompetisi kecerdasan buatan tingkat nasional', 'Mahasiswa aktif, Kemampuan programming', 'Juara 1: 20 juta, Juara 2: 15 juta, Juara 3: 10 juta', '2025-04-15', '2025-03-25', 'S1', 'Teknologi', 'Nasional', 'ai-microsoft.jpg', NULL, 'https://microsoft.com/competition', 1, '2025-06-15 11:14:57', '2025-06-15 11:14:57');

-- --------------------------------------------------------

--
-- Struktur dari tabel `notifikasi`
--

CREATE TABLE `notifikasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `tipe` enum('permintaan_bergabung','diterima','ditolak') COLLATE utf8mb4_general_ci NOT NULL,
  `pesan` text COLLATE utf8mb4_general_ci,
  `terkait_tim_id` int(11) DEFAULT NULL,
  `dari_user_id` int(11) DEFAULT NULL,
  `status_baca` enum('belum_dibaca','dibaca') COLLATE utf8mb4_general_ci DEFAULT 'belum_dibaca',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `terkait_tim_id` (`terkait_tim_id`),
  KEY `dari_user_id` (`dari_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  PRIMARY KEY (`tim_id`),
  KEY `fk_tim_user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tim`
--

INSERT INTO `tim` (`tim_id`, `nama_tim`, `jumlah_anggota`, `jenjang_tim`, `kategori_lomba`, `judul_lomba`, `asal_instansi`, `deskripsi`, `syarat_ketentuan`, `cek_ktm`, `link`, `created_at`, `user_id`) VALUES
(1, 'Tim Pahlawan', 3, 'S1', 'Robotika', 'Lomba Robot Cerdas', 'Universitas Indonesia', 'Tim dari Universitas Indonesia yang mengembangkan robot untuk tugas-tugas cerdas.', 'Harus dapat merakit robot dalam waktu 6 jam.|bisa berbahasa inggris.|paham coding', 'perlu_ktm', '', '2025-06-10 01:30:00', NULL),
(2, 'Tim Akselerasi', 3, 'S1', 'Coding', 'Lomba Koding Cepat', 'Institut Teknologi Bandung', 'Tim pengembang aplikasi yang berkompetisi dalam pemrograman software.', 'Menguasai Python dan JavaScript.', 'tidak_perlu_ktm', '', '2025-06-07 07:15:00', NULL),
(3, 'Team Giga', 3, 'S1', 'Esports', 'Lomba Game League', 'Universitas Bina Nusantara', 'Tim gamer dari Universitas Bina Nusantara yang siap menghadapi kompetisi game online.', 'Harus bisa bermain League of Legends.', 'perlu_ktm', '', '2025-06-01 02:00:00', NULL),
(4, 'Tim Inovasi', 3, 'S1', 'Sains', 'Lomba Penemuan Ilmiah', 'Universitas Gadjah Mada', 'Tim riset yang fokus pada pengembangan teknologi baru dalam bidang ilmu pengetahuan.', 'Harus memiliki produk ilmiah yang inovatif.', 'tidak_perlu_ktm', '', '2025-06-03 04:30:00', NULL),
(5, 'Tim Creators', 3, 'S1', 'Desain', 'Lomba Desain Grafis', 'Universitas Pelita Harapan', 'Tim desain grafis yang berkompetisi dalam menciptakan visual yang menarik.', 'Harus menguasai Adobe Photoshop dan Illustrator.', 'perlu_ktm', '', '2025-06-05 03:20:00', NULL),
(6, 'Tim Elang', 3, 'S1', 'Debat', 'Lomba Debat Nasional', 'Universitas Airlangga', 'Tim debat yang berkompetisi dalam forum internasional di bidang politik dan ekonomi.', 'Harus bisa berbicara dengan percaya diri tanpa teks.', 'tidak_perlu_ktm', '', '2025-06-04 09:45:00', NULL),
(7, 'Tim Pioneers', 3, 'S1', 'Matematika', 'Lomba Matematika Terapan', 'Politeknik Negeri Jakarta', 'Tim matematika yang berbakat dalam memecahkan persoalan-persoalan rumit.', 'Harus menguasai kalkulus dan aljabar.', 'perlu_ktm', '', '2025-06-02 06:00:00', NULL),
(8, 'Tim NextGen', 3, 'S1', 'Musik', 'Lomba Musik Modern', 'Institut Seni Indonesia Yogyakarta', 'Tim musisi yang berkompetisi dalam lomba memainkan musik modern dengan alat musik elektronik.', 'Harus bisa memainkan alat musik elektronik dan gitar.', 'tidak_perlu_ktm', '', '2025-06-08 10:00:00', NULL),
(9, 'Tim Vision', 3, 'S1', 'Teknologi', 'Lomba Pengembangan Aplikasi', 'Universitas Diponegoro', 'Tim yang mengembangkan aplikasi untuk membantu kehidupan sehari-hari.', 'Menguasai Android Studio atau Swift untuk iOS.', 'perlu_ktm', '', '2025-06-09 05:10:00', NULL),
(10, 'Tim Merah Putih', 3, 'SMA,S1', 'Sosial', 'Lomba Pengabdian Masyarakat', 'Universitas Negeri Surabaya', 'Tim yang fokus pada kegiatan pengabdian masyarakat dan perbaikan sosial.', 'Harus memiliki pengalaman dalam proyek sosial.', 'tidak_perlu_ktm', '', '2025-06-06 08:30:00', NULL),
(11, 'Tim Juara', 4, 'S1', 'Filsafat', 'Lomba Filosofi Kehidupan', 'Universitas Kristen Satya Wacana', 'Tim yang memiliki pemahaman filosofi dan mampu berargumen dengan baik.', 'Harus mempersiapkan argumen terkait tema yang diberikan.', 'perlu_ktm', '', '2025-01-01 03:00:00', NULL),
(12, 'Tim Spectrum', 4, 'S1', 'Kimia', 'Lomba Eksperimen Kimia', 'Universitas Sebelas Maret', 'Tim kimia yang berkompetisi dalam eksperimen kimia yang menarik dan aman.', 'Harus dapat mengatur eksperimen dengan prosedur yang benar.', 'tidak_perlu_ktm', '', '2025-01-01 03:00:00', NULL),
(13, 'Tim Dynamo', 4, 'S1', 'Teknik', 'Lomba Rancang Bangun Alat', 'Politeknik Negeri Bandung', 'Tim yang membuat dan mengembangkan alat teknologi untuk efisiensi industri.', 'Harus membawa prototipe alat yang dirancang.', 'perlu_ktm', '', '2025-01-01 03:00:00', NULL),
(14, 'Tim Prodigy', 4, 'S1', 'Fotografi', 'Lomba Fotografi Alam', 'Sekolah Tinggi Seni Rupa Bandung', 'Tim fotografi yang ahli dalam menangkap keindahan alam dan pemandangan.', 'Harus membawa kamera DSLR atau mirrorless.', 'tidak_perlu_ktm', '', '2025-01-01 03:00:00', NULL),
(15, 'Tim Katalis', 2, 'S1', 'Jurnalisme', 'Lomba Menulis Esai', 'Universitas Muhammadiyah Malang', 'Tim penulis yang membuat esai dengan topik kebijakan publik dan sosial.', 'Esai harus mengandung ide segar dan pemikiran yang mendalam.', 'perlu_ktm', '', '2025-01-01 03:00:00', NULL),
(16, 'Tim Duta', 2, 'S1', 'Biodiversitas', 'Lomba Keanekaragaman Hayati', 'Universitas Negeri Malang', 'Tim ilmuwan yang memfokuskan pada pelestarian dan konservasi alam.', 'Harus memiliki pengetahuan mengenai flora dan fauna lokal.', 'tidak_perlu_ktm', '', '2025-01-01 03:00:00', NULL),
(21, 'creator', 3, 'S1,S2', 'UI/UX Design', 'TechFest 2025', 'Universitas Indonesia', 'mencari tim yang memiliki kemampuan dalam desain ui/ux', 'paham UI/UX | mahasiswa UPI | angkatan 23/24', 'perlu_ktm', 'https://chat.whatsapp.com/HrjBEYsUNj8EtkfQIz53ZE', '2025-06-15 06:15:16', NULL),
(25, 'Tim Alpha', 4, 'S1', 'Programming', 'Hackathon 2025', 'Universitas Teknologi', 'Tim programming yang berfokus pada pengembangan aplikasi web dan mobile', 'Menguasai JavaScript, Python, atau Java | Pengalaman minimal 1 tahun | Mampu bekerja dalam tim', 'perlu_ktm', 'https://chat.whatsapp.com/example123', '2025-06-18 10:44:26', 2);

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
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`user_id`, `fullname`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Syahrul Ramadhan', 'syahrulramadhansr00@gmail.com', '$2y$10$WEVipCxKls6punOsW1eWl.lxvqQrtTd5NjCmAu6jPfnD6cqGJ2I0m', 'admin', '2025-06-15 07:28:14', '2025-06-18 03:21:47'),
(2, 'John Doe', 'john.doe@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', '2025-06-18 10:44:26', '2025-06-18 10:44:26'),
(3, 'Jane Smith', 'jane.smith@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', '2025-06-18 10:44:26', '2025-06-18 10:44:26'),
(4, 'Admin Sapres', 'admin@sapres.com', '$2y$10$WEVipCxKls6punOsW1eWl.lxvqQrtTd5NjCmAu6jPfnD6cqGJ2I0m', 'admin', '2025-06-18 03:21:47', '2025-06-18 03:21:47');

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

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `anggota_tim`
--
ALTER TABLE `anggota_tim`
  MODIFY `anggota_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `beasiswa`
--
ALTER TABLE `beasiswa`
  MODIFY `beasiswa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `bookmarks`
--
ALTER TABLE `bookmarks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `forum`
--
ALTER TABLE `forum`
  MODIFY `forum_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT untuk tabel `lomba`
--
ALTER TABLE `lomba`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tim`
--
ALTER TABLE `tim`
  MODIFY `tim_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `user_sessions`
--
ALTER TABLE `user_sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `anggota_tim`
--
ALTER TABLE `anggota_tim`
  ADD CONSTRAINT `fk_anggota_tim_tim` FOREIGN KEY (`tim_id`) REFERENCES `tim` (`tim_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_anggota_tim_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `bookmarks`
--
ALTER TABLE `bookmarks`
  ADD CONSTRAINT `bookmarks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `forum`
--
ALTER TABLE `forum`
  ADD CONSTRAINT `fk_forum_parent` FOREIGN KEY (`parent_id`) REFERENCES `forum` (`forum_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_forum_to_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD CONSTRAINT `fk_notifikasi_dari_user` FOREIGN KEY (`dari_user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_notifikasi_tim` FOREIGN KEY (`terkait_tim_id`) REFERENCES `tim` (`tim_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_notifikasi_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tim`
--
ALTER TABLE `tim`
  ADD CONSTRAINT `fk_tim_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `user_sessions`
--
ALTER TABLE `user_sessions`
  ADD CONSTRAINT `user_sessions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
--