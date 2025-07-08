<?php
session_start();
if (!isset($_SESSION['usuarioNiveisAcessoId']) || $_SESSION['usuarioNiveisAcessoId'] != 2) {
    header("Location: login.php");
    exit;
}
include_once("conexao.php");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "UPDATE alansteindorff_usuario SET usuario_ativo = 0 WHERE usuario_id = $id";
    if (mysqli_query($conn, $sql)) {
        $_SESSION['msg'] = "Usuário inativado com sucesso!";
    } else {
        $_SESSION['msg'] = "Erro ao inativar usuário.";
    }
}
header("Location: administrador.php");
exit;
?>