<?php
session_start();
if (!isset($_SESSION['usuarioNiveisAcessoId']) || $_SESSION['usuarioNiveisAcessoId'] != 2) {
    header("Location: login.php");
    exit;
}
include_once("conexao.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = mysqli_real_escape_string($conn, $_POST['usuario_nome']);
    $email = mysqli_real_escape_string($conn, $_POST['usuario_email']);
    $senha = password_hash($_POST['usuario_senha'], PASSWORD_DEFAULT);
    $nivel = mysqli_real_escape_string($conn, $_POST['usuario_nivelacesso']);
    $ativo = isset($_POST['usuario_ativo']) ? 1 : 0;

    $sql = "INSERT INTO alansteindorff_usuario (usuario_nome, usuario_email, usuario_senha, usuario_nivelacesso, usuario_ativo) 
        VALUES ('$nome', '$email', '$senha', '$nivel', $ativo)";
    if (mysqli_query($conn, $sql)) {
        $_SESSION['msg'] = "Usuário cadastrado com sucesso!";
        header("Location: administrador.php");
        exit;
    } else {
        $erro = "Erro ao cadastrar usuário.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cadastrar Usuário</title>
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
                        <span class="fa fa-sign-out"></span> <span>Sair</span>
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
        <h2>Cadastrar Usuário</h2>
        <?php if (isset($erro))
            echo "<div style='color:red; margin-bottom:10px;'>$erro</div>"; ?>
        <form method="POST">
            <div class="formulario">
                <label for="usuario_nome">Nome</label>
                <input type="text" id="usuario_nome" name="usuario_nome" required />
            </div>
            <div class="formulario">
                <label for="usuario_email">Email</label>
                <input type="email" id="usuario_email" name="usuario_email" required />
            </div>
            <div class="formulario">
                <label for="usuario_senha">Senha</label>
                <input type="password" id="usuario_senha" name="usuario_senha" required />
            </div>
            <div class="formulario">
                <label for="usuario_nivelacesso">Nível</label>
                <select id="usuario_nivelacesso" name="usuario_nivelacesso">
                    <option value="2">Administrador</option>
                    <option value="1">Gerente</option>
                    <option value="0">Usuário</option>
                </select>
            </div>
            <div class="formulario checkbox-inline">
                <input type="checkbox" name="usuario_ativo" id="usuario_ativo" checked>
                <label for="usuario_ativo" style="margin-bottom:0;">Ativo</label>
            </div>
            <button type="submit" class="btn-login">Cadastrar</button>
            <a href="administrador.php" class="back-link">← Voltar para o painel</a>
        </form>
    </div>
</body>

</html>