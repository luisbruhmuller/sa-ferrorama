<?php






?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>GordoSensores — Cadastro de Sensor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="../../assets/styles/style.css">
</head>

<body class="app-layout bg-light">
<main id="conteudo" class="app-main">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container-fluid">
            <span class="navbar-brand fw-bold"><i
                    class="bi bi-train-front-fill me-2 text-warning"></i>GordoSensores</span>

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
                                    <i class="bi bi-cpu display-4 text-warning"></i>
                                    <h4 class="fw-bold mt-2">GordoSensores</h4>
                                    <p class="text-muted small">Cadastrar Novo Sensor IoT</p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Nome / Código do Sensor</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-tag"></i></span>
                                        <input type="text" class="form-control" placeholder="Ex: Sensor TMP-01"
                                            id="nome_sensor" required />
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Tipo de Sensor</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-activity"></i></span>
                                        <select class="form-select" id="tipo_sensor" required>
                                            <option value="" selected disabled>Selecione o tipo...</option>
                                            <option value="Temperatura">Temperatura</option>
                                            <option value="Vibração">Vibração</option>
                                            <option value="Consumo de Energia">Consumo de Energia</option>
                                            <option value="Velocidade">Velocidade</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Subsistema Vinculado</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-gear"></i></span>
                                        <select class="form-select" id="subsistema" required>
                                            <option value="" selected disabled>Selecione o subsistema...</option>
                                            <option value="Motor">Motor</option>
                                            <option value="Elétrico">Elétrico</option>
                                            <option value="Freios">Freios</option>
                                            <option value="Comunicação">Comunicação</option>
                                            <option value="Refrigeração">Refrigeração</option>
                                            <option value="Câmeras">Câmeras</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Local de Instalação</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
                                        <input type="text" class="form-control" placeholder="Ex: Vagão 1 / Roda Dianteira"
                                            id="localizacao" required />
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-semibold">Limite Crítico Máximo</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-exclamation-triangle"></i></span>
                                        <input type="number" class="form-control" placeholder="Ex: 85"
                                            id="limite_maximo" required />
                                    </div>
                                </div>

                                <button id="enviar_cadastro" class="btn btn-warning w-100 fw-semibold mb-3" type="button">
                                    <i class="bi bi-plus-circle-fill me-2"></i>
                                    Cadastrar Sensor
                                </button>
                                <div id="alert-sucesso" class="alert alert-success d-none" role="alert">
                                    Sensor cadastrado com sucesso!
                                </div>

                                <div id="alert-erro" class="alert alert-danger d-none" role="alert">
                                    Erro ao cadastrar o sensor! Verifique os dados.
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="text-center">
                            <a href="tela_sensores.php" class="btn btn-secondary"><i class="bi bi-arrow-left me-2"></i>Voltar</a>
                        </div>
                    </div>
                </div>
        </div>
</section>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</main>
<script src="../../script/app.js"></script>
</body>

</html>