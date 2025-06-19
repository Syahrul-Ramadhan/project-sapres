<?php
// Force session start
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

require_once 'php/session_manager.php';
require_once 'php/koneksi.php';
require_once 'php/check_login.php';

$user_id = $_SESSION['user_id'];

// Initialize variables
$lombaList = [];
$totalLomba = 0;
$currentPage = 1;
$itemsPerPage = 15; // Changed to 15 items per page
$totalPages = 1;

// Get filter parameters
$levelFilter = $_GET['level'] ?? '';
$scopeFilter = $_GET['scope'] ?? '';
$categoryFilter = $_GET['category'] ?? '';
$monthFilter = $_GET['month'] ?? '';
$searchQuery = $_GET['search'] ?? '';
$sortBy = $_GET['sort'] ?? 'deadline_asc';

try {
    // Build WHERE clause
    $whereConditions = ['l.is_active = 1'];
    $params = [];
    
    if (!empty($levelFilter)) {
        $whereConditions[] = 'l.level = ?';
        $params[] = $levelFilter;
    }
    
    if (!empty($scopeFilter)) {
        $whereConditions[] = 'l.scope = ?';
        $params[] = $scopeFilter;
    }
    
    if (!empty($categoryFilter)) {
        $whereConditions[] = 'l.category LIKE ?';
        $params[] = '%' . $categoryFilter . '%';
    }
    
    if (!empty($monthFilter)) {
        $whereConditions[] = 'MONTH(l.deadline) = ?';
        $params[] = $monthFilter;
    }
    
    if (!empty($searchQuery)) {
        $whereConditions[] = '(l.title LIKE ? OR l.organizer LIKE ? OR l.description LIKE ?)';
        $params[] = '%' . $searchQuery . '%';
        $params[] = '%' . $searchQuery . '%';
        $params[] = '%' . $searchQuery . '%';
    }
    
    $whereClause = implode(' AND ', $whereConditions);
    
    // Build ORDER BY clause
    $orderBy = 'l.created_at DESC';
    switch ($sortBy) {
        case 'deadline_asc':
            $orderBy = 'l.deadline ASC';
            break;
        case 'deadline_desc':
            $orderBy = 'l.deadline DESC';
            break;
        case 'newest':
            $orderBy = 'l.created_at DESC';
            break;
        case 'oldest':
            $orderBy = 'l.created_at ASC';
            break;
        case 'title_asc':
            $orderBy = 'l.title ASC';
            break;
        case 'title_desc':
            $orderBy = 'l.title DESC';
            break;
    }
    
    // Get total count
    $countSql = "SELECT COUNT(*) as total FROM lomba l WHERE $whereClause";
    $countStmt = $koneksi->prepare($countSql);
    $countStmt->execute($params);
    $totalLomba = $countStmt->fetch()['total'];
    
    // Calculate pagination
    $currentPage = max(1, intval($_GET['page'] ?? 1));
    $totalPages = ceil($totalLomba / $itemsPerPage);
    $offset = ($currentPage - 1) * $itemsPerPage;
    
    // Get lomba data with pagination
    $sql = "SELECT l.*, 
            CASE 
                WHEN l.deadline < CURDATE() THEN 'expired'
                WHEN l.is_active = 1 AND l.deadline >= CURDATE() THEN 'active'
                ELSE 'inactive'
            END as status
            FROM lomba l 
            WHERE $whereClause 
            ORDER BY $orderBy 
            LIMIT $itemsPerPage OFFSET $offset";
    
    $stmt = $koneksi->prepare($sql);
    $stmt->execute($params);
    $lombaList = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Get categories for filter
    $categorySql = "SELECT DISTINCT category FROM lomba WHERE category IS NOT NULL AND category != '' AND is_active = 1 ORDER BY category";
    $categoryStmt = $koneksi->query($categorySql);
    $categories = $categoryStmt->fetchAll(PDO::FETCH_COLUMN);
    
} catch (Exception $e) {
    error_log("Error fetching lomba: " . $e->getMessage());
    $lombaList = [];
}

// Get current month name for display
$months = [
    1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
    5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
    9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
];

$currentMonthNum = $monthFilter ?: date('n');
$currentMonthName = $months[$currentMonthNum];
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Lomba - SAPRES</title>
    <link
      rel="icon"
      type="image/png"
      href="../assets/img/icons/forum_beasiswa.png"
    />
    <link rel="stylesheet" href="../assets/css/style.css" />
    <link rel="stylesheet" href="../assets/css/lomba.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    />
  </head>
  <body>
    <?php include 'php/navbar.php'; ?>
    
    <!-- MAIN CONTENT START -->
    <main class="main-content">
      <div class="content-wrapper">
        <!-- FILTER SIDEBAR -->
        <aside class="filter-sidebar">
          <div class="filter-header">
            <h2><i class="fas fa-filter filter-icon"></i>Filter Lomba</h2>
            <button class="filter-toggle">
              <i class="fas fa-chevron-down"></i>
            </button>
          </div>
          
          <div class="filter-content">
            <!-- Search Filter -->
            <div class="filter-section">
              <div class="section-header">
                <h3>Cari Lomba</h3>
              </div>
              <div class="search-box">
                <input type="text" placeholder="Nama lomba..." id="categorySearch" value="<?php echo htmlspecialchars($searchQuery); ?>">
              </div>
            </div>

            <!-- Level Filter -->
            <div class="filter-section jenjang-section">
              <div class="section-header">
                <h3>Tingkat Pendidikan</h3>
              </div>
              <div class="checkbox-group">
                <div class="checkbox-item">
                  <input type="checkbox" id="d3" value="D3" <?php echo $levelFilter === 'D3' ? 'checked' : ''; ?> />
                  <label for="d3">D3</label>
                </div>
                <div class="checkbox-item">
                  <input type="checkbox" id="d4" value="D4" <?php echo $levelFilter === 'D4' ? 'checked' : ''; ?> />
                  <label for="d4">D4</label>
                </div>
                <div class="checkbox-item">
                  <input type="checkbox" id="s1" value="S1" <?php echo $levelFilter === 'S1' ? 'checked' : ''; ?> />
                  <label for="s1">S1</label>
                </div>
                <div class="checkbox-item">
                  <input type="checkbox" id="s2" value="S2" <?php echo $levelFilter === 'S2' ? 'checked' : ''; ?> />
                  <label for="s2">S2</label>
                </div>
                <div class="checkbox-item">
                  <input type="checkbox" id="s3" value="S3" <?php echo $levelFilter === 'S3' ? 'checked' : ''; ?> />
                  <label for="s3">S3</label>
                </div>
              </div>
            </div>

            <!-- Scope Filter -->
            <div class="filter-section skala-section">
              <div class="section-header">
                <h3>Tingkat Lomba</h3>
              </div>
              <div class="checkbox-group">
                <div class="checkbox-item">
                  <input type="checkbox" id="lokal" value="Lokal" <?php echo $scopeFilter === 'Lokal' ? 'checked' : ''; ?> />
                  <label for="lokal">Lokal</label>
                </div>
                <div class="checkbox-item">
                  <input type="checkbox" id="regional" value="Regional" <?php echo $scopeFilter === 'Regional' ? 'checked' : ''; ?> />
                  <label for="regional">Regional</label>
                </div>
                <div class="checkbox-item">
                  <input type="checkbox" id="nasional" value="Nasional" <?php echo $scopeFilter === 'Nasional' ? 'checked' : ''; ?> />
                  <label for="nasional">Nasional</label>
                </div>
                <div class="checkbox-item">
                  <input type="checkbox" id="internasional" value="Internasional" <?php echo $scopeFilter === 'Internasional' ? 'checked' : ''; ?> />
                  <label for="internasional">Internasional</label>
                </div>
              </div>
            </div>

            <!-- Popular Tags -->
            <div class="filter-section bidang-section">
              <div class="section-header">
                <h3>Kategori Populer</h3>
              </div>
              <div class="popular-tags">
                <?php foreach (array_slice($categories, 0, 8) as $category): ?>
                  <span class="tag <?php echo $categoryFilter === $category ? 'active' : ''; ?>" 
                        onclick="filterByCategory('<?php echo htmlspecialchars($category); ?>')">
                    <?php echo htmlspecialchars($category); ?>
                  </span>
                <?php endforeach; ?>
              </div>
            </div>

            <!-- Filter Actions -->
            <div class="filter-actions">
              <button class="btn-reset" onclick="resetFilters()">Reset Filter</button>
              <button class="btn-apply" onclick="applyFilters()">Terapkan</button>
            </div>
          </div>
        </aside>

        <!-- CONTENT AREA -->
        <div class="content-area">
          <!-- Month Selector -->
          <section class="month-selector-container">
            <h2 class="section-title">
              Pilih Bulan <span class="count">(<?php echo $totalLomba; ?> lomba tersedia)</span>
            </h2>
            <div class="month-selector">
              <div class="month-button <?php echo empty($monthFilter) ? 'active' : ''; ?>" 
                   onclick="filterByMonth('')">
                <span>Semua Bulan</span>
              </div>
              <?php for ($i = 1; $i <= 12; $i++): ?>
                <div class="month-button <?php echo $monthFilter == $i ? 'active' : ''; ?>" 
                     onclick="filterByMonth(<?php echo $i; ?>)">
                  <span><?php echo $months[$i]; ?></span>
                </div>
              <?php endfor; ?>
            </div>
          </section>

          <!-- Competition Container -->
          <section class="competition-container">
            <div class="competition-header">
              <h2 class="section-title">Daftar Lomba</h2>
              <div class="sort-dropdown">
                <select id="sort-select" onchange="sortLomba(this.value)">
                  <option value="deadline_asc" <?php echo $sortBy === 'deadline_asc' ? 'selected' : ''; ?>>Deadline Terdekat</option>
                  <option value="newest" <?php echo $sortBy === 'newest' ? 'selected' : ''; ?>>Terbaru</option>
                  <option value="title_asc" <?php echo $sortBy === 'title_asc' ? 'selected' : ''; ?>>A-Z</option>
                  <option value="title_desc" <?php echo $sortBy === 'title_desc' ? 'selected' : ''; ?>>Z-A</option>
                </select>
              </div>
            </div>

            <!-- Competition Grid -->
            <div class="competition-grid" id="competition-grid">
              <?php if (empty($lombaList)): ?>
                <div class="empty-state">
                  <div class="empty-icon">
                    <i class="fas fa-trophy"></i>
                  </div>
                  <h3>Tidak Ada Lomba Ditemukan</h3>
                  <p>Coba ubah filter atau kata kunci pencarian Anda</p>
                  <button class="btn-reset" onclick="resetFilters()">Reset Filter</button>
                </div>
              <?php else: ?>
                <?php foreach ($lombaList as $lomba): ?>
                  <?php
                    $deadline = new DateTime($lomba['deadline']);
                    $startDate = new DateTime($lomba['start_date']);
                    $today = new DateTime();
                    
                    $isExpired = $deadline < $today;
                    $isUrgent = $deadline->diff($today)->days <= 7 && !$isExpired;
                    
                    $statusClass = $isExpired ? 'expired' : ($isUrgent ? 'urgent' : 'active');
                    $statusText = $isExpired ? 'Pendaftaran Ditutup' : ($isUrgent ? 'Segera Berakhir' : 'Pendaftaran Dibuka');
                    $statusIcon = $isExpired ? 'fas fa-times-circle' : ($isUrgent ? 'fas fa-exclamation-triangle' : 'fas fa-circle');
                  ?>
                  
                  <article class="competition-card" data-id="<?php echo $lomba['id']; ?>">
                    <div class="card-header">
                      <div class="card-image <?php echo empty($lomba['image_url']) ? 'no-image' : ''; ?>">
                        <?php if (!empty($lomba['image_url'])): ?>
                          <img src="<?php echo htmlspecialchars($lomba['image_url']); ?>" 
                               alt="<?php echo htmlspecialchars($lomba['title']); ?>" 
                               onerror="this.style.display='none'; this.parentElement.classList.add('no-image');">
                        <?php endif; ?>
                      </div>
                      <div class="card-overlay">
                        <span class="level-badge"><?php echo htmlspecialchars($lomba['level']); ?></span>
                        <span class="scope-badge"><?php echo htmlspecialchars($lomba['scope']); ?></span>
                      </div>
                      <button class="bookmark-btn" aria-label="Bookmark lomba" 
                              onclick="toggleBookmark(<?php echo $lomba['id']; ?>, 'lomba')">
                        <i class="far fa-bookmark"></i>
                      </button>
                    </div>
                    <div class="card-content">
                      <h3 class="competition-title">
                        <a href="detailLomba.php?id=<?php echo $lomba['id']; ?>">
                          <?php echo htmlspecialchars($lomba['title']); ?>
                        </a>
                      </h3>
                      <div class="competition-info">
                        <div class="info-item">
                          <i class="fas fa-building"></i>
                          <span><?php echo htmlspecialchars($lomba['organizer']); ?></span>
                        </div>
                        <div class="info-item">
                          <i class="fas fa-globe"></i>
                          <span>Tingkat <?php echo htmlspecialchars($lomba['scope']); ?></span>
                        </div>
                        <div class="info-item">
                          <i class="fas fa-graduation-cap"></i>
                          <span>untuk <?php echo htmlspecialchars($lomba['level']); ?></span>
                        </div>
                      </div>
                      <div class="competition-dates">
                        <div class="date-item">
                          <i class="far fa-calendar-alt"></i>
                          <span>Mulai: <?php echo $startDate->format('d M Y'); ?></span>
                        </div>
                        <div class="date-item deadline <?php echo $isExpired ? 'expired' : ($isUrgent ? 'urgent' : ''); ?>">
                          <i class="fas fa-clock"></i>
                          <span>Deadline: <?php echo $deadline->format('d M Y'); ?></span>
                        </div>
                      </div>
                      <div class="status-badge <?php echo $statusClass; ?>">
                        <i class="<?php echo $statusIcon; ?>"></i>
                        <span><?php echo $statusText; ?></span>
                      </div>
                    </div>
                    <div class="card-footer">
                      <a href="detailLomba.php?id=<?php echo $lomba['id']; ?>" class="btn-detail">Detail</a>
                      <?php if (!$isExpired): ?>
                        <a href="<?php echo htmlspecialchars($lomba['external_url'] ?? '#'); ?>" 
                           class="btn-register" target="_blank" rel="noopener">Daftar</a>
                      <?php else: ?>
                        <button class="btn-register" disabled>Ditutup</button>
                      <?php endif; ?>
                    </div>
                  </article>
                <?php endforeach; ?>
              <?php endif; ?>
            </div>

            <!-- Pagination -->
            <?php if ($totalPages > 1): ?>
              <div class="pagination-container">
                <div class="pagination">
                  <!-- Previous Button -->
                  <?php if ($currentPage > 1): ?>
                    <a href="?<?php echo http_build_query(array_merge($_GET, ['page' => $currentPage - 1])); ?>" 
                       class="pagination-btn">
                      <i class="fas fa-chevron-left"></i>
                      <span>Sebelumnya</span>
                    </a>
                  <?php endif; ?>

                  <!-- Page Numbers -->
                  <div class="pagination-numbers">
                    <?php
                    $startPage = max(1, $currentPage - 2);
                    $endPage = min($totalPages, $currentPage + 2);
                    
                    // Show first page if not in range
                    if ($startPage > 1): ?>
                      <a href="?<?php echo http_build_query(array_merge($_GET, ['page' => 1])); ?>" 
                         class="pagination-number">1</a>
                      <?php if ($startPage > 2): ?>
                        <span class="pagination-dots">...</span>
                      <?php endif; ?>
                    <?php endif; ?>

                    <!-- Page range -->
                    <?php for ($i = $startPage; $i <= $endPage; $i++): ?>
                      <a href="?<?php echo http_build_query(array_merge($_GET, ['page' => $i])); ?>" 
                         class="pagination-number <?php echo $i === $currentPage ? 'active' : ''; ?>">
                        <?php echo $i; ?>
                      </a>
                    <?php endfor; ?>

                    <!-- Show last page if not in range -->
                    <?php if ($endPage < $totalPages): ?>
                      <?php if ($endPage < $totalPages - 1): ?>
                        <span class="pagination-dots">...</span>
                      <?php endif; ?>
                      <a href="?<?php echo http_build_query(array_merge($_GET, ['page' => $totalPages])); ?>" 
                         class="pagination-number"><?php echo $totalPages; ?></a>
                    <?php endif; ?>
                  </div>

                  <!-- Next Button -->
                  <?php if ($currentPage < $totalPages): ?>
                    <a href="?<?php echo http_build_query(array_merge($_GET, ['page' => $currentPage + 1])); ?>" 
                       class="pagination-btn">
                      <span>Selanjutnya</span>
                      <i class="fas fa-chevron-right"></i>
                    </a>
                  <?php endif; ?>
                </div>
                
                <!-- Pagination Info -->
                <div class="pagination-info">
                  <span>Menampilkan <?php echo (($currentPage - 1) * $itemsPerPage) + 1; ?> - 
                        <?php echo min($currentPage * $itemsPerPage, $totalLomba); ?> 
                        dari <?php echo $totalLomba; ?> lomba</span>
                </div>
              </div>
            <?php endif; ?>
          </section>
        </div>
      </div>
    </main>
    <!-- MAIN CONTENT END -->

    <?php include 'php/footer.php'; ?>
    
    <!-- Loading Overlay -->
    <div class="loading-overlay" id="loadingOverlay" style="display: none;">
      <div class="loading-spinner">
        <i class="fas fa-spinner fa-spin"></i>
        <p>Memuat lomba...</p>
      </div>
    </div>

    <!-- JavaScript -->
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/auth.js"></script>
  </body>
</html>
