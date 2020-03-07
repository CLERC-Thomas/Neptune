<?php
function visualisation_admin(PDO $BDD){
    $requete = $BDD->prepare ("SELECT chambre_id , reservation , paye , client_id , depart, arrive , token,facture FROM planning
                ORDER BY chambre_id ASC");
    $requete->execute();
    $resultat = $requete->fetchAll();
    return $resultat;
}

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