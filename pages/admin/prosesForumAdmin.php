<?php
include "../php/koneksi.php";
session_start();
$admin_user_id = $_SESSION['user_id'] ?? 0;

header('Content-Type: application/json');

$action = $_REQUEST['action'] ?? '';

switch ($action) {
    // ---- CREATE ----
    case 'create_announcement':
        $kategori = $_POST['kategori'] ?? '';
        $pesan = $_POST['pesan'] ?? '';
        
        if (empty($kategori) || empty($pesan) || $admin_user_id == 0) {
            echo json_encode(['success' => false, 'message' => 'Data tidak lengkap atau Anda tidak memiliki akses.']);
            exit;
        }

        $stmt = $koneksi->prepare("INSERT INTO forum (user_id, kategori, pesan, id_penanya, tanggal_pesan) VALUES (?, ?, ?, ?, NOW())");
        if ($stmt->execute([$admin_user_id, $kategori, $pesan, $admin_user_id])) {
            echo json_encode(['success' => true, 'message' => 'Pengumuman berhasil dikirim.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Gagal mengirim pengumuman.']);
        }
        break;

    // ---- READ ----
    // ---- READ ----
    case 'get_discussion':
        $topic_id = $_GET['topic_id'] ?? 0;
        $response = ['success' => false];

        $stmt_main = $koneksi->prepare("SELECT f.*, u.fullname FROM forum f JOIN users u ON f.user_id = u.user_id WHERE f.forum_id = ?");
        $stmt_main->execute([$topic_id]);
        $result_main = $stmt_main->fetch();
        if ($result_main) {
            $response['success'] = true;
            $response['main_post'] = $result_main;
        }

        $stmt_replies = $koneksi->prepare("SELECT f.*, u.fullname FROM forum f JOIN users u ON f.user_id = u.user_id WHERE f.parent_id = ? ORDER BY f.waktu_postingan ASC");
        $stmt_replies->execute([$topic_id]);
        $response['replies'] = $stmt_replies->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($response);
        break;

    // ---- REPLY ----
    case 'reply_discussion':
        $parent_id = $_POST['parent_id'] ?? 0;
        $pesan = $_POST['pesan'] ?? '';
        if (empty($parent_id) || empty($pesan) || $admin_user_id == 0) {
             echo json_encode(['success' => false, 'message' => 'Data tidak lengkap.']);
             exit;
        }
        $stmt = $koneksi->prepare("INSERT INTO forum (user_id, pesan, parent_id) VALUES (?, ?, ?)");
        if ($stmt->execute([$admin_user_id, $pesan, $parent_id])) {
            echo json_encode(['success' => true, 'message' => 'Balasan berhasil dikirim.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Gagal mengirim balasan.']);
        }
        break;


    // ---- DELETE ----
    case 'delete_discussion':
        $topic_id = $_POST['topic_id'] ?? 0;
        
        if (empty($topic_id)) {
            echo json_encode(['success' => false, 'message' => 'ID Topik tidak valid.']);
            exit;
        }

        // Gunakan metode PDO untuk transaksi
        $koneksi->beginTransaction();

        try {
            // Hapus semua balasan terlebih dahulu
            $stmt_replies = $koneksi->prepare("DELETE FROM forum WHERE parent_id = ?");
            // Tidak perlu bind_param, cukup kirim array ke execute()
            $stmt_replies->execute([$topic_id]);

            // Kemudian hapus topik utamanya
            $stmt_main = $koneksi->prepare("DELETE FROM forum WHERE forum_id = ?");
            $stmt_main->execute([$topic_id]);

            // Jika semua berhasil, simpan perubahan
            $koneksi->commit();
            echo json_encode(['success' => true, 'message' => 'Seluruh diskusi berhasil dihapus.']);

        } catch (PDOException $exception) {
            // Jika ada error, batalkan semua perubahan
            $koneksi->rollBack();
            // Kirim pesan error untuk debugging
            echo json_encode(['success' => false, 'message' => 'Gagal menghapus diskusi: ' . $exception->getMessage()]);
        }
        break;

    case 'delete_message':
        $message_id = $_POST['message_id'] ?? 0;
        // Cek dulu apakah ini parent post
        $stmt_check = $koneksi->prepare("SELECT parent_id FROM forum WHERE forum_id = ?");
        $stmt_check->execute([$message_id]);
        $result_check = $stmt_check->fetch();

        if ($result_check['parent_id'] === NULL) {
            // Jika ini parent, hapus seluruh diskusi
            $stmt = $koneksi->prepare("DELETE FROM forum WHERE forum_id = ? OR parent_id = ?");
            $stmt->execute([$message_id, $message_id]);
        } else {
            // Jika ini hanya balasan, hapus satu pesan saja
            $stmt = $koneksi->prepare("DELETE FROM forum WHERE forum_id = ?");
            $stmt->execute([$message_id]);
        }
        
        if ($stmt) {
            echo json_encode(['success' => true, 'message' => 'Pesan berhasil dihapus.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Gagal menghapus pesan.']);
        }

    default:
        echo json_encode(['success' => false, 'message' => 'Aksi tidak valid.']);
        break;
}
?>
