<?php include('connection/db.php'); ?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CTI - Coordenação de Tecnologia da Informação</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../favicon.ico">  <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assents/css/style.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
    <a class="navbar-brand" href="../controlls/add_news.php">
    <img src="L.E.I.png" alt="Logo" style="width: 50px; height: auto;">
    <span style="vertical-align: middle;">CTI</span>
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
                    <a class="nav-link" href="index.php">Serviços</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Projetos</a>
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
            $sql = "SELECT titulo, descricao, data_publicacao, imagem FROM noticias ORDER BY data_publicacao DESC LIMIT 3";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='card img-thumbnai m-3 'style='width:14rem; '>";
                    if ($row['imagem']) {
                        echo "<img src='" . $row['imagem'] . "' alt='" . $row['titulo'] . "' class='card-img-top'>";
                    }
                    echo "<div class='card-body'>";
                    echo "<h6>" . $row['titulo'] . "</h6>";
                    echo "<p>" . $row['descricao'] . "</p>";
                    echo "<p class='data'>Publicado em: " . $row['data_publicacao'] . "</p>";
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

<?php include('./view/footer/footer.php'); ?>