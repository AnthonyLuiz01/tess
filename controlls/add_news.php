<?php include('../view/header/header.php'); ?>

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
