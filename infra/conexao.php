<?php
/**
 * Conexão MySQL: disponibiliza o objeto $conexao para os scripts que incluírem este arquivo.
 */

// Configuração do servidor local: endereço, usuário, senha e nome do banco.
$host = "localhost";
$usuario = "root";
$senha = "root";
$banco = "sa_ferrorama";

// O construtor mysqli tenta abrir a conexão imediatamente.
$conexao = new mysqli($host, $usuario, $senha, $banco);

// Interrompe a execução quando mysqli informa falha pela propriedade connect_error.
// Conforme a configuração do mysqli, falhas também podem lançar exceções.
if ($conexao->connect_error) {
    die("Erro na conexão com o banco: " . $conexao->connect_error);
};

// UTF-8 completo na comunicação com o banco, incluindo acentos e emojis.
$conexao->set_charset("utf8mb4");
?>