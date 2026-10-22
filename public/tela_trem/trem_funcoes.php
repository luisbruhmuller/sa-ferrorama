<?php
/**
 * Funções compartilhadas do CRUD de trens (tela_trem).
 * Inclua este arquivo ANTES de qualquer saída HTML: ele inicia a sessão e abre a conexão.
 */

require_once __DIR__ . '/../tela_usuario/usuarios_comum.php';
exigir_login();

require_once __DIR__ . '/../../infra/conexao.php';
require_once __DIR__ . '/../../infra/validacao_trem.php';

// infra/conexao.php expõe $conn; o módulo usa um nome mais descritivo.
$conexao = $conn;

// A partir daqui, erros de SQL viram exceções (mysqli_sql_exception) tratadas com try/catch,
// evitando que mensagens técnicas do banco apareçam para o usuário.
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

/** Escapa texto antes de imprimir no HTML (proteção contra XSS). */
function trem_h($valor): string
{
    return htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');
}

/** Cor da etiqueta de status na listagem. */
function trem_classe_status(string $status): string
{
    $mapa = [
        'Ativo' => 'bg-success',
        'Desativado' => 'bg-danger',
        'Parado no Caminho' => 'bg-warning',
    ];
    return $mapa[$status] ?? 'bg-secondary';
}

/* ---------- CSRF: garante que o POST veio de um formulário do próprio sistema ---------- */

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

/* ---------- Mensagens de retorno e redirecionamento (Post/Redirect/Get) ---------- */

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

/** Guarda o que o usuário digitou e os erros, para reexibir o formulário preenchido. */
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

/* ---------- Acesso ao banco ---------- */

function trem_buscar(mysqli $conexao, int $id): ?array
{
    $stmt = $conexao->prepare(
        'SELECT id_trem, nome, tipo, status, conjunto, id_responsavel FROM trens WHERE id_trem = ?'
    );
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $trem = $stmt->get_result()->fetch_assoc();
    $stmt->close();
    return $trem ?: null;
}

function trem_responsavel_existe(mysqli $conexao, int $idResponsavel): bool
{
    $stmt = $conexao->prepare('SELECT 1 FROM usuarios WHERE id = ? LIMIT 1');
    $stmt->bind_param('i', $idResponsavel);
    $stmt->execute();
    $existe = $stmt->get_result()->num_rows > 0;
    $stmt->close();
    return $existe;
}

function trem_listar_responsaveis(mysqli $conexao): array
{
    $resultado = $conexao->query('SELECT id, nome, email, status FROM usuarios ORDER BY nome, id');
    return $resultado->fetch_all(MYSQLI_ASSOC);
}
