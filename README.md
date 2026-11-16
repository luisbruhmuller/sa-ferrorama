# Ferrorama

Sistema de apoio ao acompanhamento ferroviário desenvolvido na Situação de Aprendizagem do SENAI. Reúne cadastros de usuários, trens, rotas e sensores, mostra sensores marcados com falha e oferece uma home com clima e consulta de CEP.

## Problema e objetivo

Registros de uma operação ferroviária dispersos dificultam a consulta e a identificação de situações que exigem atenção. O Ferrorama organiza esses registros em telas acessíveis por perfil, com vínculos entre responsável, trem, rota e sensor. O circuito animado é uma **simulação**; a aplicação ainda não recebe telemetria ao vivo nem dispara alertas automáticos.

## Funcionalidades

| Área | O que permite fazer |
| --- | --- |
| Acesso | Login, bloqueio após cinco tentativas inválidas, sessão e logout. |
| Usuários | Cadastro, busca, edição e exclusão conforme os relacionamentos. Apenas administrador. |
| Trens | Cadastro, listagem, edição e exclusão; vínculo com usuário responsável. |
| Rotas | Cadastro, listagem, edição e exclusão; vínculo com um ou mais trens. |
| Sensores | Cadastro, listagem, edição e exclusão; vínculo com trem e status. |
| Sensores com falha | Lista os sensores cujo status cadastrado é “Com falha”. |
| Home e serviços externos | Clima de São Paulo via Open-Meteo e consulta de endereço via ViaCEP. |
| Circuito | Animação ilustrativa do percurso, sem localização real. |

Administradores gerenciam os cadastros. Técnicos e funcionários consultam trens, rotas, sensores, falhas e demais telas de leitura. O bloqueio de escrita é aplicado também nos endpoints PHP.

## Tecnologias e requisitos

PHP 8.1 ou superior com `mysqli` e `mbstring`, MySQL 8 ou MariaDB compatível, Apache ou servidor PHP local, navegador moderno e internet para Bootstrap, ícones, clima e CEP. Node.js 20 ou superior é usado apenas para os testes automatizados. A interface utiliza Bootstrap 5.3, CSS e JavaScript.

## Instalação na estação de demonstração

1. Instale e inicie Apache, PHP e MySQL no computador dedicado (por exemplo, com XAMPP). Copie ou clone este repositório para a pasta servida pelo Apache.
2. Importe `database/db.sql` em uma instalação nova. Exemplo no terminal: `mysql -u root -p < database/db.sql`. O esquema cria o banco `sa_ferrorama`. **Não reimporte sobre um banco com dados**, pois as tabelas não são migrações.
3. Copie `infra/config.example.php` para `infra/config.local.php` e ajuste host, usuário, senha, nome do banco e porta. O arquivo local é ignorado pelo Git. Também é possível usar `FERRORAMA_DB_HOST`, `FERRORAMA_DB_USER`, `FERRORAMA_DB_PASSWORD`, `FERRORAMA_DB_NAME` e `FERRORAMA_DB_PORT`.
4. No terminal da estação, execute `php scripts/preparar_demo.php` (no XAMPP Windows, use `C:\xampp\php\php.exe scripts\preparar_demo.php`). O script cria duas contas **fictícias**, um trem, uma rota e dois sensores. As senhas são geradas no momento, aparecem somente no terminal e são armazenadas no banco como hash. Guarde-as fora do repositório. Executar o script novamente redefine as senhas dessas contas.
5. Abra a URL da pasta no navegador, por exemplo `http://localhost/sa-ferrorama/`. A landing é pública; clique em **Entrar**. Teste as contas de administrador e operador antes da avaliação.

O esquema não contém credenciais padrão. Em bancos antigos, remova ou inative a conta legada `admin@teste.com` após criar as contas de demonstração.

## APIs externas

- [Open-Meteo Forecast API](https://open-meteo.com/en/docs): a home consulta latitude `-23.5505`, longitude `-46.6333`, temperatura e código meteorológico com fuso `America/Sao_Paulo`. Exibe temperatura, condição, local e horário dos dados. O clima é contexto de São Paulo, sem vínculo com trens.
- [ViaCEP](https://viacep.com.br/): consulta CEP brasileiro de oito dígitos, preenche CEP, logradouro, bairro, cidade e UF quando disponíveis, e informa CEP inválido, inexistente ou falha de rede. O endereço consultado não é salvo.

Ambas são chamadas via HTTPS pelo navegador e não exigem chave neste uso. Consulte [as evidências registradas](doc/evidencias_apis.md).

## Estrutura do projeto

- `public/`: páginas PHP, formulários e menu compartilhado.
- `infra/`: conexão, validações e hash de senha.
- `database/`: esquema SQL.
- `script/` e `styles/`: comportamento e aparência da interface.
- `scripts/preparar_demo.php`: dados fictícios para a estação.
- `tests/` e `.github/workflows/ci.yml`: testes de API, sintaxe e fluxos HTTP com MySQL.
- `doc/` e `docs/`: pesquisas, evidências e relatório de uso de IA.

## Manual e verificação

O [manual de utilização](MANUAL.md) explica os passos para cada perfil. O [checklist da estação e roteiro de apresentação](doc/entrega-final.md) deve ser preenchido na bancada. Para executar os testes locais de JavaScript: `node --test tests/apis.test.js`. O CI instala PHP/MySQL, valida a sintaxe e exercita login, permissões, cadastro de trem e a lista de sensores com falha.

## Equipe e contribuições registradas

Conforme o histórico de commits: **Arthur Dias Machado** contribuiu para telas e estrutura do sistema; **Caio Ritzmann Pacheco** para telas de trens e acesso; **Henrique Boegershausen Salvador** para landing, sensores e ajustes de integração; **Luís Felipe Bruhmuller** para CRUDs, integração e revisão final. A equipe deve conferir esse resumo antes da apresentação. O uso do Codex nesta etapa está descrito em [docs/relatorio-uso-ia.md](docs/relatorio-uso-ia.md), e os commits correspondentes registram coautoria.

## Capturas e limitações

Capturas da versão executada na estação devem ser adicionadas em `doc/capturas/` após a instalação e teste presencial; não há imagens fabricadas nesta entrega. A preparação física da bancada, o teste com pessoa externa, a atualização do Kanban e a publicação de uma Release final dependem da equipe. O sistema não oferece telemetria ao vivo, regras automáticas de disparo, relatório operacional nem mapa de posição real.
