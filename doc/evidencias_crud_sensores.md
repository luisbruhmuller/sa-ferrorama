# Evidências da revisão do CRUD de sensores

Data da execução: 21/10/2026

## Tarefas e commits

| Tarefa | Correção verificada | Commit |
|---|---|---|
| Validação | Normalização e rejeição de nome, tipo, status, localização, trem e subsistema inválidos | [07e16ef](https://github.com/luisbruhmuller/SA-ferrorama/commit/07e16efa6615207452d3e1f9ef4788cc508b66b1) |
| Funções compartilhadas | CSRF, mensagens, consulta por ID, verificação de trem, duplicidade e leituras | [b0d8ac8](https://github.com/luisbruhmuller/SA-ferrorama/commit/b0d8ac84e72d4b4b83ada94fca17c85eae827923) |
| Cadastro | Formulário persistente, validação no servidor e bloqueio de código duplicado ou trem inexistente | [b8ba19f](https://github.com/luisbruhmuller/SA-ferrorama/commit/b8ba19fd9069c16f3197dcacb22ee6face7ee656) |
| Consulta e listagem | Substituição dos exemplos fixos por consulta ao banco com trem e total de leituras | [ba6a4a3](https://github.com/luisbruhmuller/SA-ferrorama/commit/ba6a4a3bf37f6b57509690f6d58a0a88842914cd) |
| Alteração | Tela preenchida, validação do ID e atualização de todos os campos e vínculos | [5f1bc30](https://github.com/luisbruhmuller/SA-ferrorama/commit/5f1bc303d2524e71dd89d18ff70487770b910ba3) |
| Exclusão | Remoção segura, com CSRF e bloqueio de sensores que possuem leituras | [c86f77a](https://github.com/luisbruhmuller/SA-ferrorama/commit/c86f77af86b12a89e05d91c4cbc9538b513ac03a) |
| Relacionamentos | Código único, vínculo obrigatório com trem e proteção das leituras por chaves estrangeiras | [1a32b2](https://github.com/luisbruhmuller/SA-ferrorama/commit/1a32b275054c5b9ead6019a17c886bd6637c01ba) |
| Testes | Casos válidos e inválidos para Create, Read, Update, Delete e relacionamento | [3bdc048](https://github.com/luisbruhmuller/SA-ferrorama/commit/3bdc048c1803f308b4f5ab954ee6fbe1a5839740) |

## Resultado dos testes

Comandos executados:

```powershell
C:\xampp\php\php.exe tests\validacao_sensor_test.php
C:\xampp\php\php.exe tests\crud_sensor_test.php
```

Saída obtida:

```text
Validação de sensores: OK
CRUD de sensores: OK — CREATE válido; CREATE inválido; READ e relacionamento; UPDATE válido; DELETE inválido bloqueado; DELETE válido
```

O teste de integração cria um banco temporário com nome aleatório, executa as quatro operações e
remove esse banco no bloco `finally`. Assim, a evidência não altera os registros de desenvolvimento.

Também foram executados `php -l` em todos os arquivos PHP do módulo e `git diff --check`, sem erros.
