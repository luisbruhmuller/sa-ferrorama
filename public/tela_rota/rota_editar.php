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

[$dados, $erros] = rota_validar($_POST);
if (!$erros && !rota_trens_existem($conexao, $dados['trens'])) {
    $erros['trens'] = 'Um ou mais trens selecionados não existem.';
}
if ($erros) {
    rota_guardar_formulario($dados, $erros);
    rota_redirecionar('tela_editar_rota.php?id=' . $idRota);
}

try {
    if (rota_buscar($conexao, $idRota) === null) {
        rota_flash('danger', 'Rota não encontrada.');
        rota_redirecionar('tela_rota.php');
    }

    $conexao->begin_transaction();
    $stmt = $conexao->prepare(
        'UPDATE rotas SET nome = ?, distancia = ?, tempo = ?, origem = ?, destino = ?, status = ? WHERE id = ?'
    );
    $stmt->bind_param(
        'sdssssi',
        $dados['nome'],
        $dados['distancia'],
        $dados['tempo'],
        $dados['origem'],
        $dados['destino'],
        $dados['status'],
        $idRota
    );
    $stmt->execute();
    $stmt->close();

    rota_sincronizar_trens($conexao, $idRota, $dados['trens']);
    $conexao->commit();
    rota_flash('success', 'Rota atualizada com sucesso!');
    rota_redirecionar('tela_rota.php');
} catch (mysqli_sql_exception $ex) {
    $conexao->rollback();
    error_log('Erro ao editar rota: ' . $ex->getMessage());
    rota_guardar_formulario($dados, $erros);
    rota_flash('danger', 'Não foi possível atualizar a rota. Verifique os relacionamentos e tente novamente.');
    rota_redirecionar('tela_editar_rota.php?id=' . $idRota);
}
