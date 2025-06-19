<?php
include "../php/koneksi.php";
require_once '../php/session_manager.php';
session_start();

$user_id = $_SESSION['user_id'];
$tim_id = $_POST['tim_id'];

// Validate tim_id is a valid number
if (!is_numeric($tim_id)) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid tim_id']);
    exit;
}

// Cek apakah tim membutuhkan KTM
$stmt = $koneksi->prepare("SELECT cek_ktm, ketua_id FROM tim WHERE tim_id = ?");
$stmt->execute([$tim_id]);
$tim = $stmt->fetch();
$requires_ktm = $tim['cek_ktm'] === 'perlu_ktm';
$ketua_id = $tim['ketua_id'];

// Proses file KTM jika diperlukan
$ktm_name = null;
if ($requires_ktm && isset($_FILES['ktm']['name']) && $_FILES['ktm']['name'] !== '') {
    $ktm_name = uniqid() . "_" . basename($_FILES['ktm']['name']);
    $tmp_path = $_FILES['ktm']['tmp_name'];
    $upload_path = '../uploads/ktm/' . $ktm_name;
    move_uploaded_file($tmp_path, $upload_path);
}

// Tambahkan ke anggota_tim
$stmt = $koneksi->prepare("INSERT INTO anggota_tim (tim_id, user_id, ktm_path, status) VALUES (?, ?, ?, 'menunggu')");
$stmt->execute([$tim_id, $user_id, $ktm_name]);

// Buat notifikasi untuk ketua tim
$pesan = "User ID $user_id mengajukan bergabung ke tim ID $tim_id.";
$stmtNotif = $koneksi->prepare("INSERT INTO notifikasi (user_id, tipe, pesan, terkait_tim_id, dari_user_id) VALUES (?, 'permintaan_bergabung', ?, ?, ?)");
$stmtNotif->execute([$ketua_id, $pesan, $tim_id, $user_id]);

// Redirect back to cari tim page
header('Location: ../cariTim.php');
exit;
?>
