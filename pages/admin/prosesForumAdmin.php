<?php
include "../php/koneksi.php";
session_start();
$admin_user_id = $_SESSION['user_id'] ?? 0;

header('Content-Type: application/json');

$action = $_REQUEST['action'] ?? '';

if ($koneksi->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Koneksi database gagal']);
    exit;
}

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
        $stmt->bind_param("issi", $admin_user_id, $kategori, $pesan, $admin_user_id);
        
        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Pengumuman berhasil dikirim.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Gagal mengirim pengumuman.']);
        }
        $stmt->close();
        break;

    // ---- READ ----
    case 'get_discussion':
        $topic_id = $_GET['topic_id'] ?? 0;
        $response = ['success' => false];

        // Ambil post utama
        $stmt_main = $koneksi->prepare("SELECT f.*, u.username FROM forum f JOIN user u ON f.user_id = u.user_id WHERE f.forum_id = ?");
        $stmt_main->bind_param("i", $topic_id);
        $stmt_main->execute();
        $result_main = $stmt_main->get_result();
        if ($result_main->num_rows > 0) {
            $response['success'] = true;
            $response['main_post'] = $result_main->fetch_assoc();
        }

        // Ambil semua balasan
        $stmt_replies = $koneksi->prepare("SELECT f.*, u.username FROM forum f JOIN user u ON f.user_id = u.user_id WHERE f.parent_id = ? ORDER BY f.waktu_postingan ASC");
        $stmt_replies->bind_param("i", $topic_id);
        $stmt_replies->execute();
        $result_replies = $stmt_replies->get_result();
        $response['replies'] = $result_replies->fetch_all(MYSQLI_ASSOC);

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
        $stmt->bind_param("isi", $admin_user_id, $pesan, $parent_id);
        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Balasan berhasil dikirim.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Gagal mengirim balasan.']);
        }
        $stmt->close();
        break;


    // ---- DELETE ----
    case 'delete_discussion':
    $topic_id = $_POST['topic_id'] ?? 0;

    mysqli_begin_transaction($koneksi); // Memulai transaksi

    try {
        // Hapus semua balasan terlebih dahulu
        $stmt_replies = $koneksi->prepare("DELETE FROM forum WHERE parent_id = ?");
        $stmt_replies->bind_param("i", $topic_id);
        $stmt_replies->execute();

        // Kemudian hapus topik utamanya
        $stmt_main = $koneksi->prepare("DELETE FROM forum WHERE forum_id = ?");
        $stmt_main->bind_param("i", $topic_id);
        $stmt_main->execute();

        mysqli_commit($koneksi); // Jika semua berhasil, simpan perubahan
        echo json_encode(['success' => true, 'message' => 'Seluruh diskusi berhasil dihapus.']);

    } catch (mysqli_sql_exception $exception) {
        mysqli_rollback($koneksi); // Jika ada error, batalkan semua perubahan
        echo json_encode(['success' => false, 'message' => 'Gagal menghapus diskusi.']);
    }
    break;

    case 'delete_message':
        $message_id = $_POST['message_id'] ?? 0;
        // Cek dulu apakah ini parent post
        $stmt_check = $koneksi->prepare("SELECT parent_id FROM forum WHERE forum_id = ?");
        $stmt_check->bind_param("i", $message_id);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result()->fetch_assoc();

        if ($result_check['parent_id'] === NULL) {
            // Jika ini parent, hapus seluruh diskusi
            $stmt = $koneksi->prepare("DELETE FROM forum WHERE forum_id = ? OR parent_id = ?");
            $stmt->bind_param("ii", $message_id, $message_id);
        } else {
            // Jika ini hanya balasan, hapus satu pesan saja
            $stmt = $koneksi->prepare("DELETE FROM forum WHERE forum_id = ?");
            $stmt->bind_param("i", $message_id);
        }
        
        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Pesan berhasil dihapus.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Gagal menghapus pesan.']);
        }
        $stmt_check->close();
        $stmt->close();
        break;

    default:
        echo json_encode(['success' => false, 'message' => 'Aksi tidak valid.']);
        break;
}

$koneksi->close();
?>
