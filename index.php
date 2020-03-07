<?php

include 'php/config.php';
include 'php/helper.php';

// On effectue une action
$action = getAction();
// eg. D:/wamp64/www/projet_b1/php/ctl_register_user.php
if(!is_bool($action) && includePhp('ctl_'.$action)){
	exit(0);
}

$page = getPage();
global $LOGGED_PAGES;
//if(!isLogged() && estceque_valeur_dans_tableau($page, $LOGGED_PAGES)){
if(!isLogged() && in_array($page, $LOGGED_PAGES)){
	// Pas logged and trying to access the interdite page
	setPage('form_login');
}
global $DEFAULT_PAGE;
includePhp($DEFAULT_PAGE);
