<?php
require_once __DIR__ . '/../tela_usuario/usuarios_comum.php';
exigir_admin();

// Pega os dados atualizados do sensor.
$id = (int) ($_POST['id_sensor'] ?? 0);
$nome = trim($_POST['nome'] ?? '');
$local = trim($_POST['localizacao'] ?? '');
$tipoDado = $_POST['tipo_dado'] ?? '';
$idTrem = (int) ($_POST['id_trem'] ?? 0);
$tipo = $_POST['tipo'] ?? 'Ativo';
$conjunto = $_POST['conjunto'] ?? '';

if ($id < 1 || $nome === '' || $local === '' || $tipoDado === '' || $idTrem < 1 || $conjunto === '') {
    $_SESSION['sensor_flash'] = ['Preencha todos os campos.', 'danger'];
    redirecionar('tela_editar_sensor.php?id=' . $id);
}

// Atualiza o sensor no banco.
$comando = mysqli_prepare($conn, 'UPDATE sensor SET nome=?, localizacao=?, tipo_dado=?, id_trem=?, tipo=?, conjunto=? WHERE id_sensor=?');
mysqli_stmt_bind_param($comando, 'sssissi', $nome, $local, $tipoDado, $idTrem, $tipo, $conjunto, $id);

if (mysqli_stmt_execute($comando)) {
    $_SESSION['sensor_flash'] = ['Sensor atualizado com sucesso!', 'success'];
    redirecionar('tela_sensores.php');
}

$_SESSION['sensor_flash'] = ['Não foi possível atualizar. O nome pode já estar em uso.', 'danger'];
redirecionar('tela_editar_sensor.php?id=' . $id);
