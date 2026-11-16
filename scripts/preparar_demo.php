<?php
// Execute apenas no terminal da estação, depois de importar database/db.sql.
if (PHP_SAPI !== 'cli') {
    http_response_code(403);
    exit('Acesso não permitido.');
}

require __DIR__ . '/../infra/conexao.php';
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

function usuario_demo(mysqli $conn, string $nome, string $email, string $cpf, string $funcao): array
{
    $senha = bin2hex(random_bytes(10));
    $hash = password_hash($senha, PASSWORD_DEFAULT);
    $stmt = $conn->prepare('SELECT id FROM usuarios WHERE email = ?');
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $existente = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    if ($existente) {
        $id = (int) $existente['id'];
        $stmt = $conn->prepare("UPDATE usuarios SET nome = ?, senha = ?, funcao = ?, status = 'ativo' WHERE id = ?");
        $stmt->bind_param('sssi', $nome, $hash, $funcao, $id);
    } else {
        $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha, cpf, funcao, status) VALUES (?, ?, ?, ?, ?, 'ativo')");
        $stmt->bind_param('sssss', $nome, $email, $hash, $cpf, $funcao);
    }
    $stmt->execute();
    if (!$existente) $id = $conn->insert_id;
    $stmt->close();
    return ['id' => $id, 'email' => $email, 'senha' => $senha];
}

function id_por_nome(mysqli $conn, string $tabela, string $coluna, string $nome): ?int
{
    // Os nomes da tabela e coluna são constantes definidas neste arquivo.
    $stmt = $conn->prepare("SELECT {$coluna} AS id FROM {$tabela} WHERE nome = ? LIMIT 1");
    $stmt->bind_param('s', $nome);
    $stmt->execute();
    $linha = $stmt->get_result()->fetch_assoc();
    $stmt->close();
    return $linha ? (int) $linha['id'] : null;
}

try {
    $conn->begin_transaction();
    $admin = usuario_demo($conn, 'Administrador Demonstração', 'demo-admin@ferrorama.invalid', '11144477735', 'adm');
    $operador = usuario_demo($conn, 'Operador Demonstração', 'demo-operador@ferrorama.invalid', '12345678909', 'funcionario');

    $idTrem = id_por_nome($conn, 'trens', 'id_trem', 'Trem Demonstração');
    if ($idTrem === null) {
        $stmt = $conn->prepare("INSERT INTO trens (nome, tipo, status, conjunto, id_responsavel) VALUES ('Trem Demonstração', 'Locomotiva', 'Ativo', 'Conjunto Demo', ?)");
        $stmt->bind_param('i', $admin['id']);
        $stmt->execute();
        $idTrem = $conn->insert_id;
        $stmt->close();
    }

    $idRota = id_por_nome($conn, 'rotas', 'id', 'Rota Demonstração');
    if ($idRota === null) {
        $conn->query("INSERT INTO rotas (nome, distancia, tempo, origem, destino, status) VALUES ('Rota Demonstração', 12.50, '00:25:00', 'Estação A', 'Estação B', 'disponível')");
        $idRota = $conn->insert_id;
    }
    $stmt = $conn->prepare('INSERT IGNORE INTO rota_trens (id_rota, id_trem) VALUES (?, ?)');
    $stmt->bind_param('ii', $idRota, $idTrem);
    $stmt->execute();
    $stmt->close();

    foreach ([
        ['Sensor Motor Demo', 'Motor', 'Temperatura', 'Ativo', 'Motor'],
        ['Sensor Freio Demo', 'Freio', 'Vibração', 'Com falha', 'Freios'],
    ] as [$nome, $local, $tipoDado, $status, $conjunto]) {
        if (id_por_nome($conn, 'sensor', 'id_sensor', $nome) !== null) continue;
        $stmt = $conn->prepare('INSERT INTO sensor (nome, localizacao, tipo_dado, id_trem, tipo, conjunto) VALUES (?, ?, ?, ?, ?, ?)');
        $stmt->bind_param('sssiss', $nome, $local, $tipoDado, $idTrem, $status, $conjunto);
        $stmt->execute();
        $stmt->close();
    }

    $conn->commit();
    echo "Contas fictícias preparadas. Guarde estas senhas fora do repositório; executar novamente cria senhas novas.\n";
    echo "Administrador: {$admin['email']} | {$admin['senha']}\n";
    echo "Operador: {$operador['email']} | {$operador['senha']}\n";
} catch (Throwable $erro) {
    $conn->rollback();
    error_log('Falha ao preparar demonstração: ' . $erro->getMessage());
    fwrite(STDERR, "Não foi possível preparar os dados de demonstração. Confira o banco e a configuração.\n");
    exit(1);
}
