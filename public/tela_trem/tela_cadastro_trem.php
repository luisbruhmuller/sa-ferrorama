<?php
require_once __DIR__ . '/../tela_usuario/usuarios_comum.php';
exigir_admin();
$responsaveis = mysqli_query($conn, 'SELECT id, nome, email, status FROM usuarios ORDER BY nome');
$flash = $_SESSION['trem_flash'] ?? null;
unset($_SESSION['trem_flash']);
$tipos = ['Locomotiva', 'Vagão Gôndola', 'Vagão Hopper', 'Vagão Plataforma'];
$statusTrem = ['Ativo', 'Desativado', 'Parado no Caminho'];
?>

<!DOCTYPE html>
<html lang="pt-BR">

<!-- Metadados, adaptação da página para dispositivos móveis e estilos. -->
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ferrorama — Cadastro de Trem</title>
    <!-- Bootstrap: grade responsiva e aparência de tabelas, cards e botões. -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Ícones fornecidos pelas classes bi e bi-*. -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />
    <!-- Estilos próprios, incluindo posicionamento do menu e conteúdo. -->
    <link rel="stylesheet" href="../../styles/style.css">
</head>

<body class="app-layout bg-light">
<?php include __DIR__ . '/../templates/sidebar.php'; ?>

    <!-- Área principal da tela, posicionada pela classe app-main. -->
    <main id="conteudo" class="app-main">

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
            <div class="container-fluid">
                <span class="navbar-brand fw-bold"><img src="../../assets/images/logo.ico" class="brand-logo me-2"
                        alt="">Ferrorama</span>
            </div>
        </nav>

        <div class="container-fluid py-4 px-3">
            <div class="row justify-content-center">
                <div class="col-md-5 col-lg-4">
                    <div class="card shadow">
                        <div class="card-body p-4">
                            <div class="text-center mb-4">
                                <i class="bi bi-train-front display-4 text-warning"></i>
                                <h4 class="fw-bold mt-2">Ferrorama</h4>
                                <p class="text-muted small">Cadastrar Novo Trem</p>
                            </div>

                            <?php if ($flash): ?>
                                <div class="alert alert-<?= escapar($flash[1]) ?>" role="alert">
                                    <?= escapar($flash[0]) ?></div>
                            <?php endif; ?>

                            <form method="post" action="trem_cadastrar.php">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold" for="nome">Nome do Trem</label>
                                    <div class="input-group"><span class="input-group-text"><i class="bi bi-tag"></i></span><input type="text" class="form-control" id="nome" name="nome" placeholder="Ex: Union Pacific" maxlength="100" required></div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold" for="tipo">Tipo de Trem</label>
                                    <div class="input-group"><span class="input-group-text"><i class="bi bi-train-front"></i></span><select class="form-select" id="tipo" name="tipo" required><option value="">Selecione o tipo...</option><?php foreach ($tipos as $opcao): ?><option value="<?= escapar($opcao) ?>"><?= escapar($opcao) ?></option><?php endforeach; ?></select></div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold" for="status">Status</label>
                                    <div class="input-group"><span class="input-group-text"><i class="bi bi-activity"></i></span><select class="form-select" id="status" name="status" required><option value="">Selecione o status...</option><?php foreach ($statusTrem as $opcao): ?><option value="<?= escapar($opcao) ?>"><?= escapar($opcao) ?></option><?php endforeach; ?></select></div>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label fw-semibold" for="conjunto">Conjunto</label>
                                    <div class="input-group"><span class="input-group-text"><i class="bi bi-diagram-3"></i></span><input type="text" class="form-control" id="conjunto" name="conjunto" placeholder="Ex: TRN-04-group" maxlength="100" required></div>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label fw-semibold" for="id_responsavel">Usuário Responsável</label>
                                    <div class="input-group"><span class="input-group-text"><i class="bi bi-person-badge"></i></span><select class="form-select" id="id_responsavel" name="id_responsavel" required><option value="">Selecione o responsável...</option><?php while ($responsavel = mysqli_fetch_assoc($responsaveis)): ?><option value="<?= (int) $responsavel['id'] ?>"><?= escapar($responsavel['nome']) ?> — <?= escapar($responsavel['email']) ?> (<?= escapar($responsavel['status']) ?>)</option><?php endwhile; ?></select></div>
                                </div>
                                <button class="btn btn-warning w-100 fw-semibold mb-3" type="submit"><i class="bi bi-check-circle-fill me-2"></i>Cadastrar Trem</button>
                            </form>
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
