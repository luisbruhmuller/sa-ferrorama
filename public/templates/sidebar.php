<?php
/**
 * Menu compartilhado pelo dashboard e pelos sensores. Também imprime DOCTYPE, html e head,
 * estrutura repetida pelas páginas que o incluem. URLs HTML são relativas à página acessada.
 */

        ?>

<!DOCTYPE html>
<html lang="pt-BR">
<!-- Metadados, adaptação da página para dispositivos móveis e estilos. -->
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>GordoSensores — Dashboard</title>
  <!-- Bootstrap: grade responsiva e aparência de tabelas, cards e botões. -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <!-- Ícones fornecidos pelas classes bi e bi-*. -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet"/>
  <!-- Estilos próprios, incluindo posicionamento do menu e conteúdo. -->
  <link rel="stylesheet" href="../../styles/style.css">
</head>
<!-- Menu lateral: links abrem telas; itens em span são informativos.
O destaque da página atual está fixo no HTML. -->
<aside class="app-sidebar bg-dark text-white">
    <div class="p-3 border-bottom border-secondary">
      <a class="d-flex align-items-center text-white text-decoration-none fw-bold fs-5" href="../../public/Tela%20Home/tela_geral_home.php">
        <img src="../../assets/images/logo.ico" class="brand-logo me-2" alt="Gordo Holding">GordoSensores
      </a>
      <div class="small text-white-50">Monitoramento ferroviário</div>
    </div>
<!-- Os itens Em breve não têm destino. Alguns links ainda usam nomes antigos de pastas. -->
<nav
    class="nav flex-column p-2 gap-1 flex-grow-1"
    aria-label="Menu principal"
  >

    <a
      href="../../public/tela_home/tela_geral_home.php"
      class="nav-link text-white rounded px-3 py-2"
    >
      <i class="bi bi-people me-2"></i>Dashboard
    </a>

    <span class="nav-link text-white-50 px-3 py-2" aria-disabled="true">
      <i class="bi bi-map me-2"></i>Mapa
      <small class="d-block ms-4">Em breve</small>
    </span>

    <span class="nav-link text-white-50 px-3 py-2" aria-disabled="true">
      <i class="bi bi-graph-up me-2"></i>Métricas
      <small class="d-block ms-4">Em breve</small>
    </span>

    <a
      href="../../public/tela_alerta/tela_alerta.php"
      class="nav-link text-white rounded px-3 py-2 bg-warning bg-opacity-25"
      aria-current="page"
    >
      <i class="bi bi-speedometer2 me-2"></i>Alertas
    </a>
    <span class="nav-link text-white-50 px-3 py-2" aria-disabled="true">
      <i class="bi bi-tools me-2"></i>Manutenção
      <small class="d-block ms-4">Em breve</small>
    </span>

    <span class="nav-link text-white-50 px-3 py-2" aria-disabled="true">
      <i class="bi bi-file-earmark-bar-graph me-2"></i>Relatórios
      <small class="d-block ms-4">Em breve</small>
    </span>

    <span class="nav-link text-white-50 px-3 py-2" aria-disabled="true">
      <i class="bi bi-train-front me-2"></i>Detalhes Trem
      <small class="d-block ms-4">Em breve</small>
    </span>

    <a
      href="../../public/tela_sensores/tela_sensores.php"
      class="nav-link text-white rounded px-3 py-2"
    >
      <i class="bi bi-cpu me-2"></i>Sensores IoT
    </a>

    <a
      href="../../public/tela_usuarios/tela_usuarios.php"
      class="nav-link text-white rounded px-3 py-2"
    >
      <i class="bi bi-people me-2"></i>Gerenciar usuários
    </a>
  </nav>
    <div class="p-3 border-top border-secondary">
      <a class="text-warning text-decoration-none" href="../../public/Tela%20Usu%C3%A1rio/tela_login.php"><i class="bi bi-person-circle me-2"></i>Login</a>
    </div></aside>