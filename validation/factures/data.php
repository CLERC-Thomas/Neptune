<?php

//require 'Programmes\Wamp\www\Neptune\validation/fonction.php';
$login='root';
$pass='';
$BDD=getDataBase($login,$pass);
$chambre=Chambre($BDD,$_SESSION['id_chambre']);
foreach ($chambre as $chambr){
    if ($chambr['douche']==0){
        $chambre[0]['douche']='oui';
    }else{
        $chambre[0]['douche']='non';
    }
}

$client = array(
"id" => 1,
"firstname" => $_SESSION['prenom'],
"lastname" => $_SESSION['nom'],
"mail" =>$_SESSION['mail'],
"address" => $_SESSION['addresse'],
"cp"=>$_SESSION['CP'],
"ville"=>$_SESSION['ville']
);


$project = array(
"name" => "",
);


$chambre= array(
    "description1" => "Chambre :".$chambre[0]["numero"],
    "description2"=>"Capacité:".$chambre[0]["capacite"]." | Exposition: ".$chambre[0]["exposition"],
    "description3"=>"Douche: ".$chambre[0]["douche"]." | Etage: ".$chambre[0]['etage'],
    "arrive"=>$_SESSION['date_arrive'],
    "depart"=>$_SESSION['date_depart'],
    "price" =>$chambre[0]['prix']);


