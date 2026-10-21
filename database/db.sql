CREATE DATABASE sa_ferrorama;
USE sa_ferrorama;

CREATE TABLE trens (
    id_trem INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    tipo VARCHAR(100) NOT NULL,
    status VARCHAR(50) NOT NULL,
    conjunto VARCHAR(100) NOT NULL,
    id_responsavel INT NULL
);

CREATE TABLE sensor (
    id_sensor INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL, 
    localizacao VARCHAR(100) NOT NULL,
    tipo_dado VARCHAR(50) NOT NULL ,
    id_trem INT NOT NULL,
    tipo VARCHAR (200),
    conjunto VARCHAR(200),
    FOREIGN KEY (id_trem) REFERENCES trens(id_trem)
);

CREATE TABLE dados_sensor (
    id_dado INT PRIMARY KEY AUTO_INCREMENT,
    valor DECIMAL(10,2),
    data_hora DATETIME,
    id_sensor INT,
    FOREIGN KEY (id_sensor) REFERENCES sensor(id_sensor)
);

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(200) NOT NULL,
    email VARCHAR(200) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    cpf VARCHAR(100) NOT NULL,
    funcao ENUM('adm', 'tecnico', 'funcionario'),
    status ENUM('ativo', 'inativo', 'pendente')
);

ALTER TABLE trens
    ADD CONSTRAINT fk_trens_responsavel
    FOREIGN KEY (id_responsavel) REFERENCES usuarios(id)
    ON UPDATE CASCADE
    ON DELETE SET NULL;

CREATE TABLE relatorio (
    id_relatorio INT PRIMARY KEY AUTO_INCREMENT,
    titulo VARCHAR(100),
    data_geracao DATE,
    id_usuario INT,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id)
);

CREATE TABLE rotas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(200) NOT NULL,
    distancia DECIMAL(10,2) NOT NULL,
    tempo TIME NOT NULL,
    origem VARCHAR(200) NOT NULL,
    destino VARCHAR(200) NOT NULL,
    status ENUM('disponível','indisponível') NOT NULL DEFAULT 'disponível'
);

CREATE TABLE rota_trens (
    id_rota INT NOT NULL,
    id_trem INT NOT NULL,
    PRIMARY KEY (id_rota, id_trem),
    CONSTRAINT fk_rota_trens_rota
        FOREIGN KEY (id_rota) REFERENCES rotas(id)
        ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT fk_rota_trens_trem
        FOREIGN KEY (id_trem) REFERENCES trens(id_trem)
        ON UPDATE CASCADE ON DELETE RESTRICT
);
