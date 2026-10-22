<?php

function normalizar_email_usuario(string $email): string
{
    return strtolower(trim($email));
}

function normalizar_cpf_usuario(string $cpf): string
{
    return preg_replace('/\D/', '', $cpf) ?? '';
}

function cpf_usuario_valido(string $cpf): bool
{
    if (strlen($cpf) !== 11 || preg_match('/^(\d)\1{10}$/', $cpf)) {
        return false;
    }

    for ($tamanho = 9; $tamanho < 11; $tamanho++) {
        $soma = 0;
        for ($indice = 0; $indice < $tamanho; $indice++) {
            $soma += (int) $cpf[$indice] * ($tamanho + 1 - $indice);
        }

        $digito = (10 * $soma) % 11;
        if ($digito === 10) {
            $digito = 0;
        }

        if ((int) $cpf[$tamanho] !== $digito) {
            return false;
        }
    }

    return true;
}

function validar_dados_usuario(array $entrada, bool $edicao = false): array
{
    $valor = static function (string $campo) use ($entrada): string {
        return isset($entrada[$campo]) && is_string($entrada[$campo])
            ? trim($entrada[$campo])
            : '';
    };

    $dados = [
        'nome' => $valor('nome'),
        'email' => normalizar_email_usuario($valor('email')),
        'cpf' => normalizar_cpf_usuario($valor('cpf')),
        'funcao' => $valor('funcao'),
        'status' => $valor('status'),
    ];
    $senha = isset($entrada['senha']) && is_string($entrada['senha']) ? $entrada['senha'] : '';
    $confirmacao = isset($entrada['confirmar_senha']) && is_string($entrada['confirmar_senha'])
        ? $entrada['confirmar_senha']
        : '';
    $erros = [];

    if ($dados['nome'] === '' || mb_strlen($dados['nome']) > 200) {
        $erros[] = 'Informe um nome com até 200 caracteres.';
    }
    if (!filter_var($dados['email'], FILTER_VALIDATE_EMAIL) || strlen($dados['email']) > 200) {
        $erros[] = 'Informe um e-mail válido com até 200 caracteres.';
    }
    if (!cpf_usuario_valido($dados['cpf'])) {
        $erros[] = 'Informe um CPF válido.';
    }
    if (!in_array($dados['funcao'], ['adm', 'tecnico', 'funcionario'], true)) {
        $erros[] = 'Selecione um cargo válido.';
    }
    if (!in_array($dados['status'], ['ativo', 'inativo', 'pendente'], true)) {
        $erros[] = 'Selecione um status válido.';
    }
    if (!$edicao || $senha !== '' || $confirmacao !== '') {
        if (strlen($senha) < 8 || strlen($senha) > 72) {
            $erros[] = 'A senha deve ter entre 8 e 72 bytes.';
        }
        if ($senha !== $confirmacao) {
            $erros[] = 'As senhas não coincidem.';
        }
    }

    return [$dados, $senha, $erros];
}
