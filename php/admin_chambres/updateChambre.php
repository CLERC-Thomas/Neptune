<?php
require('fonctionChambre.php');


$query = "UPDATE chambres
            SET capacite=:v_capacite, numero=:v_numero , exposition=:v_exposition , douche=:v_douche , etage=:v_etage , tarif_id=:v_tarif_id
            WHERE numero=:v_numero";


$bdd = getDataBase();

$statement = $bdd->prepare($query);

$statement->bindParam(':v_capacite', $_POST['capacite']);
$statement->bindParam(':v_numero', $_POST['numero']);
$statement->bindParam(':v_exposition', $_POST['exposition']);
$statement->bindParam(':v_douche', $_POST['douche']);
$statement->bindParam(':v_etage', $_POST['etage']);
$statement->bindParam(':v_tarif_id', $_POST['tarif_id']);


if ($statement->execute()) {

    header('Location: afficherChambre.php');
}else {
    echo"ça marche pas";
}

