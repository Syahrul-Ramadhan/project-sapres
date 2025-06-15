<?php
session_start();
include 'php/koneksi.php';

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kategori = $_POST['kategori'] ?? '';
    $pesan = $_POST['pesan'] ?? '';
    $id_penanya = $user_id;
    $tanggal_pesan = date('Y-m-d');

    // 🚫 Cegah pengiriman jika belum login
    if (!$user_id) {
        http_response_code(403);  // Forbidden
        echo "Anda harus login terlebih dahulu.";
        exit;
    }

    // 🚫 Validasi input kosong
    if (empty($kategori) || empty($pesan)) {
        http_response_code(400); // Bad Request
        echo "Kategori dan pesan tidak boleh kosong.";
        exit;
    }

    $query = "INSERT INTO forum (user_id, kategori, pesan, id_penanya, tanggal_pesan)
              VALUES (:user_id, :kategori, :pesan, :id_penanya, :tanggal_pesan)";

    $stmt = $koneksi->prepare($query);
    $result = $stmt->execute([
        ':user_id' => $user_id,
        ':kategori' => $kategori,
        ':pesan' => $pesan,
        ':id_penanya' => $id_penanya,
        ':tanggal_pesan' => $tanggal_pesan
    ]);

    if ($result) {
        echo "Sukses";
    } else {
        http_response_code(500);
        echo "Gagal: " . implode(" ", $stmt->errorInfo());
    }
}
?>
