Pesquisa sobre APIs


1. O que é uma API e qual é sua finalidade


API (Application Programming Interface) é uma interface que permite que um sistema se comunique com outro sem precisar saber como ele funciona por dentro. Sua finalidade é integrar sistemas, reaproveitar funcionalidades e padronizar a troca de informações.




2. Como funciona a comunicação entre sistemas por meio de APIs


A comunicação segue o modelo cliente-servidor: o cliente envia uma requisição, o servidor processa o pedido e devolve uma resposta. Normalmente isso acontece pelo protocolo HTTP/HTTPS.




3. O que são APIs REST


REST é um estilo de criar APIs usando o protocolo HTTP. Nele, cada coisa do sistema (cliente, produto, sensor) é um recurso com sua própria URL, e o servidor não guarda o estado entre as requisições.




4. O papel dos métodos HTTP


Os métodos indicam a ação que se quer fazer em um recurso:




GET: buscar dados;
POST: criar um novo registro;
PUT: atualizar o registro completo;
PATCH: atualizar apenas uma parte;
DELETE: excluir o registro.
5. O que são requisições e respostas HTTP


A requisição é o pedido enviado pelo cliente, com método, URL, cabeçalhos e, às vezes, dados. A resposta é o retorno do servidor, com um código de status (como 200 para sucesso, 404 para não encontrado e 500 para erro no servidor) e os dados solicitados.




6. O que são endpoints


Endpoint é o endereço específico da API onde um recurso pode ser acessado. Exemplo: https://api.exemplo.com/v1/sensores.




7. Como funciona a troca de dados no formato JSON


JSON é um formato de texto simples e leve para representar dados. O cliente e o servidor trocam informações nesse formato, que é fácil de ler e aceito por praticamente todas as linguagens.






json
{
  "id": 1,
  "nome": "Sensor de temperatura",
  "ativo": true
}




8. Diferenças entre uma API e um sistema web tradicional


O sistema web tradicional entrega páginas HTML prontas para o usuário no navegador. Já a API entrega apenas dados, em geral em JSON, para outros sistemas, que decidem como mostrá-los. Por isso, a mesma API pode atender um site, um aplicativo e outros sistemas.




9. Como uma aplicação PHP pode consumir uma API


O PHP envia uma requisição para o endpoint da API, geralmente usando a extensão cURL, confere o código de status da resposta e converte o JSON recebido em array com json_decode() para usar os dados no sistema.




10. Como uma API pode disponibilizar informações para outros sistemas


A API recebe a requisição, consulta o banco de dados e devolve os dados em JSON por meio de um endpoint. Assim, outros sistemas, como apps e painéis, conseguem acessar as informações sem acessar o banco diretamente.




11. Importância da autenticação, autorização e segurança


Autenticação: confirma quem está acessando (login, token ou chave de API);
Autorização: define o que cada usuário pode fazer;
Segurança: usar HTTPS, validar os dados recebidos e proteger senhas e tokens.
Sem esses cuidados, pessoas não autorizadas poderiam ler ou alterar dados importantes.




12. Exemplos de utilização de APIs em sistemas empresariais


Pagamentos (Pix e cartão);
Emissão de notas fiscais;
Consulta de CEP e CNPJ;
Cálculo de frete e rastreamento de encomendas;
Integração entre ERP e CRM;
Monitoramento com sensores IoT;
Login com conta do Google.
Conclusão


As APIs são essenciais para integrar sistemas de forma padronizada e segura. Entender como criar e consumir APIs é uma habilidade importante para quem trabalha com desenvolvimento de sistemas.