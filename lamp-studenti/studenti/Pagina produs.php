<?php
include "db.php";  // asigură-te că calea e corectă
?>

<!DOCTYPE html>
<html lang="ro">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Filtru de ulei Yamaha - MotoParts.ro</title>
  <link rel="stylesheet" href="style.css">
  <style>
    /* ===== BACKGROUND GRAFFITI ===== */
    body { 
      margin:0; 
      font-family:'Segoe UI', Arial, sans-serif; 
      background: linear-gradient(135deg, #e0e0e0 0%, #ffffff 50%, #ff9800 100%);
      background-size: cover;
      background-repeat: no-repeat;
      background-attachment: fixed;
      position: relative;
    }
    body::before {
      content:"";
      position:fixed;
      top:0; left:0; right:0; bottom:0;
      background: url('images/spray-texture.png') repeat;
      opacity:0.05;
      pointer-events:none;
    }

    /* HEADER */
    header { 
        background:#1a1a1a;
        color:white;
        padding:10px 20px;
        display:flex;
        justify-content:space-between;
        align-items:center;
        border-bottom:3px solid #ff9800;
    }
    header .logo a { color:white; text-decoration:none; font-weight:bold; font-size:1.5em; }
    header .actions a { margin-left:12px; color:white; text-decoration:none; }
    header .cart-btn { background:#ff9800; padding:8px 12px; border-radius:6px; font-weight:bold; }

    /* NAV */
    nav { 
        background:#2b2b2b; 
        display:flex; 
        justify-content:center; 
        flex-wrap:wrap; 
        gap:10px; 
        padding:10px 20px;
    }
    nav a { 
        text-decoration:none; 
        color:white; 
        padding:6px 12px; 
        display:inline-block; 
        border-radius:5px; 
        font-weight:600;
    }
    nav a.active { background:#ff9800; color:white; }
    nav a:hover { background:#ff9800; color:white; }

    /* PAGINA PRODUS */
    .container {
      display:flex;
      max-width:1200px;
      margin:40px auto;
      padding:0 15px;
      gap:30px;
      flex-wrap:wrap;
    }
    .sidebar {
      flex:1 1 200px;
      background: rgba(255,255,255,0.9);
      padding:15px;
      border-radius:8px;
      box-shadow: 0 0 6px rgba(0,0,0,0.1);
      border-top:3px solid #ff9800;
    }
    .sidebar h3 { margin-top:0; color:#1a1a1a; }
    .sidebar ul { list-style:none; padding:0; }
    .sidebar li { margin-bottom:8px; }

    .main-content { flex:2 1 600px; }

    .product-page {
      background: rgba(255,255,255,0.95);
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
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

    /* Responsive */
    @media(max-width:768px){
      .product-details { flex-direction: column; }
      .product-image, .product-info { flex:1 1 100%; }
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
  <a href="ulei.php" class="active">Ulei și Filtre</a>
</nav>

<div class="container">
  <aside class="sidebar">
    <h3>Categorii populare</h3>
    <ul>
      <li>Ulei Motor Enduro</li>
      <li>Ulei Motor Race</li>
      <li>Filtre Sport</li>
      <li>Filtre Enduro</li>
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

          <button class="toggle-details">Ascunde detalii</button>

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

<script>
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

  const stockBtn = document.querySelector(".check-stock");
  stockBtn.addEventListener("click", () => {
    stockBtn.style.backgroundColor = "#4CAF50";
    stockBtn.textContent = "Stoc disponibil ✓";
  });
</script>

</body>
</html>
