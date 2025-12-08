<?php
$host = "127.0.0.1"; // sau IP-ul containerului
$port = "3306";
$dbname = "Comardici_Alexandru";
$username = "root"; // sau alt user creat
$password = "parola_ta";

try {
    $db = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
