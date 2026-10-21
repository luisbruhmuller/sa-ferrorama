<?php

require_once __DIR__ . '/../infra/validacao_usuario.php';

function verificar(bool $condicao, string $mensagem): void
{
    if (!$condicao) {
        throw new RuntimeException($mensagem);
    }
}

$usuarioValido = [
    'nome' => '  Maria da Silva  ',
    'email' => '  MARIA@EXEMPLO.COM  ',
    'cpf' => '529.982.247-25',
    'funcao' => 'tecnico',
    'status' => 'ativo',
    'senha' => 'senha-segura',
    'confirmar_senha' => 'senha-segura',
];

[$dados, $senha, $erros] = validar_dados_usuario($usuarioValido);
verificar($erros === [], 'Um usuário válido não deve produzir erros.');
verificar($dados['nome'] === 'Maria da Silva', 'O nome deve ser normalizado.');
verificar($dados['email'] === 'maria@exemplo.com', 'O e-mail deve ser normalizado.');
verificar($dados['cpf'] === '52998224725', 'O CPF deve conter somente números.');
verificar($senha === 'senha-segura', 'A senha não pode ser alterada pela validação.');

[, , $errosObrigatorios] = validar_dados_usuario([]);
verificar(count($errosObrigatorios) === 6, 'Todos os campos obrigatórios devem ser validados.');

$dadosInvalidos = $usuarioValido;
$dadosInvalidos['cpf'] = '111.111.111-11';
$dadosInvalidos['funcao'] = 'gerente';
$dadosInvalidos['status'] = 'bloqueado';
$dadosInvalidos['senha'] = 'curta';
$dadosInvalidos['confirmar_senha'] = 'diferente';
[, , $errosInvalidos] = validar_dados_usuario($dadosInvalidos);
verificar(count($errosInvalidos) === 5, 'CPF, cargo, status e senha inválidos devem ser rejeitados.');

$edicaoSemSenha = $usuarioValido;
$edicaoSemSenha['senha'] = '';
$edicaoSemSenha['confirmar_senha'] = '';
[, , $errosEdicao] = validar_dados_usuario($edicaoSemSenha, true);
verificar($errosEdicao === [], 'A edição deve permitir manter a senha atual.');

echo "Validação de usuários: OK\n";
