-- Permite associar uma rota a mais de um trem sem perder os vínculos existentes.
-- Execute este arquivo uma vez em bancos criados antes desta revisão.

START TRANSACTION;

CREATE TABLE IF NOT EXISTS rota_trens (
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

INSERT IGNORE INTO rota_trens (id_rota, id_trem)
SELECT id, id_trem
FROM rotas
WHERE id_trem IS NOT NULL;

ALTER TABLE rotas DROP FOREIGN KEY rotas_ibfk_1;
ALTER TABLE rotas DROP COLUMN id_trem;
ALTER TABLE rotas MODIFY distancia DECIMAL(10,2) NOT NULL;
ALTER TABLE rotas MODIFY tempo TIME NOT NULL;
ALTER TABLE rotas MODIFY status ENUM('disponível','indisponível') NOT NULL DEFAULT 'disponível';

COMMIT;
