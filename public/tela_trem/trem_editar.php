<?php
require_once __DIR__ . '/../tela_usuario/usuarios_comum.php';
exigir_admin();

// Pega os dados atualizados do trem.
$id = (int) ($_POST['id_trem'] ?? 0);
$nome = trim($_POST['nome'] ?? '');
$tipo = $_POST['tipo'] ?? '';
$status = $_POST['status'] ?? '';
$conjunto = trim($_POST['conjunto'] ?? '');
$responsavel = (int) ($_POST['id_responsavel'] ?? 0);

if ($id < 1 || $nome === '' || $tipo === '' || $status === '' || $conjunto === '' || $responsavel < 1) {
    $_SESSION['trem_flash'] = ['Preencha todos os campos.', 'danger'];
    redirecionar('tela_editar_trem.php?id=' . $id);
}

// Atualiza o trem no banco.
$comando = mysqli_prepare($conn, 'UPDATE trens SET nome=?, tipo=?, status=?, conjunto=?, id_responsavel=? WHERE id_trem=?');
mysqli_stmt_bind_param($comando, 'ssssii', $nome, $tipo, $status, $conjunto, $responsavel, $id);

if (mysqli_stmt_execute($comando)) {
    $_SESSION['trem_flash'] = ['Trem atualizado com sucesso!', 'success'];
    redirecionar('tela_trem.php');
}

$_SESSION['trem_flash'] = ['Não foi possível atualizar o trem.', 'danger'];
redirecionar('tela_editar_trem.php?id=' . $id);
