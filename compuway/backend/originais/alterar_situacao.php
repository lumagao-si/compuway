<?php
 
session_start();
require "conexao.php";
if (!isset($_SESSION["admin_id"])) {
    die("Acesso negado.");
}
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Acesso inválido.");
}
$tipo = $_POST["tipo"] ?? "";
$id = (int)($_POST["id"] ?? 0);
$voltar = $_POST["voltar"] ?? "dashboard.php";

$tabelas = [
    "aluno" => ["clientes", "listar_clientes.php"],
    "curso" => ["cursos", "listar_cursos_admin.php"],
    "pacote" => ["pacotes", "pacotes.php"]
];
if (!isset($tabelas[$tipo]) || $id <= 0) {
    die("Registro inválido.");
}
$tabela = $tabelas[$tipo][0];
$pagina = $tabelas[$tipo][1];
$stmt = $conexao->prepare("UPDATE " . $tabela . " SET ativo = IF(ativo = 1, 0, 1) WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
header("Location: ../pages/" . $pagina);
exit();
