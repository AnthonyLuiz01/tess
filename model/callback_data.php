<?php
$botToken = '7374708560:AAFFiEpgachmPUBBPEy-XcA0qakCYEnaN8U';
$update = json_decode(file_get_contents('php://input'), TRUE);

if (isset($update['callback_query'])) {
    $callbackQuery = $update['callback_query'];
    $callbackData = $callbackQuery['data'];
    $messageId = $callbackQuery['message']['message_id'];
    $chatId = $callbackQuery['message']['chat']['id'];

    // Verifique o que está no callback_data
    if (strpos($callbackData, 'concluido_') !== false) {
        // Extrair o ID do chamado do callback_data
        $chamadoId = str_replace('concluido_', '', $callbackData);

        // Marcar o chamado como concluído no banco de dados
        include('../connection/db.php');
        $sql = "UPDATE chamados SET status = 'Concluído' WHERE id = $chamadoId";
        $conn->query($sql);

        // Responder ao usuário que clicou no botão
        $responseText = "✅ Chamado #$chamadoId marcado como concluído.";

        $telegramUrl = "https://api.telegram.org/bot$botToken/editMessageText";
        $telegramData = [
            'chat_id' => $chatId,
            'message_id' => $messageId,
            'text' => $responseText
        ];

        $options = [
            'http' => [
                'method' => 'POST',
                'header' => "Content-Type:application/x-www-form-urlencoded\r\n",
                'content' => http_build_query($telegramData),
            ]
        ];

        $context = stream_context_create($options);
        file_get_contents($telegramUrl, false, $context);
    }
}
?>
<?php
$botToken = '7374708560:AAFFiEpgachmPUBBPEy-XcA0qakCYEnaN8U';
$update = json_decode(file_get_contents('php://input'), TRUE);

if (isset($update['callback_query'])) {
    $callbackQuery = $update['callback_query'];
    $callbackData = $callbackQuery['data'];
    $messageId = $callbackQuery['message']['message_id'];
    $chatId = $callbackQuery['message']['chat']['id'];

    // Verifique o que está no callback_data
    if (strpos($callbackData, 'concluido_') !== false) {
        // Extrair o ID do chamado do callback_data
        $chamadoId = str_replace('concluido_', '', $callbackData);

        // Marcar o chamado como concluído no banco de dados
        include('../connection/db.php');
        $sql = "UPDATE chamados SET status = 'Concluído' WHERE id = $chamadoId";
        $conn->query($sql);

        // Responder ao usuário que clicou no botão
        $responseText = "✅ Chamado #$chamadoId marcado como concluído.";

        $telegramUrl = "https://api.telegram.org/bot$botToken/editMessageText";
        $telegramData = [
            'chat_id' => $chatId,
            'message_id' => $messageId,
            'text' => $responseText
        ];

        $options = [
            'http' => [
                'method' => 'POST',
                'header' => "Content-Type:application/x-www-form-urlencoded\r\n",
                'content' => http_build_query($telegramData),
            ]
        ];

        $context = stream_context_create($options);
        file_get_contents($telegramUrl, false, $context);
    }
}
?>
<?php
$botToken = '7374708560:AAFFiEpgachmPUBBPEy-XcA0qakCYEnaN8U';
$update = json_decode(file_get_contents('php://input'), TRUE);

if (isset($update['callback_query'])) {
    $callbackQuery = $update['callback_query'];
    $callbackData = $callbackQuery['data'];
    $messageId = $callbackQuery['message']['message_id'];
    $chatId = $callbackQuery['message']['chat']['id'];

    // Verifique o que está no callback_data
    if (strpos($callbackData, 'concluido_') !== false) {
        // Extrair o ID do chamado do callback_data
        $chamadoId = str_replace('concluido_', '', $callbackData);

        // Marcar o chamado como concluído no banco de dados
        include('../connection/db.php');
        $sql = "UPDATE chamados SET status = 'Concluído' WHERE id = $chamadoId";
        $conn->query($sql);

        // Responder ao usuário que clicou no botão
        $responseText = "✅ Chamado #$chamadoId marcado como concluído.";

        $telegramUrl = "https://api.telegram.org/bot$botToken/editMessageText";
        $telegramData = [
            'chat_id' => $chatId,
            'message_id' => $messageId,
            'text' => $responseText
        ];

        $options = [
            'http' => [
                'method' => 'POST',
                'header' => "Content-Type:application/x-www-form-urlencoded\r\n",
                'content' => http_build_query($telegramData),
            ]
        ];

        $context = stream_context_create($options);
        file_get_contents($telegramUrl, false, $context);
    }
}
?>
<?php
$botToken = '7374708560:AAFFiEpgachmPUBBPEy-XcA0qakCYEnaN8U';
$update = json_decode(file_get_contents('php://input'), TRUE);

if (isset($update['callback_query'])) {
    $callbackQuery = $update['callback_query'];
    $callbackData = $callbackQuery['data'];
    $messageId = $callbackQuery['message']['message_id'];
    $chatId = $callbackQuery['message']['chat']['id'];

    // Verifique o que está no callback_data
    if (strpos($callbackData, 'concluido_') !== false) {
        // Extrair o ID do chamado do callback_data
        $chamadoId = str_replace('concluido_', '', $callbackData);

        // Marcar o chamado como concluído no banco de dados
        include('../connection/db.php');
        $sql = "UPDATE chamados SET status = 'Concluído' WHERE id = $chamadoId";
        $conn->query($sql);

        // Responder ao usuário que clicou no botão
        $responseText = "✅ Chamado #$chamadoId marcado como concluído.";

        $telegramUrl = "https://api.telegram.org/bot$botToken/editMessageText";
        $telegramData = [
            'chat_id' => $chatId,
            'message_id' => $messageId,
            'text' => $responseText
        ];

        $options = [
            'http' => [
                'method' => 'POST',
                'header' => "Content-Type:application/x-www-form-urlencoded\r\n",
                'content' => http_build_query($telegramData),
            ]
        ];

        $context = stream_context_create($options);
        file_get_contents($telegramUrl, false, $context);
    }
}
?>
<?php
$botToken = '7374708560:AAFFiEpgachmPUBBPEy-XcA0qakCYEnaN8U';
$update = json_decode(file_get_contents('php://input'), TRUE);

if (isset($update['callback_query'])) {
    $callbackQuery = $update['callback_query'];
    $callbackData = $callbackQuery['data'];
    $messageId = $callbackQuery['message']['message_id'];
    $chatId = $callbackQuery['message']['chat']['id'];

    // Verifique o que está no callback_data
    if (strpos($callbackData, 'concluido_') !== false) {
        // Extrair o ID do chamado do callback_data
        $chamadoId = str_replace('concluido_', '', $callbackData);

        // Marcar o chamado como concluído no banco de dados
        include('../connection/db.php');
        $sql = "UPDATE chamados SET status = 'Concluído' WHERE id = $chamadoId";
        $conn->query($sql);

        // Responder ao usuário que clicou no botão
        $responseText = "✅ Chamado #$chamadoId marcado como concluído.";

        $telegramUrl = "https://api.telegram.org/bot$botToken/editMessageText";
        $telegramData = [
            'chat_id' => $chatId,
            'message_id' => $messageId,
            'text' => $responseText
        ];

        $options = [
            'http' => [
                'method' => 'POST',
                'header' => "Content-Type:application/x-www-form-urlencoded\r\n",
                'content' => http_build_query($telegramData),
            ]
        ];

        $context = stream_context_create($options);
        file_get_contents($telegramUrl, false, $context);
    }
}
?>
