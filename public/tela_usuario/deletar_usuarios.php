<?php
require __DIR__ . '/usuarios_comum.php';
$administrador = exigir_admin();
$id = (int) ($_GET['id'] ?? 0);

// Impede pedidos inválidos e a autoexclusão.
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirecionar('tela_usuarios.php');
} elseif ($id === (int) $administrador['id']) {
    $_SESSION['mensagem'] = ['Você não pode excluir sua própria conta.', 'danger'];
} elseif (mysqli_query($conn, "DELETE FROM usuarios WHERE id = $id")) {
    $_SESSION['mensagem'] = ['Usuário excluído com sucesso.', 'success'];
} else {
    $_SESSION['mensagem'] = ['Este usuário possui registros vinculados e não pode ser excluído.', 'danger'];
}

redirecionar('tela_usuarios.php');
