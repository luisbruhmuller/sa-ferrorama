(function (root) {
  'use strict';

  const URL_CLIMA = 'https://api.open-meteo.com/v1/forecast?latitude=-23.5505&longitude=-46.6333&current=temperature_2m%2Cweather_code&timezone=America%2FSao_Paulo';

  // Transforma o código em uma descrição.
  function condicao(codigo) {
    if (codigo === 0) return 'Céu limpo';
    if ([1, 2].includes(codigo)) return 'Parcialmente nublado';
    if (codigo === 3) return 'Nublado';
    if ([45, 48].includes(codigo)) return 'Nevoeiro';
    if ([51, 53, 55, 56, 57].includes(codigo)) return 'Garoa';
    if ([61, 63, 65, 66, 67, 80, 81, 82].includes(codigo)) return 'Chuva';
    if ([71, 73, 75, 77, 85, 86].includes(codigo)) return 'Neve';
    if ([95, 96, 99].includes(codigo)) return 'Trovoada';
    return 'Condição não identificada';
  }

  // Organiza os dados recebidos da API.
  function interpretarClima(resposta) {
    const atual = resposta && resposta.current;
    if (!atual || !Number.isFinite(atual.temperature_2m) || !Number.isInteger(atual.weather_code) ||
        typeof atual.time !== 'string' || !/^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}/.test(atual.time)) {
      throw new Error('Dados meteorológicos indisponíveis.');
    }
    const [data, hora] = atual.time.split('T');
    const [ano, mes, dia] = data.split('-');
    return {
      temperatura: `${Math.round(atual.temperature_2m)} °C`,
      condicao: condicao(atual.weather_code),
      horario: `${dia}/${mes}/${ano}, ${hora.slice(0, 5)}`
    };
  }

  // Consulta o clima atual.
  async function consultarClima(fetchImpl = root.fetch.bind(root)) {
    let resposta;
    try {
      resposta = await fetchImpl(URL_CLIMA, { signal: AbortSignal.timeout(8000) });
    } catch (_) {
      throw new Error('Não foi possível consultar o clima. Verifique a conexão e tente novamente.');
    }
    if (!resposta.ok) throw new Error('Não foi possível consultar o clima. Tente novamente.');
    try {
      return interpretarClima(await resposta.json());
    } catch (erro) {
      if (erro.message === 'Dados meteorológicos indisponíveis.') throw erro;
      throw new Error('Dados meteorológicos indisponíveis.');
    }
  }

  if (typeof module !== 'undefined' && module.exports) module.exports = { consultarClima, interpretarClima };
  if (typeof document === 'undefined') return;

  const temperatura = document.getElementById('clima-temperatura');
  const descricao = document.getElementById('clima-condicao');
  const horario = document.getElementById('clima-horario');
  const estado = document.getElementById('clima-estado');
  const botao = document.getElementById('clima-atualizar');
  if (!temperatura || !botao) return;

  // Atualiza os dados mostrados na tela.
  async function atualizar() {
    botao.disabled = true;
    estado.textContent = 'Consultando Open-Meteo…';
    try {
      const clima = await consultarClima();
      temperatura.textContent = clima.temperatura;
      descricao.textContent = clima.condicao;
      horario.textContent = `Dados de ${clima.horario} (São Paulo)`;
      estado.textContent = 'Consulta concluída';
    } catch (erro) {
      temperatura.textContent = '—';
      descricao.textContent = 'Clima indisponível';
      horario.textContent = 'Sem atualização';
      estado.textContent = erro.message;
    } finally {
      botao.disabled = false;
    }
  }
  botao.addEventListener('click', atualizar);
  atualizar();
})(typeof window !== 'undefined' ? window : globalThis);
