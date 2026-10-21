<?php
require_once __DIR__ . '/sensor_funcoes.php';
include '../templates/sidebar.php';

$flash = sensor_flash_pegar();
$sensores = [];
$erroConsulta = false;

try {
    $resultado = $conexao->query(
        'SELECT s.id_sensor, s.nome, s.localizacao, s.tipo_dado, s.tipo, s.conjunto,
                t.id_trem, t.nome AS trem_nome, COUNT(ds.id_dado) AS total_leituras
         FROM sensor AS s
         INNER JOIN trens AS t ON t.id_trem = s.id_trem
         LEFT JOIN dados_sensor AS ds ON ds.id_sensor = s.id_sensor
         GROUP BY s.id_sensor, s.nome, s.localizacao, s.tipo_dado, s.tipo, s.conjunto,
                  t.id_trem, t.nome
         ORDER BY s.id_sensor'
    );
    $sensores = $resultado->fetch_all(MYSQLI_ASSOC);
} catch (mysqli_sql_exception $ex) {
    error_log('Erro ao listar sensores: ' . $ex->getMessage());
    $erroConsulta = true;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GordoSensores — Sensores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../styles/style.css">
</head>
<body class="app-layout bg-light">
<main id="conteudo" class="app-main">
    <div class="row g-0 border rounded shadow overflow-hidden" style="min-height:900px">
        <div class="col bg-light">
            <div class="d-flex align-items-center justify-content-between px-4 py-2 bg-white border-bottom shadow-sm">
                <h6 class="mb-0 fw-bold"><i class="bi bi-cpu me-2" style="color:#0b3d91"></i>Sensores</h6>
                <a href="tela_sensores.php" class="btn btn-sm btn-outline-secondary" title="Atualizar lista">
                    <i class="bi bi-arrow-clockwise"></i></a>
            </div>

            <div class="p-4 bg-light flex-grow-1">
                <?php if ($flash): ?>
                    <div class="alert alert-<?= sensor_h($flash['tipo']) ?> alert-dismissible fade show" role="alert">
                        <?= sensor_h($flash['mensagem']) ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
                    </div>
                <?php endif; ?>
                <?php if ($erroConsulta): ?>
                    <div class="alert alert-danger">Não foi possível carregar a lista de sensores.</div>
                <?php endif; ?>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="mb-0 text-secondary fw-normal">Lista de Sensores Cadastrados</h5>
                    <a href="tela_cadastro_sensores.php" class="btn text-white" style="background-color:#0b3d91">
                        <i class="bi bi-plus-circle-fill me-2"></i>Novo Sensor</a>
                </div>

                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped mb-0 align-middle">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="ps-4 py-3">ID</th>
                                        <th class="py-3">Nome</th>
                                        <th class="py-3">Tipo</th>
                                        <th class="py-3">Status</th>
                                        <th class="py-3">Trem</th>
                                        <th class="py-3">Subsistema / Local</th>
                                        <th class="py-3 text-center">Leituras</th>
                                        <th class="text-end pe-4 py-3">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!$sensores): ?>
                                        <tr><td colspan="8" class="text-center text-muted py-4">Nenhum sensor cadastrado.</td></tr>
                                    <?php endif; ?>
                                    <?php foreach ($sensores as $sensor): ?>
                                        <tr>
                                            <th scope="row" class="ps-4"><?= sensor_h(str_pad($sensor['id_sensor'], 2, '0', STR_PAD_LEFT)) ?></th>
                                            <td class="fw-medium"><?= sensor_h($sensor['nome']) ?></td>
                                            <td><?= sensor_h($sensor['tipo_dado']) ?></td>
                                            <td><span class="badge <?= sensor_classe_status($sensor['tipo']) ?> bg-opacity-75">
                                                <?= sensor_h($sensor['tipo']) ?></span></td>
                                            <td><?= sensor_h($sensor['trem_nome']) ?> <small class="text-muted">#<?= (int) $sensor['id_trem'] ?></small></td>
                                            <td><?= sensor_h($sensor['conjunto']) ?><small class="d-block text-muted"><?= sensor_h($sensor['localizacao']) ?></small></td>
                                            <td class="text-center"><span class="badge bg-info text-dark"><?= (int) $sensor['total_leituras'] ?></span></td>
                                            <td class="text-end pe-4 text-nowrap">
                                                <a href="tela_editar_sensor.php?id=<?= (int) $sensor['id_sensor'] ?>"
                                                    class="btn btn-sm btn-outline-secondary me-1" title="Editar">
                                                    <i class="bi bi-pencil"></i></a>
                                                <button type="button" class="btn btn-sm btn-outline-danger" title="Excluir"
                                                    data-bs-toggle="modal" data-bs-target="#modalExcluir"
                                                    data-id="<?= (int) $sensor['id_sensor'] ?>"
                                                    data-nome="<?= sensor_h($sensor['nome']) ?>"
                                                    data-leituras="<?= (int) $sensor['total_leituras'] ?>">
                                                    <i class="bi bi-trash"></i></button>
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

    <div class="modal fade" id="modalExcluir" tabindex="-1" aria-labelledby="tituloModalExcluir" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form class="modal-content" method="post" action="excluir_sensores.php">
                <input type="hidden" name="csrf_token" value="<?= sensor_h(sensor_csrf_token()) ?>">
                <input type="hidden" name="id_sensor" id="excluir_id" value="">
                <div class="modal-header">
                    <h5 class="modal-title" id="tituloModalExcluir">Excluir sensor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <p>Tem certeza que deseja excluir <strong id="excluir_nome"></strong>?</p>
                    <div class="alert alert-warning d-none mb-0" id="aviso_leituras">
                        Este sensor possui leituras associadas e sua exclusão será bloqueada.
                    </div>
                </div>
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
    document.getElementById('aviso_leituras').classList.toggle('d-none', Number(botao.getAttribute('data-leituras')) === 0);
});
</script>
</body>
</html>
