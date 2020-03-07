<?php
require('fonctionClient.php');

$bdd = getDataBase();

$query = "INSERT INTO clients (id, civilite, nom, prenom, adresse , codePostal , ville , pseudo , mot_de_passe , mail , pays_id , admin) 
		  VALUES (:v_id, :v_civilite , :v_nom , :v_prenom , :v_adresse , :v_codePostal , :v_ville , :v_pseudo , :v_mot_de_passe ,
                :v_mail , :v_pays_id , :v_admin )";

$statement = $bdd->prepare($query);

$id = $_POST['id'];
$civilite = $_POST['civilite'];
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$adresse = $_POST['adresse'];
$codePostal = $_POST['codePostal'];
$ville = $_POST['ville'];
$pseudo = $_POST['pseudo'];
$mot_de_passe = $_POST['mot_de_passe'];
$mail = $_POST['mail'];
$pays_id = $_POST['pays_id'];
$admin = $_POST['admin'];


if ($statement->execute(array(
    ':v_id' => $id, ':v_civilite' => $civilite , ':v_nom' => $nom , ':v_prenom' => $prenom , ':v_adresse' => $adresse , ':v_codePostal' => $codePostal ,
    ':v_ville' => $ville , ':v_pseudo' => $pseudo, ':v_mot_de_passe' => $mot_de_passe , ':v_mail' => $mail , ':v_pays_id' => $pays_id , ':v_admin' => $admin ))) {

    header('Location: afficherClient.php');
} else {
    echo "ça ne marche pas";
}
