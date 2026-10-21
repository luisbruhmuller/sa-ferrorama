<?php

require_once __DIR__ . '/rota_funcoes.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    rota_redirecionar('tela_cadastro_rota.php');
}

if (!rota_csrf_valido($_POST['csrf_token'] ?? null)) {
    rota_flash('danger', 'Sessão inválida. Recarregue a página e tente novamente.');
    rota_redirecionar('tela_cadastro_rota.php');
}

[$dados, $erros] = rota_validar($_POST);
if (!$erros && !rota_trens_existem($conexao, $dados['trens'])) {
    $erros['trens'] = 'Um ou mais trens selecionados não existem.';
}
if ($erros) {
    rota_guardar_formulario($dados, $erros);
    rota_redirecionar('tela_cadastro_rota.php');
}

try {
    $conexao->begin_transaction();
    $stmt = $conexao->prepare(
        'INSERT INTO rotas (nome, distancia, tempo, origem, destino, status) VALUES (?, ?, ?, ?, ?, ?)'
    );
    $stmt->bind_param(
        'sdssss',
        $dados['nome'],
        $dados['distancia'],
        $dados['tempo'],
        $dados['origem'],
        $dados['destino'],
        $dados['status']
    );
    $stmt->execute();
    $idRota = $conexao->insert_id;
    $stmt->close();

    rota_sincronizar_trens($conexao, $idRota, $dados['trens']);
    $conexao->commit();
    rota_flash('success', 'Rota cadastrada com sucesso!');
    rota_redirecionar('tela_rota.php');
} catch (mysqli_sql_exception $ex) {
    $conexao->rollback();
    error_log('Erro ao cadastrar rota: ' . $ex->getMessage());
    rota_guardar_formulario($dados, $erros);
    rota_flash('danger', 'Não foi possível cadastrar a rota. Verifique os relacionamentos e tente novamente.');
    rota_redirecionar('tela_cadastro_rota.php');
}
