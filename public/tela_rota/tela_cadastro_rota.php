<?php
require_once __DIR__ . '/rota_funcoes.php';

$form = rota_pegar_formulario();
$dados = $form['dados'];
$erros = $form['erros'];
$flash = rota_flash_pegar();
$trens = [];

try {
    $trens = rota_listar_trens($conexao);
} catch (mysqli_sql_exception $ex) {
    error_log('Erro ao listar trens para rota: ' . $ex->getMessage());
    $flash = ['tipo' => 'danger', 'mensagem' => 'Não foi possível carregar os trens.'];
}

$acaoForm = 'rota_cadastrar.php';
$textoBotao = 'Cadastrar Rota';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GordoSensores — Cadastro de Rota</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../styles/style.css">
</head>
<body class="app-layout bg-light">
<?php include '../templates/sidebar.php'; ?>
<main id="conteudo" class="app-main">
    <div class="container-fluid py-4 px-3">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="text-center mb-4">
                            <i class="bi bi-signpost-split display-4 text-warning"></i>
                            <h4 class="fw-bold mt-2">Cadastrar nova rota</h4>
                            <p class="text-muted">Informe o trajeto e selecione um ou mais trens.</p>
                        </div>
                        <?php if ($flash): ?>
                            <div class="alert alert-<?= rota_h($flash['tipo']) ?>"><?= rota_h($flash['mensagem']) ?></div>
                        <?php endif; ?>
                        <?php include __DIR__ . '/rota_form.php'; ?>
                    </div>
                </div>
                <div class="text-center mt-3">
                    <a href="tela_rota.php" class="btn btn-secondary"><i class="bi bi-arrow-left me-2"></i>Voltar</a>
                </div>
            </div>
        </div>
    </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
