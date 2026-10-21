<?php
require_once __DIR__ . '/sensor_funcoes.php';
include '../templates/sidebar.php';

$form = sensor_pegar_formulario();
$dados = $form['dados'];
$dados['tipo'] = $dados['tipo'] ?? 'Ativo';
$erros = $form['erros'];
$flash = sensor_flash_pegar();
$trens = [];

try {
    $trens = sensor_listar_trens($conexao);
} catch (mysqli_sql_exception $ex) {
    error_log('Erro ao listar trens no cadastro de sensor: ' . $ex->getMessage());
    $flash = ['tipo' => 'danger', 'mensagem' => 'Não foi possível carregar os trens.'];
}


// Busca os trens cadastrados
$sqlTrens = "
    SELECT id_trem, nome
    FROM trens
    ORDER BY id_trem ASC
";

$resultadoTrens = $conn->query($sqlTrens);

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GordoSensores — Cadastro de Sensor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
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
            <div class="col-md-6 col-lg-5">
                <div class="card shadow">
                    <div class="card-body p-4">
                        <div class="text-center mb-4">
                            <i class="bi bi-cpu display-4 text-warning"></i>
                            <h4 class="fw-bold mt-2">GordoSensores</h4>
                            <p class="text-muted small">Cadastrar Novo Sensor IoT</p>
                        </div>
                        <?php if ($flash): ?>
                            <div class="alert alert-<?= sensor_h($flash['tipo']) ?>" role="alert">
                                <?= sensor_h($flash['mensagem']) ?></div>
                        <?php endif; ?>


                        <!-- FORMULÁRIO -->

                        <form
                            method="POST"
                            action=""
                        >


                            <!-- Nome -->

                            <div class="mb-3">

                                <label
                                    class="form-label fw-semibold"
                                >
                                    Nome / Código do Sensor
                                </label>


                                <div class="input-group">

                                    <span class="input-group-text">

                                        <i class="bi bi-tag"></i>

                                    </span>


                                    <input
                                        type="text"
                                        name="nome_sensor"
                                        class="form-control"
                                        placeholder="Ex: Sensor TMP-01"
                                        required
                                    >

                                </div>

                            </div>


                            <!-- Tipo -->

                            <div class="mb-3">

                                <label
                                    class="form-label fw-semibold"
                                >
                                    Tipo de Sensor
                                </label>


                                <div class="input-group">

                                    <span class="input-group-text">

                                        <i class="bi bi-activity"></i>

                                    </span>


                                    <select
                                        name="tipo_sensor"
                                        class="form-select"
                                        required
                                    >

                                        <option
                                            value=""
                                            selected
                                            disabled
                                        >
                                            Selecione o tipo...
                                        </option>


                                        <option value="Temperatura">
                                            Temperatura
                                        </option>


                                        <option value="Vibração">
                                            Vibração
                                        </option>


                                        <option value="Consumo de Energia">
                                            Consumo de Energia
                                        </option>


                                        <option value="Velocidade">
                                            Velocidade
                                        </option>

                                    </select>

                                </div>

                            </div>


                            <!-- Trem -->

                            <div class="mb-3">

                                <label
                                    class="form-label fw-semibold"
                                >
                                    Trem Vinculado
                                </label>


                                <div class="input-group">

                                    <span class="input-group-text">

                                        <i class="bi bi-train-front"></i>

                                    </span>


                                    <select
                                        name="id_trem"
                                        class="form-select"
                                        required
                                    >

                                        <option
                                            value=""
                                            selected
                                            disabled
                                        >
                                            Selecione o trem...
                                        </option>


                                        <?php if ($resultadoTrens && $resultadoTrens->num_rows > 0): ?>


                                            <?php while ($trem = $resultadoTrens->fetch_assoc()): ?>

                                                <option
                                                    value="<?= (int) $trem['id_trem'] ?>"
                                                >

                                                    <?= htmlspecialchars($trem['nome'], ENT_QUOTES, 'UTF-8') ?>

                                                </option>

                                            <?php endwhile; ?>


                                        <?php else: ?>

                                            <option
                                                value=""
                                                disabled
                                            >
                                                Nenhum trem cadastrado
                                            </option>

                                        <?php endif; ?>

                                    </select>

                                </div>

                            </div>


                            <!-- Localização -->

                            <div class="mb-3">

                                <label
                                    class="form-label fw-semibold"
                                >
                                    Local de Instalação
                                </label>


                                <div class="input-group">

                                    <span class="input-group-text">

                                        <i class="bi bi-geo-alt"></i>

                                    </span>


                                    <input
                                        type="text"
                                        name="localizacao"
                                        class="form-control"
                                        placeholder="Ex: Vagão 1 / Roda Dianteira"
                                        required
                                    >

                                </div>

                            </div>


                            <!-- Botão -->

                            <button
                                type="submit"
                                class="btn btn-warning w-100 fw-semibold mb-3"
                            >

                                <i class="bi bi-plus-circle-fill me-2"></i>

                                Cadastrar Sensor

                            </button>


                        </form>


                    </div>
                </div>
                <div class="text-center mt-3">
                    <a href="tela_sensores.php" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Voltar</a>
                </div>
            </div>
        </div>
    </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
