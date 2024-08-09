<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $chatId = $_POST['chatId'] ?? null;
    $message = $_POST['message'] ?? null;

    if ($chatId && $message) {
        $url = "https://api.telegram.org/bot7368928826:AAHaBQzLBgvNS0Fb8mVRLqwOD8a_f-U8zh8/sendMessage";
        $data = [
            'chat_id' => $chatId,
            'text' => $message,
            'parse_mode' => 'HTML'
        ];

        $options = [
            'http' => [
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data),
            ],
        ];
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);

        if ($result === FALSE) {
            echo json_encode(['status' => 'error', 'message' => 'Failed to send message.']);
        } else {
            echo json_encode(['status' => 'success']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid chat ID or message.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?>
