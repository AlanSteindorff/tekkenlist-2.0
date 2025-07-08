<?php
session_start();
if (!isset($_SESSION['usuarioNiveisAcessoId']) || ($_SESSION['usuarioNiveisAcessoId'] != 1 && $_SESSION['usuarioNiveisAcessoId'] != 2)) {
    header("Location: login.php");
    exit;
}
include_once("conexao.php");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    mysqli_query($conn, "DELETE FROM alansteindorff_report WHERE id = $id");
}
header("Location: relatorios.php");
exit;
?>