<?php
require_once __DIR__ . '/../tela_usuario/usuarios_comum.php';
exigir_admin();
$idRota = (int) ($_GET['id'] ?? 0);
$rota = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM rotas WHERE id = $idRota"));
if (!$rota) {
    redirecionar('tela_rota.php');
}
$trens = mysqli_query($conn, 'SELECT id_trem, nome, status FROM trens ORDER BY nome');
$selecionados = [];
$resultadoSelecionados = mysqli_query($conn, "SELECT id_trem FROM rota_trens WHERE id_rota = $idRota");
while ($item = mysqli_fetch_assoc($resultadoSelecionados)) {
    $selecionados[] = (int) $item['id_trem'];
}
$flash = $_SESSION['rota_flash'] ?? null;
unset($_SESSION['rota_flash']);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ferrorama — Editar Rota</title>
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
                            <h4 class="fw-bold mt-2">Editar rota #<?= (int) $idRota ?></h4>
                            <p class="text-muted">Atualize o trajeto e suas associações.</p>
                        </div>
                        <?php if ($flash): ?>
                            <div class="alert alert-<?= escapar($flash[1]) ?>"><?= escapar($flash[0]) ?></div>
                        <?php endif; ?>
                        <form method="post" action="rota_editar.php">
                            <input type="hidden" name="id_rota" value="<?= $idRota ?>">
                            <div class="mb-3"><label class="form-label fw-semibold" for="nome">Nome da rota</label><input class="form-control" type="text" id="nome" name="nome" maxlength="200" required value="<?= escapar($rota['nome']) ?>"></div>
                            <div class="row g-3 mb-3"><div class="col-md-6"><label class="form-label fw-semibold" for="origem">Origem</label><input class="form-control" type="text" id="origem" name="origem" maxlength="200" required value="<?= escapar($rota['origem']) ?>"></div><div class="col-md-6"><label class="form-label fw-semibold" for="destino">Destino</label><input class="form-control" type="text" id="destino" name="destino" maxlength="200" required value="<?= escapar($rota['destino']) ?>"></div></div>
                            <div class="row g-3 mb-3"><div class="col-md-4"><label class="form-label fw-semibold" for="distancia">Distância (km)</label><input class="form-control" type="number" id="distancia" name="distancia" min="0.01" step="0.01" required value="<?= escapar($rota['distancia']) ?>"></div><div class="col-md-4"><label class="form-label fw-semibold" for="tempo">Tempo estimado</label><input class="form-control" type="time" id="tempo" name="tempo" required value="<?= escapar(substr($rota['tempo'], 0, 5)) ?>"></div><div class="col-md-4"><label class="form-label fw-semibold" for="status">Status</label><select class="form-select" id="status" name="status" required><option value="disponível" <?= $rota['status'] === 'disponível' ? 'selected' : '' ?>>Disponível</option><option value="indisponível" <?= $rota['status'] === 'indisponível' ? 'selected' : '' ?>>Indisponível</option></select></div></div>
                            <fieldset class="mb-4"><legend class="form-label fw-semibold fs-6">Trens associados</legend><div class="border rounded p-3"><div class="row g-2"><?php while ($trem = mysqli_fetch_assoc($trens)): ?><div class="col-md-6"><div class="form-check"><input class="form-check-input" type="checkbox" name="trens[]" id="trem_<?= (int) $trem['id_trem'] ?>" value="<?= (int) $trem['id_trem'] ?>" <?= in_array((int) $trem['id_trem'], $selecionados, true) ? 'checked' : '' ?>><label class="form-check-label" for="trem_<?= (int) $trem['id_trem'] ?>"><?= escapar($trem['nome']) ?> <small class="text-muted">(<?= escapar($trem['status']) ?>)</small></label></div></div><?php endwhile; ?></div></div></fieldset>
                            <button class="btn btn-warning w-100 fw-semibold" type="submit"><i class="bi bi-check-circle-fill me-2"></i>Salvar Alterações</button>
                        </form>
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
