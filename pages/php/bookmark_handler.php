<?php
require_once 'koneksi.php';

header('Content-Type: application/json');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit;
}

$userId = $_SESSION['user_id'];
$input = json_decode(file_get_contents('php://input'), true);
$action = $input['action'] ?? '';

switch ($action) {
    case 'add':
        addBookmark($userId, $input);
        break;
        
    case 'remove':
        removeBookmark($userId, $input);
        break;
        
    case 'get_status':
        getBookmarkStatus($userId, $input);
        break;
        
    default:
        echo json_encode(['success' => false, 'message' => 'Invalid action']);
}

function addBookmark($userId, $input) {
    global $koneksi;
    
    $itemId = $input['item_id'] ?? 0;
    $itemType = $input['item_type'] ?? '';
    
    if (!$itemId || !$itemType) {
        echo json_encode(['success' => false, 'message' => 'Invalid parameters']);
        return;
    }
    
    try {
        $stmt = $koneksi->prepare("INSERT INTO bookmarks (user_id, item_type, item_id) VALUES (?, ?, ?)");
        $stmt->execute([$userId, $itemType, $itemId]);
        
        echo json_encode(['success' => true, 'message' => 'Bookmark added']);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
    }
}

function removeBookmark($userId, $input) {
    global $koneksi;
    
    $itemId = $input['item_id'] ?? 0;
    $itemType = $input['item_type'] ?? '';
    
    if (!$itemId || !$itemType) {
        echo json_encode(['success' => false, 'message' => 'Invalid parameters']);
        return;
    }
    
    try {
        $stmt = $koneksi->prepare("DELETE FROM bookmarks WHERE user_id = ? AND item_type = ? AND item_id = ?");
        $stmt->execute([$userId, $itemType, $itemId]);
        
        echo json_encode(['success' => true, 'message' => 'Bookmark removed']);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
    }
}

function getBookmarkStatus($userId, $input) {
    global $koneksi;
    
    $itemIds = $input['item_ids'] ?? [];
    $itemType = $input['item_type'] ?? '';
    
    if (empty($itemIds) || !$itemType) {
        echo json_encode(['success' => false, 'message' => 'Invalid parameters']);
        return;
    }
    
    try {
        $placeholders = str_repeat('?,', count($itemIds) - 1) . '?';
        $stmt = $koneksi->prepare("SELECT item_id FROM bookmarks WHERE user_id = ? AND item_type = ? AND item_id IN ($placeholders)");
        $params = array_merge([$userId, $itemType], $itemIds);
        $stmt->execute($params);
        
        $bookmarks = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        echo json_encode(['success' => true, 'bookmarks' => $bookmarks]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
    }
}
?>