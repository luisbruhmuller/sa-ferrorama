<?php
require __DIR__ . '/usuarios_comum.php';
exigir_admin();
validar_post();
$edicao = false;
[$dados, $senha, $erros] = validar_usuario();
try {
    if (!$erros && duplicado($dados)) $erros[] = 'Já existe um usuário com esse e-mail ou CPF.';
    if (!$erros) {
        $hash = password_hash($senha, PASSWORD_BCRYPT);
        consulta('INSERT INTO usuarios (nome, email, senha, cpf, funcao, status) VALUES (?, ?, ?, ?, ?, ?)', 'ssssss', [$dados['nome'], $dados['email'], $hash, $dados['cpf'], $dados['funcao'], $dados['status']]);
        mensagem('Usuário cadastrado com sucesso.');
        redirecionar('tela_usuarios.php');
    }
} catch (mysqli_sql_exception $e) {
    error_log($e->getMessage());
    $erros[] = 'Não foi possível cadastrar o usuário. Verifique os dados e tente novamente.';
}
http_response_code(422);
require __DIR__ . '/tela_cadastro_usuarios.php';
