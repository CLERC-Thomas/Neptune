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

function getAllClient(PDO $bdd, $client) {
    $query = "SELECT * FROM clients WHERE nom LIKE :v_client ";
    $clients = null;
    $statement = $bdd->prepare($query);

    $client = $client . '%';
    $statement->bindParam(':v_client', $client);

    if ($statement->execute()) {
        $clients = $statement->fetchAll(PDO::FETCH_ASSOC);

        $statement->closeCursor();
    }
    return $clients;
}
