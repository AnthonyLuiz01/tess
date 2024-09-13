<?php include('../connection/db.php'); ?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todos os Chamados</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
    <div class="container my-4">
        <h2>Todos os Chamados</h2>

        <?php
        // Busca por todos os chamados
        $sql = "SELECT * FROM chamados";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table class='table table-bordered'>";
            echo "<thead><tr><th>ID</th><th>Área</th><th>Nome</th><th>Contato</th><th>Problema</th><th>Status</th><th>Data de Criação</th></tr></thead>";
            echo "<tbody>";
            while ($row = $result->fetch_assoc()) {
                $dataCriacao = date('d/m/Y H:i', strtotime($row['data_criacao']));
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['area'] . "</td>";
                echo "<td>" . $row['nome'] . "</td>";
                echo "<td>" . $row['contato'] . "</td>";
                echo "<td>" . $row['problema'] . "</td>";
                echo "<td>" . $row['status'] . "</td>";
                echo "<td>" . $dataCriacao . "</td>";
                echo "</tr>";
            }
            echo "</tbody></table>";
        } else {
            echo "<div class='alert alert-info'>Nenhum chamado encontrado.</div>";
        }
        ?>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
