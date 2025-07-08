
<?php
// Inicia a sessão para controle de login e permissões
session_start();
// Permite acesso apenas para administradores (nível 2)
if (!isset($_SESSION['usuarioNiveisAcessoId']) || $_SESSION['usuarioNiveisAcessoId'] != 2) {
    header("Location: login.php");
    exit;
}
// Inclui o arquivo de conexão com o banco de dados
include_once("conexao.php");

// Se foi passado um ID via GET, busca os dados do usuário para edição
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM alansteindorff_usuario WHERE usuario_id = $id";
    $result = mysqli_query($conn, $sql);
    $usuario = mysqli_fetch_assoc($result);
}

// Se o formulário foi enviado via POST, atualiza os dados do usuário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['usuario_id']);
    $nome = mysqli_real_escape_string($conn, $_POST['usuario_nome']);
    $email = mysqli_real_escape_string($conn, $_POST['usuario_email']);
    $nivel = mysqli_real_escape_string($conn, $_POST['usuario_nivelacesso']);
    $ativo = isset($_POST['usuario_ativo']) ? 1 : 0;

    // Atualiza os dados do usuário no banco de dados
    $sql = "UPDATE alansteindorff_usuario SET usuario_nome = '$nome', usuario_email = '$email', usuario_nivelacesso = '$nivel', usuario_ativo = $ativo WHERE usuario_id = $id";
    if (mysqli_query($conn, $sql)) {
        // Mensagem de sucesso na sessão
        $_SESSION['msg'] = "Usuário atualizado com sucesso!";
    } else {
        // Mensagem de erro na sessão
        $_SESSION['msg'] = "Erro ao atualizar usuário.";
    }
    // Redireciona para o painel do administrador
    header("Location: administrador.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Editar Usuário</title>
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

    <div class="login editar-usuario">
        <h2>Editar Usuário</h2>
        <?php if (isset($erro)) echo "<div style='color:red; margin-bottom:10px;'>$erro</div>"; ?>
        <form method="POST">
            <input type="hidden" name="usuario_id" value="<?= $usuario['usuario_id'] ?>">
            <div class="formulario">
                <label for="usuario_nome">Nome</label>
                <input type="text" id="usuario_nome" name="usuario_nome" value="<?= htmlspecialchars($usuario['usuario_nome']) ?>" required />
            </div>
            <div class="formulario">
                <label for="usuario_email">Email</label>
                <input type="email" id="usuario_email" name="usuario_email" value="<?= htmlspecialchars($usuario['usuario_email']) ?>" required />
            </div>
            <div class="formulario">
                <label for="usuario_nivelacesso">Nível</label>
                <select id="usuario_nivelacesso" name="usuario_nivelacesso">
                    <option value="2" <?= $usuario['usuario_nivelacesso'] == '2' ? 'selected' : '' ?>>Administrador</option>
                    <option value="1" <?= $usuario['usuario_nivelacesso'] == '1' ? 'selected' : '' ?>>Gerente</option>
                    <option value="0" <?= $usuario['usuario_nivelacesso'] == '0' ? 'selected' : '' ?>>Usuário</option>
                </select>
            </div>
            <div class="formulario checkbox-inline">
                <input type="checkbox" name="usuario_ativo" id="usuario_ativo" <?= $usuario['usuario_ativo'] ? 'checked' : '' ?>>
                <label for="usuario_ativo" style="margin-bottom:0;">Ativo</label>
            </div>
            <button type="submit" class="btn-login">Salvar</button>
            <a href="administrador.php" class="back-link">← Voltar para o painel</a>
        </form>
    </div>
</body>