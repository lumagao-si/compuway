<?php
 
 
 
 
session_start();  
require "conexao.php";
 
if ($_SERVER["REQUEST_METHOD"] === "POST") {
 
    $email = trim($_POST["email"]);
    $senha = $_POST["senha"];
 
    if (empty($email) || empty($senha)) {
        die("Erro: e-mail e senha são obrigatórios.");
    }
 
     
    $stmt = $conexao->prepare("SELECT id, nome, senha FROM clientes WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();
 
    if ($resultado->num_rows === 0) {
        die("Erro: e-mail ou senha incorretos.");
    }
 
    $cliente = $resultado->fetch_assoc();
 
     
     
     
    if (password_verify($senha, $cliente["senha"])) {
 
         
         
         
        $_SESSION["cliente_id"] = $cliente["id"];
        $_SESSION["cliente_nome"] = $cliente["nome"];
 
        echo "Login realizado com sucesso! Bem-vindo, " . $cliente["nome"];
 
    } else {
         
         
         
        die("Erro: e-mail ou senha incorretos.");
    }
 
    $stmt->close();
    $conexao->close();
 
} else {
    echo "Acesso inválido.";
}
?>
 
