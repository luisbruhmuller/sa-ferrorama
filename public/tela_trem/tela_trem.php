<?php
include '../templates/sidebar.php';
/**
 * Perguntas e respostas fixas. A expansão das respostas depende do JavaScript do Bootstrap.
 */
?>

<!DOCTYPE html>
<html lang="pt-BR">

<!-- Metadados, adaptação da página para dispositivos móveis e estilos. -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GordoSensores — Trens</title>
    <!-- Bootstrap: grade responsiva e aparência de tabelas, cards e botões. -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Ícones fornecidos pelas classes bi e bi-*. -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />
    <!-- Estilos próprios, incluindo posicionamento do menu e conteúdo. -->
    <link rel="stylesheet" href="../../styles/style.css">
</head>

<body class="app-layout bg-light">
    <aside class="app-sidebar bg-dark text-white">
        <div class="p-3 border-bottom border-secondary">
            <a class="d-flex align-items-center text-white text-decoration-none fw-bold fs-5" href="../../public/Tela%20Home/tela_geral_home.php">
                <img src="../../assets/images/logo.ico" class="brand-logo me-2" alt="Gordo Holding">GordoSensores
            </a>
            <br>
            <div class="small text-white-50">Monitoramento ferroviário</div>
        </div>
        <nav class="nav flex-column p-2 gap-1 flex-grow-1" aria-label="Menu principal">
            <a href="../../public/Tela%20Home/tela_geral_home.php" class="nav-link text-white rounded px-3 py-2"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a><span class="nav-link text-white-50 px-3 py-2" aria-disabled="true"><i class="bi bi-map me-2"></i>Mapa<small class="d-block ms-4">Em breve</small></span><span class="nav-link text-white-50 px-3 py-2" aria-disabled="true"><i class="bi bi-graph-up me-2"></i>Métricas<small class="d-block ms-4">Em breve</small></span><span class="nav-link text-white-50 px-3 py-2" aria-disabled="true"><i class="bi bi-exclamation-triangle me-2"></i>Alertas<small class="d-block ms-4">Em breve</small></span><span class="nav-link text-white-50 px-3 py-2" aria-disabled="true"><i class="bi bi-tools me-2"></i>Manutenção<small class="d-block ms-4">Em breve</small></span><span class="nav-link text-white-50 px-3 py-2" aria-disabled="true"><i class="bi bi-file-earmark-bar-graph me-2"></i>Relatórios<small class="d-block ms-4">Em breve</small></span><span class="nav-link text-white rounded px-3 py-2" aria-disabled="true"><i class="bi bi-train-front me-2"></i>Detalhes Trem
</span><a href="../../public/Tela%20sensores/tela_sensores.php" class="nav-link text-white rounded px-3 py-2 bg-warning bg-opacity-25" aria-current="page"><i class="bi bi-cpu me-2"></i>Sensores IoT</a><a href="../../public/Tela%20Usu%C3%A1rio/tela_usuarios.php" class="nav-link text-white rounded px-3 py-2"><i class="bi bi-people me-2"></i>Gerenciar usuários</a>
        </nav>
        <div class="p-3 border-top border-secondary">
            <a class="text-warning text-decoration-none" href="../../public/Tela%20Usu%C3%A1rio/tela_login.php"><i class="bi bi-person-circle me-2"></i>Login</a>
        </div>
    </aside>
    <main id="conteudo" class="app-main">

        <div class="row g-0 border rounded shadow overflow-hidden" style="min-height:900px">
            <div class="col bg-light">
                <div class="d-flex align-items-center justify-content-between px-4 py-2 bg-white border-bottom shadow-sm">
                    <h6 class="mb-0 fw-bold"><i class="bi bi-people-fill me-2" style="color: #0b3d91;"></i>Trens</h6>
                    <div class="d-flex align-items-center gap-3">
                        <span class="badge bg-success"><i class="bi bi-circle-fill me-1" style="font-size:8px"></i>Sistema
                            Online</span>
                        <span class="text-muted small"><i class="bi bi-clock me-1"></i>Atualizado: 14:32:07</span>
                        <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-arrow-clockwise"></i></button>
                    </div>
                </div>

                <div class="p-4 bg-light flex-grow-1">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="mb-0 text-secondary fw-normal">Lista de Trens Cadastrados</h5>
<!-- Pendência: Novo Trem aponta para um arquivo de sensores inexistente nesta pasta.
A tela tela_cadastro_trem.php ainda não foi implementada. -->
                        <a href="tela_cadastro_sensores.php" class="btn text-white"
                            style="background-color: #0b3d91;">
                            <i class="bi bi-person-plus-fill me-2"></i>Novo Trem</a>
                    </div>

                    <div class="card shadow-sm border-0 rounded-3">
                        <div class="card-body p-0">
                            <!-- Contêiner que permite rolagem horizontal da tabela em telas estreitas. -->
                            <div class="table-responsive">
                                <table class="table table-hover table-striped mb-0 align-middle">
                                    <!-- Cabeçalho que define o significado e a ordem das colunas. -->
                                    <thead class="table-dark">
                                        <tr>
                                            <th scope="col" class="ps-4 py-3 rounded-top-start">ID</th>
                                            <th scope="col" class="py-3">Nome do Trem</th>
                                            <th scope="col" class="py-3">Tipo de Trem</th>
                                            <th scope="col" class="py-3">Status</th>
                                            <th scope="col" class="py-3">Conjunto</th>
                                            <th scope="col" class="text-end pe-4 py-3 rounded-top-end">Ações</th>
                                        </tr>
                                    </thead>
                                    <!-- Registros de exemplo escritos diretamente no HTML, sem consulta ao banco.
Os botões das linhas ainda não executam alterações nos registros. -->
                                    <tbody>
                                        <tr>
                                            <th scope="row" class="ps-4">01</th>
                                            <td class="fw-medium">BNSF Railway</td>
                                            <td>Vagão Gôndola</td>
                                            <td><span
                                                    class="badge bg-danger bg-opacity-75 fw-normal px-2 py-1 ">Desativado</span>
                                            </td>
                                            <td class="text-muted">TRN-04-group</td>
                                            <td class="text-end pe-4">
                                                <button type="button" class="btn btn-sm btn-outline-secondary me-1"
                                                    title="Editar"><i class="bi bi-eye"></i></button>
                                                <button type="button" class="btn btn-sm btn-outline-danger"
                                                    title="Excluir"><i class="bi bi-trash"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="ps-4">02</th>
                                            <td class="fw-medium">Union Pacific</td>
                                            <td>Vagão Hopper</td>
                                            <td><span
                                                    class="badge bg-warning bg-opacity-75 fw-normal px-2 py-1">Parado no Caminho</span>
                                            </td>
                                            <td class="text-muted">TRN-04-group</td>
                                            <td class="text-end pe-4">
                                                <button type="button" class="btn btn-sm btn-outline-secondary me-1"
                                                    title="Editar"><i class="bi bi-eye"></i></button>
                                                <button type="button" class="btn btn-sm btn-outline-danger"
                                                    title="Excluir"><i class="bi bi-trash"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="ps-4">03</th>
                                            <td class="fw-medium">Sishen-Saldanha</td>
                                            <td>Vagão Plataforma</td>
                                            <td><span
                                                    class="badge bg-success bg-opacity-75 fw-normal px-2 py-1">Ativo</span>
                                            </td>
                                            <td class="text-muted">TRN-04-group</td>
                                            <td class="text-end pe-4">
                                                <button type="button" class="btn btn-sm btn-outline-secondary me-1"
                                                    title="Editar"><i class="bi bi-eye"></i></button>
                                                <button type="button" class="btn btn-sm btn-outline-danger"
                                                    title="Excluir"><i class="bi bi-trash"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>









            </div>
        </div>
    </main>

</body>

</html>