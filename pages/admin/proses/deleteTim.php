<?php
    // Koneksi
    include "../../php/koneksi.php";

    // Ambil ID tim dari parameter GET
    $id_tim = $_GET['id'];

    // Pastikan id_tim adalah angka
    if (is_numeric($id_tim)) {
        // 1. Query DELETE menggunakan PDO
        $sql = "DELETE FROM tim WHERE tim_id = :id_tim";
        
        // 2. Prepare statement
        $stmt = $koneksi->prepare($sql);
        
        // 3. Bind parameter
        $stmt->bindParam(':id_tim', $id_tim, PDO::PARAM_INT);
        
        // 4. Execute query
        if ($stmt->execute()) {
            // 5. Redirect dan notifikasi jika berhasil
            echo "<script>alert('Data Tim Berhasil Dihapus'); window.location.href='../timAdmin.php';</script>";
        } else {
            // Menampilkan pesan error jika query gagal
            echo "Gagal menghapus data.";
        }
    } else {
        // Jika ID tidak valid
        echo "ID tim tidak valid.";
    }
?>
