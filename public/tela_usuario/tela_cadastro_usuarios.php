<?php







?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GordoSensores — Cadastro de usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="../../styles/style.css">
</head>

<body class="app-layout bg-light">
<aside class="app-sidebar bg-dark text-white">
    <div class="p-3 border-bottom border-secondary">
      <a class="d-flex align-items-center text-white text-decoration-none fw-bold fs-5" href="../../public/Tela%20Home/tela_geral_home.php">
        <img src="../../assets/images/logo.ico" class="brand-logo me-2" alt="Gordo Holding">GordoSensores
      </a>
      <div class="small text-white-50">Monitoramento ferroviário</div>
    </div>
    <nav class="nav flex-column p-2 gap-1 flex-grow-1" aria-label="Menu principal">
      <a href="../../public/Tela%20Home/tela_geral_home.php" class="nav-link text-white rounded px-3 py-2"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a><span class="nav-link text-white-50 px-3 py-2" aria-disabled="true"><i class="bi bi-map me-2"></i>Mapa<small class="d-block ms-4">Em breve</small></span><span class="nav-link text-white-50 px-3 py-2" aria-disabled="true"><i class="bi bi-graph-up me-2"></i>Métricas<small class="d-block ms-4">Em breve</small></span><span class="nav-link text-white-50 px-3 py-2" aria-disabled="true"><i class="bi bi-exclamation-triangle me-2"></i>Alertas<small class="d-block ms-4">Em breve</small></span><span class="nav-link text-white-50 px-3 py-2" aria-disabled="true"><i class="bi bi-tools me-2"></i>Manutenção<small class="d-block ms-4">Em breve</small></span><span class="nav-link text-white-50 px-3 py-2" aria-disabled="true"><i class="bi bi-file-earmark-bar-graph me-2"></i>Relatórios<small class="d-block ms-4">Em breve</small></span><span class="nav-link text-white-50 px-3 py-2" aria-disabled="true"><i class="bi bi-train-front me-2"></i>Detalhes Trem<small class="d-block ms-4">Em breve</small></span><a href="../../public/Tela%20sensores/tela_sensores.php" class="nav-link text-white rounded px-3 py-2"><i class="bi bi-cpu me-2"></i>Sensores IoT</a><a href="../../public/Tela%20Usu%C3%A1rio/tela_usuarios.php" class="nav-link text-white rounded px-3 py-2 bg-warning bg-opacity-25" aria-current="page"><i class="bi bi-people me-2"></i>Gerenciar usuários</a>
    </nav>
    <div class="p-3 border-top border-secondary">
      <a class="text-warning text-decoration-none" href="../../public/Tela%20Usu%C3%A1rio/tela_login.php"><i class="bi bi-person-circle me-2"></i>Login</a>
    </div></aside>
<main id="conteudo" class="app-main">
<div class="cadastro-page">
    <div class="cadastro-content">



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
                                    <div class="card-body p-4 d-inline" id="conteiner-cadastro">
                                        <div class="text-center mb-4">
                                            <img src="../../assets/images/logo.ico" class="brand-logo brand-logo-form" alt="Gordo Holding">
                                            <h4 class="fw-bold mt-2">GordoSensores</h4>
                                            <p class="text-muted small">Cadastrar novo usuário</p>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">E-mail do usuário</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                                <input type="email" class="form-control"
                                                    placeholder="usuario@empresa.com" id="login" />
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Senha do usuário</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                                <input type="password" class="form-control" placeholder="••••••••"
                                                    id="senha" />
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Repetir senha</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                                <input type="password" class="form-control" placeholder="••••••••"
                                                    id="confirmar-senha" />
                                            </div>
                                        </div>

                                        <button id="enviar_cadastro" class="btn btn-warning w-100 fw-semibold"
                                            type="button">
                                            <i class="bi bi-box-arrow-in-right me-2"></i>
                                            Cadastrar usuário
                                        </button>
                                        <div id="alert-sucesso" class="alert alert-success d-none" role="alert">
                                            Usuário cadastrado com sucesso!
                                        </div>

                                        <div id="alert-erro" class="alert alert-danger d-none" role="alert">
                                            Erro ao cadastrar usuário!
                                        </div>
                                        <br>
                                        <br>
                                        <div class="d-flex justify-content-center">
                                            <a href="tela_usuarios.php" class="btn btn-secondary"><i
                                                    class="bi bi-arrow-left me-2"></i>Voltar</a>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="text-center">
                                </div>
                            </div>
                        </div>
                </div>
</section>

            </div>



            <script src="../../script/login.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        </div>
    </div>
</main>

</body>
</html>