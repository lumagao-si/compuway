<?php
 
 
 
session_start();
require "conexao.php";
 
if (!isset($_SESSION["admin_id"])) {
    die("Acesso negado: faça login como administrador.");
}
 
if ($_SERVER["REQUEST_METHOD"] === "POST") {
 
    $id = $_POST["id"];
    $nome = trim($_POST["nome"]);
    $descricao = trim($_POST["descricao"]);
    $valor = $_POST["valor"];
    $carga_horaria = ($_POST["carga_horaria"] ?? "") !== "" ? (int)$_POST["carga_horaria"] : null;
    $duracao_meses = ($_POST["duracao_meses"] ?? "") !== "" ? (int)$_POST["duracao_meses"] : null;
 
    if (empty($nome) || empty($valor)) {
        die("Erro: nome e valor são obrigatórios.");
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
 
     
     
    $stmt = $conexao->prepare(
        "UPDATE cursos SET nome = ?, descricao = ?, valor = ?, carga_horaria = ?, duracao_meses = ? WHERE id = ?"
    );
    $stmt->bind_param("ssdiii", $nome, $descricao, $valor, $carga_horaria, $duracao_meses, $id);
 
    if ($stmt->execute()) {
        header("Location: ../pages/listar_cursos_admin.php");
        exit();
    } else {
        echo "Erro ao atualizar curso: " . $conexao->error;
    }
 
    $stmt->close();
    $conexao->close();
 
} else {
    echo "Acesso inválido.";
}
?>
 