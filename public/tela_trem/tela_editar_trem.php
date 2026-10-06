<?php
require_once __DIR__ . '/trem_funcoes.php';
include '../templates/sidebar.php';
/**
 * Edição de trem (Update): carrega o registro pelo id e exibe o formulário preenchido.
 * O envio é processado por trem_editar.php.
 */
$idTrem = trem_id_valido($_GET['id'] ?? null);
$trem = $idTrem !== null ? trem_buscar($conexao, $idTrem) : null;

if ($trem === null) {
    trem_flash('danger', 'Trem não encontrado.');
    trem_redirecionar('tela_trem.php');
}

// Se a última tentativa de salvar falhou, mostra o que o usuário digitou no lugar dos dados do banco.
$form = trem_pegar_formulario();
$dados = $form['dados'] ?: $trem;
$erros = $form['erros'];
$flash = trem_flash_pegar();

$acaoForm = 'trem_editar.php';
$textoBotao = 'Salvar Alterações';
?>

<!DOCTYPE html>
<html lang="pt-BR">

<!-- Metadados, adaptação da página para dispositivos móveis e estilos. -->
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>GordoSensores — Editar Trem</title>
    <!-- Bootstrap: grade responsiva e aparência de tabelas, cards e botões. -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Ícones fornecidos pelas classes bi e bi-*. -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />
    <!-- Estilos próprios, incluindo posicionamento do menu e conteúdo. -->
    <link rel="stylesheet" href="../../styles/style.css">
</head>

<body class="app-layout bg-light">

    <!-- Área principal da tela, posicionada pela classe app-main. -->
    <main id="conteudo" class="app-main">

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
            <div class="container-fluid">
                <span class="navbar-brand fw-bold"><img src="../../assets/images/logo.ico" class="brand-logo me-2"
                        alt="Gordo Holding">GordoSensores</span>
            </div>
        </nav>

        <div class="container-fluid py-4 px-3">
            <div class="row justify-content-center">
                <div class="col-md-5 col-lg-4">
                    <div class="card shadow">
                        <div class="card-body p-4">
                            <div class="text-center mb-4">
                                <i class="bi bi-train-front display-4 text-warning"></i>
                                <h4 class="fw-bold mt-2">GordoSensores</h4>
                                <p class="text-muted small">Editar Trem #<?= (int) $trem['id_trem'] ?></p>
                            </div>

                            <?php if ($flash): ?>
                                <div class="alert alert-<?= trem_h($flash['tipo']) ?>" role="alert">
                                    <?= trem_h($flash['mensagem']) ?></div>
                            <?php endif; ?>

                            <?php include __DIR__ . '/trem_form.php'; ?>
                        </div>
                    </div>
                    <br>
                    <div class="text-center">
                        <a href="tela_trem.php" class="btn btn-secondary"><i
                                class="bi bi-arrow-left me-2"></i>Voltar</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Habilita componentes interativos do Bootstrap. -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </main>

</body>

</html>
