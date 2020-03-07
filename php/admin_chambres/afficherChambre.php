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
    <button>Retourner à l'accueil</button></a>";
    die();
}
?>

<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <link href="../../../Neptune/css/chambre.css" rel="stylesheet">
</head>
    <title>Liste des Chambres</title>
    <?php

    $chambre = '';
    if (isset($_POST['chambre'])) {
        $chambre = htmlspecialchars($_POST['chambre']);
    }

    echo "<a href='../../index.php'>Retourner à l'accueil</a>";
    require('fonctionChambre.php');
    ?>

    <form action="" method="post">
        <label for="chambre">Le numéro de chambre commence par :</label>
        <input type="text" name="chambre" value="<?= $chambre ?>"/>
        <input type="submit" value="Rechercher" />
    </form>
    <br >

</head>

<body>
<h1>Liste des Chambres</h1>

<?php
// Etape 1 : Connexion au serveur
$bdd = getDataBase();

$chambres = null;
?>



<?php

if ($bdd) {
    $chambres = getAllchambre($bdd, $chambre);

    if ($chambres) {
        ?>
        <table>
            <thead>
            <tr>
                <th>Chambre</th>
                <th>Capacité</th>
                <th>Exposition</th>
                <th>Douche</th>
                <th>Etage</th>
                <th>Tarifs</th>
            </tr>
            </thead>
            <tbody>
<?php
        foreach ($chambres as $chambre) {
                echo '<tr>'.
                    '<td>'.$chambre['numero'].'</td>'.
                    '<td>'.$chambre['capacite'].'</td>'.
                    '<td>'.$chambre['exposition'].'</td>'.
                    '<td>'.$chambre['douche'].'</td>'.
                    '<td>'.$chambre['etage'].'</td>'.
                    '<td>'.$chambre['prix'].' </td>'.
                    '<td><a href="modifierChambre.php?numero=' . $chambre['numero'] . '"> Modifier </a></td>'.
                    '<td><a href="deleteChambre.php?numero=' . $chambre['numero'] . '"> Supprimer </a></td>'.
                    '</tr>';
        }

    }
?>
    <tr>
    <th><a href="ajouterChambre.php"> Ajouter une chambre </a></th>
    </tr>
            </tbody>
            </table>
<?php }
    else {
        echo "pas de donnée à afficher";
    }


?>

</body>
</html>