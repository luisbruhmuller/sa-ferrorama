# Revisão final do Ferrorama — plano de implementação

> **For agentic workers:** Implementar cada tarefa com testes e verificação antes de commitar.

**Goal:** Preparar uma versão demonstrável e documentada sem afirmar validações físicas ainda não realizadas.

**Architecture:** Manter PHP, MySQL e Bootstrap. Centralizar autenticação e conexão existentes, limitar mutações por perfil, consultar o banco para falhas, usar script CLI para dados de demonstração e adicionar CI para testes reproduzíveis.

**Tech Stack:** PHP 8.1+, MySQL/MariaDB, JavaScript, Node.js para testes, GitHub Actions.

**Spec:** `docs/superpowers/specs/2026-11-15-final-review-design.md`.

## Tarefas

- [ ] Corrigir autorização de trens e rotas no backend; ocultar ações administrativas para demais perfis; testar os endpoints com sessões de ambos os perfis.
- [ ] Remover registros e controles fictícios de alertas; consultar sensores `Com falha`; verificar estado vazio e erro de banco.
- [ ] Corrigir erro JavaScript, estrutura HTML e identificação de simulação do mapa; retirar itens de menu sem destino.
- [ ] Centralizar configuração local de banco sem credenciais reais no Git; criar provisionamento repetível de contas e dados fictícios.
- [ ] Criar testes de integração de login, permissões e CRUD principal no CI com PHP e MySQL; executar e inspecionar resultados.
- [ ] Revisar README, criar manual, checklist da estação e roteiro de demonstração; registrar limitações e evidências ainda pendentes.
- [ ] Verificar sintaxe, testes, diffs e histórico; commitar com coautoria, publicar a branch e abrir PR dependente da anterior.
