<?php
require __DIR__ . '/usuarios_comum.php';
exigir_admin();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirecionar('tela_cadastro_usuarios.php');
}

// Pega os dados do novo usuário.
$nome = trim($_POST['nome'] ?? '');
$email = strtolower(trim($_POST['email'] ?? ''));
$cpf = preg_replace('/\D/', '', $_POST['cpf'] ?? '');
$funcao = $_POST['funcao'] ?? 'funcionario';
$status = $_POST['status'] ?? 'ativo';
$senha = $_POST['senha'] ?? '';
$confirmacao = $_POST['confirmar_senha'] ?? '';

if ($nome === '' || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($cpf) !== 11 || strlen($senha) < 8 || $senha !== $confirmacao) {
    $_SESSION['mensagem'] = ['Preencha os dados corretamente.', 'danger'];
    redirecionar('tela_cadastro_usuarios.php');
}

// Protege a senha antes de salvar.
$hash = password_hash($senha, PASSWORD_DEFAULT);
$comando = mysqli_prepare($conn, 'INSERT INTO usuarios (nome, email, senha, cpf, funcao, status) VALUES (?, ?, ?, ?, ?, ?)');
mysqli_stmt_bind_param($comando, 'ssssss', $nome, $email, $hash, $cpf, $funcao, $status);

if (mysqli_stmt_execute($comando)) {
    $_SESSION['mensagem'] = ['Usuário cadastrado com sucesso.', 'success'];
    redirecionar('tela_usuarios.php');
}

$_SESSION['mensagem'] = [mysqli_errno($conn) === 1062 ? 'Já existe um usuário com esse e-mail ou CPF.' : 'Não foi possível cadastrar o usuário.', 'danger'];
redirecionar('tela_cadastro_usuarios.php');
