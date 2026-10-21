<?php
/**
 * Formulário compartilhado entre cadastro e edição.
 * Espera $acaoForm, $textoBotao, $dados, $erros, $trens e, na edição, $idRota.
 */
$trensSelecionados = array_map('intval', $dados['trens'] ?? []);
?>
<form method="post" action="<?= rota_h($acaoForm) ?>">
    <input type="hidden" name="csrf_token" value="<?= rota_h(rota_csrf_token()) ?>">
    <?php if (isset($idRota)): ?>
        <input type="hidden" name="id_rota" value="<?= (int) $idRota ?>">
    <?php endif; ?>

    <div class="mb-3">
        <label class="form-label fw-semibold" for="nome">Nome da rota</label>
        <input class="form-control <?= isset($erros['nome']) ? 'is-invalid' : '' ?>" type="text" id="nome"
            name="nome" maxlength="200" required value="<?= rota_h($dados['nome'] ?? '') ?>"
            placeholder="Ex: Serra Azul">
        <?php if (isset($erros['nome'])): ?>
            <div class="invalid-feedback"><?= rota_h($erros['nome']) ?></div>
        <?php endif; ?>
    </div>

    <div class="row g-3 mb-3">
        <div class="col-md-6">
            <label class="form-label fw-semibold" for="origem">Origem</label>
            <input class="form-control <?= isset($erros['origem']) ? 'is-invalid' : '' ?>" type="text"
                id="origem" name="origem" maxlength="200" required value="<?= rota_h($dados['origem'] ?? '') ?>">
            <?php if (isset($erros['origem'])): ?>
                <div class="invalid-feedback"><?= rota_h($erros['origem']) ?></div>
            <?php endif; ?>
        </div>
        <div class="col-md-6">
            <label class="form-label fw-semibold" for="destino">Destino</label>
            <input class="form-control <?= isset($erros['destino']) ? 'is-invalid' : '' ?>" type="text"
                id="destino" name="destino" maxlength="200" required value="<?= rota_h($dados['destino'] ?? '') ?>">
            <?php if (isset($erros['destino'])): ?>
                <div class="invalid-feedback"><?= rota_h($erros['destino']) ?></div>
            <?php endif; ?>
        </div>
    </div>

    <div class="row g-3 mb-3">
        <div class="col-md-4">
            <label class="form-label fw-semibold" for="distancia">Distância (km)</label>
            <input class="form-control <?= isset($erros['distancia']) ? 'is-invalid' : '' ?>" type="number"
                id="distancia" name="distancia" min="0.01" max="99999999.99" step="0.01" required
                value="<?= rota_h($dados['distancia'] ?? '') ?>">
            <?php if (isset($erros['distancia'])): ?>
                <div class="invalid-feedback"><?= rota_h($erros['distancia']) ?></div>
            <?php endif; ?>
        </div>
        <div class="col-md-4">
            <label class="form-label fw-semibold" for="tempo">Tempo estimado</label>
            <input class="form-control <?= isset($erros['tempo']) ? 'is-invalid' : '' ?>" type="time"
                id="tempo" name="tempo" required value="<?= rota_h(substr($dados['tempo'] ?? '', 0, 5)) ?>">
            <?php if (isset($erros['tempo'])): ?>
                <div class="invalid-feedback"><?= rota_h($erros['tempo']) ?></div>
            <?php endif; ?>
        </div>
        <div class="col-md-4">
            <label class="form-label fw-semibold" for="status">Status</label>
            <select class="form-select <?= isset($erros['status']) ? 'is-invalid' : '' ?>" id="status" name="status" required>
                <?php foreach (ROTA_STATUS as $status): ?>
                    <option value="<?= rota_h($status) ?>" <?= ($dados['status'] ?? 'disponível') === $status ? 'selected' : '' ?>>
                        <?= rota_h(ucfirst($status)) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <?php if (isset($erros['status'])): ?>
                <div class="invalid-feedback"><?= rota_h($erros['status']) ?></div>
            <?php endif; ?>
        </div>
    </div>

    <fieldset class="mb-4">
        <legend class="form-label fw-semibold fs-6">Trens associados</legend>
        <div class="border rounded p-3 <?= isset($erros['trens']) ? 'border-danger' : '' ?>">
            <?php if (!$trens): ?>
                <span class="text-warning">Nenhum trem cadastrado.</span>
            <?php endif; ?>
            <div class="row g-2">
                <?php foreach ($trens as $trem): ?>
                    <div class="col-md-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="trens[]"
                                id="trem_<?= (int) $trem['id_trem'] ?>" value="<?= (int) $trem['id_trem'] ?>"
                                <?= in_array((int) $trem['id_trem'], $trensSelecionados, true) ? 'checked' : '' ?>>
                            <label class="form-check-label" for="trem_<?= (int) $trem['id_trem'] ?>">
                                <?= rota_h($trem['nome']) ?>
                                <small class="text-muted">(<?= rota_h($trem['status']) ?>)</small>
                            </label>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php if (isset($erros['trens'])): ?>
            <div class="text-danger small mt-1"><?= rota_h($erros['trens']) ?></div>
        <?php endif; ?>
    </fieldset>

    <button class="btn btn-warning w-100 fw-semibold" type="submit" <?= !$trens ? 'disabled' : '' ?>>
        <i class="bi bi-check-circle-fill me-2"></i><?= rota_h($textoBotao) ?>
    </button>
</form>
