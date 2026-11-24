<?php
 
 
 
 
require "conexao.php";
 
 
if ($_SERVER["REQUEST_METHOD"] === "POST") {
 
     
     
    $nome = trim($_POST["nome"]);
    $email = trim($_POST["email"]);
    $senha = $_POST["senha"];
    $telefone = trim($_POST["telefone"] ?? "");
    $cpf = trim($_POST["cpf"] ?? "");
    $data_nascimento = ($_POST["data_nascimento"] ?? "") !== "" ? $_POST["data_nascimento"] : null;
    $endereco = trim($_POST["endereco"] ?? "");
 
     
    if (empty($nome) || empty($email) || empty($senha)) {
        die("Erro: nome, e-mail e senha são obrigatórios.");
    }
 
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Erro: e-mail inválido.");
    }
 
     
    $verifica = $conexao->prepare("SELECT id FROM clientes WHERE email = ?");
    $verifica->bind_param("s", $email);
    $verifica->execute();
    $resultado = $verifica->get_result();
 
    if ($resultado->num_rows > 0) {
        die("Erro: este e-mail já está cadastrado.");
    }
 
     
    $senha_criptografada = password_hash($senha, PASSWORD_DEFAULT);
 
     
     
     
     
    $stmt = $conexao->prepare("INSERT INTO clientes (nome, email, senha, telefone, cpf, data_nascimento, endereco) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $nome, $email, $senha_criptografada, $telefone, $cpf, $data_nascimento, $endereco);
 
    if ($stmt->execute()) {
        echo "Cadastro realizado com sucesso!";
    } else {
        echo "Erro ao cadastrar: " . $conexao->error;
    }
 
    $stmt->close();
    $conexao->close();
 
} else {
     
    echo "Acesso inválido.";
}
?>
 
