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

$stmt = $conn->prepare("INSERT INTO trens (nome, tipo, status, conjunto, id_responsavel) VALUES ('Trem Teste CI', 'Locomotiva', 'Ativo', 'Teste', ?)");
$stmt->bind_param('i', $contas['admin']['id']);
$stmt->execute();
$idTrem = $conn->insert_id;
$stmt->close();

$stmt = $conn->prepare('INSERT INTO sensor (nome, localizacao, tipo_dado, id_trem, tipo, conjunto) VALUES (?, ?, ?, ?, ?, ?)');
foreach ([
    ['Sensor Falha CI', 'Motor', 'Vibração', 'Com falha', 'Motor'],
    ['Sensor Ativo CI', 'Freios', 'Temperatura', 'Ativo', 'Freios'],
] as [$nome, $local, $tipoDado, $status, $conjunto]) {
    $stmt->bind_param('sssiss', $nome, $local, $tipoDado, $idTrem, $status, $conjunto);
    $stmt->execute();
}
$stmt->close();

echo json_encode($contas, JSON_THROW_ON_ERROR), PHP_EOL;
