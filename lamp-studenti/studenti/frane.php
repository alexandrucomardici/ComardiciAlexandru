<?php include "db.php"; ?>
<!DOCTYPE html>
<html lang="ro">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Frâne - MotoParts.ro</title>
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
  <a href="frane.php" class="active">Frâne</a>
  <a href="accesorii.php">Accesorii</a>
  <a href="anvelope.php">Anvelope</a>
  <a href="ulei.php">Ulei si Filtre</a>
</nav>

<div class="container">
  <aside class="sidebar">
<ul>
    <h2>Componente Frâne</h2>
      <li>●Discuri</li>
      <li>●Plăcuțe</li>
      <li>●Etriere</li>
      <li>●Conducte & Lichide</li>
    </ul>
  </aside>

  <div class="main-content">
    <div class="top-products">
      <h2>Frâne disponibile</h2>
      <div class="products">
        <div class="product">
          <img src="disc.png" alt="">
          <p>Disc frână Brembo</p>
        </div>
        <div class="product">
          <img src="produs 2.png" alt="">
          <p>Plăcuțe EBC Racing</p>
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
