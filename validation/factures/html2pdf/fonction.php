<?php

function getDataBase($login,$pass){
    try {
        $BDD = new PDO('mysql:host=localhost;dbname=hotel;', $login, $pass);
        $BDD->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $e){
        echo 'Echec de la connexion : '. $e->getMessage();
    }
    return $BDD;
}


function Affiche(PDO $BDD){
    if ($_POST!=null and $_POST['arrive']<$_POST['depart']){
        $requete = $BDD->prepare("SELECT * FROM chambres as c WHERE c.numero NOT IN (
                                            SELECT numero FROM `chambres` as c, planning as p 
                                            WHERE c.numero = p.chambre_id 
                                            AND (p.arrive BETWEEN :arrive AND :depart OR p.depart BETWEEN :arrive AND :depart) 
                                            GROUP BY c.numero)");
        $requete->execute(array("arrive"=>$_POST['arrive'],
                                 "depart"=>$_POST['depart']));
        $resultat = $requete->fetchAll();
        return $resultat;

    }else{
        echo 'Veuillez choisir une date';
    }
}


function emailReservation($dest){
    $sujet = "Reservation Chambre";
    $headers = "From: \"Hotel Neptune\"<contact@neptune.fr>\n";
    $headers .= "Reply-To: contact@neptune.fr\n";
    $headers .= "Content-Type: text/html; charset=\"iso-8859-1\"";
    $corp=file_get_contents ('email.html');
    if (mail($dest, $sujet, $corp, $headers, $headers)) {

    } else {
        echo "Échec de l'envoi de l'email...";
    }
}