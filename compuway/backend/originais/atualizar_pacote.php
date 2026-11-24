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
$nome = trim($_POST["nome"] ?? "");
$valor = $_POST["valor"] ?? "";
$descricao = trim($_POST["descricao"] ?? "");
$cursos = $_POST["cursos"] ?? [];
if ($id <= 0 || $nome === "" || !is_numeric($valor) || (float)$valor <= 0 ||
    !is_array($cursos) || count($cursos) === 0) {
    die("Informe nome, valor positivo e pelo menos um curso.");
}
$conexao->begin_transaction();
try {
    $stmt = $conexao->prepare("UPDATE pacotes SET nome = ?, valor = ?, descricao = ? WHERE id = ?");
    $stmt->bind_param("sdsi", $nome, $valor, $descricao, $id);
    $stmt->execute();
    $stmt->close();

    $stmt = $conexao->prepare("DELETE FROM pacote_cursos WHERE pacote_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    $stmt = $conexao->prepare("INSERT INTO pacote_cursos (pacote_id, curso_id) VALUES (?, ?)");
    foreach ($cursos as $curso_id) {
        $curso_id = (int)$curso_id;
        if ($curso_id <= 0) {
            throw new Exception("Curso inválido.");
        }
        $stmt->bind_param("ii", $id, $curso_id);
        $stmt->execute();
    }
    $stmt->close();
    $conexao->commit();
    header("Location: ../pages/pacotes.php?editado=1");
    exit();
} catch (Throwable $e) {
    $conexao->rollback();
    die("Não foi possível atualizar o pacote. Nenhuma alteração foi salva.");
}
