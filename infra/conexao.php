<?php

$host = "localhost";
$usuario = "root";
$senha = "root";
$banco = "sa_ferrorama";

$conn = new mysqli($host,$usuario,$senha,$banco);

if ($conn->connect_error) {
    die("Erro ao conectar ao banco de dados: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");

?>