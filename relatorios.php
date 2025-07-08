
<?php
// Inicia a sessão para controle de login e permissões
session_start();
// Permite acesso apenas para gerente (1) ou administrador (2)
if (!isset($_SESSION['usuarioNiveisAcessoId']) || ($_SESSION['usuarioNiveisAcessoId'] != 1 && $_SESSION['usuarioNiveisAcessoId'] != 2)) {
    header("Location: login.php");
    exit;
}
// Inclui o arquivo de conexão com o banco de dados
include_once("conexao.php");

$sql = "SELECT r.id, r.golpe_id, r.usuario_id, r.mensagem, r.data_envio, g.golpe_nome, g.personagem_id, p.personagem_nome FROM alansteindorff_report r JOIN alansteindorff_golpe g ON r.golpe_id = g.golpe_id JOIN alansteindorff_personagem p ON g.personagem_id = p.personagem_id ORDER BY r.data_envio DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="pt-br">


<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Relatórios de Erros - TEKKENLIST</title>
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

    <div class="relatorios-container">
        <div class="relatorios-title">
            <span class="fa fa-exclamation-triangle" style="color:#ff1c51;margin-right:10px;"></span>
            Relatórios de Erros dos Usuários
        </div>
        <div class="report-list">
            <?php if (mysqli_num_rows($result) == 0): ?>
                <!-- Caso não haja nenhum relatório -->
                <div style="color:#ccc; text-align:center; font-size:1.2rem; margin-top:40px;">
                    Nenhum reporte de erro enviado.
                </div>
            <?php else: ?>
                <!-- Loop para exibir cada relatório -->
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <div class="report-card">
                        <div class="report-header">
                            <!-- Nome do personagem e golpe relacionado ao erro -->
                            <span class="report-personagem"><?= htmlspecialchars($row['personagem_nome']) ?></span>
                            <span class="fa fa-angle-right" style="color:#ff1c51;"></span>
                            <span class="report-golpe"><?= htmlspecialchars($row['golpe_nome']) ?></span>
                            <span class="report-date">
                                <span class="fa fa-clock-o"></span>
                                <?= date('d/m/Y H:i', strtotime($row['data_envio'])) ?>
                            </span>
                        </div>
                        <div class="report-delete">
                            <!-- Botão para apagar o relatório -->
                            <form method="get" action="deletar_reporte.php" style="display:inline;"
                                onsubmit="return confirm('Tem certeza que deseja apagar este relatório?');">
                                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                <button type="submit" class="goto-btn delete-btn">
                                    <span class="fa fa-trash"></span> Apagar
                                </button>
                            </form>
                        </div>
                        <!-- Mensagem do usuário sobre o erro -->
                        <div class="report-msg"><?= nl2br(htmlspecialchars($row['mensagem'])) ?></div>
                        <div class="report-actions">
                            <!-- Link para ir direto ao golpe reportado -->
                            <a class="goto-btn"
                                href="<?= strtolower(str_replace(' ', '', $row['personagem_nome'])) ?>.php#golpe<?= $row['golpe_id'] ?>"
                                target="_blank">
                                <span class="fa fa-external-link"></span> Ir para o golpe
                            </a>
                        </div>
                        <?php if ($row['usuario_id']): ?>
                            <!-- Exibe o ID do usuário que reportou, se houver -->
                            <div class="report-user">
                                <span class="fa fa-user"></span>
                                Usuário ID: <?= intval($row['usuario_id']) ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>