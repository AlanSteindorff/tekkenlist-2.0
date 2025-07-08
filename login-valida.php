<?php
session_start();
include_once("conexao.php");
if ((isset($_POST['usuario'])) && (isset($_POST['senha']))) {
    $usuario = mysqli_real_escape_string($conn, $_POST['usuario']);
    $senha = $_POST['senha'];

    $result_usuario = "SELECT * FROM alansteindorff_usuario WHERE usuario_email = '$usuario' && usuario_ativo = 1 LIMIT 1";
    $resultado_usuario = mysqli_query($conn, $result_usuario);
    $resultado = mysqli_fetch_assoc($resultado_usuario);

    if ($resultado && password_verify($senha, $resultado['usuario_senha'])) {
        $_SESSION['usuarioId'] = $resultado['usuario_id'];
        $_SESSION['usuarioNiveisAcessoId'] = $resultado['usuario_nivelacesso'];
        $_SESSION['usuarioEmail'] = $resultado['usuario_email'];

        // REGISTRA LOGIN NO LOG
        $usuario_id = $resultado['usuario_id'];
        mysqli_query($conn, "INSERT INTO alansteindorff_log (usuario_id, entrada, saida) VALUES ($usuario_id, NOW(), 'ativo')");
        header("Location: index.php");
    } else {
        $_SESSION['loginErro'] = "Usuário ou senha inválido";
        header("Location: login.php");
    }
} else {
    $_SESSION['loginErro'] = "Usuário ou senha inválido";
    header("Location: login.php");
}
?>