<?php
 
 
 
 
 
 
session_start();
require "conexao.php";
 
if (!isset($_SESSION["admin_id"])) {
    die("Acesso negado: faça login como administrador.");
}
 
if ($_SERVER["REQUEST_METHOD"] === "POST") {
 
    $id = $_POST["id"];
    $valor = $_POST["valor"];
    $data_vencimento = $_POST["data_vencimento"];
    $status = $_POST["status"];
 
    if (empty($valor) || empty($data_vencimento) || empty($status)) {
        die("Erro: todos os campos são obrigatórios.");
    }
 
    if (!is_numeric($valor)) {
        die("Erro: valor precisa ser um número.");
    }
 
     
    $atual = $conexao->prepare("SELECT status, data_pagamento FROM pagamentos WHERE id = ?");
    $atual->bind_param("i", $id);
    $atual->execute();
    $dados_atuais = $atual->get_result()->fetch_assoc();
 
    if (!$dados_atuais) {
        die("Erro: pagamento não encontrado.");
    }
 
     
    if ($status === "pago" && $dados_atuais["status"] !== "pago") {
         
        $data_pagamento = date("Y-m-d");
    } elseif ($status !== "pago") {
         
        $data_pagamento = null;
    } else {
         
        $data_pagamento = $dados_atuais["data_pagamento"];
    }
 
    $stmt = $conexao->prepare(
        "UPDATE pagamentos SET valor = ?, data_vencimento = ?, status = ?, data_pagamento = ? WHERE id = ?"
    );
    $stmt->bind_param("dsssi", $valor, $data_vencimento, $status, $data_pagamento, $id);
 
    if ($stmt->execute()) {
        header("Location: ../pages/listar_pagamentos.php");
        exit();
    } else {
        echo "Erro ao atualizar pagamento: " . $conexao->error;
    }
 
    $stmt->close();
    $conexao->close();
 
} else {
    echo "Acesso inválido.";
}
?>
 