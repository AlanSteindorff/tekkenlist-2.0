
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

// Busca os 100 registros mais recentes do log, incluindo email do usuário
$sql = "SELECT l.log_id, l.entrada, l.saida, u.usuario_email FROM alansteindorff_log l LEFT JOIN alansteindorff_usuario u ON l.usuario_id = u.usuario_id ORDER BY l.entrada DESC LIMIT 100";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="pt-br">


<head>
    <meta charset="UTF-8">
    <title>Log do Sistema</title>
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
        <a href="administrador.php" class="back-link" style="margin-right: 90%;">← Voltar para o painel</a>
        <h2 style="text-align: center;">Log do Sistema</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Usuário</th>
                <th>Entrada</th>
                <th>Saída</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?= $row['log_id'] ?></td>
                    <td><?= htmlspecialchars($row['usuario_email'] ?? 'Desconhecido') ?></td>
                    <td><?= $row['entrada'] ?></td>
                    <td>
                        <?php
                        // Exibe "ativo" se o usuário está logado, senão mostra a data/hora de saída
                        if ($row['saida'] === 'ativo') {
                            echo '<span style="color:green;">ativo</span>';
                        } else {
                            echo $row['saida'];
                        }
                        ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </main>
</body>

</html>