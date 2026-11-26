<?php
require_once __DIR__ . '/../tela_usuario/usuarios_comum.php';
exigir_admin();

$nome = trim($_POST['nome'] ?? '');
$tipo = $_POST['tipo'] ?? '';
$status = $_POST['status'] ?? '';
$conjunto = trim($_POST['conjunto'] ?? '');
$responsavel = (int) ($_POST['id_responsavel'] ?? 0);

if ($nome === '' || $tipo === '' || $status === '' || $conjunto === '' || $responsavel < 1) {
    $_SESSION['trem_flash'] = ['Preencha todos os campos.', 'danger'];
    redirecionar('tela_cadastro_trem.php');
}

$comando = mysqli_prepare($conn, 'INSERT INTO trens (nome, tipo, status, conjunto, id_responsavel) VALUES (?, ?, ?, ?, ?)');
mysqli_stmt_bind_param($comando, 'ssssi', $nome, $tipo, $status, $conjunto, $responsavel);

if (mysqli_stmt_execute($comando)) {
    $_SESSION['trem_flash'] = ['Trem cadastrado com sucesso!', 'success'];
    redirecionar('tela_trem.php');
}

$_SESSION['trem_flash'] = ['Não foi possível cadastrar o trem.', 'danger'];
redirecionar('tela_cadastro_trem.php');
