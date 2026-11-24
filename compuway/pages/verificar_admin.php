<?php
// Aqui ocorre a integração: protege as telas administrativas usando a sessão criada no login.
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["admin_id"])) {
    header("Location: ../system/login.php");
    exit();
}
