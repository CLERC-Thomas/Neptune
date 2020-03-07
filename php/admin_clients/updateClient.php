<?php
require('fonctionClient.php');


$query = "UPDATE clients
            SET id=:v_id, civilite=:v_civilite , nom=:v_nom , prenom=:v_prenom , adresse=:v_adresse , codePostal=:v_codePostal , ville=:v_ville , pseudo=:v_pseudo , mot_de_passe=:v_mot_de_passe ,
                mail=:v_mail , pays_id=:v_pays_id , admin=:v_admin 
            WHERE id=:v_id";


$bdd = getDataBase();

$statement = $bdd->prepare($query);

$statement->bindParam(':v_id', $_POST['id']);
$statement->bindParam(':v_civilite', $_POST['civilite']);
$statement->bindParam(':v_nom', $_POST['nom']);
$statement->bindParam(':v_prenom', $_POST['prenom']);
$statement->bindParam(':v_adresse', $_POST['adresse']);
$statement->bindParam(':v_codePostal', $_POST['codePostal']);
$statement->bindParam(':v_ville', $_POST['ville']);
$statement->bindParam(':v_pseudo', $_POST['pseudo']);
$statement->bindParam(':v_mail', $_POST['mail']);
$statement->bindParam(':v_mot_de_passe', $_POST['mot_de_passe']);
$statement->bindParam(':v_pays_id', $_POST['pays_id']);
$statement->bindParam(':v_admin', $_POST['admin']);


if ($statement->execute()) {

    header('Location: afficherClient.php');
}else {
    echo"ça marche pas";
}

