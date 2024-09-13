<?php include('../connection/db.php'); ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CTI - Coordenação de Tecnologia da Informação</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../favicon.ico">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assents/css/style.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
    <a class="navbar-brand" href="../controlls/add_news.php">
    <img src="../L.E.I.png" alt="Logo" style="width: 50px; height: auto;">
    <span style="vertical-align: middle;">CTI</span>
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
                    <a class="nav-link" href="../index.php">Serviços</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Projetos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="suporte.php">Suporte</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

    <div class="container my-4">
        <h2>Gerenciamento de Chamados</h2>

        <!-- Botão para abrir o modal de solicitação -->
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalSolicitacao">
            Abrir Solicitação
        </button>

        <!-- Modal para abrir nova solicitação -->
        <div class="modal fade" id="modalSolicitacao" tabindex="-1" aria-labelledby="modalSolicitacaoLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalSolicitacaoLabel">Nova Solicitação</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="../controlls/nova_solicitacao.php" method="post">
                            <div class="mb-3">
                                <label for="area" class="form-label">Área</label>
                                <input type="text" class="form-control" name="area" required>
                            </div>
                            <div class="mb-3">
                                <label for="nome" class="form-label">Nome</label>
                                <input type="text" class="form-control" name="nome" required>
                            </div>
                            <div class="mb-3">
                                <label for="contato" class="form-label">Contato</label>
                                <input type="text" class="form-control" name="contato" required>
                            </div>
                            <div class="mb-3">
                                <label for="problema" class="form-label">Problema</label>
                                <textarea class="form-control" name="problema" rows="4" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-success">Enviar Solicitação</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabela de chamados -->
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
                <th>Ação</th>
                <th>Responsavel</th>

            </tr>
        </thead>
        <tbody>
        <?php
        $sql = "SELECT * FROM chamados";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Definir a classe de acordo com o status
                $statusClass = '';
                if ($row['status'] == 'Pendente') {
                    $statusClass = 'bg-warning text-dark';
                } elseif ($row['status'] == 'Finalizado') {
                    $statusClass = 'bg-success text-white';
                } elseif ($row['status'] == 'Não Resolvido') {
                    $statusClass = 'bg-danger text-white';
                }

                // Formatar a data
                $dataCriacao = date('d/m/Y H:i', strtotime($row['data_criacao']));

                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['area'] . "</td>";
                echo "<td>" . $row['nome'] . "</td>";
                echo "<td>" . $row['contato'] . "</td>";
                echo "<td>" . $row['problema'] . "</td>";
                echo "<td class='" . $statusClass . "'>" . $row['status'] . "</td>";
                echo "<td>" . $dataCriacao . "</td>";
                echo "<td><button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#modalAtualizar" . $row['id'] . "'>Atualizar</button></td>";
                echo "<td>" . $row['responsavel'] . "</td>";
                echo "</tr>";

                // Modal para atualizar o chamado
                echo "
                <div class='modal fade' id='modalAtualizar" . $row['id'] . "' tabindex='-1' aria-labelledby='modalAtualizarLabel" . $row['id'] . "' aria-hidden='true'>
                    <div class='modal-dialog'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                                <h5 class='modal-title' id='modalAtualizarLabel" . $row['id'] . "'>Atualizar Chamado #" . $row['id'] . "</h5>
                                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                            </div>
                            <div class='modal-body'>
                                <form action='../model/atualizar_chamado.php' method='post'>
                                    <input type='hidden' name='id' value='" . $row['id'] . "'>
                                    <div class='mb-3'>
                                        <label for='responsavel' class='form-label'>Responsável</label>
                                        <input type='text' class='form-control' name='responsavel' required>
                                    </div>
                                    <button type='submit' name='status' value='Finalizado' class='btn btn-success'>Finalizado</button>
                                    <button type='submit' name='status' value='Não Resolvido' class='btn btn-danger'>Não Resolvido</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>";
            }
        } else {
            echo "<tr><td colspan='8'>Nenhum chamado encontrado.</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>

<?php include('./footer/footer.php'); ?>
<?php
if (isset($_GET['status'])) {
    if ($_GET['status'] == 'deleted') {
        echo '<div class="alert alert-success" role="alert">Chamado finalizado e removido com sucesso!</div>';
    } elseif ($_GET['status'] == 'updated') {
        echo '<div class="alert alert-info" role="alert">Chamado atualizado com sucesso!</div>';
    }
}
?>
</body>
</html>
