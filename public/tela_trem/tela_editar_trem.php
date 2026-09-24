<?php
require_once __DIR__ . '/trem_funcoes.php';
include '../templates/sidebar.php';

$form = trem_pegar_formulario();
$dados = $form['dados'];
$erros = $form['erros'];
$flash = trem_flash_pegar();

$acaoForm = 'trem_cadastrar.php';
$textoBotao = 'Cadastrar Trem';
?>

<!DOCTYPE html>
<html lang="pt-BR">


    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>GordoSensores — Cadastro de Trem</title>
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="../../styles/style.css">
</head>

<body class="app-layout bg-light">

    
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
                                <p class="text-muted small">Cadastrar Novo Trem</p>
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

        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </main>

</body>

</html>
