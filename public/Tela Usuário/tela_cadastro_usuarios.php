<?php







?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet"/>
</head>

<body class="bg-light">
<div class="modal">
    <div class="modal-content">

        

            <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
                <div class="container-fluid">
                    <span class="navbar-brand fw-bold"><i
                            class="bi bi-train-front-fill me-2 text-warning"></i>GordoSensores</span>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mockupNav">
                        <span class="navbar-toggler-icon"></span>
                    </button>

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
                                            <i class="bi bi-train-front-fill display-4 text-warning"></i>
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
                                            <a href="tela_usuarios.html" class="btn btn-secondary"><i
                                                    class="bi bi-arrow-left me-2"></i>Voltar</a>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="text-center">
                                </div>
                            </div>
                        </div>
                </section>

            </div>



            <script src="../script/login.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        </div>
    </div>
</body>
</html>