<?php
 
 
 
 
 
 

session_start();
require "conexao.php";
require "financeiro.php";

header("Content-Type: application/json; charset=utf-8");

if (!isset($_SESSION["admin_id"])) {
    http_response_code(403);
    echo json_encode(["erro" => "Acesso negado: faça login como administrador."]);
    exit();
}

echo json_encode(obter_resumo_financeiro($conexao), JSON_UNESCAPED_UNICODE);
$conexao->close();
