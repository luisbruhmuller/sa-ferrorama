<?php
require_once __DIR__ . '/../tela_usuario/usuarios_comum.php';

$usuarioSidebar = null;
if (!empty($_SESSION['usuario_id'])) {
    $usuarioSidebar = consulta(
        "SELECT nome, funcao FROM usuarios WHERE id = ? AND status = 'ativo'",
        'i',
        [$_SESSION['usuario_id']]
    )->get_result()->fetch_assoc();
}
$cargosSidebar = ['adm' => 'Administrador', 'tecnico' => 'Técnico', 'funcionario' => 'Funcionário / Operador'];

/**
 * Menu compartilhado: identifica a tela principal mesmo quando este arquivo é incluído.
 * SCRIPT_NAME aponta para a página acessada, enquanto __FILE__ apontaria para o template.
 */
$paginaAtual = basename($_SERVER['SCRIPT_NAME'] ?? '');

// Telas de cadastro mantêm o destaque da seção à qual pertencem.
$secoesPorPagina = [
    'tela_geral_home.php' => 'dashboard',
    'tela_cep.php' => 'cep',
    'tela_alerta.php' => 'alertas',
    'tela_mapa.php' => 'mapa',
    'tela_trem.php' => 'trens',
    'tela_cadastro_trem.php' => 'trens',
    'tela_editar_trem.php' => 'trens',
    'tela_sensores.php' => 'sensores',
    'tela_cadastro_sensores.php' => 'sensores',
    'tela_editar_sensor.php' => 'sensores',
    'tela_usuarios.php' => 'usuarios',
    'tela_cadastro_usuarios.php' => 'usuarios',
    'editar_usuarios.php' => 'usuarios',
    'tela_rota.php' => 'rotas',
    'tela_cadastro_rota.php' => 'rotas',
    'tela_editar_rota.php' => 'rotas',
    'tela_faq.php' => 'ajuda',
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
      <a class="d-flex align-items-center text-white text-decoration-none fw-bold fs-5" href="../../public/tela_home/tela_geral_home.php">
        <img src="../../assets/images/logo.ico" class="brand-logo me-2" alt="">Ferrorama
      </a>
      <div class="small text-white-50">Monitoramento ferroviário</div>
    </div>
<nav
    class="nav flex-column p-2 gap-1 flex-grow-1"
    aria-label="Menu principal"
  >

    <a
      href="../../public/tela_home/tela_geral_home.php"
      <?php echo $atributosItemSidebar('dashboard'); ?>
    >
      <i class="bi bi-house me-2"></i>Início
    </a>

    <a href="../../public/tela_cep/tela_cep.php" <?php echo $atributosItemSidebar('cep'); ?>>
      <i class="bi bi-geo-alt me-2"></i>Consultar CEP
    </a>

    <a
      href="../../public/tela_mapa/tela_mapa.php"
      <?php echo $atributosItemSidebar('mapa'); ?>
    >
      <i class="bi bi-map me-2"></i>Simulação do circuito
    </a>

    <a
      href="../../public/tela_alerta/tela_alerta.php"
      <?php echo $atributosItemSidebar('alertas'); ?>
    >
      <i class="bi bi-exclamation-triangle me-2"></i>Sensores com falha
    </a>

    <a
      href="../../public/tela_trem/tela_trem.php"
      <?php echo $atributosItemSidebar('trens'); ?>
    >
      <i class="bi bi-train-front me-2"></i>Trens
    </a>

    <a
      href="../../public/tela_rota/tela_rota.php"
      <?php echo $atributosItemSidebar('rotas'); ?>
    >
      <i class="bi bi-signpost-split me-2"></i>Rotas
    </a>

    <a
      href="../../public/tela_sensores/tela_sensores.php"
      <?php echo $atributosItemSidebar('sensores'); ?>
    >
      <i class="bi bi-broadcast me-2"></i>Sensores
    </a>

    <?php if ($usuarioSidebar && $usuarioSidebar['funcao'] === 'adm'): ?>
    <a
      href="../../public/tela_usuario/tela_usuarios.php"
      <?php echo $atributosItemSidebar('usuarios'); ?>
    >
      <i class="bi bi-people me-2"></i>Gerenciar usuários
    </a>
    <?php endif; ?>

    <a
      href="../../public/tela_faq/tela_faq.php"
      <?php echo $atributosItemSidebar('ajuda'); ?>
    >
      <i class="bi bi-question-circle me-2"></i>Ajuda
    </a>


  </nav>
    <div class="p-3 border-top border-secondary">
      <?php if ($usuarioSidebar): ?>
      <div class="d-flex align-items-center text-warning">
        <i class="bi bi-person-circle me-2 fs-4" aria-hidden="true"></i>
        <div class="text-break">
          <div class="fw-semibold"><?= escapar($usuarioSidebar['nome']) ?></div>
          <div class="small text-white-50"><?= escapar($cargosSidebar[$usuarioSidebar['funcao']] ?? 'Não definido') ?></div>
        </div>
      </div>
      <form action="../tela_usuario/sair.php" method="post" class="mt-3">
        <?= token() ?>
        <button type="submit" class="btn btn-outline-warning btn-sm w-100">Sair</button>
      </form>
      <?php else: ?>
      <a class="text-warning text-decoration-none" href="../../public/tela_usuario/tela_login.php"><i class="bi bi-person-circle me-2"></i>Login</a>
      <?php endif; ?>
    </div></aside>
