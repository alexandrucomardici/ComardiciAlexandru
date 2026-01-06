<?php
$host = "localhost";
$port = 3306;
$user = "alex";
$pass = "Alex1234";
$dbname = "Motoparts";

$conn = new mysqli($host, $user, $pass, $dbname, $port);

if ($conn->connect_error) {
    die("❌ Conexiune eșuată: " . $conn->connect_error);
} else {
    echo "✅ Conectat cu succes la baza de date MariaDB!";
}
?>
