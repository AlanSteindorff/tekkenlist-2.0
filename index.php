
<?php
// Inicia a sessão para controlar login e permissões de usuário
session_start();
// Inclui o arquivo de conexão com o banco de dados
include_once("conexao.php");
// Consulta todos os personagens cadastrados, ordenando por nome
$sql = "SELECT personagem_id, personagem_nome, personagem_img FROM alansteindorff_personagem ORDER BY personagem_nome";
$result = mysqli_query($conn, $sql);
?>


<!DOCTYPE html>
<html lang="pt-br">


<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>TEKKENLIST - Character Select</title>
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
  </header>


  <main class="character-selection">
    <h1>Select a Character</h1>
    <?php if (isset($_SESSION['usuarioNiveisAcessoId']) && $_SESSION['usuarioNiveisAcessoId'] == 2): ?>
      <!-- Botão para adicionar personagem (apenas para administradores) -->
      <a href="cadastrar_personagem.php" class="goto-btn edit-btn" style="margin-bottom:18px;display:inline-block;">
        <span class="fa fa-plus"></span> Adicionar Personagem
      </a>
    <?php else: ?>
      </div>
    <?php endif; ?>
    <div class="character-grid">
      <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <div class="character">
          <!-- Link para a página do personagem, nome formatado para o nome do arquivo -->
          <a href="<?= strtolower(str_replace(' ', '', $row['personagem_nome'])) ?>.php">
            <!-- Imagem do personagem -->
            <img src="<?= htmlspecialchars($row['personagem_img']) ?>"
              alt="<?= htmlspecialchars($row['personagem_nome']) ?>"
              class="character-img character-<?= strtolower(str_replace([' ', "'"], ['-', ''], $row['personagem_nome'])) ?>" />
            <span><?= htmlspecialchars($row['personagem_nome']) ?></span>
          </a>
          <?php if (isset($_SESSION['usuarioNiveisAcessoId']) && $_SESSION['usuarioNiveisAcessoId'] == 2): ?>
            <!-- Botão para excluir personagem (apenas para administradores) -->
            <form method="post" action="excluir_personagem.php" style="display:inline;">
              <input type="hidden" name="personagem_id" value="<?= $row['personagem_id'] ?>">
              <button type="submit" class="delete-char-btn" title="Excluir"
                onclick="return confirm('Tem certeza que deseja excluir este personagem?');">
                <span class="fa fa-trash"></span>
              </button>
            </form>
          <?php endif; ?>
        </div>
    <?php endwhile; ?>
    </div>
  </main>
  <footer class="site-footer">
    <div class="footer-content">
      <span>© 2025 Made by Alan Steindorff</span>
      <span class="footer-divider">|</span>
      <span>
        Tekkenlist is a fan-made, unofficial resource. All Tekken trademarks and character copyrights belong to Bandai
        Namco Entertainment Inc.
      </span>
    </div>
  </footer>
</body>

</html>