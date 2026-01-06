<?php
session_start();
include "db.php";

// Preluăm categoriile
$query_cat = "SELECT * FROM categorii ORDER BY id";
$res_cat = $conn->query($query_cat);
if(!$res_cat) die("Eroare la interogarea categoriilor: ".$conn->error);

// Preluăm produse recomandate (2 produse per categorie)
$produse_recomandate = [];
while($cat = $res_cat->fetch_assoc()) {
    $id_cat = $cat['id'];
    $query_prod = "SELECT * FROM produse WHERE id_categorie = $id_cat ORDER BY id DESC LIMIT 2";
    $res_prod = $conn->query($query_prod);
    if($res_prod){
        while($prod = $res_prod->fetch_assoc()){
            $prod['categorie_id'] = $id_cat; // salvăm id-ul categoriei pentru link
            $produse_recomandate[] = $prod;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ro">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>MotoParts.ro - Piese Motociclete</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="style.css">
<style>
/* ===== BACKGROUND GRAFFITI ===== */
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
header .actions a, header .actions span { margin-left:12px; color:white; text-decoration:none; }
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

/* Banner site */
.banner { 
    background: linear-gradient(135deg, rgba(255,152,0,0.9), rgba(255,204,0,0.8));
    color:#fff; 
    text-align:center; 
    padding:40px 20px; 
    border-radius:12px; 
    margin:30px auto; 
    max-width:1200px; 
    box-shadow:0 6px 15px rgba(0,0,0,0.1); 
}

/* Main grid */
.main-content { max-width:1200px; margin:40px auto; padding:0 15px; }
.section-title { font-size:1.8em; font-weight:bold; margin-bottom:20px; padding-left:10px; border-left:6px solid #ff9800; }

/* Produse recomandate */
.products { display:grid; grid-template-columns:repeat(auto-fit, minmax(220px,1fr)); gap:25px; }
.product { 
    background: linear-gradient(145deg, #fff, #f9f9f9); 
    border-radius:12px; 
    box-shadow:0 8px 20px rgba(0,0,0,0.1); 
    padding:15px; 
    text-align:center; 
    transition:0.3s; 
}
.product:hover { transform:translateY(-5px); box-shadow:0 12px 25px rgba(0,0,0,0.15); }
.product img { width:100%; height:180px; object-fit:cover; border-radius:8px; margin-bottom:10px; }
.product p { margin:5px 0; }
.btn-orange { background:#ff9800; color:white; border:none; padding:8px 20px; border-radius:6px; font-weight:bold; transition:0.3s; cursor:pointer; }
.btn-orange:hover { background:#e68900; }

/* Footer */
footer { text-align:center; padding:20px; color:#555; margin-top:50px; }
</style>
</head>
<body>

<header>
    <div class="logo"><a href="index.php">MotoParts.ro</a></div>
    <div class="actions">
        <a href="cos.php" class="cart-btn">🛒 Coș</a>
        <?php if (isset($_SESSION['user_name'])): ?>
            <span>Bun venit, <strong><?=htmlspecialchars($_SESSION['user_name'])?></strong></span>
            <a href="logout.php"> | Logout</a>
        <?php else: ?>
            <a href="login.php">Login / Contul meu</a>
        <?php endif; ?>
    </div>
</header>

<nav>
<?php
$res_cat->data_seek(0); 
while($cat = $res_cat->fetch_assoc()):
?>
  <a href="categorie.php?id=<?= $cat['id'] ?>" 
     <?= (isset($_GET['categorie_id']) && $_GET['categorie_id']==$cat['id'] ? 'class="active"' : '') ?>>
     <?= htmlspecialchars($cat['nume_categorie']) ?>
  </a>
<?php endwhile; ?>
</nav>

<div class="banner">
    <h1>Bine ai venit la MotoParts.ro!</h1>
    <p>Găsești cele mai bune piese pentru motocicleta ta: motoare, carene, frâne, anvelope, ulei și accesorii, toate la prețuri competitive și livrare rapidă.</p>
</div>

<div class="main-content">
    <h2 class="section-title">Produse recomandate</h2>
    <div class="products">
        <?php foreach($produse_recomandate as $produs): ?>
        <div class="product">
            <a href="produs.php?id=<?= intval($produs['id']) ?>">
                <img src="images/<?=htmlspecialchars($produs['imagine'])?>" alt="<?=htmlspecialchars($produs['nume_produs'])?>">
            </a>
            <p><strong>
                <a href="produs.php?id=<?= intval($produs['id']) ?>" style="text-decoration:none; color:#1a1a1a;">
                    <?=htmlspecialchars($produs['nume_produs'])?>
                </a>
            </strong></p>
            <p><?=htmlspecialchars($produs['descriere'])?></p>
            <p>Stoc: <?=intval($produs['stoc'])?> | Preț: <?=number_format($produs['pret'],2)?> RON</p>

            <form method="post" action="cos.php">
                <input type="hidden" name="produs_id" value="<?=intval($produs['id'])?>">
                <input type="number" name="cantitate" value="1" min="1" style="width:50px;">
                <button type="submit" class="btn-orange">Add to Cart</button>
            </form>

            <a href="categorie.php?id=<?= $produs['categorie_id'] ?>" class="btn-orange" style="display:inline-block;margin-top:10px;">Vezi categoria</a>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<footer>
    &copy; 2025 MotoParts.ro — Toate drepturile rezervate.
</footer>

</body>
</html>