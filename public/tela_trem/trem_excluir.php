<?php
/**
 * Processa a exclusão de trem (Delete). Só aceita POST: excluir por link (GET) permitiria
 * que qualquer página externa apagasse registros apenas fazendo o usuário clicar em um endereço.
 */
require_once __DIR__ . '/trem_funcoes.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    trem_redirecionar('tela_trem.php');
}

if (!trem_csrf_valido($_POST['csrf_token'] ?? null)) {
    trem_flash('danger', 'Sessão inválida. Recarregue a página e tente novamente.');
    trem_redirecionar('tela_trem.php');
}

$idTrem = trem_id_valido($_POST['id_trem'] ?? null);
if ($idTrem === null) {
    trem_flash('danger', 'Trem inválido.');
    trem_redirecionar('tela_trem.php');
}

try {
    $stmt = $conexao->prepare('DELETE FROM trem WHERE id_trem = ?');
    $stmt->bind_param('i', $idTrem);
    $stmt->execute();
    $removidos = $stmt->affected_rows;
    $stmt->close();

    if ($removidos > 0) {
        trem_flash('success', 'Trem excluído com sucesso!');
    } else {
        trem_flash('danger', 'Trem não encontrado.');
    }
} catch (mysqli_sql_exception $ex) {
    // Erro 1451: o trem ainda é referenciado por sensores ou rotas (chave estrangeira).
    if ($ex->getCode() === 1451) {
        trem_flash('warning', 'Não é possível excluir: este trem possui sensores ou rotas vinculados.');
    } else {
        error_log('Erro ao excluir trem: ' . $ex->getMessage());
        trem_flash('danger', 'Não foi possível excluir o trem. Tente novamente.');
    }
}

trem_redirecionar('tela_trem.php');
