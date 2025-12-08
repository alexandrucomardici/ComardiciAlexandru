<?php
require "config.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $db->prepare("INSERT INTO utilizatori (nume_utilizator, parola_criptata) VALUES (?, ?)");
    $stmt->execute([$username, $password]);

    echo "Cont creat!";
}
?>
<!doctype html>
<html lang="ro">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Creează cont - MotoParts.ro</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    /* păstrează stilurile tale */
    body { margin:0; font-family:'Segoe UI',Arial,sans-serif; background:#f3f3f3; }
    header{background:#1a1a1a;color:#fff;padding:10px 20px;display:flex;justify-content:space-between;align-items:center;border-bottom:3px solid #ff9800;}
    .register-container{display:flex;justify-content:center;align-items:center;height:85vh;}
    .register-card{background:#fff;border-radius:10px;padding:40px 35px;box-shadow:0 6px 15px rgba(0,0,0,.15);width:100%;max-width:420px;}
    .btn-orange{background:#ff9800;color:#fff;border:none;padding:12px;width:100%;border-radius:6px;font-weight:700;}
    .btn-orange:hover{background:#e68900;}
  </style>
</head>
<body>
  <header>
    <div class="logo"><a href="index.php" style="color:white;text-decoration:none;font-weight:bold;font-size:1.2em;">MotoParts.ro</a></div>
    <div class="actions">
      <a href="cos.php" class="cart-btn" style="background:#ff9800;padding:8px 12px;border-radius:6px;color:white;text-decoration:none;">🛒 Coș</a>
      <a href="login.php" style="color:white;text-decoration:none;margin-left:10px;">Login / Contul meu</a>
    </div>
  </header>

  <div class="register-container">
    <div class="register-card">
      <h2 style="border-left:6px solid #ff9800;padding-left:10px;">Creează cont nou</h2>

      <?php if ($errors): ?>
        <?php foreach ($errors as $err): ?>
          <div class="alert alert-danger"><?=htmlspecialchars($err)?></div>
        <?php endforeach; ?>
      <?php endif; ?>

      <form method="post" novalidate>
        <div class="mb-3">
          <label for="fullname" class="form-label">Nume complet</label>
          <input type="text" id="fullname" name="fullname" class="form-control" value="<?=htmlspecialchars($_POST['fullname'] ?? '')?>" required>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Adresă de email</label>
          <input type="email" id="email" name="email" class="form-control" value="<?=htmlspecialchars($_POST['email'] ?? '')?>" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Parolă</label>
          <input type="password" id="password" name="password" class="form-control" required>
        </div>
        <div class="mb-3">
          <label for="confirm" class="form-label">Confirmă parola</label>
          <input type="password" id="confirm" name="confirm" class="form-control" required>
        </div>
        <button type="submit" class="btn-orange">Creează cont</button>
      </form>

      <div style="text-align:center;margin-top:12px;">
        <a href="login.php" style="color:#ff9800;font-weight:bold;text-decoration:none;">Ai deja cont? Autentifică-te</a>
      </div>
    </div>
  </div>
</body>
</html>
