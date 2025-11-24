<?php
$servername = "mysql"; // NUMELE serviciului MySQL din docker-compose
$username = "user";
$password = "password";
$database = "studenti";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Conexiunea a eșuat: " . $conn->connect_error);
}
?>