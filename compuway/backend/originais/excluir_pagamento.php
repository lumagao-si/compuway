<?php
 
 
 
 
 
session_start();
require "conexao.php";
 
if (!isset($_SESSION["admin_id"])) {
    die("Acesso negado: faça login como administrador.");
}
 
if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
    die("Erro: pagamento inválido.");
}
 
$id = $_GET["id"];
 
$stmt = $conexao->prepare("DELETE FROM pagamentos WHERE id = ?");
$stmt->bind_param("i", $id);
 
if ($stmt->execute()) {
    header("Location: ../pages/listar_pagamentos.php");
    exit();
} else {
    echo "Erro ao excluir pagamento: " . $conexao->error;
}
?>
 