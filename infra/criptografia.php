<?php

function gerar_hash_senha(string $senha): string
{
    return password_hash($senha, PASSWORD_DEFAULT);
}

function verificar_senha(string $senha, string $hash): bool
{
    return password_verify($senha, $hash);
}
