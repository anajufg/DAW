<nav style="background: #333; color: #fff; padding: 10px">
  <a href="index.php" style="color: #fff; margin-right: 10px">Início</a>
  <?php if (session_status() == PHP_SESSION_NONE) session_start(); ?>
  <?php if (!empty(\$_SESSION['user'])): ?>
  <span
    >Olá,
    <?=htmlspecialchars(\$_SESSION['user']['nome'])?>
    —
  </span>
  <a href="questions.php?id=0" style="color: #fff; margin-left: 10px">Jogar</a>
  <a href="logout.php" style="color: #fff; margin-left: 10px">Sair</a>
  <?php else: ?>
  <a href="login.php" style="color: #fff; margin-left: 10px">Login</a>
  <a href="register.php" style="color: #fff; margin-left: 10px">Cadastro</a>
  <?php endif; ?>
</nav>
