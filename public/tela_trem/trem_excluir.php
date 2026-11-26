<?php
require_once __DIR__ . '/../tela_usuario/usuarios_comum.php';
exigir_admin();

$id = (int) ($_POST['id_trem'] ?? 0);

// Tenta excluir o trem escolhido.
if ($id > 0 && mysqli_query($conn, "DELETE FROM trens WHERE id_trem = $id")) {
    $_SESSION['trem_flash'] = ['Trem excluído com sucesso!', 'success'];
} else {
    $_SESSION['trem_flash'] = ['Não é possível excluir: este trem possui sensores ou rotas vinculados.', 'warning'];
}

redirecionar('tela_trem.php');
