<?php
/**
 * Central de alertas demonstrativa. Registros, filtros, busca e paginação são estáticos;
 * os botões ainda não executam operações sobre os alertas.
 */

?>

<!DOCTYPE html>
<html lang="pt-BR">
<!-- Metadados, adaptação da página para dispositivos móveis e estilos. -->
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>RailSense — Alertas</title>
  <!-- Bootstrap: grade responsiva e aparência de tabelas, cards e botões. -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <!-- Ícones fornecidos pelas classes bi e bi-*. -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet"/>
    <!-- Estilos próprios, incluindo posicionamento do menu e conteúdo. -->
    <link rel="stylesheet" href="../../styles/style.css">
</head>
<body class="app-layout bg-light">

<!-- Menu lateral: links abrem telas; itens em span são informativos.
O destaque da página atual está fixo no HTML. -->
<aside class="app-sidebar bg-dark text-white">
  <div class="p-3 border-bottom border-secondary">
    <a
      class="d-flex align-items-center text-white text-decoration-none fw-bold fs-5"
      href="../../public/tela_home/tela_geral_home.php"
    >
      <img
        src="../../assets/images/logo.ico"
        class="brand-logo me-2"
        alt="Gordo Holding"
      >
      GordoSensores
    </a>
    <div class="small text-white-50">Monitoramento ferroviário</div>
  </div>

  <nav
    class="nav flex-column p-2 gap-1 flex-grow-1"
    aria-label="Menu principal"
  >

    <a
      href="../../public/tela_home/tela_geral_home.php"
      class="nav-link text-white rounded px-3 py-2"
    >
      <i class="bi bi-people me-2"></i>Dashboard
    </a>

    <span class="nav-link text-white-50 px-3 py-2" aria-disabled="true">
      <i class="bi bi-map me-2"></i>Mapa
      <small class="d-block ms-4">Em breve</small>
    </span>

    <span class="nav-link text-white-50 px-3 py-2" aria-disabled="true">
      <i class="bi bi-graph-up me-2"></i>Métricas
      <small class="d-block ms-4">Em breve</small>
    </span>

    <a
      href="../../public/tela_alerta/tela_alerta.php"
      class="nav-link text-white rounded px-3 py-2 bg-warning bg-opacity-25"
      aria-current="page"
    >
      <i class="bi bi-speedometer2 me-2"></i>Alertas
    </a>
    <span class="nav-link text-white-50 px-3 py-2" aria-disabled="true">
      <i class="bi bi-tools me-2"></i>Manutenção
      <small class="d-block ms-4">Em breve</small>
    </span>

    <span class="nav-link text-white-50 px-3 py-2" aria-disabled="true">
      <i class="bi bi-file-earmark-bar-graph me-2"></i>Relatórios
      <small class="d-block ms-4">Em breve</small>
    </span>

    <span class="nav-link text-white-50 px-3 py-2" aria-disabled="true">
      <i class="bi bi-train-front me-2"></i>Detalhes Trem
      <small class="d-block ms-4">Em breve</small>
    </span>

    <a
      href="../../public/tela_sensores/tela_sensores.php"
      class="nav-link text-white rounded px-3 py-2"
    >
      <i class="bi bi-cpu me-2"></i>Sensores IoT
    </a>

    <a
      href="../../public/tela_usuarios/tela_usuarios.php"
      class="nav-link text-white rounded px-3 py-2"
    >
      <i class="bi bi-people me-2"></i>Gerenciar usuários
    </a>
  </nav>

  <div class="p-3 border-top border-secondary">
    <a
      class="text-warning text-decoration-none"
      href="../../public/tela_usuario/tela_login.php"
    >
      <i class="bi bi-person-circle me-2"></i>Login
    </a>
  </div>
</aside>
 


<div class="py-4 px-3">

  
  <section id="screen-alerts" class="mb-5">

    <div class="card shadow">
      <div class="card-header d-flex flex-wrap gap-2 align-items-center bg-dark text-white">
        <span class="fw-bold me-auto"><i class="bi bi-exclamation-triangle me-2 text-warning"></i>Central de Alertas</span>
        <button class="btn btn-sm btn-outline-light"><i class="bi bi-funnel me-1"></i>Filtrar</button>
        <button class="btn btn-sm btn-outline-danger"><i class="bi bi-check-all me-1"></i>Marcar todos como lidos</button>
      </div>
      <div class="card-body">
<!-- Busca e contagens são demonstrativas; os controles não filtram a tabela. -->
        <!-- Filtros -->
        <div class="row g-2 mb-3">
          <div class="col-auto"><button class="btn btn-danger btn-sm active">Crítico <span class="badge bg-white text-danger">1</span></button></div>
          <div class="col-auto"><button class="btn btn-warning btn-sm text-dark">Médio <span class="badge bg-dark">1</span></button></div>
          <div class="col-auto"><button class="btn btn-info btn-sm text-dark">Baixo <span class="badge bg-dark">1</span></button></div>
          <div class="col-auto"><button class="btn btn-outline-secondary btn-sm">Todos</button></div>
          <div class="col-auto ms-auto">
            <input type="text" class="form-control form-control-sm" placeholder="Buscar alerta..."/>
          </div>
        </div>

        <!-- Tabela de alertas -->
        <!-- Contêiner que permite rolagem horizontal da tabela em telas estreitas. -->
        <div class="table-responsive">
          <table class="table table-hover align-middle">
            <!-- Cabeçalho que define o significado e a ordem das colunas. -->
            <thead class="table-dark">
              <tr>
                <th></th>
                <th>ID</th>
                <th>Descrição</th>
                <th>Severidade</th>
                <th>Trem</th>
                <th>Localização</th>
                <th>Hora</th>
                <th>Status</th>
                <th>Ações</th>
              </tr>
            </thead>
            <!-- Registros de exemplo escritos diretamente no HTML, sem consulta ao banco.
Os botões das linhas ainda não executam alterações nos registros. -->
            <tbody>
              <tr class="table-danger">
                <td><input type="checkbox"/></td>
                <td><code>#ALT-089</code></td>
                <td><strong>Vibração anormal — Roda dianteira esquerda</strong></td>
                <td><span class="badge bg-danger">Crítico</span></td>
                <td>TRN-04</td>
                <td><i class="bi bi-geo-alt text-danger"></i> KM 47.3</td>
                <td>13:47:22</td>
                <td><span class="badge bg-warning text-dark">Pendente</span></td>
                <td>
                  <button class="btn btn-sm btn-outline-primary me-1"><i class="bi bi-eye"></i></button>
                  <button class="btn btn-sm btn-outline-success"><i class="bi bi-check-lg"></i></button>
                </td>
              </tr>
              <tr class="table-warning">
                <td><input type="checkbox"/></td>
                <td><code>#ALT-088</code></td>
                <td>Temperatura do motor acima do limite (92°C)</td>
                <td><span class="badge bg-warning text-dark">Médio</span></td>
                <td>TRN-04</td>
                <td><i class="bi bi-geo-alt"></i> KM 45.1</td>
                <td>13:31:05</td>
                <td><span class="badge bg-warning text-dark">Pendente</span></td>
                <td>
                  <button class="btn btn-sm btn-outline-primary me-1"><i class="bi bi-eye"></i></button>
                  <button class="btn btn-sm btn-outline-success"><i class="bi bi-check-lg"></i></button>
                </td>
              </tr>
              <tr>
                <td><input type="checkbox"/></td>
                <td><code>#ALT-087</code></td>
                <td>Consumo energético 12% acima da média</td>
                <td><span class="badge bg-info text-dark">Baixo</span></td>
                <td>TRN-04</td>
                <td><i class="bi bi-geo-alt"></i> KM 40.0</td>
                <td>12:55:00</td>
                <td><span class="badge bg-success">Resolvido</span></td>
                <td>
                  <button class="btn btn-sm btn-outline-primary me-1"><i class="bi bi-eye"></i></button>
                  <button class="btn btn-sm btn-outline-secondary" disabled><i class="bi bi-check-lg"></i></button>
                </td>
              </tr>
              <tr>
                <td><input type="checkbox"/></td>
                <td><code>#ALT-086</code></td>
                <td>Sensor VIB-05 offline por 7 minutos</td>
                <td><span class="badge bg-info text-dark">Baixo</span></td>
                <td>TRN-07</td>
                <td><i class="bi bi-geo-alt"></i> KM 13.0</td>
                <td>12:10:44</td>
                <td><span class="badge bg-success">Resolvido</span></td>
                <td>
                  <button class="btn btn-sm btn-outline-primary me-1"><i class="bi bi-eye"></i></button>
                  <button class="btn btn-sm btn-outline-secondary" disabled><i class="bi bi-check-lg"></i></button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

<!-- Navegação visual: os links não carregam novas páginas de registros. -->
        <!-- Paginação -->
        <nav>
          <ul class="pagination pagination-sm justify-content-end">
            <li class="page-item disabled"><a class="page-link">Anterior</a></li>
            <li class="page-item active"><a class="page-link">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">Próximo</a></li>
          </ul>
        </nav>
      </div>
    </div>
  </section>

</div><!-- /container -->

<!-- Habilita componentes interativos do Bootstrap, como modal e accordion. -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>