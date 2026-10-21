<?php

require_once __DIR__ . '/rota_funcoes.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    rota_redirecionar('tela_rota.php');
}

if (!rota_csrf_valido($_POST['csrf_token'] ?? null)) {
    rota_flash('danger', 'Sessão inválida. Recarregue a página e tente novamente.');
    rota_redirecionar('tela_rota.php');
}

$idRota = rota_id_valido($_POST['id_rota'] ?? null);
if ($idRota === null) {
    rota_flash('danger', 'Rota inválida.');
    rota_redirecionar('tela_rota.php');
}

try {
    $stmt = $conexao->prepare('DELETE FROM rotas WHERE id = ?');
    $stmt->bind_param('i', $idRota);
    $stmt->execute();
    $removidos = $stmt->affected_rows;
    $stmt->close();

    if ($removidos > 0) {
        rota_flash('success', 'Rota e suas associações foram excluídas com sucesso!');
    } else {
        rota_flash('danger', 'Rota não encontrada.');
    }
} catch (mysqli_sql_exception $ex) {
    error_log('Erro ao excluir rota: ' . $ex->getMessage());
    rota_flash('danger', 'Não foi possível excluir a rota. Tente novamente.');
}

rota_redirecionar('tela_rota.php');
