<?php

const ROTA_STATUS = ['disponível', 'indisponível'];

function rota_texto(array $entrada, string $campo): string
{
    $valor = $entrada[$campo] ?? '';
    return is_string($valor) ? trim($valor) : '';
}

function rota_id_valido($valor): ?int
{
    if (!is_scalar($valor)) {
        return null;
    }

    $id = filter_var($valor, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
    return $id === false ? null : $id;
}

/** Retorna uma lista sem IDs repetidos e informa se havia algum valor inválido. */
function rota_ids_trens($valor): array
{
    if (!is_array($valor)) {
        return [[], true];
    }

    $ids = [];
    $possuiInvalido = false;
    foreach ($valor as $idInformado) {
        $id = rota_id_valido($idInformado);
        if ($id === null) {
            $possuiInvalido = true;
            continue;
        }
        $ids[$id] = $id;
    }

    return [array_values($ids), $possuiInvalido];
}

/**
 * Normaliza e valida os dados recebidos pelo formulário de rota.
 * O retorno contém [dados_limpos, erros_por_campo].
 */
function rota_validar(array $entrada): array
{
    [$idsTrens, $possuiTremInvalido] = rota_ids_trens($entrada['trens'] ?? null);
    $distanciaInformada = str_replace(',', '.', rota_texto($entrada, 'distancia'));
    $tempoInformado = rota_texto($entrada, 'tempo');

    $dados = [
        'nome' => rota_texto($entrada, 'nome'),
        'origem' => rota_texto($entrada, 'origem'),
        'destino' => rota_texto($entrada, 'destino'),
        'distancia' => $distanciaInformada,
        'tempo' => $tempoInformado,
        'status' => rota_texto($entrada, 'status'),
        'trens' => $idsTrens,
    ];
    $erros = [];

    foreach (['nome' => 'nome', 'origem' => 'origem', 'destino' => 'destino'] as $campo => $rotulo) {
        if ($dados[$campo] === '') {
            $erros[$campo] = 'Informe ' . ($campo === 'nome' ? 'o ' : 'a ') . $rotulo . ' da rota.';
        } elseif (mb_strlen($dados[$campo]) < 2 || mb_strlen($dados[$campo]) > 200) {
            $erros[$campo] = ucfirst($rotulo) . ' deve ter entre 2 e 200 caracteres.';
        }
    }

    if ($dados['origem'] !== '' && mb_strtolower($dados['origem']) === mb_strtolower($dados['destino'])) {
        $erros['destino'] = 'O destino deve ser diferente da origem.';
    }

    if (!preg_match('/^\d{1,8}(?:\.\d{1,2})?$/', $dados['distancia'])
        || (float) $dados['distancia'] <= 0) {
        $erros['distancia'] = 'Informe uma distância válida, maior que zero.';
    } else {
        $dados['distancia'] = number_format((float) $dados['distancia'], 2, '.', '');
    }

    if (!preg_match('/^(?:[01]\d|2[0-3]):[0-5]\d(?:\:[0-5]\d)?$/', $dados['tempo'])) {
        $erros['tempo'] = 'Informe um tempo válido entre 00:01 e 23:59.';
    } else {
        if (strlen($dados['tempo']) === 5) {
            $dados['tempo'] .= ':00';
        }
        if ($dados['tempo'] === '00:00:00') {
            $erros['tempo'] = 'O tempo estimado deve ser maior que zero.';
        }
    }

    if (!in_array($dados['status'], ROTA_STATUS, true)) {
        $erros['status'] = 'Selecione um status válido.';
    }

    if (!$dados['trens']) {
        $erros['trens'] = 'Selecione ao menos um trem.';
    } elseif ($possuiTremInvalido) {
        $erros['trens'] = 'A seleção de trens contém um valor inválido.';
    }

    return [$dados, $erros];
}
