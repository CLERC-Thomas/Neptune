<?php
session_start();
   $bdd = new PDO('mysql:host=localhost;dbname=hotel;charset=utf8','root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
   $bdd->prepare("DELETE FROM clients WHERE id = ?")->execute( array($_SESSION['id_client']) );
    $_SESSION = array();
    session_destroy();
   $redirect_url = "/";

   header("Location: /Neptune/?page=welcome");
   exit;