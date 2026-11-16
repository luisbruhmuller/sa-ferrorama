#  Sistema de Gerenciamento Ferroviário

## Executar localmente

1. Instale PHP 8.1+ com as extensões `mysqli` e `mbstring`, Apache e MySQL/MariaDB (por exemplo, XAMPP).
2. Coloque este repositório na pasta servida pelo Apache. Importe `database/db.sql` no MySQL.
3. Confira usuário, senha, host e porta em `infra/conexao.php` para o seu ambiente.
4. Inicie Apache e MySQL e abra `http://localhost/sa-ferrorama/` (ajuste o caminho conforme a pasta escolhida).
5. Entre com um usuário ativo. A landing é pública; a home e a consulta de CEP exigem login. O arquivo SQL inclui um administrador de teste para ambiente local; troque suas credenciais antes de disponibilizar o sistema em outra rede.

## Novas páginas e APIs

- **Landing:** `public/tela_landing/tela_landing.php` apresenta o propósito e os recursos. O painel desenhado nela é uma ilustração, sem métricas reais.
- **Home:** `public/tela_home/tela_geral_home.php` reúne atalhos e consulta o clima de **São Paulo, SP** na [Open-Meteo Forecast API](https://open-meteo.com/en/docs). A requisição usa latitude/longitude fixas, `current=temperature_2m,weather_code` e `timezone=America/Sao_Paulo`. Temperatura, condição traduzida do código WMO e horário dos dados retornados aparecem na tela. O botão permite atualizar; erro de rede, HTTP ou resposta incompleta aparece no cartão.
- **Consultar CEP:** `public/tela_cep/tela_cep.php` usa o [ViaCEP](https://viacep.com.br/) para consultar um CEP digitado e preencher CEP, logradouro, bairro, cidade e UF. Aceita oito dígitos com ou sem hífen. Informa formato inválido, CEP inexistente e falha de comunicação. A consulta não grava endereço no banco.

As duas consultas são feitas pelo navegador via HTTPS e precisam de acesso à internet. Os serviços não exigem chave nesta utilização. O clima é contexto da cidade escolhida, não telemetria da ferrovia. Alguns CEPs não têm logradouro ou bairro específico.

## Verificação

Execute `node --test tests/apis.test.js` para testar transformação de dados e tratamento de erros. Os registros de consultas reais estão em [doc/evidencias_apis.md](doc/evidencias_apis.md). O uso de IA está descrito em [docs/relatorio-uso-ia.md](docs/relatorio-uso-ia.md).

---

## Sobre o Projeto

Este repositório foi desenvolvido como parte da **Situação de Aprendizagem** do curso de **Desenvolvimento de Sistemas do SENAI**.

O objetivo principal é permitir que os alunos demonstrem, na prática, as habilidades adquiridas ao longo do curso por meio da criação de um sistema completo voltado à **mobilidade urbana coletiva**, com foco em **ferrovias**.

---

## Objetivo

Desenvolver um sistema capaz de gerenciar operações ferroviárias, incluindo:

* Controle de trens 🚄
* Monitoramento de rotas
* Gestão de estações
* Integração com sensores
* Simulação de soluções de mobilidade urbana

---

##  Tecnologias e Conceitos Envolvidos

O projeto envolve diversas áreas do desenvolvimento de sistemas:

* 🧠 **Back-end**: Regras de negócio e processamento de dados
* 🎨 **Front-end**: Interface para interação com o usuário
* 🗄️ **Banco de Dados**: Armazenamento e gerenciamento das informações
* 📡 **Sensores**: Coleta de dados em tempo real (simulada ou real)
* 🔗 **Integração de Sistemas**

---

##  Funcionalidades Esperadas

* Cadastro e gerenciamento de trens
* Controle de horários e itinerários
* Monitoramento em tempo real
* Simulação de tráfego ferroviário
* Alertas e notificações
* Relatórios operacionais

---

##  Status do Projeto
 
Nesse nova etapa do projeto, nosso objetivo é pegar o código já criado nas fases anteriores, que foram criados usando apenas HTML, Css e Java Script, e agora, começaremos a usar a linguagem PHP, e alteraremos grande parte dos códigos. Agora também implementaremos o banco de dados, usando a linguagem SQL. E agora também começaremos a usar o XAMPP como servidor web local.

 Agora o foco do nosso projeto é outro, agora iremos alterar nossos códigos, melhorar nossas funcionalidades, tudo isso de maneira organizada, utilizando novas metodologias de desenvolvimento, como:

 * **SCRUM**: Scrum é uma metodologia ágil usada principalmente no desenvolvimento de software, mas também pode ser aplicada em outros tipos de projetos. Ela ajuda equipes a trabalharem de forma organizada, colaborativa e adaptável.

 * **Kanban**: É um sistema visual de gestão de trabalho que usa cartões e colunas em um quadro para controlar o fluxo de tarefas de forma ágil e eficiente.

 * **XP**: O XP (Extreme Programming) é uma metodologia ágil de desenvolvimento de software criada por Kent Beck no final dos anos 90, focada em alta qualidade de código, feedback constante e adaptação rápida a mudanças.

 Todas essas metodologias nos ajudarão a entregar o melhor produto possível, fornecendo organização, qualidade e produtividade.

 ---

 ## Novas ferramentas

Agora nessa nova etapa do projeto, iremos utilizar novas ferramentas para implementar nossos novos objetivos como:

* **PHP**: Após termos encaminhado bem a parte em HTML das telas, iremos implementar a linguagem PHP nos códigos. 
E uma das operações que mais daremos destaque é o CRUD(Create, Read, Update, Delete), pois para essa nova etapa, iremos implementar a parte de backend do projeto,
Que contará com essas partes de cadastro, e administração de entidades que no caso são os usuários, os sensores e etc..

* **XAMPP**: O XAMPP é um acrônimo para **X**: Multiplataforma, **A**: Apache, **M**: Maria Db/ MySQL, **P**: PHP(linguagem de programação), **P**: Perl(Linguagem de programação).E o XAMPP serve basicamente para rodar sistemas direto na máquina, e simular um servidor real, criando um ambiente controlado para rodar códigos e testar banco de dados, sem precisar colocar o site no ar.

* **Banco de Dados**: O Banco de dados é como se fosse a biblioteca do projeto, ele vai armazenar todos os dados cadastrados, e utilizando o SQL(linguagem de banco de dados), que assim criaremos os bancos de dados, e suas tabelas, assim quando estivermos fazendo o código, graças a conexão com o banco feita pelo **PHP**, e o servidor local do **XAMPP**, as telas estarão funcionando, e o projeto será concluído assim.

* **Conclusão**: A Conclusão final sobre essa etapa é que todas as metodologias que utilizaremos, e todas as novas ferramentas, trabalharão juntos para o projeto ser concluído.


--- <table>

## Requisitos Não Funcionais

| ID | Regras de negócio |
|---|---|
| **RN01** | O acesso ao sistema deve ser permitido apenas para usuários cadastrados. |
| **RN02** | O usuário deve fornecer e-mail e senha válidos para autenticação. |
| **RN03** | O sistema deve bloquear o acesso após 5 tentativas de login inválidas. |
| **RN04** | Apenas usuários com perfil de administrador podem cadastrar, editar ou excluir sensores. |
| **RN05** | Sensores não podem ser excluídos se possuírem dados associados no sistema. |
| **RN06** | Cada sensor deve possuir um identificador único. |
| **RN07** | Os dados dos sensores devem ser enviados continuamente em tempo real. |
| **RN08** | O sistema deve armazenar todos os dados recebidos dos sensores. |
| **RN09** | Os dados de velocidade devem estar dentro dos limites operacionais definidos. |
| **RN10** | Caso um valor ultrapasse os limites seguros, o sistema deve gerar um alerta automaticamente. |
| **RN11** | O sistema deve registrar todas as falhas detectadas pelos sensores. |
| **RN12** | O sistema deve priorizar a exibição de falhas críticas no dashboard. |
| **RN13** | Os dados exibidos no dashboard devem ser atualizados automaticamente a partir do banco de dados. |
| **RN14** | Relatórios só podem ser gerados por usuários autorizados de acordo com seu cargo. |
| **RN15** | Os relatórios devem considerar filtros por período, sensor e trem. |
| **RN16** | O sistema deve manter um histórico dos relatórios gerados. |
| **RN17** | As notificações dos alertas gerados devem ser enviadas apenas para usuários autorizados. |
| **RN18** | As informações exibidas no sistema devem seguir os padrões de visualização definidos. |
| **RN19** | O sistema deve registrar logs de todas as operações realizadas pelos usuários. |
| **RN20** | Os dados sensíveis devem ser protegidos conforme a LGPD e as configurações de segurança do sistema. |
| **RN21** | O sistema deve permitir integração apenas com dispositivos IoT cadastrados. |
| **RN22** | Cada trem monitorado deve estar vinculado a um conjunto de sensores. |
| **RN23** | O sistema deve identificar automaticamente sensores inativos. |
| **RN24** | Os dados históricos devem ser mantidos por um período mínimo definido, como 1 ano. |
| **RN25** | O sistema deve permitir análise preditiva com base nos dados coletados. |
| **RN26** | Os dados exibidos no dashboard devem permanecer consistentes durante as atualizações. |
| **RN27** | As atualizações do sistema não devem comprometer os dados já armazenados. |
| **RN28** | O sistema deve possuir redundância para evitar interrupções no serviço. |


## Requisitos funcionais

| ID | Requisito Funcional |
|---|---|
| **RF01** | O sistema deve permitir o cadastro de usuários. |
| **RF02** | O sistema deve permitir login de usuários. |
| **RF03** | O sistema deve validar e-mail e senha. |
| **RF04** | O sistema deve disponibilizar API para integração com outros sistemas.|
| **RF05** | O sistema deve permitir logout seguro. |
| **RF06** | O sistema deve permitir diferentes níveis de acesso (administrador e operador). |
| **RF07** | O sistema deve exibir lista de sensores cadastrados. |
| **RF08** | O sistema deve cadastrar novos sensores. |
| **RF09** | O sistema deve editar informações de sensores. |
| **RF10** | O sistema deve excluir sensores. |
| **RF11** | O sistema deve impedir exclusão de sensores com dados associados. |
| **RF12** | O sistema deve exibir o status dos sensores (ativo, inativo, com falha). |
| **RF13** | O sistema deve receber dados em tempo real dos sensores IoT. |
| **RF14** | O sistema deve exibir dados de velocidade do trem. |
| **RF15** | O sistema deve exibir localização do trem em tempo real. |
| **RF16** | O sistema deve exibir consumo de energia. |
| **RF17** | O sistema deve identificar e exibir falhas detectadas. |
| **RF18** | O sistema deve atualizar automaticamente os dados sem recarregar a página. |
| **RF19** | O sistema deve apresentar dashboard com indicadores principais. |
| **RF20** | O sistema deve exibir gráficos de desempenho. |
| **RF21** | O sistema deve permitir filtros por período (dia, semana e mês). |
| **RF22** | O sistema deve destacar alertas críticos no dashboard. |
| **RF23** | O sistema deve gerar alertas automáticos em caso de falhas. |
| **RF24** | O sistema deve notificar usuários sobre eventos críticos. |
| **RF25** | O sistema deve registrar histórico de falhas. |
| **RF26** | O sistema deve apoiar manutenção preditiva. |
| **RF27** | O sistema deve gerar relatórios operacionais. |
| **RF28** | O sistema deve permitir visualizar relatórios. |
| **RF29** | O sistema deve exportar relatórios (PDF ou CSV). |
| **RF30** | O sistema deve permitir agendamento de relatórios automáticos. |
| **RF31** | O sistema deve integrar com dispositivos IoT. |
| **RF32** | O sistema deve permitir comunicação com banco de dados central. |

## Requisitos Não Funcionais

| ID | Requisito Não Funcional |
|---|---|
| **RNF01** | O sistema deve ser responsivo (desktop, tablet e mobile). |
| **RNF02** | O sistema deve ter interface intuitiva, proporcionando boa experiência do usuário (UX). |
| **RNF03** | O sistema deve seguir padrões de acessibilidade. |
| **RNF04** | O sistema deve possuir autenticação segura, com criptografia de senhas. |
| **RNF05** | O sistema deve garantir a integridade dos dados. |
| **RNF06** | O sistema deve proteger contra acessos não autorizados. |
| **RNF07** | O sistema deve registrar logs de acesso e operações. |
| **RNF08** | O sistema deve processar dados em tempo real. |
| **RNF09** | O sistema deve ter tempo de resposta inferior a 2 segundos. |
| **RNF10** | O sistema deve suportar múltiplos sensores simultaneamente. |
| **RNF11** | O sistema deve suportar grande volume de dados, garantindo escalabilidade. |
| **RNF12** | O sistema deve estar disponível 24 horas por dia, 7 dias por semana (24/7). |
| **RNF13** | O sistema deve possuir tolerância a falhas. |
| **RNF14** | O sistema deve realizar backup automático dos dados. |
| **RNF15** | O sistema deve ser compatível com diferentes dispositivos IoT. |
| **RNF16** | O sistema deve utilizar protocolos padrão, como MQTT e HTTP. |
| **RNF17** | O sistema deve permitir integração com sistemas externos. |
| **RNF18** | O sistema deve possuir código modular e bem documentado. |

---



