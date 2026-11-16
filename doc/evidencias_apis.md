# Evidências das integrações

Data da consulta: 15/11/2026. As respostas abaixo foram obtidas por requisições HTTPS reais executadas durante esta implementação; valores de clima mudam a cada atualização.

## Open-Meteo

Requisição: `GET https://api.open-meteo.com/v1/forecast?latitude=-23.5505&longitude=-46.6333&current=temperature_2m%2Cweather_code&timezone=America%2FSao_Paulo`

Status HTTP: `200`.

Trecho da resposta: `"current":{"time":"2026-11-15T23:15","interval":900,"temperature_2m":18.6,"weather_code":53}`.

A home apresenta esse conjunto como 19 °C, Garoa e o horário dos dados em São Paulo. O serviço pode devolver valores novos a cada consulta.

## ViaCEP

Requisição: `GET https://viacep.com.br/ws/01001000/json/`

Status HTTP: `200`.

Trecho da resposta: `"cep":"01001-000","logradouro":"Praça da Sé","bairro":"Sé","localidade":"São Paulo","uf":"SP"`.

A tela preenche os cinco campos correspondentes. Os testes automatizados também cobrem formato inválido, CEP inexistente e erro de comunicação.

Executando os módulos do projeto com `node -e` e `fetch` real, a consulta retornou `{"cep":"01001-000","logradouro":"Praça da Sé","bairro":"Sé","cidade":"São Paulo","uf":"SP"}`. Para `99999999`, o módulo informou `CEP não encontrado. Confira o número informado.`. O módulo de clima retornou `{"temperatura":"19 °C","condicao":"Garoa","horario":"15/11/2026, 23:30"}` na mesma execução.

## Capturas de tela

Capturas da interface PHP ainda precisam ser produzidas em uma instalação com PHP, Apache e MySQL em execução. Este ambiente de desenvolvimento não tem o executável PHP nem um banco local disponíveis; por isso não há captura apresentada como prova de execução visual.
