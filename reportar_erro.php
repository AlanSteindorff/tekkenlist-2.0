
<?php
session_start();
include_once("conexao.php");

// Só permite acesso se o usuário estiver logado
if (!isset($_SESSION['usuarioId'])) {
    header("Location: login.php");
    exit;
}

// Se o formulário foi enviado via POST e os campos obrigatórios existem
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['golpe_id'], $_POST['mensagem'])) {
    $golpe_id = intval($_POST['golpe_id']); // ID do golpe reportado
    $usuario_id = intval($_SESSION['usuarioId']); // ID do usuário que reportou
    $mensagem = mysqli_real_escape_string($conn, $_POST['mensagem']); // Mensagem do usuário

    // Insere o relatório de erro no banco de dados
    $sql = "INSERT INTO alansteindorff_report (golpe_id, usuario_id, mensagem) VALUES ($golpe_id, $usuario_id, '$mensagem')";
    if (mysqli_query($conn, $sql)) {
        // Redireciona para a página do personagem com mensagem de sucesso
        header("Location: shaheen.php?report=ok");
        exit;
    } else {
        // Redireciona para a página do personagem com mensagem de erro
        header("Location: shaheen.php?report=erro");
        exit;
    }
}
// Se não for POST ou faltar campos, redireciona para a página do personagem
header("Location: shaheen.php");
exit;
?>