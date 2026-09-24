<?php
require __DIR__ . '/usuarios_comum.php';
$administrador = exigir_admin();
$id = id_usuario($_GET['id'] ?? null);
$dados = buscar_usuario($id);
$edicao = true;
$erros = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    validar_post();
    [$dados, $senha, $erros] = validar_usuario(true);
    if ($id === (int) $administrador['id'] && ($dados['funcao'] !== 'adm' || $dados['status'] !== 'ativo')) $erros[] = 'Você não pode remover seu próprio acesso de administrador.';
    try {
        if (!$erros && duplicado($dados, $id)) $erros[] = 'Já existe um usuário com esse e-mail ou CPF.';
        if (!$erros) {
            if ($senha !== '') {
                consulta('UPDATE usuarios SET nome = ?, email = ?, cpf = ?, funcao = ?, status = ?, senha = ? WHERE id = ?', 'ssssssi', [$dados['nome'], $dados['email'], $dados['cpf'], $dados['funcao'], $dados['status'], password_hash($senha, PASSWORD_BCRYPT), $id]);
            } else {
                consulta('UPDATE usuarios SET nome = ?, email = ?, cpf = ?, funcao = ?, status = ? WHERE id = ?', 'sssssi', [$dados['nome'], $dados['email'], $dados['cpf'], $dados['funcao'], $dados['status'], $id]);
            }
            mensagem('Usuário atualizado com sucesso.');
            redirecionar('tela_usuarios.php');
        }
    } catch (mysqli_sql_exception $e) {
        error_log($e->getMessage());
        $erros[] = 'Não foi possível atualizar o usuário. Tente novamente.';
    }
    http_response_code(422);
}
require __DIR__ . '/tela_cadastro_usuarios.php';
