CREATE DATABASE sa_ferrorama;
USE sa_ferrorama;

CREATE TABLE trem (
    id_trem INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    tipo VARCHAR(50) NOT NULL,
    conjunto VARCHAR(100) NOT NULL,
    status VARCHAR(50) NOT NULL
);

CREATE TABLE sensor (
    id_sensor INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL, 
    localizacao VARCHAR(100) NOT NULL,
    tipo_dado VARCHAR(50) NOT NULL ,
    id_trem INT NOT NULL,
    tipo VARCHAR (200),
    conjunto VARCHAR(200),
    FOREIGN KEY (id_trem) REFERENCES trem(id_trem)
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
    senha VARCHAR(100) NOT NULL,
    cpf VARCHAR(100) NOT NULL,
    funcao ENUM('adm', 'funcionario', 'cliente'),
    status ENUM('ativo', 'inativo', 'pendente')
);

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
    distancia VARCHAR(200) NOT NULL,
    tempo TIME,
    origem VARCHAR(200) NOT NULL,
    destino VARCHAR(200) NOT NULL,
    status ENUM('disponível','indisponível'),
    id_trem INT,
    FOREIGN KEY (id_trem) REFERENCES trem(id_trem)
);
