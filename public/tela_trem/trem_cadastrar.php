<?php
/**
 * Processa o cadastro de trem (Create). Recebe apenas POST e sempre termina com redirecionamento.
 */
require_once __DIR__ . '/trem_funcoes.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    trem_redirecionar('tela_cadastro_trem.php');
}

if (!trem_csrf_valido($_POST['csrf_token'] ?? null)) {
    trem_flash('danger', 'Sessão inválida. Recarregue a página e tente novamente.');
    trem_redirecionar('tela_cadastro_trem.php');
}

// Validação no servidor: o HTML do formulário não é confiável, pois pode ser alterado no navegador.
[$dados, $erros] = trem_validar($_POST);
if (!$erros && !trem_responsavel_existe($conexao, $dados['id_responsavel'])) {
    $erros['id_responsavel'] = 'Usuário responsável não encontrado.';
}
if ($erros) {
    trem_guardar_formulario($dados, $erros);
    trem_redirecionar('tela_cadastro_trem.php');
}

try {
    // Consulta parametrizada: os valores nunca são concatenados ao SQL (proteção contra SQL Injection).
    $stmt = $conexao->prepare(
        'INSERT INTO trens (nome, tipo, status, conjunto, id_responsavel) VALUES (?, ?, ?, ?, ?)'
    );
    $stmt->bind_param(
        'ssssi',
        $dados['nome'],
        $dados['tipo'],
        $dados['status'],
        $dados['conjunto'],
        $dados['id_responsavel']
    );
    $stmt->execute();
    $stmt->close();

    trem_flash('success', 'Trem cadastrado com sucesso!');
    trem_redirecionar('tela_trem.php');
} catch (mysqli_sql_exception $ex) {
    // O detalhe técnico vai para o log do servidor; o usuário recebe uma mensagem genérica.
    error_log('Erro ao cadastrar trem: ' . $ex->getMessage());
    if ($ex->getCode() === 1452) {
        $erros['id_responsavel'] = 'Usuário responsável não encontrado.';
    }
    trem_guardar_formulario($dados, $erros);
    trem_flash('danger', $ex->getCode() === 1452
        ? 'O responsável selecionado não existe mais.'
        : 'Não foi possível cadastrar o trem. Tente novamente.');
    trem_redirecionar('tela_cadastro_trem.php');
}
