<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Reservation</title>
</head>
<body>
<header>
    <h1><center>Reservation</center></h1>
</header>

<main>
    <h1>Choisisez une chambre</h1>
    <form method="post" action="index.php">
        <label for = "arrive">Date d'arrivée :</label>
        <input type="date" id="arrive" name="arrive"
              value="<?php if (isset($_POST['arrive'])){
                  echo $_POST['arrive'];
              }else{
                  echo date('Y-m-d');
              }
              ?>"
               min="<?php echo date('Y-m-d'); ?>"
               max="<?php $jour=date('y-m-d');
               echo date('Y-m-d', strtotime($jour. ' + 2 years'));
               ?>"required>
        <span class="validity"></span>

        <label for = "depart">Date de départ :</label>
        <input type="date" id="depart" name="depart"
               value="<?php if (isset($_POST['depart'])){
                   echo $_POST['depart'];
               }else{
                   $jour = date('Y-m-d'); echo date('Y-m-d', strtotime($jour. ' + 1 days'));
               }
               ?>"
               min="<?php  $jour = date('Y-m-d');
               echo date('Y-m-d', strtotime($jour. ' + 1 days'));?>"
               max="<?php $jour=date('y-m-d');
                echo date('Y-m-d', strtotime($jour. ' + 2 years'));?>"required>
        <span class="validity"></span>

         <?php
        if (isset($_POST['arrive'])){
        $datetime1 = date_create($_POST['arrive']);
        $datetime2 = date_create($_POST['depart']);
        if ($datetime1<$datetime2){
            $interval = date_diff($datetime1, $datetime2);
        echo $interval->format('Soit: %a nuits');}
        else{
            echo 'Veuillez saisir une date correcte';
        }
        }
        ?>
        <br><br>

        <input type="submit" value="Vérifier les disponibilités ">
        <br>  <br>

</main>
</body>
</html>
