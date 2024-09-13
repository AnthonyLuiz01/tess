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
                        <a class="nav-link" href="sobre.php">Sobre</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../controlls/add_news.php">Adicionar Notícia</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="suporte.php">Suporte</a>
                    </li>  <li class="nav-item">
                        <a class="nav-link" href="view.php">Pendentes</a>
                    </li>
                     </li>  <li class="nav-item">
                        <a class="nav-link" href="todos_chamados.php">Todos os chamados</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <main>
        <h2>Sobre a CTI</h2>
        <p>A Coordenação de Tecnologia da Informação (CTI) é responsável por...</p>
    </main>

    <?php include('./footer/footer.php'); ?> <!-- Inclui o rodapé comum -->
</body>
</html>
