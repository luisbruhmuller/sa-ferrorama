<?php
require_once __DIR__ . '/../tela_usuario/usuarios_comum.php';
exigir_admin();
$id = (int) ($_POST['id_rota'] ?? 0);

if ($id > 0 && mysqli_query($conn, "DELETE FROM rotas WHERE id = $id")) {
    $_SESSION['rota_flash'] = ['Rota excluída com sucesso!', 'success'];
} else {
    $_SESSION['rota_flash'] = ['Não foi possível excluir a rota.', 'danger'];
}

redirecionar('tela_rota.php');
