<?php
require __DIR__ . '/usuarios_comum.php';
$administrador = exigir_admin();
$id = id_usuario($_GET['id'] ?? null);
buscar_usuario($id);
validar_post();
    if ($id === (int) $administrador['id']) {
        mensagem('Você não pode excluir sua própria conta.', 'danger');
    } else {
        try {
            consulta('DELETE FROM usuarios WHERE id = ?', 'i', [$id]);
            mensagem('Usuário excluído com sucesso.');
        } catch (mysqli_sql_exception $e) {
            error_log($e->getMessage());
            mensagem($e->getCode() === 1451 ? 'Este usuário possui registros vinculados e não pode ser excluído. Você pode inativá-lo na edição.' : 'Não foi possível excluir o usuário. Tente novamente.', 'danger');
        }
    }
    redirecionar('tela_usuarios.php');
