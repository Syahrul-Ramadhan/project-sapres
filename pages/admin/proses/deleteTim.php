<?php
    // Koneksi
    include "../../php/koneksi.php";

    $id_tim = $_GET['id'];
    // 1. Query DELETE
    $sql = "DELETE FROM tim WHERE tim_id = '$id_tim'";
    // 2. Execute Query
    $hasil_query = mysqli_query($koneksi, $sql);
    // 3. kembali ke index.php
    // header('Location: ../timAdmin.php');
    // Notifikasi menggunakan alert
    echo "<script>alert('Data Tim Berhasil Dihapus'); window.location.href='../timAdmin.php';</script>";
?>