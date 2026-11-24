<?php
 
 
 
 
session_start();
require "conexao.php";
 
 
 
 
if (!isset($_SESSION["admin_id"])) {
    die("Acesso negado: faça login como administrador.");
}
 
if ($_SERVER["REQUEST_METHOD"] === "POST") {
 
    $nome = trim($_POST["nome"]);
    $descricao = trim($_POST["descricao"]);
    $valor = $_POST["valor"];
    $carga_horaria = ($_POST["carga_horaria"] ?? "") !== "" ? (int)$_POST["carga_horaria"] : null;
    $duracao_meses = ($_POST["duracao_meses"] ?? "") !== "" ? (int)$_POST["duracao_meses"] : null;
 
     
    if (empty($nome) || empty($valor)) {
        die("Erro: nome e valor do curso são obrigatórios.");
    }
 
     
     
    if (!is_numeric($valor) || (float)$valor <= 0) {
        die("Erro: valor precisa ser um número maior que zero.");
    }
    if ($carga_horaria !== null && $carga_horaria < 1) {
        die("Erro: carga horária deve ser maior que zero.");
    }
    if ($duracao_meses !== null && $duracao_meses < 1) {
        die("Erro: duração deve ser maior que zero.");
    }
 
     
    $stmt = $conexao->prepare("INSERT INTO cursos (nome, descricao, valor, carga_horaria) VALUES (?, ?, ?, ?)");
     
     
    $stmt->bind_param("ssdi", $nome, $descricao, $valor, $carga_horaria);
 
    if ($stmt->execute()) {
        echo "Curso cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar curso: " . $conexao->error;
    }
 
    $stmt->close();
    $conexao->close();
 
} else {
    echo "Acesso inválido.";
}
?>
 
 