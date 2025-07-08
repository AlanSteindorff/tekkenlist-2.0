
<?php
// Inicia a sessão para controle de login e mensagens
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>TEKKENLIST - Login</title>
  <link rel="stylesheet" href="tekkenlist.css">
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

  <div class="login">
    <h2>Account Login</h2>
    <?php
    // Exibe mensagem de sucesso
    if (isset($_SESSION['msg'])) {
      echo '<div style="color:green; margin-bottom:10px;">' . $_SESSION['msg'] . '</div>';
      unset($_SESSION['msg']);
    }
    // Exibe mensagem de erro de login
    if (isset($_SESSION['loginErro'])) {
      echo '<div style="color:red; margin-bottom:10px;">' . $_SESSION['loginErro'] . '</div>';
      unset($_SESSION['loginErro']);
    }
    ?>
    <form action="login-valida.php" method="POST">
      <div class="formulario">
        <label for="usuario">Email</label>
        <input type="text" id="usuario" name="usuario" required />
      </div>
      <div class="formulario">
        <label for="senha">Password</label>
        <input type="password" id="senha" name="senha" required />
      </div>
      <button type="submit" class="btn-login">Log In</button>
      <a href="index.php" class="back-link">← Back to Home</a>
      <a href="criar_conta.php" class="back-link" style="margin-top: 40px;">Create an account</a>
    </form>
  </div>

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