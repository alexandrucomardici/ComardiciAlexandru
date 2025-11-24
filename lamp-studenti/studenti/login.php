<?php include "db.php"; ?>
<!DOCTYPE html>
<html lang="ro">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Autentificare - MotoParts.ro</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', Arial, sans-serif;
      background-color: #f3f3f3;
    }

    header {
      background-color: #1a1a1a;
      color: white;
      padding: 10px 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-bottom: 3px solid #ff9800;
    }

    header .logo a {
      color: white;
      text-decoration: none;
      font-weight: bold;
      font-size: 1.5em;
    }

    .cart-btn {
      background-color: #ff9800;
      padding: 8px 14px;
      border-radius: 5px;
      color: white;
      font-weight: bold;
      text-decoration: none;
      transition: 0.3s;
    }

    .cart-btn:hover {
      background-color: #e68900;
    }

    nav {
      background-color: #2b2b2b;
      display: flex;
      justify-content: center;
      gap: 25px;
      padding: 10px 0;
      border-bottom: 2px solid #ff9800;
    }

    nav a {
      color: white;
      text-decoration: none;
      font-weight: 600;
      transition: 0.3s;
    }

    nav a:hover {
      color: #ff9800;
    }

    .login-container {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 80vh;
    }

    .login-card {
      background-color: white;
      border-radius: 10px;
      padding: 40px 35px;
      box-shadow: 0 6px 15px rgba(0,0,0,0.15);
      width: 100%;
      max-width: 400px;
      transition: 0.3s;
    }

    .login-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 8px 20px rgba(0,0,0,0.2);
    }

    .login-card h2 {
      text-align: center;
      margin-bottom: 25px;
      border-left: 6px solid #ff9800;
      padding-left: 10px;
      color: #222;
      font-weight: bold;
    }

    .form-control:focus {
      border-color: #ff9800;
      box-shadow: 0 0 5px rgba(255,152,0,0.5);
    }

    .btn-orange {
      background-color: #ff9800;
      color: white;
      border: none;
      width: 100%;
      padding: 12px;
      font-weight: bold;
      border-radius: 6px;
      transition: 0.3s;
    }

    .btn-orange:hover {
      background-color: #e68900;
    }

    .links {
      text-align: center;
      margin-top: 15px;
    }

    .links a {
      color: #ff9800;
      text-decoration: none;
      font-weight: 500;
    }

    .links a:hover {
      text-decoration: underline;
    }

    footer {
      text-align: center;
      color: #555;
      margin-top: 40px;
      padding: 15px;
    }
a.hover-underline {
  color: #ff9800;
  font-weight: bold;
  text-decoration: none;
}

a.hover-underline:hover {
  text-decoration: underline;
}
  </style>
</head>

<body>
  <header>
    <div class="logo"><a href="index.php">MotoParts.ro</a></div>
    <div class="actions">
      <a href="cos.php" class="cart-btn">🛒 Coș</a>
      <a href="login.php" style="color:white; text-decoration:none;">Login / Contul meu</a>
    </div>
  </header>

  <nav>
    <a href="index.php">Acasă</a>
    <a href="motoare.php">Motoare</a>
    <a href="carene.php">Carene</a>
    <a href="frane.php">Frâne</a>
    <a href="accesorii.php">Accesorii</a>
    <a href="anvelope.php">Anvelope</a>
    <a href="ulei.php">Ulei si Filtre</a>
  </nav>

  <div class="login-container">
    <div class="login-card">
      <h2>Autentificare</h2>
      <form onsubmit="return loginUser(event)">
        <div class="mb-3">
          <label for="email" class="form-label">Adresă de email</label>
          <input type="email" id="email" class="form-control" placeholder="exemplu@email.com" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Parolă</label>
          <input type="password" id="password" class="form-control" placeholder="••••••••" required>
        </div>
        <div class="form-check mb-3">
          <input type="checkbox" class="form-check-input" id="remember">
          <label class="form-check-label" for="remember">Ține-mă minte</label>
        </div>
        <button type="submit" class="btn-orange">Login</button>
      </form>

    <div style="text-align:center; margin-top:12px;">
  <a href="forgot.php" style="color:#ff9800; font-weight:bold; text-decoration:none;"
     onmouseover="this.style.textDecoration='underline';"
     onmouseout="this.style.textDecoration='none';">
    Ai uitat parola?
  </a>
</div>

<div style="text-align:center; margin-top:12px;">
  <a href="register.php" style="color:#ff9800; font-weight:bold; text-decoration:none;"
     onmouseover="this.style.textDecoration='underline';"
     onmouseout="this.style.textDecoration='none';">
    Creează un cont nou
  </a>
</div>

</div>
</div>
  <footer>
    <p>© 2025 MotoParts.ro — Toate drepturile rezervate.</p>
  </footer>

  <script>
    function loginUser(event) {
      event.preventDefault();
      const email = document.getElementById("email").value;
      const password = document.getElementById("password").value;

      if (email === "admin@motoparts.ro" && password === "admin123") {
        alert("Autentificare reușită! Bine ai revenit, Admin!");
        window.location.href = "index.php";
      } else {
        alert("Email sau parolă incorectă!");
      }
    }
  </script>
</body>
</html>
