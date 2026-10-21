<?php

require_once __DIR__ . '/../infra/validacao_trem.php';

function verificar(bool $condicao, string $mensagem): void
{
    if (!$condicao) {
        fwrite(STDERR, "FALHOU: {$mensagem}\n");
        exit(1);
    }
}

$entradaValida = [
    'nome' => '  Serra Azul  ',
    'tipo' => 'Locomotiva',
    'status' => 'Ativo',
    'conjunto' => 'TRN-01',
    'id_responsavel' => '7',
];

[$dados, $erros] = trem_validar($entradaValida);
verificar($erros === [], 'dados válidos devem ser aceitos');
verificar($dados['nome'] === 'Serra Azul', 'o nome deve ser normalizado');
verificar($dados['id_responsavel'] === 7, 'o responsável deve ser convertido para inteiro');

[$dadosSemResponsavel, $errosSemResponsavel] = trem_validar(array_merge(
    $entradaValida,
    ['id_responsavel' => 'usuario-inexistente']
));
verificar($dadosSemResponsavel['id_responsavel'] === null, 'responsável inválido deve ser descartado');
verificar(isset($errosSemResponsavel['id_responsavel']), 'responsável inválido deve gerar erro');

[$dadosInvalidos, $errosInvalidos] = trem_validar([
    'nome' => 'A',
    'tipo' => 'Avião',
    'status' => 'Voando',
    'conjunto' => 'TRN@01',
    'id_responsavel' => 0,
]);
verificar(count($errosInvalidos) === 5, 'todos os campos inválidos devem ser informados');
verificar($dadosInvalidos['id_responsavel'] === null, 'id zero não deve ser aceito');

verificar(trem_id_valido(['7']) === null, 'um array não pode ser aceito como id');

echo "Validação de trens: OK\n";
