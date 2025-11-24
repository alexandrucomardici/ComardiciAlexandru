<?php include "db.php"; ?>
<!DOCTYPE html>
<html lang="ro">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Accesorii - MotoParts.ro</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<div id="top"></div>
<header>
  <div class="logo"><a href="index.php">MotoParts.ro</a></div>
  <div class="actions">
    <a href="cos.php" class="cart-btn">🛒 Coș</a>
    <a href="login.php" style="color:white; text-decoration:none;">Login / Contul meu</a>
  </div>
</header>
<nav>
  <a href="motoare.php">Motoare</a>
  <a href="carene.php">Carene</a>
  <a href="frane.php">Frâne</a>
  <a href="accesorii.php" class="active">Accesorii</a>
  <a href="anvelope.php">Anvelope</a>
  <a href="ulei.php">Ulei si Filtre</a>
</nav>

<div class="container">
  <aside class="sidebar">
<ul>
    <h2>Tipuri Accesorii</h3>

      <li>●Cască & Echipament</li>
      <li>●Oglinzi & Suporturi</li>
      <li>●Protecții</li>
      <li>●Topcase & Bagaje</li>
  
</ul>
  </aside>

  <div class="main-content">
    <div class="top-products">
      <h2>Accesorii populare</h2>
      <div class="products">
        <div class="product">
          <img src="download.jpg" alt="">
          <p>Cască integrală HJC</p>
        </div>
        <div class="product">
          <img src="oglinda.jpg" alt="">
          <p>Oglindă sport neagră</p>
        </div>
      </div>
    </div>
  </div>
</div>
<a href="#top" class="back-to-top">⬆️ Mergi sus</a>
<footer>
  <p>&copy; 2025 MotoParts.ro - Toate drepturile rezervate.</p>
</footer>

</body>
</html>
