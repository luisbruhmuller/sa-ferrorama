<?php
require __DIR__ . '/usuarios_comum.php';
exigir_admin();
$busca = isset($_GET['busca']) && is_string($_GET['busca']) ? trim($_GET['busca']) : '';
$funcao = isset($_GET['funcao']) && is_string($_GET['funcao']) ? $_GET['funcao'] : '';
$statusFiltro = isset($_GET['status']) && is_string($_GET['status']) ? $_GET['status'] : '';

$sql = 'SELECT id, nome, email, funcao, status FROM usuarios WHERE 1 = 1';
$tipos = '';
$valores = [];

if ($busca !== '') {
    $sql .= ' AND (nome LIKE ? OR email LIKE ?)';
    $tipos .= 'ss';
    $valores[] = "%{$busca}%";
    $valores[] = "%{$busca}%";
}
if (in_array($funcao, ['adm', 'tecnico', 'funcionario'], true)) {
    $sql .= ' AND funcao = ?';
    $tipos .= 's';
    $valores[] = $funcao;
}
if (in_array($statusFiltro, ['ativo', 'inativo', 'pendente'], true)) {
    $sql .= ' AND status = ?';
    $tipos .= 's';
    $valores[] = $statusFiltro;
}

$usuarios = consulta($sql . ' ORDER BY nome, id', $tipos, $valores)->get_result();
$cargos = ['adm' => 'Administrador', 'tecnico' => 'Técnico', 'funcionario' => 'Funcionário / Operador'];
$mensagem = $_SESSION['mensagem'] ?? null;
unset($_SESSION['mensagem']);
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela Visualização de Usuários</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="../../styles/style.css">
</head>

<body class="app-layout bg-light"><?php require __DIR__ . '/../templates/sidebar.php'; ?>

<main id="conteudo" class="app-main">

    <div class="row g-0 border rounded shadow overflow-hidden" style="min-height:900px">

        <div class="col bg-light">
            <div class="d-flex align-items-center justify-content-between px-4 py-2 bg-white border-bottom shadow-sm">
                <h6 class="mb-0 fw-bold"><i class="bi bi-people-fill me-2 text-warning"></i>Usuários</h6>
                <div class="d-flex align-items-center gap-3">
                    <span class="badge bg-success"><i class="bi bi-circle-fill me-1" style="font-size:8px"></i>Sistema
                        Online</span>

                    <a href="tela_usuarios.php" class="btn btn-sm btn-outline-secondary" aria-label="Atualizar"><i class="bi bi-arrow-clockwise"></i></a><form action="sair.php" method="post"><?= token() ?><button class="btn btn-sm btn-outline-secondary" type="submit">Sair</button></form>
                </div>
            </div>

            <div class="p-4 bg-light flex-grow-1"><?php if ($mensagem): ?><div class="alert alert-<?= escapar($mensagem[1]) ?>" role="alert"><?= escapar($mensagem[0]) ?></div><?php endif; ?>
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="mb-0 text-secondary fw-normal">Lista de Usuários Cadastrados</h5>
                    <a href="tela_cadastro_usuarios.php" class="btn btn-primary"><i
                            class="bi bi-person-plus-fill me-2"></i>Novo Usuário</a>
                </div>

                <form method="get" class="row g-2 mb-4">
                    <div class="col-md-5">
                        <label for="busca" class="form-label">Nome ou e-mail</label>
                        <input type="search" class="form-control" id="busca" name="busca" value="<?= escapar($busca) ?>" placeholder="Buscar usuário">
                    </div>
                    <div class="col-md-3">
                        <label for="funcao" class="form-label">Cargo</label>
                        <select class="form-select" id="funcao" name="funcao">
                            <option value="">Todos</option>
                            <?php foreach ($cargos as $valor => $rotulo): ?>
                                <option value="<?= escapar($valor) ?>" <?= $funcao === $valor ? 'selected' : '' ?>><?= escapar($rotulo) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status">
                            <option value="">Todos</option>
                            <option value="ativo" <?= $statusFiltro === 'ativo' ? 'selected' : '' ?>>Ativo</option>
                            <option value="inativo" <?= $statusFiltro === 'inativo' ? 'selected' : '' ?>>Inativo</option>
                            <option value="pendente" <?= $statusFiltro === 'pendente' ? 'selected' : '' ?>>Pendente</option>
                        </select>
                    </div>
                    <div class="col-md-2 d-flex align-items-end gap-2">
                        <button type="submit" class="btn btn-warning">Filtrar</button>
                        <a href="tela_usuarios.php" class="btn btn-outline-secondary">Limpar</a>
                    </div>
                </form>

                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-body p-0">

                        <div class="table-responsive">
                            <table class="table table-hover table-striped mb-0 align-middle">

                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col" class="ps-4 py-3 rounded-top-start">ID</th>
                                        <th scope="col" class="py-3">Nome completo</th>
                                        <th scope="col" class="py-3">Status</th>
                                        <th scope="col" class="py-3">Cargo</th>
                                        <th scope="col" class="py-3">Email</th>
                                        <th scope="col" class="text-end pe-4 py-3 rounded-top-end">Ações</th>
                                    </tr>
                                </thead>

                                <tbody>
    <?php if ($usuarios->num_rows === 0): ?>
        <tr><td colspan="6" class="text-center p-4">Nenhum usuário encontrado.</td></tr>
    <?php endif; ?>
    <?php foreach ($usuarios as $usuario): ?>
        <tr>
            <th scope="row" class="ps-4"><?= (int) $usuario['id'] ?></th>
            <td class="fw-medium"><?= escapar($usuario['nome']) ?></td>
            <td><?= escapar($usuario['status']) ?></td>
            <td><span class="badge bg-primary fw-normal"><?= escapar($cargos[$usuario['funcao']] ?? 'Não definido') ?></span></td>
            <td class="text-muted"><?= escapar($usuario['email']) ?></td>
            <td class="text-end pe-4 text-nowrap">
                <a href="tela_cadastro_usuarios.php?id=<?= (int) $usuario['id'] ?>" class="btn btn-sm btn-outline-secondary me-1" aria-label="Editar usuário"><i class="bi bi-pencil-square"></i></a>
                <form action="deletar_usuarios.php?id=<?= (int) $usuario['id'] ?>" method="post" class="d-inline" onsubmit="return confirm('Confirma a exclusão deste usuário?');">
                    <?= token() ?>
                    <button type="submit" class="btn btn-sm btn-outline-danger" aria-label="Excluir usuário"><i class="bi bi-trash"></i></button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
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
