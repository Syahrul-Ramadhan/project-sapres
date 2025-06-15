<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sapres</title>
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    />
    <link rel="stylesheet" href="../../assets/css/admin/sidenav.css">
    <link rel="stylesheet" href="../../assets/css/admin/dashboardAdmin.css">
</head>
<body>

    <?php
        include "../php/koneksi.php";
        
        // Fetch data for the dashboard using PDO
        $sql = "SELECT COUNT(*) AS total_beasiswa FROM beasiswa";
        $stmt = $koneksi->prepare($sql);
        $stmt->execute();
        $data_beasiswa = $stmt->fetch(PDO::FETCH_ASSOC);
        $jumlah_beasiswa = $data_beasiswa['total_beasiswa'];

        // Fetch competition data
        $sql = "SELECT COUNT(*) AS total_lomba FROM lomba";
        $stmt = $koneksi->prepare($sql);
        $stmt->execute();
        $data_lomba = $stmt->fetch(PDO::FETCH_ASSOC);
        $jumlah_lomba = $data_lomba['total_lomba'];

        // Fetch team data
        $sql = "SELECT COUNT(*) AS total_tim FROM tim";
        $stmt = $koneksi->prepare($sql);
        $stmt->execute();
        $data_tim = $stmt->fetch(PDO::FETCH_ASSOC);
        $jumlah_tim = $data_tim['total_tim'];

        // Fetch forum data
        $sql = "SELECT COUNT(*) AS total_forum FROM forum";
        $stmt = $koneksi->prepare($sql);
        $stmt->execute();
        $data_forum = $stmt->fetch(PDO::FETCH_ASSOC);
        $jumlah_forum = $data_forum['total_forum'];
    ?>

    <!-- SIDE NAV START -->
        <div class="side-nav">
        <div class="container">
            <div class="nav-header">
            <div class="title">
                <h2>Sapres</h2>
            </div>
            <div class="nav-list">
                <ul>
                    <li><img src="../../assets/img/icons/dashboard-admin/pie-chart.png" alt="chart-icon"><a href="dashboardAdmin.php">Dashboard</a></li>
                    <li><img src="../../assets/img/icons/dashboard-admin/dollar-currency-symbol.png" alt="beasiswa-icon"><a href="beasiswaAdmin.php">Beasiswa</a></li>
                    <li><img src="../../assets/img/icons/dashboard-admin/trophy.png" alt="lomba-icon"><a href="lombaAdmin.php">Lomba</a></li>
                    <li><img src="../../assets/img/icons/dashboard-admin/group-users.png" alt="team-icon"><a href="timAdmin.php">Tim</a></li>
                    <li><img src="../../assets/img/icons/dashboard-admin/chat.png" alt="forum-icon"><a href="forumAdmin.php">Forum</a></li>
                </ul>
            </div>
        </div>
        <div class="nav-footer">
            <div class="profile">
                <img src="../../assets/img/user_profile/default_profile.png" alt="Profile Picture">
                <div class="profile-info">
                    <h4>Icibos</h4>
                    <p>Admin</p>
                </div>
            </div>
            <a href="" class="log-out">
                <i class="fa-solid fa-arrow-right-from-bracket fa-rotate-180"></i>
                Log out
            </a>
        </div>
        </div>
    </div>
    <!-- SIDE NAV END -->

    <div class="main-container">
        <h2 class="tittle">Dashboard</h2>

        <div class="dashboard-container">
            <div class="card-list">
                <div class="card">
                    <div class="card-title">
                        <img src="../../assets/img/icons/dashboard-admin/dollar-currency-symbol (1).png" alt="dollar-icon">
                    </div>
                    <div class="card-info">
                        <h3>Jumlah Beasiswa</h3>
                        <p><?php echo $jumlah_beasiswa?></p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-title">
                        <img src="../../assets/img/icons/dashboard-admin/trophy (1).png" alt="lomba-icon">
                    </div>
                    <div class="card-info">
                        <h3>Jumlah Lomba</h3>
                        <p><?php echo $jumlah_lomba?></p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-title">
                        <img src="../../assets/img/icons/dashboard-admin/group-users (1).png" alt="team-icon">
                    </div>
                    <div class="card-info">
                        <h3>Jumlah Tim</h3>
                        <p><?php echo $jumlah_tim?></p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-title">
                        <img src="../../assets/img/icons/dashboard-admin/chat (1).png" alt="forum-icon">
                    </div>
                    <div class="card-info">
                        <h3>Jumlah Forum</h3>
                        <p><?php echo $jumlah_forum?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>