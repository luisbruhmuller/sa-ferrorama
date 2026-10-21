<?php

const SENSOR_TIPOS_DADO = [
    'Temperatura',
    'Vibração',
    'Consumo de Energia',
    'Velocidade',
    'Localização',
];

const SENSOR_STATUS = ['Ativo', 'Inativo', 'Com falha'];

const SENSOR_CONJUNTOS = [
    'Motor',
    'Elétrico',
    'Freios',
    'Comunicação',
    'Refrigeração',
    'Câmeras',
];

function sensor_texto(array $entrada, string $campo): string
{
    $valor = $entrada[$campo] ?? '';
    return is_string($valor) ? trim($valor) : '';
}

/** Lê um identificador positivo sem aceitar arrays, decimais ou texto parcial. */
function sensor_id_valido($valor): ?int
{
    if (!is_scalar($valor)) {
        return null;
    }

    $id = filter_var($valor, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
    return $id === false ? null : $id;
}

/**
 * Normaliza e valida o formulário de sensor.
 * Retorna [dados, erros]; dados só podem ser persistidos quando erros estiver vazio.
 */
function sensor_validar(array $entrada): array
{
    $dados = [
        'nome' => sensor_texto($entrada, 'nome'),
        'tipo_dado' => sensor_texto($entrada, 'tipo_dado'),
        'localizacao' => sensor_texto($entrada, 'localizacao'),
        'id_trem' => sensor_id_valido($entrada['id_trem'] ?? null),
        'tipo' => sensor_texto($entrada, 'tipo'),
        'conjunto' => sensor_texto($entrada, 'conjunto'),
    ];
    $erros = [];

    if ($dados['nome'] === '') {
        $erros['nome'] = 'Informe o nome ou código do sensor.';
    } elseif (mb_strlen($dados['nome']) < 2 || mb_strlen($dados['nome']) > 100) {
        $erros['nome'] = 'O nome deve ter entre 2 e 100 caracteres.';
    } elseif (!preg_match('/^[\p{L}\p{N} _.-]+$/u', $dados['nome'])) {
        $erros['nome'] = 'Use apenas letras, números, espaço, ponto, hífen ou sublinhado.';
    }

    if (!in_array($dados['tipo_dado'], SENSOR_TIPOS_DADO, true)) {
        $erros['tipo_dado'] = 'Selecione um tipo de dado válido.';
    }

    if ($dados['localizacao'] === '') {
        $erros['localizacao'] = 'Informe o local de instalação.';
    } elseif (mb_strlen($dados['localizacao']) > 100) {
        $erros['localizacao'] = 'O local deve ter no máximo 100 caracteres.';
    }

    if ($dados['id_trem'] === null) {
        $erros['id_trem'] = 'Selecione um trem válido.';
    }

    if (!in_array($dados['tipo'], SENSOR_STATUS, true)) {
        $erros['tipo'] = 'Selecione um status válido.';
    }

    if (!in_array($dados['conjunto'], SENSOR_CONJUNTOS, true)) {
        $erros['conjunto'] = 'Selecione um subsistema válido.';
    }

    return [$dados, $erros];
}
