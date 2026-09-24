<?php


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../infra/conexao.php';


mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);


const TREM_STATUS = ['Ativo', 'Desativado', 'Parado no Caminho'];
const TREM_TIPOS = ['Locomotiva', 'Vagão Gôndola', 'Vagão Hopper', 'Vagão Plataforma'];

function trem_h($valor): string
{
    return htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');
}

function trem_classe_status(string $status): string
{
    $mapa = [
        'Ativo' => 'bg-success',
        'Desativado' => 'bg-danger',
        'Parado no Caminho' => 'bg-warning',
    ];
    return $mapa[$status] ?? 'bg-secondary';
}



function trem_csrf_token(): string
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function trem_csrf_valido($token): bool
{
    return is_string($token)
        && isset($_SESSION['csrf_token'])
        && hash_equals($_SESSION['csrf_token'], $token);
}



function trem_flash(string $tipo, string $mensagem): void
{
    $_SESSION['trem_flash'] = ['tipo' => $tipo, 'mensagem' => $mensagem];
}

function trem_flash_pegar(): ?array
{
    $flash = $_SESSION['trem_flash'] ?? null;
    unset($_SESSION['trem_flash']);
    return $flash;
}


function trem_guardar_formulario(array $dados, array $erros): void
{
    $_SESSION['trem_form'] = ['dados' => $dados, 'erros' => $erros];
}

function trem_pegar_formulario(): array
{
    $form = $_SESSION['trem_form'] ?? ['dados' => [], 'erros' => []];
    unset($_SESSION['trem_form']);
    return $form;
}

function trem_redirecionar(string $destino): void
{
    header('Location: ' . $destino);
    exit;
}



function trem_texto(array $entrada, string $campo): string
{
    $valor = $entrada[$campo] ?? '';
    return is_string($valor) ? trim($valor) : '';
}


function trem_validar(array $entrada): array
{
    $dados = [
        'nome' => trem_texto($entrada, 'nome'),
        'tipo' => trem_texto($entrada, 'tipo'),
        'status' => trem_texto($entrada, 'status'),
        'conjunto' => trem_texto($entrada, 'conjunto'),
    ];
    $erros = [];

    if ($dados['nome'] === '') {
        $erros['nome'] = 'Informe o nome do trem.';
    } elseif (mb_strlen($dados['nome']) < 2 || mb_strlen($dados['nome']) > 100) {
        $erros['nome'] = 'O nome deve ter entre 2 e 100 caracteres.';
    }

    if (!in_array($dados['tipo'], TREM_TIPOS, true)) {
        $erros['tipo'] = 'Selecione um tipo de trem válido.';
    }

    if (!in_array($dados['status'], TREM_STATUS, true)) {
        $erros['status'] = 'Selecione um status válido.';
    }

    if ($dados['conjunto'] === '') {
        $erros['conjunto'] = 'Informe o conjunto do trem.';
    } elseif (mb_strlen($dados['conjunto']) > 100) {
        $erros['conjunto'] = 'O conjunto deve ter no máximo 100 caracteres.';
    } elseif (!preg_match('/^[\p{L}\p{N} _.\-]+$/u', $dados['conjunto'])) {
        $erros['conjunto'] = 'Use apenas letras, números, espaço, ponto, hífen ou sublinhado.';
    }

    return [$dados, $erros];
}


function trem_id_valido($valor): ?int
{
    $id = filter_var($valor, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
    return $id === false ? null : $id;
}


function trem_buscar(mysqli $conexao, int $id): ?array
{
    $stmt = $conexao->prepare('SELECT id_trem, nome, tipo, status, conjunto FROM trem WHERE id_trem = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $trem = $stmt->get_result()->fetch_assoc();
    $stmt->close();
    return $trem ?: null;
}
