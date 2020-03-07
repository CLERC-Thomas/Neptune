<?php

/**
* Récupére le chemin dans lequel se trouve le site
*/
function getPath(){
	//  'SCRIPT_FILENAME' => string 'D:/wamp64/www/projet_b1/index.php' (length=33)
	$path = pathinfo($_SERVER['SCRIPT_FILENAME']);
	//  'dirname' => string 'D:/wamp64/www/projet_b1' (length=23)
	return $path['dirname'];
}

function includeHtml($filename){
	$file = getPath().'/html/'.$filename.'.html';
	return includePage($file);
}

function includePhp($filename){
	$file = getPath().'/php/'.$filename.'.php';
	return includePage($file);
}

function includePage($file){
	if(is_file($file)){
		include($file);
		return true;	
	}
	return false;
}

function getVar($name){
	return retrieveVar($name, $_GET);
}

function postVar($name){
	return retrieveVar($name, $_POST);
}

function sessionVar($name) {
	if (session_status() !== PHP_SESSION_ACTIVE) {
		session_start();
	}
	return retrieveVar($name, $_SESSION);
}

function retrieveVar($name, $tab){
	if(isset($tab[$name])){
		// Elle existe
		if(!empty($tab[$name])){
			// Elle est set
			return $tab[$name];
		}
		// Elle est pas set
		return true;
	}
	return false;
}

function getPage(){
	global $VAR_PAGE;
	$page = getVar($VAR_PAGE);
	if(is_bool($page)){
		global $DEFAULT_PAGE;
		$page = $DEFAULT_PAGE;
	}
	return $page;
}

function setPage($page){
	global $VAR_PAGE;
	$_GET[$VAR_PAGE] = $page;
}

function getAction(){
	global $VAR_ACTION;
	return getVar($VAR_ACTION);
}

function isLogged(){
	global $VAR_LOGGED;
	return sessionVar($VAR_LOGGED);
}

function estceque_valeur_dans_tableau($valeur, $tableau){
	for ($i=0; $i < count($tableau); $i++) { 
		if($valeur == $tableau[$i]){
			return true;
		}
	}
	return false;
}

function getConnection(){
	try{
		global $DB_HOST;
		global $DB_NAME;
		global $DB_LOGIN;
		global $DB_PASSWORD;
		return new PDO('mysql:host='.$DB_HOST.';dbname='.$DB_NAME,$DB_LOGIN,$DB_PASSWORD);
	}catch(Exception$e){
		echo"Échec:".$e->getMessage();
	}
	return false;
}