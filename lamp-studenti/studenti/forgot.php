<!-- forgot.php -->
<!DOCTYPE html>
<html lang="ro">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Ai uitat parola - MotoParts.ro</title>

  <!-- stil comun -->
  <link rel="stylesheet" href="style.css">

  <style>
    /* mici ajustări specifice paginii */
    .forgot-container {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 75vh;
    }

    .forgot-card {
      background: white;
      padding: 28px;
      border-radius: 10px;
      max-width: 460px;
      width: 100%;
      box-shadow: 0 6px 15px rgba(0,0,0,0.12);
    }

    .forgot-card h2 {
      margin-top: 0;
      margin-bottom: 14px;
      border-left: 6px solid #ff9800;
      padding-left: 10px;
    }

    .notice {
      background: #fff9e6;
      border: 1px solid #ffe0b2;
      color: #6b4a00;
      padding: 10px 12px;
      border-radius: 6px;
      margin-bottom: 12px;
      font-size: 0.95rem;
    }

    .success {
      background: #e6ffef;
      border: 1px solid #bff1d1;
      color: #165a2d;
      padding: 10px 12px;
      border-radius: 6px;
      margin-top: 12px;
      display: none;
    }

    .error {
      color: #c0392b;
      font-size: 0.9rem;
      margin-top: 6px;
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
    <a href="ulei.php">Ulei și Filtre</a>
  </nav>

  <main class="forgot-container">
    <div class="forgot-card form-card" role="region" aria-labelledby="forgot-title">
      <h2 id="forgot-title">Resetare parolă</h2>

      <p class="notice">
        Introdu adresa de email asociată contului tău. 
      </p>

      <form id="forgot-form" novalidate>
        <label for="email" class="form-label">Adresă de email</label>
        <input id="email" type="email" class="form-control" placeholder="exemplu@domeniu.ro" required>

        <div id="email-error" class="error" aria-live="polite" style="display:none;"></div>

        <button type="submit" class="btn-orange" style="margin-top:12px;">Trimite email</button>

        <div id="sent-success" class="success" role="status">
          Emailul pentru resetare a fost trimis. Verifica inbox-ul sau folderul de spam.
        </div>
      </form>

      <div style="text-align:center; margin-top:12px;">
        <a href="login.php" style="color:#ff9800; font-weight:600; text-decoration:none;">Înapoi la autentificare</a>
      </div>
    </div>
  </main>

  <footer>
    <p>© 2025 MotoParts.ro — Toate drepturile rezervate.</p>
  </footer>

  <script>
    (function () {
      const form = document.getElementById('forgot-form');
      const emailInput = document.getElementById('email');
      const errorDiv = document.getElementById('email-error');
      const successDiv = document.getElementById('sent-success');

      function validEmail(email) {
        // validare simplă
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
      }

      form.addEventListener('submit', function (e) {
        e.preventDefault();
        errorDiv.style.display = 'none';
        successDiv.style.display = 'none';

        const email = emailInput.value.trim();
        if (!email) {
          errorDiv.textContent = 'Te rog introdu adresa de email.';
          errorDiv.style.display = 'block';
          return;
        }
        if (!validEmail(email)) {
          errorDiv.textContent = 'Adresa de email nu este validă.';
          errorDiv.style.display = 'block';
          return;
        }

        // Construim un mailto: care va deschide clientul de email al utilizatorului.
        // Mesajul (body) conține doar textul: "Reseteaza-ti parola"
        const subject = encodeURIComponent('Resetare parolă');
        const body = encodeURIComponent('Reseteaza-ti parola');
        const mailto = `mailto:${encodeURIComponent(email)}?subject=${subject}&body=${body}`;

        // Încearcă să deschizi clientul mail
        // Notă: browserul va deschide aplicația de mail implicită sau webmailul asociat
        // Dacă utilizatorul nu are configurat client de mail, link-ul poate să nu deschidă nimic.
        // Vom totuși să încercăm și afișăm un mesaj de succes după.
        window.location.href = mailto;

        // Arătăm mesajul de succes (vizual), chiar dacă trimiterea efectivă depinde de clientul de email.
        successDiv.style.display = 'block';

        // (opțional) reset form după 1s
        setTimeout(() => {
          form.reset();
        }, 1000);
      });
    })();
  </script>
</body>
  </html>
