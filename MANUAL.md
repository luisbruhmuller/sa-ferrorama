# Manual de utilização — Ferrorama

## Acesso e navegação

Abra a URL preparada na estação. A primeira página apresenta o propósito do projeto. Selecione **Entrar**, informe a conta fictícia fornecida para a demonstração e clique em **Entrar**. O menu lateral dá acesso a Início, Consultar CEP, Simulação do circuito, Sensores com falha, Trens, Rotas, Sensores e Ajuda. O item **Gerenciar usuários** aparece apenas para administradores. Use **Sair** no rodapé do menu para encerrar a sessão.

A home exibe atalhos e o clima de **São Paulo, SP**. O horário no cartão é o dos dados retornados pela Open-Meteo; **Atualizar clima** faz nova consulta. O clima não mede a posição dos trens.

## Perfil administrador

1. **Usuários:** abra **Gerenciar usuários**. Use **Novo Usuário** para informar nome, e-mail, CPF válido, cargo, status e senha. A lista permite buscar e filtrar. Use os botões de edição ou exclusão de cada linha; registros vinculados podem impedir a exclusão.
2. **Trens:** abra **Trens → Novo Trem**. Informe nome, tipo, status, conjunto e responsável já cadastrado. Salve e confira o registro na lista. Use as ações da linha para editar ou excluir. Um trem vinculado a rota ou sensor não pode ser excluído.
3. **Rotas:** abra **Rotas → Nova Rota**. Informe nome, origem, destino, distância, tempo, status e selecione pelo menos um trem. A lista mostra os trens vinculados. Use as ações da linha para editar ou excluir.
4. **Sensores:** abra **Sensores → Novo Sensor**. Informe nome, tipo de dado, local, trem, status e subsistema. A lista mostra o trem vinculado e o número de leituras existentes. Sensores com leituras associadas não podem ser excluídos.

Os formulários indicam campos obrigatórios e mostram mensagens quando algum valor é inválido. Após salvar, confira a mensagem e a nova linha na listagem. Antes de excluir, leia a confirmação apresentada.

## Perfis técnico e funcionário

Esses perfis podem consultar trens, rotas, sensores e sensores com falha. Botões de criação, edição e exclusão não aparecem, e o servidor também bloqueia tentativas diretas de acessar esses endpoints. Use a conta de operador fictícia para demonstrar essa diferença.

## Outras telas

- **Sensores com falha:** mostra apenas sensores com status cadastrado “Com falha”. A lista não é uma transmissão em tempo real.
- **Simulação do circuito:** escolha um percurso e use **Pausar/Retomar**. A animação é ilustrativa, sem localização real.
- **Consultar CEP:** digite oito dígitos, com ou sem hífen, e clique em **Consultar**. Confira os campos preenchidos. CEP inexistente ou falha de conexão aparece como mensagem; nenhum endereço é gravado.
- **Ajuda:** contém respostas rápidas sobre acesso, perfis e limites da aplicação.

## Encerrar e recuperar

Clique em **Sair**. Após cinco tentativas de login inválidas, a sessão fica bloqueada por 15 minutos. Se uma consulta externa falhar, verifique a internet e tente novamente. Se uma tela de cadastro informar erro de banco, peça à equipe da estação para verificar Apache, MySQL e `infra/config.local.php`.
