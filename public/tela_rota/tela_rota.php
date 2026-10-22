<?php
require_once __DIR__ . '/rota_funcoes.php';

$flash = rota_flash_pegar();
$rotas = [];
$erroConsulta = false;

try {
    $resultado = $conexao->query(
        "SELECT r.id, r.nome, r.distancia, r.tempo, r.origem, r.destino, r.status,
                GROUP_CONCAT(t.nome ORDER BY t.nome SEPARATOR '||') AS nomes_trens
         FROM rotas AS r
         LEFT JOIN rota_trens AS rt ON rt.id_rota = r.id
         LEFT JOIN trens AS t ON t.id_trem = rt.id_trem
         GROUP BY r.id, r.nome, r.distancia, r.tempo, r.origem, r.destino, r.status
         ORDER BY r.id"
    );
    $rotas = $resultado->fetch_all(MYSQLI_ASSOC);
} catch (mysqli_sql_exception $ex) {
    error_log('Erro ao listar rotas: ' . $ex->getMessage());
    $erroConsulta = true;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GordoSensores — Rotas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../styles/style.css">
</head>
<body class="app-layout bg-light">
<?php include '../templates/sidebar.php'; ?>
<main id="conteudo" class="app-main">
    <div class="d-flex align-items-center justify-content-between px-4 py-3 bg-white border-bottom shadow-sm">
        <h5 class="mb-0 fw-bold"><i class="bi bi-signpost-split me-2 text-warning"></i>Rotas</h5>
        <a href="tela_rota.php" class="btn btn-sm btn-outline-secondary" title="Atualizar lista">
            <i class="bi bi-arrow-clockwise"></i>
        </a>
    </div>

    <div class="p-4">
        <?php if ($flash): ?>
            <div class="alert alert-<?= rota_h($flash['tipo']) ?> alert-dismissible fade show" role="alert">
                <?= rota_h($flash['mensagem']) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
            </div>
        <?php endif; ?>
        <?php if ($erroConsulta): ?>
            <div class="alert alert-danger">Não foi possível carregar a lista de rotas.</div>
        <?php endif; ?>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="mb-0 text-secondary fw-normal">Rotas cadastradas</h5>
            <a href="tela_cadastro_rota.php" class="btn text-white" style="background-color:#0b3d91">
                <i class="bi bi-plus-circle-fill me-2"></i>Nova Rota
            </a>
        </div>

        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0 align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th class="ps-4 py-3">ID</th>
                                <th>Rota</th>
                                <th>Trajeto</th>
                                <th>Distância</th>
                                <th>Tempo</th>
                                <th>Status</th>
                                <th>Trens</th>
                                <th class="text-end pe-4">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!$rotas): ?>
                                <tr><td colspan="8" class="text-center text-muted py-4">Nenhuma rota cadastrada.</td></tr>
                            <?php endif; ?>
                            <?php foreach ($rotas as $rota): ?>
                                <tr>
                                    <th class="ps-4"><?= rota_h(str_pad($rota['id'], 2, '0', STR_PAD_LEFT)) ?></th>
                                    <td class="fw-medium"><?= rota_h($rota['nome']) ?></td>
                                    <td>
                                        <?= rota_h($rota['origem']) ?>
                                        <i class="bi bi-arrow-right mx-1 text-muted"></i>
                                        <?= rota_h($rota['destino']) ?>
                                    </td>
                                    <td><?= rota_h(number_format((float) $rota['distancia'], 2, ',', '.')) ?> km</td>
                                    <td><?= rota_h(substr($rota['tempo'], 0, 5)) ?></td>
                                    <td><span class="badge <?= rota_classe_status($rota['status']) ?> bg-opacity-75">
                                        <?= rota_h(ucfirst($rota['status'])) ?></span></td>
                                    <td>
                                        <?php $nomesTrens = $rota['nomes_trens'] ? explode('||', $rota['nomes_trens']) : []; ?>
                                        <?php if (!$nomesTrens): ?>
                                            <span class="badge bg-warning text-dark">Sem trem</span>
                                        <?php endif; ?>
                                        <?php foreach ($nomesTrens as $nomeTrem): ?>
                                            <span class="badge bg-secondary mb-1"><?= rota_h($nomeTrem) ?></span>
                                        <?php endforeach; ?>
                                    </td>
                                    <td class="text-end pe-4 text-nowrap">
                                        <a href="tela_editar_rota.php?id=<?= (int) $rota['id'] ?>"
                                            class="btn btn-sm btn-outline-secondary me-1" title="Editar">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-danger" title="Excluir"
                                            data-bs-toggle="modal" data-bs-target="#modalExcluir"
                                            data-id="<?= (int) $rota['id'] ?>" data-nome="<?= rota_h($rota['nome']) ?>">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalExcluir" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form class="modal-content" method="post" action="rota_excluir.php">
                <input type="hidden" name="csrf_token" value="<?= rota_h(rota_csrf_token()) ?>">
                <input type="hidden" name="id_rota" id="excluir_id" value="">
                <div class="modal-header">
                    <h5 class="modal-title">Excluir rota</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">Tem certeza que deseja excluir a rota <strong id="excluir_nome"></strong>?</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger"><i class="bi bi-trash me-1"></i>Excluir</button>
                </div>
            </form>
        </div>
    </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.getElementById('modalExcluir').addEventListener('show.bs.modal', function (evento) {
    var botao = evento.relatedTarget;
    document.getElementById('excluir_id').value = botao.getAttribute('data-id');
    document.getElementById('excluir_nome').textContent = botao.getAttribute('data-nome');
});
</script>
</body>
</html>
