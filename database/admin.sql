USE sa_ferrorama;

INSERT INTO usuarios (nome, email, senha, cpf, funcao, status)
VALUES (
    'Administrador',
    'admin',
    '$2y$10$byP7A2mL8Hy/T3inML1Ws.Q5J2FW5JiZjqIVGkBki1CizYlrP8mYm',
    '00000000000',
    'adm',
    'ativo'
)
ON DUPLICATE KEY UPDATE
    nome = 'Administrador',
    senha = VALUES(senha),
    funcao = 'adm',
    status = 'ativo';
