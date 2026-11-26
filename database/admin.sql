-- Arquivo legado mantido para compatibilidade com referências antigas.
-- Para criar contas fictícias de demonstração, execute:
-- php scripts/preparar_demo.php

USE sa_ferrorama;


INSERT INTO usuarios (nome, email, senha, cpf, funcao, status)
VALUES (
    'Administrador Teste',
    'admin@teste.com',
    '$2y$10$FgMmorsNtep.CtAHNLjskOktOZpxRGlS0WWTglqRYuENvoOZmtMjq',
    '52998224725',
    'adm',
    'ativo'
);