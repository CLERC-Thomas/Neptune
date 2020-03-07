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
<a href='../../index.php'><br>
    <button>Retourner à l'accueil</button></a>

<h1>Ajouter une Chambre</h1>


    <form action="addChambre.php" method="post">
        <label for="num">Chambre :</label>
        <input type="text" name="numero" placeholder="numero" />
        <input type="text" name="capacite" placeholder="capacite" />
        <input type="text" name="exposition" placeholder="exposition" />
        <input type="text" name="douche" placeholder="douche" />
        <input type="text" name="etage" placeholder="etage" />
        <input type="text" name="tarif_id" placeholder="tarif" />
        <input type="submit" value="Valider" />
    </form>

</body>
</html>
