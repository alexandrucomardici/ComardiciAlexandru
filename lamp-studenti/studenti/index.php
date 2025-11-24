<?php include "db.php"; ?>
<!DOCTYPE html>
<html lang="ro">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MotoParts.ro - Piese Motociclete</title>
  <link rel="stylesheet" href="style.css">
</head>

<body id="top">

  <!-- === HEADER === -->
  <header>
    <div class="logo"><a href="index.php">MotoParts.ro</a></div>
    <div class="actions">
      <a href="cos.php" class="cart-btn">🛒 Coș</a>
      <a href="login.php" style="color:white; text-decoration:none;">Login / Contul meu</a>
    </div>
  </header>

  <!-- === MENIU NAV === -->
  <nav>
    <a href="motoare.php">Motoare</a>
    <a href="carene.php">Carene</a>
    <a href="frane.php">Frâne</a>
    <a href="accesorii.php">Accesorii</a>
    <a href="anvelope.php">Anvelope</a>
    <a href="ulei.php">Ulei și Filtre</a>
  </nav>

  <!-- === GRID PRINCIPAL === -->
  <div class="grid-container">

    <!-- === SIDEBAR === -->
    <aside class="sidebar">
<ul>
      <h3>Oferte & Discount-uri</h3>
        <li>Reduceri la frâne</li>
        <li>Promo carene sport</li>
        <li>Anvelope -20%</li>
        <li>Accesorii noi</li>
      </ul>
    </aside>

    <!-- === CONȚINUT PRINCIPAL === -->
    <main class="main-content">

      <!-- GALERIE IMAGINI PRODUSE -->
      <div class="gallery">
        <img src="motociclu-barton-fr50cc-culoare-negru-verde-467764.jpg" alt="Motocicletă Barton 50cc">
        <img src="2025-Yamaha-YZF900R9-EU-Icon_Blue-360-Degrees-001-03.jpg" alt="Yamaha YZF900R9">
        <img src="Suzuki-GSX-8R--model-cat-pic-1.png" alt="Suzuki GSX-8R">
        <img src="43183.png" alt="Motocicletă Sport">
        <img src="filtru-ulei-yamaha-yzf-250-09-20-mt-125-15-19-yzf-450-09-20-wrf-250-450-09-20-yfz-ybr-yfm-250-181989.jpg" alt="Filtru Ulei Yamaha">
        <img src="kit-carene-ktm-2024-culoare-oem-ufo-grafica-personalizata-cadou-1000x1000.jpg" alt="Carene KTM">
      </div>

      <!-- NEWSLETTER -->
      <div class="newsletter">
        <h2>Abonează-te la newsletter</h2>
        <p>Primește oferte, noutăți și promoții exclusive</p>
        <input type="email" placeholder="Adresa ta de email">
        <button>Abonează-mă</button>
      </div>

      <!-- PRODUSE TOP -->
      <div class="top-products">
        <h2>Cele mai comandate produse</h2>
        <div class="products">
          <div class="product">
            <img src="produsul 1.png" alt="Ulei Motul">
            <p>Ulei Motul</p>
          </div>
          <div class="product">
            <img src="produs 2.png" alt="Plăcuțe Frână Brembo">
            <p>Plăcuțe frână Brembo</p>
          </div>
          <div class="product">
            <img src="produs 3.png" alt="Anvelope Michelin Sport">
            <p>Anvelope Michelin Sport</p>
          </div>
          <div class="product">
            <img src="produs 4.png" alt="Instant Repair Kit">
            <p>Instant Repair Kit</p>
          </div>
        </div>
      </div>

    </main>
  </div>

  <!-- === BACK TO TOP === -->
  <a href="#top" class="back-to-top">⬆️ Mergi sus</a>

  <!-- === FOOTER === -->
  <footer>
    <p>&copy; 2025 MotoParts.ro - Toate drepturile rezervate.</p>
  </footer>
<div id="popup">
  <div id="popup-content">
    <button id="close-btn">&times;</button>
    <a href="bfriday.php">
      <img src="blackfriday.png" alt="Black Friday">
    </a>
  </div>
</div>

<script>
  window.onload = function() {
    setTimeout(() => {
      document.getElementById("popup").style.display = "flex";
    }, 2000);
  };

  document.getElementById("close-btn").onclick = function() {
    document.getElementById("popup").style.display = "none";
  };
</script>

</body>
</html>
