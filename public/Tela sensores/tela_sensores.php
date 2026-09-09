<?php







?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela Visualização de Usuários</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/styles/style.css">
</head>

<body>

    <div class="row g-0 border rounded shadow overflow-hidden" style="min-height:900px">
        <div class="col bg-light">
            <div class="d-flex align-items-center justify-content-between px-4 py-2 bg-white border-bottom shadow-sm">
                <h6 class="mb-0 fw-bold"><i class="bi bi-people-fill me-2 text-warning"></i>Sensores</h6>
                <div class="d-flex align-items-center gap-3">
                    <span class="badge bg-success"><i class="bi bi-circle-fill me-1" style="font-size:8px"></i>Sistema
                        Online</span>
                    <span class="text-muted small"><i class="bi bi-clock me-1"></i>Atualizado: 14:32:07</span>
                    <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-arrow-clockwise"></i></button>
                </div>
            </div>

            <div class="p-4 bg-light flex-grow-1">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="mb-0 text-secondary fw-normal">Lista de Sensores Cadastrados</h5>
                    <a href="tela_cadastro_sensores.html" class="btn btn-primary"><i
                            class="bi bi-person-plus-fill me-2"></i>Novo Sensor</a>
                </div>

                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped mb-0 align-middle">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col" class="ps-4 py-3 rounded-top-start">ID</th>
                                        <th scope="col" class="py-3">Nome</th>
                                        <th scope="col" class="py-3">Trem/local</th>
                                        <th scope="col" class="py-3">Tipo</th>
                                        <th scope="col" class="py-3">Conjunto</th>
                                        <th scope="col" class="text-end pe-4 py-3 rounded-top-end">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row" class="ps-4">TMP-04</th>
                                        <td class="fw-medium">Temperatura-wtrn-04</td>
                                        <td>TRN-04</td>
                                        <td><span
                                                class="badge bg-danger bg-opacity-75 fw-normal px-2 py-1 ">Temperatura</span>
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
                                        <th scope="row" class="ps-4">GPS-04</th>
                                        <td class="fw-medium">gps-gtrn-04</td>
                                        <td>TRN-04</td>
                                        <td><span
                                                class="badge bg-warning bg-opacity-75 fw-normal px-2 py-1">Localização</span>
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
                                        <th scope="row" class="ps-4">VEL-04</th>
                                        <td class="fw-medium">Velocidade-vtrn-04</td>
                                        <td>TRN-04</td>
                                        <td><span
                                                class="badge bg-success bg-opacity-75 fw-normal px-2 py-1">Funcionário</span>
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









            <script src="../script/validacao.js"></script>
</body>

</html>