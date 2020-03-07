<?php
function getDataBase($login = "",$pass = ""){
    if(empty($login)){
        GLOBAL $login;
    }
    if(empty($pass)){
        GLOBAL $pass;
    }  
    try {
        $BDD = new PDO('mysql:host=localhost;dbname=hotel;', $login, $pass);
        $BDD->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $e){
        echo 'Echec de la connexion : '. $e->getMessage();
    }
    return $BDD;
}


function visualisation_clients(PDO $BDD, $id){
    $requete = $BDD->prepare ("SELECT chambre_id , reservation , paye , client_id , depart, arrive , token FROM planning WHERE client_id =:v_client
                ORDER BY chambre_id ASC");
    $requete->execute(array('v_client' => $id));
    $resultat = $requete->fetchAll();
    return $resultat;
}


// function getLoggedUser(PDO $BDD){

// 	$sql = 'SELECT clients.id FROM clients  WHERE id = :id';
// 	$db = getDataBase();
// 	if(!$db){
// 		// Fail connecting to db
// 		die();
// 	}
// 	$select = $db->prepare($sql);
// 	$select->execute(array('id'=>$id));
// 	$result = $select->fetchAll();
// 	return $select;
// }

function authenticate($pseudo, $mot_de_passe){
    $sql = 'SELECT `id` FROM `clients` WHERE `pseudo` = :pseudo AND `mot_de_passe` = :mot_de_passe;';
    $db = getDataBase();
    if(!$db){
        // Fail connecting to db
        die();
    }
    $select = $db->prepare($sql);
    $select->execute(array('pseudo'=>$pseudo, 'mot_de_passe'=>$mot_de_passe));
    $result = $select->fetchAll();
    return empty($result) ? false : $result[0]['id'];
}

?>