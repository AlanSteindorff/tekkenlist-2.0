<?php
session_start();
include_once("conexao.php");

// Permissão: só ADM ou gerente
if (!isset($_SESSION['usuarioNiveisAcessoId']) || ($_SESSION['usuarioNiveisAcessoId'] != 1 && $_SESSION['usuarioNiveisAcessoId'] != 2)) {
    header("Location: login.php");
    exit;
}

// Recebe o ID do golpe via POST
if (!isset($_POST['id']) || !is_numeric($_POST['id'])) {
    header("Location: index.php");
    exit;
}

$golpe_id = intval($_POST['id']);

// Descobre personagem para redirecionar corretamente
$sql = "SELECT personagem_id FROM alansteindorff_golpe WHERE golpe_id = $golpe_id LIMIT 1";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if (!$row) {
    header("Location: index.php");
    exit;
}

$personagem_id = $row['personagem_id'];

// Descobre nome do personagem para montar o redirecionamento
$sql2 = "SELECT personagem_nome FROM alansteindorff_personagem WHERE personagem_id = $personagem_id LIMIT 1";
$result2 = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_assoc($result2);

if (!$row2) {
    header("Location: index.php");
    exit;
}

$personagem_nome = strtolower(str_replace(' ', '', $row2['personagem_nome']));

// Deleta o golpe
$sql_del = "DELETE FROM alansteindorff_golpe WHERE golpe_id = $golpe_id LIMIT 1";
mysqli_query($conn, $sql_del);

// Redireciona para a página do personagem
header("Location: {$personagem_nome}.php");
exit;