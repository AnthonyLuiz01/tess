<?php include('connection/db.php'); ?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CTI - Coordenação de Tecnologia da Informação-adm</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../favicon.ico">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assents/css/style.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
            <img src="L.E.I.png" alt="Logo" style="width: 50px; height: auto;">
            <span style="vertical-align: middle;">CTI-ADM</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="./view/sobre.php">Sobre</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./controlls/add_news.php">Adicionar Notícia</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./view/suporte.php">Suporte</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<main>
    <section class="banner mb-3">
        <h2>Conectando Pessoas e Tecnologia</h2>
    </section>

    <section class="noticias mb-5">
        <h2>Últimas Notícias</h2>
        <div class="noticias-container">
            <?php
            $sql = "SELECT id, titulo, descricao, data_publicacao, imagem FROM noticias ORDER BY data_publicacao DESC LIMIT 3";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='card img-thumbnail m-3' style='width: 14rem;'>";
                    if ($row['imagem']) {
                        echo "<img src='" . $row['imagem'] . "' alt='" . $row['titulo'] . "' class='card-img-top'>";
                    }
                    echo "<div class='card-body'>";
                    echo "<h6>" . $row['titulo'] . "</h6>";
                    echo "<p>" . $row['descricao'] . "</p>";
                    echo "<p class='data'>Publicado em: " . $row['data_publicacao'] . "</p>";
                    echo "<button class='btn btn-danger btn-sm me-2' onclick='confirmarExclusao(" . $row['id'] . ")'>Excluir</button>";
                    echo "<button class='btn btn-primary btn-sm' onclick='editarNoticia(" . $row['id'] . ", `" . $row['titulo'] . "`, `" . $row['descricao'] . "`, `" . $row['data_publicacao'] . "`, `" . $row['imagem'] . "`)'>Editar</button>";
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "<p>Sem notícias recentes.</p>";
            }
            ?>
        </div>
    </section>
</main>

<!-- Modal de Confirmação de Exclusão -->
<div class="modal fade" id="confirmarExclusaoModal" tabindex="-1" aria-labelledby="confirmarExclusaoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmarExclusaoModalLabel">Confirmar Exclusão</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Você tem certeza de que deseja excluir esta notícia?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" id="confirmarExcluir">Excluir</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Edição -->
<div class="modal fade" id="editarNoticiaModal" tabindex="-1" aria-labelledby="editarNoticiaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarNoticiaModalLabel">Editar Notícia</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editarNoticiaForm" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="titulo" class="form-label">Título</label>
                        <input type="text" class="form-control" id="titulo" name="titulo" required>
                    </div>
                    <div class="mb-3">
                        <label for="descricao" class="form-label">Descrição</label>
                        <textarea class="form-control" id="descricao" name="descricao" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="data_publicacao" class="form-label">Data de Publicação</label>
                        <input type="date" class="form-control" id="data_publicacao" name="data_publicacao" required>
                    </div>
                    <div class="mb-3">
                        <label for="imagem" class="form-label">Imagem</label>
                        <input type="file" class="form-control" id="imagem" name="imagem" accept="image/*">
                    </div>
                    <div id="imagem-preview" class="mb-3">
                        <img src="" alt="Pré-visualização da imagem" style="max-width: 100%; height: auto;">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="confirmarEdicao">Salvar</button>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    let noticiaId;

    function confirmarExclusao(id) {
        noticiaId = id;
        const modal = new bootstrap.Modal(document.getElementById('confirmarExclusaoModal'));
        modal.show();
    }

    function editarNoticia(id, titulo, descricao, data_publicacao, imagem) {
        noticiaId = id;
        document.getElementById('titulo').value = titulo;
        document.getElementById('descricao').value = descricao;
        document.getElementById('data_publicacao').value = data_publicacao;
        
        if (imagem) {
            document.getElementById('imagem-preview').querySelector('img').src = imagem;
        } else {
            document.getElementById('imagem-preview').querySelector('img').src = '';
        }

        const modal = new bootstrap.Modal(document.getElementById('editarNoticiaModal'));
        modal.show();
    }

    document.getElementById('confirmarExcluir').addEventListener('click', function() {
        // Lógica para excluir a notícia
        window.location.href = './controlls/delete_news.php?id=' + noticiaId;
    });
    document.getElementById('confirmarEdicao').addEventListener('click', function() {
    const titulo = document.getElementById('titulo').value;
    const descricao = document.getElementById('descricao').value;
    const data_publicacao = document.getElementById('data_publicacao').value;
    const imagem = document.getElementById('imagem').files[0]; // Pegar o arquivo da imagem
    
    // Criar um FormData para enviar a imagem e outros dados
    const formData = new FormData();
    formData.append('id', noticiaId);
    formData.append('titulo', titulo);
    formData.append('descricao', descricao);
    formData.append('data_publicacao', data_publicacao);
    if (imagem) {
        formData.append('imagem', imagem);
    }

    // Enviar os dados via AJAX (fetch API)
    fetch('edit_news.php', {
        method: 'POST',
        body: formData
    }).then(response => {
        if (response.ok) {
            window.location.reload();
        } else {
            alert('Erro ao editar notícia.');
        }
    });
});

</script>

<?php include('./view/footer/footer.php'); ?>
