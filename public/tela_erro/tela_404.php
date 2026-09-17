<?php
/**
 * Página visual de erro. Este arquivo não define o status HTTP 404;
 * essa responsabilidade fica com o servidor ou código que encaminha a requisição.
 */
?>

<!DOCTYPE html>
<html lang="pt-BR">

<!-- Metadados, adaptação da página para dispositivos móveis e estilos. -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GordoSensores — Página não encontrada</title>
    <link rel="icon" href="../../assets/images/logo.ico">
    <!-- Bootstrap: grade responsiva e aparência de tabelas, cards e botões. -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Ícones fornecidos pelas classes bi e bi-*. -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />
    <!-- Estilos próprios, incluindo posicionamento do menu e conteúdo. -->
    <link rel="stylesheet" href="../../styles/style.css">
</head>

<body class="bg-light">

    <div class="container min-vh-100 d-flex align-items-center justify-content-center">
        <div class="text-center">

            <img src="../../assets/images/404.png" class="img-fluid mb-4" style="max-width: 350px;" alt="Erro 404">

            <h1 class="display-1 fw-bold text-warning">404</h1>
            <h4 class="fw-bold mb-2">Página não encontrada</h4>
            <p class="text-muted mb-4">A página que você procura não existe ou foi movida.</p>

<!-- Voltar usa o histórico do navegador; o dashboard oferece um destino explícito. -->
            <div class="d-flex justify-content-center gap-2">
                <button type="button" class="btn btn-outline-secondary" onclick="history.back()">
                    <i class="bi bi-arrow-left me-2"></i>Voltar
                </button>
                <a href="../tela_home/tela_geral_home.php" class="btn btn-warning fw-semibold">
                    <i class="bi bi-speedometer2 me-2"></i>Ir para o Dashboard
                </a>
            </div>

        </div>
    </div>

</body>

</html>
