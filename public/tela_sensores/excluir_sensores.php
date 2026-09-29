<?php

session_start();

require_once __DIR__ . '/../../infra/conexao.php';


/*
|--------------------------------------------------------------------------
| Verifica se recebeu POST
|--------------------------------------------------------------------------
*/

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

    header("Location: tela_sensores.php");
    exit;

}


/*
|--------------------------------------------------------------------------
| Pega o ID do sensor
|--------------------------------------------------------------------------
*/

$id_sensor = (int) ($_POST['id_sensor'] ?? 0);


if ($id_sensor <= 0) {

    $_SESSION['flash'] = [
        'tipo' => 'danger',
        'mensagem' => 'Sensor inválido.'
    ];

    header("Location: tela_sensores.php");
    exit;

}


try {

    /*
    |--------------------------------------------------------------------------
    | Exclui os dados relacionados ao sensor
    |--------------------------------------------------------------------------
    */

    $sql = "DELETE FROM dados_sensor WHERE id_sensor = ?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param("i", $id_sensor);

    $stmt->execute();

    $stmt->close();


    /*
    |--------------------------------------------------------------------------
    | Exclui o sensor
    |--------------------------------------------------------------------------
    */

    $sql = "DELETE FROM sensor WHERE id_sensor = ?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param("i", $id_sensor);

    $stmt->execute();


    /*
    |--------------------------------------------------------------------------
    | Verifica se realmente excluiu
    |--------------------------------------------------------------------------
    */

    if ($stmt->affected_rows > 0) {

        $_SESSION['flash'] = [
            'tipo' => 'success',
            'mensagem' => 'Sensor excluído com sucesso!'
        ];

    } else {

        $_SESSION['flash'] = [
            'tipo' => 'warning',
            'mensagem' => 'Sensor não encontrado.'
        ];

    }


    $stmt->close();


} catch (Exception $e) {

    $_SESSION['flash'] = [
        'tipo' => 'danger',
        'mensagem' => 'Erro ao excluir o sensor: ' . $e->getMessage()
    ];

}


$conn->close();


header("Location: tela_sensores.php");
exit;

?>