<?php
require_once __DIR__ . '/../tela_usuario/usuarios_comum.php';
exigir_login();

// Busca os sensores que estão com falha.
$resultado = mysqli_query($conn, "SELECT s.*, t.nome AS trem_nome FROM sensor s INNER JOIN trens t ON t.id_trem=s.id_trem WHERE s.tipo='Com falha' ORDER BY s.id_sensor DESC");
$falhas = $resultado ? mysqli_fetch_all($resultado, MYSQLI_ASSOC) : [];
$erroConsulta = !$resultado;
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ferrorama — Sensores com falha</title>
  <link rel="icon" href="../../assets/images/logo.ico">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../../styles/style.css">
</head>
<body class="app-layout bg-light">
  <?php require __DIR__ . '/../templates/sidebar.php'; ?>
  <main id="conteudo" class="app-main">
    <div class="container-fluid px-3 px-lg-5 py-4 py-lg-5">
      <div class="d-flex flex-wrap justify-content-between align-items-start gap-3 mb-4">
        <div>
          <p class="text-uppercase fw-semibold text-primary small mb-1">Acompanhamento operacional</p>
          <h1 class="h2 fw-bold mb-2">Sensores com falha</h1>
          <p class="text-muted mb-0">Esta lista reflete os sensores cadastrados com status “Com falha”.</p>
        </div>
        <a class="btn btn-outline-primary" href="tela_alerta.php"><i class="bi bi-arrow-clockwise me-1" aria-hidden="true"></i>Atualizar lista</a>
      </div>

      <?php if ($erroConsulta): ?>
        <div class="alert alert-danger" role="alert">Não foi possível carregar os sensores com falha. Tente novamente.</div>
      <?php elseif (!$falhas): ?>
        <div class="card border-0 shadow-sm"><div class="card-body p-4">
          <i class="bi bi-check-circle text-success fs-2" aria-hidden="true"></i>
          <h2 class="h5 fw-bold mt-2">Nenhum sensor marcado com falha</h2>
          <p class="text-muted mb-3">Consulte a lista de sensores para verificar os demais estados cadastrados.</p>
          <a class="btn btn-primary" href="../tela_sensores/tela_sensores.php">Ver sensores</a>
        </div></div>
      <?php else: ?>
        <div class="card border-0 shadow-sm">
          <div class="card-body p-0">
            <div class="table-responsive">
              <!-- Lista dos sensores encontrados. -->
              <table class="table table-hover align-middle mb-0">
                <thead class="table-dark"><tr><th scope="col" class="ps-4">Sensor</th><th scope="col">Tipo de dado</th><th scope="col">Trem</th><th scope="col">Subsistema e local</th><th scope="col">Estado</th></tr></thead>
                <tbody>
                <?php foreach ($falhas as $falha): ?>
                  <tr>
                    <td class="ps-4 fw-semibold"><?= escapar($falha['nome']) ?> <small class="text-muted">#<?= (int) $falha['id_sensor'] ?></small></td>
                    <td><?= escapar($falha['tipo_dado']) ?></td>
                    <td><?= escapar($falha['trem_nome']) ?> <small class="text-muted">#<?= (int) $falha['id_trem'] ?></small></td>
                    <td><?= escapar($falha['conjunto']) ?><small class="d-block text-muted"><?= escapar($falha['localizacao']) ?></small></td>
                    <td><span class="badge bg-danger">Com falha</span></td>
                  </tr>
                <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      <?php endif; ?>
      <p class="text-muted small mt-3">O status é atualizado pelo cadastro de sensores. Esta tela não recebe leituras nem gera avisos automáticos.</p>
    </div>
  </main>
</body>
</html>
