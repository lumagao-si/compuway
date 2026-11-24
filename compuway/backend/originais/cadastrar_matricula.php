<?php
 
session_start();
require "conexao.php";

if (!isset($_SESSION["admin_id"])) {
    die("Acesso negado.");
}
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Acesso inválido.");
}

$cliente_id = (int)($_POST["cliente_id"] ?? 0);
$curso_id = (int)($_POST["curso_id"] ?? 0);
$pacote_id = (int)($_POST["pacote_id"] ?? 0);
$data_matricula = $_POST["data_matricula"] ?? "";
$primeiro_vencimento = $_POST["primeiro_vencimento"] ?? "";
$quantidade = (int)($_POST["quantidade_mensalidades"] ?? 0);

 
if ($cliente_id <= 0 || (($curso_id > 0) === ($pacote_id > 0)) ||
    $quantidade < 1 || $quantidade > 60 ||
    !preg_match('/^\d{4}-\d{2}-\d{2}$/', $data_matricula) ||
    !preg_match('/^\d{4}-\d{2}-\d{2}$/', $primeiro_vencimento)) {
    die("Confira o aluno, o curso/pacote, as datas e a quantidade (1 a 60).");
}

$curso_id_db = $curso_id > 0 ? $curso_id : null;
$pacote_id_db = $pacote_id > 0 ? $pacote_id : null;
$tabela = $curso_id > 0 ? "cursos" : "pacotes";
$id_produto = $curso_id > 0 ? $curso_id : $pacote_id;

$stmt = $conexao->prepare("SELECT valor FROM " . $tabela . " WHERE id = ? AND ativo = 1");
$stmt->bind_param("i", $id_produto);
$stmt->execute();
$produto = $stmt->get_result()->fetch_assoc();
$stmt->close();
if (!$produto) {
    die("Curso ou pacote não encontrado ou inativo.");
}
$valor = (float)$produto["valor"];

$conexao->begin_transaction();
try {
    $stmt = $conexao->prepare(
        "INSERT INTO matriculas (cliente_id, curso_id, pacote_id, data_matricula, primeiro_vencimento, quantidade_mensalidades)
         VALUES (?, ?, ?, ?, ?, ?)"
    );
    $stmt->bind_param("iiissi", $cliente_id, $curso_id_db, $pacote_id_db, $data_matricula, $primeiro_vencimento, $quantidade);
    $stmt->execute();
    $matricula_id = $conexao->insert_id;
    $stmt->close();

    $historico = $conexao->prepare("INSERT INTO matricula_historico (matricula_id, status, descricao) VALUES (?, 'ativa', 'Matrícula criada')");
    $historico->bind_param("i", $matricula_id);
    $historico->execute();
    $historico->close();

     
    $vencimento = new DateTime($primeiro_vencimento);
    $dia_vencimento = (int)$vencimento->format("d");
    $vencimento->modify("first day of this month");
    $pagamento = $conexao->prepare(
        "INSERT INTO pagamentos (cliente_id, curso_id, pacote_id, matricula_id, valor, data_vencimento, referencia, status)
         VALUES (?, ?, ?, ?, ?, ?, ?, 'pendente')"
    );
    for ($i = 0; $i < $quantidade; $i++) {
        $referencia = $vencimento->format("Y-m");
        $ultimo_dia = (int)$vencimento->format("t");
        $dia = min($dia_vencimento, $ultimo_dia);
        $data = $vencimento->format("Y-m-") . str_pad((string)$dia, 2, "0", STR_PAD_LEFT);
        $pagamento->bind_param("iiiidss", $cliente_id, $curso_id_db, $pacote_id_db, $matricula_id, $valor, $data, $referencia);
        $pagamento->execute();
        $vencimento->modify("+1 month");
    }
    $pagamento->close();
    $conexao->commit();
    header("Location: ../pages/matriculas.php?salvo=1");
    exit();
} catch (Throwable $e) {
    $conexao->rollback();
    die("Não foi possível criar a matrícula e as mensalidades. Nenhuma alteração foi salva.");
}
