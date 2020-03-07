<?php
$serveur = "localhost";
$login = "root";
$pass = "";
require 'fonction_reservation.php';


$requete = "DELETE FROM planning 
            WHERE planning.token =:t_id ";

$BDD = getDataBase($login , $pass);
$statement = $BDD->prepare($requete);
$statement->bindParam(':t_id', $_POST['token']);
if ($statement->execute()) {
    header('Location: visualisation_admin.php');
} else {
    echo "Raté !";
}
?>




