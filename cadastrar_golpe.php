<?php
session_start();
if (!isset($_SESSION['usuarioNiveisAcessoId']) || ($_SESSION['usuarioNiveisAcessoId'] != 1 && $_SESSION['usuarioNiveisAcessoId'] != 2)) {
    header("Location: login.php");
    exit;
}
include_once("conexao.php");

// Descobre personagem pelo GET
if (!isset($_GET['personagem_id'])) {
    echo "Personagem não especificado.";
    exit;
}
$personagem_id = intval($_GET['personagem_id']);
$sql_personagem = "SELECT personagem_nome FROM alansteindorff_personagem WHERE personagem_id = $personagem_id";
$result_personagem = mysqli_query($conn, $sql_personagem);
$personagem = mysqli_fetch_assoc($result_personagem);
if (!$personagem) {
    echo "Personagem não encontrado.";
    exit;
}

// Cadastro
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = mysqli_real_escape_string($conn, $_POST['golpe_nome']);
    $tipo = mysqli_real_escape_string($conn, $_POST['golpe_tipo']);
    $qtdhit = mysqli_real_escape_string($conn, $_POST['golpe_qtdhit']);
    $comando = mysqli_real_escape_string($conn, $_POST['golpe_comando']);
    $hitlvl = mysqli_real_escape_string($conn, $_POST['golpe_hitlvl']);
    $dano = mysqli_real_escape_string($conn, $_POST['golpe_dano']);
    $startf = mysqli_real_escape_string($conn, $_POST['golpe_startf']);
    $blockf = mysqli_real_escape_string($conn, $_POST['golpe_blockf']);
    $hitf = mysqli_real_escape_string($conn, $_POST['golpe_hitf']);

    $sql_insert = "INSERT INTO alansteindorff_golpe 
        (personagem_id, golpe_nome, golpe_tipo, golpe_qtdhit, golpe_comando, golpe_hitlvl, golpe_dano, golpe_startf, golpe_blockf, golpe_hitf)
        VALUES ($personagem_id, '$nome', '$tipo', '$qtdhit', '$comando', '$hitlvl', '$dano', '$startf', '$blockf', '$hitf')";
    if (mysqli_query($conn, $sql_insert)) {
        header("Location: shaheen.php"); // Troque para a página do personagem correspondente
        exit;
    } else {
        $erro = "Erro ao cadastrar golpe.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <title>Cadastrar Golpe</title>
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
    <div class="login new-move">
        <h2>Cadastrar Golpe para <?= htmlspecialchars($personagem['personagem_nome']) ?></h2>
        <?php if (isset($erro))
            echo "<div style='color:red;'>$erro</div>"; ?>
        <form method="POST" class="edit-golpe-form">
            <div class="edit-golpe-grid">
                <div>
                    <label>Nome<br>
                        <input type="text" name="golpe_nome" required>
                    </label>
                    <label>Tipo<br>
                        <input type="text" name="golpe_tipo">
                    </label>
                    <label>Quantidade de hits<br>
                        <input type="text" name="golpe_qtdhit">
                    </label>
                    <label>Comando<br>
                        <input type="text" name="golpe_comando">
                    </label>
                </div>
                <div>
                    <label>Hit Level<br>
                        <input type="text" name="golpe_hitlvl">
                    </label>
                    <label>Dano<br>
                        <input type="text" name="golpe_dano">
                    </label>
                    <label>Startup Frames<br>
                        <input type="text" name="golpe_startf">
                    </label>
                    <label>Frames on block<br>
                        <input type="text" name="golpe_blockf">
                    </label>
                    <label>Frames on hit<br>
                        <input type="text" name="golpe_hitf">
                    </label>
                </div>
            </div>
            <button type="submit" class="btn-login">Cadastrar</button>
            <a href="<?= strtolower(str_replace(' ', '', $personagem['personagem_nome'])) ?>.php"
                class="back-link">Cancelar</a>
        </form>
    </div>
</body>

</html>