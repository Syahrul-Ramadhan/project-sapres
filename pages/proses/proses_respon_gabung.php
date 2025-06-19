<?php
require_once '../php/koneksi.php';
require_once '../php/session_manager.php';

// Ambil data dari parameter GET
$tim_id = $_GET['tim_id'];
$user_id = $_GET['user_id'];
$aksi = $_GET['aksi'];  // Terima atau Tolak

// Pastikan aksi yang diterima adalah salah satu dari 'terima' atau 'tolak'
if ($aksi == 'terima' || $aksi == 'tolak') {
    // Update status anggota tim berdasarkan aksi yang diterima
    if ($aksi == 'terima') {
        // Terima permintaan, update status menjadi 'sudah_disetujui'
        $stmt = $koneksi->prepare("UPDATE anggota_tim SET status = 'diterima' WHERE tim_id = ? AND user_id = ?");
    } else {
        // Tolak permintaan, update status menjadi 'ditolak'
        $stmt = $koneksi->prepare("UPDATE anggota_tim SET status = 'ditolak' WHERE tim_id = ? AND user_id = ?");
    }

    // Eksekusi query untuk memperbarui status anggota tim
    $stmt->execute([$tim_id, $user_id]);

    // Update status notifikasi menjadi 'dibaca'
    $stmtNotif = $koneksi->prepare("UPDATE notifikasi SET status_baca = 'dibaca' WHERE terkait_tim_id = ? AND dari_user_id = ?");
    $stmtNotif->execute([$tim_id, $user_id]);

    // Redirect kembali ke halaman notifikasi
    header("Location: ../dashboard.php");
    exit;
} else {
    echo "Aksi tidak valid.";
}
?>
