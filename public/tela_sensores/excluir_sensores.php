<?php
/**
 * Exclui um sensor sem remover suas leituras. Sensores com dados associados são
 * preservados conforme a regra RN05 e a chave estrangeira do banco.
 */
require_once __DIR__ . '/sensor_funcoes.php';
exigir_admin();

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

try {
    if (sensor_buscar($conexao, $idSensor) === null) {
        sensor_flash('danger', 'Sensor não encontrado.');
        sensor_redirecionar('tela_sensores.php');
    }

    if (sensor_total_leituras($conexao, $idSensor) > 0) {
        sensor_flash('warning', 'Não é possível excluir: este sensor possui leituras associadas.');
        sensor_redirecionar('tela_sensores.php');
    }

    $stmt = $conexao->prepare('DELETE FROM sensor WHERE id_sensor = ?');
    $stmt->bind_param('i', $idSensor);
    $stmt->execute();
    $removidos = $stmt->affected_rows;
    $stmt->close();

    sensor_flash(
        $removidos > 0 ? 'success' : 'danger',
        $removidos > 0 ? 'Sensor excluído com sucesso!' : 'Sensor não encontrado.'
    );
} catch (mysqli_sql_exception $ex) {
    if ($ex->getCode() === 1451) {
        sensor_flash('warning', 'Não é possível excluir: este sensor possui dados associados.');
    } else {
        error_log('Erro ao excluir sensor: ' . $ex->getMessage());
        sensor_flash('danger', 'Não foi possível excluir o sensor. Tente novamente.');
    }
}

sensor_redirecionar('tela_sensores.php');
