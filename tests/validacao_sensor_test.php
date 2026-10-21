<?php

require_once __DIR__ . '/../infra/validacao_sensor.php';

function verificar_sensor(bool $condicao, string $mensagem): void
{
    if (!$condicao) {
        fwrite(STDERR, "FALHOU: {$mensagem}\n");
        exit(1);
    }
}

$entradaValida = [
    'nome' => '  Sensor TMP-01  ',
    'tipo_dado' => 'Temperatura',
    'localizacao' => ' Vagão 1 / Motor ',
    'id_trem' => '7',
    'tipo' => 'Ativo',
    'conjunto' => 'Motor',
];

[$dados, $erros] = sensor_validar($entradaValida);
verificar_sensor($erros === [], 'dados válidos devem ser aceitos');
verificar_sensor($dados['nome'] === 'Sensor TMP-01', 'o nome deve ser normalizado');
verificar_sensor($dados['localizacao'] === 'Vagão 1 / Motor', 'a localização deve ser normalizada');
verificar_sensor($dados['id_trem'] === 7, 'o id do trem deve ser convertido em inteiro');

[$dadosInvalidos, $errosInvalidos] = sensor_validar([
    'nome' => '<sensor>',
    'tipo_dado' => 'Pressão',
    'localizacao' => str_repeat('A', 101),
    'id_trem' => '0',
    'tipo' => 'Quebrado',
    'conjunto' => 'Teto',
]);
verificar_sensor(count($errosInvalidos) === 6, 'todos os campos inválidos devem ser informados');
verificar_sensor(isset($errosInvalidos['nome']), 'caracteres inválidos no nome devem ser rejeitados');
verificar_sensor(isset($errosInvalidos['id_trem']), 'id de trem não positivo deve ser rejeitado');
verificar_sensor($dadosInvalidos['id_trem'] === null, 'id inválido deve ser normalizado para null');

[, $errosArrays] = sensor_validar(array_merge($entradaValida, [
    'nome' => ['Sensor'],
    'id_trem' => ['7'],
]));
verificar_sensor(isset($errosArrays['nome']), 'array não pode ser aceito como nome');
verificar_sensor(isset($errosArrays['id_trem']), 'array não pode ser aceito como id');
verificar_sensor(sensor_id_valido('2.5') === null, 'id decimal deve ser rejeitado');

echo "Validação de sensores: OK\n";
