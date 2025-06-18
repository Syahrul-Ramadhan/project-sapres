-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 18 Jun 2025 pada 11.51
-- Versi server: 8.4.3
-- Versi PHP: 8.3.16

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
  `anggota_id` int NOT NULL,
  `tim_id` int NOT NULL,
  `user_id` int NOT NULL,
  `status` enum('menunggu','diterima','ditolak') DEFAULT 'menunggu',
  `ktm_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  `beasiswa_id` int NOT NULL,
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
  `daftar_beasiswa` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `beasiswa`
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
-- Struktur dari tabel `bookmarks`
--

CREATE TABLE `bookmarks` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `item_type` enum('beasiswa','lomba') COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `bookmarks`
--

INSERT INTO `bookmarks` (`id`, `user_id`, `item_type`, `item_id`, `created_at`) VALUES
(2, 2, 'beasiswa', 6, '2025-06-18 07:05:35'),
(14, 2, 'beasiswa', 7, '2025-06-18 07:32:58'),
(15, 2, 'beasiswa', 5, '2025-06-18 07:35:16'),
(16, 2, 'beasiswa', 4, '2025-06-18 07:46:18'),
(17, 2, 'beasiswa', 3, '2025-06-18 08:16:54');

-- --------------------------------------------------------

--
-- Struktur dari tabel `forum`
--

CREATE TABLE `forum` (
  `forum_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `kategori` enum('lomba','beasiswa','cari tim','umum') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pesan` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_penanya` int DEFAULT NULL,
  `parent_id` int DEFAULT NULL,
  `tanggal_pesan` date DEFAULT NULL,
  `waktu_postingan` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
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
  `id` int NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cost` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `organizer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `requirements` text COLLATE utf8mb4_unicode_ci,
  `prizes` text COLLATE utf8mb4_unicode_ci,
  `deadline` date NOT NULL,
  `start_date` date NOT NULL,
  `level` enum('D3','D4','S1','S2','S3') COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scope` enum('Lokal','Regional','Nasional','Internasional') COLLATE utf8mb4_unicode_ci DEFAULT 'Nasional',
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `external_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `lomba`
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
-- Struktur dari tabel `notifikasi`
--

CREATE TABLE `notifikasi` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `tipe` enum('permintaan_bergabung','diterima','ditolak') NOT NULL,
  `pesan` text,
  `terkait_tim_id` int DEFAULT NULL,
  `dari_user_id` int DEFAULT NULL,
  `status_baca` enum('belum_dibaca','dibaca') DEFAULT 'belum_dibaca',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tim`
--

CREATE TABLE `tim` (
  `tim_id` int NOT NULL,
  `nama_tim` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `ketua_id` int DEFAULT NULL,
  `jumlah_anggota` int NOT NULL,
  `max_anggota` int DEFAULT '5',
  `jenjang_tim` set('SMP','SMA','S1','S2','S3','D3','D4','Non-degree','Gap-year','Profesi') COLLATE utf8mb4_general_ci NOT NULL,
  `kategori_lomba` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `judul_lomba` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `asal_instansi` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `deskripsi` text COLLATE utf8mb4_general_ci,
  `syarat_ketentuan` text COLLATE utf8mb4_general_ci,
  `cek_ktm` enum('perlu_ktm','tidak_perlu_ktm') COLLATE utf8mb4_general_ci NOT NULL,
  `status_tim` enum('terbuka','tertutup') COLLATE utf8mb4_general_ci DEFAULT 'terbuka',
  `link` text COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tim`
--

INSERT INTO `tim` (`tim_id`, `nama_tim`, `ketua_id`, `jumlah_anggota`, `max_anggota`, `jenjang_tim`, `kategori_lomba`, `judul_lomba`, `asal_instansi`, `deskripsi`, `syarat_ketentuan`, `cek_ktm`, `status_tim`, `link`, `created_at`) VALUES
(1, 'Tim Pahlawan', NULL, 3, 5, 'S1', 'Robotika', 'Lomba Robot Cerdas', 'Universitas Indonesia', 'Tim dari Universitas Indonesia yang mengembangkan robot untuk tugas-tugas cerdas.', 'Harus dapat merakit robot dalam waktu 6 jam.|bisa berbahasa inggris.|paham coding', 'perlu_ktm', 'terbuka', '', '2025-06-10 01:30:00'),
(2, 'Tim Akselerasi', NULL, 3, 5, 'S1', 'Coding', 'Lomba Koding Cepat', 'Institut Teknologi Bandung', 'Tim pengembang aplikasi yang berkompetisi dalam pemrograman software.', 'Menguasai Python dan JavaScript.', 'tidak_perlu_ktm', 'terbuka', '', '2025-06-07 07:15:00'),
(3, 'Team Giga', NULL, 3, 5, 'S1', 'Esports', 'Lomba Game League', 'Universitas Bina Nusantara', 'Tim gamer dari Universitas Bina Nusantara yang siap menghadapi kompetisi game online.', 'Harus bisa bermain League of Legends.', 'perlu_ktm', 'terbuka', '', '2025-06-01 02:00:00'),
(4, 'Tim Inovasi', NULL, 3, 5, 'S1', 'Sains', 'Lomba Penemuan Ilmiah', 'Universitas Gadjah Mada', 'Tim riset yang fokus pada pengembangan teknologi baru dalam bidang ilmu pengetahuan.', 'Harus memiliki produk ilmiah yang inovatif.', 'tidak_perlu_ktm', 'terbuka', '', '2025-06-03 04:30:00'),
(5, 'Tim Creators', NULL, 3, 5, 'S1', 'Desain', 'Lomba Desain Grafis', 'Universitas Pelita Harapan', 'Tim desain grafis yang berkompetisi dalam menciptakan visual yang menarik.', 'Harus menguasai Adobe Photoshop dan Illustrator.', 'perlu_ktm', 'terbuka', '', '2025-06-05 03:20:00'),
(6, 'Tim Elang', NULL, 3, 5, 'S1', 'Debat', 'Lomba Debat Nasional', 'Universitas Airlangga', 'Tim debat yang berkompetisi dalam forum internasional di bidang politik dan ekonomi.', 'Harus bisa berbicara dengan percaya diri tanpa teks.', 'tidak_perlu_ktm', 'terbuka', '', '2025-06-04 09:45:00'),
(7, 'Tim Pioneers', NULL, 3, 5, 'S1', 'Matematika', 'Lomba Matematika Terapan', 'Politeknik Negeri Jakarta', 'Tim matematika yang berbakat dalam memecahkan persoalan-persoalan rumit.', 'Harus menguasai kalkulus dan aljabar.', 'perlu_ktm', 'terbuka', '', '2025-06-02 06:00:00'),
(8, 'Tim NextGen', NULL, 3, 5, 'S1', 'Musik', 'Lomba Musik Modern', 'Institut Seni Indonesia Yogyakarta', 'Tim musisi yang berkompetisi dalam lomba memainkan musik modern dengan alat musik elektronik.', 'Harus bisa memainkan alat musik elektronik dan gitar.', 'tidak_perlu_ktm', 'terbuka', '', '2025-06-08 10:00:00'),
(9, 'Tim Vision', NULL, 3, 5, 'S1', 'Teknologi', 'Lomba Pengembangan Aplikasi', 'Universitas Diponegoro', 'Tim yang mengembangkan aplikasi untuk membantu kehidupan sehari-hari.', 'Menguasai Android Studio atau Swift untuk iOS.', 'perlu_ktm', 'terbuka', '', '2025-06-09 05:10:00'),
(10, 'Tim Merah Putih', NULL, 3, 5, 'SMA,S1', 'Sosial', 'Lomba Pengabdian Masyarakat', 'Universitas Negeri Surabaya', 'Tim yang fokus pada kegiatan pengabdian masyarakat dan perbaikan sosial.', 'Harus memiliki pengalaman dalam proyek sosial.', 'tidak_perlu_ktm', 'terbuka', '', '2025-06-06 08:30:00'),
(11, 'Tim Juara', NULL, 4, 5, 'S1', 'Filsafat', 'Lomba Filosofi Kehidupan', 'Universitas Kristen Satya Wacana', 'Tim yang memiliki pemahaman filosofi dan mampu berargumen dengan baik.', 'Harus mempersiapkan argumen terkait tema yang diberikan.', 'perlu_ktm', 'terbuka', '', '2025-01-01 03:00:00'),
(12, 'Tim Spectrum', NULL, 4, 5, 'S1', 'Kimia', 'Lomba Eksperimen Kimia', 'Universitas Sebelas Maret', 'Tim kimia yang berkompetisi dalam eksperimen kimia yang menarik dan aman.', 'Harus dapat mengatur eksperimen dengan prosedur yang benar.', 'tidak_perlu_ktm', 'terbuka', '', '2025-01-01 03:00:00'),
(13, 'Tim Dynamo', NULL, 4, 5, 'S1', 'Teknik', 'Lomba Rancang Bangun Alat', 'Politeknik Negeri Bandung', 'Tim yang membuat dan mengembangkan alat teknologi untuk efisiensi industri.', 'Harus membawa prototipe alat yang dirancang.', 'perlu_ktm', 'terbuka', '', '2025-01-01 03:00:00'),
(14, 'Tim Prodigy', NULL, 4, 5, 'S1', 'Fotografi', 'Lomba Fotografi Alam', 'Sekolah Tinggi Seni Rupa Bandung', 'Tim fotografi yang ahli dalam menangkap keindahan alam dan pemandangan.', 'Harus membawa kamera DSLR atau mirrorless.', 'tidak_perlu_ktm', 'terbuka', '', '2025-01-01 03:00:00'),
(15, 'Tim Katalis', NULL, 2, 5, 'S1', 'Jurnalisme', 'Lomba Menulis Esai', 'Universitas Muhammadiyah Malang', 'Tim penulis yang membuat esai dengan topik kebijakan publik dan sosial.', 'Esai harus mengandung ide segar dan pemikiran yang mendalam.', 'perlu_ktm', 'terbuka', '', '2025-01-01 03:00:00'),
(16, 'Tim Duta', NULL, 2, 5, 'S1', 'Biodiversitas', 'Lomba Keanekaragaman Hayati', 'Universitas Negeri Malang', 'Tim ilmuwan yang memfokuskan pada pelestarian dan konservasi alam.', 'Harus memiliki pengetahuan mengenai flora dan fauna lokal.', 'tidak_perlu_ktm', 'terbuka', '', '2025-01-01 03:00:00'),
(21, 'creator', NULL, 3, 5, 'S1,S2', 'UI/UX Design', 'TechFest 2025', 'Universitas Indonesia', 'mencari tim yang memiliki kemampuan dalam desain ui/ux', 'paham UI/UX | mahasiswa UPI | angkatan 23/24', 'perlu_ktm', 'terbuka', 'https://chat.whatsapp.com/HrjBEYsUNj8EtkfQIz53ZE', '2025-06-15 06:15:16'),
(24, 'Rex Team', NULL, 3, 5, 'S1,S2,S3', 'UI/UX Design', 'TechFest 2025', 'semua', 'kjkjjkjkjkjjjj', 'ghfhgfghghf', 'tidak_perlu_ktm', 'terbuka', 'https://chat.whatsapp.com/HrjBEYsUNj8EtkfQIz53ZE', '2025-06-17 14:47:13'),
(25, 'Rex Team', 2, 1, 3, 'S1,S2', 'UI/UX Design', 'TechFest 2025', 'Universitas Pendidikan Indonesia', 'tim siap grak', 'sehat|mampu bekerja sama dengan tim', 'perlu_ktm', 'terbuka', 'https://chat.whatsapp.com/HrjBEYsUNj8EtkfQIz53ZE', '2025-06-18 10:44:26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `user_id` int NOT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('user','admin') COLLATE utf8mb4_unicode_ci DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`user_id`, `fullname`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Syahrul Ramadhan', 'syahrulramadhansr00@gmail.com', '$2y$10$WEVipCxKls6punOsW1eWl.lxvqQrtTd5NjCmAu6jPfnD6cqGJ2I0m', 'user', '2025-06-15 07:28:14', '2025-06-15 07:28:14'),
(2, 'user sapres', 'user@gmail.com', '$2y$10$kSOjii.ddJM19.U5zC3eHuRWg6ooKpGQE5ibJC0hhUH8CZbx407aC', 'user', '2025-06-18 02:49:51', '2025-06-18 02:49:51'),
(4, 'admin sapres', 'adminsapres@gmail.com', '$2y$10$pr0fgT2d8P/W1H1e6YUGQOfib6Cd16NCHlXPWhByqL8ZaEmMUGP5q', 'admin', '2025-06-18 03:00:46', '2025-06-18 03:01:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_sessions`
--

CREATE TABLE `user_sessions` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `session_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `login_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `last_activity` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `user_sessions`
--

INSERT INTO `user_sessions` (`id`, `user_id`, `session_id`, `login_time`, `last_activity`, `ip_address`, `user_agent`, `is_active`) VALUES
(2, 2, 'qado7a6mcgikibpm34fg2p9bj6', '2025-06-18 02:50:01', '2025-06-18 02:50:09', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 0),
(3, 2, 'a4gmg1cbvdgbkk48vevplt4g4i', '2025-06-18 02:50:25', '2025-06-18 02:50:56', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 0),
(4, 2, 'ei0istkr4dh7rbjikdv6p9horh', '2025-06-18 02:51:06', '2025-06-18 02:58:34', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 0),
(5, 4, '3eggarkh99di6aj50ktrorrmvq', '2025-06-18 03:00:55', '2025-06-18 03:01:31', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 0),
(6, 4, '783gqt77kfi11ugss2e973kft5', '2025-06-18 03:03:30', '2025-06-18 03:36:43', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 0),
(7, 4, '783gqt77kfi11ugss2e973kft5', '2025-06-18 03:35:06', '2025-06-18 03:36:43', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 0),
(8, 4, '783gqt77kfi11ugss2e973kft5', '2025-06-18 03:35:33', '2025-06-18 03:36:43', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 0),
(9, 4, '783gqt77kfi11ugss2e973kft5', '2025-06-18 03:36:40', '2025-06-18 03:36:43', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 0),
(10, 2, '783gqt77kfi11ugss2e973kft5', '2025-06-18 03:36:55', '2025-06-18 03:36:55', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 1),
(11, 2, 'mbd0260n3dt1tr0aur8b3kh6ap', '2025-06-18 06:04:13', '2025-06-18 07:26:06', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 0),
(12, 2, 'ehpj4dpbn7vmdm1mi3gmsjbh4g', '2025-06-18 07:26:15', '2025-06-18 11:28:30', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 0),
(13, 4, 'nkl4fdetfhbppjgbp5ma3427mc', '2025-06-18 11:30:56', '2025-06-18 11:31:29', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 0),
(14, 2, 'nkl4fdetfhbppjgbp5ma3427mc', '2025-06-18 11:31:40', '2025-06-18 11:31:40', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `anggota_tim`
--
ALTER TABLE `anggota_tim`
  ADD PRIMARY KEY (`anggota_id`),
  ADD KEY `fk_tim` (`tim_id`),
  ADD KEY `fk_user` (`user_id`);

--
-- Indeks untuk tabel `beasiswa`
--
ALTER TABLE `beasiswa`
  ADD PRIMARY KEY (`beasiswa_id`);

--
-- Indeks untuk tabel `bookmarks`
--
ALTER TABLE `bookmarks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_bookmark` (`user_id`,`item_type`,`item_id`),
  ADD KEY `idx_user_id` (`user_id`),
  ADD KEY `idx_item_type` (`item_type`);

--
-- Indeks untuk tabel `forum`
--
ALTER TABLE `forum`
  ADD PRIMARY KEY (`forum_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `lomba`
--
ALTER TABLE `lomba`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_deadline` (`deadline`),
  ADD KEY `idx_level` (`level`),
  ADD KEY `idx_scope` (`scope`),
  ADD KEY `idx_is_active` (`is_active`);

--
-- Indeks untuk tabel `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `terkait_tim_id` (`terkait_tim_id`),
  ADD KEY `dari_user_id` (`dari_user_id`);

--
-- Indeks untuk tabel `tim`
--
ALTER TABLE `tim`
  ADD PRIMARY KEY (`tim_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indeks untuk tabel `user_sessions`
--
ALTER TABLE `user_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_user_id` (`user_id`),
  ADD KEY `idx_session_id` (`session_id`),
  ADD KEY `idx_is_active` (`is_active`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `anggota_tim`
--
ALTER TABLE `anggota_tim`
  MODIFY `anggota_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `beasiswa`
--
ALTER TABLE `beasiswa`
  MODIFY `beasiswa_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `bookmarks`
--
ALTER TABLE `bookmarks`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `forum`
--
ALTER TABLE `forum`
  MODIFY `forum_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT untuk tabel `lomba`
--
ALTER TABLE `lomba`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tim`
--
ALTER TABLE `tim`
  MODIFY `tim_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `user_sessions`
--
ALTER TABLE `user_sessions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `anggota_tim`
--
ALTER TABLE `anggota_tim`
  ADD CONSTRAINT `fk_tim` FOREIGN KEY (`tim_id`) REFERENCES `tim` (`tim_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `bookmarks`
--
ALTER TABLE `bookmarks`
  ADD CONSTRAINT `bookmarks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `forum`
--
ALTER TABLE `forum`
  ADD CONSTRAINT `fk_forum_to_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Ketidakleluasaan untuk tabel `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD CONSTRAINT `notifikasi_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notifikasi_ibfk_2` FOREIGN KEY (`terkait_tim_id`) REFERENCES `tim` (`tim_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notifikasi_ibfk_3` FOREIGN KEY (`dari_user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `user_sessions`
--
ALTER TABLE `user_sessions`
  ADD CONSTRAINT `user_sessions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
