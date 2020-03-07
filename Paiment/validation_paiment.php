<?php
session_start();

require "../fonction.php";
$login='root';
$pass='';

$BDD=getDataBase($login,$pass);
$verif=Verification($BDD,$_SESSION['id_chambre'],$_SESSION['date_arrive'],$_SESSION['date_depart']);


if (empty($verif) and $_SESSION['id_chambre']!=null and $_SESSION['date_arrive']!=null and $_SESSION['date_depart']!=null and $_SESSION['date_arrive']<$_SESSION['date_depart']){
    Paiment($BDD,$_SESSION['id_chambre'],$_SESSION['id_client'],$_SESSION['date_depart'],$_SESSION['date_arrive']);
    echo '<h1>Paiment effectué</h1>';
    echo 'Cliquez sur le bouton pour continuer la reservation<br>';
    echo "<a href='../validation/validation.php'>
    <button>Suivant</button></a>";

}else{
    echo "Une erreur s'est produite";
    echo "<a href='../index.php'><br>
    <button>Retournez à l'accueil</button></a>";
}
