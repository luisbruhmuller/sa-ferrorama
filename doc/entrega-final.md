# Estação e entrega final — Ferrorama

Este checklist deve ser preenchido **na estação de demonstração**. Marque apenas o que foi observado; não trate um teste de CI como prova da bancada física.

## Preparação da estação

- [ ] Computador dedicado em bancada limpa, com monitor, teclado, mouse e energia estável.
- [ ] Repositório atualizado com o commit final; Apache/PHP e MySQL iniciam sem intervenção durante a apresentação.
- [ ] Banco importado e `infra/config.local.php` configurado fora do Git.
- [ ] `php scripts/preparar_demo.php` executado; senhas fictícias guardadas fora do repositório.
- [ ] Conta legada `admin@teste.com` removida ou inativada em bancos reaproveitados.
- [ ] Landing aberta no navegador e caminho de login visível.
- [ ] Internet disponível para CSS externo, Open-Meteo e ViaCEP, ou falhas dessas consultas demonstradas com mensagem clara.
- [ ] Nenhum dado pessoal, senha real ou arquivo local de configuração exposto na apresentação.

## Prova rápida antes da avaliação

- [ ] Login de administrador, bloqueio após tentativas inválidas e logout verificados.
- [ ] Usuário: cadastrar, buscar, editar e excluir ou explicar vínculo que impede exclusão.
- [ ] Trem: cadastrar com responsável, listar, editar e excluir ou explicar vínculo.
- [ ] Rota: cadastrar com trem, listar, editar e excluir.
- [ ] Sensor: cadastrar com trem, listar, editar e excluir ou explicar leituras vinculadas.
- [ ] Alteração persiste após recarregar a página; banco reflete o que a interface mostra.
- [ ] Operador acessa as listas, mas não cria, edita ou exclui, inclusive por URL direta.
- [ ] Sensores com falha mostram somente os registros marcados; circuito é apresentado como simulação.
- [ ] CEP válido, inválido e inexistente; clima, horário e erro de rede conferidos.
- [ ] Layout e navegação conferidos em tela larga e estreita.
- [ ] Capturas reais salvas em `doc/capturas/` e referenciadas no README.

## Teste com pessoa de fora da equipe

Nome ou identificação do participante: __________  Data: __________

Peça que encontre a finalidade do sistema, entre com uma conta fictícia, navegue, consulte um registro, faça uma operação permitida e saia. Registre aqui dificuldades observadas e correções, sem inserir dados pessoais:

| Dificuldade observada | Ajuste realizado | Nova verificação |
| --- | --- | --- |
| A preencher após o teste | A preencher | A preencher |

## Roteiro da apresentação

1. Landing: problema, objetivo, limites da simulação e das APIs.
2. Login administrador; mostrar usuários, trens com responsável, rotas com trens e sensores com trem.
3. Mostrar sensor marcado com falha, clima e CEP.
4. Sair e entrar como operador; mostrar navegação de consulta e bloqueio de escrita.
5. Mostrar esquema SQL, README, manual, CI, histórico de commits e PRs.
6. Explicar decisões técnicas, testes realizados e limitações conhecidas.

## Publicação oficial

- [ ] PR de home/APIs e PR de revisão final revisadas e incorporadas à `main`.
- [ ] Kanban/Google Projects conferido pela equipe; tarefas reais concluídas ou pendentes com status correto.
- [ ] Release `v1.0.0` criada **a partir do commit efetivamente demonstrado**, com resumo e limitações.
- [ ] Bancada, testes e capturas validados por integrantes antes de declarar a versão final pronta.
