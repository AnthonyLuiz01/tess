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
    <style>
        @media (max-width: 576px) {
            .navbar-brand img {
                width: 40px;
            }
            .navbar-brand span {
                font-size: 18px;
            }
            body {
                font-size: 16px;
            }
        }
    </style>
</head>

<body>



<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
    <a class="navbar-brand" href="../index.php">
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
                    <a class="nav-link" href="suporte.php">Suporte</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
    <!-- Conteúdo principal -->
    <div class="container my-4">
        <h2>Gerenciamento de Chamados</h2>

        <!-- Botões de Adicionar e Consultar -->
        <div class="d-flex justify-content-between">
            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalSolicitacao">
                Adicionar Solicitação
            </button>

            <button type="button" class="btn btn-secondary mb-3" data-bs-toggle="modal" data-bs-target="#modalConsulta">
                Consultar Chamado
            </button>
        </div>
<!--abri novo chamado -->
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

        <!-- Modal para consulta de chamado -->
        <div class="modal fade" id="modalConsulta" tabindex="-1" aria-labelledby="modalConsultaLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalConsultaLabel">Consultar Chamado</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="consultar_chamado.php" method="get">
                            <div class="mb-3">
                                <label for="nomeConsulta" class="form-label">Nome</label>
                                <input type="text" class="form-control" name="nome" id="nomeConsulta" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Consultar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
