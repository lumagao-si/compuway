<?php
 
 
 
 
 
session_start();
require "conexao.php";
 
if (!isset($_SESSION["admin_id"])) {
    die("Acesso negado: faça login como administrador.");
}
 
if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
    die("Erro: cliente inválido.");
}
 
$id = $_GET["id"];
 
$stmt = $conexao->prepare("DELETE FROM clientes WHERE id = ?");
$stmt->bind_param("i", $id);
 
if ($stmt->execute()) {
    header("Location: ../pages/listar_clientes.php");
    exit();
} else {
    die("Não foi possível excluir: este cliente possui pagamentos vinculados. " .
        "Erro do banco: " . $conexao->error);
}
?>
 