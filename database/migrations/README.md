# Migrações do banco

Faça um backup, inicie o MySQL no XAMPP e execute cada migração uma vez, na ordem indicada, a partir da raiz do projeto:

```powershell
C:\xampp\php\php.exe database\migrations\001_hash_senhas_existentes.php
C:\xampp\php\php.exe database\migrations\002_restricoes_usuarios.php
```

A segunda migração normaliza e-mail e CPF e cria restrições contra duplicidade. Se houver dados obrigatórios inválidos ou duplicados, ela será cancelada e indicará o primeiro registro que precisa ser corrigido.
