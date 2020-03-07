<?php
require('../dao_user.php');
require('../helper.php');
require('../config.php');
global $VAR_LOGGED;
getConnection();
$id = sessionVar($VAR_LOGGED);
$clients = getUserById($id);
echo 'Bonjour ' . $clients['nom'] ;
if ($clients['admin'] != 1){
    echo "<br>Vous n'avez pas accès à cette page";
    echo "<a href='../../index.php'>Retourner à l'accueil</a>";
    die();
}
?>
<html>
<link href="../../../Neptune/css/chambre.css" rel="stylesheet">
<body>

<h1>Modifier une Chambre</h1>

<?php
require ('fonctionChambre.php');

if (isset($_GET['numero'])) {
    $numero = $_GET['numero'];

    $bdd = getDataBase();
    $query ="SELECT * FROM chambres WHERE numero=:v_numero";

    $statement = $bdd->prepare($query);

    $statement->bindParam(':v_numero', $numero);

    if ($statement->execute()) {
        $chambre = $statement->fetch(PDO::FETCH_OBJ);
    }
    echo "<a href='../../index.php'><br>
    <button>Retourner à l'accueil</button></a>";
    ?>
    <table>
        <thead>
        <tr>
            <th>Chambre</th>
            <th>Capacité</th>
            <th>Exposition</th>
            <th>Douche</th>
            <th>Etage</th>
            <th>Tarif Id</th>
        </tr>
        </thead>
        <tbody>
        <tr>
    <form action="updateChambre.php" method="post">
        <td><input type="text" name="numero" value="<?= $chambre->numero ?>" /></td>
        <td><input type="text" name="capacite" value="<?= $chambre->capacite ?>" /></td>
        <td><input type="text" name="exposition" value="<?= $chambre->exposition ?>" /></td>
        <td><input type="text" name="douche" value="<?= $chambre->douche ?>" /></td>
        <td><input type="text" name="etage" value="<?= $chambre->etage ?>" /></td>
        <td><input type="text" name="tarif_id" value="<?= $chambre->tarif_id ?>" /></td>
        <td><input type="submit" value="Valider" /></td>
    </form>
        </tr>

        </tbody>
    </table>
    <?php
} else {
    echo "Chambre non trouvée";
}
?>
</body>
</html>
