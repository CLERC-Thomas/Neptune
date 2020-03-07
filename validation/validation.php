<?php
session_start();

require "../fonction.php";

$login='root';
$pass='';

$BDD=getDataBase($login,$pass);

$verif=VerificationPaiment($BDD,$_SESSION['id_chambre'],$_SESSION['id_client'],$_SESSION['date_depart'],$_SESSION['date_arrive']);


if($_SESSION!=null and $verif['0']['reservation']==0 and $verif['0']['paye']==-1){
    require "mail/mail.php";
    Reservation($BDD,$_SESSION['id_chambre'],$_SESSION['id_client'],$_SESSION['date_depart'],$_SESSION['date_arrive']);

    echo "<h1>Reservation effectué</h1>
    <p>Merci pour votre reservation</p>
    <p>Veuillez consultez vos mails, pour voir votre facture.</p>
    
    <a href='../index.php'><br>
    <button>Retournez à l'accueil</button></a>";


}else{
    echo "Une erreur s'est produite";
    echo "<a href='../index.php'><br>
    <button>Retournez à l'accueil</button></a>";

}

