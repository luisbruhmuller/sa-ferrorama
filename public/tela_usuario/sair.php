<?php

// Encerra a sessão do usuário.
session_start();
session_destroy();

header('Location: tela_login.php');
exit;
