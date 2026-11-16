const { test } = require('node:test');
const assert = require('node:assert/strict');
const { consultarClima, interpretarClima } = require('../script/clima.js');
const { consultarCep, normalizarCep } = require('../script/cep.js');

test('interpreta temperatura, condição e horário da Open-Meteo', () => {
  assert.deepEqual(interpretarClima({ current: { temperature_2m: 24.6, weather_code: 61, time: '2026-11-15T14:15' } }), {
    temperatura: '25 °C', condicao: 'Chuva', horario: '15/11/2026, 14:15'
  });
});

test('rejeita resposta incompleta de clima', () => {
  assert.throws(() => interpretarClima({ current: { temperature_2m: 23 } }), /indisponíveis/i);
});

test('consulta Open-Meteo com coordenadas e parâmetros esperados', async () => {
  const clima = await consultarClima(async (url) => {
    const parsed = new URL(url);
    assert.equal(parsed.hostname, 'api.open-meteo.com');
    assert.equal(parsed.searchParams.get('timezone'), 'America/Sao_Paulo');
    assert.equal(parsed.searchParams.get('current'), 'temperature_2m,weather_code');
    return { ok: true, json: async () => ({ current: { temperature_2m: 20, weather_code: 0, time: '2026-11-15T10:00' } }) };
  });
  assert.equal(clima.condicao, 'Céu limpo');
});

test('falha de comunicação do clima é informada', async () => {
  await assert.rejects(consultarClima(async () => ({ ok: false })), /consultar o clima/i);
});

test('normaliza CEP com máscara e rejeita formato incorreto', () => {
  assert.equal(normalizarCep(' 01001-000 '), '01001000');
  assert.throws(() => normalizarCep('0100-100'), /8 dígitos/);
  assert.throws(() => normalizarCep('abcdefgh'), /8 dígitos/);
});

test('consulta ViaCEP e devolve os campos do endereço', async () => {
  const endereco = await consultarCep('01001-000', async (url) => {
    assert.equal(url, 'https://viacep.com.br/ws/01001000/json/');
    return { ok: true, json: async () => ({ cep: '01001-000', logradouro: 'Praça da Sé', bairro: 'Sé', localidade: 'São Paulo', uf: 'SP' }) };
  });
  assert.deepEqual(endereco, { cep: '01001-000', logradouro: 'Praça da Sé', bairro: 'Sé', cidade: 'São Paulo', uf: 'SP' });
});

test('distingue CEP inexistente de falha de rede', async () => {
  await assert.rejects(consultarCep('99999999', async () => ({ ok: true, json: async () => ({ erro: true }) })), /não encontrado/i);
  await assert.rejects(consultarCep('01001000', async () => { throw Error('offline'); }), /comunicação/i);
});

test('rejeita resposta nula do ViaCEP com mensagem útil', async () => {
  await assert.rejects(consultarCep('01001000', async () => ({ ok: true, json: async () => null })), /resposta incompleta/i);
});
