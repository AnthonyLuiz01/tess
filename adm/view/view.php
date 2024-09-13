<?php
// Inclui o arquivo de conexão com o banco de dados
include('../connection/db.php');

// Configura o fuso horário para o horário de Brasília
date_default_timezone_set('America/Sao_Paulo');

// Consulta para selecionar todos os chamados com status 'Pendente'
$sql = "SELECT * FROM chamados WHERE status = 'Pendente'";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chamados Pendentes - CTI</title>

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

    <div class="container my-4">
        <h2>Chamados Pendentes</h2>

        <!-- Tabela de chamados pendentes -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Área</th>
                    <th>Nome</th>
                    <th>Contato</th>
                    <th>Problema</th>
                    <th>Status</th>
                    <th>Data de Criação</th>
                    <th>Responsável</th>
                </tr>
            </thead>
            <tbody>
                <?php
                
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        // Formatar a data para o horário do Brasil
                        $dataCriacao = date('d/m/Y H:i', strtotime($row['data_criacao']));

                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['area'] . "</td>";
                        echo "<td>" . $row['nome'] . "</td>";
                        echo "<td>" . $row['contato'] . "</td>";
                        echo "<td>" . $row['problema'] . "</td>";
                        echo "<td>" . $row['status'] . "</td>";
                        echo "<td>" . $dataCriacao . "</td>";
                        echo "<td>" . $row['responsavel'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>Nenhum chamado pendente encontrado.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
// Fecha a conexão com o banco de dados
$conn->close();
?>
