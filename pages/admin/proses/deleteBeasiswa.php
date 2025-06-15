<?php
    // Koneksi
    include "../../php/koneksi.php";

    // Mengambil id_beasiswa dari URL
    $id_beasiswa = $_GET['id'];

    // Memastikan id_beasiswa valid
    if (isset($id_beasiswa) && is_numeric($id_beasiswa)) {
        // Query DELETE menggunakan prepared statement
        $sql = "DELETE FROM beasiswa WHERE beasiswa_id = ?";

        // Menyiapkan statement PDO
        $stmt = $koneksi->prepare($sql);

        // Menjalankan query dengan parameter
        if ($stmt->execute([$id_beasiswa])) {
            // Jika berhasil, arahkan ke halaman beasiswaAdmin.php dengan notifikasi
            echo "<script>alert('Data Beasiswa Berhasil Dihapus'); window.location.href='../beasiswaAdmin.php';</script>";
        } else {
            // Jika gagal, tampilkan pesan error
            $errorInfo = $stmt->errorInfo();
            echo "Error: " . $errorInfo[2];
        }

    } else {
        // Jika id_beasiswa tidak valid
        echo "<script>alert('ID Beasiswa tidak valid'); window.location.href='../beasiswaAdmin.php';</script>";
    }
?>
