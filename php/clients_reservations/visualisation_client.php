<!DOCTYPE html>
<html lang="fr">
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

    require 'fonctions_clients.php';
    


    session_start();
    if (isset($_SESSION['id_client'])) {
        $id = $_SESSION['id_client'];

    $BDD = getDataBase($login , $pass);
    $visu_client = visualisation_clients($BDD, $id);


        ?>
        <table>
            <thead>
                <tr>
                    <th>Chambre</th>
                    <th>Réservation</th>
                    <th>Payé</th>
                    <th>Client_id</th>
                    <th>Départ</th>
                    <th>Arrivé</th>
                </tr>
            </thead>
        <tbody>
        <?php

        foreach ($visu_client as $visu_c) {
            echo '<tr>'.'<td>'.$visu_c['chambre_id'].'</td>'.
                '<td>'.$visu_c['reservation'].'</td>'.
                '<td>'.$visu_c['paye'].'</td>'.
                '<td>'.$visu_c['client_id'].'</td>'.
                '<td>'.$visu_c['depart'].'</td>'.
                '<td>'.$visu_c['arrive'].'</td>'. 
                '<td>' . '<a href="supprimer_client.php?token=' . $visu_c['token'] . '">Supprimer</a>' . '</td>' .
                '</tr>';
        }
    }
        ?>
        </tbody>
        </table>
    </center>

</body>
</html>