# Migração das senhas

Faça um backup, inicie o MySQL no XAMPP e execute uma vez na raiz do projeto:

```powershell
C:\xampp\php\php.exe database\migrations\001_hash_senhas_existentes.php
```

## Rotas associadas a vários trens

Faça um backup e execute `004_rotas_multiplos_trens.sql` no phpMyAdmin ou no cliente MySQL.
A migração preserva a associação antiga de cada rota antes de remover a coluna `id_trem`.
