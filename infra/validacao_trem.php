<?php

const TREM_STATUS = ['Ativo', 'Desativado', 'Parado no Caminho'];
const TREM_TIPOS = ['Locomotiva', 'Vagão Gôndola', 'Vagão Hopper', 'Vagão Plataforma'];

function trem_texto(array $entrada, string $campo): string
{
    $valor = $entrada[$campo] ?? '';
    return is_string($valor) ? trim($valor) : '';
}

/** Lê um id enviado pelo usuário; retorna int positivo ou null se for inválido. */
function trem_id_valido($valor): ?int
{
    if (!is_scalar($valor)) {
        return null;
    }

    $id = filter_var($valor, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
    return $id === false ? null : $id;
}

/**
 * Valida e limpa os dados do formulário.
 * Retorna [dados_limpos, erros]; se $erros estiver vazio, os dados podem ser gravados.
 */
function trem_validar(array $entrada): array
{
    $dados = [
        'nome' => trem_texto($entrada, 'nome'),
        'tipo' => trem_texto($entrada, 'tipo'),
        'status' => trem_texto($entrada, 'status'),
        'conjunto' => trem_texto($entrada, 'conjunto'),
        'id_responsavel' => trem_id_valido($entrada['id_responsavel'] ?? null),
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

    if ($dados['id_responsavel'] === null) {
        $erros['id_responsavel'] = 'Selecione um usuário responsável válido.';
    }

    return [$dados, $erros];
}
