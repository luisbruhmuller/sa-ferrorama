<?php
require __DIR__ . '/../infra/conexao.php';

$contas = [];
foreach ([
    ['admin', 'Administrador Demonstração', 'demo-admin@ferrorama.invalid', '11144477735', 'adm'],
    ['operador', 'Operador Demonstração', 'demo-operador@ferrorama.invalid', '12345678909', 'funcionario'],
] as [$chave, $nome, $email, $cpf, $funcao]) {
    $senha = bin2hex(random_bytes(10));
    $hash = password_hash($senha, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha, cpf, funcao, status) VALUES (?, ?, ?, ?, ?, 'ativo')");
    $stmt->bind_param('sssss', $nome, $email, $hash, $cpf, $funcao);
    $stmt->execute();
    $contas[$chave] = ['email' => $email, 'senha' => $senha, 'id' => $conn->insert_id];
    $stmt->close();
}

echo json_encode($contas, JSON_THROW_ON_ERROR), PHP_EOL;
