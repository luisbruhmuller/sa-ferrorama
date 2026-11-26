<?php
require __DIR__ . '/usuarios_comum.php';
$erro = '';
$email = '';

// Confere os dados enviados no login.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (($_SESSION['login_bloqueado_ate'] ?? 0) > time()) {
        $erro = 'Muitas tentativas inválidas. Aguarde 15 minutos para tentar novamente.';
    } else {
        if (isset($_SESSION['login_bloqueado_ate'])) {
            unset($_SESSION['login_bloqueado_ate'], $_SESSION['login_tentativas']);
        }
        $email = strtolower(trim($_POST['email'] ?? ''));
        $senha = $_POST['senha'] ?? '';

        $comando = mysqli_prepare($conn, 'SELECT id, senha, funcao, status FROM usuarios WHERE email = ?');
        mysqli_stmt_bind_param($comando, 's', $email);
        mysqli_stmt_execute($comando);
        $usuario = mysqli_fetch_assoc(mysqli_stmt_get_result($comando));

        if ($usuario && $usuario['status'] === 'ativo' && password_verify($senha, $usuario['senha'])) {
            session_regenerate_id(true);
            $_SESSION['usuario_id'] = (int) $usuario['id'];
            unset($_SESSION['login_tentativas'], $_SESSION['login_bloqueado_ate']);
            redirecionar($usuario['funcao'] === 'adm' ? 'tela_usuarios.php' : '../tela_home/tela_geral_home.php');
        }

        $_SESSION['login_tentativas'] = ($_SESSION['login_tentativas'] ?? 0) + 1;
        if ($_SESSION['login_tentativas'] >= 5) {
            $_SESSION['login_bloqueado_ate'] = time() + 900;
        }
        $erro = 'E-mail ou senha inválidos, ou usuário não está ativo.';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ferrorama — Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="../../styles/style.css">
</head>

<body class="bg-light">

<main id="conteudo" class="app-main">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container-fluid">
            <span class="navbar-brand fw-bold"><img src="../../assets/images/logo.ico" class="brand-logo me-2" alt="">Ferrorama</span>
            <a class="btn btn-outline-light btn-sm" href="../tela_landing/tela_landing.php"><i class="bi bi-arrow-left me-1"></i>Início</a>

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
                                    <img src="../../assets/images/logo.ico" class="brand-logo brand-logo-form" alt="">
                                    <h4 class="fw-bold mt-2">Ferrorama</h4>
                                    <p class="text-muted small">Sistema de Monitoramento Ferroviário</p>
                                </div>

                                <!-- Formulário de entrada. -->
                                <form method="post" action="tela_login.php">
<div class="mb-3">
                                    <label for="login-login" class="form-label fw-semibold">E-mail ou usuário</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                        <input type="text" class="form-control" placeholder="usuario@empresa.com"
                                            id="login-login" name="email" maxlength="200" autocomplete="username" value="<?= escapar($email) ?>" required />
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="login-senha" class="form-label fw-semibold">Senha</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                        <input type="password" class="form-control" placeholder="••••••••"
                                            id="login-senha" name="senha" autocomplete="current-password" required />

                                    </div>
                                </div>

                                <button id="enviar_login" class="btn btn-warning w-100 fw-semibold" type="submit">
                                    <i class="bi bi-box-arrow-in-right me-2"></i>
                                    Entrar
                                </button>

                                </form><?php if ($erro): ?><div id="alert-erro" class="alert alert-danger mt-3" role="alert"><?= escapar($erro) ?></div><?php endif; ?><hr />
                            </div>
                        </div>

                    </div>
                </div>
        </div>
</section>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</main>

</body>

</html>
