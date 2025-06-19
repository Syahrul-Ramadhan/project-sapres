<?php

    // Koneksi
    include "../../php/koneksi.php";

    // Mengambil data dari form
    $judul = $_POST['edit-judul_beasiswa'];
    $jenjang = $_POST['edit-jenjang_beasiswa'];
    $pendaftaran = $_POST['edit-mulai_beasiswa'];  
    $penutupan = $_POST['edit-penutupan_beasiswa'];  
    $pemberi_beasiswa = $_POST['edit-pemberi_beasiswa'];
    $asal_instansi = $_POST['edit-asal_instansi'];
    $tipe_pendanaan = $_POST['edit-tipe_pendanaan'];
    $benefit = $_POST['edit-benefit_beasiswa'];
    $syarat = $_POST['edit-syarat_beasiswa'];
    $booklet = $_POST['edit-booklet_beasiswa'];
    $lokasi = $_POST['edit-lokasi_beasiswa'];
    $daftar = $_POST['edit-link_pendaftaran'];
    $id = $_POST['edit-beasiswa_id'];

    // Format tanggal menjadi Y-m-d sebelum memasukkannya ke query
    $pendaftaranValid = date("Y-m-d", strtotime($pendaftaran));  // Mengubah format tanggal
    $penutupanValid = date("Y-m-d", strtotime($penutupan));  // Mengubah format tanggal

    // Gabungkan nilai jenjang yang dipilih menjadi satu string dengan koma
    $jenjang = implode(",", $jenjang);  // Menggabungkan nilai checkbox menjadi string

    // Query untuk update data beasiswa menggunakan prepared statement
    $sql = "UPDATE beasiswa SET 
                judul_beasiswa = ?, 
                jenjang_beasiswa = ?, 
                mulai_beasiswa = ?, 
                penutupan_beasiswa = ?, 
                pemberi_beasiswa = ?, 
                asal_instansi = ?, 
                tipe_pendanaan = ?, 
                benefit_beasiswa = ?, 
                syarat_beasiswa = ?, 
                booklet_beasiswa = ?, 
                lokasi_beasiswa = ?, 
                daftar_beasiswa = ? 
            WHERE beasiswa_id = ?";

    // Menyiapkan statement PDO
    $stmt = $koneksi->prepare($sql);

    // Menjalankan query dengan parameter (PDO)
    if ($stmt->execute([
        $judul,
        $jenjang,
        $pendaftaranValid,
        $penutupanValid,
        $pemberi_beasiswa,
        $asal_instansi,
        $tipe_pendanaan,
        $benefit,
        $syarat,
        $booklet,
        $lokasi,
        $daftar,
        $id
    ])) {
        // Jika berhasil
        echo "<script>alert('Data Beasiswa Berhasil Diubah'); window.location.href='../beasiswaAdmin.php';</script>";
    } else {
        // Jika gagal
        $errorInfo = $stmt->errorInfo();
        echo "Data tidak tersimpan. Error: " . $errorInfo[2];
    }

    // Menutup statement
    $stmt = null;

?>
