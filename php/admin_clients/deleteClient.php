<?php
require('fonctionClient.php');

$bdd = getDataBase();

$query = "DELETE FROM clients WHERE id=:v_id";

$statement = $bdd->prepare($query);

$statement->bindParam(':v_id', $_GET['id']);


if ($statement->execute()) {

    header('Location: afficherClient.php');
} else {
    echo "ça ne marche pas";
}

