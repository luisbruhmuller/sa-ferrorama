-- Esquema completo do banco: importe este arquivo para uma instalação nova.
-- Se as tabelas já existirem, este arquivo não altera nem substitui sua estrutura.
CREATE DATABASE IF NOT EXISTS sa_ferrorama
    CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE sa_ferrorama;
SET NAMES utf8mb4;
SET default_storage_engine = InnoDB;

CREATE TABLE trens (
    id_trem INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    tipo VARCHAR(100) NOT NULL,
    status VARCHAR(50) NOT NULL,
    conjunto VARCHAR(100) NOT NULL,
    id_responsavel INT NULL
);

CREATE TABLE sensor (
    id_sensor INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    localizacao VARCHAR(100) NOT NULL,
    tipo_dado VARCHAR(50) NOT NULL,
    id_trem INT NOT NULL,
    tipo ENUM('Ativo', 'Inativo', 'Com falha') NOT NULL DEFAULT 'Ativo',
    conjunto VARCHAR(100) NOT NULL,
    CONSTRAINT uq_sensor_nome UNIQUE (nome),
    CONSTRAINT fk_sensor_trem FOREIGN KEY (id_trem) REFERENCES trens(id_trem)
        ON UPDATE CASCADE ON DELETE RESTRICT
);

CREATE TABLE dados_sensor (
    id_dado INT AUTO_INCREMENT PRIMARY KEY,
    valor DECIMAL(10,2),
    data_hora DATETIME,
    id_sensor INT NOT NULL,
    CONSTRAINT fk_dados_sensor_sensor FOREIGN KEY (id_sensor) REFERENCES sensor(id_sensor)
        ON UPDATE CASCADE ON DELETE RESTRICT
);

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(200) NOT NULL,
    email VARCHAR(200) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    cpf CHAR(11) NOT NULL,
    funcao ENUM('adm', 'tecnico', 'funcionario') NOT NULL,
    status ENUM('ativo', 'inativo', 'pendente') NOT NULL,
    UNIQUE KEY uq_usuarios_email (email),
    UNIQUE KEY uq_usuarios_cpf (cpf)
);

ALTER TABLE trens
    ADD CONSTRAINT fk_trens_responsavel
    FOREIGN KEY (id_responsavel) REFERENCES usuarios(id)
    ON UPDATE CASCADE
    ON DELETE SET NULL;

CREATE TABLE relatorio (
    id_relatorio INT AUTO_INCREMENT PRIMARY KEY,
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
    status ENUM('disponível', 'indisponível') NOT NULL DEFAULT 'disponível'
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
