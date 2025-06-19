<?php
session_start();
include 'php/koneksi.php';

$user_id = $_SESSION['user_id'] ?? null;
$parent_id = $_POST['parent_id'] ?? null;
$id_penanya = $_POST['id_penanya'] ?? null;
$pesan = trim($_POST['pesan'] ?? '');

if (!$user_id || !$parent_id || !$pesan) {
  http_response_code(400);
  echo "Data tidak lengkap.";
  exit;
}

try {
    $query = "INSERT INTO forum (user_id, pesan, parent_id, id_penanya) 
              VALUES (:user_id, :pesan, :parent_id, :id_penanya)";
              
    $stmt = $koneksi->prepare($query);

    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindParam(':pesan', $pesan, PDO::PARAM_STR);
    $stmt->bindParam(':parent_id', $parent_id, PDO::PARAM_INT);
    $stmt->bindParam(':id_penanya', $id_penanya, PDO::PARAM_INT);

    if ($stmt->execute()) {
        header('Location: forum-chat.php?topic=' . $parent_id);
        exit;
    } else {
        http_response_code(500);
        echo "Gagal mengirim balasan.";
    }

} catch(PDOException $e) {
    http_response_code(500);
    echo "Error: " . $e->getMessage();
}
?>