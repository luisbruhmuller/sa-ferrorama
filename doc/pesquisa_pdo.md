## Pesquisa sobre PDO 

# Oque é

PDO (PHP Data Objects) é uma extensão do PHP que fornece uma interface padronizada para acessar bancos de dados. Em vez de usar funções específicas para cada banco (como mysqli para MySQL), você utiliza a mesma API para diferentes SGBDs, como MySQL, PostgreSQL, SQLite, SQL Server e outros.

# Para oque ele é utilizado ?

O PDO em PHP é utilizado principalmente para conectar o PHP a um banco de dados e permitir que o sistema trabalhe com os dados armazenados nele.

Como por exemplo em um sistema de cadastro 

**Conectar** o PHP ao MySQL
**Cadastrar** usuários ou clientes
**Consultar** informações
**Alterar** dados
**Excluir** dados

# Conexão com o Banco

Uma conexão com PDO funciona como uma ponte entre o seu código PHP e o banco de dados. O PHP abre essa conexão, envia comandos SQL e recebe os resultados.

# Principais Características 

As principais características do PDO (PHP Data Objects) são:

**Segurança** — permite usar consultas preparadas (prepare e execute), ajudando a evitar SQL Injection.
**Suporte a vários bancos** — pode trabalhar com MySQL, PostgreSQL, SQLite, SQL Server, entre outros.
**Conexão com banco de dados** — permite que o PHP se comunique com o banco.
**Execução de SQL** — permite fazer SELECT, INSERT, UPDATE e DELETE.
**Tratamento de erros** — pode gerar exceções quando ocorre algum problema na conexão ou consulta.
**Código organizado** — utiliza uma interface orientada a objetos, facilitando a manutenção.
**Portabilidade** — facilita trocar de banco de dados sem precisar reescrever todo o código.

# Diferenças entre PDO e MySQLi 

* PDO é mais flexível porque trabalha com vários bancos de dados.
* MySQLi é específico para MySQL, mas também oferece segurança e consultas preparadas.
* Para projetos novos, PDO costuma ser uma boa escolha, principalmente se houver possibilidade de trocar o banco de dados no futuro.

# Vantagens e desvantagens do PDO

Vantagens:

**Mais segurança**: permite usar consultas preparadas, ajudando a evitar SQL Injection.
**Suporta vários bancos**: MySQL, PostgreSQL, SQLite, SQL Server etc.
**Portabilidade**: facilita trocar o banco de dados.
**Código organizado**: possui uma estrutura orientada a objetos.
**Tratamento de erros**: permite trabalhar facilmente com exceções.

Desvantagens:

**Pode ser mais difícil para iniciantes**: possui alguns conceitos que precisam ser aprendidos.
**Sintaxe diferente**: quem está acostumado com mysqli precisa aprender a sintaxe do PDO.
**Pequena sobrecarga**: em alguns casos, pode ter uma pequena diferença de desempenho em relação a métodos específicos do banco.
**Nem todos os recursos específicos do MySQL**: algumas funcionalidades exclusivas do MySQL podem exigir recursos específicos que não são padronizados pelo PDO.

# Conclusão

o PDO tem como principais vantagens a segurança, organização e compatibilidade com vários bancos, enquanto sua principal desvantagem é que pode exigir um pouco mais de aprendizado para quem está começando.