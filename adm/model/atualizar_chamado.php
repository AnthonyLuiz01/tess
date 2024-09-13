<?php
include('../connection/db.php');

// Verifica se os dados foram enviados via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recebe os dados do formulário
    $id = $_POST['id'];
    $nome_responsavel = $_POST['nome_responsavel'];
    $status = $_POST['status'];

    // Valida os dados recebidos
    if (empty($id) || empty($nome_responsavel) || empty($status)) {
        header('Location: ../view/suporte.php?status=error');
        exit();
    }

    // Prepara a consulta para atualizar o chamado
    $sql = "UPDATE chamados SET responsavel = ?, status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    
    if (!$stmt) {
        // Erro na preparação da consulta
        header('Location: ../view/suporte.php?status=error');
        exit();
    }

    // Vincula os parâmetros e executa a consulta
    $stmt->bind_param('ssi', $nome_responsavel, $status, $id);
    $success = $stmt->execute();

    // Fecha a declaração
    $stmt->close();

    if ($success) {
        header('Location: ../view/suporte.php?status=updated');
    } else {
        header('Location: ../view/suporte.php?status=error');
    }
} else {
    // Caso o acesso não seja via POST
    header('Location: ../view/suporte.php?status=error');
}
?>
