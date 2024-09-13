<?php
include('../connection/db.php');

// Verificar se o ID foi passado via GET
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Verificar se o ID é válido
    if ($id > 0) {
        // Primeiro, precisamos pegar o caminho da imagem associada à notícia (se houver)
        $sql = "SELECT imagem FROM noticias WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        // Se a notícia existir
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $imagem = $row['imagem'];

            // Deletar a notícia do banco de dados
            $delete_sql = "DELETE FROM noticias WHERE id = ?";
            $delete_stmt = $conn->prepare($delete_sql);
            $delete_stmt->bind_param('i', $id);

            if ($delete_stmt->execute()) {
                // Verificar se a imagem existe e excluí-la
                if ($imagem && file_exists($imagem)) {
                    unlink($imagem); // Excluir o arquivo da imagem
                }
                // Redirecionar de volta para a página principal
                header('Location: ../index.php');
                exit();
            } else {
                echo "Erro ao excluir notícia: " . $conn->error;
            }
        } else {
            echo "Notícia não encontrada.";
        }
    } else {
        echo "ID inválido.";
    }
} else {
    echo "ID da notícia não foi fornecido.";
}
?>
