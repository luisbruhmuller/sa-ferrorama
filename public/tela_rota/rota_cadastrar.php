<?php
require_once __DIR__ . '/../tela_usuario/usuarios_comum.php';
exigir_admin();

$nome = trim($_POST['nome'] ?? '');
$origem = trim($_POST['origem'] ?? '');
$destino = trim($_POST['destino'] ?? '');
$distancia = (float) ($_POST['distancia'] ?? 0);
$tempo = $_POST['tempo'] ?? '';
$status = $_POST['status'] ?? 'disponível';
$trens = $_POST['trens'] ?? [];

if ($nome === '' || $origem === '' || $destino === '' || $distancia <= 0 || $tempo === '' || !$trens) {
    $_SESSION['rota_flash'] = ['Preencha todos os campos e selecione um trem.', 'danger'];
    redirecionar('tela_cadastro_rota.php');
}

mysqli_begin_transaction($conn);
$comando = mysqli_prepare($conn, 'INSERT INTO rotas (nome, distancia, tempo, origem, destino, status) VALUES (?, ?, ?, ?, ?, ?)');
$ok = $comando !== false;

if ($ok) {
    mysqli_stmt_bind_param($comando, 'sdssss', $nome, $distancia, $tempo, $origem, $destino, $status);
    $ok = mysqli_stmt_execute($comando);
}

if ($ok) {
    $idRota = mysqli_insert_id($conn);
    $vinculo = mysqli_prepare($conn, 'INSERT INTO rota_trens (id_rota, id_trem) VALUES (?, ?)');
    $ok = $vinculo !== false;

    foreach ($trens as $idTrem) {
        $idTrem = (int) $idTrem;
        if (!$ok || $idTrem < 1) {
            $ok = false;
            break;
        }
        mysqli_stmt_bind_param($vinculo, 'ii', $idRota, $idTrem);
        $ok = mysqli_stmt_execute($vinculo);
    }
}

if ($ok) {
    mysqli_commit($conn);
    $_SESSION['rota_flash'] = ['Rota cadastrada com sucesso!', 'success'];
    redirecionar('tela_rota.php');
}

mysqli_rollback($conn);
$_SESSION['rota_flash'] = ['Não foi possível cadastrar a rota.', 'danger'];
redirecionar('tela_cadastro_rota.php');
