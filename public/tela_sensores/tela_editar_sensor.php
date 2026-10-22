<?php
require_once __DIR__ . '/sensor_funcoes.php';
exigir_admin();
include '../templates/sidebar.php';

$idSensor = sensor_id_valido($_GET['id'] ?? null);
$sensor = $idSensor !== null ? sensor_buscar($conexao, $idSensor) : null;
if ($sensor === null) {
    sensor_flash('danger', 'Sensor não encontrado.');
    sensor_redirecionar('tela_sensores.php');
}

$form = sensor_pegar_formulario();
$dados = $form['dados'] ?: $sensor;
$erros = $form['erros'];
$flash = sensor_flash_pegar();
$trens = [];

try {
    $trens = sensor_listar_trens($conexao);
} catch (mysqli_sql_exception $ex) {
    error_log('Erro ao listar trens na edição de sensor: ' . $ex->getMessage());
    $flash = ['tipo' => 'danger', 'mensagem' => 'Não foi possível carregar os trens.'];
}

$acaoForm = 'sensor_editar.php';
$textoBotao = 'Salvar Alterações';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GordoSensores — Editar Sensor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../styles/style.css">
</head>
<body class="app-layout bg-light">
<main id="conteudo" class="app-main">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container-fluid">
            <span class="navbar-brand fw-bold"><img src="../../assets/images/logo.ico" class="brand-logo me-2"
                alt="Gordo Holding">GordoSensores</span>
        </div>
    </nav>
    <div class="container-fluid py-4 px-3">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card shadow">
                    <div class="card-body p-4">
                        <div class="text-center mb-4">
                            <i class="bi bi-cpu display-4 text-warning"></i>
                            <h4 class="fw-bold mt-2">GordoSensores</h4>
                            <p class="text-muted small">Editar Sensor #<?= (int) $sensor['id_sensor'] ?></p>
                        </div>
                        <?php if ($flash): ?>
                            <div class="alert alert-<?= sensor_h($flash['tipo']) ?>" role="alert">
                                <?= sensor_h($flash['mensagem']) ?></div>
                        <?php endif; ?>
                        <?php include __DIR__ . '/sensor_form.php'; ?>
                    </div>
                </div>
                <div class="text-center mt-3">
                    <a href="tela_sensores.php" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Voltar</a>
                </div>
            </div>
        </div>
    </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
