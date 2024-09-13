<?php
include('./connection/db.php');

// Recebe os dados do formulário
$titulo = $_POST['titulo'];
$descricao = $_POST['descricao'];
$data_publicacao = $_POST['data_publicacao'];

// Processa o upload da imagem
$imagem = null;
if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
    $imagemTmpPath = $_FILES['imagem']['tmp_name'];
    $imagemName = basename($_FILES['imagem']['name']);
    $imagemPath = './uploads/' . $imagemName;

    // Cria o diretório uploads se não existir
    if (!is_dir('./uploads')) {
        mkdir('./uploads', 0777, true);
    }

    // Move a imagem para o diretório de uploads
    if (move_uploaded_file($imagemTmpPath, $imagemPath)) {
        $imagem = $imagemPath;
    } else {
        echo "Erro ao fazer upload da imagem.";
        exit();
    }
}

// Inserir no banco de dados
$sql = "INSERT INTO noticias (titulo, descricao, data_publicacao, imagem) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $titulo, $descricao, $data_publicacao, $imagem);

if ($stmt->execute()) {
    // Redireciona para a página de notícias com mensagem de sucesso
    header("Location: ./index.php?status=success");
    exit();
} else {
    echo "Erro: " . $stmt->error;
}

$conn->close();
?>
