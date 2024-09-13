<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CTI - Coordenação de Tecnologia da Informação-adm</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../favicon.ico">  <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assents/css/style.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
    <a class="navbar-brand" href="../index.php">
    <img src="../L.E.I.png" alt="Logo" style="width: 50px; height: auto;">
    <span style="vertical-align: middle;">CTI-ADM</span>
</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../view/sobre.php">Sobre</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="add_news.php">adicionar Noticia</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../view/suporte.php">Suporte</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container my-4">
    <h2>Adicionar Nova Notícia</h2>

    <!-- Formulário para adicionar uma nova notícia -->
    <form action="../process_add_news.php" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" class="form-control" id="titulo" name="titulo" required>
        </div>
        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea class="form-control" id="descricao" name="descricao" rows="4" required></textarea>
        </div>
        <div class="mb-3">
            <label for="data_publicacao" class="form-label">Data de Publicação</label>
            <input type="date" class="form-control" id="data_publicacao" name="data_publicacao" required>
        </div>
        <div class="mb-3">
            <label for="imagem" class="form-label">Imagem</label>
            <input type="file" class="form-control" id="imagem" name="imagem" accept="image/*">
        </div>
        <button type="submit" class="btn btn-primary">Adicionar Notícia</button>
    </form>
</div>

<?php include('../view/footer/footer.php'); ?>
