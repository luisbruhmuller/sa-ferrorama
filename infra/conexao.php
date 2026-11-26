<?php

mysqli_report(MYSQLI_REPORT_OFF);

// Procura as configurações locais.
$config = file_exists(__DIR__ . '/config.local.php')
    ? require __DIR__ . '/config.local.php'
    : [];

$host = getenv('FERRORAMA_DB_HOST') ?: ($config['host'] ?? 'localhost');
$usuario = getenv('FERRORAMA_DB_USER') ?: ($config['user'] ?? 'root');
$senha = getenv('FERRORAMA_DB_PASSWORD');
$senha = $senha !== false ? $senha : ($config['password'] ?? '');
$banco = getenv('FERRORAMA_DB_NAME') ?: ($config['database'] ?? 'sa_ferrorama');
$porta = (int) (getenv('FERRORAMA_DB_PORT') ?: ($config['port'] ?? 3306));

// Abre a conexão com o banco.
$conn = mysqli_connect($host, $usuario, $senha, $banco, $porta);

if (!$conn) {
    die('Erro ao conectar com o banco de dados.');
}

mysqli_set_charset($conn, 'utf8mb4');
