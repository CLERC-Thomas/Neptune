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
<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <link href="../../../Neptune/css/chambre.css" rel="stylesheet">
</head>
    <title>Liste des Clients</title>
    <?php

    $client = '';
    if (isset($_POST['client'])) {
        $client = htmlspecialchars($_POST['client']);
    }
    echo "<a href='../../index.php'>Retourner à l'accueil</a>";
    require('fonctionClient.php');
    ?>

    <form action="" method="post">
        <label for="client">Le Nom du client commence par :</label>
        <input type="text" name="client" value="<?= $client ?>"/>
        <input type="submit" value="Rechercher" />
    </form>
    <br >
</head>

<body>
<h1>Liste des Clients</h1>

<?php
// Etape 1 : Connexion au serveur
$bdd = getDataBase();

$clients = null;
?>



<?php

if ($bdd) {
    $clients = getAllClient($bdd, $client);

    if ($clients) {
        ?>
        <table>
                <thead>
                <tr>
                    <th>Client</th>
                    <th>Civilité</th>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>Adresse</th>
                    <th>Code Postal</th>
                    <th>Ville</th>
                    <th>Pseudo</th>
                    <th>Mail</th>
                    <th>Mot de passe</th>
                    <th>Pays</th>
                    <th>Admin</th>
                </tr>
                </thead>
            <tbody>
<?php
        foreach ($clients as $client) {
                echo '<tr>'.
                    '<td>'.$client['id'].'</td>'.
                    '<td>'.$client['civilite'].'</td>'.
                    '<td>'.$client['nom'].'</td>'.
                    '<td>'.$client['prenom'].'</td>'.
                    '<td>'.$client['adresse'].'</td>'.
                    '<td>'.$client['codePostal'].' </td>'.
                    '<td>'.$client['ville'].' </td>'.
                    '<td>'.$client['pseudo'].' </td>'.
                    '<td>'.$client['mail'].' </td>'.
                    '<td>'.$client['mot_de_passe'].' </td>'.
                    '<td>'.$client['pays_id'].' </td>'.
                    '<td>'.$client['admin'].' </td>'.
                    '<td><a href="modifierClient.php?id=' . $client['id'] . '"> Modifier </a></td>'.
                    '<td><a href="deleteClient.php?id=' . $client['id'] . '"> Supprimer </a></td>'.
                    '</tr>';
        }

    }
?>
    <tr>
        <th><a href="ajouterClient.php"> Ajouter un Client </a></th>
    </tr>
            </tbody>
            </table>
<?php }
    else {
        ?>
        pas de donnée à afficher
        <?php
    }
?>

</body>
</html>