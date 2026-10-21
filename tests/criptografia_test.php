<?php

require_once __DIR__ . '/../infra/criptografia.php';

function verificar_criptografia(bool $condicao, string $mensagem): void
{
    if (!$condicao) {
        throw new RuntimeException($mensagem);
    }
}

$senha = 'Senha segura 123!';
$hash = gerar_hash_senha($senha);

verificar_criptografia($hash !== $senha, 'A senha não pode ser armazenada em texto puro.');
verificar_criptografia(verificar_senha($senha, $hash), 'O hash deve validar a senha correta.');
verificar_criptografia(!verificar_senha('senha incorreta', $hash), 'O hash deve rejeitar uma senha incorreta.');
verificar_criptografia(password_get_info($hash)['algoName'] !== 'unknown', 'Um algoritmo seguro deve ser identificado.');
verificar_criptografia(!senha_precisa_novo_hash($hash), 'Um hash recém-criado não deve precisar de atualização.');

$hashAntigo = password_hash($senha, PASSWORD_BCRYPT, ['cost' => 4]);
verificar_criptografia(senha_precisa_novo_hash($hashAntigo), 'Um hash com configuração antiga deve ser atualizado.');

echo "Criptografia de senhas: OK\n";
