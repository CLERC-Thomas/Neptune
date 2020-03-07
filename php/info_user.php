<?php


if(!empty($_SESSION["id_client"])){
    $info=infoUser($_SESSION["id_client"]);
    $_SESSION['id_client']=$info['0']['id'];
    $_SESSION['prenom']=$info['0']['prenom'];
    $_SESSION['nom']=$info['0']['nom'];
    $_SESSION['mail']=$info['0']['mail'];
    $_SESSION['addresse']=$info['0']['adresse'];
    $_SESSION['CP']=$info['0']['codePostal'];
    $_SESSION['ville']=$info['0']['ville'];

}

