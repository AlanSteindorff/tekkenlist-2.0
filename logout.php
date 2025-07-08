
<?php
session_start();
include_once("conexao.php");

// Se o usuário está logado, registra a saída no log
if (isset($_SESSION['usuarioId'])) {
    $usuario_id = $_SESSION['usuarioId'];
    // Atualiza o registro de log do usuário, marcando a saída e status como inativo
    mysqli_query($conn, "UPDATE alansteindorff_log SET saida = NOW(), status = 'inativo' WHERE usuario_id = $usuario_id AND saida = 'ativo'");
}

// Destroi todas as variáveis de sessão (logout)
session_destroy();
header("Location: login.php");
exit;
?>