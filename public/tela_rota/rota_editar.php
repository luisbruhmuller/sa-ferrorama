<?php
require_once __DIR__ . '/../tela_usuario/usuarios_comum.php';
exigir_admin();

// Pega os novos dados da rota.
$idRota = (int) ($_POST['id_rota'] ?? 0);
$nome = trim($_POST['nome'] ?? '');
$origem = trim($_POST['origem'] ?? '');
$destino = trim($_POST['destino'] ?? '');
$distancia = (float) ($_POST['distancia'] ?? 0);
$tempo = $_POST['tempo'] ?? '';
$status = $_POST['status'] ?? 'disponível';
$trens = $_POST['trens'] ?? [];

if ($idRota < 1 || $nome === '' || $origem === '' || $destino === '' || $distancia <= 0 || $tempo === '' || !$trens) {
    $_SESSION['rota_flash'] = ['Preencha todos os campos e selecione um trem.', 'danger'];
    redirecionar('tela_editar_rota.php?id=' . $idRota);
}

// Atualiza tudo na mesma transação.
mysqli_begin_transaction($conn);
$comando = mysqli_prepare($conn, 'UPDATE rotas SET nome=?, distancia=?, tempo=?, origem=?, destino=?, status=? WHERE id=?');
$ok = $comando !== false;

if ($ok) {
    mysqli_stmt_bind_param($comando, 'sdssssi', $nome, $distancia, $tempo, $origem, $destino, $status, $idRota);
    $ok = mysqli_stmt_execute($comando);
}

if ($ok) {
    $ok = mysqli_query($conn, "DELETE FROM rota_trens WHERE id_rota = $idRota") !== false;
}

if ($ok) {
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
    $_SESSION['rota_flash'] = ['Rota atualizada com sucesso!', 'success'];
    redirecionar('tela_rota.php');
}

mysqli_rollback($conn);
$_SESSION['rota_flash'] = ['Não foi possível atualizar a rota.', 'danger'];
redirecionar('tela_editar_rota.php?id=' . $idRota);
