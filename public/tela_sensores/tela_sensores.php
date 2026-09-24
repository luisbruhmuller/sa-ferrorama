<?php
/**
 * Lista fixa de sensores e modal de cadastro. cadastrarSensor() verifica campos vazios,
 * mas não persiste dados nem acrescenta registros à tabela.
 */
// Carrega o menu; o template atual também imprime sua própria estrutura HTML.
include '../templates/sidebar.php';

?>

<!DOCTYPE html>
<html lang="pt-BR">

<!-- Metadados, adaptação da página para dispositivos móveis e estilos. -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GordoSensores — Sensores</title>
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
                    <h6 class="mb-0 fw-bold"><i class="bi bi-people-fill me-2" style="color: #0b3d91;"></i>Sensores</h6>
                    <div class="d-flex align-items-center gap-3">
                        <span class="badge bg-success"><i class="bi bi-circle-fill me-1" style="font-size:8px"></i>Sistema
                            Online</span>
                        <span class="text-muted small"><i class="bi bi-clock me-1"></i>Atualizado: 14:32:07</span>
                        <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-arrow-clockwise"></i></button>
                    </div>
                </div>

            <div class="p-4 bg-light flex-grow-1">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="mb-0 text-secondary fw-normal">Lista de Sensores Cadastrados</h5>
<!-- data-bs-target indica o ID do modal que o Bootstrap deve abrir. -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalSensor"><i
                            class="bi bi-person-plus-fill me-2"></i>Novo Sensor</button>
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
                                            <th scope="col" class="py-3">Nome</th>
                                            <th scope="col" class="py-3">Trem</th>
                                            <th scope="col" class="py-3">Tipo</th>
                                            <th scope="col" class="py-3">Conjunto</th>
                                            <th scope="col" class="text-end pe-4 py-3 rounded-top-end">Ações</th>
                                        </tr>
                                    </thead>
                                    <!-- Registros de exemplo escritos diretamente no HTML, sem consulta ao banco.
Os botões das linhas ainda não executam alterações nos registros. -->
                                    <tbody>
                                        <tr>
                                            <th scope="row" class="ps-4">01</th>
                                            <td class="fw-medium">Temperatura-wtrn-04</td>
                                            <td>TRN-04</td>
                                            <td><span
                                                    class="badge bg-danger bg-opacity-75 fw-normal px-2 py-1 ">Temperatura</span>
                                            </td>
                                            <td class="text-muted">TRN-04-group</td>
                                            <td class="text-end pe-4">
                                                <button type="button" class="btn btn-sm btn-outline-secondary me-1"
                                                    title="Editar"><i class="bi bi-eye"></i></button>
                                                <button type="button" class="btn btn-sm btn-outline-danger"
                                                    title="Excluir"><i class="bi bi-trash"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="ps-4">02</th>
                                            <td class="fw-medium">gps-gtrn-04</td>
                                            <td>TRN-04</td>
                                            <td><span
                                                    class="badge bg-warning bg-opacity-75 fw-normal px-2 py-1">Localização</span>
                                            </td>
                                            <td class="text-muted">TRN-04-group</td>
                                            <td class="text-end pe-4">
                                                <button type="button" class="btn btn-sm btn-outline-secondary me-1"
                                                    title="Editar"><i class="bi bi-eye"></i></button>
                                                <button type="button" class="btn btn-sm btn-outline-danger"
                                                    title="Excluir"><i class="bi bi-trash"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="ps-4">03</th>
                                            <td class="fw-medium">Velocidade-vtrn-04</td>
                                            <td>TRN-04</td>
                                            <td><span
                                                    class="badge bg-success bg-opacity-75 fw-normal px-2 py-1">Funcionário</span>
                                            </td>
                                            <td class="text-muted">TRN-04-group</td>
                                            <td class="text-end pe-4">
                                                <button type="button" class="btn btn-sm btn-outline-secondary me-1"
                                                    title="Editar"><i class="bi bi-eye"></i></button>
                                                <button type="button" class="btn btn-sm btn-outline-danger"
                                                    title="Excluir"><i class="bi bi-trash"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>









            </div>
        </div>
    </main>

<!-- popup de cadastro de sensor -->
<!-- Janela de cadastro; data-bs-dismiss fecha o modal sem salvar os campos. -->
<div class="modal fade" id="modalSensor" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-cpu me-2 text-warning"></i>Cadastrar Novo Sensor IoT</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <!-- Identificação do sensor, separada da grandeza que ele mede. -->
                    <label class="form-label fw-semibold">Nome / Código do Sensor</label>
                    <input type="text" class="form-control" placeholder="Ex: Sensor TMP-01" id="nome_sensor" />
                </div>
                <div class="mb-3">
                    <!-- Grandeza monitorada; a opção inicial vazia representa ausência de seleção. -->
                    <label class="form-label fw-semibold">Tipo de Sensor</label>
                    <select class="form-select" id="tipo_sensor">
                        <option value="" selected disabled>Selecione o tipo...</option>
                        <option value="Temperatura">Temperatura</option>
                        <option value="Vibração">Vibração</option>
                        <option value="Consumo de Energia">Consumo de Energia</option>
                        <option value="Velocidade">Velocidade</option>
                    </select>
                </div>
                <div class="mb-3">
                    <!-- Parte do trem à qual o sensor será associado. -->
                    <label class="form-label fw-semibold">Subsistema Vinculado</label>
                    <select class="form-select" id="subsistema">
                        <option value="" selected disabled>Selecione o subsistema...</option>
                        <option value="Motor">Motor</option>
                        <option value="Elétrico">Elétrico</option>
                        <option value="Freios">Freios</option>
                        <option value="Comunicação">Comunicação</option>
                        <option value="Refrigeração">Refrigeração</option>
                        <option value="Câmeras">Câmeras</option>
                    </select>
                </div>
                <div class="mb-3">
                    <!-- Posição física do sensor dentro do trem. -->
                    <label class="form-label fw-semibold">Local de Instalação</label>
                    <input type="text" class="form-control" placeholder="Ex: Vagão 1 / Roda Dianteira" id="localizacao" />
                </div>
                <div class="mb-3">
                    <!-- Referência pretendida para alertas; esta tela não compara leituras com esse limite. -->
                    <label class="form-label fw-semibold">Limite Crítico Máximo</label>
                    <input type="number" class="form-control" placeholder="Ex: 85" id="limite_maximo" />
                </div>

<!-- Mensagens alternadas pela função cadastrarSensor() abaixo. -->
                <div id="alert-sucesso" class="alert alert-success d-none">Sensor cadastrado com sucesso!</div>
                <div id="alert-erro" class="alert alert-danger d-none">Erro ao cadastrar o sensor! Verifique os dados.</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-warning fw-semibold" onclick="cadastrarSensor()">Cadastrar Sensor</button>
            </div>
        </div>
    </div>
</div>

<!-- Habilita componentes interativos do Bootstrap, como modal e accordion. -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Validação visual: não envia requisições nem salva no navegador ou banco.
    function cadastrarSensor() {
// Lê os cinco campos do modal; .value retorna texto, inclusive no input numérico.
        var nome = document.getElementById("nome_sensor").value;
        var tipo = document.getElementById("tipo_sensor").value;
        var subsistema = document.getElementById("subsistema").value;
        var local = document.getElementById("localizacao").value;
        var limite = document.getElementById("limite_maximo").value;

// Oculta o resultado anterior antes de avaliar a nova tentativa.
        document.getElementById("alert-sucesso").classList.add("d-none");
        document.getElementById("alert-erro").classList.add("d-none");

// Rejeita campos vazios; não valida espaços, faixa numérica ou duplicidade.
        if (nome == "" || tipo == "" || subsistema == "" || local == "" || limite == "") {
            document.getElementById("alert-erro").classList.remove("d-none");
        } else {
// Sucesso significa apenas campos preenchidos; nenhum registro é persistido.
            document.getElementById("alert-sucesso").classList.remove("d-none");
        }
    }
</script>

</body>

</html>