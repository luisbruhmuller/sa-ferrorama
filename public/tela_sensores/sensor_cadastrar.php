<?php
/** Processa o cadastro (Create) e aplica o padrão Post/Redirect/Get. */
require_once __DIR__ . '/sensor_funcoes.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    sensor_redirecionar('tela_cadastro_sensores.php');
}

if (!sensor_csrf_valido($_POST['csrf_token'] ?? null)) {
    sensor_flash('danger', 'Sessão inválida. Recarregue a página e tente novamente.');
    sensor_redirecionar('tela_cadastro_sensores.php');
}

[$dados, $erros] = sensor_validar($_POST);
if (!$erros && !sensor_trem_existe($conexao, $dados['id_trem'])) {
    $erros['id_trem'] = 'Trem não encontrado.';
}
if (!$erros && sensor_nome_existe($conexao, $dados['nome'])) {
    $erros['nome'] = 'Já existe um sensor com este nome ou código.';
}
if ($erros) {
    sensor_guardar_formulario($dados, $erros);
    sensor_redirecionar('tela_cadastro_sensores.php');
}

try {
    $stmt = $conexao->prepare(
        'INSERT INTO sensor (nome, localizacao, tipo_dado, id_trem, tipo, conjunto)
         VALUES (?, ?, ?, ?, ?, ?)'
    );
    $stmt->bind_param(
        'sssiss',
        $dados['nome'],
        $dados['localizacao'],
        $dados['tipo_dado'],
        $dados['id_trem'],
        $dados['tipo'],
        $dados['conjunto']
    );
    $stmt->execute();
    $stmt->close();

    sensor_flash('success', 'Sensor cadastrado com sucesso!');
    sensor_redirecionar('tela_sensores.php');
} catch (mysqli_sql_exception $ex) {
    error_log('Erro ao cadastrar sensor: ' . $ex->getMessage());
    if ($ex->getCode() === 1062) {
        $erros['nome'] = 'Já existe um sensor com este nome ou código.';
    } elseif ($ex->getCode() === 1452) {
        $erros['id_trem'] = 'O trem selecionado não existe mais.';
    }
    sensor_guardar_formulario($dados, $erros);
    sensor_flash('danger', 'Não foi possível cadastrar o sensor. Confira os dados e tente novamente.');
    sensor_redirecionar('tela_cadastro_sensores.php');
}
