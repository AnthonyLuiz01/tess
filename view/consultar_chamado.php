<?php include('../connection/db.php'); ?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar Chamado</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container my-4">
        <h2>Resultado da Consulta</h2>

        <?php
        if (isset($_GET['nome'])) {
            $nome = $_GET['nome'];

            // Busca no banco de dados por chamados com o nome
            $sql = "SELECT * FROM chamados WHERE nome LIKE '%$nome%'";
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
                echo "<div class='alert alert-warning'>Nenhum chamado registrado com esse nome.</div>";
            }
        }
        ?>

        <!-- Botão Voltar -->
        <div class="text-center mt-4">
            <a href="suporte.php" class="btn btn-secondary">Voltar para Suporte</a>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
