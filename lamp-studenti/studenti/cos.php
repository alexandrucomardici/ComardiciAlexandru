<?php
session_start();
include "db.php";

// 1️⃣ Ștergere produs din coș prin link
if (isset($_GET['remove_id'])) {
    $removeId = intval($_GET['remove_id']);
    if (isset($_SESSION['cart'][$removeId])) {
        unset($_SESSION['cart'][$removeId]);
    }
    header("Location: cos.php");
    exit;
}

// 2️⃣ Actualizare cantități la submit
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['quantities'])) {
    foreach ($_POST['quantities'] as $id => $qty) {
        $id = intval($id);
        $qty = intval($qty);
        if ($qty <= 0) {
            unset($_SESSION['cart'][$id]);
        } else {
            $_SESSION['cart'][$id]['cantitate'] = $qty;
        }
    }
    header("Location: cos.php");
    exit;
}

// 3️⃣ Funcție pentru a prelua datele produsului din baza de date
function getProduct($conn, $id) {
    $stmt = $conn->prepare("SELECT * FROM produse WHERE id=?");
    $stmt->bind_param("i",$id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

// 4️⃣ Popup pentru produs adăugat
$showPopup = false;
if (isset($_GET['added'])) {
    $showPopup = true;
}
?>

<!DOCTYPE html>
<html lang="ro">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Coșul de cumpărături - MotoParts.ro</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body { margin:0; font-family:'Segoe UI',Arial,sans-serif; background:#f3f3f3; }
header { background:#1a1a1a; color:#fff; padding:10px 20px; display:flex; justify-content:space-between; align-items:center; border-bottom:3px solid #ff9800; }
header .logo a { color:white; text-decoration:none; font-weight:bold; font-size:1.5em; }
.cart-btn { background:#ff9800; padding:8px 14px; border-radius:5px; color:white; font-weight:bold; text-decoration:none; transition:0.3s; }
.cart-btn:hover { background:#e68900; }
nav { background:#2b2b2b; display:flex; justify-content:center; gap:25px; padding:10px 0; border-bottom:2px solid #ff9800; }
nav a { color:white; text-decoration:none; font-weight:600; transition:0.3s; }
nav a:hover { color:#ff9800; }
.container { margin-top:40px; max-width:1100px; }
h2 { border-left:6px solid #ff9800; padding-left:10px; font-weight:bold; color:#222; margin-bottom:25px; }
.card { background:white; border:none; border-radius:10px; box-shadow:0 4px 10px rgba(0,0,0,0.1); padding:25px; }
.cart-table th { background:#ff9800; color:white; text-align:center; }
.cart-table td { vertical-align:middle; text-align:center; }
.cart-table img { width:80px; height:auto; border-radius:5px; border:2px solid #ff9800; }
.btn-orange { background:#ff9800; color:white; border:none; padding:10px 25px; border-radius:6px; font-weight:bold; transition:0.3s; }
.btn-orange:hover { background:#e68900; }
.btn-remove { background:#dc3545; border:none; color:white; border-radius:5px; padding:5px 10px; cursor:pointer; transition:0.3s; }
.btn-remove:hover { background:#b02a37; }
.stock-available { color:green; font-weight:bold; }
.stock-unavailable { color:red; font-weight:bold; }

/* Popup produs adăugat */
#popup {
    position:fixed;
    top:20px;
    right:20px;
    background:#ff9800cc; /* puțin transparent */
    color:white;
    padding:10px 15px;
    border-radius:6px;
    box-shadow:0 4px 10px rgba(0,0,0,0.2);
    display:none;
    z-index:1000;
    font-weight:bold;
    font-size:0.95em;
}

footer { margin-top:60px; text-align:center; color:#555; padding:20px; }
</style>
</head>
<body>

<header>
  <div class="logo"><a href="index.php">MotoParts.ro</a></div>
  <div class="actions">
    <a href="cos.php" class="cart-btn">🛒 Coș</a>
    <?php if(isset($_SESSION['user_id'])): ?>
      <span style="color:white;">Bun venit, <strong><?=htmlspecialchars($_SESSION['user_name'])?></strong></span>
      <a href="logout.php" style="color:white;text-decoration:none;"> | Logout</a>
    <?php else: ?>
      <a href="login.php" style="color:white; text-decoration:none;">Login / Contul meu</a>
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

<div class="container">
  <h2>Coșul tău de cumpărături</h2>

  <div class="card">
    <form method="post">
      <table class="table cart-table align-middle">
        <thead>
          <tr>
            <th>Produs</th>
            <th>Nume</th>
            <th>Cantitate</th>
            <th>Preț</th>
            <th>Total</th>
            <th>Stoc</th>
            <th>Șterge</th>
          </tr>
        </thead>
        <tbody>
        <?php
        $grandTotal = 0;
        if(isset($_SESSION['cart']) && count($_SESSION['cart'])>0):
            foreach($_SESSION['cart'] as $id => $prod):
                $dbProd = getProduct($conn, $id);
                $cantitate = $prod['cantitate'];
                $total = $dbProd['pret'] * $cantitate;
                $grandTotal += $total;
                $stockClass = ($dbProd['stoc'] > 0) ? "stock-available" : "stock-unavailable";
                $stockText = ($dbProd['stoc'] > 0) ? "Stoc disponibil" : "Stoc epuizat";
        ?>
          <tr>
            <td><img src="images/<?=htmlspecialchars($dbProd['imagine'])?>" alt="<?=htmlspecialchars($dbProd['nume_produs'])?>"></td>
            <td><?=htmlspecialchars($dbProd['nume_produs'])?></td>
            <td><input type="number" name="quantities[<?=$id?>]" class="form-control qty" value="<?=$cantitate?>" min="1"></td>
            <td class="price"><?=number_format($dbProd['pret'],2)?> RON</td>
            <td class="total"><?=number_format($total,2)?></td>
            <td class="<?= $stockClass ?>"><?= $stockText ?></td>
            <td><a href="cos.php?remove_id=<?=$id?>" class="btn-remove">✖</a></td>
          </tr>
        <?php
            endforeach;
        else:
        ?>
          <tr>
            <td colspan="7">Coșul tău este gol.</td>
          </tr>
        <?php endif; ?>
        </tbody>
      </table>

      <?php if(isset($_SESSION['cart']) && count($_SESSION['cart'])>0): ?>
        <div class="text-end mt-3">
          <h4>Total general: <span id="grand-total" style="color:#ff9800;"><?=number_format($grandTotal,2)?> RON</span></h4>
          <button type="submit" class="btn-orange mt-2">Actualizează cantități</button>
          <a href="checkout.php" class="btn-orange mt-2">Finalizează comanda</a>
        </div>
      <?php endif; ?>
    </form>
  </div>
</div>

<!-- Popup -->
<div id="popup">Produs adăugat în coș ✅</div>

<script>
// Afișare popup dacă a fost adăugat produs
<?php if($showPopup): ?>
const popup = document.getElementById("popup");
popup.style.display = "block";
setTimeout(() => { popup.style.display = "none"; }, 2500);
<?php endif; ?>
</script>

<footer>
  <p>© 2025 MotoParts.ro — Toate drepturile rezervate.</p>
</footer>

</body>
</html>
