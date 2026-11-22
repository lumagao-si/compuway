<?php
 
 
 
 
 
 
 
 
session_start();
require "conexao.php";
 
if (!isset($_SESSION["admin_id"])) {
    die("Acesso negado: faça login como administrador.");
}
 
if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
    die("Erro: administrador inválido.");
}
 
$id = $_GET["id"];
 
 
if ($id == $_SESSION["admin_id"]) {
    die("Erro: você não pode excluir sua própria conta enquanto estiver logado nela.");
}
 
 
$total = $conexao->query("SELECT COUNT(*) AS total FROM administradores")->fetch_assoc()["total"];
if ($total <= 1) {
    die("Erro: não é possível excluir o único administrador do sistema.");
}
 
$stmt = $conexao->prepare("DELETE FROM administradores WHERE id = ?");
$stmt->bind_param("i", $id);
 
if ($stmt->execute()) {
    header("Location: ../pages/listar_admins.php");
    exit();
} else {
    echo "Erro ao excluir administrador: " . $conexao->error;
}
?>
 