<?php
require_once __DIR__ . '/usuarios_comum.php';
exigir_admin();
// O mesmo formulário serve para cadastrar e editar.
if (!isset($dados)) {
    $edicao = isset($_GET['id']);
    $id = $edicao ? id_usuario($_GET['id']) : 0;
    $dados = $edicao ? buscar_usuario($id) : ['nome' => '', 'email' => '', 'cpf' => '', 'funcao' => 'funcionario', 'status' => 'ativo'];
    $erros = [];
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GordoSensores — Cadastro de usuário</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet"/>

  <link rel="stylesheet" href="../../styles/style.css">
</head>

<body class="app-layout bg-light">

<?php require __DIR__ . '/../templates/sidebar.php'; ?>

<main id="conteudo" class="app-main">
<div class="cadastro-page">
    <div class="cadastro-content">

            <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
                <div class="container-fluid">
                    <span class="navbar-brand fw-bold"><img src="../../assets/images/logo.ico" class="brand-logo me-2" alt="Gordo Holding">GordoSensores</span>

                </div>
            </nav>

            <div class="container-fluid py-4 px-3">

                <section id="screen-login" class="mb-5">

                    <div class="container-fluid py-4 px-3">

                        <div class="row justify-content-center">
                            <div class="col-md-5 col-lg-4">
                                <div class="card shadow">
                                    <div class="card-body p-4 d-inline" id="conteiner-cadastro">
                                        <div class="text-center mb-4">
                                            <img src="../../assets/images/logo.ico" class="brand-logo brand-logo-form" alt="Gordo Holding">
                                            <h4 class="fw-bold mt-2">GordoSensores</h4>
                                            <p class="text-muted small"><?= $edicao ? 'Editar usuário' : 'Cadastrar novo usuário' ?></p>
                                        </div>

                                        <?php if ($erros): ?><div class="alert alert-danger" role="alert"><ul class="mb-0"><?php foreach ($erros as $erro): ?><li><?= escapar($erro) ?></li><?php endforeach; ?></ul></div><?php endif; ?>
<form method="post" action="<?= $edicao ? 'editar_usuarios.php?id=' . (int) $id : 'criar_usuarios.php' ?>">
<?= token() ?>
<div class="mb-3"><label class="form-label" for="nome">Nome completo</label><input class="form-control" id="nome" name="nome" maxlength="200" required value="<?= escapar($dados['nome']) ?>" autocomplete="name"></div>
<div class="mb-3"><label class="form-label" for="email">E-mail</label><input class="form-control" type="email" id="email" name="email" maxlength="200" required value="<?= escapar($dados['email']) ?>" autocomplete="email"></div>
<div class="mb-3"><label class="form-label" for="cpf">CPF</label><input class="form-control" id="cpf" name="cpf" maxlength="14" required value="<?= escapar($dados['cpf']) ?>" inputmode="numeric" placeholder="000.000.000-00"></div>
<div class="row"><div class="col-sm-6 mb-3"><label class="form-label" for="funcao">Cargo</label><select class="form-select" id="funcao" name="funcao" required>
<?php foreach (['adm' => 'Administrador', 'funcionario' => 'Funcionário', 'cliente' => 'Cliente'] as $valor => $rotulo): ?><option value="<?= $valor ?>" <?= $dados['funcao'] === $valor ? 'selected' : '' ?>><?= $rotulo ?></option><?php endforeach; ?></select></div>
<div class="col-sm-6 mb-3"><label class="form-label" for="status">Status</label><select class="form-select" id="status" name="status" required><?php foreach (['ativo' => 'Ativo', 'inativo' => 'Inativo', 'pendente' => 'Pendente'] as $valor => $rotulo): ?><option value="<?= $valor ?>" <?= $dados['status'] === $valor ? 'selected' : '' ?>><?= $rotulo ?></option><?php endforeach; ?></select></div></div>
<?php if ($edicao): ?><p class="text-muted">Deixe os campos de senha vazios para manter a senha atual.</p><?php endif; ?>
<div class="mb-3"><label class="form-label" for="senha">Senha</label><input class="form-control" type="password" id="senha" name="senha" minlength="8" maxlength="72" autocomplete="new-password" <?= !$edicao ? 'required' : '' ?>><div class="form-text">Mínimo de 8 caracteres; limite de 72 bytes.</div></div>
<div class="mb-3"><label class="form-label" for="confirmar_senha">Confirmar senha</label><input class="form-control" type="password" id="confirmar_senha" name="confirmar_senha" minlength="8" maxlength="72" autocomplete="new-password" <?= !$edicao ? 'required' : '' ?>></div>
<div class="d-flex gap-2"><button class="btn btn-warning" type="submit">Salvar usuário</button><a class="btn btn-secondary" href="tela_usuarios.php">Cancelar</a></div>
</form>

                                    </div>
                                </div>
                                <br>
                                <div class="text-center">
                                </div>
                            </div>
                        </div>
                </div>
</section>

            </div>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        </div>
    </div>
</main>

</body>
</html>
