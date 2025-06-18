<?php
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
    <!-- NAVBAR START -->
    <nav class="navbar">
      <div class="nav-responsive">
        <div class="burger-menu">
          <span></span>
        </div>
        <div class="logo">
          <a href="index.php">SaPres</a>
        </div>
      </div>

      <div class="nav-content">
        <div class="menu-responsive">
          <ul>
            <li><a href="beasiswa.php">Beasiswa</a></li>
            <li><a href="lomba.php">Lomba</a></li>
            <li><a href="cariTim.php">Cari Tim</a></li>
            <li><a href="forum.php">Forum</a></li>
            <li><a href="login.php" class="auth-resp">MASUK</a></li>
            <li>
              <a
                href="register.php"
                class="btn-register register-responsive auth-resp"
                >DAFTAR</a
              >
            </li>
          </ul>
        </div>
        <div class="close-nav"></div>
        <div class="nav-menu">
          <ul class="nav-list">
            <li><a href="beasiswa.php">Beasiswa</a></li>
            <li><a href="lomba.php">Lomba</a></li>
            <li><a href="cariTim.php">Cari Tim</a></li>
            <li><a href="forum.php">Forum</a></li>
          </ul>
        </div>
      </div>
      <div class="search-container">
        <div class="search-bar">
          <input
            type="text"
            id="searchInput"
            placeholder="Ketik nama lomba yang ingin kamu cari"
            value="<?php echo htmlspecialchars($searchQuery); ?>"
          />
        </div>
        <div class="search-btn" onclick="performSearch()">Cari</div>
      </div>
      <div class="nav-item">
        <div class="search-icon" onclick="toggleSearch()">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 24 24"
            width="24"
            height="24"
            color="#333332"
            fill="none"
          >
            <path
              d="M17.5 17.5L22 22"
              stroke="currentColor"
              stroke-width="1.5"
              stroke-linecap="round"
              stroke-linejoin="round"
            />
            <path
              d="M20 11C20 6.02944 15.9706 2 11 2C6.02944 2 2 6.02944 2 11C2 15.9706 6.02944 20 11 20C15.9706 20 20 15.9706 20 11Z"
              stroke="currentColor"
              stroke-width="1.5"
              stroke-linejoin="round"
            />
          </svg>
        </div>
        <?php if (isset($_SESSION['user_id'])): ?>
        <div
          class="profile-container"
          id="profile-section"
          style="display: none"
        >
          <div class="profile-btn">
            <img
              src="../assets/img/user_profile/user_profile.png"
              alt="User Profile"
            />
            <div class="dropdown-profile">
              <a href="dashboard.php">Dashboard</a>
              <a id="logout">Keluar</a>
            </div>
          </div>
        </div>
      </div>
      <?php else: ?>
      <div class="auth-buttons">
        <a href="login.php"><button class="btn btn-login">MASUK</button></a>
        <a href="register.php"
          ><button class="btn btn-register">DAFTAR</button></a
        >
      </div>
      <?php endif; ?>
    </nav>
    <!-- NAVBAR END -->

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

    <!-- FOOTER START -->
    <?php include 'php/footer.php'; ?>
    <!-- FOOTER END -->

    <!-- Loading Overlay -->
    <div class="loading-overlay" id="loadingOverlay" style="display: none;">
      <div class="loading-spinner">
        <i class="fas fa-spinner fa-spin"></i>
        <p>Memuat lomba...</p>
      </div>
    </div>

    <!-- JavaScript -->
    <script src="../assets/js/main.js"></script>
    <script>
      // Global variables
      let currentFilters = {
        level: '<?php echo $levelFilter; ?>',
        scope: '<?php echo $scopeFilter; ?>',
        category: '<?php echo $categoryFilter; ?>',
        month: '<?php echo $monthFilter; ?>',
        search: '<?php echo $searchQuery; ?>',
        sort: '<?php echo $sortBy; ?>'
      };

      // Initialize page
      document.addEventListener('DOMContentLoaded', function() {
        initializeFilters();
        initializeSearch();
        initializeBookmarks();
        handleImageErrors();
      });

      // Initialize filters
      function initializeFilters() {
        // Set checkbox states
        const checkboxes = document.querySelectorAll('input[type="checkbox"]');
        checkboxes.forEach(checkbox => {
          checkbox.addEventListener('change', function() {
            if (this.checked) {
              // Uncheck other checkboxes in the same group
              const group = this.closest('.checkbox-group');
              if (group) {
                group.querySelectorAll('input[type="checkbox"]').forEach(cb => {
                  if (cb !== this) cb.checked = false;
                });
              }
            }
          });
        });

        // Filter toggle for mobile
        const filterToggle = document.querySelector('.filter-toggle');
        const filterContent = document.querySelector('.filter-content');
        
        if (filterToggle && filterContent) {
          filterToggle.addEventListener('click', function() {
            filterContent.classList.toggle('show');
            const icon = this.querySelector('i');
            icon.classList.toggle('fa-chevron-down');
            icon.classList.toggle('fa-chevron-up');
          });
        }
      }

      // Initialize search
      function initializeSearch() {
        const searchInput = document.getElementById('searchInput');
        const categorySearch = document.getElementById('categorySearch');
        
        if (searchInput) {
          searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
              performSearch();
            }
          });
        }
        
        if (categorySearch) {
          categorySearch.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
              currentFilters.search = this.value;
              applyFilters();
            }
          });
        }
      }

      // Initialize bookmarks
      function initializeBookmarks() {
    const cards = document.querySelectorAll('.competition-card');
    const ids = Array.from(cards).map(card => card.dataset.id).filter(Boolean);

    if (ids.length === 0) return;

    fetch('php/bookmark_handler.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({
        action: 'get_status',
        item_type: 'lomba',
        item_ids: ids
      }),
    })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          const bookmarkedIds = new Set(data.bookmarks.map(b => b.item_id.toString()));
          cards.forEach(card => {
            const id = card.dataset.id;
            const icon = card.querySelector('.bookmark-icon');
            if (bookmarkedIds.has(id)) {
              icon.classList.remove('far');
              icon.classList.add('fas');
            }
          });
        }
      });
  }


      // Handle image loading errors
      function handleImageErrors() {
        const images = document.querySelectorAll('.card-image img');
        images.forEach(img => {
          img.addEventListener('error', function() {
            this.style.display = 'none';
            this.parentElement.classList.add('no-image');
          });
          
          // Check if already loaded but broken
          if (img.complete && img.naturalHeight === 0) {
            img.style.display = 'none';
            img.parentElement.classList.add('no-image');
          }
        });
      }

      // Search functions
      function performSearch() {
        const searchInput = document.getElementById('searchInput');
        if (searchInput) {
          currentFilters.search = searchInput.value;
          applyFilters();
        }
      }

      function toggleSearch() {
        const searchContainer = document.querySelector('.search-container');
        if (searchContainer) {
          searchContainer.classList.toggle('active');
        }
      }

      // Filter functions
      function filterByMonth(month) {
        currentFilters.month = month;
        applyFilters();
      }

      function filterByCategory(category) {
        currentFilters.category = currentFilters.category === category ? '' : category;
        applyFilters();
      }

      function sortLomba(sortBy) {
        currentFilters.sort = sortBy;
        applyFilters();
      }

      function resetFilters() {
        // Clear all filters
        currentFilters = {
          level: '',
          scope: '',
          category: '',
          month: '',
          search: '',
          sort: 'deadline_asc'
        };
        
        // Clear form inputs
        document.querySelectorAll('input[type="checkbox"]').forEach(cb => cb.checked = false);
        document.querySelectorAll('input[type="text"]').forEach(input => input.value = '');
        document.getElementById('sort-select').value = 'deadline_asc';
        
        // Remove active states
        document.querySelectorAll('.month-button').forEach(btn => btn.classList.remove('active'));
        document.querySelectorAll('.tag').forEach(tag => tag.classList.remove('active'));
        
        applyFilters();
      }

      function applyFilters() {
        showLoading();
        
        // Get current filter values
        const levelCheckboxes = document.querySelectorAll('.jenjang-section input[type="checkbox"]:checked');
        const scopeCheckboxes = document.querySelectorAll('.skala-section input[type="checkbox"]:checked');
        const categorySearch = document.getElementById('categorySearch');
        
        currentFilters.level = levelCheckboxes.length > 0 ? levelCheckboxes[0].value : '';
        currentFilters.scope = scopeCheckboxes.length > 0 ? scopeCheckboxes[0].value : '';
        currentFilters.search = categorySearch ? categorySearch.value : '';
        
        // Build URL with filters
        const params = new URLSearchParams();
        
        Object.keys(currentFilters).forEach(key => {
          if (currentFilters[key] && currentFilters[key] !== '') {
            params.append(key, currentFilters[key]);
          }
        });
        
        // Reset to page 1 when applying filters
        params.append('page', '1');
        
        // Redirect with new filters
        window.location.href = 'lomba.php?' + params.toString();
      }

      // Bookmark functions
      function toggleBookmark(lombaId, type) {
        fetch('php/auth_check.php')
          .then(response => response.json())
          .then(data => {
            if (!data.logged_in) {
              alert('Silakan login terlebih dahulu untuk menyimpan lomba');
              window.location.href = 'login.php';
              return;
            }

            const icon = document.querySelector(`[onclick="toggleBookmark(${lombaId}, '${type}')"] i`);
            const isBookmarked = icon.classList.contains('fas'); // fas = aktif/bookmarked
            const action = isBookmarked ? 'remove' : 'add';

            return fetch('php/bookmark_handler.php', {
              method: 'POST',
              headers: { 'Content-Type': 'application/json' },
              body: JSON.stringify({
                action,
                item_id: lombaId,
                item_type: type
              })
            });
          })
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              const icon = document.querySelector(`[onclick="toggleBookmark(${lombaId}, '${type}')"] i`);
              if (icon) {
                icon.classList.toggle('fas');
                icon.classList.toggle('far');

                showNotification(
                  data.message || (icon.classList.contains('fas') ? 'Disimpan' : 'Dihapus dari bookmark'),
                  icon.classList.contains('fas') ? 'success' : 'info'
                );
              }
            } else {
              showNotification(data.message || 'Terjadi kesalahan', 'error');
            }
          })
          .catch(error => {
            console.error('Error:', error);
            showNotification('Terjadi kesalahan jaringan', 'error');
          });
      }


      // Utility functions
      function showLoading() {
        const overlay = document.getElementById('loadingOverlay');
        if (overlay) {
          overlay.style.display = 'flex';
        }
      }

      function hideLoading() {
        const overlay = document.getElementById('loadingOverlay');
        if (overlay) {
          overlay.style.display = 'none';
        }
      }

      function showNotification(message, type = 'info') {
        // Remove existing notifications
        const existingNotifications = document.querySelectorAll('.notification');
        existingNotifications.forEach(notification => notification.remove());
        
        // Create notification element
        const notification = document.createElement('div');
        notification.className = `notification ${type}`;
        notification.innerHTML = `
          <div class="notification-content">
            <i class="fas ${type === 'success' ? 'fa-check-circle' : type === 'error' ? 'fa-exclamation-circle' : 'fa-info-circle'}"></i>
            <span>${message}</span>
            <button class="notification-close" onclick="this.parentElement.parentElement.remove()">
              <i class="fas fa-times"></i>
            </button>
          </div>
        `;
        
        // Add to page
        document.body.appendChild(notification);
        
        // Auto remove after 5 seconds
        setTimeout(() => {
          if (notification.parentElement) {
            notification.remove();
          }
        }, 5000);
      }

      // Handle page load completion
      window.addEventListener('load', function() {
        hideLoading();
      });

      // Handle back button
      window.addEventListener('popstate', function(event) {
        location.reload();
      });

      // Mobile responsive functions
      function toggleMobileFilter() {
        const sidebar = document.querySelector('.filter-sidebar');
        if (sidebar) {
          sidebar.classList.toggle('mobile-active');
        }
      }

      // Smooth scroll for pagination
      function scrollToTop() {
        window.scrollTo({
          top: 0,
          behavior: 'smooth'
        });
      }

      // Add click handlers for pagination
      document.addEventListener('DOMContentLoaded', function() {
        const paginationLinks = document.querySelectorAll('.pagination-number, .pagination-btn');
        paginationLinks.forEach(link => {
          link.addEventListener('click', function() {
            showLoading();
            // Scroll to top after a short delay
            setTimeout(scrollToTop, 100);
          });
        });
      });

      // Keyboard navigation
      document.addEventListener('keydown', function(e) {
        // ESC key to close mobile filter
        if (e.key === 'Escape') {
          const sidebar = document.querySelector('.filter-sidebar');
          if (sidebar && sidebar.classList.contains('mobile-active')) {
            sidebar.classList.remove('mobile-active');
          }
        }
        
        // Enter key for search
        if (e.key === 'Enter' && e.target.matches('#searchInput, #categorySearch')) {
          e.preventDefault();
          if (e.target.id === 'searchInput') {
            performSearch();
          } else {
            currentFilters.search = e.target.value;
            applyFilters();
          }
        }
      });

      // Touch/swipe support for mobile
      let touchStartX = 0;
      let touchEndX = 0;

      document.addEventListener('touchstart', function(e) {
        touchStartX = e.changedTouches[0].screenX;
      });

      document.addEventListener('touchend', function(e) {
        touchEndX = e.changedTouches[0].screenX;
        handleSwipe();
      });

      function handleSwipe() {
        const swipeThreshold = 100;
        const sidebar = document.querySelector('.filter-sidebar');
        
        if (touchEndX < touchStartX - swipeThreshold) {
          // Swipe left - close sidebar
          if (sidebar && sidebar.classList.contains('mobile-active')) {
            sidebar.classList.remove('mobile-active');
          }
        }
        
        if (touchEndX > touchStartX + swipeThreshold) {
          // Swipe right - open sidebar
          if (sidebar && !sidebar.classList.contains('mobile-active')) {
            sidebar.classList.add('mobile-active');
          }
        }
      }

      // Intersection Observer for lazy loading (if needed)
      if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
          entries.forEach(entry => {
            if (entry.isIntersecting) {
              const img = entry.target;
              if (img.dataset.src) {
                img.src = img.dataset.src;
                img.removeAttribute('data-src');
                observer.unobserve(img);
              }
            }
          });
        });

        // Observe images with data-src attribute
        document.querySelectorAll('img[data-src]').forEach(img => {
          imageObserver.observe(img);
        });
      }

      // Performance optimization - debounce search
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

      // Debounced search function
      const debouncedSearch = debounce(function(query) {
        currentFilters.search = query;
        applyFilters();
      }, 500);

      // Update search inputs to use debounced search
      document.addEventListener('DOMContentLoaded', function() {
        const categorySearch = document.getElementById('categorySearch');
        if (categorySearch) {
          categorySearch.addEventListener('input', function() {
            debouncedSearch(this.value);
          });
        }
      });
    </script>

    <!-- Additional CSS for notifications and loading -->
    <style>
      .notification {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 10000;
        max-width: 400px;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        animation: slideInRight 0.3s ease-out;
      }

      .notification.success {
        background: #d4edda;
        border: 1px solid #c3e6cb;
        color: #155724;
      }

      .notification.error {
        background: #f8d7da;
        border: 1px solid #f5c6cb;
        color: #721c24;
      }

      .notification.info {
        background: #d1ecf1;
        border: 1px solid #bee5eb;
        color: #0c5460;
      }

      .notification-content {
        display: flex;
        align-items: center;
        padding: 12px 16px;
        gap: 8px;
      }

      .notification-close {
        background: none;
        border: none;
        cursor: pointer;
        margin-left: auto;
        opacity: 0.7;
        transition: opacity 0.2s;
      }

      .notification-close:hover {
        opacity: 1;
      }

      @keyframes slideInRight {
        from {
          transform: translateX(100%);
          opacity: 0;
        }
        to {
          transform: translateX(0);
          opacity: 1;
        }
      }

      .loading-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.9);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
      }

      .loading-spinner {
        text-align: center;
        color: var(--Primary-color);
      }

      .loading-spinner i {
        font-size: 2rem;
        margin-bottom: 10px;
      }

      .empty-state {
        grid-column: 1 / -1;
        text-align: center;
        padding: 60px 20px;
        color: var(--second-font-color);
      }

      .empty-icon {
        font-size: 4rem;
        margin-bottom: 20px;
        opacity: 0.5;
      }

      .empty-state h3 {
        margin-bottom: 10px;
        color: var(--base-font-color);
      }

      .empty-state p {
        margin-bottom: 20px;
      }

      /* Mobile filter overlay */
      @media (max-width: 768px) {
        .filter-sidebar.mobile-active {
          position: fixed;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          z-index: 1000;
          background: white;
          overflow-y: auto;
        }

        .filter-sidebar.mobile-active::before {
          content: '';
          position: fixed;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          background: rgba(0, 0, 0, 0.5);
          z-index: -1;
        }
      }

      /* Pagination styles */
      .pagination-container {
        margin-top: 40px;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 20px;
      }

      .pagination {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
        justify-content: center;
      }

      .pagination-btn,
      .pagination-number {
        display: flex;
        align-items: center;
        gap: 5px;
        padding: 8px 12px;
        border: 1px solid #ddd;
        border-radius: 6px;
        text-decoration: none;
        color: var(--base-font-color);
        transition: all 0.2s;
        min-width: 44px;
        min-height: 44px;
        justify-content: center;
      }

      .pagination-number.active {
        background: var(--Primary-color);
        color: white;
        border-color: var(--Primary-color);
      }

      .pagination-btn:hover,
      .pagination-number:hover {
        background: var(--fill-color);
        border-color: var(--Primary-color);
      }

      .pagination-dots {
        padding: 8px 4px;
        color: var(--second-font-color);
      }

      .pagination-info {
        color: var(--second-font-color);
        font-size: 0.9rem;
        text-align: center;
      }

      @media (max-width: 640px) {
        .pagination {
          gap: 5px;
        }
        
        .pagination-btn,
        .pagination-number {
          padding: 6px 8px;
          font-size: 0.9rem;
        }
        
        .pagination-btn span {
          display: none;
        }
      }
    </style>
  </body>
</html>

