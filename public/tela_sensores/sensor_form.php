<?php
/** Formulário compartilhado de cadastro e edição de sensores. */
?>
<form method="post" action="<?= sensor_h($acaoForm) ?>">
    <input type="hidden" name="csrf_token" value="<?= sensor_h(sensor_csrf_token()) ?>">
    <?php if (isset($idSensor)): ?>
        <input type="hidden" name="id_sensor" value="<?= (int) $idSensor ?>">
    <?php endif; ?>

    <div class="mb-3">
        <label class="form-label fw-semibold" for="nome">Nome / Código do Sensor</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-tag"></i></span>
            <input type="text" class="form-control <?= isset($erros['nome']) ? 'is-invalid' : '' ?>"
                id="nome" name="nome" maxlength="100" required placeholder="Ex: Sensor TMP-01"
                value="<?= sensor_h($dados['nome'] ?? '') ?>">
        </div>
        <?php if (isset($erros['nome'])): ?>
            <div class="invalid-feedback d-block"><?= sensor_h($erros['nome']) ?></div>
        <?php endif; ?>
    </div>

    <div class="mb-3">
        <label class="form-label fw-semibold" for="tipo_dado">Tipo de Sensor</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-activity"></i></span>
            <select class="form-select <?= isset($erros['tipo_dado']) ? 'is-invalid' : '' ?>"
                id="tipo_dado" name="tipo_dado" required>
                <option value="" disabled <?= empty($dados['tipo_dado']) ? 'selected' : '' ?>>Selecione o tipo...</option>
                <?php foreach (SENSOR_TIPOS_DADO as $opcao): ?>
                    <option value="<?= sensor_h($opcao) ?>" <?= ($dados['tipo_dado'] ?? '') === $opcao ? 'selected' : '' ?>>
                        <?= sensor_h($opcao) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <?php if (isset($erros['tipo_dado'])): ?>
            <div class="invalid-feedback d-block"><?= sensor_h($erros['tipo_dado']) ?></div>
        <?php endif; ?>
    </div>

    <div class="mb-3">
        <label class="form-label fw-semibold" for="id_trem">Trem Vinculado</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-train-front"></i></span>
            <select class="form-select <?= isset($erros['id_trem']) ? 'is-invalid' : '' ?>"
                id="id_trem" name="id_trem" required>
                <option value="" disabled <?= empty($dados['id_trem']) ? 'selected' : '' ?>>Selecione o trem...</option>
                <?php foreach ($trens as $trem): ?>
                    <option value="<?= (int) $trem['id_trem'] ?>"
                        <?= (int) ($dados['id_trem'] ?? 0) === (int) $trem['id_trem'] ? 'selected' : '' ?>>
                        <?= sensor_h($trem['nome']) ?> (<?= sensor_h($trem['status']) ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <?php if (!$trens): ?>
            <div class="form-text text-warning">Cadastre um trem antes de associar um sensor.</div>
        <?php endif; ?>
        <?php if (isset($erros['id_trem'])): ?>
            <div class="invalid-feedback d-block"><?= sensor_h($erros['id_trem']) ?></div>
        <?php endif; ?>
    </div>

    <div class="mb-3">
        <label class="form-label fw-semibold" for="conjunto">Subsistema Vinculado</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-diagram-3"></i></span>
            <select class="form-select <?= isset($erros['conjunto']) ? 'is-invalid' : '' ?>"
                id="conjunto" name="conjunto" required>
                <option value="" disabled <?= empty($dados['conjunto']) ? 'selected' : '' ?>>Selecione o subsistema...</option>
                <?php foreach (SENSOR_CONJUNTOS as $opcao): ?>
                    <option value="<?= sensor_h($opcao) ?>" <?= ($dados['conjunto'] ?? '') === $opcao ? 'selected' : '' ?>>
                        <?= sensor_h($opcao) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <?php if (isset($erros['conjunto'])): ?>
            <div class="invalid-feedback d-block"><?= sensor_h($erros['conjunto']) ?></div>
        <?php endif; ?>
    </div>

    <div class="mb-3">
        <label class="form-label fw-semibold" for="localizacao">Local de Instalação</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
            <input type="text" class="form-control <?= isset($erros['localizacao']) ? 'is-invalid' : '' ?>"
                id="localizacao" name="localizacao" maxlength="100" required
                placeholder="Ex: Vagão 1 / Roda Dianteira" value="<?= sensor_h($dados['localizacao'] ?? '') ?>">
        </div>
        <?php if (isset($erros['localizacao'])): ?>
            <div class="invalid-feedback d-block"><?= sensor_h($erros['localizacao']) ?></div>
        <?php endif; ?>
    </div>

    <div class="mb-4">
        <label class="form-label fw-semibold" for="tipo">Status</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-broadcast"></i></span>
            <select class="form-select <?= isset($erros['tipo']) ? 'is-invalid' : '' ?>" id="tipo" name="tipo" required>
                <?php foreach (SENSOR_STATUS as $opcao): ?>
                    <option value="<?= sensor_h($opcao) ?>" <?= ($dados['tipo'] ?? 'Ativo') === $opcao ? 'selected' : '' ?>>
                        <?= sensor_h($opcao) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <?php if (isset($erros['tipo'])): ?>
            <div class="invalid-feedback d-block"><?= sensor_h($erros['tipo']) ?></div>
        <?php endif; ?>
    </div>

    <button class="btn btn-warning w-100 fw-semibold mb-3" type="submit" <?= !$trens ? 'disabled' : '' ?>>
        <i class="bi bi-check-circle-fill me-2"></i><?= sensor_h($textoBotao) ?>
    </button>
</form>
