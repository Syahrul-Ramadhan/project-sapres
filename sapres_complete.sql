-- =============================================
-- Database: sapres
-- Description: Database untuk aplikasi SAPRES
-- Created: 2025
-- =============================================

-- Buat database jika belum ada
CREATE DATABASE IF NOT EXISTS `sapres` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `sapres`;

-- =============================================
-- Table structure for table `users`
-- =============================================
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================
-- Table structure for table `user_sessions`
-- =============================================
DROP TABLE IF EXISTS `user_sessions`;
CREATE TABLE `user_sessions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `session_id` varchar(255) NOT NULL,
  `login_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `last_activity` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text,
  `is_active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `idx_user_id` (`user_id`),
  KEY `idx_session_id` (`session_id`),
  KEY `idx_is_active` (`is_active`),
  CONSTRAINT `user_sessions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================
-- Table structure for table `beasiswa`
-- =============================================
DROP TABLE IF EXISTS `beasiswa`;
CREATE TABLE `beasiswa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `organizer` varchar(255) NOT NULL,
  `description` text,
  `requirements` text,
  `benefits` text,
  `deadline` date NOT NULL,
  `start_date` date NOT NULL,
  `level` enum('D3','D4','S1','S2','S3') NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `external_url` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_deadline` (`deadline`),
  KEY `idx_level` (`level`),
  KEY `idx_is_active` (`is_active`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================
-- Table structure for table `lomba`
-- =============================================
DROP TABLE IF EXISTS `lomba`;
CREATE TABLE `lomba` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `organizer` varchar(255) NOT NULL,
  `description` text,
  `requirements` text,
  `prizes` text,
  `deadline` date NOT NULL,
  `start_date` date NOT NULL,
  `level` enum('D3','D4','S1','S2','S3') NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `scope` enum('Lokal','Regional','Nasional','Internasional') DEFAULT 'Nasional',
  `image_url` varchar(255) DEFAULT NULL,
  `external_url` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_deadline` (`deadline`),
  KEY `idx_level` (`level`),
  KEY `idx_scope` (`scope`),
  KEY `idx_is_active` (`is_active`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================
-- Table structure for table `teams`
-- =============================================
DROP TABLE IF EXISTS `teams`;
CREATE TABLE `teams` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  `category` varchar(100) DEFAULT NULL,
  `max_members` int(11) DEFAULT '5',
  `current_members` int(11) DEFAULT '1',
  `skills_needed` text,
  `contact_info` varchar(255) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_created_by` (`created_by`),
  KEY `idx_is_active` (`is_active`),
  CONSTRAINT `teams_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================
-- Table structure for table `forum_posts`
-- =============================================
DROP TABLE IF EXISTS `forum_posts`;
CREATE TABLE `forum_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `category` enum('beasiswa','lomba','cari-tim','how-to') NOT NULL,
  `author_id` int(11) NOT NULL,
  `views` int(11) DEFAULT '0',
  `likes` int(11) DEFAULT '0',
  `is_pinned` tinyint(1) DEFAULT '0',
  `is_active` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_author_id` (`author_id`),
  KEY `idx_category` (`category`),
  KEY `idx_is_active` (`is_active`),
  CONSTRAINT `forum_posts_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================
-- Table structure for table `forum_replies`
-- =============================================
DROP TABLE IF EXISTS `forum_replies`;
CREATE TABLE `forum_replies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `likes` int(11) DEFAULT '0',
  `is_active` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_post_id` (`post_id`),
  KEY `idx_author_id` (`author_id`),
  KEY `idx_is_active` (`is_active`),
  CONSTRAINT `forum_replies_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `forum_posts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `forum_replies_ibfk_2` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================
-- Table structure for table `bookmarks`
-- =============================================
DROP TABLE IF EXISTS `bookmarks`;
CREATE TABLE `bookmarks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `item_type` enum('beasiswa','lomba') NOT NULL,
  `item_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_bookmark` (`user_id`,`item_type`,`item_id`),
  KEY `idx_user_id` (`user_id`),
  KEY `idx_item_type` (`item_type`),
  CONSTRAINT `bookmarks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================
-- Table structure for table `team_members`
-- =============================================
DROP TABLE IF EXISTS `team_members`;
CREATE TABLE `team_members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `team_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `role` varchar(100) DEFAULT 'Member',
  `status` enum('pending','accepted','rejected') DEFAULT 'pending',
  `joined_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_team_member` (`team_id`,`user_id`),
  KEY `idx_team_id` (`team_id`),
  KEY `idx_user_id` (`user_id`),
  KEY `idx_status` (`status`),
  CONSTRAINT `team_members_ibfk_1` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE,
  CONSTRAINT `team_members_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================
-- Table structure for table `notifications`
-- =============================================
DROP TABLE IF EXISTS `notifications`;
CREATE TABLE `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `type` enum('beasiswa','lomba','team','forum','system') NOT NULL,
  `related_id` int(11) DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_user_id` (`user_id`),
  KEY `idx_type` (`type`),
  KEY `idx_is_read` (`is_read`),
  KEY `idx_created_at` (`created_at`),
  CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================
-- Table structure for table `user_profiles`
-- =============================================
DROP TABLE IF EXISTS `user_profiles`;
CREATE TABLE `user_profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `university` varchar(255) DEFAULT NULL,
  `major` varchar(255) DEFAULT NULL,
  `semester` int(11) DEFAULT NULL,
  `gpa` decimal(3,2) DEFAULT NULL,
  `skills` text,
  `bio` text,
  `linkedin_url` varchar(255) DEFAULT NULL,
  `github_url` varchar(255) DEFAULT NULL,
  `portfolio_url` varchar(255) DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`),
  CONSTRAINT `user_profiles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================
-- Table structure for table `applications`
-- =============================================
DROP TABLE IF EXISTS `applications`;
CREATE TABLE `applications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `item_type` enum('beasiswa','lomba') NOT NULL,
  `item_id` int(11) NOT NULL,
  `status` enum('draft','submitted','under_review','accepted','rejected') DEFAULT 'draft',
  `application_data` json DEFAULT NULL,
  `notes` text,
  `submitted_at` timestamp NULL DEFAULT NULL,
  `reviewed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_user_id` (`user_id`),
  KEY `idx_item_type` (`item_type`),
  KEY `idx_status` (`status`),
  KEY `idx_submitted_at` (`submitted_at`),
  CONSTRAINT `applications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================
-- Insert sample data
-- =============================================

-- Insert admin user (password: admin123)
INSERT INTO `users` (`fullname`, `email`, `password`, `role`) VALUES
('Admin SAPRES', 'admin@sapres.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin');

-- Insert sample users (password: 123456)
INSERT INTO `users` (`fullname`, `email`, `password`, `role`) VALUES
('John Doe', 'john@example.com', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'user'),
('Jane Smith', 'jane@example.com', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'user'),
('Ahmad Rahman', 'ahmad@example.com', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'user'),
('Siti Nurhaliza', 'siti@example.com', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'user'),
('Budi Santoso', 'budi@example.com', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'user');

-- Insert sample beasiswa
INSERT INTO `beasiswa` (`title`, `organizer`, `description`, `requirements`, `benefits`, `deadline`, `start_date`, `level`, `category`, `image_url`, `external_url`) VALUES
('Beasiswa LPDP 2025', 'LPDP', 'Beasiswa untuk melanjutkan studi S2/S3 di dalam dan luar negeri', 'IPK minimal 3.0, TOEFL/IELTS, Surat rekomendasi', 'Biaya kuliah penuh, biaya hidup, tiket pesawat', '2025-06-30', '2025-03-01', 'S2', 'Pendidikan', 'lpdp.jpg', 'https://lpdp.kemenkeu.go.id'),
('Beasiswa Unggulan Kemendikbud', 'Kemendikbud', 'Beasiswa untuk mahasiswa berprestasi', 'IPK minimal 3.5, Prestasi akademik/non-akademik', 'Biaya kuliah, uang saku bulanan', '2025-05-15', '2025-02-01', 'S1', 'Pendidikan', 'kemendikbud.jpg', 'https://beasiswaunggulan.kemdikbud.go.id'),
('MEXT Scholarship Japan', 'MEXT Japan', 'Beasiswa pemerintah Jepang untuk studi di Jepang', 'Kemampuan bahasa Jepang/Inggris, Penerimaan universitas', 'Biaya kuliah, tunjangan hidup, tiket pesawat', '2025-07-31', '2025-04-01', 'S2', 'Internasional', 'mext.jpg', 'https://www.mext.go.jp'),
('Beasiswa Chevening UK', 'British Council', 'Beasiswa pemerintah Inggris untuk studi S2', 'IPK minimal 3.5, IELTS 6.5, Leadership experience', 'Biaya kuliah penuh, biaya hidup, visa', '2025-11-02', '2025-08-01', 'S2', 'Internasional', 'chevening.jpg', 'https://www.chevening.org'),
('Beasiswa Australia Awards', 'DFAT Australia', 'Beasiswa pemerintah Australia untuk negara berkembang', 'IPK minimal 3.0, IELTS 6.0, Work experience', 'Biaya kuliah, tunjangan hidup, asuransi kesehatan', '2025-04-30', '2025-02-01', 'S2', 'Internasional', 'australia-awards.jpg', 'https://www.australiaawards.gov.au'),
('Beasiswa BCA Finance', 'BCA Finance', 'Beasiswa untuk mahasiswa ekonomi dan bisnis', 'IPK minimal 3.25, Jurusan ekonomi/bisnis', 'Uang kuliah semester, magang di BCA', '2025-03-31', '2025-01-15', 'S1', 'Swasta', 'bca-finance.jpg', 'https://www.bcafinance.co.id'),
('Beasiswa Djarum Plus', 'Djarum Foundation', 'Beasiswa prestasi untuk mahasiswa aktif', 'IPK minimal 3.0, Prestasi non-akademik, Leadership', 'Uang saku, soft skill training, networking', '2025-12-31', '2025-10-01', 'S1', 'Swasta', 'djarum-plus.jpg', 'https://djarumbeasiswaplus.org'),
('Beasiswa Tanoto Foundation', 'Tanoto Foundation', 'Beasiswa untuk mahasiswa kurang mampu berprestasi', 'IPK minimal 3.0, Kondisi ekonomi kurang mampu', 'Biaya kuliah, biaya hidup, leadership development', '2025-05-31', '2025-03-01', 'S1', 'Yayasan', 'tanoto.jpg', 'https://www.tanotofoundation.org');

-- Insert sample lomba
INSERT INTO `lomba` (`title`, `organizer`, `description`, `requirements`, `prizes`, `deadline`, `start_date`, `level`, `category`, `scope`, `image_url`, `external_url`) VALUES
('Business Case Competition IYREF 2025', 'SRE ITB', 'Kompetisi analisis kasus bisnis tingkat nasional', 'Mahasiswa aktif D3/D4/S1, Tim 3-4 orang', 'Juara 1: 15 juta, Juara 2: 10 juta, Juara 3: 5 juta', '2025-03-23', '2025-03-06', 'S1', 'Bisnis', 'Nasional', 'bcc-iyref.jpg', 'https://iyref.com'),
('AI Competition Microsoft', 'Microsoft Indonesia', 'Kompetisi kecerdasan buatan tingkat nasional', 'Mahasiswa aktif, Kemampuan programming', 'Juara 1: 20 juta, Juara 2: 15 juta, Juara 3: 10 juta', '2025-04-15', '2025-03-25', 'S1', 'Teknologi', 'Nasional', 'ai-microsoft.jpg', 'https://microsoft.com/competition'),
('Hackathon Garuda Cyber', 'Garuda Cyber', 'Kompetisi pengembangan aplikasi cybersecurity', 'Tim 2-5 orang, Mahasiswa/Fresh graduate', 'Total hadiah 100 juta rupiah', '2025-05-30', '2025-05-01', 'S1', 'Cybersecurity', 'Nasional', 'hackathon-garuda.jpg', 'https://garudacyber.co.id'),
('Gemastik 2025', 'Puskomedia', 'Pagelaran Mahasiswa Nasional bidang TIK', 'Mahasiswa aktif, Tim maksimal 3 orang', 'Juara 1: 25 juta, Juara 2: 15 juta, Juara 3: 10 juta', '2025-06-15', '2025-04-01', 'S1', 'Teknologi', 'Nasional', 'gemastik.jpg', 'https://gemastik.kemdikbud.go.id'),
('LKTI Nasional UGM', 'UGM', 'Lomba Karya Tulis Ilmiah tingkat nasional', 'Mahasiswa aktif, Tim 2-3 orang', 'Juara 1: 10 juta, Juara 2: 7 juta, Juara 3: 5 juta', '2025-04-30', '2025-03-01', 'S1', 'Penelitian', 'Nasional', 'lkti-ugm.jpg', 'https://ugm.ac.id'),
('Startup Competition Telkom', 'Telkom Indonesia', 'Kompetisi startup untuk mahasiswa', 'Tim 3-5 orang, Ide bisnis teknologi', 'Juara 1: 50 juta, Juara 2: 30 juta, Juara 3: 20 juta', '2025-07-31', '2025-06-01', 'S1', 'Startup', 'Nasional', 'startup-telkom.jpg', 'https://telkom.co.id'),
('Design Competition Adobe', 'Adobe Indonesia', 'Kompetisi desain grafis dan UI/UX', 'Mahasiswa/Fresh graduate, Portfolio design', 'Juara 1: 15 juta, Software license, Internship', '2025-05-15', '2025-04-01', 'S1', 'Desain', 'Nasional', 'adobe-design.jpg', 'https://adobe.com/id'),
('Data Science Challenge Shopee', 'Shopee Indonesia', 'Kompetisi analisis data dan machine learning', 'Tim 1-4 orang, Background data science/IT', 'Juara 1: 30 juta, Job opportunity, Mentoring', '2025-08-31', '2025-07-01', 'S1', 'Data Science', 'Nasional', 'shopee-datascience.jpg', 'https://shopee.co.id');

-- Insert sample teams
INSERT INTO `teams` (`name`, `description`, `category`, `max_members`, `current_members`, `skills_needed`, `contact_info`, `created_by`) VALUES
('Team AI Innovators', 'Mencari anggota untuk kompetisi AI dan machine learning', 'Teknologi', 5, 2, 'Python, Machine Learning, Data Science', 'contact@aiinnovators.com', 2),
('Business Analysts Squad', 'Tim untuk kompetisi business case dan consulting', 'Bisnis', 4, 3, 'Business Analysis, Presentation, Research', 'business.squad@gmail.com', 3),
('Cyber Warriors', 'Tim cybersecurity untuk hackathon dan CTF', 'Cybersecurity', 6, 1, 'Network Security, Penetration Testing, Forensics', 'cyberwarriors@proton.me', 4),
('Creative Designers', 'Tim desain untuk kompetisi UI/UX dan graphic design', 'Desain', 4, 2, 'Adobe Creative Suite, Figma, UI/UX Design', 'creative.designers@gmail.com', 5),
('Data Miners', 'Tim data science untuk analisis data dan visualization', 'Data Science', 5, 3, 'Python, R, SQL, Tableau, Machine Learning', 'dataminers.team@outlook.com', 6),
('Startup Builders', 'Tim untuk mengembangkan ide startup teknologi', 'Startup', 6, 4, 'Full-stack Development, Business Development, Marketing', 'startup.builders@gmail.com', 2);

-- Insert sample team members
INSERT INTO `team_members` (`team_id`, `user_id`, `role`, `status`) VALUES
(1, 2, 'Leader', 'accepted'),
(1, 3, 'Data Scientist', 'accepted'),
(2, 3, 'Leader', 'accepted'),
(2, 4, 'Analyst', 'accepted'),
(2, 5, 'Researcher', 'accepted'),
(3, 4, 'Leader', 'accepted'),
(4, 5, 'Leader', 'accepted'),
(4, 6, 'UI Designer', 'accepted'),
(5, 6, 'Leader', 'accepted'),
(5, 2, 'Data Analyst', 'accepted'),
(5, 3, 'ML Engineer', 'accepted'),
(6, 2, 'Leader', 'accepted'),
(6, 4, 'Developer', 'accepted'),
(6, 5, 'Marketing', 'accepted'),
(6, 6, 'Business Analyst', 'accepted');

-- Insert sample forum posts
INSERT INTO `forum_posts` (`title`, `content`, `category`, `author_id`, `views`, `likes`, `is_pinned`) VALUES
('Selamat Datang di Forum SAPRES!', 'Halo Sobat SAPRES!\n\nSelamat datang di Forum SAPRES, tempat untuk berbagi informasi dan berdiskusi seputar beasiswa, lomba, dan mencari tim. Di forum ini terdapat beberapa kategori, seperti Beasiswa, Lomba, dan Cari Tim.\n\nAyo aktif berdiskusi dan saling membantu!', 'how-to', 1, 150, 25, 1),
('Tips Mendapatkan Beasiswa LPDP', 'Berdasarkan pengalaman saya yang berhasil mendapatkan beasiswa LPDP, berikut beberapa tips:\n\n1. Persiapkan dokumen jauh-jauh hari\n2. Perkuat motivation letter\n3. Cari referensi yang kuat\n4. Latihan interview\n\nAda yang mau tanya?', 'beasiswa', 2, 89, 15, 0),
('Pengalaman Ikut Gemastik 2024', 'Halo teman-teman! Mau share pengalaman ikut Gemastik tahun lalu. Kompetisinya sangat ketat tapi pengalaman yang didapat luar biasa.\n\nBagi yang mau ikut tahun ini, persiapkan dari sekarang ya!', 'lomba', 3, 67, 12, 0),
('Cari Tim untuk Business Case Competition', 'Halo! Saya sedang mencari 2-3 anggota tim untuk ikut Business Case Competition IYREF 2025.\n\nYang dibutuhkan:\n- Background bisnis/ekonomi\n- Pengalaman presentasi\n- Bisa commit waktu\n\nYang berminat bisa PM saya!', 'cari-tim', 4, 45, 8, 0),
('Cara Membuat CV yang Menarik untuk Beasiswa', 'Tips membuat CV untuk aplikasi beasiswa:\n\n1. Gunakan format yang clean dan professional\n2. Highlight prestasi akademik dan non-akademik\n3. Sertakan pengalaman organisasi\n4. Jangan lupa soft skills\n\nAda template CV yang bagus?', 'how-to', 5, 78, 18, 0);

-- Insert sample forum replies
INSERT INTO `forum_replies` (`post_id`, `author_id`, `content`, `likes`) VALUES
(2, 3, 'Terima kasih tips nya! Untuk motivation letter, ada format khusus yang disarankan tidak?', 3),
(2, 4, 'Setuju banget! Motivation letter memang kunci utama. Saya juga berhasil karena ML yang kuat.', 5),
(2, 5, 'Boleh minta contoh motivation letter yang bagus? Saya masih bingung cara memulainya.', 2),
(3, 2, 'Wah keren! Kategori apa yang kamu ikuti di Gemastik? Saya tertarik ikut tahun ini.', 4),
(3, 4, 'Gemastik memang kompetisi yang bergengsi. Persiapannya harus matang banget ya.', 2),
(4, 2, 'Saya tertarik join! Background saya ekonomi dan punya pengalaman presentasi. Boleh diskusi lebih lanjut?', 1),
(4, 5, 'Tim saya juga lagi cari anggota untuk kompetisi yang sama. Mungkin bisa kolaborasi?', 0),
(5, 3, 'Saya punya template CV yang lumayan bagus. Bisa saya share via email kalau mau.', 6),
(5, 6, 'Tips yang sangat membantu! Saya akan coba terapkan untuk aplikasi beasiswa bulan depan.', 4),
(1, 2, 'Forum yang sangat bermanfaat! Semoga bisa membantu banyak mahasiswa mendapatkan beasiswa dan lomba.', 8);

-- Insert sample user profiles
INSERT INTO `user_profiles` (`user_id`, `phone`, `university`, `major`, `semester`, `gpa`, `skills`, `bio`, `linkedin_url`, `github_url`) VALUES
(2, '081234567890', 'Institut Teknologi Bandung', 'Teknik Informatika', 6, 3.75, 'Python, Machine Learning, Data Analysis, React', 'Mahasiswa IT yang passionate di bidang AI dan data science. Aktif dalam berbagai kompetisi teknologi.', 'https://linkedin.com/in/johndoe', 'https://github.com/johndoe'),
(3, '081234567891', 'Universitas Indonesia', 'Manajemen', 4, 3.85, 'Business Analysis, Project Management, Public Speaking', 'Mahasiswa manajemen dengan minat di bidang consulting dan business development.', 'https://linkedin.com/in/janesmith', NULL),
(4, '081234567892', 'Universitas Gadjah Mada', 'Teknik Elektro', 5, 3.60, 'Network Security, Penetration Testing, Linux Administration', 'Cybersecurity enthusiast dengan pengalaman dalam ethical hacking dan network security.', 'https://linkedin.com/in/ahmadrahman', 'https://github.com/ahmadrahman'),
(5, '081234567893', 'Institut Teknologi Sepuluh Nopember', 'Desain Komunikasi Visual', 3, 3.70, 'Adobe Creative Suite, UI/UX Design, Figma, Prototyping', 'Designer yang fokus pada user experience dan visual communication.', 'https://linkedin.com/in/sitinurhaliza', NULL),
(6, '081234567894', 'Universitas Bina Nusantara', 'Sistem Informasi', 7, 3.80, 'Full-stack Development, Database Design, Business Process', 'Mahasiswa SI dengan pengalaman dalam pengembangan aplikasi web dan mobile.', 'https://linkedin.com/in/budisantoso', 'https://github.com/budisantoso');

-- Insert sample bookmarks
INSERT INTO `bookmarks` (`user_id`, `item_type`, `item_id`) VALUES
(2, 'beasiswa', 1),
(2, 'beasiswa', 3),
(2, 'lomba', 2),
(2, 'lomba', 4),
(3, 'beasiswa', 2),
(3, 'beasiswa', 6),
(3, 'lomba', 1),
(3, 'lomba', 6),
(4, 'beasiswa', 1),
(4, 'beasiswa', 4),
(4, 'lomba', 3),
(5, 'beasiswa', 7),
(5, 'lomba', 7),
(6, 'beasiswa', 8),
(6, 'lomba', 8);

-- Insert sample notifications
INSERT INTO `notifications` (`user_id`, `title`, `message`, `type`, `related_id`, `is_read`) VALUES
(2, 'Beasiswa Baru Tersedia!', 'Beasiswa LPDP 2025 telah dibuka. Deadline: 30 Juni 2025', 'beasiswa', 1, 0),
(2, 'Lomba AI Competition', 'Microsoft AI Competition telah dibuka. Jangan lewatkan kesempatan ini!', 'lomba', 2, 0),
(3, 'Undangan Bergabung Tim', 'Anda diundang untuk bergabung dengan tim AI Innovators', 'team', 1, 1),
(3, 'Beasiswa Unggulan Kemendikbud', 'Pendaftaran beasiswa unggulan telah dibuka. Deadline: 15 Mei 2025', 'beasiswa', 2, 0),
(4, 'Reply di Forum', 'Ada balasan baru di post "Cari Tim untuk Business Case Competition"', 'forum', 4, 0),
(4, 'Beasiswa Australia Awards', 'Beasiswa Australia Awards 2025 telah dibuka untuk pendaftaran', 'beasiswa', 5, 1),
(5, 'Lomba Design Competition', 'Adobe Design Competition telah dibuka. Tunjukkan kreativitas Anda!', 'lomba', 7, 0),
(6, 'Tim Baru Dibuat', 'Tim "Startup Builders" telah berhasil dibuat', 'team', 6, 1);

-- Insert sample applications
INSERT INTO `applications` (`user_id`, `item_type`, `item_id`, `status`, `application_data`, `notes`, `submitted_at`) VALUES
(2, 'beasiswa', 1, 'submitted', '{"motivation_letter": "Saya tertarik mengambil beasiswa LPDP...", "documents": ["cv.pdf", "transcript.pdf"], "university_choice": "University of Melbourne"}', 'Aplikasi lengkap dengan semua dokumen', '2025-01-15 10:30:00'),
(2, 'lomba', 2, 'submitted', '{"team_name": "AI Innovators", "project_description": "AI-powered healthcare solution", "team_members": ["John Doe", "Jane Smith"]}', 'Tim sudah terbentuk dan siap berkompetisi', '2025-01-20 14:15:00'),
(3, 'beasiswa', 2, 'draft', '{"motivation_letter": "Draft motivation letter...", "documents": ["cv.pdf"]}', 'Masih dalam tahap persiapan dokumen', NULL),
(4, 'lomba', 3, 'submitted', '{"team_name": "Cyber Warriors", "specialization": "Network Security", "previous_experience": "CTF competitions"}', 'Pengalaman di bidang cybersecurity cukup baik', '2025-01-18 16:45:00'),
(5, 'lomba', 7, 'under_review', '{"portfolio_url": "https://behance.net/sitinurhaliza", "design_category": "UI/UX Design", "tools_used": ["Figma", "Adobe XD"]}', 'Portfolio design sangat menarik', '2025-01-12 09:20:00');

-- =============================================
-- Create Views for easier data access
-- =============================================

-- View untuk statistik dashboard
CREATE OR REPLACE VIEW `dashboard_stats` AS
SELECT 
    (SELECT COUNT(*) FROM beasiswa WHERE is_active = 1) as total_beasiswa,
    (SELECT COUNT(*) FROM lomba WHERE is_active = 1) as total_lomba,
    (SELECT COUNT(*) FROM teams WHERE is_active = 1) as total_teams,
    (SELECT COUNT(*) FROM forum_posts WHERE is_active = 1) as total_forum_posts,
    (SELECT COUNT(*) FROM users WHERE role = 'user') as total_users,
    (SELECT COUNT(*) FROM users WHERE role = 'admin') as total_admins;

-- View untuk beasiswa yang akan berakhir
CREATE OR REPLACE VIEW `beasiswa_deadline_soon` AS
SELECT 
    id, title, organizer, deadline,
    DATEDIFF(deadline, CURDATE()) as days_remaining
FROM beasiswa 
WHERE is_active = 1 
    AND deadline >= CURDATE() 
    AND deadline <= DATE_ADD(CURDATE(), INTERVAL 30 DAY)
ORDER BY deadline ASC;

-- View untuk lomba yang akan berakhir
CREATE OR REPLACE VIEW `lomba_deadline_soon` AS
SELECT 
    id, title, organizer, deadline,
    DATEDIFF(deadline, CURDATE()) as days_remaining
FROM lomba 
WHERE is_active = 1 
    AND deadline >= CURDATE() 
    AND deadline <= DATE_ADD(CURDATE(), INTERVAL 30 DAY)
ORDER BY deadline ASC;

-- View untuk tim yang masih mencari anggota
CREATE OR REPLACE VIEW `teams_recruiting` AS
SELECT 
    t.id, t.name, t.description, t.category,
    t.max_members, t.current_members,
    (t.max_members - t.current_members) as slots_available,
    u.fullname as creator_name,
    t.created_at
FROM teams t
JOIN users u ON t.created_by = u.id
WHERE t.is_active = 1 
    AND t.current_members < t.max_members
ORDER BY t.created_at DESC;

-- View untuk forum posts dengan informasi author
CREATE OR REPLACE VIEW `forum_posts_with_author` AS
SELECT 
    fp.id, fp.title, fp.content, fp.category,
    fp.views, fp.likes, fp.is_pinned,
    fp.created_at, fp.updated_at,
    u.fullname as author_name,
    (SELECT COUNT(*) FROM forum_replies fr WHERE fr.post_id = fp.id AND fr.is_active = 1) as reply_count
FROM forum_posts fp
JOIN users u ON fp.author_id = u.id
WHERE fp.is_active = 1
ORDER BY fp.is_pinned DESC, fp.created_at DESC;

-- =============================================
-- Create Stored Procedures
-- =============================================

DELIMITER //

-- Procedure untuk update statistik tim
CREATE PROCEDURE UpdateTeamMemberCount(IN team_id INT)
BEGIN
    UPDATE teams 
    SET current_members = (
        SELECT COUNT(*) 
        FROM team_members 
        WHERE team_id = team_id AND status = 'accepted'
    )
    WHERE id = team_id;
END //

-- Procedure untuk membersihkan session yang expired
CREATE PROCEDURE CleanExpiredSessions()
BEGIN
    UPDATE user_sessions 
    SET is_active = 0 
    WHERE last_activity < DATE_SUB(NOW(), INTERVAL 24 HOUR);
    
    DELETE FROM user_sessions 
    WHERE last_activity < DATE_SUB(NOW(), INTERVAL 7 DAY);
END //

-- Procedure untuk mendapatkan statistik user
CREATE PROCEDURE GetUserStats(OUT total_users INT, OUT active_users INT, OUT online_users INT)
BEGIN
    SELECT COUNT(*) INTO total_users FROM users WHERE role = 'user';
    
    SELECT COUNT(DISTINCT user_id) INTO active_users 
    FROM user_sessions 
    WHERE last_activity >= DATE_SUB(NOW(), INTERVAL 24 HOUR) AND is_active = 1;
    
    SELECT COUNT(DISTINCT user_id) INTO online_users 
    FROM user_sessions 
    WHERE last_activity >= DATE_SUB(NOW(), INTERVAL 15 MINUTE) AND is_active = 1;
END //

DELIMITER ;

-- =============================================
-- Create Triggers
-- =============================================

DELIMITER //

-- Trigger untuk update team member count ketika ada perubahan status
CREATE TRIGGER update_team_count_after_member_change
AFTER UPDATE ON team_members
FOR EACH ROW
BEGIN
    IF OLD.status != NEW.status THEN
        CALL UpdateTeamMemberCount(NEW.team_id);
    END IF;
END //

-- Trigger untuk membuat notifikasi ketika ada beasiswa baru
CREATE TRIGGER notify_new_beasiswa
AFTER INSERT ON beasiswa
FOR EACH ROW
BEGIN
    INSERT INTO notifications (user_id, title, message, type, related_id)
    SELECT id, 
           CONCAT('Beasiswa Baru: ', NEW.title),
           CONCAT('Beasiswa ', NEW.title, ' dari ', NEW.organizer, ' telah tersedia. Deadline: ', DATE_FORMAT(NEW.deadline, '%d %M %Y')),
           'beasiswa',
           NEW.id
    FROM users WHERE role = 'user';
END //

-- Trigger untuk membuat notifikasi ketika ada lomba baru
CREATE TRIGGER notify_new_lomba
AFTER INSERT ON lomba
FOR EACH ROW
BEGIN
    INSERT INTO notifications (user_id, title, message, type, related_id)
    SELECT id,
           CONCAT('Lomba Baru: ', NEW.title),
           CONCAT('Lomba ', NEW.title, ' dari ', NEW.organizer, ' telah tersedia. Deadline: ', DATE_FORMAT(NEW.deadline, '%d %M %Y')),
           'lomba',
           NEW.id
    FROM users WHERE role = 'user';
END //

DELIMITER ;

-- =============================================
-- Create Indexes for better performance
-- =============================================

-- Additional indexes for better query performance
CREATE INDEX idx_beasiswa_deadline_active ON beasiswa(deadline, is_active);
CREATE INDEX idx_lomba_deadline_active ON lomba(deadline, is_active);
CREATE INDEX idx_forum_posts_category_active ON forum_posts(category, is_active);
CREATE INDEX idx_notifications_user_read ON notifications(user_id, is_read);
CREATE INDEX idx_applications_user_status ON applications(user_id, status);
CREATE INDEX idx_user_sessions_activity ON user_sessions(last_activity, is_active);

-- =============================================
-- Insert additional sample data for testing
-- =============================================

-- Insert beberapa session untuk testing
INSERT INTO `user_sessions` (`user_id`, `session_id`, `login_time`, `last_activity`, `ip_address`, `user_agent`, `is_active`) VALUES
(1, 'admin_session_123', NOW(), NOW(), '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36', 1),
(2, 'user_session_456', DATE_SUB(NOW(), INTERVAL 30 MINUTE), DATE_SUB(NOW(), INTERVAL 5 MINUTE), '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36', 1),
(3, 'user_session_789', DATE_SUB(NOW(), INTERVAL 2 HOUR), DATE_SUB(NOW(), INTERVAL 10 MINUTE), '192.168.1.100', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36', 1),
(4, 'user_session_101', DATE_SUB(NOW(), INTERVAL 1 HOUR), DATE_SUB(NOW(), INTERVAL 15 MINUTE), '192.168.1.101', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36', 1);

-- =============================================
-- Final data consistency checks and updates
-- =============================================

-- Update team current_members count berdasarkan actual members
UPDATE teams t SET current_members = (
    SELECT COUNT(*) 
    FROM team_members tm 
    WHERE tm.team_id = t.id AND tm.status = 'accepted'
);

-- Update forum post reply counts (jika diperlukan di masa depan)
-- Ini bisa digunakan jika ada kolom reply_count di tabel forum_posts

-- =============================================
-- Create sample admin queries for monitoring
-- =============================================

-- Query untuk monitoring user activity (untuk admin dashboard)
-- SELECT u.fullname, us.login_time, us.last_activity, us.ip_address
-- FROM users u 
-- JOIN user_sessions us ON u.id = us.user_id 
-- WHERE us.is_active = 1 
-- ORDER BY us.last_activity DESC;

-- Query untuk monitoring aplikasi terbaru
-- SELECT u.fullname, a.item_type, 
--        CASE 
--            WHEN a.item_type = 'beasiswa' THEN b.title
--            WHEN a.item_type = 'lomba' THEN l.title
--        END as item_title,
--        a.status, a.submitted_at
-- FROM applications a
-- JOIN users u ON a.user_id = u.id
-- LEFT JOIN beasiswa b ON a.item_type = 'beasiswa' AND a.item_id = b.id
-- LEFT JOIN lomba l ON a.item_type = 'lomba' AND a.item_id = l.id
-- ORDER BY a.submitted_at DESC;

-- =============================================
-- Database setup completion message
-- =============================================

-- Insert system notification untuk admin
INSERT INTO `notifications` (`user_id`, `title`, `message`, `type`, `is_read`) VALUES
(1, 'Database Setup Complete', 'Database SAPRES telah berhasil disetup dengan data sample. Sistem siap digunakan!', 'system', 0);

-- =============================================
-- Database version and metadata
-- =============================================

-- Create table untuk tracking database version
CREATE TABLE IF NOT EXISTS `database_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `version` varchar(20) NOT NULL,
  `description` text,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert database version info
INSERT INTO `database_info` (`version`, `description`) VALUES
('1.0.0', 'Initial database setup with complete schema and sample data for SAPRES application');

-- =============================================
-- Final optimizations
-- =============================================

-- Analyze tables for better performance
ANALYZE TABLE users, user_sessions, beasiswa, lomba, teams, forum_posts, forum_replies, bookmarks, notifications, user_profiles, applications, team_members;

-- =============================================
-- Security settings (optional, uncomment if needed)
-- =============================================

-- Create dedicated database user for application (uncomment and modify as needed)
-- CREATE USER 'sapres_app'@'localhost' IDENTIFIED BY 'your_secure_password_here';
-- GRANT SELECT, INSERT, UPDATE, DELETE ON sapres.* TO 'sapres_app'@'localhost';
-- GRANT EXECUTE ON sapres.* TO 'sapres_app'@'localhost';
-- FLUSH PRIVILEGES;

-- =============================================
-- Backup and maintenance recommendations
-- =============================================

-- Recommended maintenance queries (run periodically):

-- 1. Clean expired sessions (run daily)
-- CALL CleanExpiredSessions();

-- 2. Clean old notifications (run weekly)
-- DELETE FROM notifications WHERE created_at < DATE_SUB(NOW(), INTERVAL 30 DAY) AND is_read = 1;

-- 3. Update statistics (run as needed)
-- CALL GetUserStats(@total, @active, @online);

-- 4. Backup important data (run regularly)
-- mysqldump -u root -p sapres > backup_sapres_$(date +%Y%m%d).sql

-- =============================================
-- END OF DATABASE SETUP
-- =============================================

-- Success message
SELECT 'Database SAPRES setup completed successfully!' as message,
       'Total tables created: 12' as tables_info,
       'Sample data inserted for testing' as data_info,
       'Views, procedures, and triggers created' as features_info,
       'Ready for application integration' as status;

-- Show final statistics
SELECT 
    'SAPRES Database Statistics' as info,
    (SELECT COUNT(*) FROM users) as total_users,
    (SELECT COUNT(*) FROM beasiswa) as total_beasiswa,
    (SELECT COUNT(*) FROM lomba) as total_lomba,
    (SELECT COUNT(*) FROM teams) as total_teams,
    (SELECT COUNT(*) FROM forum_posts) as total_forum_posts,
    (SELECT COUNT(*) FROM applications) as total_applications;

-- =============================================
-- Login credentials for testing:
-- =============================================
-- Admin: admin@sapres.com / admin123
-- Users: john@example.com / 123456
--        jane@example.com / 123456
--        ahmad@example.com / 123456
--        siti@example.com / 123456
--        budi@example.com / 123456
-- =============================================

