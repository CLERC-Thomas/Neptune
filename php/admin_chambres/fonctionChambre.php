<?php

function getDataBase() {
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=hotel;charset=utf8',
            'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    } catch (Exception $exception) {
        $bdd = null;
    }
    return $bdd;
}

function getAllChambre(PDO $bdd, $chambre) {
    $query = "SELECT numero, capacite, exposition, douche, etage, prix FROM chambres, tarifs WHERE tarifs.id = chambres.tarif_id and  numero LIKE :v_numero";
    $chambres = null;
    $statement = $bdd->prepare($query);

    $chambre = $chambre . '%';
    $statement->bindParam(':v_numero', $chambre);

    if ($statement->execute()) {
        $chambres = $statement->fetchAll(PDO::FETCH_ASSOC);

        $statement->closeCursor();
    }
    return $chambres;
}
