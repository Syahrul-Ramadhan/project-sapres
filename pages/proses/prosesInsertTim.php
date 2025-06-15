<?php

// Koneksi
include "../php/koneksi.php";

// Ambil Variabel dikirim dari FORM
$namaTim = $_POST['nama_tim'];
$jumlahAnggota = $_POST['jumlah_anggota'];
$jenjang = $_POST['jenjang_tim']; // array
$kategori = $_POST['kategori_lomba'];
$judul = $_POST['judul_lomba'];
$asalInstansi = $_POST['asal_instansi'];
$deskripsi = $_POST['deskripsi'];
$syaratKetentuan = $_POST['syarat_ketentuan'];
$cekKTM = isset($_POST['cek_ktm']) ? $_POST['cek_ktm'] : 'tidak_perlu_ktm'; // Jika tidak dicentang, set ke 'tidak_perlu_ktm'
$link = $_POST['link'];

// Gabungkan nilai jenjang yang dipilih menjadi satu string dengan koma
$jenjang = implode(",", $jenjang);  // Menggabungkan nilai checkbox menjadi string

// Menyiapkan SQL Insert menggunakan prepared statement
$sql = "INSERT INTO tim (nama_tim, jumlah_anggota, jenjang_tim, kategori_lomba, judul_lomba, asal_instansi, deskripsi, syarat_ketentuan, cek_ktm, link) 
        VALUES (:nama_tim, :jumlah_anggota, :jenjang_tim, :kategori_lomba, :judul_lomba, :asal_instansi, :deskripsi, :syarat_ketentuan, :cek_ktm, :link)";

// Menyiapkan statement
$stmt = $koneksi->prepare($sql);

// Mengikat parameter ke statement
$stmt->bindParam(':nama_tim', $namaTim, PDO::PARAM_STR);
$stmt->bindParam(':jumlah_anggota', $jumlahAnggota, PDO::PARAM_INT);
$stmt->bindParam(':jenjang_tim', $jenjang, PDO::PARAM_STR);
$stmt->bindParam(':kategori_lomba', $kategori, PDO::PARAM_STR);
$stmt->bindParam(':judul_lomba', $judul, PDO::PARAM_STR);
$stmt->bindParam(':asal_instansi', $asalInstansi, PDO::PARAM_STR);
$stmt->bindParam(':deskripsi', $deskripsi, PDO::PARAM_STR);
$stmt->bindParam(':syarat_ketentuan', $syaratKetentuan, PDO::PARAM_STR);
$stmt->bindParam(':cek_ktm', $cekKTM, PDO::PARAM_STR);
$stmt->bindParam(':link', $link, PDO::PARAM_STR);

// Menjalankan query
if ($stmt->execute()) {
    // Jika berhasil
    echo "<script>alert('Tim Anda Berhasil Dibuat'); window.location.href='../dashboard.php';</script>";
} else {
    // Jika gagal
    echo "Data tidak tersimpan, Kembali";
}

?>
