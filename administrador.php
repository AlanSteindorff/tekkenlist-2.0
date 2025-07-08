<?php
session_start();
if (!isset($_SESSION['usuarioNiveisAcessoId']) || $_SESSION['usuarioNiveisAcessoId'] != 2) {
    header("Location: login.php");
    exit;
}
include_once("conexao.php");

// Busca todos os usuários
$sql = "SELECT usuario_id, usuario_nome, usuario_email, usuario_nivelacesso, usuario_ativo FROM alansteindorff_usuario";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador</title>
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
    </header>
    <main class="character-selection">
        <div class="top-buttons">
            <a class="btn btn-top" href="cadastrar_usuario.php">Cadastrar Usuário</a>
            <a class="btn btn-top" href="log.php">Log</a>
        </div>
        <table>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Nível</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr class="<?= $row['usuario_ativo'] ? '' : 'inativo' ?>">
                    <td><?= $row['usuario_id'] ?></td>
                    <td><?= htmlspecialchars($row['usuario_nome']) ?></td>
                    <td><?= htmlspecialchars($row['usuario_email']) ?></td>
                    <td><?= $row['usuario_nivelacesso'] ?></td>
                    <td><?= $row['usuario_ativo'] ? 'Ativo' : 'Inativo' ?></td>
                    <td>
                        <a class="btn" href="editar_usuario.php?id=<?= $row['usuario_id'] ?>">Editar</a>
                        <?php if ($row['usuario_ativo']): ?>
                            <a class="btn" href="inativar_usuario.php?id=<?= $row['usuario_id'] ?>"
                                onclick="return confirm('Deseja inativar este usuário?')">Inativar</a>
                        <?php else: ?>
                            <span class="btn inativo">Inativo</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </main>
</body>

</html>