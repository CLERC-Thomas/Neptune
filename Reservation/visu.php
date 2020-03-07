<?php
require '../fonction.php';
$login='root';
$pass='';
$BDD=getDataBase($login,$pass);
$pasdispo=visualisation_admin($BDD);
var_dump($pasdispo);