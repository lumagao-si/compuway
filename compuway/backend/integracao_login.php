<?php
// Aqui ocorre a integração: recebe os campos usuario e senha do formulário do frontend.
session_start();
require_once __DIR__ . '/conexao.php';

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../system/login.php");
    exit();
}

// O frontend chama o campo de usuario; no banco, o identificador cadastrado é email.
$usuario = trim($_POST["usuario"] ?? "");
$senha = $_POST["senha"] ?? "";

$stmt = $conexao->prepare("SELECT id, nome, senha FROM administradores WHERE email = ? LIMIT 1");
$stmt->bind_param("s", $usuario);
$stmt->execute();
$resultado = $stmt->get_result();
$admin = $resultado->fetch_assoc();

if ($admin && password_verify($senha, $admin["senha"])) {
    session_regenerate_id(true);
    $_SESSION["admin_id"] = $admin["id"];
    $_SESSION["admin_nome"] = $admin["nome"];
    header("Location: ../system/dashboard.php");
    exit();
}

header("Location: ../system/login.php?erro=1");
exit();
