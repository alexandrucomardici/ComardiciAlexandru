<?php include "db.php"; ?>
<!DOCTYPE html>
<html lang="ro">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Creează cont - MotoParts.ro</title>

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

    .register-container {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 85vh;
    }

    .register-card {
      background-color: white;
      border-radius: 10px;
      padding: 40px 35px;
      box-shadow: 0 6px 15px rgba(0,0,0,0.15);
      width: 100%;
      max-width: 420px;
      transition: 0.3s;
    }

    .register-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 8px 20px rgba(0,0,0,0.2);
    }

    .register-card h2 {
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

  <div class="register-container">
    <div class="register-card">
      <h2>Creează cont nou</h2>
      <form onsubmit="return registerUser(event)">
        <div class="mb-3">
          <label for="fullname" class="form-label">Nume complet</label>
          <input type="text" id="fullname" class="form-control" placeholder="Ex: Andrei Popescu" required>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Adresă de email</label>
          <input type="email" id="email" class="form-control" placeholder="exemplu@email.com" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Parolă</label>
          <input type="password" id="password" class="form-control" placeholder="••••••••" required>
        </div>
        <div class="mb-3">
          <label for="confirm" class="form-label">Confirmă parola</label>
          <input type="password" id="confirm" class="form-control" placeholder="••••••••" required>
        </div>
        <button type="submit" class="btn-orange">Creează cont</button>
      </form>

      <div class="links">
        <a href="login.php">Ai deja cont? Autentifică-te</a>
      </div>
    </div>
  </div>

  <footer>
    <p>© 2025 MotoParts.ro — Toate drepturile rezervate.</p>
  </footer>

  <script>
    function registerUser(event) {
      event.preventDefault();

      const name = document.getElementById('fullname').value.trim();
      const email = document.getElementById('email').value.trim();
      const pass = document.getElementById('password').value;
      const confirm = document.getElementById('confirm').value;

      if (pass !== confirm) {
        alert("Parolele nu coincid!");
        return false;
      }

      if (pass.length < 6) {
        alert("Parola trebuie să aibă cel puțin 6 caractere!");
        return false;
      }

      alert(`Contul a fost creat cu succes pentru ${name}!`);
      window.location.href = "login.php";
    }
  </script>
</body>
</html>
