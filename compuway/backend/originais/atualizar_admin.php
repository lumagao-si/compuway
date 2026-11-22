<?php
 
session_start();
require "conexao.php";
 
if (!isset($_SESSION["admin_id"])) {
    die("Acesso negado: faça login como administrador.");
}
 
if ($_SERVER["REQUEST_METHOD"] === "POST") {
 
    $id = $_POST["id"];
    $nome = trim($_POST["nome"]);
    $email = trim($_POST["email"]);
 
    if (empty($nome) || empty($email)) {
        die("Erro: nome e e-mail são obrigatórios.");
    }
 
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Erro: e-mail inválido.");
    }
 
    $verifica = $conexao->prepare("SELECT id FROM administradores WHERE email = ? AND id != ?");
    $verifica->bind_param("si", $email, $id);
    $verifica->execute();
    if ($verifica->get_result()->num_rows > 0) {
        die("Erro: este e-mail já está sendo usado por outro administrador.");
    }
 
    $stmt = $conexao->prepare("UPDATE administradores SET nome = ?, email = ? WHERE id = ?");
    $stmt->bind_param("ssi", $nome, $email, $id);
 
    if ($stmt->execute()) {
        header("Location: ../pages/listar_admins.php");
        exit();
    } else {
        echo "Erro ao atualizar administrador: " . $conexao->error;
    }
 
    $stmt->close();
    $conexao->close();
 
} else {
    echo "Acesso inválido.";
}
?>
 