<?php

$arquivoLocal = __DIR__ . '/config.local.php';
$config = is_file($arquivoLocal) ? require $arquivoLocal : [];
$host = getenv('FERRORAMA_DB_HOST') ?: ($config['host'] ?? 'localhost');
$usuario = getenv('FERRORAMA_DB_USER') ?: ($config['user'] ?? 'root');
$senhaAmbiente = getenv('FERRORAMA_DB_PASSWORD');
$senha = $senhaAmbiente !== false ? $senhaAmbiente : ($config['password'] ?? '');
$banco = getenv('FERRORAMA_DB_NAME') ?: ($config['database'] ?? 'sa_ferrorama');
$porta = (int) (getenv('FERRORAMA_DB_PORT') ?: ($config['port'] ?? 3306));

$conn = new mysqli($host, $usuario, $senha, $banco, $porta);

if ($conn->connect_error) {
    throw new RuntimeException('Não foi possível conectar ao banco de dados.');
}

$conn->set_charset("utf8mb4");

?>
