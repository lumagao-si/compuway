<?php
 
 
 
 
 
session_start();
require "conexao.php";
 
 
 
if (!isset($_SESSION["admin_id"])) {
    die("Acesso negado: faça login como administrador.");
}
 
if ($_SERVER["REQUEST_METHOD"] === "POST") {
 
    $cliente_id = $_POST["cliente_id"];
    $curso_id = $_POST["curso_id"];
    $valor = $_POST["valor"];
    $data_vencimento = $_POST["data_vencimento"];
 
     
    if (empty($cliente_id) || empty($curso_id) || empty($valor) || empty($data_vencimento)) {
        die("Erro: todos os campos são obrigatórios.");
    }
 
    if (!is_numeric($valor)) {
        die("Erro: valor precisa ser um número.");
    }
 
     
     
     
    $stmt = $conexao->prepare(
        "INSERT INTO pagamentos (cliente_id, curso_id, valor, data_vencimento) VALUES (?, ?, ?, ?)"
    );
     
    $stmt->bind_param("iids", $cliente_id, $curso_id, $valor, $data_vencimento);
 
    if ($stmt->execute()) {
        echo "Pagamento registrado com sucesso!";
    } else {
        echo "Erro ao registrar pagamento: " . $conexao->error;
    }
 
    $stmt->close();
    $conexao->close();
 
} else {
    echo "Acesso inválido.";
}
?>
 