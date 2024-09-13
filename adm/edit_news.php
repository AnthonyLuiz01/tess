<?php
include('./connection/db.php'); // Certifique-se de ajustar o caminho corretamente

// Verificar se a solicitação é POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obter os dados enviados via POST
    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $data_publicacao = $_POST['data_publicacao'];
    
    // Verificar se uma nova imagem foi enviada
    $imagem = null;
    if (!empty($_FILES['imagem']['name'])) {
        $imagem_nome = $_FILES['imagem']['name'];
        $imagem_tmp = $_FILES['imagem']['tmp_name'];

        // Diretório de upload
        $upload_dir = '../uploads/';  // Certifique-se de que o diretório existe e tem permissões de gravação
        
        // Criar um nome único para a imagem (para evitar conflitos)
        $imagem_novo_nome = uniqid() . '_' . $imagem_nome;
        
        // Caminho completo para o upload da imagem
        $imagem_caminho = $upload_dir . $imagem_novo_nome;

        // Mover o arquivo para o diretório de uploads
        if (move_uploaded_file($imagem_tmp, $imagem_caminho)) {
            $imagem = $imagem_caminho;

            // Verificar e excluir a imagem antiga, se existir
            $sql_imagem_antiga = "SELECT imagem FROM noticias WHERE id = ?";
            $stmt_imagem = $conn->prepare($sql_imagem_antiga);
            $stmt_imagem->bind_param('i', $id);
            $stmt_imagem->execute();
            $result_imagem = $stmt_imagem->get_result();
            if ($result_imagem->num_rows > 0) {
                $row = $result_imagem->fetch_assoc();
                if ($row['imagem'] && file_exists($row['imagem'])) {
                    unlink($row['imagem']); // Excluir a imagem antiga do servidor
                }
            }
        }
    }

    // Atualizar os dados da notícia no banco de dados
    if ($imagem) {
        // Atualizar incluindo a nova imagem
        $sql = "UPDATE noticias SET titulo = ?, descricao = ?, data_publicacao = ?, imagem = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssssi', $titulo, $descricao, $data_publicacao, $imagem, $id);
    } else {
        // Atualizar sem mexer na imagem
        $sql = "UPDATE noticias SET titulo = ?, descricao = ?, data_publicacao = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sssi', $titulo, $descricao, $data_publicacao, $id);
    }

    // Executar a query
    if ($stmt->execute()) {
        // Redirecionar de volta para a página principal após a edição
        header('Location: ./index.php');
        exit();
    } else {
        echo "Erro ao atualizar a notícia: " . $conn->error;
    }
}
?>
