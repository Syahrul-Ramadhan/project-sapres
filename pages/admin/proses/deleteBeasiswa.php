<?php
    // Koneksi
    include "../../php/koneksi.php";

    $id_beasiswa = $_GET['id'];
    // 1. Query DELETE
    $sql = "DELETE FROM beasiswa WHERE beasiswa_id = '$id_beasiswa'";
    // 2. Execute Query
    $hasil_query = mysqli_query($koneksi, $sql);
    // 3. kembali ke index.php
    // header('Location: ../beasiswaAdmin.php');
    //notifikasi menggunakan alert
    echo "<script>alert('Data Beasiswa Berhasil Dihapus'); window.location.href='../beasiswaAdmin.php';</script>";
?>