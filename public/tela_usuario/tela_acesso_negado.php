<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acesso negado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { min-height: 100vh; background: #f5f6f8; }
        .denied-card { max-width: 960px; border: 0; border-radius: 1.25rem; }
        .denied-image { display: block; width: min(100%, 440px); max-height: 440px; object-fit: contain; margin: 0 auto; }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center p-3">
    <main class="card denied-card shadow-sm w-100">
        <div class="card-body p-4 p-md-5 text-center">
            <img class="denied-image mb-3" src="../assets/acesso-negado.png" alt="Mascote segurando uma placa de acesso negado">
            <h1 class="h3 fw-bold">Acesso negado</h1>
            <p class="text-secondary mb-4">Seu perfil não tem permissão para gerenciar usuários. Se precisar de acesso, fale com um administrador.</p>
            <a class="btn btn-primary px-4" href="../tela_home/tela_geral_home.php">Voltar ao início</a>
        </div>
    </main>
</body>
</html>