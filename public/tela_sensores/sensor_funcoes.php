<?php
/** Funções compartilhadas pelo CRUD de sensores. Inclua antes de qualquer saída HTML. */

require_once __DIR__ . '/../tela_usuario/usuarios_comum.php';
$usuarioSensor = exigir_login();

require_once __DIR__ . '/../../infra/conexao.php';
require_once __DIR__ . '/../../infra/validacao_sensor.php';

$conexao = $conn;
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

function sensor_h($valor): string
{
    return htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');
}

function sensor_classe_status(string $status): string
{
    $classes = [
        'Ativo' => 'bg-success',
        'Inativo' => 'bg-secondary',
        'Com falha' => 'bg-danger',
    ];
    return $classes[$status] ?? 'bg-secondary';
}

function sensor_csrf_token(): string
{
    if (empty($_SESSION['sensor_csrf_token'])) {
        $_SESSION['sensor_csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['sensor_csrf_token'];
}

function sensor_csrf_valido($token): bool
{
    return is_string($token)
        && isset($_SESSION['sensor_csrf_token'])
        && hash_equals($_SESSION['sensor_csrf_token'], $token);
}

function sensor_flash(string $tipo, string $mensagem): void
{
    $_SESSION['sensor_flash'] = ['tipo' => $tipo, 'mensagem' => $mensagem];
}

function sensor_flash_pegar(): ?array
{
    $flash = $_SESSION['sensor_flash'] ?? null;
    unset($_SESSION['sensor_flash']);
    return $flash;
}

function sensor_guardar_formulario(array $dados, array $erros): void
{
    $_SESSION['sensor_form'] = ['dados' => $dados, 'erros' => $erros];
}

function sensor_pegar_formulario(): array
{
    $form = $_SESSION['sensor_form'] ?? ['dados' => [], 'erros' => []];
    unset($_SESSION['sensor_form']);
    return $form;
}

function sensor_redirecionar(string $destino): void
{
    header('Location: ' . $destino);
    exit;
}

function sensor_buscar(mysqli $conexao, int $id): ?array
{
    $stmt = $conexao->prepare(
        'SELECT id_sensor, nome, localizacao, tipo_dado, id_trem, tipo, conjunto
         FROM sensor WHERE id_sensor = ?'
    );
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $sensor = $stmt->get_result()->fetch_assoc();
    $stmt->close();
    return $sensor ?: null;
}

function sensor_listar_trens(mysqli $conexao): array
{
    $resultado = $conexao->query('SELECT id_trem, nome, status FROM trens ORDER BY nome, id_trem');
    return $resultado->fetch_all(MYSQLI_ASSOC);
}

function sensor_trem_existe(mysqli $conexao, int $idTrem): bool
{
    $stmt = $conexao->prepare('SELECT 1 FROM trens WHERE id_trem = ? LIMIT 1');
    $stmt->bind_param('i', $idTrem);
    $stmt->execute();
    $existe = $stmt->get_result()->num_rows > 0;
    $stmt->close();
    return $existe;
}

function sensor_nome_existe(mysqli $conexao, string $nome, ?int $ignorarId = null): bool
{
    if ($ignorarId === null) {
        $stmt = $conexao->prepare('SELECT 1 FROM sensor WHERE nome = ? LIMIT 1');
        $stmt->bind_param('s', $nome);
    } else {
        $stmt = $conexao->prepare('SELECT 1 FROM sensor WHERE nome = ? AND id_sensor <> ? LIMIT 1');
        $stmt->bind_param('si', $nome, $ignorarId);
    }
    $stmt->execute();
    $existe = $stmt->get_result()->num_rows > 0;
    $stmt->close();
    return $existe;
}

function sensor_total_leituras(mysqli $conexao, int $idSensor): int
{
    $stmt = $conexao->prepare('SELECT COUNT(*) AS total FROM dados_sensor WHERE id_sensor = ?');
    $stmt->bind_param('i', $idSensor);
    $stmt->execute();
    $total = (int) $stmt->get_result()->fetch_assoc()['total'];
    $stmt->close();
    return $total;
}
