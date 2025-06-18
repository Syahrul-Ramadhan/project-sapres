<?php
// Start session and authentication
// if (session_status() === PHP_SESSION_NONE) {
//     session_start();
// }

require_once '../php/koneksi.php';
// require_once '../php/admin_auth.php';

// $adminAuth = new AdminAuth($koneksi);
// $adminAuth->requireAdminLogin();
// $adminInfo = $adminAuth->getAdminInfo();
// $admin_name = $adminInfo ? $adminInfo['fullname'] : 'Admin';

session_start();

// Ambil user_id dari sesi
$user_id = $_SESSION['user_id'] ?? 0; // Pastikan session sudah di-set sebelumnya

// Cek apakah user_id ada
if ($user_id > 0) {
    // Ambil data pengguna dari database (misalnya 'users' tabel)
    // Ganti dengan query yang sesuai dengan struktur database Anda
    $stmt = $koneksi->prepare("SELECT fullname FROM users WHERE user_id = ?");
    $stmt->execute([$user_id]);
    $user = $stmt->fetch();

    $fullname = $user ? $user['fullname'] : 'User Not Found'; // Jika data ditemukan
} else {
    $fullname = 'Guest';  // Jika user_id tidak ada (belum login)
}

// Get lomba data
$lombaList = [];
$stats = ['total' => 0, 'active' => 0, 'expired' => 0];

try {
    // Get stats
    $stmt = $koneksi->query("SELECT 
        COUNT(*) as total,
        SUM(CASE WHEN is_active = 1 AND deadline >= CURDATE() THEN 1 ELSE 0 END) as active,
        SUM(CASE WHEN deadline < CURDATE() THEN 1 ELSE 0 END) as expired
        FROM lomba");
    $stats = $stmt->fetch(PDO::FETCH_ASSOC) ?: $stats;
    
    // Get lomba list
    $stmt = $koneksi->query("SELECT * FROM lomba ORDER BY created_at DESC");
    $lombaList = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
} catch (Exception $e) {
    error_log("Error: " . $e->getMessage());
}

// Handle AJAX requests
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    header('Content-Type: application/json');
    
    try {
        switch ($_POST['action']) {
            case 'add':
                $stmt = $koneksi->prepare("INSERT INTO lomba (title, cost, organizer, description, start_date, deadline, level, scope, category, external_url, is_active) VALUES (?,?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $result = $stmt->execute([
                    $_POST['title'],
                    $_POST['cost'],
                    $_POST['organizer'],
                    $_POST['description'] ?? '',
                    $_POST['start_date'],
                    $_POST['deadline'],
                    $_POST['level'],
                    $_POST['scope'],
                    $_POST['category'] ?? 'Umum',
                    $_POST['external_url'] ?? '',
                    $_POST['is_active'] ?? 1
                ]);
                echo json_encode(['success' => $result]);
                break;
                
            case 'edit':
                $stmt = $koneksi->prepare("UPDATE lomba SET title = ?, cost = ?,organizer = ?, description = ?, start_date = ?, deadline = ?, level = ?, scope = ?, category = ?, external_url = ?, is_active = ? WHERE id = ?");
                $result = $stmt->execute([
                    $_POST['title'],
                    $_POST['cost'],
                    $_POST['organizer'],
                    $_POST['description'] ?? '',
                    $_POST['start_date'],
                    $_POST['deadline'],
                    $_POST['level'],
                    $_POST['scope'],
                    $_POST['category'] ?? 'Umum',
                    $_POST['external_url'] ?? '',
                    $_POST['is_active'] ?? 1,
                    $_POST['id']
                ]);
                echo json_encode(['success' => $result]);
                break;
                
            case 'get':
                $stmt = $koneksi->prepare("SELECT * FROM lomba WHERE id = ?");
                $stmt->execute([$_POST['id']]);
                $lomba = $stmt->fetch(PDO::FETCH_ASSOC);
                echo json_encode(['success' => true, 'data' => $lomba]);
                break;
                
            case 'toggle_status':
                $stmt = $koneksi->prepare("UPDATE lomba SET is_active = ? WHERE id = ?");
                $result = $stmt->execute([$_POST['status'], $_POST['id']]);
                echo json_encode(['success' => $result]);
                break;
                
            case 'delete':
                $stmt = $koneksi->prepare("DELETE FROM lomba WHERE id = ?");
                $result = $stmt->execute([$_POST['id']]);
                echo json_encode(['success' => $result]);
                break;
        }
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manajemen Lomba</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* ---------- RESET & BASE STYLES ---------- */
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap");

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", Verdana, sans-serif;
        }

        body {
            line-height: 1.6;
            background-color: #f5f5f5;
            overflow-x: hidden;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        ul {
            list-style: none;
        }

        :root {
            --Primary-color: #205781;
            --Secondary-color: #4f959d;
            --fill-color: #d5e6e7;
            --base-font-color: #333332;
            --second-font-color: #777776;
        }

        /* ---------- SIDE NAV ---------- */
        .side-nav {
            width: 250px;
            height: 100vh;
            background-color: var(--fill-color);
            color: var(--base-font-color);
            padding: 24px;
            position: fixed;
        }

        .container {
            margin-left: 24px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            width: 100%;
            height: 100%;
        }

        .side-nav h2 {
            font-weight: bold;
            font-size: 24px;
            color: var(--Primary-color);
            margin-bottom: 24px;
        }

        .nav-header .nav-list ul {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .nav-header .nav-list li {
            display: flex;
            gap: 16px;
            align-items: center;
        }

        .nav-header .nav-list li img {
            width: 20px;
            height: 20px;
        }

        .nav-footer {
            margin-bottom: 12px;
        }

        .nav-footer .profile {
            display: flex;
            flex-direction: row;
            gap: 12px;
            margin-bottom: 24px;
        }

        .nav-footer .profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            -webkit-border-radius: 50%;
            -moz-border-radius: 50%;
            -ms-border-radius: 50%;
            -o-border-radius: 50%;
        }

        .nav-footer .log-out {
            display: flex;
            align-items: center;
            gap: 8px;
            padding-left: 12px;
        }

        /* Main Content */
        .main-content {
            margin-left: 250px;
            min-height: 100vh;
            padding: 30px;
        }

        .page-title {
            font-size: 28px;
            color: #205781;
            margin-bottom: 30px;
            font-weight: 700;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            border-left: 4px solid #205781;
        }

        .stat-card h3 {
            font-size: 14px;
            color: #666;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .stat-card .number {
            font-size: 32px;
            font-weight: 700;
            color: #205781;
        }

        /* Action Bar */
        .action-bar {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
        }

        .search-box {
            flex: 1;
            position: relative;
        }

        .search-box input {
            width: 100%;
            padding: 12px 40px 12px 16px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
        }

        .search-box i {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
        }

        .add-btn {
            background: #205781;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: background 0.3s ease;
        }

        .add-btn:hover {
            background: #1a4a6b;
        }

        /* Filter & Pagination Styles */
        .filter-bar {
            background: white;
            padding: 15px 20px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 20px;
            display: flex;
            gap: 15px;
            align-items: center;
            flex-wrap: wrap;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .filter-group label {
            font-size: 12px;
            color: #666;
            font-weight: 500;
        }

        .filter-group select {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
            min-width: 120px;
        }

        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            margin-top: 20px;
            padding: 20px;
        }

        .pagination button {
            padding: 8px 12px;
            border: 1px solid #ddd;
            background: white;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .pagination button:hover:not(:disabled) {
            background: #f8f9fa;
        }

        .pagination button.active {
            background: #205781;
            color: white;
            border-color: #205781;
        }

        .pagination button:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .pagination-info {
            font-size: 14px;
            color: #666;
            margin: 0 15px;
        }

        .table-scroll {
            max-height: 600px;
            overflow-y: auto;
        }

        .table-scroll::-webkit-scrollbar {
            width: 8px;
        }

        .table-scroll::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }

        .table-scroll::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 4px;
        }

        .table-scroll::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }

        /* Loading State */
        .loading {
            text-align: center;
            padding: 40px;
            color: #666;
        }

        .loading i {
            font-size: 24px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Data Table */
        .table-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table th {
            background: #f8f9fa;
            padding: 16px;
            text-align: left;
            font-weight: 600;
            color: #333;
            border-bottom: 1px solid #eee;
        }

        .data-table td {
            padding: 16px;
            border-bottom: 1px solid #eee;
            vertical-align: top;
        }

        .data-table tbody tr:hover {
            background: #f8f9fa;
        }

        .lomba-title {
            font-weight: 600;
            color: #333;
            margin-bottom: 4px;
        }

        .lomba-organizer {
            color: #666;
            font-size: 14px;
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            text-align: center;
            min-width: 80px;
            display: inline-block;
        }

        .status-badge.active {
            background: #d4edda;
            color: #155724;
        }

        .status-badge.inactive {
            background: #f8d7da;
            color: #721c24;
        }

        .status-badge.expired {
            background: #fff3cd;
            color: #856404;
        }

        .action-btns {
            display: flex;
            gap: 8px;
        }

        .btn-sm {
            padding: 6px 12px;
            border: none;
            border-radius: 6px;
            font-size: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-edit {
            background: #ffc107;
            color: #212529;
        }

        .btn-edit:hover {
            background: #e0a800;
        }

        .btn-delete {
            background: #dc3545;
            color: white;
        }

        .btn-delete:hover {
            background: #c82333;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #666;
        }

        .empty-state i {
            font-size: 48px;
            color: #ddd;
            margin-bottom: 20px;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background-color: white;
            border-radius: 12px;
            width: 90%;
            max-width: 600px;
            max-height: 90vh;
            overflow-y: auto;
            position: relative;
        }

        .modal-header {
            padding: 20px;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h3 {
            margin: 0;
            color: #205781;
        }

        .close {
            color: #aaa;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover {
            color: #000;
        }

        .modal-body {
            padding: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
            color: #333;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
        }

        .form-group textarea {
            height: 100px;
            resize: vertical;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .modal-footer {
            padding: 20px;
            border-top: 1px solid #eee;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: #205781;
            color: white;
        }

        .btn-primary:hover {
            background: #1a4a6b;
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
        }

        .btn-secondary:hover {
            background: #5a6268;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .side-nav {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
                z-index: 1001;
            }

            .side-nav.open {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
                padding: 20px 15px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .action-bar {
                flex-direction: column;
                align-items: stretch;
            }

            .filter-bar {
                flex-direction: column;
                align-items: stretch;
            }

            .filter-group {
                flex-direction: row;
                align-items: center;
                justify-content: space-between;
            }

            .table-container {
                overflow-x: auto;
            }

            .data-table {
                min-width: 600px;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            .mobile-menu-btn {
                position: fixed;
                top: 20px;
                left: 20px;
                z-index: 1002;
                background: #205781;
                color: white;
                border: none;
                padding: 10px;
                border-radius: 6px;
                cursor: pointer;
            }
        }
    </style>
</head>
<body>
    <!-- SIDE NAV START -->
    <div class="side-nav" id="sidebar">
        <div class="container">
            <div class="nav-header">
                <div class="title">
                    <h2>Sapres</h2>
                </div>
                <div class="nav-list">
                    <ul>
                        <li>
                            <img src="../../assets/img/icons/dashboard-admin/pie-chart.png" alt="chart-icon">
                            <a href="dashboardAdmin.php">Dashboard</a>
                        </li>
                        <li>
                            <img src="../../assets/img/icons/dashboard-admin/dollar-currency-symbol.png" alt="beasiswa-icon">
                            <a href="beasiswaAdmin.php">Beasiswa</a>
                        </li>
                        <li>
                            <img src="../../assets/img/icons/dashboard-admin/trophy.png" alt="lomba-icon">
                            <a href="lombaAdmin.php" style="font-weight: 600; color: var(--Primary-color);">Lomba</a>
                        </li>
                        <li>
                            <img src="../../assets/img/icons/dashboard-admin/group-users.png" alt="team-icon">
                            <a href="timAdmin.php">Tim</a>
                        </li>
                        <li>
                            <img src="../../assets/img/icons/dashboard-admin/chat.png" alt="forum-icon">
                            <a href="forumAdmin.php">Forum</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="nav-footer">
                <div class="profile">
                    <img src="../../assets/img/user_profile/default_profile.png" alt="Profile Picture">
                    <div class="profile-info">
                        <h4><?php echo htmlspecialchars($fullname); ?></h4>
                        <p>Admin</p>
                    </div>
                </div>
                <a href="../php/auth_handler.php?action=logout" class="log-out">
                    <i class="fa-solid fa-arrow-right-from-bracket fa-rotate-180"></i>
                    Log out
                </a>
            </div>
        </div>
    </div>
    <!-- SIDE NAV END -->

    <!-- Main Content -->
    <div class="main-content">
        <h1 class="page-title">Manajemen Lomba</h1>

        <!-- Stats Cards -->
        <div class="stats-grid">
            <div class="stat-card">
                <h3>Total Lomba</h3>
                <div class="number"><?php echo $stats['total']; ?></div>
            </div>
            <div class="stat-card">
                <h3>Lomba Aktif</h3>
                <div class="number"><?php echo $stats['active']; ?></div>
            </div>
            <div class="stat-card">
                <h3>Lomba Berakhir</h3>
                <div class="number"><?php echo $stats['expired']; ?></div>
            </div>
        </div>

        <!-- Action Bar -->
        <div class="action-bar">
            <div class="search-box">
                <input type="text" id="searchInput" placeholder="Cari lomba atau penyelenggara...">
                <i class="fas fa-search"></i>
            </div>
            <button class="add-btn" onclick="openModal()">
                <i class="fas fa-plus"></i>
                Tambah Lomba
            </button>
        </div>

        <!-- Filter Bar -->
        <div class="filter-bar">
            <div class="filter-group">
                <label>Level</label>
                <select id="filterLevel">
                    <option value="">Semua Level</option>
                    <option value="D3">D3</option>
                    <option value="D4">D4</option>
                    <option value="S1">S1</option>
                    <option value="S2">S2</option>
                    <option value="S3">S3</option>
                </select>
            </div>
            <div class="filter-group">
                <label>Cakupan</label>
                <select id="filterScope">
                    <option value="">Semua Cakupan</option>
                    <option value="Lokal">Lokal</option>
                    <option value="Regional">Regional</option>
                    <option value="Nasional">Nasional</option>
                    <option value="Internasional">Internasional</option>
                </select>
            </div>
            <div class="filter-group">
                <label>Status</label>
                <select id="filterStatus">
                    <option value="">Semua Status</option>
                    <option value="active">Aktif</option>
                    <option value="inactive">Tidak Aktif</option>
                    <option value="expired">Berakhir</option>
                </select>
            </div>
            <div class="filter-group">
                <label>Urutkan</label>
                <select id="sortBy">
                    <option value="created_at_desc">Terbaru</option>
                    <option value="created_at_asc">Terlama</option>
                    <option value="title_asc">Nama A-Z</option>
                    <option value="title_desc">Nama Z-A</option>
                    <option value="deadline_asc">Deadline Terdekat</option>
                    <option value="deadline_desc">Deadline Terjauh</option>
                </select>
            </div>
            <button onclick="resetFilters()" style="padding: 8px 15px; background: #6c757d; color: white; border: none; border-radius: 6px; cursor: pointer;">
                <i class="fas fa-undo"></i> Reset
            </button>
        </div>

        <!-- Data Table -->
        <div class="table-container">
            <div id="loadingState" class="loading" style="display: none;">
                <i class="fas fa-spinner"></i>
                <p>Memuat data...</p>
            </div>
            
            <div class="table-scroll">
                <table class="data-table" id="lombaTable">
                    <thead>
                        <tr>
                            <th>Lomba</th>
                            <th>Level</th>
                            <th>Cakupan</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        <!-- Data akan dimuat via JavaScript -->
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="pagination" id="pagination">
                <button onclick="changePage('prev')" id="prevBtn">
                    <i class="fas fa-chevron-left"></i> Sebelumnya
                </button>
                <div id="pageNumbers"></div>
                <button onclick="changePage('next')" id="nextBtn">
                    Selanjutnya <i class="fas fa-chevron-right"></i>
                </button>
                <div class="pagination-info" id="paginationInfo"></div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="lombaModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="modalTitle">Tambah Lomba</h3>
                <span class="close" onclick="closeModal()">&times;</span>
            </div>
            <form id="lombaForm">
                <div class="modal-body">
                    <input type="hidden" id="lombaId">
                    
                    <div class="form-group">
                        <label for="title">Nama Lomba *</label>
                        <input type="text" id="title" name="title" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="organizer">Penyelenggara *</label>
                        <input type="text" id="organizer" name="organizer" required>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="level">Level *</label>
                            <select id="level" name="level" required>
                                <option value="">Pilih Level</option>
                                <option value="D3">D3</option>
                                <option value="D4">D4</option>
                                <option value="S1">S1</option>
                                <option value="S2">S2</option>
                                <option value="S3">S3</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="scope">Cakupan *</label>
                            <select id="scope" name="scope" required>
                                <option value="">Pilih Cakupan</option>
                                <option value="Lokal">Lokal</option>
                                <option value="Regional">Regional</option>
                                <option value="Nasional">Nasional</option>
                                <option value="Internasional">Internasional</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="start_date">Tanggal Mulai *</label>
                            <input type="date" id="start_date" name="start_date" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="deadline">Deadline *</label>
                            <input type="date" id="deadline" name="deadline" required>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="category">Kategori</label>
                            <input type="text" id="category" name="category" placeholder="Contoh: Teknologi, Bisnis, Seni">
                        </div>
                        
                        <div class="form-group">
                            <label for="is_active">Status *</label>
                            <select id="is_active" name="is_active" required>
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="cost">Biaya</label>
                        <input type="text" id="cost" name="cost" placeholder="Biaya lomba..."></input>
                    </div>
                    <div class="form-group">
                        <label for="description">Deskripsi</label>
                        <textarea id="description" name="description" placeholder="Deskripsi lomba..."></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="external_url">Link Pendaftaran</label>
                        <input type="url" id="external_url" name="external_url" placeholder="https://...">
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeModal()">Batal</button>
                    <button type="submit" class="btn btn-primary" id="submitBtn">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Mobile Menu Button -->
    <button class="mobile-menu-btn" onclick="toggleSidebar()" style="display: none;">
        <i class="fas fa-bars"></i>
    </button>

    <script>
        // Global variables
        let lombaData = <?php echo json_encode($lombaList); ?>;
        let filteredData = [...lombaData];
        let currentPage = 1;
        let itemsPerPage = 10;
        let isEditing = false;

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            renderTable();
            setupEventListeners();
            setupResponsive();
        });

        // Setup event listeners
        function setupEventListeners() {
            // Filter listeners
            document.getElementById('filterLevel').addEventListener('change', applyFilters);
            document.getElementById('filterScope').addEventListener('change', applyFilters);
            document.getElementById('filterStatus').addEventListener('change', applyFilters);
            document.getElementById('sortBy').addEventListener('change', applyFilters);
            
            // Search listener
            document.getElementById('searchInput').addEventListener('input', debounce(applyFilters, 300));
            
            // Form listener
            document.getElementById('lombaForm').addEventListener('submit', handleFormSubmit);
            
            // Modal listeners
            window.addEventListener('click', function(event) {
                const modal = document.getElementById('lombaModal');
                if (event.target === modal) {
                    closeModal();
                }
            });
        }

        // Setup responsive
        function setupResponsive() {
            if (window.innerWidth <= 768) {
                document.querySelector('.mobile-menu-btn').style.display = 'block';
            }
            
            window.addEventListener('resize', function() {
                if (window.innerWidth <= 768) {
                    document.querySelector('.mobile-menu-btn').style.display = 'block';
                } else {
                    document.querySelector('.mobile-menu-btn').style.display = 'none';
                    document.getElementById('sidebar').classList.remove('open');
                }
            });
        }

        // Toggle sidebar
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('open');
        }

        // Debounce function
        function debounce(func, wait) {
            let timeout;
            return function executedFunction(...args) {
                const later = () => {
                    clearTimeout(timeout);
                    func(...args);
                };
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
            };
        }

        // Apply filters
        function applyFilters() {
            showLoading();
            
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const levelFilter = document.getElementById('filterLevel').value;
            const scopeFilter = document.getElementById('filterScope').value;
            const statusFilter = document.getElementById('filterStatus').value;
            const sortBy = document.getElementById('sortBy').value;
            
            // Filter data
            filteredData = lombaData.filter(item => {
                const matchSearch = !searchTerm || 
                    item.title.toLowerCase().includes(searchTerm) ||
                    item.organizer.toLowerCase().includes(searchTerm);
                    
                const matchLevel = !levelFilter || item.level === levelFilter;
                const matchScope = !scopeFilter || item.scope === scopeFilter;
                
                let matchStatus = true;
                if (statusFilter) {
                    const now = new Date();
                    const deadline = new Date(item.deadline);
                    
                    if (statusFilter === 'active') {
                        matchStatus = item.is_active == 1 && deadline >= now;
                    } else if (statusFilter === 'inactive') {
                        matchStatus = item.is_active == 0;
                    } else if (statusFilter === 'expired') {
                        matchStatus = deadline < now;
                    }
                }
                
                return matchSearch && matchLevel && matchScope && matchStatus;
            });
            
            // Sort data
            filteredData.sort((a, b) => {
                switch(sortBy) {
                    case 'created_at_asc':
                        return new Date(a.created_at) - new Date(b.created_at);
                    case 'created_at_desc':
                        return new Date(b.created_at) - new Date(a.created_at);
                    case 'title_asc':
                        return a.title.localeCompare(b.title);
                    case 'title_desc':
                        return b.title.localeCompare(a.title);
                    case 'deadline_asc':
                        return new Date(a.deadline) - new Date(b.deadline);
                    case 'deadline_desc':
                        return new Date(b.deadline) - new Date(a.deadline);
                    default:
                        return 0;
                }
            });
            
            currentPage = 1;
            renderTable();
            hideLoading();
        }

        // Reset filters
        function resetFilters() {
            document.getElementById('searchInput').value = '';
            document.getElementById('filterLevel').value = '';
            document.getElementById('filterScope').value = '';
            document.getElementById('filterStatus').value = '';
            document.getElementById('sortBy').value = 'created_at_desc';
            
            filteredData = [...lombaData];
            currentPage = 1;
            renderTable();
        }

        // Show/Hide loading
        function showLoading() {
            document.getElementById('loadingState').style.display = 'block';
            document.getElementById('lombaTable').style.opacity = '0.5';
        }

        function hideLoading() {
            document.getElementById('loadingState').style.display = 'none';
            document.getElementById('lombaTable').style.opacity = '1';
        }

        // Render table
        function renderTable() {
            const startIndex = (currentPage - 1) * itemsPerPage;
            const endIndex = startIndex + itemsPerPage;
            const pageData = filteredData.slice(startIndex, endIndex);
            
            const tbody = document.getElementById('tableBody');
            tbody.innerHTML = '';
            
            if (pageData.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 40px; color: #666;">
                            <i class="fas fa-search" style="font-size: 24px; margin-bottom: 10px; display: block;"></i>
                            Tidak ada data yang sesuai dengan filter
                        </td>
                    </tr>
                `;
            } else {
                pageData.forEach(lomba => {
                    const row = createTableRow(lomba);
                    tbody.appendChild(row);
                });
            }
            
            renderPagination();
        }

        // Create table row
        function createTableRow(lomba) {
            const row = document.createElement('tr');
            const now = new Date();
            const deadline = new Date(lomba.deadline);
            const isExpired = deadline < now;
            
            // Determine status
            let statusClass = 'inactive';
            let statusText = 'Tidak Aktif';
            
            if (isExpired) {
                statusClass = 'expired';
                statusText = 'Berakhir';
            } else if (lomba.is_active == 1) {
                statusClass = 'active';
                statusText = 'Aktif';
            }
            
            row.innerHTML = `
                <td>
                    <div class="lomba-title">${escapeHtml(lomba.title)}</div>
                    <div class="lomba-organizer">${escapeHtml(lomba.organizer)}</div>
                </td>
                <td>
                    <span class="status-badge">${escapeHtml(lomba.level)}</span>
                </td>
                <td>${escapeHtml(lomba.scope || 'Nasional')}</td>
                <td>
                    <div style="font-size: 13px;">
                        <div>Mulai: ${formatDate(lomba.start_date)}</div>
                        <div style="color: ${isExpired ? '#dc3545' : '#28a745'};">
                            Deadline: ${formatDate(lomba.deadline)}
                        </div>
                    </div>
                </td>
                <td>
                    <span class="status-badge ${statusClass}">${statusText}</span>
                </td>
                <td>
                    <div class="action-btns">
                        <button class="btn-sm btn-edit" onclick="editLomba(${lomba.id})" title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn-sm btn-delete" onclick="deleteLomba(${lomba.id})" title="Hapus">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </td>
            `;
            
            return row;
        }

        // Render pagination
        function renderPagination() {
            const totalPages = Math.ceil(filteredData.length / itemsPerPage);
            const pagination = document.getElementById('pagination');
            
            if (totalPages <= 1) {
                pagination.style.display = 'none';
                return;
            }
            
            pagination.style.display = 'flex';
            
            // Update buttons
            document.getElementById('prevBtn').disabled = currentPage === 1;
            document.getElementById('nextBtn').disabled = currentPage === totalPages;
            
            // Update page numbers
            const pageNumbers = document.getElementById('pageNumbers');
            pageNumbers.innerHTML = '';
            
            const startPage = Math.max(1, currentPage - 2);
            const endPage = Math.min(totalPages, currentPage + 2);
            
            for (let i = startPage; i <= endPage; i++) {
                const btn = document.createElement('button');
                btn.textContent = i;
                btn.className = i === currentPage ? 'active' : '';
                btn.onclick = () => changePage(i);
                pageNumbers.appendChild(btn);
            }
            
            // Update info
            const start = (currentPage - 1) * itemsPerPage + 1;
            const end = Math.min(currentPage * itemsPerPage, filteredData.length);
            document.getElementById('paginationInfo').textContent = 
                `Menampilkan ${start}-${end} dari ${filteredData.length} data`;
        }

        // Change page
        function changePage(direction) {
            const totalPages = Math.ceil(filteredData.length / itemsPerPage);
            
            if (direction === 'prev' && currentPage > 1) {
                currentPage--;
            } else if (direction === 'next' && currentPage < totalPages) {
                currentPage++;
            } else if (typeof direction === 'number') {
                currentPage = direction;
            }
            
            renderTable();
        }

        // Modal functions
        function openModal(id = null) {
            const modal = document.getElementById('lombaModal');
            const form = document.getElementById('lombaForm');
            
            // Center modal
            modal.style.display = 'flex';
            
            if (id) {
                // Edit mode
                isEditing = true;
                document.getElementById('modalTitle').textContent = 'Edit Lomba';
                document.getElementById('submitBtn').textContent = 'Update';
                loadLombaData(id);
            } else {
                // Add mode
                isEditing = false;
                document.getElementById('modalTitle').textContent = 'Tambah Lomba';
                document.getElementById('submitBtn').textContent = 'Simpan';
                form.reset();
                document.getElementById('lombaId').value = '';
            }
        }

        function closeModal() {
            document.getElementById('lombaModal').style.display = 'none';
        }

        // Load lomba data for editing
        function loadLombaData(id) {
            const lomba = lombaData.find(item => item.id == id);
            if (lomba) {
                document.getElementById('lombaId').value = lomba.id;
                document.getElementById('title').value = lomba.title;
                document.getElementById('organizer').value = lomba.organizer;
                document.getElementById('level').value = lomba.level;
                document.getElementById('scope').value = lomba.scope;
                document.getElementById('start_date').value = lomba.start_date;
                document.getElementById('deadline').value = lomba.deadline;
                document.getElementById('category').value = lomba.category || '';
                document.getElementById('cost').value = lomba.cost || '';
                document.getElementById('description').value = lomba.description || '';
                document.getElementById('external_url').value = lomba.external_url || '';
                document.getElementById('is_active').value = lomba.is_active;
            }
        }

        // Handle form submit
        function handleFormSubmit(e) {
            e.preventDefault();
            
            const formData = new FormData(e.target);
            const action = isEditing ? 'edit' : 'add';
            formData.append('action', action);
            
            if (isEditing) {
                formData.append('id', document.getElementById('lombaId').value);
            }
            
            // Show loading
            const submitBtn = document.getElementById('submitBtn');
            const originalText = submitBtn.textContent;
            submitBtn.textContent = 'Menyimpan...';
            submitBtn.disabled = true;
            
            fetch('', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    closeModal();
                    showAlert('Data berhasil disimpan!', 'success');
                    setTimeout(() => location.reload(), 1000);
                } else {
                    showAlert('Gagal menyimpan data: ' + (data.message || 'Unknown error'), 'error');
                }
            })
            .catch(error => {
                showAlert('Terjadi kesalahan jaringan', 'error');
            })
            .finally(() => {
                submitBtn.textContent = originalText;
                submitBtn.disabled = false;
            });
        }

        // Edit lomba
        function editLomba(id) {
            openModal(id);
        }

        // Delete lomba
        function deleteLomba(id) {
            const lomba = lombaData.find(item => item.id == id);
            if (!lomba) return;
            
            if (confirm(`Apakah Anda yakin ingin menghapus lomba "${lomba.title}"?\n\nTindakan ini tidak dapat dibatalkan.`)) {
                const formData = new FormData();
                formData.append('action', 'delete');
                formData.append('id', id);
                
                fetch('', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showAlert('Data berhasil dihapus!', 'success');
                        setTimeout(() => location.reload(), 1000);
                    } else {
                        showAlert('Gagal menghapus data', 'error');
                    }
                })
                .catch(error => {
                    showAlert('Terjadi kesalahan jaringan', 'error');
                });
            }
        }

        // Utility functions
        function escapeHtml(text) {
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }

        function formatDate(dateString) {
            const date = new Date(dateString);
            return date.toLocaleDateString('id-ID', {
                day: '2-digit',
                month: 'short',
                year: 'numeric'
            });
        }

        function showAlert(message, type = 'info') {
            // Remove existing alerts
            const existingAlerts = document.querySelectorAll('.alert');
            existingAlerts.forEach(alert => alert.remove());
            
            // Create alert
            const alert = document.createElement('div');
            alert.className = `alert alert-${type}`;
            alert.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                padding: 15px 20px;
                border-radius: 8px;
                color: white;
                font-weight: 500;
                z-index: 10000;
                max-width: 400px;
                box-shadow: 0 4px 12px rgba(0,0,0,0.2);
                animation: slideIn 0.3s ease;
            `;
            
            // Set background color based on type
            switch(type) {
                case 'success':
                    alert.style.backgroundColor = '#28a745';
                    break;
                case 'error':
                    alert.style.backgroundColor = '#dc3545';
                    break;
                case 'warning':
                    alert.style.backgroundColor = '#ffc107';
                    alert.style.color = '#000';
                    break;
                default:
                    alert.style.backgroundColor = '#17a2b8';
            }
            
            alert.innerHTML = `
                <div style="display: flex; align-items: center; gap: 10px;">
                    <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' : 'info-circle'}"></i>
                    <span>${message}</span>
                    <button onclick="this.parentElement.parentElement.remove()" style="background: none; border: none; color: inherit; font-size: 18px; cursor: pointer; margin-left: auto;">&times;</button>
                </div>
            `;
            
            document.body.appendChild(alert);
            
            // Auto remove after 5 seconds
            setTimeout(() => {
                if (alert.parentElement) {
                    alert.remove();
                }
            }, 5000);
        }

        // Add CSS animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideIn {
                from {
                    transform: translateX(100%);
                    opacity: 0;
                }
                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }
        `;
        document.head.appendChild(style);

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // Ctrl/Cmd + N = New lomba
            if ((e.ctrlKey || e.metaKey) && e.key === 'n') {
                e.preventDefault();
                openModal();
            }
            
            // Escape = Close modal
            if (e.key === 'Escape') {
                closeModal();
            }
        });

        // Auto-refresh data every 5 minutes
        setInterval(function() {
            if (!document.getElementById('lombaModal').style.display || 
                document.getElementById('lombaModal').style.display === 'none') {
                location.reload();
            }
        }, 300000); // 5 minutes

        // Initialize tooltips for action buttons
        function initTooltips() {
            const buttons = document.querySelectorAll('[title]');
            buttons.forEach(button => {
                button.addEventListener('mouseenter', function(e) {
                    const tooltip = document.createElement('div');
                    tooltip.className = 'tooltip';
                    tooltip.textContent = this.getAttribute('title');
                    tooltip.style.cssText = `
                        position: absolute;
                        background: #333;
                        color: white;
                        padding: 5px 10px;
                        border-radius: 4px;
                        font-size: 12px;
                        z-index: 1000;
                        pointer-events: none;
                        white-space: nowrap;
                    `;
                    
                    document.body.appendChild(tooltip);
                    
                    const rect = this.getBoundingClientRect();
                    tooltip.style.left = rect.left + (rect.width / 2) - (tooltip.offsetWidth / 2) + 'px';
                    tooltip.style.top = rect.top - tooltip.offsetHeight - 5 + 'px';
                    
                    this.addEventListener('mouseleave', function() {
                        tooltip.remove();
                    }, { once: true });
                });
            });
        }

        // Call initTooltips after table render
        const originalRenderTable = renderTable;
        renderTable = function() {
            originalRenderTable();
            setTimeout(initTooltips, 100);
        };

        // Export functions (optional)
        function exportData(format = 'csv') {
            const data = filteredData.map(lomba => ({
                'Nama Lomba': lomba.title,
                'Penyelenggara': lomba.organizer,
                'Level': lomba.level,
                'Cakupan': lomba.scope,
                'Tanggal Mulai': lomba.start_date,
                'Deadline': lomba.deadline,
                'Status': lomba.is_active ? 'Aktif' : 'Tidak Aktif',
                'Kategori': lomba.category || '',
                'Link': lomba.external_url || ''
            }));
            
            if (format === 'csv') {
                const csv = convertToCSV(data);
                downloadFile(csv, 'lomba-data.csv', 'text/csv');
            } else if (format === 'json') {
                const json = JSON.stringify(data, null, 2);
                downloadFile(json, 'lomba-data.json', 'application/json');
            }
        }

        function convertToCSV(data) {
            if (data.length === 0) return '';
            
            const headers = Object.keys(data[0]);
            const csvContent = [
                headers.join(','),
                ...data.map(row => headers.map(header => `"${row[header]}"`).join(','))
            ].join('\n');
            
            return csvContent;
        }

        function downloadFile(content, filename, contentType) {
            const blob = new Blob([content], { type: contentType });
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = filename;
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            window.URL.revokeObjectURL(url);
        }

        // Print function
        function printTable() {
            const printWindow = window.open('', '_blank');
            const tableHTML = document.getElementById('lombaTable').outerHTML;
            
            printWindow.document.write(`
                <!DOCTYPE html>
                <html>
                <head>
                    <title>Data Lomba - SAPRES</title>
                    <style>
                        body { font-family: Arial, sans-serif; margin: 20px; }
                        table { width: 100%; border-collapse: collapse; }
                        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
                        th { background-color: #f2f2f2; }
                        .lomba-title { font-weight: bold; }
                        .lomba-organizer { color: #666; font-size: 12px; }
                        .status-badge { padding: 2px 8px; border-radius: 10px; background: #d4edda; }
                        @media print {
                            .action-btns { display: none; }
                        }
                    </style>
                </head>
                <body>
                    <h1>Data Lomba - SAPRES</h1>
                    <p>Dicetak pada: ${new Date().toLocaleString('id-ID')}</p>
                    ${tableHTML}
                </body>
                </html>
            `);
            
            printWindow.document.close();
            printWindow.print();
        }

        // Add export and print buttons to action bar (optional)
        document.addEventListener('DOMContentLoaded', function() {
            const actionBar = document.querySelector('.action-bar');
            
            // Uncomment to add export and print buttons
            /*
            const exportBtn = document.createElement('button');
            exportBtn.innerHTML = '<i class="fas fa-download"></i> Export';
            exportBtn.className = 'btn btn-secondary';
            exportBtn.style.marginLeft = '10px';
            exportBtn.onclick = () => exportData('csv');
            
            const printBtn = document.createElement('button');
            printBtn.innerHTML = '<i class="fas fa-print"></i> Print';
            printBtn.className = 'btn btn-secondary';
            printBtn.style.marginLeft = '10px';
            printBtn.onclick = printTable;
            
            actionBar.appendChild(exportBtn);
            actionBar.appendChild(printBtn);
            */
        });
    </script>
</body>
</html>



