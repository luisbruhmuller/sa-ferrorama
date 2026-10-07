<?php

if (PHP_SAPI !== 'cli') {
    exit('Execute esta migracao pela linha de comando.');
}

require_once __DIR__ . '/../../infra/criptografia.php';
require_once __DIR__ . '/../../infra/conexao.php';

$conn->query('ALTER TABLE usuarios MODIFY senha VARCHAR(255) NOT NULL');
$conn->begin_transaction();

try {
    $usuarios = $conn->query('SELECT id, senha FROM usuarios FOR UPDATE');
    $atualizar = $conn->prepare('UPDATE usuarios SET senha = ? WHERE id = ?');
    $quantidade = 0;

    while ($usuario = $usuarios->fetch_assoc()) {
        if (password_get_info($usuario['senha'])['algoName'] !== 'unknown') {
            continue;
        }

        $hash = gerar_hash_senha($usuario['senha']);
        $id = (int) $usuario['id'];
        $atualizar->bind_param('si', $hash, $id);
        $atualizar->execute();
        $quantidade++;
    }

    $conn->commit();
    echo "Migracao concluida. Senhas protegidas: {$quantidade}.\n";
} catch (Throwable $erro) {
    $conn->rollback();
    exit("A migracao falhou: {$erro->getMessage()}\n");
}
