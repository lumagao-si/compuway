<?php
// Aqui ocorre a integração: encerra a sessão administrativa e retorna ao login.
session_start();
$_SESSION = [];
session_destroy();
header("Location: ../system/login.php");
exit();
