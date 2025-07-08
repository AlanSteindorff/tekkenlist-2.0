<?php
session_start();
include_once("conexao.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = mysqli_real_escape_string($conn, $_POST['usuario_nome']);
    $email = mysqli_real_escape_string($conn, $_POST['usuario_email']);
    $senha = password_hash($_POST['usuario_senha'], PASSWORD_DEFAULT);
    $nivel = 0; // Sempre usuário comum
    $ativo = 1; // Sempre ativo

    $sql = "INSERT INTO alansteindorff_usuario (usuario_nome, usuario_email, usuario_senha, usuario_nivelacesso, usuario_ativo) 
        VALUES ('$nome', '$email', '$senha', '$nivel', $ativo)";
    if (mysqli_query($conn, $sql)) {
        $_SESSION['msg'] = "Account created successfully! Please log in.";
        header("Location: login.php");
        exit;
    } else {
        $erro = "Error creating account. Please try another email.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Create Account</title>
    <link rel="stylesheet" href="tekkenlist.css" />
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
</head>

<body>
    <header class="cabeçalho">
        <div class="container">
            <div class="logotipo">
                <a href="index.php">
                    <img src="LOGOTIPO-TEKKENLIST1.png" alt="TEKKENLIST" />
                </a>
            </div>
            <nav class="menu-botoes">
                <?php if (isset($_SESSION['usuarioNiveisAcessoId']) && $_SESSION['usuarioNiveisAcessoId'] == 2): ?>
                    <a href="administrador.php" class="menu-btn adm-btn" title="Painel ADM">
                        <span class="fa fa-cogs"></span> <span>Painel ADM</span>
                    </a>
                <?php endif; ?>
                <?php if (isset($_SESSION['usuarioNiveisAcessoId']) && ($_SESSION['usuarioNiveisAcessoId'] == 1 || $_SESSION['usuarioNiveisAcessoId'] == 2)): ?>
                    <a href="relatorios.php" class="menu-btn rpt-btn" title="Relatórios">
                        <span class="fa fa-envelope"></span> <span>Relatórios</span>
                    </a>
                <?php endif; ?>
                <?php if (isset($_SESSION['usuarioId'])): ?>
                    <a href="logout.php" class="menu-btn sair-btn" title="Sair">
                        <span class="fa fa-sign-out"></span> <span>Logout</span>
                    </a>
                <?php else: ?>
                    <a href="login.php" class="menu-btn login-btn" title="Login">
                        <span class="fa fa-sign-in"></span> <span>Login</span>
                    </a>
                <?php endif; ?>
            </nav>
        </div>
    </header>

    <div class="login cadastro-usuario">
        <h2>Sign Up</h2>
        <?php if (isset($erro))
            echo "<div style='color:red; margin-bottom:10px;'>$erro</div>"; ?>
        <form method="POST">
            <div class="formulario">
                <label for="usuario_nome">Name</label>
                <input type="text" id="usuario_nome" name="usuario_nome" required />
            </div>
            <div class="formulario">
                <label for="usuario_email">Email</label>
                <input type="email" id="usuario_email" name="usuario_email" required />
            </div>
            <div class="formulario">
                <label for="usuario_senha">Password</label>
                <input type="password" id="usuario_senha" name="usuario_senha" required />
            </div>
            <button type="submit" class="btn-login">Create Account</button>
            <a href="login.php" class="back-link">← Back to login</a>
        </form>
    </div>
    <footer class="site-footer">
        <div class="footer-content">
            <span>© 2025 Made by Alan Steindorff</span>
            <span class="footer-divider">|</span>
            <span>
                Tekkenlist is a fan-made, unofficial resource. All Tekken trademarks and character copyrights belong to
                Bandai
                Namco Entertainment Inc.
            </span>
        </div>
    </footer>
</body>

</html>