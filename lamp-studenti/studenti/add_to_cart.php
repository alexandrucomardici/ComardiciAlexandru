<?php
session_start();
include "db.php";

if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['produs_id'])){
    $id = intval($_POST['produs_id']);
    $cantitate = intval($_POST['cantitate'] ?? 1);

    $stmt = $conn->prepare("SELECT * FROM produse WHERE id=?");
    $stmt->bind_param("i",$id);
    $stmt->execute();
    $prod = $stmt->get_result()->fetch_assoc();

    if($prod){
        if(!isset($_SESSION['cart'][$id])){
            $_SESSION['cart'][$id] = [
                'nume' => $prod['nume_produs'],
                'pret' => $prod['pret'],
                'cantitate' => $cantitate,
                'imagine' => "images/".$prod['imagine']
            ];
        }else{
            $_SESSION['cart'][$id]['cantitate'] += $cantitate;
        }
        echo "ok";
    }else{
        echo "Produs inexistent";
    }
}
?>
