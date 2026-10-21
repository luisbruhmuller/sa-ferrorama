<?php

function gerar_hash_senha(string $senha): string
{
    return password_hash($senha, PASSWORD_DEFAULT);
}

function verificar_senha(string $senha, string $hash): bool
{
    return password_verify($senha, $hash);
}

function senha_precisa_novo_hash(string $hash): bool
{
    return password_needs_rehash($hash, PASSWORD_DEFAULT);
}
