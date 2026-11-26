<?php

session_start();
session_destroy();

header('Location: tela_login.php');
exit;
