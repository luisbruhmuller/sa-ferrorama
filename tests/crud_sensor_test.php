<?php
/** Teste de integração isolado: cria um banco temporário e sempre o remove ao final. */

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$conexao = new mysqli('localhost', 'root', '', '', 3306);
$conexao->set_charset('utf8mb4');
$bancoTeste = 'sa_ferrorama_sensor_test_' . bin2hex(random_bytes(4));
$etapas = [];

function verificar_crud(bool $condicao, string $mensagem): void
{
    if (!$condicao) {
        throw new RuntimeException($mensagem);
    }
}

try {
    $conexao->query("CREATE DATABASE `{$bancoTeste}` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci");
    $conexao->select_db($bancoTeste);
    $conexao->query(
        "CREATE TABLE trens (
            id_trem INT AUTO_INCREMENT PRIMARY KEY,
            nome VARCHAR(100) NOT NULL,
            status VARCHAR(50) NOT NULL
        ) ENGINE=InnoDB"
    );
    $conexao->query(
        "CREATE TABLE sensor (
            id_sensor INT AUTO_INCREMENT PRIMARY KEY,
            nome VARCHAR(100) NOT NULL,
            localizacao VARCHAR(100) NOT NULL,
            tipo_dado VARCHAR(50) NOT NULL,
            id_trem INT NOT NULL,
            tipo ENUM('Ativo','Inativo','Com falha') NOT NULL DEFAULT 'Ativo',
            conjunto VARCHAR(100) NOT NULL,
            CONSTRAINT uq_sensor_nome UNIQUE (nome),
            CONSTRAINT fk_sensor_trem FOREIGN KEY (id_trem) REFERENCES trens(id_trem)
                ON UPDATE CASCADE ON DELETE RESTRICT
        ) ENGINE=InnoDB"
    );
    $conexao->query(
        "CREATE TABLE dados_sensor (
            id_dado INT AUTO_INCREMENT PRIMARY KEY,
            valor DECIMAL(10,2),
            data_hora DATETIME,
            id_sensor INT NOT NULL,
            CONSTRAINT fk_dados_sensor_sensor FOREIGN KEY (id_sensor) REFERENCES sensor(id_sensor)
                ON UPDATE CASCADE ON DELETE RESTRICT
        ) ENGINE=InnoDB"
    );
    $conexao->query("INSERT INTO trens (nome, status) VALUES ('Trem Teste', 'Ativo')");
    $idTrem = $conexao->insert_id;

    $stmt = $conexao->prepare(
        'INSERT INTO sensor (nome, localizacao, tipo_dado, id_trem, tipo, conjunto)
         VALUES (?, ?, ?, ?, ?, ?)'
    );
    $nome = 'Sensor TMP-TESTE';
    $localizacao = 'Vagão de teste';
    $tipoDado = 'Temperatura';
    $status = 'Ativo';
    $conjunto = 'Motor';
    $stmt->bind_param('sssiss', $nome, $localizacao, $tipoDado, $idTrem, $status, $conjunto);
    $stmt->execute();
    $idSensor = $conexao->insert_id;
    $stmt->close();
    verificar_crud($idSensor > 0, 'cadastro válido não gerou um sensor');
    $etapas[] = 'CREATE válido';

    try {
        $conexao->query(
            "INSERT INTO sensor (nome, localizacao, tipo_dado, id_trem, tipo, conjunto)
             VALUES ('Sensor TMP-TESTE', 'Outro local', 'Temperatura', {$idTrem}, 'Ativo', 'Motor')"
        );
        throw new RuntimeException('nome duplicado foi aceito');
    } catch (mysqli_sql_exception $ex) {
        verificar_crud($ex->getCode() === 1062, 'duplicidade retornou erro inesperado');
    }
    try {
        $conexao->query(
            "INSERT INTO sensor (nome, localizacao, tipo_dado, id_trem, tipo, conjunto)
             VALUES ('Sensor sem trem', 'Teste', 'Temperatura', 999999, 'Ativo', 'Motor')"
        );
        throw new RuntimeException('trem inexistente foi aceito');
    } catch (mysqli_sql_exception $ex) {
        verificar_crud($ex->getCode() === 1452, 'chave estrangeira retornou erro inesperado');
    }
    $etapas[] = 'CREATE inválido';

    $resultado = $conexao->query(
        "SELECT s.nome, t.nome AS trem_nome
         FROM sensor AS s INNER JOIN trens AS t ON t.id_trem = s.id_trem
         WHERE s.id_sensor = {$idSensor}"
    )->fetch_assoc();
    verificar_crud($resultado['nome'] === $nome && $resultado['trem_nome'] === 'Trem Teste', 'consulta não retornou o vínculo');
    $etapas[] = 'READ e relacionamento';

    $conexao->query("UPDATE sensor SET tipo = 'Com falha', localizacao = 'Vagão 2' WHERE id_sensor = {$idSensor}");
    $atualizado = $conexao->query("SELECT tipo, localizacao FROM sensor WHERE id_sensor = {$idSensor}")->fetch_assoc();
    verificar_crud($atualizado['tipo'] === 'Com falha' && $atualizado['localizacao'] === 'Vagão 2', 'alteração não foi persistida');
    $etapas[] = 'UPDATE válido';

    $conexao->query("INSERT INTO dados_sensor (valor, data_hora, id_sensor) VALUES (85.5, NOW(), {$idSensor})");
    try {
        $conexao->query("DELETE FROM sensor WHERE id_sensor = {$idSensor}");
        throw new RuntimeException('sensor com leitura foi excluído');
    } catch (mysqli_sql_exception $ex) {
        verificar_crud($ex->getCode() === 1451, 'bloqueio de exclusão retornou erro inesperado');
    }
    $etapas[] = 'DELETE inválido bloqueado';

    $conexao->query("DELETE FROM dados_sensor WHERE id_sensor = {$idSensor}");
    $conexao->query("DELETE FROM sensor WHERE id_sensor = {$idSensor}");
    $restantes = (int) $conexao->query("SELECT COUNT(*) AS total FROM sensor WHERE id_sensor = {$idSensor}")->fetch_assoc()['total'];
    verificar_crud($restantes === 0, 'sensor sem leituras não foi excluído');
    $etapas[] = 'DELETE válido';

    echo 'CRUD de sensores: OK — ' . implode('; ', $etapas) . "\n";
} finally {
    $conexao->query("DROP DATABASE IF EXISTS `{$bancoTeste}`");
    $conexao->close();
}
