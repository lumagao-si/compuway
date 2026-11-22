<?php
 
session_start();
require "conexao.php";

if (!isset($_SESSION["admin_id"])) {
    die("Acesso negado.");
}
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Acesso inválido.");
}

$nome = trim($_POST["nome"] ?? "");
$valor = $_POST["valor"] ?? "";
$descricao = trim($_POST["descricao"] ?? "");
$cursos = $_POST["cursos"] ?? [];

if ($nome === "" || !is_numeric($valor) || (float)$valor <= 0 || !is_array($cursos) || count($cursos) === 0) {
    die("Informe nome, valor positivo e pelo menos um curso.");
}

$conexao->begin_transaction();
try {
    $stmt = $conexao->prepare("INSERT INTO pacotes (nome, valor, descricao) VALUES (?, ?, ?)");
    $stmt->bind_param("sds", $nome, $valor, $descricao);
    $stmt->execute();
    $pacote_id = $conexao->insert_id;
    $stmt->close();

    $relacao = $conexao->prepare("INSERT INTO pacote_cursos (pacote_id, curso_id) VALUES (?, ?)");
    foreach ($cursos as $curso_id) {
        $curso_id = (int)$curso_id;
        if ($curso_id <= 0) {
            throw new Exception("Curso inválido.");
        }
        $relacao->bind_param("ii", $pacote_id, $curso_id);
        $relacao->execute();
    }
    $relacao->close();
    $conexao->commit();
    header("Location: ../pages/pacotes.php?salvo=1");
    exit();
} catch (Throwable $e) {
    $conexao->rollback();
    die("Não foi possível cadastrar o pacote. Confira os cursos selecionados.");
}
