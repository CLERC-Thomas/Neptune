<?php
includePhp('dao_user');

$login = postVar('login');
$password = postVar('password');
$firstname = postVar('firstname');
$lastname = postVar('lastname');

if(!is_bool($login) && !is_bool($password) && !is_bool($firstname) && !is_bool($lastname)){
	$id=createUser($login, $password, $firstname, $lastname);
	if (session_status() !== PHP_SESSION_ACTIVE) {
		session_start();
	}
	global $VAR_LOGGED;
	$_SESSION[$VAR_LOGGED] = $id;
	header('Location: ?page=logged');
	exit(0);
}
header("Location: ?page=form_register_user&error=2");
exit(0);
