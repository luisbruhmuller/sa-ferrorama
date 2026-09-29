<?php

session_start();

require_once __DIR__ . '/../../infra/conexao.php';


// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome = trim($_POST['nome_sensor'] ?? '');
    $tipo = trim($_POST['tipo_sensor'] ?? '');
    $localizacao = trim($_POST['localizacao'] ?? '');
    $id_trem = (int) ($_POST['id_trem'] ?? 0);


    // Verifica se os campos foram preenchidos
    if ($nome === '' || $tipo === '' || $localizacao === '' || $id_trem <= 0) {

        $erro = "Preencha todos os campos.";

    } else {

        // Insere o sensor no banco
        $sql = "
            INSERT INTO sensor
            (
                nome,
                localizacao,
                tipo_dado,
                id_trem
            )
            VALUES (?, ?, ?, ?)
        ";

        $stmt = $conn->prepare($sql);

        if ($stmt) {

            $stmt->bind_param(
                "sssi",
                $nome,
                $localizacao,
                $tipo,
                $id_trem
            );

            if ($stmt->execute()) {

                $_SESSION['flash'] = [
                    'tipo' => 'success',
                    'mensagem' => 'Sensor cadastrado com sucesso!'
                ];

                $stmt->close();

                header("Location: tela_sensores.php");
                exit;

            } else {

                $erro = "Erro ao cadastrar o sensor: " . $stmt->error;

            }

            $stmt->close();

        } else {

            $erro = "Erro ao preparar o cadastro: " . $conn->error;

        }
    }
}


// Busca os trens cadastrados
$sqlTrens = "
    SELECT id_trem, modelo
    FROM trem
    ORDER BY id_trem ASC
";

$resultadoTrens = $conn->query($sqlTrens);

?>

<!DOCTYPE html>

<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>GordoSensores — Cadastro de Sensor</title>


    <!-- Bootstrap -->

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >


    <!-- Bootstrap Icons -->

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
        rel="stylesheet"
    >


    <!-- CSS do projeto -->

    <link
        rel="stylesheet"
        href="../../styles/style.css"
    >

</head>


<body class="app-layout bg-light">


<?php include '../templates/sidebar.php'; ?>


<main
    id="conteudo"
    class="app-main"
>


    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">

        <div class="container-fluid">

            <span class="navbar-brand fw-bold">

                <img
                    src="../../assets/images/logo.ico"
                    class="brand-logo me-2"
                    alt="Gordo Holding"
                >

                GordoSensores

            </span>

        </div>

    </nav>


    <div class="container-fluid py-4 px-3">


        <div class="row justify-content-center">

            <div class="col-md-6 col-lg-5">


                <div class="card shadow">


                    <div class="card-body p-4">


                        <!-- Título -->

                        <div class="text-center mb-4">

                            <i class="bi bi-cpu display-4 text-warning"></i>

                            <h4 class="fw-bold mt-2">
                                GordoSensores
                            </h4>

                            <p class="text-muted small">
                                Cadastrar Novo Sensor IoT
                            </p>

                        </div>


                        <!-- Mensagem de erro -->

                        <?php if (isset($erro)): ?>

                            <div
                                class="alert alert-danger"
                                role="alert"
                            >

                                <?= htmlspecialchars($erro) ?>

                            </div>

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

                                                    <?= htmlspecialchars($trem['modelo']) ?>

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


                <!-- Voltar -->

                <div class="text-center mt-3">

                    <a
                        href="tela_sensores.php"
                        class="btn btn-secondary"
                    >

                        <i class="bi bi-arrow-left me-2"></i>

                        Voltar

                    </a>

                </div>


            </div>

        </div>


    </div>


</main>


<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
></script>


</body>

</html>