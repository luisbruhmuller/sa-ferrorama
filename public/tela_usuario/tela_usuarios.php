<?php







?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela Visualização de Usuários</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../../assets/styles/style.css">
</head>

<body class="app-layout bg-light">
<main id="conteudo" class="app-main">

    <div class="row g-0 border rounded shadow overflow-hidden" style="min-height:900px">

        <div class="col bg-light">
            <div class="d-flex align-items-center justify-content-between px-4 py-2 bg-white border-bottom shadow-sm">
                <h6 class="mb-0 fw-bold"><i class="bi bi-people-fill me-2 text-warning"></i>Usuários</h6>
                <div class="d-flex align-items-center gap-3">
                    <span class="badge bg-success"><i class="bi bi-circle-fill me-1" style="font-size:8px"></i>Sistema
                        Online</span>
                    <span class="text-muted small"><i class="bi bi-clock me-1"></i>Atualizado: 14:32:07</span>
                    <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-arrow-clockwise"></i></button>
                </div>
            </div>

            <div class="p-4 bg-light flex-grow-1">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="mb-0 text-secondary fw-normal">Lista de Usuários Cadastrados</h5>
                    <a href="tela_cadastro_usuarios.php" class="btn btn-primary"><i
                            class="bi bi-person-plus-fill me-2"></i>Novo Usuário</a>
                </div>

                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped mb-0 align-middle">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col" class="ps-4 py-3 rounded-top-start">ID</th>
                                        <th scope="col" class="py-3">Nome</th>
                                        <th scope="col" class="py-3">Sobrenome</th>
                                        <th scope="col" class="py-3">Cargo</th>
                                        <th scope="col" class="py-3">Email</th>
                                        <th scope="col" class="text-end pe-4 py-3 rounded-top-end">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row" class="ps-4">1</th>
                                        <td class="fw-medium">Roberto</td>
                                        <td>Carlos</td>
                                        <td><span
                                                class="badge bg-primary bg-opacity-75 fw-normal px-2 py-1">Administrador</span>
                                        </td>
                                        <td class="text-muted">roberto_carlos@gmail.com</td>
                                        <td class="text-end pe-4">
                                            <button type="button" class="btn btn-sm btn-outline-secondary me-1"
                                                title="Editar"><i class="bi bi-pencil-square"></i></button>
                                            <button type="button" class="btn btn-sm btn-outline-danger"
                                                title="Excluir"><i class="bi bi-trash"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="ps-4">2</th>
                                        <td class="fw-medium">Gabriel</td>
                                        <td>Medeiros</td>
                                        <td><span
                                                class="badge bg-secondary bg-opacity-75 fw-normal px-2 py-1">Técnico</span>
                                        </td>
                                        <td class="text-muted">gabriel_medeiros@gmail.com</td>
                                        <td class="text-end pe-4">
                                            <button type="button" class="btn btn-sm btn-outline-secondary me-1"
                                                title="Editar"><i class="bi bi-pencil-square"></i></button>
                                            <button type="button" class="btn btn-sm btn-outline-danger"
                                                title="Excluir"><i class="bi bi-trash"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="ps-4">3</th>
                                        <td class="fw-medium">Dagoberto</td>
                                        <td>Junior</td>
                                        <td><span
                                                class="badge bg-success bg-opacity-75 fw-normal px-2 py-1">Funcionário</span>
                                        </td>
                                        <td class="text-muted">dagoberto_junior@gmail.com</td>
                                        <td class="text-end pe-4">
                                            <button type="button" class="btn btn-sm btn-outline-secondary me-1"
                                                title="Editar"><i class="bi bi-pencil-square"></i></button>
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
<script src="../../script/app.js"></script>
</body>

</html>