<?php
require_once 'php/config.php';

// Initialize variables
$lombaList = [];
$totalLomba = 0;
$currentPage = 1;
$itemsPerPage = 12;
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
    $countStmt = $pdo->prepare($countSql);
    $countStmt->execute($params);
    $totalLomba = $countStmt->fetch(PDO::FETCH_ASSOC)['total'];
    
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
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $lombaList = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Get categories for filter
    $categorySql = "SELECT DISTINCT category FROM lomba WHERE category IS NOT NULL AND category != '' AND is_active = 1 ORDER BY category";
    $categoryStmt = $pdo->query($categorySql);
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
            placeholder="Ketik nama beasiswa/lomba yang ingin kamu cari"
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
      <div class="auth-buttons">
        <a href="login.php"><button class="btn btn-login">MASUK</button></a>
        <a href="register.php"
          ><button class="btn btn-register">DAFTAR</button></a
        >
      </div>
    </nav>
    <!-- NAVBAR END -->

    <!-- DAFTAR LOMBA START -->
    <main class="main-content">
      <div class="page-title">
        <h1>Lomba</h1>
        <p>Temukan berbagai lomba sesuai dengan minat dan bakatmu</p>
      </div>

      <div class="content-wrapper">
        <aside class="filter-sidebar">
          <div class="filter-header">
            <i class="fas fa-filter filter-icon"></i>
            <h2>Filter</h2>
            <button class="filter-toggle" aria-label="Toggle filter">
              <i class="fas fa-chevron-down"></i>
            </button>
          </div>

          <div class="filter-content">
            <div class="filter-section jenjang-section">
              <div class="section-header">
                <h3>Jenjang</h3>
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

            <div class="filter-section skala-section">
              <div class="section-header">
                <h3>Skala Lomba</h3>
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

            <div class="filter-section bidang-section">
              <div class="section-header">
                <h3>Bidang Lomba</h3>
              </div>
              <div class="search-box bidang-search">
                <input type="text" id="categorySearch" placeholder="Cari Bidang" value="<?php echo htmlspecialchars($categoryFilter); ?>" />
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

            <div class="filter-actions">
              <button class="btn-reset" onclick="resetFilters()">Reset Filter</button>
              <button class="btn-apply" onclick="applyFilters()">Terapkan</button>
            </div>
          </div>
        </aside>

        <div class="content-area">
          <div class="month-selector-container">
            <h2 class="section-title">Pilih Bulan</h2>
            <div class="month-selector">
              <?php for ($i = 1; $i <= 12; $i++): ?>
                <div class="month-button <?php echo $currentMonthNum == $i ? 'active' : ''; ?>" 
                     onclick="filterByMonth(<?php echo $i; ?>)">
                  <span><?php echo substr($months[$i], 0, 3); ?></span>
                </div>
              <?php endfor; ?>
            </div>
          </div>

          <div class="competition-container">
            <div class="competition-header">
              <h2 class="section-title">
                Lomba Bulan <?php echo $currentMonthName; ?>
                <span class="count">(<?php echo $totalLomba; ?> lomba)</span>
              </h2>
              <div class="sort-dropdown">
                <select id="sortSelect" onchange="applySorting()">
                  <option value="deadline_asc" <?php echo $sortBy === 'deadline_asc' ? 'selected' : ''; ?>>Deadline Terdekat</option>
                  <option value="deadline_desc" <?php echo $sortBy === 'deadline_desc' ? 'selected' : ''; ?>>Deadline Terjauh</option>
                  <option value="newest" <?php echo $sortBy === 'newest' ? 'selected' : ''; ?>>Terbaru</option>
                  <option value="oldest" <?php echo $sortBy === 'oldest' ? 'selected' : ''; ?>>Terlama</option>
                  <option value="title_asc" <?php echo $sortBy === 'title_asc' ? 'selected' : ''; ?>>Nama A-Z</option>
                  <option value="title_desc" <?php echo $sortBy === 'title_desc' ? 'selected' : ''; ?>>Nama Z-A</option>
                </select>
              </div>
            </div>

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
              <div class="competition-grid" id="competitionGrid">
                <?php foreach ($lombaList as $lomba): ?>
                  <?php
                  $deadline = new DateTime($lomba['deadline']);
                  $startDate = new DateTime($lomba['start_date']);
                  $now = new DateTime();
                  $isExpired = $deadline < $now;
                  $daysLeft = $isExpired ? 0 : $now->diff($deadline)->days;
                  ?>
                  <div class="competition-card" data-id="<?php echo $lomba['id']; ?>">
                    <div class="card-header">
                      <div class="card-image">
                        <?php if (!empty($lomba['image_url'])): ?>
                          <img src="<?php echo htmlspecialchars($lomba['image_url']); ?>" 
                               alt="<?php echo htmlspecialchars($lomba['title']); ?>" />
                        <?php else: ?>
                          <div class="placeholder-image">
                            <i class="fas fa-trophy"></i>
                          </div>
                        <?php endif; ?>
                        <div class="card-overlay">
                          <div class="level-badge">
                            <span><?php echo htmlspecialchars($lomba['level']); ?></span>
                          </div>
                          <div class="scope-badge">
                            <span><?php echo htmlspecialchars($lomba['scope']); ?></span>
                          </div>
                        </div>
                      </div>
                      <div class="bookmark-btn" onclick="toggleBookmark(<?php echo $lomba['id']; ?>, 'lomba')" 
                           data-id="<?php echo $lomba['id']; ?>" data-type="lomba">
                        <i class="far fa-bookmark"></i>
                      </div>
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
                        
                        <?php if (!empty($lomba['category'])): ?>
                          <div class="info-item">
                            <i class="fas fa-tag"></i>
                            <span><?php echo htmlspecialchars($lomba['category']); ?></span>
                          </div>
                        <?php endif; ?>
                      </div>

                      <div class="competition-dates">
                        <div class="date-item start-date">
                          <i class="far fa-calendar-alt"></i>
                          <span>Mulai: <?php echo $startDate->format('d M Y'); ?></span>
                        </div>
                        <div class="date-item deadline <?php echo $isExpired ? 'expired' : ''; ?>">
                          <i class="fas fa-clock"></i>
                          <span>
                            Deadline: <?php echo $deadline->format('d M Y'); ?>
                            <?php if (!$isExpired && $daysLeft <= 7): ?>
                              <span class="urgent">(<?php echo $daysLeft; ?> hari lagi)</span>
                            <?php endif; ?>
                          </span>
                        </div>
                      </div>

                      <?php if ($isExpired): ?>
                        <div class="status-badge expired">
                          <i class="fas fa-times-circle"></i>
                          <span>Berakhir</span>
                        </div>
                      <?php elseif ($daysLeft <= 3): ?>
                        <div class="status-badge urgent">
                          <i class="fas fa-exclamation-triangle"></i>
                          <span>Segera Berakhir</span>
                        </div>
                      <?php else: ?>
                        <div class="status-badge active">
                          <i class="fas fa-check-circle"></i>
                          <span>Aktif</span>
                        </div>
                      <?php endif; ?>
                    </div>

                    <div class="card-footer">
                      <a href="detailLomba.php?id=<?php echo $lomba['id']; ?>" class="btn-detail">
                        Lihat Detail
                      </a>
                      <?php if (!empty($lomba['external_url'])): ?>
                        <a href="<?php echo htmlspecialchars($lomba['external_url']); ?>" 
                           target="_blank" class="btn-register">
                          Daftar Sekarang
                        </a>
                      <?php endif; ?>
                    </div>
                  </div>
                <?php endforeach; ?>
              </div>

              <!-- Pagination -->
              <?php if ($totalPages > 1): ?>
                <div class="pagination-container">
                  <div class="pagination">
                    <?php if ($currentPage > 1): ?>
                      <a href="?<?php echo http_build_query(array_merge($_GET, ['page' => $currentPage - 1])); ?>" 
                         class="pagination-btn prev">
                        <i class="fas fa-chevron-left"></i>
                        Sebelumnya
                      </a>
                    <?php endif; ?>

                    <div class="pagination-numbers">
                      <?php
                      $startPage = max(1, $currentPage - 2);
                      $endPage = min($totalPages, $currentPage + 2);
                      
                      if ($startPage > 1): ?>
                        <a href="?<?php echo http_build_query(array_merge($_GET, ['page' => 1])); ?>" 
                           class="pagination-number">1</a>
                        <?php if ($startPage > 2): ?>
                          <span class="pagination-dots">...</span>
                        <?php endif; ?>
                      <?php endif; ?>

                      <?php for ($i = $startPage; $i <= $endPage; $i++): ?>
                        <a href="?<?php echo http_build_query(array_merge($_GET, ['page' => $i])); ?>" 
                           class="pagination-number <?php echo $i === $currentPage ? 'active' : ''; ?>">
                          <?php echo $i; ?>
                        </a>
                      <?php endfor; ?>

                      <?php if ($endPage < $totalPages): ?>
                        <?php if ($endPage < $totalPages - 1): ?>
                          <span class="pagination-dots">...</span>
                        <?php endif; ?>
                        <a href="?<?php echo http_build_query(array_merge($_GET, ['page' => $totalPages])); ?>" 
                           class="pagination-number"><?php echo $totalPages; ?></a>
                      <?php endif; ?>
                    </div>

                    <?php if ($currentPage < $totalPages): ?>
                      <a href="?<?php echo http_build_query(array_merge($_GET, ['page' => $currentPage + 1])); ?>" 
                         class="pagination-btn next">
                        Selanjutnya
                        <i class="fas fa-chevron-right"></i>
                      </a>
                    <?php endif; ?>
                  </div>
                  
                  <div class="pagination-info">
                    Menampilkan <?php echo (($currentPage - 1) * $itemsPerPage) + 1; ?> - 
                    <?php echo min($currentPage * $itemsPerPage, $totalLomba); ?> 
                    dari <?php echo $totalLomba; ?> lomba
                  </div>
                </div>
              <?php endif; ?>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </main>
    <!-- DAFTAR LOMBA END -->

    <!-- Loading Overlay -->
    <div id="loadingOverlay" class="loading-overlay" style="display: none;">
      <div class="loading-spinner">
        <i class="fas fa-spinner fa-spin"></i>
        <p>Memuat data...</p>
      </div>
    </div>

    <!-- FOOTER START -->
    <?php include 'php/footer.php'; ?>
    <!-- FOOTER END -->

    <script>
      // Global variables
      let currentFilters = {
        level: '<?php echo $levelFilter; ?>',
        scope: '<?php echo $scopeFilter; ?>',
        category: '<?php echo $categoryFilter; ?>',
        month: '<?php echo $monthFilter; ?>',
        search: '<?php echo $searchQuery; ?>',
        sort: '<?php echo $sortBy; ?>',
        page: <?php echo $currentPage; ?>
      };

      // Initialize page
      document.addEventListener('DOMContentLoaded', function() {
        initializeFilters();
        initializeSearch();
        initializeBookmarks();
        initializeResponsive();
      });

      // Initialize filters
      function initializeFilters() {
        // Level filters
        document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
          checkbox.addEventListener('change', function() {
            if (this.checked) {
              // Uncheck other checkboxes in the same group
              const group = this.closest('.checkbox-group');
              group.querySelectorAll('input[type="checkbox"]').forEach(cb => {
                if (cb !== this) cb.checked = false;
              });
            }
          });
        });

        // Category search
        const categorySearch = document.getElementById('categorySearch');
        if (categorySearch) {
          categorySearch.addEventListener('input', debounce(function() {
            filterCategories(this.value);
          }, 300));
        }
      }

      // Initialize search
      function initializeSearch() {
        const searchInput = document.getElementById('searchInput');
        if (searchInput) {
          searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
              performSearch();
            }
          });
        }
      }

      // Initialize bookmarks
      function initializeBookmarks() {
        // Load bookmark status for current user
        loadBookmarkStatus();
      }

      // Initialize responsive features
      function initializeResponsive() {
        const filterToggle = document.querySelector('.filter-toggle');
        const filterContent = document.querySelector('.filter-content');
        
        if (filterToggle && filterContent) {
          filterToggle.addEventListener('click', function() {
            filterContent.classList.toggle('show');
            this.querySelector('i').classList.toggle('fa-chevron-up');
            this.querySelector('i').classList.toggle('fa-chevron-down');
          });
        }

        // Close filter on mobile when clicking outside
        document.addEventListener('click', function(e) {
          if (window.innerWidth <= 768) {
            const sidebar = document.querySelector('.filter-sidebar');
            if (sidebar && !sidebar.contains(e.target)) {
              filterContent.classList.remove('show');
            }
          }
        });
      }

      // Search functions
      function performSearch() {
        const searchInput = document.getElementById('searchInput');
        currentFilters.search = searchInput.value;
        currentFilters.page = 1;
        applyFiltersAndRedirect();
      }

      function toggleSearch() {
        const searchContainer = document.querySelector('.search-container');
        searchContainer.classList.toggle('active');
        
        if (searchContainer.classList.contains('active')) {
          document.getElementById('searchInput').focus();
        }
      }

      // Filter functions
      function filterByMonth(month) {
        currentFilters.month = month;
        currentFilters.page = 1;
        applyFiltersAndRedirect();
      }

      function filterByCategory(category) {
        currentFilters.category = category;
        currentFilters.page = 1;
        applyFiltersAndRedirect();
      }

      function applySorting() {
        const sortSelect = document.getElementById('sortSelect');
        currentFilters.sort = sortSelect.value;
        currentFilters.page = 1;
        applyFiltersAndRedirect();
      }

      function applyFilters() {
        showLoading();
        
        // Get level filter
        const levelCheckbox = document.querySelector('input[name="level"]:checked') || 
                             document.querySelector('.checkbox-group input:checked');
        currentFilters.level = levelCheckbox ? levelCheckbox.value : '';
        
        // Get scope filter
        const scopeCheckbox = document.querySelector('.skala-section input:checked');
        currentFilters.scope = scopeCheckbox ? scopeCheckbox.value : '';
        
        // Get category filter
        const categorySearch = document.getElementById('categorySearch');
        currentFilters.category = categorySearch ? categorySearch.value : '';
        
        currentFilters.page = 1;
        applyFiltersAndRedirect();
      }

      function resetFilters() {
        // Clear all filters
        document.querySelectorAll('input[type="checkbox"]').forEach(cb => cb.checked = false);
        document.getElementById('categorySearch').value = '';
        document.getElementById('searchInput').value = '';
        document.getElementById('sortSelect').value = 'deadline_asc';
        
        // Reset filter object
        currentFilters = {
          level: '',
          scope: '',
          category: '',
          month: '',
          search: '',
          sort: 'deadline_asc',
          page: 1
        };
        
        applyFiltersAndRedirect();
      }
      function applyFiltersAndRedirect() {
        // Build query parameters
        const params = new URLSearchParams();
        
        Object.keys(currentFilters).forEach(key => {
          if (currentFilters[key] && currentFilters[key] !== '') {
            params.append(key, currentFilters[key]);
          }
        });
        
        // Redirect with new parameters
        window.location.href = 'lomba.php?' + params.toString();
      }

      // Bookmark functions
      function toggleBookmark(itemId, itemType) {
        // Check if user is logged in
        if (!isUserLoggedIn()) {
          showLoginPrompt();
          return;
        }

        const bookmarkBtn = document.querySelector(`[data-id="${itemId}"][data-type="${itemType}"]`);
        const icon = bookmarkBtn.querySelector('i');
        const isBookmarked = icon.classList.contains('fas');

        // Show loading state
        icon.className = 'fas fa-spinner fa-spin';

        // Send request to server
        fetch('php/bookmark_handler.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({
            action: isBookmarked ? 'remove' : 'add',
            item_id: itemId,
            item_type: itemType
          })
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            // Update icon
            icon.className = isBookmarked ? 'far fa-bookmark' : 'fas fa-bookmark';
            
            // Show feedback
            showNotification(
              isBookmarked ? 'Bookmark dihapus' : 'Ditambahkan ke bookmark',
              'success'
            );
          } else {
            // Revert icon
            icon.className = isBookmarked ? 'fas fa-bookmark' : 'far fa-bookmark';
            showNotification('Gagal mengubah bookmark', 'error');
          }
        })
        .catch(error => {
          // Revert icon
          icon.className = isBookmarked ? 'fas fa-bookmark' : 'far fa-bookmark';
          showNotification('Terjadi kesalahan jaringan', 'error');
        });
      }

      function loadBookmarkStatus() {
        if (!isUserLoggedIn()) return;

        const lombaIds = Array.from(document.querySelectorAll('.competition-card')).map(card => 
          card.getAttribute('data-id')
        );

        if (lombaIds.length === 0) return;

        fetch('php/bookmark_handler.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({
            action: 'get_status',
            item_ids: lombaIds,
            item_type: 'lomba'
          })
        })
        .then(response => response.json())
        .then(data => {
          if (data.success && data.bookmarks) {
            data.bookmarks.forEach(bookmark => {
              const btn = document.querySelector(`[data-id="${bookmark.item_id}"][data-type="lomba"]`);
              if (btn) {
                btn.querySelector('i').className = 'fas fa-bookmark';
              }
            });
          }
        })
        .catch(error => {
          console.error('Error loading bookmark status:', error);
        });
      }

      // Utility functions
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

      function showLoading() {
        document.getElementById('loadingOverlay').style.display = 'flex';
      }

      function hideLoading() {
        document.getElementById('loadingOverlay').style.display = 'none';
      }

      function isUserLoggedIn() {
        // Check if user is logged in (you can modify this based on your auth system)
        return document.getElementById('profile-section').style.display !== 'none';
      }

      function showLoginPrompt() {
        if (confirm('Anda harus login untuk menyimpan bookmark. Login sekarang?')) {
          window.location.href = 'login.php?redirect=' + encodeURIComponent(window.location.href);
        }
      }

      function showNotification(message, type = 'info') {
        // Remove existing notifications
        const existingNotifications = document.querySelectorAll('.notification');
        existingNotifications.forEach(notification => notification.remove());

        // Create notification element
        const notification = document.createElement('div');
        notification.className = `notification notification-${type}`;
        notification.innerHTML = `
          <div class="notification-content">
            <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' : 'info-circle'}"></i>
            <span>${message}</span>
            <button class="notification-close" onclick="this.parentElement.parentElement.remove()">
              <i class="fas fa-times"></i>
            </button>
          </div>
        `;

        document.body.appendChild(notification);

        // Auto remove after 3 seconds
        setTimeout(() => {
          if (notification.parentElement) {
            notification.remove();
          }
        }, 3000);
      }

      function filterCategories(searchTerm) {
        const tags = document.querySelectorAll('.popular-tags .tag');
        tags.forEach(tag => {
          const text = tag.textContent.toLowerCase();
          const matches = text.includes(searchTerm.toLowerCase());
          tag.style.display = matches ? 'inline-block' : 'none';
        });
      }

      // Keyboard shortcuts
      document.addEventListener('keydown', function(e) {
        // Ctrl/Cmd + K = Focus search
        if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
          e.preventDefault();
          document.getElementById('searchInput').focus();
        }
        
        // Escape = Clear search
        if (e.key === 'Escape') {
          const searchInput = document.getElementById('searchInput');
          if (searchInput === document.activeElement) {
            searchInput.blur();
          }
        }
      });

      // Infinite scroll (optional)
      let isLoadingMore = false;
      
      function initInfiniteScroll() {
        window.addEventListener('scroll', debounce(function() {
          if (isLoadingMore) return;
          
          const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
          const windowHeight = window.innerHeight;
          const documentHeight = document.documentElement.scrollHeight;
          
          if (scrollTop + windowHeight >= documentHeight - 1000) {
            loadMoreLomba();
          }
        }, 100));
      }

      function loadMoreLomba() {
        if (<?php echo $currentPage; ?> >= <?php echo $totalPages; ?>) return;
        
        isLoadingMore = true;
        const nextPage = <?php echo $currentPage + 1; ?>;
        
        // Build URL for next page
        const params = new URLSearchParams(window.location.search);
        params.set('page', nextPage);
        
        fetch('lomba.php?' + params.toString())
        .then(response => response.text())
        .then(html => {
          // Parse HTML and extract competition cards
          const parser = new DOMParser();
          const doc = parser.parseFromString(html, 'text/html');
          const newCards = doc.querySelectorAll('.competition-card');
          
          // Append new cards to grid
          const grid = document.getElementById('competitionGrid');
          newCards.forEach(card => {
            grid.appendChild(card.cloneNode(true));
          });
          
          // Update current page
          currentFilters.page = nextPage;
          
          // Re-initialize bookmarks for new cards
          loadBookmarkStatus();
          
          isLoadingMore = false;
        })
        .catch(error => {
          console.error('Error loading more lomba:', error);
          isLoadingMore = false;
        });
      }

      // Uncomment to enable infinite scroll
      // initInfiniteScroll();
    </script>

    <!-- Include main JavaScript -->
    <script src="../assets/js/main.js"></script>
  </body>
</html>

