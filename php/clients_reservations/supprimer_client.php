<html>
<body>

<h1><center>Êtes-vous sûr de vouloir supprimer cette réservation?</center></h1>
<br>
<center>
<?php
$serveur = "localhost";
$login = "root";
$pass = "";
require ('fonctions_clients.php');

$planning = null;
if (isset($_GET['token'])) {
    $token = $_GET['token'];
    $BDD = getDataBase($login , $pass);
    $requete = "SELECT chambre_id , reservation , paye , client_id , depart , arrive , token  FROM planning WHERE token=:t_id ";
    $statement = $BDD->prepare($requete);
    $statement->bindParam(':t_id', $token);
    if ($statement->execute()) {
        $planning = $statement->fetch(PDO::FETCH_OBJ);
    }
}

if ($planning == null)  {
    echo "planning non trouvé";

} 
else {

?>

<form action="delete_client.php" method="post">
<label for="chambre_id">chambre_id :</label>
    <input type="text" name="chambre_id" disabled value="<?= $planning->chambre_id ?>"/><br />
    <label for="reservation">Réservation :</label>
    <input type="text" name="reservation" disabled value="<?= $planning->reservation ?>"/><br />
    <label for="paye">Etat :</label>
    <input type="text" name="paye" disabled value="<?= $planning->paye ?>"/><br />
    <label for="depart">Départ :</label>
    <input type="text" name="depart" disabled value="<?= $planning->depart ?>"/><br />
    <label for="arrive">Arrivé :</label>
    <input type="text" name="arrive" disabled value="<?= $planning->arrive ?>"/><br />
   
    <input type="hidden" name="token" value="<?= $planning->token ?>"/>
    <input type="submit" value="Supprimer"/>
</form>

<?php
}
?>
</center>