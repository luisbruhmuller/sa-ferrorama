<?php







?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>GordoSensores — Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="../../assets/styles/style.css">
</head>
<body class="app-layout bg-light">
<aside class="app-sidebar bg-dark text-white">
    <div class="p-3 border-bottom border-secondary">
      <a class="d-flex align-items-center text-white text-decoration-none fw-bold fs-5" href="../../public/Tela%20Home/tela_geral_home.php">
        <img src="../../assets/images/gordo_holding_icon.png" class="brand-logo me-2" alt="Gordo Holding">GordoSensores
      </a>
      <div class="small text-white-50">Monitoramento ferroviário</div>
    </div>
    <nav class="nav flex-column p-2 gap-1 flex-grow-1" aria-label="Menu principal">
      <a href="../../public/Tela%20Home/tela_geral_home.php" class="nav-link text-white rounded px-3 py-2 bg-warning bg-opacity-25" aria-current="page"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a><span class="nav-link text-white-50 px-3 py-2" aria-disabled="true"><i class="bi bi-map me-2"></i>Mapa<small class="d-block ms-4">Em breve</small></span><span class="nav-link text-white-50 px-3 py-2" aria-disabled="true"><i class="bi bi-graph-up me-2"></i>Métricas<small class="d-block ms-4">Em breve</small></span><span class="nav-link text-white-50 px-3 py-2" aria-disabled="true"><i class="bi bi-exclamation-triangle me-2"></i>Alertas<small class="d-block ms-4">Em breve</small></span><span class="nav-link text-white-50 px-3 py-2" aria-disabled="true"><i class="bi bi-tools me-2"></i>Manutenção<small class="d-block ms-4">Em breve</small></span><span class="nav-link text-white-50 px-3 py-2" aria-disabled="true"><i class="bi bi-file-earmark-bar-graph me-2"></i>Relatórios<small class="d-block ms-4">Em breve</small></span><span class="nav-link text-white-50 px-3 py-2" aria-disabled="true"><i class="bi bi-train-front me-2"></i>Detalhes Trem<small class="d-block ms-4">Em breve</small></span><a href="../../public/Tela%20sensores/tela_sensores.php" class="nav-link text-white rounded px-3 py-2"><i class="bi bi-cpu me-2"></i>Sensores IoT</a><a href="../../public/Tela%20Usu%C3%A1rio/tela_usuarios.php" class="nav-link text-white rounded px-3 py-2"><i class="bi bi-people me-2"></i>Gerenciar usuários</a>
    </nav>
    <div class="p-3 border-top border-secondary">
      <a class="text-warning text-decoration-none" href="../../public/Tela%20Usu%C3%A1rio/tela_login.php"><i class="bi bi-person-circle me-2"></i>Login</a>
    </div></aside>
<main id="conteudo" class="app-main">
    <div class="row g-0 border rounded shadow overflow-hidden" style="min-height:900px">



      <div class="col bg-light">
        <div class="d-flex align-items-center justify-content-between px-4 py-2 bg-white border-bottom shadow-sm">
          <h6 class="mb-0 fw-bold"><i class="bi bi-speedometer2 me-2 text-warning"></i>Dashboard Principal</h6>
          <div class="d-flex align-items-center gap-3">
            <span class="badge bg-success"><i class="bi bi-circle-fill me-1" style="font-size:8px"></i>Sistema Online</span>
            <span class="text-muted small"><i class="bi bi-clock me-1"></i>Atualizado: 14:32:07</span>
            <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-arrow-clockwise"></i></button>
          </div>
        </div>

        <div class="p-4">
          <div class="row g-3 mb-4">
            <div class="col-sm-6 col-xl-3">
              <div class="card border-start border-5 border-primary shadow-sm h-100">
                <div class="card-body">
                  <div class="d-flex justify-content-between align-items-start">
                    <div>
                      <div class="text-muted small fw-semibold text-uppercase">Velocidade Atual</div>
                      <div class="display-6 fw-bold">87 <small class="fs-6 text-muted">km/h</small></div>
                      <span class="badge bg-success">Normal</span>
                    </div>
                    <div class="bg-primary bg-opacity-10 rounded p-2">
                      <i class="bi bi-speedometer2 fs-3 text-primary"></i>
                    </div>
                  </div>
                  <div class="progress mt-2" style="height:4px">
                    <div class="progress-bar bg-primary" style="width:58%"></div>
                  </div>
                  <small class="text-muted">Máx. 150 km/h</small>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-xl-3">
              <div class="card border-start border-5 border-warning shadow-sm h-100">
                <div class="card-body">
                  <div class="d-flex justify-content-between align-items-start">
                    <div>
                      <div class="text-muted small fw-semibold text-uppercase">Consumo Energia</div>
                      <div class="display-6 fw-bold">342 <small class="fs-6 text-muted">kWh</small></div>
                      <span class="badge bg-warning text-dark">Atenção</span>
                    </div>
                    <div class="bg-warning bg-opacity-10 rounded p-2">
                      <i class="bi bi-lightning-charge fs-3 text-warning"></i>
                    </div>
                  </div>
                  <div class="progress mt-2" style="height:4px">
                    <div class="progress-bar bg-warning" style="width:72%"></div>
                  </div>
                  <small class="text-muted">+12% vs. média</small>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-xl-3">
              <div class="card border-start border-5 border-success shadow-sm h-100">
                <div class="card-body">
                  <div class="d-flex justify-content-between align-items-start">
                    <div>
                      <div class="text-muted small fw-semibold text-uppercase">Saúde do Sistema</div>
                      <div class="display-6 fw-bold">94 <small class="fs-6 text-muted">%</small></div>
                      <span class="badge bg-success">Ótimo</span>
                    </div>
                    <div class="bg-success bg-opacity-10 rounded p-2">
                      <i class="bi bi-heart-pulse fs-3 text-success"></i>
                    </div>
                  </div>
                  <div class="progress mt-2" style="height:4px">
                    <div class="progress-bar bg-success" style="width:94%"></div>
                  </div>
                  <small class="text-muted">Todos sistemas ok</small>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-xl-3">
              <div class="card border-start border-5 border-danger shadow-sm h-100">
                <div class="card-body">
                  <div class="d-flex justify-content-between align-items-start">
                    <div>
                      <div class="text-muted small fw-semibold text-uppercase">Alertas Ativos</div>
                      <div class="display-6 fw-bold">3 <small class="fs-6 text-muted">alertas</small></div>
                      <span class="badge bg-danger">1 crítico</span>
                    </div>
                    <div class="bg-danger bg-opacity-10 rounded p-2">
                      <i class="bi bi-exclamation-triangle fs-3 text-danger"></i>
                    </div>
                  </div>
                  <div class="progress mt-2" style="height:4px">
                    <div class="progress-bar bg-danger" style="width:30%"></div>
                  </div>
                  <small class="text-muted">Último: 13:47</small>
                </div>
              </div>
            </div>
          </div>

          <div class="row g-3">
            <div class="col-lg-5">
              <div class="card shadow-sm h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                  <span class="fw-semibold"><i class="bi bi-geo-alt me-2 text-danger"></i>Localização em Tempo Real</span>
                  <a aria-disabled="true" title="Em breve" class="btn btn-sm btn-outline-primary disabled">Ver mapa completo</a>
                </div>
                <div class="card-body p-0">
                  <div class="bg-secondary bg-opacity-10 d-flex flex-column align-items-center justify-content-center" style="height:220px">
                    <i class="bi bi-map display-1 text-secondary opacity-25"></i>
                    <p class="text-muted small mt-2">Mapa OpenStreetMap / Google Maps</p>
                    <div class="d-flex gap-1 align-items-center mt-1">
                      <span class="badge bg-secondary">Estação A</span>
                      <i class="bi bi-arrow-right text-muted"></i>
                      <span class="badge bg-warning text-dark"><i class="bi bi-train-front-fill me-1"></i>TRN-04</span>
                      <i class="bi bi-arrow-right text-muted"></i>
                      <span class="badge bg-secondary">Estação B</span>
                    </div>
                    <small class="text-muted mt-2">Lat: -23.5505 | Lon: -46.6333</small>
                    <small class="text-muted">Segmento: KM 47.3</small>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-7">
              <div class="card shadow-sm h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                  <span class="fw-semibold"><i class="bi bi-bell me-2 text-warning"></i>Alertas Recentes</span>
                  <a aria-disabled="true" title="Em breve" class="btn btn-sm btn-outline-warning disabled">Ver todos</a>
                </div>
                <div class="card-body p-0">
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex align-items-start gap-3 py-3">
                      <span class="badge bg-danger mt-1">Crítico</span>
                      <div class="flex-grow-1">
                        <div class="fw-semibold">Vibração anormal detectada — Roda dianteira esquerda</div>
                        <div class="text-muted small"><i class="bi bi-geo-alt me-1"></i>KM 47.3 · <i class="bi bi-clock me-1"></i>13:47:22 · <i class="bi bi-cpu me-1"></i>Sensor VIB-03</div>
                      </div>
                      <span class="badge bg-warning text-dark">Pendente</span>
                    </li>
                    <li class="list-group-item d-flex align-items-start gap-3 py-3">
                      <span class="badge bg-warning text-dark mt-1">Média</span>
                      <div class="flex-grow-1">
                        <div class="fw-semibold">Temperatura do motor acima do limite</div>
                        <div class="text-muted small"><i class="bi bi-geo-alt me-1"></i>KM 45.1 · <i class="bi bi-clock me-1"></i>13:31:05 · <i class="bi bi-cpu me-1"></i>Sensor TMP-01</div>
                      </div>
                      <span class="badge bg-warning text-dark">Pendente</span>
                    </li>
                    <li class="list-group-item d-flex align-items-start gap-3 py-3">
                      <span class="badge bg-info text-dark mt-1">Baixa</span>
                      <div class="flex-grow-1">
                        <div class="fw-semibold">Consumo energético acima da média (12%)</div>
                        <div class="text-muted small"><i class="bi bi-clock me-1"></i>12:55:00 · <i class="bi bi-cpu me-1"></i>Sensor PWR-02</div>
                      </div>
                      <span class="badge bg-success">Resolvido</span>
                    </li>
                  </ul>
                </div>
              </div>
            </div>


            <div class="col-12">
              <div class="card shadow-sm">
                <div class="card-header fw-semibold"><i class="bi bi-grid me-2"></i>Status dos Subsistemas</div>
                <div class="card-body">
                  <div class="row g-2 text-center">
                    <div class="col-6 col-md-2"><div class="border rounded p-2"><i class="bi bi-gear-fill fs-4 text-success"></i><div class="small mt-1 fw-semibold">Motor</div><div><span class="badge bg-success">OK</span></div></div></div>
                    <div class="col-6 col-md-2"><div class="border rounded p-2"><i class="bi bi-lightning-fill fs-4 text-warning"></i><div class="small mt-1 fw-semibold">Elétrico</div><div><span class="badge bg-warning text-dark">Atenção</span></div></div></div>
                    <div class="col-6 col-md-2"><div class="border rounded p-2"><i class="bi bi-shield-check fs-4 text-success"></i><div class="small mt-1 fw-semibold">Freios</div><div><span class="badge bg-success">OK</span></div></div></div>
                    <div class="col-6 col-md-2"><div class="border rounded p-2"><i class="bi bi-wifi fs-4 text-success"></i><div class="small mt-1 fw-semibold">Comunicação</div><div><span class="badge bg-success">OK</span></div></div></div>
                    <div class="col-6 col-md-2"><div class="border rounded p-2"><i class="bi bi-thermometer-half fs-4 text-danger"></i><div class="small mt-1 fw-semibold">Refrigeração</div><div><span class="badge bg-danger">Falha</span></div></div></div>
                    <div class="col-6 col-md-2"><div class="border rounded p-2"><i class="bi bi-camera-video fs-4 text-success"></i><div class="small mt-1 fw-semibold">Câmeras</div><div><span class="badge bg-success">OK</span></div></div></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</main>

</body>
</html>