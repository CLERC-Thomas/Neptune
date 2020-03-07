<?php
$serveur = "localhost";
$login = "root";
$pass = "";
require ('fonctions_clients.php');

$requete = "DELETE FROM planning 
            WHERE planning.token =:t_id ";

$BDD = getDataBase($login , $pass);
$statement = $BDD->prepare($requete);
$statement->bindParam(':t_id', $_POST['token']);
if ($statement->execute()) {
    header('Location: visualisation_client.php');
} else {
    echo "Raté !";
}
?>




