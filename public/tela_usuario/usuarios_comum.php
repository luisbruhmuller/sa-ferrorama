<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../infra/conexao.php';

// Evita que textos virem código HTML.
function escapar($texto)
{
    return htmlspecialchars((string) $texto, ENT_QUOTES, 'UTF-8');
}

// Leva o usuário para outra página.
function redirecionar($pagina)
{
    header('Location: ' . $pagina);
    exit;
}

// Confere se existe um usuário conectado.
function exigir_login($pagina = '../tela_usuario/tela_login.php')
{
    global $conn;

    if (empty($_SESSION['usuario_id'])) {
        redirecionar($pagina);
    }

    $id = (int) $_SESSION['usuario_id'];
    $usuario = mysqli_fetch_assoc(mysqli_query(
        $conn,
        "SELECT id, nome, funcao, status FROM usuarios WHERE id = $id"
    ));

    if (!$usuario || $usuario['status'] !== 'ativo') {
        session_destroy();
        redirecionar($pagina);
    }

    return $usuario;
}

// Deixa a página apenas para administradores.
function exigir_admin()
{
    $usuario = exigir_login('../tela_usuario/tela_login.php');

    if ($usuario['funcao'] !== 'adm') {
        redirecionar('../tela_usuario/tela_acesso_negado.php');
    }

    return $usuario;
}
