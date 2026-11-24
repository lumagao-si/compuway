<?php
 
 
 
 
 
 
session_start();
require "conexao.php";
 
if (!isset($_SESSION["admin_id"])) {
    die("Acesso negado: faça login como administrador.");
}
 
if ($_SERVER["REQUEST_METHOD"] === "POST") {
 
    $nome = trim($_POST["nome"]);
    $email = trim($_POST["email"]);
    $senha = $_POST["senha"];
 
    if (empty($nome) || empty($email) || empty($senha)) {
        die("Erro: todos os campos são obrigatórios.");
    }
 
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Erro: e-mail inválido.");
    }
 
    $verifica = $conexao->prepare("SELECT id FROM administradores WHERE email = ?");
    $verifica->bind_param("s", $email);
    $verifica->execute();
    if ($verifica->get_result()->num_rows > 0) {
        die("Erro: este e-mail já está cadastrado como administrador.");
    }
 
    $senha_criptografada = password_hash($senha, PASSWORD_DEFAULT);
 
    $stmt = $conexao->prepare("INSERT INTO administradores (nome, email, senha) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nome, $email, $senha_criptografada);
 
    if ($stmt->execute()) {
        header("Location: ../pages/listar_admins.php");
        exit();
    } else {
        echo "Erro ao cadastrar administrador: " . $conexao->error;
    }
 
    $stmt->close();
    $conexao->close();
 
} else {
    echo "Acesso inválido.";
}
?>
 