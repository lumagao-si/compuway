<?php

session_start(); //inicia a sessão para poder acessar as variáveis de sessão
session_unset();  //limpa e remove as variáveis globais que estavam armazenadas na sessão
session_destroy(); //destrói a sessão atual, apagando os dados do usuário armazenados no servidor

header("Location: ../login.php"); //redireciona o usuário para a página do login após sair da sessão
exit; 