# Home, landing e consultas externas

## Objetivo

Preparar o Ferrorama para demonstração: entrada pública clara, home útil para usuários autenticados, clima real e consulta real de CEP.

## Decisões

- Manter PHP, Bootstrap e a identidade azul/escura existente. Não criar um segundo sistema ou dependências de build.
- Consultar Open-Meteo diretamente do navegador na home para São Paulo, SP, com temperatura, condição, localização e horário informado pela API. Exibir erro quando a consulta falhar.
- Consultar ViaCEP em uma tela autenticada de endereço. Validar oito dígitos, preencher CEP, logradouro, bairro, cidade e UF; distinguir formato inválido, CEP inexistente e falha de rede.
- Substituir o dashboard demonstrativo como home por atalhos reais. Não apresentar valores operacionais fictícios como leituras atuais.
- Preservar a landing pública, melhorando sua mensagem e identificando o painel visual como ilustração do fluxo do produto.

## Alternativas consideradas

- Proxy PHP para APIs: centralizaria requisições, mas acrescentaria configuração de cURL e novos endpoints. As duas APIs públicas aceitam consulta direta; o navegador é mais simples para esta etapa.
- Adicionar endereço ao cadastro de usuários: exigiria migração do banco e associaria uma consulta de CEP a dados pessoais sem necessidade funcional. Uma tela de consulta independente atende ao requisito e pode ser usada por qualquer usuário autenticado.

## Limites

O clima é contextual para São Paulo, não a localização do trem. A consulta de CEP preenche campos para conferência e não salva endereço no banco. Monitoramento em tempo real depende de uma integração futura com sensores.
