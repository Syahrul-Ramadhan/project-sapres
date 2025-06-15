<?php
session_start();
include 'php/koneksi.php';

$user_id = $_SESSION['user_id'] ?? null;
$parent_id = $_POST['parent_id'] ?? null;
$id_penanya = $_POST['id_penanya'] ?? null;
$pesan = trim($_POST['pesan'] ?? '');

// Validasi input
if (!$user_id || !$parent_id || !$pesan) {
  http_response_code(400); // Bad Request
  echo "Data tidak lengkap.";
  exit;
}

// Hindari SQL Injection
$parent_id = intval($parent_id);
$id_penanya = intval($id_penanya);
$pesan = mysqli_real_escape_string($koneksi, $pesan);

// Simpan komentar ke database
$query = "INSERT INTO forum (user_id, pesan, parent_id, id_penanya) 
          VALUES ('$user_id', '$pesan', '$parent_id', '$id_penanya')";

if (mysqli_query($koneksi, $query)) {
  echo "Komentar berhasil dikirim.";
} else {
  http_response_code(500); // Internal Server Error
  echo "Gagal mengirim balasan: " . mysqli_error($koneksi);
}