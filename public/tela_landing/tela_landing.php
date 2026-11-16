<?php
/**
 * Landing page pública: apresenta o Ferrorama antes do login.
 * Não consulta o banco; apenas lê a sessão para trocar o botão principal
 * quando o usuário já está autenticado.
 */
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start(['cookie_httponly' => true, 'cookie_samesite' => 'Lax',
        'cookie_secure' => !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off']);
}
$logado = !empty($_SESSION['usuario_id']);
$destino = $logado ? '../tela_home/tela_geral_home.php' : '../tela_usuario/tela_login.php';
$textoBotao = $logado ? 'Ir para o painel' : 'Acessar o sistema';

$recursos = [
    ['bi-train-front', 'Gestão de trens', 'Cadastre a frota, acompanhe o status de cada composição e mantenha tudo organizado em um só lugar.'],
    ['bi-broadcast', 'Sensores', 'Cadastre sensores associados aos trens e organize os pontos de coleta da operação.'],
    ['bi-signpost-split', 'Rotas e itinerários', 'Cadastre e consulte trajetos para planejar a operação de forma clara.'],
    ['bi-exclamation-triangle', 'Central de alertas', 'Acesse avisos operacionais em uma área dedicada do sistema.'],
    ['bi-map', 'Mapa da ferrovia', 'Explore a representação visual da malha ferroviária.'],
    ['bi-shield-lock', 'Acesso seguro', 'Perfis de administrador, técnico e operador, com senhas criptografadas e controle de permissões.'],
];
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ferrorama — Monitoramento ferroviário</title>
    <link rel="icon" href="../../assets/images/logo.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../../styles/style.css">
</head>

<body class="bg-light">

    <nav class="navbar navbar-expand navbar-dark bg-dark sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="tela_landing.php">
                <img src="../../assets/images/logo.ico" class="brand-logo me-2" alt="">Ferrorama
            </a>
            <div class="d-flex align-items-center gap-3">
                <a class="nav-link text-white-50 d-none d-sm-inline" href="#recursos">Recursos</a>
                <a class="nav-link text-white-50 d-none d-sm-inline" href="#como-funciona">Como funciona</a>
                <a class="btn btn-warning btn-sm fw-semibold" href="<?= $destino ?>">
                    <i class="bi bi-box-arrow-in-right me-1"></i><?= $logado ? 'Painel' : 'Entrar' ?>
                </a>
            </div>
        </div>
    </nav>

    <header class="landing-hero text-white">
        <div class="container py-5">
            <div class="row align-items-center g-5 py-lg-4">
                <div class="col-lg-7">
                    <span class="badge rounded-pill landing-tag mb-3">
                        <i class="bi bi-cpu me-1"></i>Acompanhamento ferroviário em um só lugar
                    </span>
                    <h1 class="display-5 fw-bold mb-3">
                        A operação ferroviária mais clara, <span class="landing-destaque">do trilho ao painel.</span>
                    </h1>
                    <p class="lead text-white-50 mb-4">
                        O Ferrorama reúne cadastro de trens, rotas, sensores e alertas em uma plataforma
                        para apoiar o acompanhamento e a organização da operação.
                    </p>
                    <div class="d-flex flex-wrap gap-2">
                        <a class="btn btn-warning btn-lg fw-semibold px-4" href="<?= $destino ?>">
                            <i class="bi bi-box-arrow-in-right me-2"></i><?= $textoBotao ?>
                        </a>
                        <a class="btn btn-outline-light btn-lg px-4" href="#recursos">Conhecer recursos</a>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="landing-painel shadow-lg">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <span class="fw-semibold"><i class="bi bi-diagram-3 me-2 landing-destaque"></i>Fluxo do Ferrorama</span>
                            <span class="badge bg-primary-subtle text-primary-emphasis">Ilustração</span>
                        </div>
                        <div class="row g-2 mb-3">
                            <div class="col-4"><div class="landing-kpi"><i class="bi bi-train-front fs-4" aria-hidden="true"></i><small class="d-block">Trens</small></div></div>
                            <div class="col-4"><div class="landing-kpi"><i class="bi bi-broadcast fs-4" aria-hidden="true"></i><small class="d-block">Sensores</small></div></div>
                            <div class="col-4"><div class="landing-kpi"><i class="bi bi-exclamation-triangle fs-4" aria-hidden="true"></i><small class="d-block">Alertas</small></div></div>
                        </div>
                        <div class="landing-trilho" aria-hidden="true"><i class="bi bi-train-front-fill"></i></div>
                        <p class="small text-white-50 mt-3 mb-0">Organize os ativos, acompanhe as informações e encontre rapidamente o próximo passo.</p>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section id="problema" class="py-5 bg-white">
      <div class="container py-lg-3">
        <div class="row align-items-center g-4">
          <div class="col-lg-5"><p class="text-uppercase fw-semibold text-primary small mb-2">O desafio</p><h2 class="fw-bold">Informação dispersa atrasa decisões.</h2></div>
          <div class="col-lg-7"><p class="lead text-muted mb-0">Trens, rotas e sensores precisam ser vistos no contexto da mesma operação. O Ferrorama aproxima esses registros e oferece caminhos claros para consulta e gestão, ajudando equipes a acompanhar riscos e organizar o trabalho.</p></div>
        </div>
      </div>
    </section>

    <section id="recursos" class="py-5">
        <div class="container py-lg-3">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Tudo o que a operação precisa</h2>
                <p class="text-muted mb-0">Ferramentas pensadas para quem administra, mantém e opera a ferrovia.</p>
            </div>
            <div class="row g-4">
                <?php foreach ($recursos as [$icone, $titulo, $texto]): ?>
                    <div class="col-sm-6 col-lg-4">
                        <div class="card h-100 border-0 shadow-sm landing-card">
                            <div class="card-body p-4">
                                <div class="landing-icone mb-3"><i class="bi <?= $icone ?>"></i></div>
                                <h5 class="fw-bold"><?= $titulo ?></h5>
                                <p class="text-muted mb-0"><?= $texto ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section id="como-funciona" class="py-5 bg-white border-top border-bottom">
        <div class="container py-lg-3">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Como funciona</h2>
                <p class="text-muted mb-0">Do campo até a tela, em três passos.</p>
            </div>
            <div class="row g-4 text-center">
                <div class="col-md-4">
                    <div class="landing-passo mx-auto mb-3">1</div>
                    <h5 class="fw-bold">Coleta</h5>
                    <p class="text-muted">Cadastre os sensores e associe cada dispositivo ao trem correspondente.</p>
                </div>
                <div class="col-md-4">
                    <div class="landing-passo mx-auto mb-3">2</div>
                    <h5 class="fw-bold">Processamento</h5>
                    <p class="text-muted">Consulte trens, rotas e sensores em telas organizadas para a equipe.</p>
                </div>
                <div class="col-md-4">
                    <div class="landing-passo mx-auto mb-3">3</div>
                    <h5 class="fw-bold">Ação</h5>
                    <p class="text-muted">Acesse a área de alertas e as funcionalidades operacionais a partir da home.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-white border-top" aria-labelledby="beneficios-titulo">
      <div class="container py-lg-3">
        <p class="text-uppercase fw-semibold text-primary small mb-2">Por que centralizar</p>
        <h2 id="beneficios-titulo" class="fw-bold mb-4">Mais contexto para cada decisão</h2>
        <div class="row g-4">
          <div class="col-md-4"><h3 class="h5 fw-bold"><i class="bi bi-shield-check text-primary me-2"></i>Segurança</h3><p class="text-muted mb-0">Alertas e registros organizados ajudam a identificar pontos que exigem atenção.</p></div>
          <div class="col-md-4"><h3 class="h5 fw-bold"><i class="bi bi-lightning-charge text-primary me-2"></i>Eficiência</h3><p class="text-muted mb-0">A navegação direta reduz o tempo gasto procurando informações em telas diferentes.</p></div>
          <div class="col-md-4"><h3 class="h5 fw-bold"><i class="bi bi-clipboard-data text-primary me-2"></i>Acompanhamento</h3><p class="text-muted mb-0">Trens, rotas e sensores têm áreas próprias para consulta e atualização.</p></div>
        </div>
      </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="landing-cta text-white text-center p-5 rounded-4 shadow">
                <h2 class="fw-bold mb-2">Pronto para começar?</h2>
                <p class="text-white-50 mb-4">Entre com o e-mail e a senha fornecidos pelo administrador do sistema.</p>
                <a class="btn btn-warning btn-lg fw-semibold px-4" href="<?= $destino ?>">
                    <i class="bi bi-box-arrow-in-right me-2"></i><?= $textoBotao ?>
                </a>
            </div>
        </div>
    </section>

    <footer class="bg-dark text-white-50 py-4">
        <div class="container d-flex flex-column flex-sm-row justify-content-between align-items-center gap-2 small">
            <span><img src="../../assets/images/logo.ico" class="brand-logo me-2" style="width:28px;height:28px" alt="">Ferrorama · Projeto SENAI</span>
            <span>Situação de Aprendizagem — SENAI · <?= date('Y') ?></span>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
