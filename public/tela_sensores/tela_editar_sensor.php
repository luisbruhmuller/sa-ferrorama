<?php
require_once __DIR__ . '/../tela_usuario/usuarios_comum.php';
exigir_admin();
$idSensor = (int) ($_GET['id'] ?? 0);
// Busca o sensor que vai ser editado.
$sensor = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM sensor WHERE id_sensor = $idSensor"));
if (!$sensor) {
    redirecionar('tela_sensores.php');
}
$trens = mysqli_query($conn, 'SELECT id_trem, nome, status FROM trens ORDER BY nome');
$flash = $_SESSION['sensor_flash'] ?? null;
unset($_SESSION['sensor_flash']);
$tiposDado = ['Temperatura', 'Vibração', 'Consumo de Energia', 'Velocidade', 'Localização'];
$conjuntos = ['Motor', 'Elétrico', 'Freios', 'Comunicação', 'Refrigeração', 'Câmeras'];
$statusSensor = ['Ativo', 'Inativo', 'Com falha'];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ferrorama — Editar Sensor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../styles/style.css">
</head>
<body class="app-layout bg-light">
<?php include __DIR__ . '/../templates/sidebar.php'; ?>
<main id="conteudo" class="app-main">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container-fluid">
            <span class="navbar-brand fw-bold"><img src="../../assets/images/logo.ico" class="brand-logo me-2"
                alt="">Ferrorama</span>
        </div>
    </nav>
    <div class="container-fluid py-4 px-3">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card shadow">
                    <div class="card-body p-4">
                        <div class="text-center mb-4">
                            <i class="bi bi-cpu display-4 text-warning"></i>
                            <h4 class="fw-bold mt-2">Ferrorama</h4>
                            <p class="text-muted small">Editar Sensor #<?= (int) $sensor['id_sensor'] ?></p>
                        </div>
                        <?php if ($flash): ?>
                            <div class="alert alert-<?= escapar($flash[1]) ?>" role="alert">
                                <?= escapar($flash[0]) ?></div>
                        <?php endif; ?>
                        <!-- Formulário de edição do sensor. -->
                        <form method="post" action="sensor_editar.php">
                            <input type="hidden" name="id_sensor" value="<?= $idSensor ?>">
                            <div class="mb-3"><label class="form-label fw-semibold" for="nome">Nome / Código do Sensor</label><div class="input-group"><span class="input-group-text"><i class="bi bi-tag"></i></span><input type="text" class="form-control" id="nome" name="nome" maxlength="100" required value="<?= escapar($sensor['nome']) ?>"></div></div>
                            <div class="mb-3"><label class="form-label fw-semibold" for="tipo_dado">Tipo de Sensor</label><div class="input-group"><span class="input-group-text"><i class="bi bi-activity"></i></span><select class="form-select" id="tipo_dado" name="tipo_dado" required><?php foreach ($tiposDado as $opcao): ?><option value="<?= escapar($opcao) ?>" <?= $sensor['tipo_dado'] === $opcao ? 'selected' : '' ?>><?= escapar($opcao) ?></option><?php endforeach; ?></select></div></div>
                            <div class="mb-3"><label class="form-label fw-semibold" for="id_trem">Trem Vinculado</label><div class="input-group"><span class="input-group-text"><i class="bi bi-train-front"></i></span><select class="form-select" id="id_trem" name="id_trem" required><?php while ($trem = mysqli_fetch_assoc($trens)): ?><option value="<?= (int) $trem['id_trem'] ?>" <?= (int) $sensor['id_trem'] === (int) $trem['id_trem'] ? 'selected' : '' ?>><?= escapar($trem['nome']) ?> (<?= escapar($trem['status']) ?>)</option><?php endwhile; ?></select></div></div>
                            <div class="mb-3"><label class="form-label fw-semibold" for="conjunto">Subsistema Vinculado</label><div class="input-group"><span class="input-group-text"><i class="bi bi-diagram-3"></i></span><select class="form-select" id="conjunto" name="conjunto" required><?php foreach ($conjuntos as $opcao): ?><option value="<?= escapar($opcao) ?>" <?= $sensor['conjunto'] === $opcao ? 'selected' : '' ?>><?= escapar($opcao) ?></option><?php endforeach; ?></select></div></div>
                            <div class="mb-3"><label class="form-label fw-semibold" for="localizacao">Local de Instalação</label><div class="input-group"><span class="input-group-text"><i class="bi bi-geo-alt"></i></span><input type="text" class="form-control" id="localizacao" name="localizacao" maxlength="100" required value="<?= escapar($sensor['localizacao']) ?>"></div></div>
                            <div class="mb-4"><label class="form-label fw-semibold" for="tipo">Status</label><div class="input-group"><span class="input-group-text"><i class="bi bi-broadcast"></i></span><select class="form-select" id="tipo" name="tipo" required><?php foreach ($statusSensor as $opcao): ?><option value="<?= escapar($opcao) ?>" <?= $sensor['tipo'] === $opcao ? 'selected' : '' ?>><?= escapar($opcao) ?></option><?php endforeach; ?></select></div></div>
                            <button class="btn btn-warning w-100 fw-semibold mb-3" type="submit"><i class="bi bi-check-circle-fill me-2"></i>Salvar Alterações</button>
                        </form>
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
