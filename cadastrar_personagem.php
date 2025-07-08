
<?php
session_start();
// Permite acesso apenas para administradores (nível 2)
if (!isset($_SESSION['usuarioNiveisAcessoId']) || $_SESSION['usuarioNiveisAcessoId'] != 2) {
    header("Location: index.php");
    exit;
}
// Inclui o arquivo de conexão com o banco de dados
include_once("conexao.php");

// Se o formulário foi enviado via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['personagem_nome'] ?? ''); // Nome do personagem
    $img = $_FILES['personagem_img'] ?? null;      // Imagem enviada

    // Validação dos campos obrigatórios
    if (empty($nome) || !$img || $img['error'] !== 0) {
        $erro = "Preencha todos os campos e envie uma imagem válida.";
    } else {
        // Verifica extensão da imagem
        $ext = strtolower(pathinfo($img['name'], PATHINFO_EXTENSION));
        $permitidas = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        if (!in_array($ext, $permitidas)) {
            $erro = "Formato de imagem não permitido.";
        } else {
            // Gera nome único para o arquivo da imagem
            $novo_nome = uniqid('char_', true) . '.' . $ext;
            $destino = $novo_nome;
            // Move o arquivo enviado para o destino
            if (move_uploaded_file($img['tmp_name'], $destino)) {
                // Prepara e executa o INSERT no banco de dados
                $sql = "INSERT INTO alansteindorff_personagem (personagem_nome, personagem_img) VALUES (?, ?)";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "ss", $nome, $destino);
                if (mysqli_stmt_execute($stmt)) {
                    $sucesso = "Personagem cadastrado com sucesso!";
                } else {
                    $erro = "Erro ao cadastrar personagem.";
                }
                mysqli_stmt_close($stmt);
            } else {
                $erro = "Erro ao salvar a imagem.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">


<head>
    <meta charset="UTF-8">
    <title>Cadastrar Personagem</title>
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
    <div class="login new-move">
        <h2>Cadastrar Personagem</h2>
        <?php if ($erro): ?>
            <!-- Exibe mensagem de erro, se houver -->
            <div style="color:#c90000;"> <?= htmlspecialchars($erro) ?> </div>
        <?php endif; ?>
        <?php if ($sucesso): ?>
            <!-- Exibe mensagem de sucesso, se houver -->
            <div style="color:#009900;"> <?= htmlspecialchars($sucesso) ?> </div>
        <?php endif; ?>
        <form method="post" enctype="multipart/form-data" class="edit-golpe-form">
            <div class="edit-golpe-grid" style="grid-template-columns: 1fr; gap: 24px;">
                <div>
                    <label>Nome do Personagem<br>
                        <input type="text" name="personagem_nome" required maxlength="50">
                    </label>
                </div>
                <div>
                    <label>Imagem do Personagem<br>
                        <input type="file" name="personagem_img" accept="image/*" required style="padding:8px 0;">
                    </label>
                </div>
            </div>
            <button type="submit" class="btn-login"></span> Cadastrar</button>
            <a href="index.php" class="back-link">Cancelar</a>
        </form>
    </div>
</body>

</html>