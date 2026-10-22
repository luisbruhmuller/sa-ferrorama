<?php
/**
 * Campos do formulário de trem, compartilhados entre cadastro e edição.
 * Variáveis esperadas: $acaoForm (arquivo que processa o POST), $textoBotao,
 * $dados (valores atuais), $erros (mensagens por campo) e $idTrem (apenas na edição).
 */
?>
<form method="post" action="<?= trem_h($acaoForm) ?>">
    <input type="hidden" name="csrf_token" value="<?= trem_h(trem_csrf_token()) ?>">
    <?php if (isset($idTrem)): ?>
        <input type="hidden" name="id_trem" value="<?= (int) $idTrem ?>">
    <?php endif; ?>

    <div class="mb-3">
        <label class="form-label fw-semibold" for="nome">Nome do Trem</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-tag"></i></span>
            <input type="text" class="form-control <?= isset($erros['nome']) ? 'is-invalid' : '' ?>" id="nome" name="nome"
                placeholder="Ex: Union Pacific" maxlength="100" required
                value="<?= trem_h($dados['nome'] ?? '') ?>">
        </div>
        <?php if (isset($erros['nome'])): ?>
            <div class="invalid-feedback d-block"><?= trem_h($erros['nome']) ?></div>
        <?php endif; ?>
    </div>

    <div class="mb-3">
        <label class="form-label fw-semibold" for="tipo">Tipo de Trem</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-train-front"></i></span>
            <select class="form-select <?= isset($erros['tipo']) ? 'is-invalid' : '' ?>" id="tipo" name="tipo" required>
                <option value="" disabled <?= empty($dados['tipo']) ? 'selected' : '' ?>>Selecione o tipo...</option>
                <?php foreach (TREM_TIPOS as $opcao): ?>
                    <option value="<?= trem_h($opcao) ?>" <?= ($dados['tipo'] ?? '') === $opcao ? 'selected' : '' ?>>
                        <?= trem_h($opcao) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <?php if (isset($erros['tipo'])): ?>
            <div class="invalid-feedback d-block"><?= trem_h($erros['tipo']) ?></div>
        <?php endif; ?>
    </div>

    <div class="mb-3">
        <label class="form-label fw-semibold" for="status">Status</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-activity"></i></span>
            <select class="form-select <?= isset($erros['status']) ? 'is-invalid' : '' ?>" id="status" name="status" required>
                <option value="" disabled <?= empty($dados['status']) ? 'selected' : '' ?>>Selecione o status...</option>
                <?php foreach (TREM_STATUS as $opcao): ?>
                    <option value="<?= trem_h($opcao) ?>" <?= ($dados['status'] ?? '') === $opcao ? 'selected' : '' ?>>
                        <?= trem_h($opcao) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <?php if (isset($erros['status'])): ?>
            <div class="invalid-feedback d-block"><?= trem_h($erros['status']) ?></div>
        <?php endif; ?>
    </div>

    <div class="mb-4">
        <label class="form-label fw-semibold" for="conjunto">Conjunto</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-diagram-3"></i></span>
            <input type="text" class="form-control <?= isset($erros['conjunto']) ? 'is-invalid' : '' ?>" id="conjunto"
                name="conjunto" placeholder="Ex: TRN-04-group" maxlength="100" required
                value="<?= trem_h($dados['conjunto'] ?? '') ?>">
        </div>
        <?php if (isset($erros['conjunto'])): ?>
            <div class="invalid-feedback d-block"><?= trem_h($erros['conjunto']) ?></div>
        <?php endif; ?>
    </div>

    <div class="mb-4">
        <label class="form-label fw-semibold" for="id_responsavel">Usuário Responsável</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-person-badge"></i></span>
            <select class="form-select <?= isset($erros['id_responsavel']) ? 'is-invalid' : '' ?>"
                id="id_responsavel" name="id_responsavel" required>
                <option value="" disabled <?= empty($dados['id_responsavel']) ? 'selected' : '' ?>>
                    Selecione o responsável...
                </option>
                <?php foreach ($responsaveis as $responsavel): ?>
                    <option value="<?= (int) $responsavel['id'] ?>"
                        <?= (int) ($dados['id_responsavel'] ?? 0) === (int) $responsavel['id'] ? 'selected' : '' ?>>
                        <?= trem_h($responsavel['nome']) ?> — <?= trem_h($responsavel['email']) ?>
                        (<?= trem_h($responsavel['status']) ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <?php if (!$responsaveis): ?>
            <div class="form-text text-warning">Cadastre um usuário antes de associar um trem.</div>
        <?php endif; ?>
        <?php if (isset($erros['id_responsavel'])): ?>
            <div class="invalid-feedback d-block"><?= trem_h($erros['id_responsavel']) ?></div>
        <?php endif; ?>
    </div>

    <button class="btn btn-warning w-100 fw-semibold mb-3" type="submit" <?= !$responsaveis ? 'disabled' : '' ?>>
        <i class="bi bi-check-circle-fill me-2"></i><?= trem_h($textoBotao) ?>
    </button>
</form>
