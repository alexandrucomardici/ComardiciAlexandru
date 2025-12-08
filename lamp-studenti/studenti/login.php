<?php
require "config.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $db->prepare("SELECT * FROM utilizatori WHERE nume_utilizator = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['parola_criptata'])) {
        session_start();
        $_SESSION['user'] = $user['id'];
        header("Location: index.php");
        exit;
    } else {
        echo "Date greșite!";
    }
}
?>

<!doctype html>
<html lang="ro">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Autentificare - MotoParts.ro</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    /* păstrează stilurile tale pentru login */
    body { margin:0; font-family:'Segoe UI',Arial,sans-serif; background:#f3f3f3; }
    .login-container{display:flex;justify-content:center;align-items:center;height:80vh;}
    .login-card{background:#fff;border-radius:10px;padding:40px 35px;box-shadow:0 6px 15px rgba(0,0,0,.15);width:100%;max-width:400px;}
    .btn-orange{background:#ff9800;color:#fff;border:none;padding:12px;width:100%;border-radius:6px;font-weight:700;}
    .btn-orange:hover{background:#e68900;}
  </style>
</head>
<body>
  <header style="background:#1a1a1a;color:#fff;padding:10px 20px;display:flex;justify-content:space-between;align-items:center;border-bottom:3px solid #ff9800;">
    <div class="logo"><a href="index.php" style="color:white;text-decoration:none;font-weight:bold;">MotoParts.ro</a></div>
    <div class="actions">
      <a href="cos.php" class="cart-btn" style="background:#ff9800;padding:8px 12px;border-radius:6px;color:white;text-decoration:none;">🛒 Coș</a>
      <a href="register.php" style="color:white;text-decoration:none;margin-left:10px;">Creează cont</a>
    </div>
  </header>

  <div class="login-container">
    <div class="login-card">
      <h2 style="border-left:6px solid #ff9800;padding-left:10px;">Autentificare</h2>

      <?php if (!empty($_GET['registered'])): ?>
        <div class="alert alert-success">Cont creat cu succes. Te poți autentifica.</div>
      <?php endif; ?>

      <?php if ($errors): foreach ($errors as $err): ?>
        <div class="alert alert-danger"><?=htmlspecialchars($err)?></div>
      <?php endforeach; endif; ?>

      <form method="post" novalidate>
        <div class="mb-3">
          <label for="email" class="form-label">Adresă de email</label>
          <input type="email" id="email" name="email" class="form-control" value="<?=htmlspecialchars($_POST['email'] ?? '')?>" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Parolă</label>
          <input type="password" id="password" name="password" class="form-control" required>
        </div>
        <div class="form-check mb-3">
          <input type="checkbox" id="remember" name="remember" class="form-check-input">
          <label class="form-check-label" for="remember">Ține-mă minte</label>
        </div>
        <button type="submit" class="btn-orange">Login</button>
      </form>

      <div style="text-align:center;margin-top:12px;">
        <a href="forgot.php" style="color:#ff9800;font-weight:bold;text-decoration:none;">Ai uitat parola?</a>
      </div>

      <div style="text-align:center;margin-top:12px;">
        <a href="register.php" style="color:#ff9800;font-weight:bold;text-decoration:none;">Creează un cont nou</a>
      </div>
    </div>
  </div>
</body>
</html>
