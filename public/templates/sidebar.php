<?php
/**
 * Menu compartilhado: identifica a tela principal mesmo quando este arquivo é incluído.
 * SCRIPT_NAME aponta para a página acessada, enquanto __FILE__ apontaria para o template.
 */
$paginaAtual = basename($_SERVER['SCRIPT_NAME'] ?? '');

// Telas de cadastro mantêm o destaque da seção à qual pertencem.
$secoesPorPagina = [
    'tela_geral_home.php' => 'dashboard',
    'tela_alerta.php' => 'alertas',
    'tela_sensores.php' => 'sensores',
    'tela_cadastro_sensores.php' => 'sensores',
    'tela_usuarios.php' => 'usuarios',
    'tela_cadastro_usuarios.php' => 'usuarios',
];
$secaoAtual = $secoesPorPagina[$paginaAtual] ?? '';

// Retorna somente atributos fixos: páginas não mapeadas não destacam nenhum item.
$atributosItemSidebar = static function ($secao) use ($secaoAtual) {
    $ativo = $secaoAtual === $secao;
    return 'class="nav-link text-white rounded px-3 py-2'
        . ($ativo ? ' bg-warning bg-opacity-25' : '') . '"'
        . ($ativo ? ' aria-current="page"' : '');
};
?>
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
      <?php echo $atributosItemSidebar('dashboard'); ?>
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
      <?php echo $atributosItemSidebar('alertas'); ?>
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

    <a
      href="../../public/tela_trem/tela_trem.php"
      class="nav-link text-white rounded px-3 py-2"
    >
      <i class="bi bi-cpu me-2"></i>Detalhes Trem
    </a>

    <a
      href="../../public/tela_sensores/tela_sensores.php"
      <?php echo $atributosItemSidebar('sensores'); ?>
    >
      <i class="bi bi-cpu me-2"></i>Sensores IoT
    </a>

    <a
      href="../../public/tela_usuario/tela_usuarios.php"
      <?php echo $atributosItemSidebar('usuarios'); ?>
    >
      <i class="bi bi-people me-2"></i>Gerenciar usuários
    </a>

    <a
      href="../../public/tela_faq/tela_faq.php"
      class="nav-link text-white rounded px-3 py-2"
    >
      <i class="bi bi-question-circle me-2"></i>FAQ
    </a>


  </nav>
    <div class="p-3 border-top border-secondary">
      <a class="text-warning text-decoration-none" href="../../public/Tela%20Usu%C3%A1rio/tela_login.php"><i class="bi bi-person-circle me-2"></i>Login</a>
    </div></aside>