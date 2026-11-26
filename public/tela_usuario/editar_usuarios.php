<?php
require __DIR__ . '/usuarios_comum.php';
$administrador = exigir_admin();

$id = (int) ($_GET['id'] ?? 0);
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || $id < 1) {
    redirecionar('tela_usuarios.php');
}

$nome = trim($_POST['nome'] ?? '');
$email = strtolower(trim($_POST['email'] ?? ''));
$cpf = preg_replace('/\D/', '', $_POST['cpf'] ?? '');
$funcao = $_POST['funcao'] ?? 'funcionario';
$status = $_POST['status'] ?? 'ativo';
$senha = $_POST['senha'] ?? '';
$confirmacao = $_POST['confirmar_senha'] ?? '';

if ($id === (int) $administrador['id'] && ($funcao !== 'adm' || $status !== 'ativo')) {
    $_SESSION['mensagem'] = ['Você não pode remover seu próprio acesso de administrador.', 'danger'];
    redirecionar('tela_cadastro_usuarios.php?id=' . $id);
}

if ($nome === '' || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($cpf) !== 11 || ($senha !== '' && (strlen($senha) < 8 || $senha !== $confirmacao))) {
    $_SESSION['mensagem'] = ['Preencha os dados corretamente.', 'danger'];
    redirecionar('tela_cadastro_usuarios.php?id=' . $id);
}

if ($senha !== '') {
    $hash = password_hash($senha, PASSWORD_DEFAULT);
    $comando = mysqli_prepare($conn, 'UPDATE usuarios SET nome=?, email=?, cpf=?, funcao=?, status=?, senha=? WHERE id=?');
    mysqli_stmt_bind_param($comando, 'ssssssi', $nome, $email, $cpf, $funcao, $status, $hash, $id);
} else {
    $comando = mysqli_prepare($conn, 'UPDATE usuarios SET nome=?, email=?, cpf=?, funcao=?, status=? WHERE id=?');
    mysqli_stmt_bind_param($comando, 'sssssi', $nome, $email, $cpf, $funcao, $status, $id);
}

if (mysqli_stmt_execute($comando)) {
    $_SESSION['mensagem'] = ['Usuário atualizado com sucesso.', 'success'];
    redirecionar('tela_usuarios.php');
}

$_SESSION['mensagem'] = [mysqli_errno($conn) === 1062 ? 'Já existe um usuário com esse e-mail ou CPF.' : 'Não foi possível atualizar o usuário.', 'danger'];
redirecionar('tela_cadastro_usuarios.php?id=' . $id);
