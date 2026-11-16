<?php
require_once __DIR__ . '/../tela_usuario/usuarios_comum.php';
$usuario = exigir_login();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ferrorama — Início</title>
  <link rel="icon" href="../../assets/images/logo.ico">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../../styles/style.css">
</head>
<body class="app-layout bg-light">
  <?php require __DIR__ . '/../templates/sidebar.php'; ?>
  <main id="conteudo" class="app-main home-page">
    <div class="container-fluid px-3 px-lg-5 py-4 py-lg-5">
      <header class="home-hero mb-4 mb-lg-5">
        <span class="home-eyebrow"><i class="bi bi-train-front me-2"></i>Centro de operações</span>
        <h1 class="display-5 fw-bold mt-3 mb-2">Olá, <?= escapar($usuario['nome']) ?>.</h1>
        <p class="lead mb-0">Acesse trens, rotas, sensores e alertas em um só lugar.</p>
      </header>

      <div class="row g-4">
        <section class="col-xl-8" aria-labelledby="acoes-titulo">
          <div class="d-flex align-items-end justify-content-between mb-3">
            <div>
              <p class="text-uppercase fw-semibold text-primary small mb-1">Navegação rápida</p>
              <h2 id="acoes-titulo" class="h3 fw-bold mb-0">O que você precisa acompanhar?</h2>
            </div>
          </div>
          <div class="row g-3">
            <?php
            $atalhos = [
              ['bi-train-front', 'Trens', 'Consulte e gerencie as composições cadastradas.', '../tela_trem/tela_trem.php'],
              ['bi-signpost-split', 'Rotas', 'Veja trajetos e itinerários da operação.', '../tela_rota/tela_rota.php'],
              ['bi-broadcast', 'Sensores', 'Acompanhe os sensores associados aos trens.', '../tela_sensores/tela_sensores.php'],
              ['bi-exclamation-triangle', 'Sensores com falha', 'Consulte os sensores marcados com falha.', '../tela_alerta/tela_alerta.php'],
              ['bi-map', 'Simulação do circuito', 'Explore o percurso animado ilustrativo.', '../tela_mapa/tela_mapa.php'],
              ['bi-geo-alt', 'Consultar CEP', 'Localize um endereço com preenchimento automático.', '../tela_cep/tela_cep.php'],
            ];
            foreach ($atalhos as [$icone, $titulo, $descricao, $url]):
            ?>
              <div class="col-md-6">
                <a class="home-link card h-100 text-decoration-none" href="<?= escapar($url) ?>">
                  <span class="home-icon"><i class="bi <?= escapar($icone) ?>" aria-hidden="true"></i></span>
                  <strong class="h5 text-dark mt-3 mb-1"><?= escapar($titulo) ?></strong>
                  <span class="text-muted small flex-grow-1"><?= escapar($descricao) ?></span>
                  <span class="text-primary fw-semibold small mt-3">Abrir <i class="bi bi-arrow-up-right" aria-hidden="true"></i></span>
                </a>
              </div>
            <?php endforeach; ?>
          </div>
        </section>

        <aside class="col-xl-4" aria-labelledby="clima-titulo">
          <div class="home-weather card h-100">
            <div class="card-body p-4">
              <div class="d-flex justify-content-between align-items-start gap-2">
                <div>
                  <p class="text-uppercase fw-semibold small mb-1">Condições externas</p>
                  <h2 id="clima-titulo" class="h4 fw-bold mb-0">Clima agora</h2>
                </div>
                <i class="bi bi-cloud-sun fs-2" aria-hidden="true"></i>
              </div>
              <div class="home-weather-value fw-bold mt-4" id="clima-temperatura">—</div>
              <p class="fs-5 mb-1" id="clima-condicao">Carregando clima…</p>
              <p class="mb-4"><i class="bi bi-geo-alt me-1" aria-hidden="true"></i>São Paulo, SP · Brasil</p>
              <div class="home-weather-footer pt-3">
                <p class="small mb-1" id="clima-horario">Aguardando atualização</p>
                <p class="small mb-3" id="clima-estado" role="status" aria-live="polite">Consultando Open-Meteo…</p>
                <button class="btn btn-light btn-sm" type="button" id="clima-atualizar"><i class="bi bi-arrow-clockwise me-1" aria-hidden="true"></i>Atualizar clima</button>
              </div>
            </div>
          </div>
        </aside>
      </div>
      <p class="text-muted small mt-4 mb-0">O clima é uma referência para São Paulo e não representa a posição de um trem ou leitura de sensor.</p>
    </div>
  </main>
  <script src="../../script/clima.js" defer></script>
</body>
</html>
