<?php
$login='root';
$pass='';
session_start();

if (!empty($_SESSION['id_client'])){
    require 'formulaire.php';
    require 'filtrage.php';
}else{
    echo 'Veuillez vous connecter';
    echo "<a href='../index.php'>
    <button>Retournez à l'accueil</button></a>";
}


?>
