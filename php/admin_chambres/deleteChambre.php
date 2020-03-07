<?php
require('fonctionChambre.php');

$bdd = getDataBase();

$query = "DELETE FROM chambres WHERE numero=:v_numero";

$statement = $bdd->prepare($query);

$statement->bindParam(':v_numero', $_GET['numero']);


if ($statement->execute()) {

    header('Location: afficherChambre.php');
} else {
    echo "ça marche pas";
}

