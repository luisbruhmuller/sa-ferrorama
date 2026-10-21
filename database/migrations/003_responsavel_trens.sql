-- Execute uma vez em bancos criados com a versão anterior de database/db.sql.
-- Faça backup antes de aplicar esta migração.

USE sa_ferrorama;

ALTER TABLE trens
    CHANGE COLUMN id id_trem INT NOT NULL AUTO_INCREMENT,
    CHANGE COLUMN nome_trem nome VARCHAR(100) NOT NULL,
    CHANGE COLUMN tipo_trem tipo VARCHAR(100) NOT NULL,
    ADD COLUMN id_responsavel INT NULL AFTER conjunto;

ALTER TABLE trens
    ADD CONSTRAINT fk_trens_responsavel
    FOREIGN KEY (id_responsavel) REFERENCES usuarios(id)
    ON UPDATE CASCADE
    ON DELETE SET NULL;

-- Garante que as tabelas dependentes apontem para a chave padronizada de trens.
ALTER TABLE sensor
    DROP FOREIGN KEY sensor_ibfk_1,
    ADD CONSTRAINT fk_sensor_trem
    FOREIGN KEY (id_trem) REFERENCES trens(id_trem);

ALTER TABLE rotas
    DROP FOREIGN KEY rotas_ibfk_1,
    ADD CONSTRAINT fk_rotas_trem
    FOREIGN KEY (id_trem) REFERENCES trens(id_trem);
