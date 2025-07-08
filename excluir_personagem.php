<?php
session_start();
if (!isset($_SESSION['usuarioNiveisAcessoId']) || $_SESSION['usuarioNiveisAcessoId'] != 2) {
    header("Location: index.php");
    exit;
}
include_once("conexao.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['personagem_id'])) {
    $personagem_id = intval($_POST['personagem_id']);

    // Busca o caminho da imagem para excluir o arquivo físico
    $sql_img = "SELECT personagem_img FROM alansteindorff_personagem WHERE personagem_id = ?";
    $stmt_img = mysqli_prepare($conn, $sql_img);
    mysqli_stmt_bind_param($stmt_img, "i", $personagem_id);
    mysqli_stmt_execute($stmt_img);
    mysqli_stmt_bind_result($stmt_img, $img_path);
    mysqli_stmt_fetch($stmt_img);
    mysqli_stmt_close($stmt_img);

    // Exclui o personagem do banco
    $sql = "DELETE FROM alansteindorff_personagem WHERE personagem_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $personagem_id);
    if (mysqli_stmt_execute($stmt)) {
        // Exclui o arquivo de imagem, se existir e não for vazio
        if (!empty($img_path) && file_exists($img_path)) {
            unlink($img_path);
        }
        mysqli_stmt_close($stmt);
        header("Location: index.php?msg=excluido");
        exit;
    } else {
        mysqli_stmt_close($stmt);
        header("Location: index.php?msg=erro");
        exit;
    }
} else {
    header("Location: index.php");
    exit;
}