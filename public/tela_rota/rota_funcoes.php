<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../infra/conexao.php';
require_once __DIR__ . '/../../infra/validacao_rota.php';

$conexao = $conn;
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

function rota_h($valor): string
{
    return htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');
}

function rota_classe_status(string $status): string
{
    return $status === 'disponível' ? 'bg-success' : 'bg-danger';
}

function rota_csrf_token(): string
{
    if (empty($_SESSION['rota_csrf_token'])) {
        $_SESSION['rota_csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['rota_csrf_token'];
}

function rota_csrf_valido($token): bool
{
    return is_string($token)
        && isset($_SESSION['rota_csrf_token'])
        && hash_equals($_SESSION['rota_csrf_token'], $token);
}

function rota_flash(string $tipo, string $mensagem): void
{
    $_SESSION['rota_flash'] = ['tipo' => $tipo, 'mensagem' => $mensagem];
}

function rota_flash_pegar(): ?array
{
    $flash = $_SESSION['rota_flash'] ?? null;
    unset($_SESSION['rota_flash']);
    return $flash;
}

function rota_guardar_formulario(array $dados, array $erros): void
{
    $_SESSION['rota_form'] = ['dados' => $dados, 'erros' => $erros];
}

function rota_pegar_formulario(): array
{
    $form = $_SESSION['rota_form'] ?? ['dados' => [], 'erros' => []];
    unset($_SESSION['rota_form']);
    return $form;
}

function rota_redirecionar(string $destino): void
{
    header('Location: ' . $destino);
    exit;
}

function rota_buscar(mysqli $conexao, int $id): ?array
{
    $stmt = $conexao->prepare(
        'SELECT id, nome, distancia, tempo, origem, destino, status FROM rotas WHERE id = ?'
    );
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $rota = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    if (!$rota) {
        return null;
    }

    $stmt = $conexao->prepare('SELECT id_trem FROM rota_trens WHERE id_rota = ? ORDER BY id_trem');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $rota['trens'] = array_map(
        'intval',
        array_column($stmt->get_result()->fetch_all(MYSQLI_ASSOC), 'id_trem')
    );
    $stmt->close();
    return $rota;
}

function rota_listar_trens(mysqli $conexao): array
{
    $resultado = $conexao->query('SELECT id_trem, nome, status FROM trens ORDER BY nome, id_trem');
    return $resultado->fetch_all(MYSQLI_ASSOC);
}

function rota_trens_existem(mysqli $conexao, array $idsTrens): bool
{
    if (!$idsTrens) {
        return false;
    }

    $marcadores = implode(',', array_fill(0, count($idsTrens), '?'));
    $tipos = str_repeat('i', count($idsTrens));
    $stmt = $conexao->prepare("SELECT COUNT(*) AS total FROM trens WHERE id_trem IN ({$marcadores})");
    $stmt->bind_param($tipos, ...$idsTrens);
    $stmt->execute();
    $total = (int) $stmt->get_result()->fetch_assoc()['total'];
    $stmt->close();
    return $total === count($idsTrens);
}

/** Substitui todos os vínculos da rota dentro da transação aberta pelo chamador. */
function rota_sincronizar_trens(mysqli $conexao, int $idRota, array $idsTrens): void
{
    $stmt = $conexao->prepare('DELETE FROM rota_trens WHERE id_rota = ?');
    $stmt->bind_param('i', $idRota);
    $stmt->execute();
    $stmt->close();

    $stmt = $conexao->prepare('INSERT INTO rota_trens (id_rota, id_trem) VALUES (?, ?)');
    foreach ($idsTrens as $idTrem) {
        $stmt->bind_param('ii', $idRota, $idTrem);
        $stmt->execute();
    }
    $stmt->close();
}
