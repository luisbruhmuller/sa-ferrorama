(function (root) {
  'use strict';

  function normalizarCep(valor) {
    const texto = String(valor).trim();
    if (!/^\d{5}-?\d{3}$/.test(texto)) throw new Error('Informe um CEP com 8 dígitos.');
    return texto.replace('-', '');
  }

  async function consultarCep(entrada, fetchImpl = root.fetch.bind(root)) {
    const cep = normalizarCep(entrada);
    let resposta;
    try {
      resposta = await fetchImpl(`https://viacep.com.br/ws/${cep}/json/`, { signal: AbortSignal.timeout(8000) });
    } catch (_) {
      throw new Error('Falha de comunicação com o ViaCEP. Tente novamente.');
    }
    if (!resposta.ok) throw new Error('Falha de comunicação com o ViaCEP. Tente novamente.');
    let dados;
    try {
      dados = await resposta.json();
    } catch (_) {
      throw new Error('Resposta inválida do ViaCEP. Tente novamente.');
    }
    if (dados && dados.erro) throw new Error('CEP não encontrado. Confira o número informado.');
    if (!dados || !dados.cep || typeof dados.localidade !== 'string' || typeof dados.uf !== 'string') {
      throw new Error('Resposta incompleta do ViaCEP. Tente novamente.');
    }
    return {
      cep: dados.cep,
      logradouro: dados.logradouro || '',
      bairro: dados.bairro || '',
      cidade: dados.localidade,
      uf: dados.uf
    };
  }

  if (typeof module !== 'undefined' && module.exports) module.exports = { consultarCep, normalizarCep };
  if (typeof document === 'undefined') return;

  const form = document.getElementById('consulta-cep');
  if (!form) return;
  const mensagem = document.getElementById('cep-mensagem');
  const botao = form.querySelector('button[type="submit"]');
  const campos = ['cep', 'logradouro', 'bairro', 'cidade', 'uf'];

  form.addEventListener('submit', async (evento) => {
    evento.preventDefault();
    botao.disabled = true;
    mensagem.className = 'alert alert-info';
    mensagem.textContent = 'Consultando ViaCEP…';
    try {
      const endereco = await consultarCep(document.getElementById('cep-busca').value);
      for (const campo of campos) document.getElementById(`endereco-${campo}`).value = endereco[campo];
      mensagem.className = 'alert alert-success';
      mensagem.textContent = 'Endereço encontrado. Confira os campos preenchidos.';
    } catch (erro) {
      for (const campo of campos) document.getElementById(`endereco-${campo}`).value = '';
      mensagem.className = 'alert alert-danger';
      mensagem.textContent = erro.message;
    } finally {
      botao.disabled = false;
    }
  });
})(typeof window !== 'undefined' ? window : globalThis);
