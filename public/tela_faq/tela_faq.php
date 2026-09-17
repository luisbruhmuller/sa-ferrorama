<?php
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GordoSensores — FAQ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../../styles/style.css">
</head>

<body class="app-layout bg-light">
<aside class="app-sidebar bg-dark text-white">
    <div class="p-3 border-bottom border-secondary">
      <a class="d-flex align-items-center text-white text-decoration-none fw-bold fs-5" href="../tela_home/tela_geral_home.php">
        <img src="../../assets/images/logo.ico" class="brand-logo me-2" alt="Gordo Holding">GordoSensores
      </a>
      <br>
      <div class="small text-white-50">Monitoramento ferroviário</div>
    </div>
    <nav class="nav flex-column p-2 gap-1 flex-grow-1" aria-label="Menu principal">
      <a href="../tela_home/tela_geral_home.php" class="nav-link text-white rounded px-3 py-2"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a>
      <a href="../tela_sensores/tela_sensores.php" class="nav-link text-white rounded px-3 py-2"><i class="bi bi-cpu me-2"></i>Sensores IoT</a>
      <a href="../tela_usuario/tela_usuarios.php" class="nav-link text-white rounded px-3 py-2"><i class="bi bi-people me-2"></i>Gerenciar usuários</a>
      <a href="tela_faq.php" class="nav-link text-white rounded px-3 py-2 bg-warning bg-opacity-25" aria-current="page"><i class="bi bi-question-circle me-2"></i>FAQ</a>
    </nav>
    <div class="p-3 border-top border-secondary">
      <a class="text-warning text-decoration-none" href="../tela_usuario/tela_login.php"><i class="bi bi-person-circle me-2"></i>Login</a>
    </div>
</aside>

<main id="conteudo" class="app-main">

    <div class="d-flex align-items-center justify-content-between px-4 py-2 bg-white border-bottom shadow-sm">
        <h6 class="mb-0 fw-bold"><i class="bi bi-question-circle-fill me-2 text-warning"></i>FAQ</h6>
        <span class="badge bg-success"><i class="bi bi-circle-fill me-1" style="font-size:8px"></i>Sistema Online</span>
    </div>

    <div class="p-4">
        <h5 class="text-secondary fw-normal mb-4">Perguntas Frequentes</h5>

        <div class="accordion shadow-sm" id="faq">

            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#pergunta1">
                        Aparece "Usuário ou senha inválidos!". O que faço?
                    </button>
                </h2>
                <div id="pergunta1" class="accordion-collapse collapse show" data-bs-parent="#faq">
                    <div class="accordion-body">
                        Confira se o e-mail está escrito certo e se o Caps Lock está desligado. Se continuar dando erro, peça para o administrador verificar seu cadastro.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#pergunta2">
                        Aparece "As senhas não coincidem!" no cadastro.
                    </button>
                </h2>
                <div id="pergunta2" class="accordion-collapse collapse" data-bs-parent="#faq">
                    <div class="accordion-body">
                        Os campos "Senha" e "Repetir senha" estão diferentes. Digite a mesma senha nos dois.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#pergunta3">
                        Não consigo cadastrar um sensor.
                    </button>
                </h2>
                <div id="pergunta3" class="accordion-collapse collapse" data-bs-parent="#faq">
                    <div class="accordion-body">
                        Todos os campos são obrigatórios. Confira se escolheu o Tipo e o Subsistema e se o Limite Crítico é um número.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#pergunta4">
                        A página não abre.
                    </button>
                </h2>
                <div id="pergunta4" class="accordion-collapse collapse" data-bs-parent="#faq">
                    <div class="accordion-body">
                        Confira sua internet e o endereço digitado. Se o sistema estiver rodando no seu computador, veja se o Apache e o MySQL estão ligados no XAMPP.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#pergunta5">
                        O que significa "Em breve" no menu?
                    </button>
                </h2>
                <div id="pergunta5" class="accordion-collapse collapse" data-bs-parent="#faq">
                    <div class="accordion-body">
                        São funções que ainda estão sendo desenvolvidas e vão ser liberadas nas próximas versões.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#pergunta6">
                        Um sensor aparece offline. O que fazer?
                    </button>
                </h2>
                <div id="pergunta6" class="accordion-collapse collapse" data-bs-parent="#faq">
                    <div class="accordion-body">
                        Verifique se o sensor está bem instalado e conectado. Se continuar offline, avise a equipe técnica.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#pergunta7">
                        A tela aparece desconfigurada.
                    </button>
                </h2>
                <div id="pergunta7" class="accordion-collapse collapse" data-bs-parent="#faq">
                    <div class="accordion-body">
                        Limpe o cache do navegador (Ctrl + Shift + Delete) e recarregue a página com Ctrl + F5.
                    </div>
                </div>
            </div>

        </div>

        <div class="card shadow-sm border-0 mt-4">
            <div class="card-body text-center">
                <h6 class="fw-bold">Não encontrou sua resposta?</h6>
                <p class="text-muted mb-0">Entre em contato com o suporte: <strong>suporte@gordoholding.com.br</strong></p>
            </div>
        </div>
    </div>

</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
