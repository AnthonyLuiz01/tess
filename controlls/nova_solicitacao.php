<?php
include('../connection/db.php');

// Recebe os dados do formulário
$area = $_POST['area'];
$nome = $_POST['nome'];
$contato = $_POST['contato'];
$problema = $_POST['problema'];

// Validação simples dos dados
if (empty($area) || empty($nome) || empty($contato) || empty($problema)) {
    echo "Todos os campos são obrigatórios.";
    exit();
}

// Inserir no banco de dados
$sql = "INSERT INTO chamados (area, nome, contato, problema, status, data_criacao) VALUES (?, ?, ?, ?, 'Pendente', NOW())";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $area, $nome, $contato, $problema);

if ($stmt->execute()) {
    // Obter o ID do chamado recém-criado
    $chamadoId = $conn->insert_id;

    // Recuperar os dados recém-adicionados
    $sql = "SELECT * FROM chamados WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $chamadoId);
    $stmt->execute();
    $result = $stmt->get_result();
    $chamado = $result->fetch_assoc();

    // Formatar a data e hora
    $dataCriacao = date('d/m/Y H:i', strtotime($chamado['data_criacao']));

    // Mensagem a ser enviada ao Telegram
    $message = "🆕 *Novo Chamado Recebido*\n";
    $message .= "👤 *Nome*: " . $chamado['nome'] . "\n";
    $message .= "💻 *ID*: " . $chamadoId . "\n";
    $message .= "🏢 *Área*: " . $chamado['area'] . "\n";
    $message .= "📞 *Contato*: " . $chamado['contato'] . "\n";
    $message .= "❗️ *Problema*: " . $chamado['problema'] . "\n";
    $message .= "🕒 *Status*: " . $chamado['status'] . "\n";
    $message .= "⏰ *Data e Hora*: " . $dataCriacao . "\n";

    // Token do bot e ID do grupo
    $botToken = '7374708560:AAFFiEpgachmPUBBPEy-XcA0qakCYEnaN8U';
    $chatId = '-1002246054145';

    // Configuração dos botões
    $replyMarkup = [
        'inline_keyboard' => [
            [
                ['text' => 'Abrir Link', 'url' => 'https://example.com'], // Substitua pelo seu link
            ]
        ]
    ];

    // Enviar mensagem ao Telegram com botões
    $telegramUrl = "https://api.telegram.org/bot$botToken/sendMessage";
    $telegramData = [
        'chat_id' => $chatId,
        'text' => $message,
        'parse_mode' => 'Markdown',
        'reply_markup' => json_encode($replyMarkup)
    ];

    $options = [
        'http' => [
            'method' => 'POST',
            'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
            'content' => http_build_query($telegramData),
        ]
    ];

    $context = stream_context_create($options);
    $result = file_get_contents($telegramUrl, false, $context);

    if ($result === FALSE) {
        echo "Erro ao enviar a mensagem para o Telegram.";
    }

    // Redireciona para a página de suporte com mensagem de sucesso
    header("Location: ../view/suporte.php?status=success");
    exit();
} else {
    echo "Erro ao inserir o chamado: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
