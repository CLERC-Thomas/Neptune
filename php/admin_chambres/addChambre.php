<?php
require('fonctionChambre.php');

$bdd = getDataBase();

$query = "INSERT INTO chambres (numero, capacite, exposition, douche, etage, tarif_id) 
		  VALUES (:v_numero , :v_capacite, :v_exposition , :v_douche , :v_etage , :v_tarif_id)";

$statement = $bdd->prepare($query);

$numero = $_POST['numero'];
$capacite = $_POST['capacite'];
$exposition = $_POST['exposition'];
$douche = $_POST['douche'];
$etage = $_POST['etage'];
$tarif_id = $_POST['tarif_id'];


if ($statement->execute(array(
    ':v_numero' => $numero, ':v_capacite' => $capacite, 'v_exposition' => $exposition, ':v_douche' => $douche, ':v_etage' => $etage , ':v_tarif_id' => $tarif_id ))) {

    header('Location: afficherChambre.php');
} else {
    echo "ça marche pas";
}
