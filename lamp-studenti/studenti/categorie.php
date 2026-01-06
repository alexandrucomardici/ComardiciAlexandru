<?php
session_start();
include "db.php";  // conexiune la MariaDB

// Preluăm id-ul categoriei din URL
$id = intval($_GET['id'] ?? 0);
if ($id <= 0) {
    die("Categorie invalidă.");
}

// Preluăm numele categoriei
$catStmt = $conn->prepare("SELECT nume_categorie FROM categorii WHERE id = ?");
$catStmt->bind_param("i", $id);
$catStmt->execute();
$catRes = $catStmt->get_result();
$categorie = $catRes->fetch_assoc()['nume_categorie'] ?? 'Categorie necunoscută';

// Preluăm produsele din categoria selectată
$stmt = $conn->prepare("SELECT * FROM produse WHERE id_categorie = ?");
$stmt->bind_param("i", $id);  
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="ro">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= htmlspecialchars($categorie) ?> - MotoParts.ro</title>
<link rel="stylesheet" href="style.css">
<style>
body { 
    margin:0; 
    font-family:'Segoe UI', Arial, sans-serif; 
    background: linear-gradient(135deg, #272424ff 0%, #999191ff 50%, #ff9800 90%);
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
header, nav { }
.main-content {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px,1fr));
    gap: 20px;
    justify-items: center;
    padding: 20px;
    max-width: 1200px;
    margin:auto;
}
.product {
    background: linear-gradient(145deg,#fff,#f9f9f9);
    border-radius: 10px;
    padding: 15px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    text-align: center;
    transition: transform 0.3s, box-shadow 0.3s;
}
.product:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
}
.product img {
    width: 150px;
    height: 150px;
    object-fit: contain;
    margin-bottom: 10px;
}
.btn-orange {
    background-color: #ff9800;
    color: white;
    border: none;
    padding: 8px 20px;
    border-radius: 6px;
    font-weight: bold;
    cursor: pointer;
    transition: 0.3s;
}
.btn-orange:hover { background-color: #e68900; }

.category-header { text-align: center; margin-top:20px; }
.category-header img { max-width:100%; height:auto; border-radius:5px; margin-bottom:20px; }

nav a { text-decoration:none; color:white; margin-right:-12px; padding:6px 12px; display:inline-block; }
nav a.active { background:#ff9800; border-radius:5px; }

.breadcrumb {
    max-width: 1200px;
    margin: 15px auto;
    padding-left: 10px;
    font-size: 0.95em;
    color: #555;
}
.breadcrumb a { text-decoration:none; color:#ff9800; }
.breadcrumb span { margin: 0 5px; }
</style>
</head>
<body id="top">

<header style="background:#1a1a1a;color:white;padding:10px 20px;display:flex;justify-content:space-between;align-items:center;border-bottom:3px solid #ff9800;">
  <div class="logo"><a href="index.php" style="color:white;text-decoration:none;font-weight:bold;">MotoParts.ro</a></div>
  <div class="actions">
    <a href="cos.php" class="cart-btn" style="background:#ff9800;padding:8px 12px;border-radius:6px;color:white;text-decoration:none;">🛒 Coș</a>
    <?php if(isset($_SESSION['user_name'])): ?>
        <span style="color:white; margin-left:12px;">Bun venit, <strong><?=htmlspecialchars($_SESSION['user_name'])?></strong></span>
        <a href="logout.php" style="color:white; margin-left:12px; text-decoration:none;"> | Logout</a>
    <?php else: ?>
        <a href="login.php" style="color:white; text-decoration:none; margin-left:12px;">Login / Contul meu</a>
    <?php endif; ?>
  </div>
</header>

<nav style="background:#2b2b2b;padding:10px 20px;">
<?php
$catQuery = "SELECT * FROM categorii ORDER BY id";
$catResult = $conn->query($catQuery);
while($catNav = $catResult->fetch_assoc()):
?>
  <a href="categorie.php?id=<?= $catNav['id'] ?>" <?= ($catNav['id']==$id ? 'class="active"' : '') ?>><?= htmlspecialchars($catNav['nume_categorie']) ?></a>
<?php endwhile; ?>
</nav>

<!-- Breadcrumb -->
<div class="breadcrumb">
    <a href="index.php">Acasă</a> <span>&gt;</span> <span><?= htmlspecialchars($categorie) ?></span>
</div>

<div class="category-header">
    <img src="images/oferta.jpg" alt="Ofertă specială">
</div>

<main class="main-content">
<?php while($prod = $result->fetch_assoc()): ?>
  <a href="produs.php?id=<?= $prod['id'] ?>" style="text-decoration:none; color:inherit;">
    <div class="product">
      <img src="images/<?= htmlspecialchars($prod['imagine']) ?>" alt="<?= htmlspecialchars($prod['nume_produs']) ?>">
      <p><strong><?= htmlspecialchars($prod['nume_produs']) ?></strong></p>
      <p><?= number_format($prod['pret'],2) ?> RON</p>
    </div>
  </a>
<?php endwhile; ?>
</main>

<a href="#top" class="back-to-top">⬆️ Mergi sus</a>

<footer style="text-align:center; padding:20px; color:#555;">
  <p>&copy; 2025 MotoParts.ro — Toate drepturile rezervate.</p>
</footer>

</body>
</html>
