<?php include "db.php"; ?>
<!DOCTYPE html>
<html lang="ro">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Anvelope - MotoParts.ro</title>
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
  <a href="accesorii.php">Accesorii</a>
  <a href="anvelope.php" class="active">Anvelope</a>
  <a href="ulei.php">Ulei si Filtre</a>
</nav>

<div class="container">
  <aside class="sidebar">
<ul>
    <h2>Tipuri Anvelope</h3>
      <li>●Stradale</li>
      <li>●Sport</li>
      <li>●Enduro</li>
      <li>●All-season</li>
    </ul>
  </aside>

  <div class="main-content">
    <div class="top-products">
      <h2>Anvelope disponibile</h2>
      <div class="products">
        <div class="product">
          <img src="produs 3.png" alt="">
          <p>Anvelopă Sport Michelin</p>
        </div>
        <div class="product">
          <img src="anvelopa.png" alt="">
          <p>Anvelopă Enduro Dunlop</p>
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
