<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/tableau.css"><link>

</head>
<body>
<table>
    <?php

    require '../fonction.php';
    $BDD=getDataBase($login,$pass);
    $chambres=Affiche($BDD);



    if($_POST!=null and $_POST['arrive']<$_POST['depart']){
    if(empty($chambres)){
        echo "Il n'y aucune chambre disponible";
    }else{
        $_SESSION['date_arrive']=$_POST['arrive'];
        $_SESSION['date_depart']=$_POST['depart'];

        echo '<tr>
        <th>Chambre</th>    
        <th>Capacité</th>
        <th>Exposition</th>
        <th>Douche</th>
        <th>Etage</th>
        <th>Tarifs</th>
    </tr>';
    foreach ($chambres as $chambre){
        if ($chambre['douche']==0){
            $chambre['douche']='oui';
        }else{
            $chambre['douche']='non';
        }
        echo '<tr>'.'<td>'.$chambre['numero'].'</td>'.
            '<td>'.$chambre['capacite'].'</td>'.
            '<td>'.$chambre['exposition'].'</td>'.
            '<td>'.$chambre['douche'].'</td>'.
            '<td>'.$chambre['etage'].'</td>'.
            '<td>'.$chambre['prix'].' € '.'</td>'.'<td>';
            ?>    <form action="../paiment/carte.php" method="POST">
            <input type="HIDDEN" name="numero" value=<?=$chambre['numero']?>>

            <input type="submit" value="Reservez">
        </form>
<?php
        echo  '</td>'.'</tr>';
    }
    }
}
    ?>

</table>
</body>
</html>