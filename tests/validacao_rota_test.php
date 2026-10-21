<?php

require_once __DIR__ . '/../infra/validacao_rota.php';

function verificar_rota(bool $condicao, string $mensagem): void
{
    if (!$condicao) {
        fwrite(STDERR, "FALHOU: {$mensagem}\n");
        exit(1);
    }
}

$entradaValida = [
    'nome' => '  Rota Serra Azul  ',
    'origem' => 'Joinville',
    'destino' => 'Blumenau',
    'distancia' => '127,5',
    'tempo' => '02:30',
    'status' => 'disponível',
    'trens' => ['3', '7', '3'],
];

[$dados, $erros] = rota_validar($entradaValida);
verificar_rota($erros === [], 'dados válidos devem ser aceitos');
verificar_rota($dados['nome'] === 'Rota Serra Azul', 'o nome deve ser normalizado');
verificar_rota($dados['distancia'] === '127.50', 'a distância deve usar duas casas decimais');
verificar_rota($dados['tempo'] === '02:30:00', 'o tempo deve ser preparado para o banco');
verificar_rota($dados['trens'] === [3, 7], 'IDs repetidos devem ser removidos');

[$dadosInvalidos, $errosInvalidos] = rota_validar([
    'nome' => 'A',
    'origem' => 'Joinville',
    'destino' => 'joinville',
    'distancia' => '-10',
    'tempo' => '25:00',
    'status' => 'em andamento',
    'trens' => ['1', 'inválido'],
]);
verificar_rota(count($errosInvalidos) === 6, 'todos os campos inválidos devem ser informados');
verificar_rota(isset($errosInvalidos['destino']), 'origem e destino iguais devem ser rejeitados');
verificar_rota(isset($errosInvalidos['trens']), 'um ID de trem inválido deve invalidar a seleção');
verificar_rota($dadosInvalidos['trens'] === [1], 'IDs válidos ainda devem ser normalizados');

[, $errosSemTrens] = rota_validar(array_merge($entradaValida, ['trens' => []]));
verificar_rota(isset($errosSemTrens['trens']), 'a rota deve possuir ao menos um trem');
verificar_rota(rota_id_valido(['2']) === null, 'um array não pode ser aceito como id da rota');

echo "Validação de rotas: OK\n";
