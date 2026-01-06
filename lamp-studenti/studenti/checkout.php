<?php
session_start();
include "db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$userId = $_SESSION['user_id'];
$userName = $_SESSION['user_name'];
$userEmail = $_SESSION['user_email'] ?? '';
$userTelefon = $_SESSION['user_telefon'] ?? '';
$userAdresa = $_SESSION['user_adresa'] ?? '';

$popupMessage = '';
$orderNumber = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {

    // Preluăm valorile din formular, dar dacă nu sunt completate, folosim cele din sesiune
    $nume = $_POST['nume'] ?? $userName;
    $telefon = $_POST['telefon'] ?? $userTelefon;
    $email = $_POST['email'] ?? $userEmail;
    $adresa = $_POST['adresa'] ?? $userAdresa;

    $totalPlata = 0;
    foreach ($_SESSION['cart'] as $prodId => $prod) {
        $totalPlata += $prod['pret'] * $prod['cantitate'];
    }

    // Data comenzii ca text
    $dataComanda = date("d-m-Y H:i:s");

    // Inserare în comenzi
    $stmt = $conn->prepare("INSERT INTO comenzi (id_utilizator, nume, telefon, email, data, total_plata, adresa) VALUES (?, ?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("Eroare la pregătirea interogării: " . $conn->error);
    }

    $stmt->bind_param("isssdss", $userId, $nume, $telefon, $email, $dataComanda, $totalPlata, $adresa);

    if ($stmt->execute()) {
        $orderNumber = $stmt->insert_id; // ID-ul comenzii inserate
        $stmt->close();

        // Inserare produse în comenzi_produs
        $stmtProd = $conn->prepare("INSERT INTO comenzi_produs (id_produs, id_comanda, cantitate, pret_la_moment) VALUES (?, ?, ?, ?)");
        if (!$stmtProd) die("Eroare la pregătirea produselor: " . $conn->error);

        foreach ($_SESSION['cart'] as $prodId => $prod) {
            $stmtProd->bind_param(
                "iiid",
                $prodId,
                $orderNumber,
                $prod['cantitate'],
                $prod['pret']
            );
            $stmtProd->execute();
        }
        $stmtProd->close();

        // Golim coșul
        unset($_SESSION['cart']);

        $popupMessage = "Comanda ta a fost plasată cu succes! Număr comandă: $orderNumber";
    } else {
        die("Eroare la inserare comandă: " . $stmt->error);
    }
}
?>

<!DOCTYPE html>
<html lang="ro">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Checkout - MotoParts.ro</title>
<style>
body { font-family: 'Segoe UI', Arial, sans-serif; background:#f3f3f3; margin:0; padding:0; }
header { background:#1a1a1a; color:white; padding:10px 20px; display:flex; justify-content:space-between; align-items:center; border-bottom:3px solid #ff9800; }
header a { color:white; text-decoration:none; margin-left:12px; }
.container { max-width:800px; margin:50px auto; background:white; padding:30px; border-radius:8px; box-shadow:0 4px 10px rgba(0,0,0,0.1); }
h2 { color:#1a1a1a; margin-bottom:20px; }
form input, form textarea { width:100%; padding:10px; margin-bottom:15px; border:1px solid #ccc; border-radius:5px; }
button { background:#ff9800; color:white; border:none; padding:12px 20px; border-radius:6px; cursor:pointer; transition:0.3s; }
button:hover { background:#e68900; }
#popup {
    position:fixed;
    top:20px;
    right:20px;
    background:rgba(255,152,0,0.9);
    color:white;
    padding:10px 15px;
    border-radius:5px;
    box-shadow:0 4px 10px rgba(0,0,0,0.2);
    display:none;
    font-size:0.9em;
    max-width:250px;
    text-align:center;
    z-index:1000;
}
</style>
</head>
<body>

<header>
    <div class="logo"><a href="index.php">MotoParts.ro</a></div>
    <div class="actions">
        <a href="cos.php">🛒 Coș</a>
        <span>Bun venit, <?=htmlspecialchars($userName)?></span>
        <a href="logout.php"> | Logout</a>
    </div>
</header>

<div class="container">
    <h2>Finalizează comanda</h2>
    <h5>Toate comenzile pot fi plătite doar numerar la livrare</h5>

    <?php if (!isset($_SESSION['cart']) || count($_SESSION['cart'])==0): ?>
        <p>Coșul tău este gol.</p>
    <?php else: ?>
        <form method="post">
            <label>Nume:</label>
            <input type="text" name="nume" value="<?=htmlspecialchars($userName)?>" required>

            <label>Telefon:</label>
            <input type="text" name="telefon" value="<?=htmlspecialchars($userTelefon)?>" required>

            <label>Email:</label>
            <input type="email" name="email" value="<?=htmlspecialchars($userEmail)?>" required>

            <label>Adresă:</label>
            <textarea name="adresa" required><?=htmlspecialchars($userAdresa)?></textarea>

            <button type="submit">Finalizează comanda</button>
        </form>
    <?php endif; ?>
</div>

<div id="popup"><?= htmlspecialchars($popupMessage) ?></div>

<script>
const popup = document.getElementById("popup");
<?php if($popupMessage): ?>
popup.style.display = "block";
setTimeout(() => { popup.style.display = "none"; }, 5000);
<?php endif; ?>
</script>

</body>
</html>