
<?php
// date conexiune MariaDB
$host = "localhost";    // sau IP-ul Docker dacă rulezi separat
$port = 3306;           // portul MariaDB
$user = "alex";         // userul creat în MariaDB
$pass = "Alex1234";     // parola userului
$dbname = "Motoparts";  // baza de date creată

// creează conexiunea
$conn = new mysqli($host, $user, $pass, $dbname, $port);

// verifică conexiunea
if ($conn->connect_error) {
    die("❌ Conexiune eșuată: " . $conn->connect_error);
}
?>
