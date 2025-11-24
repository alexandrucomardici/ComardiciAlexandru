<?php
$servername = "mysql"; // numele serviciului MySQL din docker-compose
$username = "user";
$password = "password";
$database = "studenti";

// Crează conexiunea
$conn = new mysqli($servername, $username, $password, $database);

// Verifică conexiunea
if ($conn->connect_error) {
    die("Conexiunea a eșuat: " . $conn->connect_error);
}

echo "Conexiune reușită la baza de date!";
?>
