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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../css/chambre.css" rel="stylesheet">
    <title>visualisation</title>
</head>
<body>
    <h1><center>Planning des réservations</center> </h1>
    <br>
    <center>
    <?php
    $serveur = "localhost";
    $login = "root";
    $pass = "";

    require 'fonction_reservation.php';
    
    $BDD = getDataBase($login , $pass);
    $visu_a = visualisation_admin ($BDD);
 
    // $suppr_t=supprimer_table($BDD);

    if ($visu_a) {
        ?>
        <table>
            <thead>
                <tr>
                    <th>Chambre</th>
                    <th>Réservation</th>
                    <th>Payé</th>
                    <th>Client_id</th>
                    <th>Arrivé</th>
                    <th>Départ</th>
                </tr>
            </thead>
        <tbody>
        <?php
        }
        foreach ($visu_a as $visu_a) {

            echo '<tr>'.'<td>'.$visu_a['chambre_id'].'</td>'.
                '<td>'.$visu_a['reservation'].'</td>'.
                '<td>'.$visu_a['paye'].'</td>'.
                '<td>'.$visu_a['client_id'].'</td>'.
                '<td>'.$visu_a['arrive'].'</td>'.
                '<td>'.$visu_a['depart'].'</td>'.'<td>';
            ?>    <form action="facture.php" method="POST">
                <input type="HIDDEN" name="facture" value=<?=$visu_a['facture']?>>
                <input type="submit" value="Facture">
            </form>
            <?php
            echo         '</td>' .'<td>'. '<a href="supprimer.php?token=' . $visu_a['token'] . '">Supprimer</a>' . '</td>' .

                '</tr>';

        }
        ?>
        </tbody>
        </table>
    </center>
    





</body>
</html>