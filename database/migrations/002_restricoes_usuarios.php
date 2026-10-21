<?php

if (PHP_SAPI !== 'cli') {
    exit('Execute esta migracao pela linha de comando.');
}

require_once __DIR__ . '/../../infra/conexao.php';

function valor_duplicado(mysqli $conn, string $expressao): ?string
{
    $resultado = $conn->query(
        "SELECT {$expressao} AS valor, COUNT(*) AS quantidade
         FROM usuarios
         GROUP BY {$expressao}
         HAVING COUNT(*) > 1
         LIMIT 1"
    );
    $duplicado = $resultado->fetch_assoc();

    return $duplicado ? (string) $duplicado['valor'] : null;
}

$cpfNormalizado = "REPLACE(REPLACE(REPLACE(REPLACE(cpf, '.', ''), '-', ''), ' ', ''), '/', '')";
$registroInvalido = $conn->query(
    "SELECT id
     FROM usuarios
     WHERE nome IS NULL OR TRIM(nome) = ''
        OR email IS NULL OR TRIM(email) = ''
        OR cpf IS NULL OR CHAR_LENGTH({$cpfNormalizado}) <> 11
        OR {$cpfNormalizado} REGEXP '[^0-9]'
        OR funcao IS NULL
        OR status IS NULL
     LIMIT 1"
)->fetch_assoc();

if ($registroInvalido) {
    exit("A migracao foi cancelada: corrija os dados obrigatorios do usuario {$registroInvalido['id']}.\n");
}

$emailDuplicado = valor_duplicado($conn, 'LOWER(TRIM(email))');
if ($emailDuplicado !== null) {
    exit("A migracao foi cancelada: o e-mail {$emailDuplicado} esta duplicado.\n");
}

$cpfDuplicado = valor_duplicado($conn, $cpfNormalizado);
if ($cpfDuplicado !== null) {
    exit("A migracao foi cancelada: o CPF {$cpfDuplicado} esta duplicado.\n");
}

$conn->begin_transaction();
try {
    $conn->query(
        "UPDATE usuarios
         SET email = LOWER(TRIM(email)),
             cpf = {$cpfNormalizado}"
    );
    $conn->commit();
} catch (Throwable $erro) {
    $conn->rollback();
    exit("A normalizacao dos usuarios falhou: {$erro->getMessage()}\n");
}

try {
    $conn->query(
        "ALTER TABLE usuarios
         MODIFY cpf CHAR(11) NOT NULL,
         MODIFY funcao ENUM('adm', 'tecnico', 'funcionario') NOT NULL,
         MODIFY status ENUM('ativo', 'inativo', 'pendente') NOT NULL,
         ADD UNIQUE KEY uq_usuarios_email (email),
         ADD UNIQUE KEY uq_usuarios_cpf (cpf)"
    );
    echo "Migracao concluida. E-mail e CPF agora sao unicos.\n";
} catch (Throwable $erro) {
    exit("A criacao das restricoes falhou: {$erro->getMessage()}\n");
}
