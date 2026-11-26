<?php
require_once __DIR__ . '/../tela_usuario/usuarios_comum.php';
exigir_admin();

$id = (int) ($_POST['id_sensor'] ?? 0);

if ($id > 0 && mysqli_query($conn, "DELETE FROM sensor WHERE id_sensor = $id")) {
    $_SESSION['sensor_flash'] = ['Sensor excluído com sucesso!', 'success'];
} else {
    $_SESSION['sensor_flash'] = ['Não é possível excluir: este sensor possui leituras associadas.', 'warning'];
}

redirecionar('tela_sensores.php');
