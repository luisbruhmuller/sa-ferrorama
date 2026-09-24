<?php
require_once __DIR__ . '/trem_funcoes.php';
include '../templates/sidebar.php';
/**
 * Listagem de trens (Read): consulta o banco, exibe as mensagens de retorno
 * e oferece os botões de edição e exclusão de cada registro.
 */
$flash = trem_flash_pegar();
$trens = [];
$erroConsulta = false;

try {
    // Consulta fixa, sem dados vindos do usuário.
    $resultado = $conexao->query('SELECT id_trem, nome, tipo, status, conjunto FROM trem ORDER BY id_trem');
    $trens = $resultado->fetch_all(MYSQLI_ASSOC);
} catch (mysqli_sql_exception $ex) {
    error_log('Erro ao listar trens: ' . $ex->getMessage());
    $erroConsulta = true;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<!-- Metadados, adaptação da página para dispositivos móveis e estilos. -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GordoSensores — Trens</title>
    <!-- Bootstrap: grade responsiva e aparência de tabelas, cards e botões. -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Ícones fornecidos pelas classes bi e bi-*. -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />
    <!-- Estilos próprios, incluindo posicionamento do menu e conteúdo. -->
    <link rel="stylesheet" href="../../styles/style.css">
</head>

<body class="app-layout bg-light">

    <main id="conteudo" class="app-main">

        <div class="row g-0 border rounded shadow overflow-hidden" style="min-height:900px">
            <div class="col bg-light">
                <div class="d-flex align-items-center justify-content-between px-4 py-2 bg-white border-bottom shadow-sm">
                    <h6 class="mb-0 fw-bold"><i class="bi bi-train-front me-2" style="color: #0b3d91;"></i>Trens</h6>
                    <div class="d-flex align-items-center gap-3">
                        <span class="badge bg-success"><i class="bi bi-circle-fill me-1" style="font-size:8px"></i>Sistema
                            Online</span>
                        <a href="tela_trem.php" class="btn btn-sm btn-outline-secondary" title="Atualizar lista"><i
                                class="bi bi-arrow-clockwise"></i></a>
                    </div>
                </div>

                <div class="p-4 bg-light flex-grow-1">
                    <?php if ($flash): ?>
                        <div class="alert alert-<?= trem_h($flash['tipo']) ?> alert-dismissible fade show" role="alert">
                            <?= trem_h($flash['mensagem']) ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
                        </div>
                    <?php endif; ?>

                    <?php if ($erroConsulta): ?>
                        <div class="alert alert-danger" role="alert">Não foi possível carregar a lista de trens.</div>
                    <?php endif; ?>

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="mb-0 text-secondary fw-normal">Lista de Trens Cadastrados</h5>
                        <a href="tela_cadastro_trem.php" class="btn text-white" style="background-color: #0b3d91;">
                            <i class="bi bi-plus-circle-fill me-2"></i>Novo Trem</a>
                    </div>

                    <div class="card shadow-sm border-0 rounded-3">
                        <div class="card-body p-0">
                            <!-- Contêiner que permite rolagem horizontal da tabela em telas estreitas. -->
                            <div class="table-responsive">
                                <table class="table table-hover table-striped mb-0 align-middle">
                                    <!-- Cabeçalho que define o significado e a ordem das colunas. -->
                                    <thead class="table-dark">
                                        <tr>
                                            <th scope="col" class="ps-4 py-3 rounded-top-start">ID</th>
                                            <th scope="col" class="py-3">Nome do Trem</th>
                                            <th scope="col" class="py-3">Tipo de Trem</th>
                                            <th scope="col" class="py-3">Status</th>
                                            <th scope="col" class="py-3">Conjunto</th>
                                            <th scope="col" class="text-end pe-4 py-3 rounded-top-end">Ações</th>
                                        </tr>
                                    </thead>
                                    <!-- Uma linha para cada trem retornado pelo banco. -->
                                    <tbody>
                                        <?php if (!$trens): ?>
                                            <tr>
                                                <td colspan="6" class="text-center text-muted py-4">Nenhum trem cadastrado.</td>
                                            </tr>
                                        <?php endif; ?>

                                        <?php foreach ($trens as $trem): ?>
                                            <tr>
                                                <th scope="row" class="ps-4"><?= trem_h(str_pad($trem['id_trem'], 2, '0', STR_PAD_LEFT)) ?></th>
                                                <td class="fw-medium"><?= trem_h($trem['nome']) ?></td>
                                                <td><?= trem_h($trem['tipo']) ?></td>
                                                <td>
                                                    <span class="badge <?= trem_classe_status($trem['status']) ?> bg-opacity-75 fw-normal px-2 py-1">
                                                        <?= trem_h($trem['status']) ?></span>
                                                </td>
                                                <td class="text-muted"><?= trem_h($trem['conjunto']) ?></td>
                                                <td class="text-end pe-4">
                                                    <a href="tela_editar_trem.php?id=<?= (int) $trem['id_trem'] ?>"
                                                        class="btn btn-sm btn-outline-secondary me-1" title="Editar">
                                                        <i class="bi bi-pencil"></i></a>
                                                    <button type="button" class="btn btn-sm btn-outline-danger" title="Excluir"
                                                        data-bs-toggle="modal" data-bs-target="#modalExcluir"
                                                        data-id="<?= (int) $trem['id_trem'] ?>"
                                                        data-nome="<?= trem_h($trem['nome']) ?>">
                                                        <i class="bi bi-trash"></i></button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Confirmação de exclusão: o formulário envia o id por POST para trem_excluir.php. -->
        <div class="modal fade" id="modalExcluir" tabindex="-1" aria-labelledby="tituloModalExcluir" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <form class="modal-content" method="post" action="trem_excluir.php">
                    <input type="hidden" name="csrf_token" value="<?= trem_h(trem_csrf_token()) ?>">
                    <input type="hidden" name="id_trem" id="excluir_id" value="">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tituloModalExcluir">Excluir trem</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                    </div>
                    <div class="modal-body">
                        Tem certeza que deseja excluir o trem <strong id="excluir_nome"></strong>?
                        Esta ação não pode ser desfeita.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger"><i class="bi bi-trash me-1"></i>Excluir</button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <!-- Habilita componentes interativos do Bootstrap, como o modal de confirmação. -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Ao abrir o modal, copia o id e o nome do trem clicado para o formulário de exclusão.
        document.getElementById('modalExcluir').addEventListener('show.bs.modal', function (evento) {
            var botao = evento.relatedTarget;
            document.getElementById('excluir_id').value = botao.getAttribute('data-id');
            document.getElementById('excluir_nome').textContent = botao.getAttribute('data-nome');
        });
    </script>

</body>

</html>
