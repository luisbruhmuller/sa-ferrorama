(() => {
  const base = new URL("../", document.currentScript.src);
  const url = path => new URL(path, base).href;
  const current = decodeURIComponent(location.pathname);
  const items = [
    ["Dashboard", "bi-speedometer2", "public/Tela Home/tela_geral_home.php", "Tela Home/"],
    ["Mapa", "bi-map"],
    ["Métricas", "bi-graph-up"],
    ["Alertas", "bi-exclamation-triangle"],
    ["Manutenção", "bi-tools"],
    ["Relatórios", "bi-file-earmark-bar-graph"],
    ["Detalhes Trem", "bi-train-front"],
    ["Sensores IoT", "bi-cpu", "public/Tela sensores/tela_sensores.php", "Tela sensores/"],
    ["Gerenciar usuários", "bi-people", "public/Tela Usuário/tela_usuarios.php", "Tela Usuário/"]
  ];
  const sidebar = document.createElement("aside");
  sidebar.className = "app-sidebar bg-dark text-white";
  sidebar.innerHTML = `
    <div class="p-3 border-bottom border-secondary">
      <a class="d-flex align-items-center text-white text-decoration-none fw-bold fs-5" href="${url(items[0][2])}">
        <img src="${url("assets/images/gordo_holding_icon.png")}" class="brand-logo me-2" alt="Gordo Holding">GordoSensores
      </a>
      <div class="small text-white-50">Monitoramento ferroviário</div>
    </div>
    <nav class="nav flex-column p-2 gap-1 flex-grow-1" aria-label="Menu principal">
      ${items.map(([label, icon, path, group]) => {
        if (!path) return `<span class="nav-link text-white-50 px-3 py-2" aria-disabled="true"><i class="bi ${icon} me-2"></i>${label}<small class="d-block ms-4">Em breve</small></span>`;
        const active = current.includes(group) && !current.endsWith("tela_login.php");
        return `<a href="${url(path)}" class="nav-link text-white rounded px-3 py-2${active ? " bg-warning bg-opacity-25" : ""}"${active ? ' aria-current="page"' : ""}><i class="bi ${icon} me-2"></i>${label}</a>`;
      }).join("")}
    </nav>
    <div class="p-3 border-top border-secondary">
      <a class="text-warning text-decoration-none" href="${url("public/Tela Usuário/tela_login.php")}"><i class="bi bi-person-circle me-2"></i>Login</a>
    </div>`;
  document.body.prepend(sidebar);
})();