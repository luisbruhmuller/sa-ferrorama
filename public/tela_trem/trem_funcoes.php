<?php

require_once __DIR__ . '/trem_funcoes.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    trem_redirecionar('tela_cadastro_trem.php');
}

if (!trem_csrf_valido($_POST['csrf_token'] ?? null)) {
    trem_flash('danger', 'Sessão inválida. Recarregue a página e tente novamente.');
    trem_redirecionar('tela_cadastro_trem.php');
}


[$dados, $erros] = trem_validar($_POST);
if ($erros) {
    trem_guardar_formulario($dados, $erros);
    trem_redirecionar('tela_cadastro_trem.php');
}

try {
  
    $stmt = $conexao->prepare('INSERT INTO trem (nome, tipo, status, conjunto) VALUES (?, ?, ?, ?)');
    $stmt->bind_param('ssss', $dados['nome'], $dados['tipo'], $dados['status'], $dados['conjunto']);
    $stmt->execute();
    $stmt->close();

    trem_flash('success', 'Trem cadastrado com sucesso!');
    trem_redirecionar('tela_trem.php');
} catch (mysqli_sql_exception $ex) {
 
    error_log('Erro ao cadastrar trem: ' . $ex->getMessage());
    trem_guardar_formulario($dados, []);
    trem_flash('danger', 'Não foi possível cadastrar o trem. Tente novamente.');
    trem_redirecionar('tela_cadastro_trem.php');
}
