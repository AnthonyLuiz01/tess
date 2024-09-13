<?php include('../connection/db.php'); ?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CTI - Coordenação de Tecnologia da Informação - Adm</title>

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
                                <input type="text" class="form-control" id="telefone" name="contato" required>
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
                    <th>Responsável</th>
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
                        } elseif ($row['status'] == 'Não_resolvido') {
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
                <!-- Modal para atualizar o chamado -->
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
                        <label for='nome_responsavel' class='form-label'>Nome do Responsável</label>
                        <input type='text' class='form-control' name='nome_responsavel' value='" . $row['responsavel'] . "' required>
                    </div>
                    <div class='mb-3'>
                        <label for='status' class='form-label'>Status</label>
                        <select class='form-select' name='status' required>
                            <option value='Pendente'" . ($row['status'] == 'Pendente' ? ' selected' : '') . ">Pendente</option>
                            <option value='Finalizado'" . ($row['status'] == 'Finalizado' ? ' selected' : '') . ">Finalizado</option>
                            <option value='Não_resolvido'" . ($row['status'] == 'Não_resolvido' ? ' selected' : '') . ">Não Resolvido</option>
                        </select>
                    </div>
                    <button type='submit' class='btn btn-primary'>Atualizar</button>
                </form>
            </div>
        </div>
    </div>
</div>
";
                    }
                } else {
                    echo "<tr><td colspan='9'>Nenhum chamado encontrado.</td></tr>";
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
        } elseif ($_GET['status'] == 'error') {
            echo '<div class="alert alert-danger" role="alert">Ocorreu um erro ao atualizar o chamado.</div>';
        }
    }
    ?>

    <script>
        // Função para aplicar a máscara de telefone
        function maskTelefone(input) {
            // Remove tudo que não for número
            let value = input.value.replace(/\D/g, '');

            // Adiciona parênteses no DDD
            if (value.length > 0) {
                value = '(' + value;
            }
            if (value.length > 3) {
                value = value.slice(0, 3) + ') ' + value.slice(3);
            }
            // Adiciona hífen após o quinto número
            if (value.length > 10) {
                value = value.slice(0, 10) + '-' + value.slice(10);
            }

            // Limita a 14 caracteres no total (formato: (99) 99999-9999)
            input.value = value.slice(0, 15);
        }

        document.getElementById('telefone').addEventListener('input', function() {
            maskTelefone(this);
        });
    </script>
</body>

</html>
