<?php
session_start();
include "db.php";

// Preluăm id-ul produsului din URL
$id = intval($_GET['id'] ?? 0);
if ($id <= 0) {
    die("Produs invalid.");
}

// Preluăm datele produsului
$stmt = $conn->prepare("SELECT p.*, c.nume_categorie FROM produse p 
                        JOIN categorii c ON p.id_categorie = c.id 
                        WHERE p.id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$produs = $result->fetch_assoc();

if (!$produs) {
    die("Produsul nu a fost găsit.");
}
?>

<!DOCTYPE html>
<html lang="ro">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= htmlspecialchars($produs['nume_produs']) ?> - MotoParts.ro</title>
<link rel="stylesheet" href="style.css">
<style>
body { 
    margin:0; 
    font-family:'Segoe UI', Arial, sans-serif; 
    background: linear-gradient(135deg, #272424ff 0%, #999191ff 50%, #ff9800 100%);
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
header {
    background:#1a1a1a;
    color:white;
    padding:10px 20px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    border-bottom:3px solid #ff9800;
}
header .logo a {
    color:white;
    text-decoration:none;
    font-weight:bold;
    font-size:1.5em;
}
header .actions a, header .actions span {
    margin-left:12px;
    color:white;
    text-decoration:none;
}
header .cart-btn {
    background:#ff9800;
    padding:8px 12px;
    border-radius:6px;
    font-weight:bold;
}
nav {
    background:#2b2b2b;
    display:flex;
    justify-content:center;
    gap:20px;
    padding:10px 0;
    border-bottom:2px solid #ff9800;
}
nav a {
    color:white;
    text-decoration:none;
    font-weight:600;
}
nav a:hover, nav a.active { color:#ff9800; }

/* Oferta banner deasupra */
.offer-banner {
    text-align:center;
    margin:20px 0;
}
.offer-banner img {
    max-width:600px;
    width:90%;
    border-radius:10px;
    object-fit:cover;
}

/* Container produs */
.container {
    max-width:1200px;
    margin:0 auto;
    padding:20px;
    display:flex;
    flex-wrap:wrap;
    gap:40px;
}

/* Imagine produs stanga */
.product-image {
    flex:1 1 400px;
}
.product-image img {
    width:100%;
    max-width:500px;
    border-radius:6px;
    border:3px solid #ff9800;
}

/* Info produs dreapta */
.product-info {
    flex:1 1 400px;
    display:flex;
    flex-direction:column;
}
.product-info h2 {
    font-size:2em;
    margin-bottom:15px;
}
.product-info .description {
    font-size:1.1em;
    line-height:1.6;
    margin-bottom:20px;
}
.product-info .price {
    font-size:1.6em;
    color:#ff9800;
    font-weight:bold;
    margin-bottom:20px;
}
.product-info .buttons {
    display:flex;
    gap:15px;
}
button {
    background-color:#ff9800;
    color:white;
    border:none;
    padding:12px 25px;
    border-radius:6px;
    font-size:1em;
    cursor:pointer;
    transition:0.3s;
}
button:hover { background-color:#e68900; }

/* Popup notificare */
#popup {
    position: fixed;               /* fix în fereastră */
    top: 50px;                     /* distanță de sus */
    left: 1300px;                   /* distanță de dreapta */
    background: rgba(255, 152, 0, 0.95); /* portocaliu semi-transparent */
    color: white;
    padding: 10px 15px;            /* compact */
    border-radius: 6px;
    font-size: 0.9em;
    box-shadow: 0 3px 8px rgba(0,0,0,0.25);
    display: none;                  /* ascuns inițial */
    z-index: 9999;                  /* deasupra tuturor */
    width: auto;                    /* lățime automată după text */
    max-width: 220px;               /* nu mai mare de atât */
    text-align: center;
    white-space: nowrap;            /* textul nu se rupe */
    height: auto;                   /* înălțimea să se adapteze conținutului */
}




/* Responsive */
@media (max-width:900px) {
    .container { flex-direction:column; align-items:center; }
    .product-info { flex:1 1 100%; }
    .product-image { flex:1 1 100%; }
}
</style>
</head>
<body>

<header>
  <div class="logo"><a href="index.php">MotoParts.ro</a></div>
  <div class="actions">
    <a href="cos.php" class="cart-btn">🛒 Coș</a>
    <?php if(isset($_SESSION['user_name'])): ?>
        <span>Bun venit, <strong><?=htmlspecialchars($_SESSION['user_name'])?></strong></span>
        <a href="logout.php"> | Logout</a>
    <?php else: ?>
        <a href="login.php">Login / Contul meu</a>
    <?php endif; ?>
  </div>
</header>

<nav>
<?php
$catQuery = "SELECT * FROM categorii ORDER BY id";
$catResult = $conn->query($catQuery);
while($catNav = $catResult->fetch_assoc()):
?>
  <a href="categorie.php?id=<?= $catNav['id'] ?>"><?= htmlspecialchars($catNav['nume_categorie']) ?></a>
<?php endwhile; ?>
</nav>

<!-- Poza oferta.jpg deasupra -->
<div class="offer-banner">
    <img src="images/oferta.jpg" alt="Ofertă specială">
</div>

<div class="container">
    <div class="product-image">
        <img src="images/<?= htmlspecialchars($produs['imagine']) ?>" alt="<?= htmlspecialchars($produs['nume_produs']) ?>">
    </div>
    <div class="product-info">
        <h2><?= htmlspecialchars($produs['nume_produs']) ?></h2>
        <div class="description"><?= nl2br(htmlspecialchars($produs['descriere'])) ?></div>
        <div class="price"><?= number_format($produs['pret'],2) ?> RON</div>
        <div class="buttons">
            <button id="addToCart" data-id="<?= $produs['id'] ?>">Adaugă în coș 🛒</button>
            <button id="checkStock">Verifică stoc</button>
        </div>
    </div>
</div>

<!-- Popup -->
<div id="popup">Produs adăugat în coș!</div>

<script>
// Verificare stoc
const stockBtn = document.getElementById("checkStock");
stockBtn.addEventListener("click", () => {
    stockBtn.style.backgroundColor = "#4CAF50";
    stockBtn.textContent = "Stoc disponibil ✓";
});

// AJAX adaugare in cos
document.getElementById("addToCart").addEventListener("click", function(){
    const prodId = this.dataset.id;
    fetch("add_to_cart.php", {
        method:"POST",
        headers:{"Content-Type":"application/x-www-form-urlencoded"},
        body:"produs_id="+prodId+"&cantitate=1"
    })
    .then(response => response.text())
    .then(res => {
        const popup = document.getElementById("popup");
        popup.style.display = "block";
        setTimeout(()=>{popup.style.display="none"},2500);
    });
});
</script>

</body>
</html>
