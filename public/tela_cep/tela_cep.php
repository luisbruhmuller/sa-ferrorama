<?php
require_once __DIR__ . '/../tela_usuario/usuarios_comum.php';
exigir_login();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ferrorama — Consultar CEP</title>
  <link rel="icon" href="../../assets/images/logo.ico">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../../styles/style.css">
</head>
<body class="app-layout bg-light">
  <?php require __DIR__ . '/../templates/sidebar.php'; ?>
  <main id="conteudo" class="app-main cep-page">
    <div class="container-fluid px-3 px-lg-5 py-4 py-lg-5">
      <a class="text-decoration-none small" href="../tela_home/tela_geral_home.php"><i class="bi bi-arrow-left me-1"></i>Voltar ao início</a>
      <header class="mt-4 mb-4">
        <p class="text-uppercase fw-semibold text-primary small mb-1">Consulta de endereço</p>
        <h1 class="display-6 fw-bold">Encontre um CEP</h1>
        <p class="text-muted mb-0">Digite um CEP brasileiro para preencher os dados disponíveis no ViaCEP.</p>
      </header>
      <div class="row g-4">
        <div class="col-lg-5">
          <div class="card shadow-sm border-0">
            <div class="card-body p-4">
              <!-- Formulário para pesquisar o CEP. -->
              <form id="consulta-cep" novalidate>
                <label class="form-label fw-semibold" for="cep-busca">CEP</label>
                <div class="input-group">
                  <input class="form-control" id="cep-busca" name="cep-busca" inputmode="numeric" autocomplete="postal-code" maxlength="9" placeholder="00000-000" required>
                  <button class="btn btn-warning" type="submit">Consultar</button>
                </div>
                <div class="form-text">Informe 8 dígitos, com ou sem hífen.</div>
              </form>
              <div id="cep-mensagem" class="alert alert-secondary mt-4 mb-0" role="status" aria-live="polite">Aguardando consulta.</div>
            </div>
          </div>
        </div>
        <div class="col-lg-7">
          <div class="card shadow-sm border-0">
            <div class="card-body p-4">
              <h2 class="h5 fw-bold mb-3">Dados do endereço</h2>
              <div class="row g-3">
                <div class="col-sm-4"><label class="form-label" for="endereco-cep">CEP</label><input class="form-control" id="endereco-cep" readonly></div>
                <div class="col-sm-8"><label class="form-label" for="endereco-logradouro">Logradouro</label><input class="form-control" id="endereco-logradouro" readonly></div>
                <div class="col-sm-6"><label class="form-label" for="endereco-bairro">Bairro</label><input class="form-control" id="endereco-bairro" readonly></div>
                <div class="col-sm-4"><label class="form-label" for="endereco-cidade">Cidade</label><input class="form-control" id="endereco-cidade" readonly></div>
                <div class="col-sm-2"><label class="form-label" for="endereco-uf">UF</label><input class="form-control" id="endereco-uf" readonly></div>
              </div>
              <p class="text-muted small mt-3 mb-0">Alguns CEPs abrangem uma cidade inteira; nesses casos, logradouro e bairro podem vir vazios. Os dados são somente para consulta.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <script src="../../script/cep.js" defer></script>
</body>
</html>
