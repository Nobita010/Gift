<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $photo = $_POST['photo'] ?? '';
    $userId = $_POST['id'] ?? '';

    if (!empty($photo) && !empty($userId)) {
        $decodedPhoto = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $photo));
        $filePath = 'uploads/' . $userId . '_' . uniqid() . '.png';

        if (file_put_contents($filePath, $decodedPhoto)) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to save photo.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid photo or user ID.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?>
