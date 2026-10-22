-- Revisão do CRUD de sensores. Execute depois da migração 003.
-- Faça backup antes de aplicar em uma base existente.

USE sa_ferrorama;

-- Normaliza registros antigos para que os campos obrigatórios possam ser aplicados.
UPDATE sensor SET tipo = 'Ativo' WHERE tipo IS NULL OR tipo NOT IN ('Ativo', 'Inativo', 'Com falha');
UPDATE sensor SET conjunto = 'Motor' WHERE conjunto IS NULL OR TRIM(conjunto) = '';

-- Preserva sensores duplicados, tornando seus códigos únicos antes de criar a restrição.
UPDATE sensor AS s
INNER JOIN (
    SELECT nome
    FROM sensor
    GROUP BY nome
    HAVING COUNT(*) > 1
) AS duplicados ON duplicados.nome = s.nome
SET s.nome = CONCAT(LEFT(s.nome, 88), '-', s.id_sensor);

ALTER TABLE sensor
    MODIFY nome VARCHAR(100) NOT NULL,
    MODIFY localizacao VARCHAR(100) NOT NULL,
    MODIFY tipo_dado VARCHAR(50) NOT NULL,
    MODIFY id_trem INT NOT NULL,
    MODIFY tipo ENUM('Ativo','Inativo','Com falha') NOT NULL DEFAULT 'Ativo',
    MODIFY conjunto VARCHAR(100) NOT NULL,
    ADD CONSTRAINT uq_sensor_nome UNIQUE (nome);

ALTER TABLE sensor
    DROP FOREIGN KEY fk_sensor_trem,
    ADD CONSTRAINT fk_sensor_trem
        FOREIGN KEY (id_trem) REFERENCES trens(id_trem)
        ON UPDATE CASCADE ON DELETE RESTRICT;

ALTER TABLE dados_sensor
    MODIFY id_sensor INT NOT NULL,
    DROP FOREIGN KEY dados_sensor_ibfk_1,
    ADD CONSTRAINT fk_dados_sensor_sensor
        FOREIGN KEY (id_sensor) REFERENCES sensor(id_sensor)
        ON UPDATE CASCADE ON DELETE RESTRICT;
