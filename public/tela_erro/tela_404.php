<?php
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GordoSensores — Página não encontrada</title>
    <link rel="icon" href="../../assets/images/logo.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../../styles/style.css">
</head>

<body class="bg-light">

    <div class="container min-vh-100 d-flex align-items-center justify-content-center">
        <div class="text-center">

            <img src="../../assets/images/404.png" class="img-fluid mb-4" style="max-width: 350px;" alt="Erro 404">

            <h1 class="display-1 fw-bold text-warning">404</h1>
            <h4 class="fw-bold mb-2">Página não encontrada</h4>
            <p class="text-muted mb-4">A página que você procura não existe ou foi movida.</p>

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
