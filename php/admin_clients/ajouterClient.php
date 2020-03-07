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
<link href="../../css/chambre.css" rel="stylesheet">
<body>
<a href='../../index.php'>Retourner à l'accueil</a>
<h1>Ajouter une Client</h1>



<form action="addClient.php" method="post">
    <div>
    <input type="text" name="id" placeholder="id" /></div>
    <div>
    <input type="text" name="civilite" placeholder="civilite" /></div>
    <div>
    <input type="text" name="nom" placeholder="nom" /></div>
    <div>
    <input type="text" name="prenom" placeholder="prenom" /></div>
    <div>
    <div>
    <input type="text" name="adresse" placeholder="adresse" /></div>
    <div>
    <input type="text" name="codePostal" placeholder="codePostal" /></div>
        <div>
    <input type="text" name="ville" placeholder="ville" /></div>
        <div>
    <input type="text" name="pseudo" placeholder="pseudo" /></div>
        <div>
    <input type="text" name="mail" placeholder="mail" /></div>
        <div>
    <input type="text" name="mot_de_passe" placeholder="mot_de_passe" /></div>
        <div>
    <input type="text" name="pays_id" placeholder="pays_id" /></div>
        <div>
    <input type="text" name="admin" placeholder="admin" /></div>
        <div>
    <input type="submit" value="Valider" />
</form>

</body>
</html>
