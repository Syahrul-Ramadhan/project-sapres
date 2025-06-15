<?php

    //Koneksi
    include "../../php/koneksi.php";

    // Mengambil data dari form
    $judul = $_POST['edit-judul_beasiswa'];
    $jenjang =$_POST['edit-jenjang_beasiswa'];
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

    // Query untuk update data beasiswa
    $sql = "UPDATE beasiswa SET 
                judul_beasiswa = '$judul', 
                jenjang_beasiswa = '$jenjang', 
                mulai_beasiswa = '$pendaftaranValid',
                penutupan_beasiswa = '$penutupanValid', 
                pemberi_beasiswa = '$pemberi_beasiswa', 
                asal_instansi = '$asal_instansi', 
                tipe_pendanaan = '$tipe_pendanaan', 
                benefit_beasiswa = '$benefit', 
                syarat_beasiswa = '$syarat', 
                booklet_beasiswa = '$booklet', 
                lokasi_beasiswa = '$lokasi', 
                daftar_beasiswa = '$daftar' 
            WHERE beasiswa_id = '$id'";

    //  Execute
    $hasil_query = mysqli_query($koneksi, $sql);

    // Validasi
    if ($hasil_query) {
        // Kalau berhasil
        // header('Location: ../beasiswaAdmin.php');
        echo "<script>alert('Data Beasiswa Berhasil Diubah'); window.location.href='../beasiswaAdmin.php';</script>";
    } else {
        // Kalau Gagal
        echo "Data tidak tersimpan, Kembali";
    }
?>