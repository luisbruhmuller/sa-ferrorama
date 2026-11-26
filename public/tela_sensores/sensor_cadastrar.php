<?php
require_once __DIR__ . '/../tela_usuario/usuarios_comum.php';
exigir_admin();

$nome = trim($_POST['nome'] ?? '');
$local = trim($_POST['localizacao'] ?? '');
$tipoDado = $_POST['tipo_dado'] ?? '';
$idTrem = (int) ($_POST['id_trem'] ?? 0);
$tipo = $_POST['tipo'] ?? 'Ativo';
$conjunto = $_POST['conjunto'] ?? '';

if ($nome === '' || $local === '' || $tipoDado === '' || $idTrem < 1 || $conjunto === '') {
    $_SESSION['sensor_flash'] = ['Preencha todos os campos.', 'danger'];
    redirecionar('tela_cadastro_sensores.php');
}

$comando = mysqli_prepare($conn, 'INSERT INTO sensor (nome, localizacao, tipo_dado, id_trem, tipo, conjunto) VALUES (?, ?, ?, ?, ?, ?)');
mysqli_stmt_bind_param($comando, 'sssiss', $nome, $local, $tipoDado, $idTrem, $tipo, $conjunto);

if (mysqli_stmt_execute($comando)) {
    $_SESSION['sensor_flash'] = ['Sensor cadastrado com sucesso!', 'success'];
    redirecionar('tela_sensores.php');
}

$_SESSION['sensor_flash'] = ['Não foi possível cadastrar. O nome pode já estar em uso.', 'danger'];
redirecionar('tela_cadastro_sensores.php');
