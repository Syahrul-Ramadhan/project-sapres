<?php

    //Koneksi
    include "../../php/koneksi.php";

    // Ambil Variabel dikirim dari FORM
    $judul = $_POST['judul_beasiswa'];
    $jenjang = $_POST['jenjang_beasiswa'];
    $pendaftaran = $_POST['mulai_beasiswa'];
    $penutupan = $_POST['penutupan_beasiswa'];
    $pemberi_beasiswa = $_POST['pemberi_beasiswa'];
    $asal_instansi = $_POST['asal_instansi'];
    $tipe_pendanaan = $_POST['tipe_pendanaan'];
    $benefit = $_POST['benefit_beasiswa'];
    $syarat = $_POST['syarat_beasiswa'];
    $booklet = $_POST['booklet_beasiswa'];
    $lokasi = $_POST['lokasi_beasiswa'];
    $daftar = $_POST['link_pendaftaran'];

    // Gabungkan nilai jenjang yang dipilih menjadi satu string dengan koma
    $jenjang = implode(",", $jenjang);  // Menggabungkan nilai checkbox menjadi string

    // Perintah SQL Insert
    $sql = "INSERT INTO beasiswa(judul_beasiswa, jenjang_beasiswa, mulai_beasiswa, penutupan_beasiswa, pemberi_beasiswa, asal_instansi, tipe_pendanaan, benefit_beasiswa, syarat_beasiswa, booklet_beasiswa, lokasi_beasiswa, daftar_beasiswa) VALUES ('$judul', '$jenjang', '$pendaftaran', '$penutupan', '$pemberi_beasiswa', '$asal_instansi', '$tipe_pendanaan', '$benefit', '$syarat', '$booklet', '$lokasi', '$daftar')";

    // 3. Execute
    $hasil_query = mysqli_query($koneksi, $sql);

    // 4. Validasi
    if ($hasil_query) {
        // Kalau berhasil
        // header('Location: ../beasiswaAdmin.php');
        echo "<script>alert('Data Beasiswa Berhasil Ditambahkan'); window.location.href='../beasiswaAdmin.php';</script>";
    } else {
        // Kalau Gagal
        echo "Data tidak tersimpan, Kembali";
    }

?>