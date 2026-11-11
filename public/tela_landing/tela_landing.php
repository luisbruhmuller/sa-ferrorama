<?php
/**
 * Landing page pública: apresenta o GordoSensores antes do login.
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
    ['bi-broadcast', 'Sensores em tempo real', 'Registre sensores de presença, temperatura e velocidade instalados ao longo da via e nos trens.'],
    ['bi-signpost-split', 'Rotas e itinerários', 'Defina rotas, estações e horários para planejar a operação de forma clara e previsível.'],
    ['bi-exclamation-triangle', 'Central de alertas', 'Receba avisos sobre falhas e anomalias para agir rápido e evitar interrupções no serviço.'],
    ['bi-map', 'Mapa da ferrovia', 'Visualize a malha ferroviária e a posição dos trens em um mapa interativo.'],
    ['bi-shield-lock', 'Acesso seguro', 'Perfis de administrador, técnico e operador, com senhas criptografadas e controle de permissões.'],
];
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>GordoSensores — Monitoramento Ferroviário</title>
    <link rel="icon" href="../../assets/images/logo.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../../styles/style.css">
</head>

<body class="bg-light">

    <nav class="navbar navbar-expand navbar-dark bg-dark sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="tela_landing.php">
                <img src="../../assets/images/logo.ico" class="brand-logo me-2" alt="Gordo Holding">GordoSensores
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
                        <i class="bi bi-cpu me-1"></i>Monitoramento ferroviário inteligente
                    </span>
                    <h1 class="display-5 fw-bold mb-3">
                        Sua ferrovia sob controle, <span class="landing-destaque">do sensor ao painel.</span>
                    </h1>
                    <p class="lead text-white-50 mb-4">
                        O GordoSensores reúne trens, rotas, sensores e alertas em uma única plataforma
                        para tornar a mobilidade urbana sobre trilhos mais segura e eficiente.
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
                            <span class="fw-semibold"><i class="bi bi-speedometer2 me-2 landing-destaque"></i>Visão geral</span>
                            <span class="badge bg-success-subtle text-success-emphasis"><i class="bi bi-circle-fill me-1 small"></i>Online</span>
                        </div>
                        <div class="row g-2 mb-3">
                            <div class="col-4"><div class="landing-kpi"><div class="fs-4 fw-bold">12</div><small>Trens</small></div></div>
                            <div class="col-4"><div class="landing-kpi"><div class="fs-4 fw-bold">48</div><small>Sensores</small></div></div>
                            <div class="col-4"><div class="landing-kpi"><div class="fs-4 fw-bold">3</div><small>Alertas</small></div></div>
                        </div>
                        <div class="landing-trilho" aria-hidden="true"><i class="bi bi-train-front-fill"></i></div>
                        <ul class="list-unstyled small mb-0 mt-3">
                            <li class="d-flex justify-content-between py-1 border-bottom border-secondary-subtle"><span>TRN-01 · Linha Norte</span><span class="landing-ok">Em operação</span></li>
                            <li class="d-flex justify-content-between py-1 border-bottom border-secondary-subtle"><span>TRN-04 · Linha Sul</span><span class="landing-atencao">Atenção</span></li>
                            <li class="d-flex justify-content-between py-1"><span>TRN-07 · Linha Leste</span><span class="landing-ok">Em operação</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>

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
                    <p class="text-muted">Sensores instalados nos trens e na via captam presença, velocidade e temperatura.</p>
                </div>
                <div class="col-md-4">
                    <div class="landing-passo mx-auto mb-3">2</div>
                    <h5 class="fw-bold">Processamento</h5>
                    <p class="text-muted">As leituras são registradas e analisadas para identificar falhas e anomalias.</p>
                </div>
                <div class="col-md-4">
                    <div class="landing-passo mx-auto mb-3">3</div>
                    <h5 class="fw-bold">Ação</h5>
                    <p class="text-muted">A equipe acompanha tudo no painel e recebe alertas para agir com rapidez.</p>
                </div>
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
            <span><img src="../../assets/images/logo.ico" class="brand-logo me-2" style="width:28px;height:28px" alt="">GordoSensores · Gordo Holding</span>
            <span>Situação de Aprendizagem — SENAI · <?= date('Y') ?></span>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
