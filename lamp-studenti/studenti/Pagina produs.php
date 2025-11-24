<?php include "db.php"; ?>
<!DOCTYPE html>
<html lang="ro">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Filtru de ulei Yamaha - MotoParts.ro</title>
  <link rel="stylesheet" href="style.css">
  <style>
    /* Stiluri suplimentare doar pentru pagina de produs */
    .product-page {
      background-color: white;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 6px rgba(0,0,0,0.1);
      border-top: 3px solid #ff9800;
    }

    .product-details {
      display: flex;
      flex-wrap: wrap;
      gap: 30px;
    }

    .product-image {
      flex: 1 1 300px;
    }

    .product-image img {
      width: 100%;
      max-width: 400px;
      border: 3px solid #ff9800;
      border-radius: 6px;
    }

    .product-info {
      flex: 1 1 300px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .product-info h2 {
      color: #1a1a1a;
      margin-bottom: 10px;
    }

    .price {
      font-size: 1.4em;
      color: #ff9800;
      font-weight: bold;
      margin: 15px 0;
    }

    .add-to-cart, .toggle-details, .check-stock {
      background-color: #ff9800;
      color: white;
      border: none;
      padding: 12px 25px;
      border-radius: 5px;
      font-size: 1em;
      cursor: pointer;
      transition: 0.3s;
      width: fit-content;
      margin-top: 10px;
    }

    .add-to-cart:hover,
    .toggle-details:hover,
    .check-stock:hover {
      background-color: #e68900;
    }

    .description {
      margin-top: 20px;
      color: #333;
      line-height: 1.6;
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
  <a href="motoare.php">Motoare</a>
  <a href="carene.php">Carene</a>
  <a href="frane.php">Frâne</a>
  <a href="accesorii.php">Accesorii</a>
  <a href="anvelope.php">Anvelope</a>
  <a href="ulei.php" class="active">Ulei si Filtre</a>
</nav>

<div class="container">
  <aside class="sidebar">
   <ul>
 <h3>Categorii populare</h3>
    <ul>
      <li>Ulei Motor Enduro</li>
      <li>Ulei Motor Race</li>
      <li>Filtre Sport</li>
      <li>Filtre Enduro</li>
    </ul>
 </ul>
  </aside>

  <div class="main-content">
    <div class="product-page">
      <div class="product-details">
        <div class="product-image">
          <img src="filtru-ulei-yamaha-yzf-250-09-20-mt-125-15-19-yzf-450-09-20-wrf-250-450-09-20-yfz-ybr-yfm-250-181989.jpg" alt="Filtru de ulei Yamaha">
        </div>

        <div class="product-info">
          <h2>Filtru de ulei Yamaha YZF / MT / WRF / YFM</h2>
          <p class="price">49,90 RON</p>

          <button class="add-to-cart">Adaugă în coș 🛒</button>

          <!-- BUTON AFISARE/ASCUNDERE DETALII -->
          <button class="toggle-details">Ascunde detalii</button>

          <!-- BUTON VERIFICARE STOC -->
          <button class="check-stock">Verifică stoc</button>

          <div class="description" id="productDescription">
            <p>
              Filtru de ulei compatibil cu o gamă largă de modele Yamaha:
              YZF 250 (2009–2020), MT 125 (2015–2019), YZF 450 (2009–2020),
              WRF 250 / 450 (2009–2020), YFM 250 etc.
            </p>
            <p>
              Fabricat din materiale de calitate, oferă o filtrare eficientă și protejează motorul
              împotriva impurităților. Recomandat pentru întreținerea regulată a motocicletei.
            </p>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>

<!-- SCRIPT PENTRU FUNCTIONALITATE -->
<script>
  // Ascunde/Afișează detalii
  const toggleBtn = document.querySelector(".toggle-details");
  const description = document.getElementById("productDescription");

  toggleBtn.addEventListener("click", () => {
    if (description.style.display === "none") {
      description.style.display = "block";
      toggleBtn.textContent = "Ascunde detalii";
    } else {
      description.style.display = "none";
      toggleBtn.textContent = "Afișează detalii";
    }
  });

  // Buton verificare stoc
  const stockBtn = document.querySelector(".check-stock");

  stockBtn.addEventListener("click", () => {
    stockBtn.style.backgroundColor = "#4CAF50";
    stockBtn.textContent = "Stoc disponibil ✓";
  });
</script>

</body>
</html>
