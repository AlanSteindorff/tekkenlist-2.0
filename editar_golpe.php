<?php
session_start();
if (!isset($_SESSION['usuarioNiveisAcessoId']) || ($_SESSION['usuarioNiveisAcessoId'] != 1 && $_SESSION['usuarioNiveisAcessoId'] != 2)) {
    header("Location: login.php");
    exit;
}
include_once("conexao.php");

if (!isset($_GET['id'])) {
    echo "Golpe não especificado.";
    exit;
}

$golpe_id = intval($_GET['id']);

// Busca os dados do golpe
$sql = "SELECT * FROM alansteindorff_golpe WHERE golpe_id = $golpe_id";
$result = mysqli_query($conn, $sql);
$golpe = mysqli_fetch_assoc($result);

if (!$golpe) {
    echo "Golpe não encontrado.";
    exit;
}

// Atualiza se enviado via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = mysqli_real_escape_string($conn, $_POST['golpe_nome']);
    $tipo = mysqli_real_escape_string($conn, $_POST['golpe_tipo']);
    $qtdhit = mysqli_real_escape_string($conn, $_POST['golpe_qtdhit']);
    $comando = mysqli_real_escape_string($conn, $_POST['golpe_comando']);
    $hitlvl = mysqli_real_escape_string($conn, $_POST['golpe_hitlvl']);
    $dano = mysqli_real_escape_string($conn, $_POST['golpe_dano']);
    $startf = mysqli_real_escape_string($conn, $_POST['golpe_startf']);
    $blockf = mysqli_real_escape_string($conn, $_POST['golpe_blockf']);

    $sql_update = "UPDATE alansteindorff_golpe SET 
        golpe_nome='$nome',
        golpe_tipo='$tipo',
        golpe_qtdhit='$qtdhit',
        golpe_comando='$comando',
        golpe_hitlvl='$hitlvl',
        golpe_dano='$dano',
        golpe_startf='$startf',
        golpe_blockf='$blockf'
        WHERE golpe_id = $golpe_id";
    if (mysqli_query($conn, $sql_update)) {
        header("Location: {$_GET['voltar']}#golpe$golpe_id");
        exit;
    } else {
        $erro = "Erro ao atualizar golpe.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <title>Editar Golpe</title>
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
    <div class="login edit-move">
        <h2>Editar Golpe</h2>
        <?php if (isset($erro))
            echo "<div style='color:red;'>$erro</div>"; ?>
        <form method="POST" class="edit-golpe-form">
            <div class="edit-golpe-grid">
                <div>
                    <label>Nome<br>
                        <input type="text" name="golpe_nome" value="<?= htmlspecialchars($golpe['golpe_nome']) ?>"
                            required>
                    </label>
                    <label>Tipo<br>
                        <input type="text" name="golpe_tipo" value="<?= htmlspecialchars($golpe['golpe_tipo']) ?>">
                    </label>
                    <label>Quantidade de hits<br>
                        <input type="text" name="golpe_qtdhit" value="<?= htmlspecialchars($golpe['golpe_qtdhit']) ?>">
                    </label>
                    <label>Comando<br>
                        <input type="text" name="golpe_comando"
                            value="<?= htmlspecialchars($golpe['golpe_comando']) ?>">
                    </label>
                </div>
                <div>
                    <label>Hit Level<br>
                        <input type="text" name="golpe_hitlvl" value="<?= htmlspecialchars($golpe['golpe_hitlvl']) ?>">
                    </label>
                    <label>Dano<br>
                        <input type="text" name="golpe_dano" value="<?= htmlspecialchars($golpe['golpe_dano']) ?>">
                    </label>
                    <label>Startup Frames<br>
                        <input type="text" name="golpe_startf" value="<?= htmlspecialchars($golpe['golpe_startf']) ?>">
                    </label>
                    <label>Frames on block<br>
                        <input type="text" name="golpe_blockf" value="<?= htmlspecialchars($golpe['golpe_blockf']) ?>">
                    </label>
                </div>
            </div>
            <button type="submit" class="btn-login">Salvar</button>
            <a href="<?= htmlspecialchars($_GET['voltar']) ?>#golpe<?= $golpe_id ?>" class="back-link">Cancelar</a>
        </form>
    </div>
</body>

</html>