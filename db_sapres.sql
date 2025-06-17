-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2025 at 07:40 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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
-- Table structure for table `beasiswa`
--

CREATE TABLE `beasiswa` (
  `beasiswa_id` int(11) NOT NULL,
  `judul_beasiswa` varchar(100) DEFAULT NULL,
  `jenjang_beasiswa` set('SMP','SMA','S1','S2','S3','D3','D4','Non-degree','Gap-year','Profesi') DEFAULT NULL,
  `mulai_beasiswa` date DEFAULT NULL,
  `penutupan_beasiswa` date DEFAULT NULL,
  `pemberi_beasiswa` varchar(50) DEFAULT NULL,
  `asal_instansi` varchar(500) DEFAULT NULL,
  `tipe_pendanaan` set('Fully Funded','Partially Funded') DEFAULT NULL,
  `benefit_beasiswa` text DEFAULT NULL,
  `syarat_beasiswa` text DEFAULT NULL,
  `booklet_beasiswa` varchar(50) DEFAULT NULL,
  `lokasi_beasiswa` varchar(50) DEFAULT NULL,
  `daftar_beasiswa` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `beasiswa`
--

INSERT INTO `beasiswa` (`beasiswa_id`, `judul_beasiswa`, `jenjang_beasiswa`, `mulai_beasiswa`, `penutupan_beasiswa`, `pemberi_beasiswa`, `asal_instansi`, `tipe_pendanaan`, `benefit_beasiswa`, `syarat_beasiswa`, `booklet_beasiswa`, `lokasi_beasiswa`, `daftar_beasiswa`) VALUES
(1, 'Beasiswa Unggulan Kemendikbud', 'S1,S2', '2025-01-01', '2025-03-31', 'Kemendikbud', 'Semua instansi', 'Fully Funded', 'Uang kuliah. biaya hidup. tunjangan buku.', 'Warga negara Indonesia, IPK min 3.0', 'booklet_unggulan.pdf', 'Indonesia', 'https://beasiswa.kemdikbud.go.id'),
(2, 'Beasiswa Unggulan Kemendikbud', 'S1,S2', '2025-01-01', '2025-03-31', 'Kemendikbud', 'Semua instansi', 'Fully Funded', 'Uang kuliah, biaya hidup, tunjangan buku', 'Warga negara Indonesia, IPK min 3.0', 'booklet_unggulan.pdf', 'Indonesia', 'https://beasiswa.kemdikbud.go.id'),
(3, 'Swedish Institute Scholarships', 'S2,S3', '2025-09-01', '2025-12-01', 'Swedish Institute', 'Sweden', 'Fully Funded', 'Biaya kuliah, tunjangan hidup, tiket pesawat pulang pergi', 'IPK min 3.0, WNI, usia max 30 tahun', 'swedish_institute.pdf', 'Sweden', 'https://www.si.se/en/apply/scholarships/'),
(4, 'Fulbright Foreign Student Program', 'S2,S3', '2025-01-01', '2025-05-01', 'Fulbright Program', 'USA', 'Fully Funded', 'Biaya kuliah, tunjangan hidup, asuransi kesehatan', 'WNI, IPK min 3.0, TOEFL min 550', 'fulbright.pdf', 'USA', 'https://foreign.fulbrightonline.org/'),
(5, 'Chevening Scholarships', 'S2', '2025-06-01', '2025-11-01', 'Chevening Secretariat', 'United Kingdom', 'Fully Funded', 'Biaya kuliah, biaya hidup, tiket pesawat', 'IPK min 3.0, pengalaman kerja minimal 2 tahun', 'chevening.pdf', 'United Kingdom', 'https://www.chevening.org/'),
(6, 'LPDP Scholarship', 'S1,S2,S3', '2025-05-01', '2025-08-01', 'LPDP', 'Indonesia', 'Fully Funded', 'Biaya kuliah, biaya hidup, tunjangan penelitian', 'WNI, tidak sedang menerima beasiswa lain', 'lpdp.pdf', 'Indonesia', 'https://www.lpdp.kemenkeu.go.id/'),
(7, 'DAAD Scholarship', 'S1,S2,S3', '2025-04-01', '2025-09-01', 'DAAD', 'Germany', 'Fully Funded', 'Biaya kuliah, akomodasi, tunjangan hidup', 'IPK min 3.0, wawancara', 'daad.pdf', 'Germany', 'https://www.daad.de/en/');

-- --------------------------------------------------------

--
-- Table structure for table `bookmarks`
--

CREATE TABLE `bookmarks` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_type` enum('beasiswa','lomba') NOT NULL,
  `item_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `forum`
--

CREATE TABLE `forum` (
  `forum_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `kategori` enum('lomba','beasiswa','cari tim','umum') DEFAULT NULL,
  `pesan` varchar(100) DEFAULT NULL,
  `id_penanya` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `tanggal_pesan` date DEFAULT NULL,
  `waktu_postingan` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `forum`
--

INSERT INTO `forum` (`forum_id`, `user_id`, `kategori`, `pesan`, `id_penanya`, `parent_id`, `tanggal_pesan`, `waktu_postingan`) VALUES
(84, 1, 'umum', 'Halo semua, admin disini', 1, NULL, '2025-06-17', '2025-06-17 05:38:02'),
(86, 1, 'cari tim', 'aku butuh tim yang ahli dalam pemrograman web', 1, NULL, '2025-06-17', '2025-06-17 05:39:48');

-- --------------------------------------------------------

--
-- Table structure for table `lomba`
--

CREATE TABLE `lomba` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `cost` varchar(100) NOT NULL,
  `organizer` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `requirements` text DEFAULT NULL,
  `prizes` text DEFAULT NULL,
  `deadline` date NOT NULL,
  `start_date` date NOT NULL,
  `level` enum('D3','D4','S1','S2','S3') NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `scope` enum('Lokal','Regional','Nasional','Internasional') DEFAULT 'Nasional',
  `image_url` varchar(255) DEFAULT NULL,
  `external_url` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lomba`
--

INSERT INTO `lomba` (`id`, `title`, `cost`, `organizer`, `description`, `requirements`, `prizes`, `deadline`, `start_date`, `level`, `category`, `scope`, `image_url`, `external_url`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Business Case Competition IYREF 2025', '', 'SRE ITB', 'Kompetisi analisis kasus bisnis tingkat nasional', 'Mahasiswa aktif D3/D4/S1, Tim 3-4 orang', 'Juara 1: 15 juta, Juara 2: 10 juta, Juara 3: 5 juta', '2025-03-23', '2025-03-06', 'S1', 'Bisnis', 'Nasional', 'bcc-iyref.jpg', 'https://iyref.com', 1, '2025-06-15 11:14:57', '2025-06-15 11:14:57'),
(2, 'AI Competition Microsoft', '', 'Microsoft Indonesia', 'Kompetisi kecerdasan buatan tingkat nasional', 'Mahasiswa aktif, Kemampuan programming', 'Juara 1: 20 juta, Juara 2: 15 juta, Juara 3: 10 juta', '2025-04-15', '2025-03-25', 'S1', 'Teknologi', 'Nasional', 'ai-microsoft.jpg', 'https://microsoft.com/competition', 1, '2025-06-15 11:14:57', '2025-06-15 11:14:57'),
(3, 'Hackathon Garuda Cyber', '', 'Garuda Cyber', 'Kompetisi pengembangan aplikasi cybersecurity', 'Tim 2-5 orang, Mahasiswa/Fresh graduate', 'Total hadiah 100 juta rupiah', '2025-05-30', '2025-05-01', 'S1', 'Cybersecurity', 'Nasional', 'hackathon-garuda.jpg', 'https://garudacyber.co.id', 1, '2025-06-15 11:14:57', '2025-06-15 11:14:57'),
(4, 'Gemastik 2025', '', 'Puskomedia', 'Pagelaran Mahasiswa Nasional bidang TIK', 'Mahasiswa aktif, Tim maksimal 3 orang', 'Juara 1: 25 juta, Juara 2: 15 juta, Juara 3: 10 juta', '2025-06-15', '2025-04-01', 'S1', 'Teknologi', 'Nasional', 'gemastik.jpg', 'https://gemastik.kemdikbud.go.id', 1, '2025-06-15 11:14:57', '2025-06-15 11:14:57'),
(5, 'LKTI Nasional UGM', '', 'UGM', 'Lomba Karya Tulis Ilmiah tingkat nasional', 'Mahasiswa aktif, Tim 2-3 orang', 'Juara 1: 10 juta, Juara 2: 7 juta, Juara 3: 5 juta', '2025-04-30', '2025-03-01', 'S1', 'Penelitian', 'Nasional', 'lkti-ugm.jpg', 'https://ugm.ac.id', 1, '2025-06-15 11:14:57', '2025-06-15 11:14:57'),
(6, 'Startup Competition Telkom', '', 'Telkom Indonesia', 'Kompetisi startup untuk mahasiswa', 'Tim 3-5 orang, Ide bisnis teknologi', 'Juara 1: 50 juta, Juara 2: 30 juta, Juara 3: 20 juta', '2025-07-31', '2025-06-01', 'S1', 'Startup', 'Nasional', 'startup-telkom.jpg', 'https://telkom.co.id', 1, '2025-06-15 11:14:57', '2025-06-15 11:14:57'),
(7, 'Design Competition Adobe', '', 'Adobe Indonesia', 'Kompetisi desain grafis dan UI/UX', 'Mahasiswa/Fresh graduate, Portfolio design', 'Juara 1: 15 juta, Software license, Internship', '2025-05-15', '2025-04-01', 'S1', 'Desain', 'Nasional', 'adobe-design.jpg', 'https://adobe.com/id', 1, '2025-06-15 11:14:57', '2025-06-15 11:14:57'),
(8, 'Data Science Challenge Shopee', '', 'Shopee Indonesia', 'Kompetisi analisis data dan machine learning', 'Tim 1-4 orang, Background data science/IT', 'Juara 1: 30 juta, Job opportunity, Mentoring', '2025-08-31', '2025-07-01', 'S1', 'Data Science', 'Nasional', 'shopee-datascience.jpg', 'https://shopee.co.id', 1, '2025-06-15 11:14:57', '2025-06-15 11:14:57');

-- --------------------------------------------------------

--
-- Table structure for table `tim`
--

CREATE TABLE `tim` (
  `tim_id` int(11) NOT NULL,
  `nama_tim` varchar(25) NOT NULL,
  `jumlah_anggota` int(11) NOT NULL,
  `jenjang_tim` set('SMP','SMA','S1','S2','S3','D3','D4','Non-degree','Gap-year','Profesi') NOT NULL,
  `kategori_lomba` varchar(50) DEFAULT NULL,
  `judul_lomba` varchar(50) DEFAULT NULL,
  `asal_instansi` varchar(50) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `syarat_ketentuan` text DEFAULT NULL,
  `cek_ktm` enum('perlu_ktm','tidak_perlu_ktm') NOT NULL,
  `link` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tim`
--

INSERT INTO `tim` (`tim_id`, `nama_tim`, `jumlah_anggota`, `jenjang_tim`, `kategori_lomba`, `judul_lomba`, `asal_instansi`, `deskripsi`, `syarat_ketentuan`, `cek_ktm`, `link`, `created_at`) VALUES
(1, 'Tim Pahlawan', 3, 'S1', 'Robotika', 'Lomba Robot Cerdas', 'Universitas Indonesia', 'Tim dari Universitas Indonesia yang mengembangkan robot untuk tugas-tugas cerdas.', 'Harus dapat merakit robot dalam waktu 6 jam.|bisa berbahasa inggris.|paham coding', 'perlu_ktm', '', '2025-06-10 01:30:00'),
(2, 'Tim Akselerasi', 3, 'S1', 'Coding', 'Lomba Koding Cepat', 'Institut Teknologi Bandung', 'Tim pengembang aplikasi yang berkompetisi dalam pemrograman software.', 'Menguasai Python dan JavaScript.', 'tidak_perlu_ktm', '', '2025-06-07 07:15:00'),
(3, 'Team Giga', 3, 'S1', 'Esports', 'Lomba Game League', 'Universitas Bina Nusantara', 'Tim gamer dari Universitas Bina Nusantara yang siap menghadapi kompetisi game online.', 'Harus bisa bermain League of Legends.', 'perlu_ktm', '', '2025-06-01 02:00:00'),
(4, 'Tim Inovasi', 3, 'S1', 'Sains', 'Lomba Penemuan Ilmiah', 'Universitas Gadjah Mada', 'Tim riset yang fokus pada pengembangan teknologi baru dalam bidang ilmu pengetahuan.', 'Harus memiliki produk ilmiah yang inovatif.', 'tidak_perlu_ktm', '', '2025-06-03 04:30:00'),
(5, 'Tim Creators', 3, 'S1', 'Desain', 'Lomba Desain Grafis', 'Universitas Pelita Harapan', 'Tim desain grafis yang berkompetisi dalam menciptakan visual yang menarik.', 'Harus menguasai Adobe Photoshop dan Illustrator.', 'perlu_ktm', '', '2025-06-05 03:20:00'),
(6, 'Tim Elang', 3, 'S1', 'Debat', 'Lomba Debat Nasional', 'Universitas Airlangga', 'Tim debat yang berkompetisi dalam forum internasional di bidang politik dan ekonomi.', 'Harus bisa berbicara dengan percaya diri tanpa teks.', 'tidak_perlu_ktm', '', '2025-06-04 09:45:00'),
(7, 'Tim Pioneers', 3, 'S1', 'Matematika', 'Lomba Matematika Terapan', 'Politeknik Negeri Jakarta', 'Tim matematika yang berbakat dalam memecahkan persoalan-persoalan rumit.', 'Harus menguasai kalkulus dan aljabar.', 'perlu_ktm', '', '2025-06-02 06:00:00'),
(8, 'Tim NextGen', 3, 'S1', 'Musik', 'Lomba Musik Modern', 'Institut Seni Indonesia Yogyakarta', 'Tim musisi yang berkompetisi dalam lomba memainkan musik modern dengan alat musik elektronik.', 'Harus bisa memainkan alat musik elektronik dan gitar.', 'tidak_perlu_ktm', '', '2025-06-08 10:00:00'),
(9, 'Tim Vision', 3, 'S1', 'Teknologi', 'Lomba Pengembangan Aplikasi', 'Universitas Diponegoro', 'Tim yang mengembangkan aplikasi untuk membantu kehidupan sehari-hari.', 'Menguasai Android Studio atau Swift untuk iOS.', 'perlu_ktm', '', '2025-06-09 05:10:00'),
(10, 'Tim Merah Putih', 3, 'SMA,S1', 'Sosial', 'Lomba Pengabdian Masyarakat', 'Universitas Negeri Surabaya', 'Tim yang fokus pada kegiatan pengabdian masyarakat dan perbaikan sosial.', 'Harus memiliki pengalaman dalam proyek sosial.', 'tidak_perlu_ktm', '', '2025-06-06 08:30:00'),
(11, 'Tim Juara', 4, 'S1', 'Filsafat', 'Lomba Filosofi Kehidupan', 'Universitas Kristen Satya Wacana', 'Tim yang memiliki pemahaman filosofi dan mampu berargumen dengan baik.', 'Harus mempersiapkan argumen terkait tema yang diberikan.', 'perlu_ktm', '', '2025-01-01 03:00:00'),
(12, 'Tim Spectrum', 4, 'S1', 'Kimia', 'Lomba Eksperimen Kimia', 'Universitas Sebelas Maret', 'Tim kimia yang berkompetisi dalam eksperimen kimia yang menarik dan aman.', 'Harus dapat mengatur eksperimen dengan prosedur yang benar.', 'tidak_perlu_ktm', '', '2025-01-01 03:00:00'),
(13, 'Tim Dynamo', 4, 'S1', 'Teknik', 'Lomba Rancang Bangun Alat', 'Politeknik Negeri Bandung', 'Tim yang membuat dan mengembangkan alat teknologi untuk efisiensi industri.', 'Harus membawa prototipe alat yang dirancang.', 'perlu_ktm', '', '2025-01-01 03:00:00'),
(14, 'Tim Prodigy', 4, 'S1', 'Fotografi', 'Lomba Fotografi Alam', 'Sekolah Tinggi Seni Rupa Bandung', 'Tim fotografi yang ahli dalam menangkap keindahan alam dan pemandangan.', 'Harus membawa kamera DSLR atau mirrorless.', 'tidak_perlu_ktm', '', '2025-01-01 03:00:00'),
(15, 'Tim Katalis', 2, 'S1', 'Jurnalisme', 'Lomba Menulis Esai', 'Universitas Muhammadiyah Malang', 'Tim penulis yang membuat esai dengan topik kebijakan publik dan sosial.', 'Esai harus mengandung ide segar dan pemikiran yang mendalam.', 'perlu_ktm', '', '2025-01-01 03:00:00'),
(16, 'Tim Duta', 2, 'S1', 'Biodiversitas', 'Lomba Keanekaragaman Hayati', 'Universitas Negeri Malang', 'Tim ilmuwan yang memfokuskan pada pelestarian dan konservasi alam.', 'Harus memiliki pengetahuan mengenai flora dan fauna lokal.', 'tidak_perlu_ktm', '', '2025-01-01 03:00:00'),
(21, 'creator', 3, 'S1,S2', 'UI/UX Design', 'TechFest 2025', 'Universitas Indonesia', 'mencari tim yang memiliki kemampuan dalam desain ui/ux', 'paham UI/UX | mahasiswa UPI | angkatan 23/24', 'perlu_ktm', 'https://chat.whatsapp.com/HrjBEYsUNj8EtkfQIz53ZE', '2025-06-15 06:15:16');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `fullname`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Syahrul Ramadhan', 'syahrulramadhansr00@gmail.com', '$2y$10$WEVipCxKls6punOsW1eWl.lxvqQrtTd5NjCmAu6jPfnD6cqGJ2I0m', 'user', '2025-06-15 07:28:14', '2025-06-15 07:28:14');

-- --------------------------------------------------------

--
-- Table structure for table `user_sessions`
--

CREATE TABLE `user_sessions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `session_id` varchar(255) NOT NULL,
  `login_time` timestamp NULL DEFAULT current_timestamp(),
  `last_activity` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `beasiswa`
--
ALTER TABLE `beasiswa`
  ADD PRIMARY KEY (`beasiswa_id`);

--
-- Indexes for table `bookmarks`
--
ALTER TABLE `bookmarks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_bookmark` (`user_id`,`item_type`,`item_id`),
  ADD KEY `idx_user_id` (`user_id`),
  ADD KEY `idx_item_type` (`item_type`);

--
-- Indexes for table `forum`
--
ALTER TABLE `forum`
  ADD PRIMARY KEY (`forum_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `lomba`
--
ALTER TABLE `lomba`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_deadline` (`deadline`),
  ADD KEY `idx_level` (`level`),
  ADD KEY `idx_scope` (`scope`),
  ADD KEY `idx_is_active` (`is_active`);

--
-- Indexes for table `tim`
--
ALTER TABLE `tim`
  ADD PRIMARY KEY (`tim_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_sessions`
--
ALTER TABLE `user_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_user_id` (`user_id`),
  ADD KEY `idx_session_id` (`session_id`),
  ADD KEY `idx_is_active` (`is_active`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `beasiswa`
--
ALTER TABLE `beasiswa`
  MODIFY `beasiswa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `bookmarks`
--
ALTER TABLE `bookmarks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `forum`
--
ALTER TABLE `forum`
  MODIFY `forum_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `lomba`
--
ALTER TABLE `lomba`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tim`
--
ALTER TABLE `tim`
  MODIFY `tim_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_sessions`
--
ALTER TABLE `user_sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookmarks`
--
ALTER TABLE `bookmarks`
  ADD CONSTRAINT `bookmarks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `forum`
--
ALTER TABLE `forum`
  ADD CONSTRAINT `fk_forum_to_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `user_sessions`
--
ALTER TABLE `user_sessions`
  ADD CONSTRAINT `user_sessions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
