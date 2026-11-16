const { test } = require('node:test');
const assert = require('node:assert/strict');
const { execFileSync } = require('node:child_process');

if (!process.env.FERRORAMA_TEST_URL) {
  test('smoke HTTP requer servidor PHP e banco (execute no CI)', { skip: true }, () => {});
} else {
  const base = process.env.FERRORAMA_TEST_URL.replace(/\/$/, '');
  const contas = JSON.parse(execFileSync('php', ['tests/seed-smoke.php'], { encoding: 'utf8' }));

  function cliente() {
    let cookie = '';
    return async (path, options = {}) => {
      const resposta = await fetch(base + path, {
        ...options,
        redirect: 'manual',
        headers: { ...(cookie ? { Cookie: cookie } : {}), ...options.headers }
      });
      const novoCookie = resposta.headers.get('set-cookie');
      if (novoCookie) cookie = novoCookie.split(';')[0];
      return resposta;
    };
  }

  async function entrar(conta) {
    const requisitar = cliente();
    const pagina = await (await requisitar('/public/tela_usuario/tela_login.php')).text();
    const csrf = pagina.match(/name="csrf" value="([^"]+)"/);
    assert.ok(csrf, 'formulário de login deve ter token CSRF');
    const resposta = await requisitar('/public/tela_usuario/tela_login.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: new URLSearchParams({ csrf: csrf[1], email: conta.email, senha: conta.senha })
    });
    assert.equal(resposta.status, 303, 'login deve redirecionar após sucesso');
    return requisitar;
  }

  test('operador consulta trens e não acessa criação nem endpoints de alteração', async () => {
    const requisitar = await entrar(contas.operador);
    const lista = await requisitar('/public/tela_trem/tela_trem.php');
    assert.equal(lista.status, 200);
    assert.doesNotMatch(await lista.text(), /Novo Trem/);
    for (const path of [
      '/public/tela_trem/tela_cadastro_trem.php',
      '/public/tela_rota/tela_cadastro_rota.php'
    ]) {
      const resposta = await requisitar(path);
      assert.match(resposta.headers.get('location') || '', /tela_acesso_negado\.php/);
    }
    for (const path of [
      '/public/tela_trem/trem_cadastrar.php',
      '/public/tela_trem/trem_editar.php',
      '/public/tela_trem/trem_excluir.php',
      '/public/tela_rota/rota_cadastrar.php',
      '/public/tela_rota/rota_editar.php',
      '/public/tela_rota/rota_excluir.php'
    ]) {
      const resposta = await requisitar(path, { method: 'POST' });
      assert.match(resposta.headers.get('location') || '', /tela_acesso_negado\.php/, path);
    }
  });

  test('administrador cadastra trem e o registro aparece na listagem', async () => {
    const requisitar = await entrar(contas.admin);
    const pagina = await (await requisitar('/public/tela_trem/tela_cadastro_trem.php')).text();
    const csrf = pagina.match(/name="csrf_token" value="([^"]+)"/);
    assert.ok(csrf, 'formulário de trem deve ter token CSRF');
    const resposta = await requisitar('/public/tela_trem/trem_cadastrar.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: new URLSearchParams({
        csrf_token: csrf[1], nome: 'Trem Integração', tipo: 'Locomotiva',
        status: 'Ativo', conjunto: 'Demo', id_responsavel: String(contas.admin.id)
      })
    });
    assert.equal(resposta.status, 302);
    assert.match(resposta.headers.get('location') || '', /tela_trem\.php/);
    const lista = await (await requisitar('/public/tela_trem/tela_trem.php')).text();
    assert.match(lista, /Trem Integração/);
  });

  test('central de falhas mostra somente sensores marcados com falha', async () => {
    const requisitar = await entrar(contas.operador);
    const resposta = await requisitar('/public/tela_alerta/tela_alerta.php');
    assert.equal(resposta.status, 200);
    const pagina = await resposta.text();
    assert.match(pagina, /Sensor Falha CI/);
    assert.doesNotMatch(pagina, /Sensor Ativo CI/);
    assert.doesNotMatch(pagina, /#ALT-0/);
    assert.doesNotMatch(pagina, /href="#"/);
  });

  test('login inválido bloqueia após cinco tentativas', async () => {
    const requisitar = cliente();
    const pagina = await (await requisitar('/public/tela_usuario/tela_login.php')).text();
    const csrf = pagina.match(/name="csrf" value="([^"]+)"/);
    assert.ok(csrf);
    let ultima;
    for (let i = 0; i < 6; i++) {
      ultima = await requisitar('/public/tela_usuario/tela_login.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({ csrf: csrf[1], email: contas.operador.email, senha: 'incorreta' })
      });
    }
    assert.match(await ultima.text(), /Aguarde 15 minutos/);
  });

  test('logout encerra acesso à home autenticada', async () => {
    const requisitar = await entrar(contas.operador);
    const pagina = await (await requisitar('/public/tela_home/tela_geral_home.php')).text();
    const csrf = pagina.match(/name="csrf" value="([^"]+)"/);
    assert.ok(csrf);
    const saida = await requisitar('/public/tela_usuario/sair.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: new URLSearchParams({ csrf: csrf[1] })
    });
    assert.equal(saida.status, 303);
    const acesso = await requisitar('/public/tela_home/tela_geral_home.php');
    assert.match(acesso.headers.get('location') || '', /tela_login\.php/);
  });
}
