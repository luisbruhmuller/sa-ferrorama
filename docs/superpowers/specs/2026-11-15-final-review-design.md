# Revisão final do Ferrorama

## Objetivo

Entregar um repositório coerente com a demonstração final: operações principais protegidas, interface sem dados operacionais inventados, instalação reproduzível, manual e pendências físicas explicitadas.

## Decisões

- Continuar a partir da branch `codex/home-landing-apis`, pois ela contém a home e as APIs ainda não incorporadas à `main`. A revisão final terá PR própria e dependente da anterior.
- Perfis `adm` podem cadastrar, editar e excluir usuários, trens, rotas e sensores. Perfis `tecnico` e `funcionario` consultam trens, rotas, sensores, falhas e mapa. O controle deve valer no backend e na interface.
- Trocar a tela de alertas demonstrativos por consulta real a sensores marcados `Com falha`. Não apresentar essa lista como telemetria em tempo real ou alertas automáticos.
- Identificar o mapa animado como simulação e corrigir seus erros JavaScript e estrutura HTML.
- Preparar contas e dados fictícios por script executado localmente. Senhas são geradas na estação, armazenadas apenas como hash e não são commitadas.
- Documentar instalação, demonstração, manual e checklist de aceite. Release final depende de a equipe confirmar o ambiente físico, validar os fluxos e incorporar as PRs.

## Limites

Este workspace não controla a bancada, periféricos, servidor XAMPP ou o teste de usabilidade por pessoa externa. O repositório deve conter instruções objetivas e campos para evidências, sem declarar essas etapas concluídas.
