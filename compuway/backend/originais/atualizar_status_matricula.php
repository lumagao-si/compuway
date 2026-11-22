<?php
session_start();
require "conexao.php";
if (!isset($_SESSION["admin_id"])) {
    die("Acesso negado.");
}
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Acesso inválido.");
}
$id = (int)($_POST["id"] ?? 0);
$status = $_POST["status"] ?? "";
if ($id <= 0 || !in_array($status, ["ativa", "concluida", "cancelada"], true)) {
    die("Matrícula ou status inválido.");
}
$stmt = $conexao->prepare("SELECT status FROM matriculas WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$atual = $stmt->get_result()->fetch_assoc();
$stmt->close();
if (!$atual) {
    die("Matrícula não encontrada.");
}
if ($atual["status"] !== $status) {
    $stmt = $conexao->prepare("UPDATE matriculas SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $id);
    $stmt->execute();
    $stmt->close();

    $descricao = "Status alterado de " . $atual["status"] . " para " . $status;
    $stmt = $conexao->prepare("INSERT INTO matricula_historico (matricula_id, status, descricao) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $id, $status, $descricao);
    $stmt->execute();
    $stmt->close();
}
header("Location: ../pages/matriculas.php");
exit();
