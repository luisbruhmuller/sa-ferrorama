<?php
/**
 * Login controlado por ../../script/login.js. Compara dados do localStorage do navegador;
 * não autentica pelo MySQL nem cria uma sessão PHP.
 */







?>

<!DOCTYPE html>
<html lang="pt-BR">

<!-- Metadados, adaptação da página para dispositivos móveis e estilos. -->
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>GordoSensores — Login</title>
    <!-- Bootstrap: grade responsiva e aparência de tabelas, cards e botões. -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Ícones fornecidos pelas classes bi e bi-*. -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />
    <!-- Estilos próprios, incluindo posicionamento do menu e conteúdo. -->
    <link rel="stylesheet" href="../../styles/style.css">
</head>

<body class="bg-light">
<!-- Área principal da tela, posicionada pela classe app-main. -->
<main id="conteudo" class="app-main">


    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container-fluid">
            <span class="navbar-brand fw-bold"><img src="../../assets/images/logo.ico" class="brand-logo me-2" alt="Gordo Holding">GordoSensores</span>

        </div>
    </nav>

    <div class="container-fluid py-4 px-3">

        <section id="screen-login" class="mb-5">

            <div class="container-fluid py-4 px-3">


                <div class="row justify-content-center">
                    <div class="col-md-5 col-lg-4">
                        <div class="card shadow">
                            <div class="card-body p-4">
                                <div class="text-center mb-4">
                                    <img src="../../assets/images/logo.ico" class="brand-logo brand-logo-form" alt="Gordo Holding">
                                    <h4 class="fw-bold mt-2">GordoSensores</h4>
                                    <p class="text-muted small">Sistema de Monitoramento Ferroviário</p>
                                </div>
<!-- Campos lidos por login.js pelos IDs login-login e login-senha. -->
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">E-mail</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                        <input type="email" class="form-control" placeholder="usuario@empresa.com"
                                            id="login-login" />
                                    </div>
                                </div>
<!-- Campos lidos por login.js pelos IDs login-login e login-senha. -->
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Senha</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                        <input type="password" class="form-control" placeholder="••••••••"
                                            id="login-senha" />
                                        <button class="btn btn-outline-secondary"><i class="bi bi-eye"></i></button>
                                    </div>
                                </div>
<!-- Opção visual: login.js não utiliza Manter conectado para guardar uma sessão. -->
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" checked />
                                    <label class="form-check-label">Manter conectado</label>
                                </div>

<!-- O evento registrado em login.js processa o clique, sem submit de formulário. -->
                                <button id="enviar_login" class="btn btn-warning w-100 fw-semibold" type="button">
                                    <i class="bi bi-box-arrow-in-right me-2"></i>
                                    Entrar
                                </button>

<!-- d-none oculta as mensagens até login.js mostrar sucesso ou erro. -->
                                <div class="erros">
                                    <div id="alert-sucesso" class="alert alert-success d-none" role="alert">
                                        Login realizado com sucesso!
                                    </div>

                                    <div id="alert-erro" class="alert alert-danger d-none" role="alert">
                                        Usuário ou senha inválidos!
                                    </div>

                                </div>
                                <hr />
                            </div>
                        </div>


                    </div>
                </div>
        </div>
</section>




    </div>
<!-- Registra os eventos após a criação dos campos no DOM.
O script compartilhado também trata cadastro e verifica a existência dos botões. -->
    <script src="../../script/login.js"></script>
    <!-- Habilita componentes interativos do Bootstrap, como modal e accordion. -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</main>

</body>

</html>