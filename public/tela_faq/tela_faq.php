<?php
require_once __DIR__ . '/../tela_usuario/usuarios_comum.php';
exigir_login();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ferrorama — Ajuda</title>
  <link rel="icon" href="../../assets/images/logo.ico">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../../styles/style.css">
</head>
<body class="app-layout bg-light">
  <?php require __DIR__ . '/../templates/sidebar.php'; ?>
  <main id="conteudo" class="app-main">
    <div class="container-fluid px-3 px-lg-5 py-4 py-lg-5">
      <p class="text-uppercase fw-semibold text-primary small mb-1">Orientação rápida</p>
      <h1 class="h2 fw-bold mb-2">Como usar o Ferrorama</h1>
      <p class="text-muted mb-4">Use o menu lateral para voltar ao início e abrir as funcionalidades disponíveis para seu perfil.</p>

      <div class="accordion shadow-sm" id="ajuda">
        <?php
        // Perguntas mostradas na página.
        $perguntas = [
          ['Como entrar e sair?', 'Entre com o e-mail e a senha fornecidos pelo administrador. Para encerrar a sessão, use “Sair” no rodapé do menu. Após cinco tentativas inválidas, aguarde 15 minutos.'],
          ['O que cada perfil pode fazer?', 'Administradores gerenciam usuários, trens, rotas e sensores. Técnicos e funcionários consultam esses registros, os sensores com falha e a simulação do circuito.'],
          ['Como cadastrar um trem?', 'Um administrador abre Trens → Novo Trem, informa nome, tipo, status, conjunto e usuário responsável, e salva. O responsável deve existir antes do cadastro.'],
          ['Como cadastrar uma rota ou um sensor?', 'Em Rotas, o administrador vincula ao menos um trem ao trajeto. Em Sensores, seleciona um trem, o tipo de dado, local de instalação, subsistema e status.'],
          ['De onde vêm clima e CEP?', 'A home consulta a Open-Meteo para São Paulo; o horário mostrado é o dos dados recebidos. Consultar CEP usa ViaCEP e preenche os campos de endereço sem salvá-los no banco. Ambas as consultas precisam de internet.'],
          ['O mapa e as falhas são dados em tempo real?', 'O circuito é uma simulação animada. A tela Sensores com falha lista registros cujo status foi marcado como “Com falha”; ela não recebe telemetria nem gera alertas automáticos.'],
        ];
        foreach ($perguntas as $indice => [$pergunta, $resposta]):
        ?>
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button <?= $indice ? 'collapsed' : '' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#ajuda-<?= $indice ?>" aria-expanded="<?= $indice ? 'false' : 'true' ?>" aria-controls="ajuda-<?= $indice ?>">
                <?= escapar($pergunta) ?>
              </button>
            </h2>
            <div id="ajuda-<?= $indice ?>" class="accordion-collapse collapse <?= $indice ? '' : 'show' ?>" data-bs-parent="#ajuda">
              <div class="accordion-body"><?= escapar($resposta) ?></div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
      <p class="text-muted small mt-4">Se uma operação falhar, confira os campos informados. Persistindo o problema, avise a equipe responsável pela estação de demonstração.</p>
    </div>
  </main>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
