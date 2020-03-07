<?php

includePhp('dao_user');

$pseudo = postVar('pseudo');
$mot_de_passe = sha1(postVar('mot_de_passe'));

if(!is_bool($pseudo) && !is_bool($mot_de_passe)){
	$id = authenticate($pseudo, $mot_de_passe);
	if($id != false){
		if (session_status() !== PHP_SESSION_ACTIVE) {
			session_start();
		}
		global $VAR_LOGGED;
		$_SESSION[$VAR_LOGGED] = $id;
		$_SESSION['id_client'] = $id;
		header('Location: ?page=welcome');
		exit(0);
	}
}
// FAILURE !
header('Location: ?page=form_login&error=1');
exit(0);