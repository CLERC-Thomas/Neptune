<?php

function getUserById($id){
	$sql = 'SELECT `nom`, `prenom`, admin FROM `clients`  WHERE `id` = :id';
	$db = getConnection();
	if(!$db){
		// Fail connecting to db
		die();
	}
	$select = $db->prepare($sql);
	$select->execute(array('id'=>$id));
	$result = $select->fetchAll();
	return empty($result) ? false : array('nom' => $result[0]['nom'], 'prenom' => $result[0]['prenom'], 'admin' => $result[0]['admin']);
}

function getAdmin($admin){
    $db = getConnection();
    if(!$db){
        // Fail connecting to db
        die();
    }

    $ad = $db->query('SELECT admin FROM clients where admin = 1');
    $admin = $ad->fetch();
    $select = $db->prepare($ad);
    $select->execute(array('admin'=>$admin));
    $result = 'admin';
    return $result;

}

function updateUser(){

}

function deleteUser(){

}

function authenticate($pseudo, $mot_de_passe){
	$sql = 'SELECT `id` FROM `clients` WHERE `pseudo` = :pseudo AND `mot_de_passe` = :mot_de_passe;';
	$db = getConnection();
	if(!$db){
		// Fail connecting to db
		die();
	}
	$select = $db->prepare($sql);
	$select->execute(array('pseudo'=>$pseudo, 'mot_de_passe'=>$mot_de_passe));
	$result = $select->fetchAll();
	return empty($result) ? false : $result[0]['id'];
}

function infoUser($id){
    $sql = 'SELECT * FROM `clients`  WHERE `id` = :id';
    $db = getConnection();
    if(!$db){
        // Fail connecting to db
        die();
    }
    $select = $db->prepare($sql);
    $select->execute(array('id'=>$id));
    $result = $select->fetchAll();
    return $result;
}