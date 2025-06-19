<?php
session_start();
include "../php/koneksi.php";
require_once '../php/session_manager.php';

$user_id = $_SESSION['user_id'];

// Ambil Variabel dari FORM
$namaTim = $_POST['nama_tim'];
$jumlahAnggota = 1;
$maxAnggota = $_POST['jumlah_anggota'];
$jenjang = $_POST['jenjang_tim']; // array
$kategori = $_POST['kategori_lomba'];
$judul = $_POST['judul_lomba'];
$asalInstansi = $_POST['asal_instansi'];
$deskripsi = $_POST['deskripsi'];
$syaratKetentuan = $_POST['syarat_ketentuan'];
$cekKTM = isset($_POST['cek_ktm']) ? $_POST['cek_ktm'] : 'tidak_perlu_ktm';
$link = $_POST['link'];

// Gabungkan jenjang (array checkbox) ke string
$jenjang = implode(",", $jenjang);

try {
    // Mulai transaksi (implementasi TRANSACTION)
    $koneksi->beginTransaction();

    // Simpan ke tabel tim, termasuk ketua_id
    $sql = "INSERT INTO tim (
        nama_tim, jumlah_anggota, max_anggota, jenjang_tim, kategori_lomba, 
        judul_lomba, asal_instansi, deskripsi, syarat_ketentuan, 
        cek_ktm, link, created_at, ketua_id
    ) VALUES (
        :nama_tim, :jumlah_anggota, :max_anggota, :jenjang_tim, :kategori_lomba, 
        :judul_lomba, :asal_instansi, :deskripsi, :syarat_ketentuan, 
        :cek_ktm, :link, NOW(), :ketua_id
    )";

    $stmt = $koneksi->prepare($sql);
    $stmt->execute([
        ':nama_tim' => $namaTim,
        ':jumlah_anggota' => $jumlahAnggota,
        ':max_anggota' => $maxAnggota,
        ':jenjang_tim' => $jenjang,
        ':kategori_lomba' => $kategori,
        ':judul_lomba' => $judul,
        ':asal_instansi' => $asalInstansi,
        ':deskripsi' => $deskripsi,
        ':syarat_ketentuan' => $syaratKetentuan,
        ':cek_ktm' => $cekKTM,
        ':link' => $link,
        ':ketua_id' => $user_id
    ]);

    // Ambil ID tim yang baru dibuat
    $tim_id = $koneksi->lastInsertId();

    // Tambahkan ketua ke anggota_tim
    $stmt2 = $koneksi->prepare("INSERT INTO anggota_tim (tim_id, user_id, status) VALUES (?, ?, 'diterima')");
    $stmt2->execute([$tim_id, $user_id]);

    // Commit transaksi
    $koneksi->commit();

    echo "<script>alert('Tim Anda Berhasil Dibuat'); window.location.href='../dashboard.php';</script>";

} catch (Exception $e) {
    $koneksi->rollBack();
    echo "<script>alert('Terjadi kesalahan: {$e->getMessage()}'); window.history.back();</script>";
}
?>
