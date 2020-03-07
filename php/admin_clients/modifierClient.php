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
    echo "<a href='../../index.php'><br>
    <button>Retournez à l'accueil</button></a>";
    die();
}
?>
<html>
<link href="../../../Neptune/css/chambre.css" rel="stylesheet">
<body>

<h1>Modifier une Client</h1>

<?php
require ('fonctionClient.php');
echo "<a href='../../index.php'>Retourner à l'accueil</a>";
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $bdd = getDataBase();

    $query ="SELECT * FROM clients WHERE id=:v_id";

    $statement = $bdd->prepare($query);

    $statement->bindParam(':v_id', $id);
    if ($statement->execute()) {
        $client = $statement->fetch(PDO::FETCH_OBJ);
    }
    ?>
    <form action="updateClient.php" method="post">
    <table>
        <tr>
            <th>Client</th>
            <td><input type="text" name="id" value="<?= $client->id ?>" /></td>
        </tr>
        <tr>
            <th>Civilité</th>
            <td><input type="text" name="civilite" value="<?= $client->civilite ?>" /></td>
        </tr>
        <tr>
            <th>Nom</th>
            <td><input type="text" name="nom" value="<?= $client->nom ?>" /></td>
        </tr>
        <tr>
            <th>Prenom</th>
            <td><input type="text" name="prenom" value="<?= $client->prenom ?>" /></td>
        </tr>
        <tr>
            <th>Adresse</th>
            <td><input type="text" name="adresse" value="<?= $client->adresse ?>" /></td>
        </tr>
        <tr>
            <th>Code Postal</th>
            <td><input type="text" name="codePostal" value="<?= $client->codePostal ?>" /></td>
        </tr>
        <tr>
            <th>Ville</th>
            <td><input type="text" name="ville" value="<?= $client->ville ?>" /></td>
        </tr>
        <tr>
            <th>Pseudo</th>
            <td><input type="text" name="pseudo" value="<?= $client->pseudo ?>" /></td>
        </tr>
        <tr>
            <th>Mail</th>
            <td><input type="text" name="mail" value="<?= $client->mail ?>" /></td>
        </tr>
        <tr>
            <th>Mot de passe</th>
            <td><input type="text" name="mot_de_passe" value="<?= $client->mot_de_passe ?>" /></td>
        </tr>
        <tr>
            <th>Pays</th>
            <td><input type="text" name="pays_id" value="<?= $client->pays_id ?>" /></td>
        </tr>
        <tr>
            <th>Admin</th>
            <td><input type="text" name="admin" value="<?= $client->admin ?>" /></td>
        </tr>
        <tbody>
            <td><input type="submit" value="Valider" /></td>
    </form>

        </tbody>
    </table>
    <?php
} else {
    echo "Client non trouvée";
}
?>
</body>
</html>
