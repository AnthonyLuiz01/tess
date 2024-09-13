<?php
include('../connection/db.php');

// Recebe os dados do formulário
$id = $_POST['id'];
$responsavel = $_POST['responsavel'];
$status = $_POST['status'];

if ($status == 'Finalizado') {
    // Se o status for "Finalizado", remove o chamado do banco de dados
    $sql = "UPDATE chamados SET status = ?, responsavel = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $status, $responsavel, $id);;

    if ($stmt->execute()) {
        header("Location: ../view/suporte.php?status=deleted");
    } else {
        echo "Erro ao finalizar chamado: " . $stmt->error;
    }
} else {
    // Se o status não for "Finalizado", apenas atualize o status no banco de dados
    $sql = "UPDATE chamados SET status = ?, responsavel = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $status, $responsavel, $id);

    if ($stmt->execute()) {
        header("Location: ../view/suporte.php?status=updated");
    } else {
        echo "Erro ao atualizar chamado: " . $stmt->error;
    }
}
//menssaggem


$stmt->close();
$conn->close();
?>
