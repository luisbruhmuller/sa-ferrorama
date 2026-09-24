<?php
// Funções compartilhadas exclusivamente pelo módulo de usuários.
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start(['cookie_httponly' => true, 'cookie_samesite' => 'Lax',
        'cookie_secure' => !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off']);
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
try {
    // Conexão do módulo com o MySQL usado pelo phpMyAdmin deste XAMPP.
    $conexao = new mysqli('127.0.0.1', 'root', '', 'sa_ferrorama', 3307);
    $conexao->set_charset('utf8mb4');
} catch (mysqli_sql_exception $e) {
    error_log($e->getMessage());
    http_response_code(503);
    exit('Não foi possível conectar ao banco de dados. Tente novamente mais tarde.');
}
function escapar($valor) {
    return htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');
}
function campo($nome) {
    return isset($_POST[$nome]) && is_string($_POST[$nome]) ? trim($_POST[$nome]) : '';
}
function consulta($sql, $tipos = '', $valores = []) {
    global $conexao;
    $stmt = $conexao->prepare($sql);
    if ($tipos !== '') $stmt->bind_param($tipos, ...$valores);
    $stmt->execute();
    return $stmt;
}
function redirecionar($destino) {
    header('Location: ' . $destino, true, 303);
    exit;
}
function mensagem($texto, $tipo = 'success') {
    $_SESSION['mensagem'] = [$texto, $tipo];
}
function token() {
    if (empty($_SESSION['csrf'])) $_SESSION['csrf'] = bin2hex(random_bytes(32));
    return '<input type="hidden" name="csrf" value="' . escapar($_SESSION['csrf']) . '">';
}
function validar_post() {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Allow: POST');
        http_response_code(405);
        exit('Método não permitido.');
    }
    if (empty($_SESSION['csrf']) || !hash_equals($_SESSION['csrf'], campo('csrf'))) {
        http_response_code(403);
        exit('Formulário expirado. Volte à página e tente novamente.');
    }
}
function exigir_admin() {
    if (empty($_SESSION['usuario_id'])) redirecionar('tela_login.php');
    $usuario = consulta('SELECT id, nome, funcao, status FROM usuarios WHERE id = ?', 'i', [$_SESSION['usuario_id']])->get_result()->fetch_assoc();
    if (!$usuario || $usuario['status'] !== 'ativo') {
        unset($_SESSION['usuario_id']);
        redirecionar('tela_login.php');
    }
    if ($usuario['funcao'] !== 'adm') {
        http_response_code(403);
        exit('Acesso permitido somente a administradores.');
    }
    return $usuario;
}
function id_usuario($valor) {
    $id = is_scalar($valor) ? filter_var($valor, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]) : false;
    if (!$id) { http_response_code(400); exit('Usuário inválido.'); }
    return $id;
}
function buscar_usuario($id) {
    $usuario = consulta('SELECT id, nome, email, cpf, funcao, status FROM usuarios WHERE id = ?', 'i', [$id])->get_result()->fetch_assoc();
    if (!$usuario) { http_response_code(404); exit('Usuário não encontrado.'); }
    return $usuario;
}
function validar_usuario($edicao = false) {
    $dados = ['nome' => campo('nome'), 'email' => campo('email'), 'cpf' => preg_replace('/[^0-9]/', '', campo('cpf')), 'funcao' => campo('funcao'), 'status' => campo('status')];
    $senha = isset($_POST['senha']) && is_string($_POST['senha']) ? $_POST['senha'] : '';
    $confirmacao = isset($_POST['confirmar_senha']) && is_string($_POST['confirmar_senha']) ? $_POST['confirmar_senha'] : '';
    $erros = [];
    if ($dados['nome'] === '' || mb_strlen($dados['nome']) > 200) $erros[] = 'Informe um nome com até 200 caracteres.';
    if (!filter_var($dados['email'], FILTER_VALIDATE_EMAIL) || strlen($dados['email']) > 200) $erros[] = 'Informe um e-mail válido com até 200 caracteres.';
    $cpf = $dados['cpf'];
    $cpfValido = strlen($cpf) === 11 && !preg_match('/^(\d)\1{10}$/', $cpf);
    if ($cpfValido) {
        for ($t = 9; $t < 11; $t++) {
            $soma = 0;
            for ($i = 0; $i < $t; $i++) $soma += (int) $cpf[$i] * ($t + 1 - $i);
            $digito = (10 * $soma) % 11;
            if ($digito === 10) $digito = 0;
            if ((int) $cpf[$t] !== $digito) $cpfValido = false;
        }
    }
    if (!$cpfValido) $erros[] = 'Informe um CPF válido.';
    if (!in_array($dados['funcao'], ['adm', 'funcionario', 'cliente'], true)) $erros[] = 'Selecione um cargo válido.';
    if (!in_array($dados['status'], ['ativo', 'inativo', 'pendente'], true)) $erros[] = 'Selecione um status válido.';
    if (!$edicao || $senha !== '' || $confirmacao !== '') {
        if (strlen($senha) < 8 || strlen($senha) > 72) $erros[] = 'A senha deve ter entre 8 e 72 bytes.';
        if ($senha !== $confirmacao) $erros[] = 'As senhas não coincidem.';
    }
    return [$dados, $senha, $erros];
}
function duplicado($dados, $id = 0) {
    return consulta("SELECT id FROM usuarios WHERE id <> ? AND (email = ? OR REPLACE(REPLACE(REPLACE(cpf, '.', ''), '-', ''), ' ', '') = ?) LIMIT 1", 'iss', [$id, $dados['email'], $dados['cpf']])->get_result()->num_rows > 0;
}
