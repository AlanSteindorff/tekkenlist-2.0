<?php
session_start();
include_once("conexao.php");

// Busca o personagem
$sql_personagem = "SELECT personagem_id, personagem_nome, personagem_img FROM alansteindorff_personagem WHERE personagem_nome = 'Bryan Fury' LIMIT 1";
$result_personagem = mysqli_query($conn, $sql_personagem);
$personagem = mysqli_fetch_assoc($result_personagem);

if (!$personagem) {
  echo "Personagem não encontrado.";
  exit;
}

// Busca os golpes do personagem
$sql_golpes = "SELECT * FROM alansteindorff_golpe WHERE personagem_id = {$personagem['personagem_id']} ORDER BY golpe_id";
$result_golpes = mysqli_query($conn, $sql_golpes);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= htmlspecialchars($personagem['personagem_nome']) ?></title>
  <link rel="stylesheet" href="tekkenlist.css" />
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <style>
    .move-frames td {
      background: transparent !important;
    }
  </style>
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

  <main class="char-movelist">
    <div class="head" style="display: flex; justify-content: space-between; align-items: center;">
      <span class="move-head"><?= htmlspecialchars($personagem['personagem_nome']) ?> - Movelist</span>
      <?php if (isset($_SESSION['usuarioNiveisAcessoId']) && ($_SESSION['usuarioNiveisAcessoId'] == 1 || $_SESSION['usuarioNiveisAcessoId'] == 2)): ?>
        <a href="cadastrar_golpe.php?personagem_id=<?= $personagem['personagem_id'] ?>" class="goto-btn edit-btn"
          style="margin-left:auto;">
          <span class="fa fa-plus"></span> Cadastrar Golpe
        </a>
      <?php endif; ?>
    </div>
    <div class="inner-table">
      <div class="move-table">
        <?php $num = 1;
        while ($golpe = mysqli_fetch_assoc($result_golpes)): ?>
          <div class="move-card" id="golpe<?= $golpe['golpe_id'] ?>">

            <div class="move-info">
              <div class="move-title">
                <span class="move-number"><?= $num++ ?></span>
                <span class="move-name"><?= htmlspecialchars($golpe['golpe_nome']) ?></span>
                <?php
                // Exibir imagens dos tipos (homing, powercrush, etc)
                if (!empty($golpe['golpe_tipo'])) {
                  $tipos = explode(',', $golpe['golpe_tipo']);
                  foreach ($tipos as $tipo) {
                    $tipo = trim(strtolower($tipo));
                    if ($tipo) {
                      echo '<img class="move-type-icon" src="./assets/type/' . $tipo . '.svg" alt="' . $tipo . '" title="' . ucfirst($tipo) . '">';
                    }
                  }
                }
                ?>
                <?php if (!empty($golpe['golpe_qtdhit'])): ?>
                  <span class="move-hitamount"><?= htmlspecialchars($golpe['golpe_qtdhit']) ?></span>
                <?php endif; ?>
              </div>
              <div class="move-string">
                <?php
                $comandos = explode(',', $golpe['golpe_comando']);
                foreach ($comandos as $cmd) {
                  $cmd = trim(strtolower($cmd));
                  // Direcionais
                  $arrows = ['f', 'f hold', 'b', 'b hold', 'u', 'u hold', 'd', 'd hold', 'df', 'df hold', 'df hold', 'db', 'db hold', 'uf', 'uf hold', 'ub', 'ub hold', 'n', 'uf', 'uf hold', 'ub', 'ub hold', 'f+u', 'f+u hold', 'b+d', 'b+d hold', 'd+f', 'd+f hold', 'd+b', 'd+b hold', 'u+b', 'u+b hold'];
                  if (in_array($cmd, $arrows)) {
                    echo '<img class="move-arrow" src="./assets/arrow/' . $cmd . '.svg" alt="' . $cmd . '">';
                  }
                  // Botões
                  elseif (in_array($cmd, ['0', '1', '2', '3', '4', '1+2', '3+4', '2+3', '1+3', '1+4', '2+4', '1+2+3', '1+3+4', '2+3+4', '1+2+4', '1+2+3+4'])) {
                    echo '<img class="move-button" src="./assets/button/default/' . $cmd . '.svg" alt="' . $cmd . '">';
                  }
                  // Texto extra
                  elseif (!empty($cmd)) {
                    echo '<span class="move-hint">' . htmlspecialchars($cmd) . '</span>';
                  }
                }
                ?>
              </div>
              <div class="move-hit-dmg">
                <div class="move-hitlvlstring">
                  <?php
                  if (!empty($golpe['golpe_hitlvl'])) {
                    $hitlvls = explode(',', $golpe['golpe_hitlvl']);
                    foreach ($hitlvls as $hlvl) {
                      $hlvl = trim($hlvl);
                      if (preg_match('/^([^\[]+)(?:\[(.+)\])?$/', $hlvl, $matches)) {
                        $nivel = strtolower(trim($matches[1]));
                        $prop = isset($matches[2]) ? strtolower(trim($matches[2])) : '';
                        $hit_class = '';
                        if (strpos($nivel, 'unblockable') !== false)
                          $hit_class = 'hitnoblk';
                        elseif (strpos($nivel, 'unblockable high') !== false)
                          $hit_class = 'hitnoblk';
                        elseif (strpos($nivel, 'unblockable mid') !== false)
                          $hit_class = 'hitnoblk';
                        elseif (strpos($nivel, 'unblockable low') !== false)
                          $hit_class = 'hitnoblk';
                        elseif (strpos($nivel, 'throw') !== false)
                          $hit_class = 'hitthrow';
                        elseif (strpos($nivel, 'high throw') !== false)
                          $hit_class = 'hitthrow';
                        elseif (strpos($nivel, 'mid throw') !== false)
                          $hit_class = 'hitthrow';
                        elseif (strpos($nivel, 'low throw') !== false)
                          $hit_class = 'hitthrow';
                        elseif (strpos($nivel, 'special mid') !== false)
                          $hit_class = 'hitsmid';
                        elseif (strpos($nivel, 'projectile') !== false)
                          $hit_class = 'hitproj';
                        elseif (strpos($nivel, 'mid') !== false)
                          $hit_class = 'hitmid';
                        elseif (strpos($nivel, 'high') !== false)
                          $hit_class = 'hithigh';
                        elseif (strpos($nivel, 'low') !== false)
                          $hit_class = 'hitlow';

                        echo '<span class="mv-hitlvl ' . $hit_class . '">';
                        echo htmlspecialchars(ucfirst($nivel));
                        if ($prop) {
                          echo '<img class="move-prop-icon" src="./assets/hitprop/' . $prop . '.svg" alt="' . $prop . '" title="' . ucfirst($prop) . '">';
                        }
                        echo '</span>';
                      }
                    }
                  }
                  ?>
                </div>
                <div class="move-dmg">
                  <?php if (!empty($golpe['golpe_dano'])): ?>
                    <p class="mv-frames"><?= htmlspecialchars($golpe['golpe_dano']) ?></p>
                    <p class="mv-id">Damage</p>
                  <?php endif; ?>
                </div>
              </div>
            </div>
            <div class="move-extra">
              <div class="mv-section">
                <div class="move-special"></div>
                <table class="move-frames">
                  <?php if (isset($_SESSION['usuarioNiveisAcessoId']) && ($_SESSION['usuarioNiveisAcessoId'] == 1 || $_SESSION['usuarioNiveisAcessoId'] == 2)): ?>
                    <div class="btn-edit-move" style="display: flex; gap: 8px;">
                      <a href="editar_golpe.php?id=<?= $golpe['golpe_id'] ?>&voltar=bryanfury.php" class="goto-btn edit-btn">
                        <span class="fa fa-pencil"></span> Editar
                      </a>
                      <form action="deletar_golpe.php" method="post" style="display:inline;"
                        onsubmit="return confirm('Tem certeza que deseja excluir este golpe?');">
                        <input type="hidden" name="id" value="<?= $golpe['golpe_id'] ?>">
                        <button type="submit" class="goto-btn delete-btn">
                          <span class="fa fa-trash"></span> Excluir
                        </button>
                      </form>
                    </div>
                  <?php endif; ?>
                  <tbody>
                    <tr class="move-startf">
                      <td class="mv-id">Start</td>
                      <td class="mv-frames"><?= htmlspecialchars($golpe['golpe_startf']) ?></td>
                    </tr>
                    <tr class="move-blockf">
                      <td class="mv-id">Block</td>
                      <?php
                      $blockf = trim($golpe['golpe_blockf']);
                      $block_class = '';
                      if ($blockf !== '') {
                        if (is_numeric($blockf)) {
                          if ($blockf > 0)
                            $block_class = 'blkpositive';
                          elseif ($blockf < 0)
                            $block_class = 'blknegative';
                          else
                            $block_class = 'blkmild';
                        } elseif (strpos($blockf, '+') === 0) {
                          $block_class = 'blkpositive';
                        } elseif (strpos($blockf, '-') === 0) {
                          $block_class = 'blknegative';
                        } elseif ($blockf == '0') {
                          $block_class = 'blkmild';
                        }
                      }
                      ?>
                      <td class="mv-frames <?= $block_class ?>"><?= htmlspecialchars($golpe['golpe_blockf']) ?></td>
                    </tr>
                    <tr class="move-hitf">
                      <td class="mv-id">Hit</td>
                      <?php
                      $hitf = trim($golpe['golpe_hitf']);
                      $hitf_class = '';
                      if ($hitf !== '') {
                        if (is_numeric($hitf)) {
                          if ($hitf > 0)
                            $hitf_class = 'blkpositive';
                          elseif ($hitf < 0)
                            $hitf_class = 'blknegative';
                          else
                            $hitf_class = 'blkmild';
                        } elseif (strpos($hitf, '+') === 0) {
                          $hitf_class = 'blkpositive';
                        } elseif (strpos($hitf, '-') === 0) {
                          $hitf_class = 'blknegative';
                        } elseif ($hitf == '0') {
                          $hitf_class = 'blkmild';
                        }
                      }
                      ?>
                      <td class="mv-frames <?= $hitf_class ?>"><?= htmlspecialchars($golpe['golpe_hitf']) ?></td>
                    </tr>
                  </tbody>
                </table>
                <?php if (isset($_SESSION['usuarioId'])): ?>
                  <button class="report-btn"
                    onclick="openReportModal(<?= $golpe['golpe_id'] ?>, '<?= htmlspecialchars(addslashes($golpe['golpe_nome'])) ?>')">Reportar
                    Erro</button>
                <?php else: ?>
                  <a href="login.php" class="report-btn">Report Error</a>
                <?php endif; ?>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      </div>
    </div>
  </main>

  <div class="char-fixed-img">
  <img src="<?= htmlspecialchars($personagem['personagem_img']) ?>" alt="<?= htmlspecialchars($personagem['personagem_nome']) ?>">
</div>

  <div class="icon-legend">
    <h3>Icons</h3>
    <ul>
      <li><img src="./assets/hitprop/power crush.svg" alt="Power Crush" class="legend-icon"> Power Crush</li>
      <li><img src="./assets/hitprop/heat.svg" alt="Heat" class="legend-icon"> Heat Engager</li>
      <li><img src="./assets/hitprop/homing.svg" alt="Homing" class="legend-icon"> Homing</li>
      <li><img src="./assets/hitprop/chip.svg" alt="Chip" class="legend-icon"> Chip/Life Gauge Reducer</li>
      <li><img src="./assets/hitprop/tornado.svg" alt="Tornado" class="legend-icon"> Tornado</li>
      <li><img src="./assets/hitprop/force crouch.svg" alt="Force Crouch" class="legend-icon"> Force Crouch</li>
      <li><img src="./assets/hitprop/wall break.svg" alt="Wall Break" class="legend-icon"> Wall Break</li>
      <li><img src="./assets/hitprop/wall bound.svg" alt="Wall Bound" class="legend-icon"> Wall Bound</li>
      <li><img src="./assets/hitprop/wall blast.svg" alt="Wall Blast" class="legend-icon"> Wall Blast</li>
      <li><img src="./assets/hitprop/floor break.svg" alt="Floor Break" class="legend-icon"> Floor Break</li>
      <li><img src="./assets/hitprop/floor blast.svg" alt="Floor Blast" class="legend-icon"> Floor Blast</li>
      <li><img src="./assets/hitprop/balcony break.svg" alt="Balcony Break" class="legend-icon"> Balcony Break</li>
    </ul>
  </div>
  
  <!-- Modal de reporte de erro -->
  <div id="report-modal" class="report-modal">
    <div class="report-modal-content">
      <form method="post" action="reportar_erro.php" class="report-modal-form">
        <input type="hidden" name="golpe_id" id="report-golpe-id">
        <div><b id="report-golpe-nome"></b></div>
        <textarea name="mensagem" rows="4" placeholder="Describe the issue..." required></textarea>
        <div class="report-modal-actions">
          <button type="button" onclick="closeReportModal()">Cancel</button>
          <button type="submit">Submit</button>
        </div>
      </form>
    </div>
  </div>
  <script>
    function openReportModal(id, nome) {
      document.getElementById('report-golpe-id').value = id;
      document.getElementById('report-golpe-nome').innerText = nome;
      document.getElementById('report-modal').style.display = 'flex';
    }
    function closeReportModal() {
      document.getElementById('report-modal').style.display = 'none';
    }
  </script>
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