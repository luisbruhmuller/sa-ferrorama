<?php
/**
 * Processa a edição de trem (Update). Recebe apenas POST e sempre termina com redirecionamento.
 */
require_once __DIR__ . '/trem_funcoes.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    trem_redirecionar('tela_trem.php');
}

if (!trem_csrf_valido($_POST['csrf_token'] ?? null)) {
    trem_flash('danger', 'Sessão inválida. Recarregue a página e tente novamente.');
    trem_redirecionar('tela_trem.php');
}

// O id também vem do formulário, então também precisa ser validado.
$idTrem = trem_id_valido($_POST['id_trem'] ?? null);
if ($idTrem === null) {
    trem_flash('danger', 'Trem inválido.');
    trem_redirecionar('tela_trem.php');
}

[$dados, $erros] = trem_validar($_POST);
if ($erros) {
    trem_guardar_formulario($dados, $erros);
    trem_redirecionar('tela_editar_trem.php?id=' . $idTrem);
}

try {
    // Verifica se o trem existe (UPDATE sem mudanças reais retorna 0 linhas afetadas, então não serve para isso).
    if (trem_buscar($conexao, $idTrem) === null) {
        trem_flash('danger', 'Trem não encontrado.');
        trem_redirecionar('tela_trem.php');
    }

    $stmt = $conexao->prepare('UPDATE trem SET nome = ?, tipo = ?, status = ?, conjunto = ? WHERE id_trem = ?');
    $stmt->bind_param('ssssi', $dados['nome'], $dados['tipo'], $dados['status'], $dados['conjunto'], $idTrem);
    $stmt->execute();
    $stmt->close();

    trem_flash('success', 'Trem atualizado com sucesso!');
    trem_redirecionar('tela_trem.php');
} catch (mysqli_sql_exception $ex) {
    error_log('Erro ao editar trem: ' . $ex->getMessage());
    trem_guardar_formulario($dados, []);
    trem_flash('danger', 'Não foi possível atualizar o trem. Tente novamente.');
    trem_redirecionar('tela_editar_trem.php?id=' . $idTrem);
}
