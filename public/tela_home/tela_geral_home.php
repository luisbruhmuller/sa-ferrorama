<?php
// Inicia a sessão antes de enviar o HTML ao navegador.
require_once __DIR__ . '/../tela_usuario/usuarios_comum.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GordoSensores — Dashboard</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="../../styles/home.css">
</head>
<body>
  <?php include '../templates/sidebar.php'; ?>

  <main class="home" id="conteudo">
    <header class="home-cabecalho">
      <div>
        <p class="legenda">PAINEL DE MONITORAMENTO</p>
        <h1>Visão geral da ferrovia</h1>
        <p>Acompanhe os indicadores e os alertas da operação.</p>
      </div>
      <span class="etiqueta azul"><i class="bi bi-info-circle" aria-hidden="true"></i> Dados demonstrativos</span>
    </header>

    <!-- Os valores são exemplos fixos, sem leituras de sensores ou filtros. -->
    <div class="home-colunas">
      <section class="resumo" aria-label="Indicadores e alertas">
        <div class="trem-selecionado">
          <span class="icone"><i class="bi bi-train-front" aria-hidden="true"></i></span>
          <div><span class="legenda">TREM EM DESTAQUE</span><h2>TRN-04</h2><p>Estação A → Estação B</p></div>
          <a class="botao" href="../tela_trem/tela_trem.php">Ver trens <i class="bi bi-arrow-up-right" aria-hidden="true"></i></a>
        </div>

        <div class="indicadores">
          <article class="card indicador">
            <div class="titulo-indicador"><h3>Velocidade atual</h3><i class="bi bi-speedometer2" aria-hidden="true"></i></div>
            <p class="valor">87 <span>km/h</span></p>
            <div class="linha"><span class="etiqueta verde">Normal</span><span>Máx. 150 km/h</span></div>
            <meter min="0" max="150" value="87" aria-label="Velocidade: 87 de 150 km/h"></meter>
          </article>
          <article class="card indicador">
            <div class="titulo-indicador"><h3>Consumo de energia</h3><i class="bi bi-lightning-charge" aria-hidden="true"></i></div>
            <p class="valor">342 <span>kWh</span></p>
            <div class="linha"><span class="etiqueta amarelo">Atenção</span><span>+12% vs. média</span></div>
          </article>
          <article class="card indicador">
            <div class="titulo-indicador"><h3>Saúde do sistema</h3><i class="bi bi-heart-pulse" aria-hidden="true"></i></div>
            <p class="valor">94 <span>%</span></p>
            <div class="linha"><span class="etiqueta verde">Ótimo</span><span>Saúde geral</span></div>
            <meter min="0" max="100" value="94" aria-label="Saúde do sistema: 94%"></meter>
          </article>
          <article class="card indicador">
            <div class="titulo-indicador"><h3>Alertas ativos</h3><i class="bi bi-bell" aria-hidden="true"></i></div>
            <p class="valor">3 <span>alertas</span></p>
            <div class="linha"><span class="etiqueta vermelho">1 crítico</span><span>Último às 13:47</span></div>
          </article>
        </div>

        <section class="card alertas">
          <div class="titulo-secao"><h2>Alertas recentes</h2><a href="../tela_alerta/tela_alerta.php">Ver todos →</a></div>
          <ul class="lista-alertas">
            <li><span class="etiqueta vermelho">Crítico</span><h3>Vibração anormal detectada</h3><p>Roda dianteira esquerda · Sensor VIB-03</p><div class="linha"><span>KM 47.3 · 13:47:22</span><span class="etiqueta amarelo">Pendente</span></div></li>
            <li><span class="etiqueta amarelo">Média</span><h3>Temperatura acima do limite</h3><p>Motor · Sensor TMP-01</p><div class="linha"><span>KM 45.1 · 13:31:05</span><span class="etiqueta amarelo">Pendente</span></div></li>
            <li><span class="etiqueta azul">Baixa</span><h3>Consumo energético acima da média</h3><p>Aumento de 12% · Sensor PWR-02</p><div class="linha"><span>12:55:00</span><span class="etiqueta verde">Resolvido</span></div></li>
          </ul>
        </section>
      </section>

      <div class="detalhes">
        <section class="card localizacao">
          <div class="titulo-secao"><div><p class="legenda">PERCURSO DO TREM</p><h2>Localização</h2></div><a href="../tela_mapa/tela_mapa.php">Abrir ferrovia ↗</a></div>
          <!-- Ilustração da rota, sem integração com mapas ou GPS. -->
          <div class="mapa">
            <svg viewBox="0 0 640 360" role="img" aria-label="Rota ilustrativa entre a Estação A e a Estação B, com o trem TRN-04 no quilômetro 47.3">
              <rect width="640" height="360" fill="#e9ede7"/>
              <path d="M0 25 L155 0 195 85 140 140 0 110Z M390 0 L640 0 640 105 530 135 440 85Z M0 275 L145 235 210 360 0 360Z M385 255 L500 190 640 230 640 360 440 360Z" fill="#cdddbc"/>
              <path d="M280 -20 Q220 80 300 160 T345 380" fill="none" stroke="#c0dae5" stroke-width="24"/>
              <g fill="none" stroke="#fff" stroke-width="7">
                <path d="M-20 170 L660 110 M-20 300 L660 225 M70 -20 L190 380 M370 -20 L465 380 M570 -20 L545 380 M0 40 L640 320 M20 360 L620 0"/>
              </g>
              <path d="M85 100 L170 130 205 220 350 220 425 170 555 250" fill="none" stroke="#fff" stroke-width="8" stroke-linejoin="round"/>
              <path d="M85 100 L170 130 205 220 350 220 425 170 555 250" fill="none" stroke="#e8a04b" stroke-width="4" stroke-linejoin="round"/>
              <g fill="#fff" stroke="#2563eb" stroke-width="5"><circle cx="85" cy="100" r="12"/><circle cx="555" cy="250" r="12"/></g>
              <circle cx="350" cy="220" r="22" fill="#2563eb" stroke="#fff" stroke-width="5"/>
              <g fill="#fff"><rect x="341" y="209" width="18" height="18" rx="4"/><circle cx="344" cy="230" r="2"/><circle cx="356" cy="230" r="2"/></g>
              <rect x="344" y="213" width="12" height="6" rx="1" fill="#2563eb"/>
              <g font-family="Arial, sans-serif" font-size="13" fill="#344054">
                <rect x="48" y="53" width="78" height="26" rx="5" fill="#fff"/><text x="60" y="71">Estação A</text>
                <rect x="512" y="280" width="78" height="26" rx="5" fill="#fff"/><text x="524" y="298">Estação B</text>
                <rect x="313" y="170" width="76" height="27" rx="5" fill="#fff"/><text x="328" y="188">TRN-04</text>
              </g>
            </svg>
            <span class="mapa-legenda">Rota ilustrativa</span>
          </div>
          <div class="rota"><div><span class="legenda">ORIGEM</span><strong>Estação A</strong></div><i class="bi bi-arrow-right" aria-hidden="true"></i><div><span class="legenda">DESTINO</span><strong>Estação B</strong></div><span class="etiqueta azul">KM 47.3</span></div>
          <p class="coordenadas">Localização de exemplo: Lat. -23.5505 · Lon. -46.6333</p>
        </section>

        <section class="card subsistemas">
          <div class="titulo-secao"><div><p class="legenda">CONDIÇÕES DA OPERAÇÃO</p><h2>Status dos subsistemas</h2></div><span class="etiqueta verde">4 de 6 OK</span></div>
          <div class="lista-sistemas">
            <div><i class="bi bi-gear" aria-hidden="true"></i><span>Motor</span><span class="etiqueta verde">OK</span></div>
            <div><i class="bi bi-lightning" aria-hidden="true"></i><span>Elétrico</span><span class="etiqueta amarelo">Atenção</span></div>
            <div><i class="bi bi-shield-check" aria-hidden="true"></i><span>Freios</span><span class="etiqueta verde">OK</span></div>
            <div><i class="bi bi-wifi" aria-hidden="true"></i><span>Comunicação</span><span class="etiqueta verde">OK</span></div>
            <div><i class="bi bi-thermometer-half" aria-hidden="true"></i><span>Refrigeração</span><span class="etiqueta vermelho">Falha</span></div>
            <div><i class="bi bi-camera-video" aria-hidden="true"></i><span>Câmeras</span><span class="etiqueta verde">OK</span></div>
          </div>
        </section>
      </div>
    </div>
    <footer class="home-rodape">GordoSensores · Monitoramento ferroviário <span>Projeto de aprendizagem — dados de exemplo</span></footer>
  </main>
</body>
</html>
