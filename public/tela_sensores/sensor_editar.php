<?php
/** Processa a alteração (Update) de um sensor. */
require_once __DIR__ . '/sensor_funcoes.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    sensor_redirecionar('tela_sensores.php');
}

if (!sensor_csrf_valido($_POST['csrf_token'] ?? null)) {
    sensor_flash('danger', 'Sessão inválida. Recarregue a página e tente novamente.');
    sensor_redirecionar('tela_sensores.php');
}

$idSensor = sensor_id_valido($_POST['id_sensor'] ?? null);
if ($idSensor === null) {
    sensor_flash('danger', 'Sensor inválido.');
    sensor_redirecionar('tela_sensores.php');
}

[$dados, $erros] = sensor_validar($_POST);
if (!$erros && !sensor_trem_existe($conexao, $dados['id_trem'])) {
    $erros['id_trem'] = 'Trem não encontrado.';
}
if (!$erros && sensor_nome_existe($conexao, $dados['nome'], $idSensor)) {
    $erros['nome'] = 'Já existe outro sensor com este nome ou código.';
}
if ($erros) {
    sensor_guardar_formulario($dados, $erros);
    sensor_redirecionar('tela_editar_sensor.php?id=' . $idSensor);
}

try {
    if (sensor_buscar($conexao, $idSensor) === null) {
        sensor_flash('danger', 'Sensor não encontrado.');
        sensor_redirecionar('tela_sensores.php');
    }

    $stmt = $conexao->prepare(
        'UPDATE sensor
         SET nome = ?, localizacao = ?, tipo_dado = ?, id_trem = ?, tipo = ?, conjunto = ?
         WHERE id_sensor = ?'
    );
    $stmt->bind_param(
        'sssissi',
        $dados['nome'],
        $dados['localizacao'],
        $dados['tipo_dado'],
        $dados['id_trem'],
        $dados['tipo'],
        $dados['conjunto'],
        $idSensor
    );
    $stmt->execute();
    $stmt->close();

    sensor_flash('success', 'Sensor atualizado com sucesso!');
    sensor_redirecionar('tela_sensores.php');
} catch (mysqli_sql_exception $ex) {
    error_log('Erro ao editar sensor: ' . $ex->getMessage());
    if ($ex->getCode() === 1062) {
        $erros['nome'] = 'Já existe outro sensor com este nome ou código.';
    } elseif ($ex->getCode() === 1452) {
        $erros['id_trem'] = 'O trem selecionado não existe mais.';
    }
    sensor_guardar_formulario($dados, $erros);
    sensor_flash('danger', 'Não foi possível atualizar o sensor. Confira os dados e tente novamente.');
    sensor_redirecionar('tela_editar_sensor.php?id=' . $idSensor);
}
