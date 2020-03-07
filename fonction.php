<?php

function getDataBase($login,$pass){
    try {
        $BDD = new PDO('mysql:host=localhost;dbname=hotel;', $login, $pass);
        $BDD->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $e){
        echo 'Echec de la connexion : '. $e->getMessage();
    }
    return $BDD;
}


function Affiche(PDO $BDD){
    if ($_POST!=null and $_POST['arrive']<$_POST['depart']){
        $requete = $BDD->prepare("SELECT numero,capacite,exposition,douche,etage,prix FROM chambres as c,tarifs as t WHERE c.tarif_id=t.id and c.numero NOT IN (
                                            SELECT numero FROM `chambres` as c, planning as p 
                                            WHERE c.numero = p.chambre_id 
                                            AND (p.arrive BETWEEN :arrive AND :depart OR p.depart BETWEEN :arrive AND :depart) 
                                            GROUP BY c.numero)");
        $requete->execute(array("arrive"=>$_POST['arrive'],
            "depart"=>$_POST['depart']));
        $resultat = $requete->fetchAll();
        return $resultat;
    }else{
        echo 'Veuillez choisir une date';
    }
}

function Chambre(PDO $BDD,$id){
    $requete = $BDD->prepare("SELECT numero,capacite,exposition,douche,etage,prix 
                                        FROM chambres as c,tarifs as t 
                                        WHERE c.tarif_id=t.id and numero=:id ");
    $requete->execute(array("id"=>$id));
    $resultat = $requete->fetchAll();
    return $resultat;
}

function generateToken(){
    return md5(uniqid(rand(), true));
}

function Paiment(PDO $BDD,$id_chambre,$id_client,$depart,$arrive){
    $requete = $BDD->prepare("INSERT INTO planning VALUES (:chambre_id, 0, -1, :client_id, :depart, :arrive, :token, facture) ");
    $requete->execute(array("chambre_id"=>securisation($id_chambre),
        "client_id"=>$id_client,
        "depart"=>securisation($depart),
        "arrive"=>securisation($arrive),
        "token"=>generateToken()));
}

function VerificationPaiment(PDO $BDD,$id_chambre,$id_client,$depart,$arrive){
    $requete = $BDD->prepare("SELECT reservation, paye FROM `planning` WHERE `chambre_id`=:chambre_id AND client_id=:client_id AND `depart` =:depart AND `arrive` = :arrive ");
    $requete->execute(array("chambre_id"=>securisation($id_chambre),
        "client_id"=>$id_client,
        "depart"=>securisation($depart),
        "arrive"=>securisation($arrive)));
    $resultat = $requete->fetchAll();
    return $resultat;
}

function Reservation(PDO $BDD,$id_chambre,$id_client,$depart,$arrive){
    $requete = $BDD->prepare("UPDATE planning SET reservation=-1 
                                        WHERE chambre_id=:chambre_id and paye=-1 and client_id=:client_id and depart=:depart and arrive=:arrive");
    $requete->execute(array("chambre_id"=>securisation($id_chambre),
        "client_id"=>$id_client,
        "depart"=>securisation($depart),
        "arrive"=>securisation($arrive)));
}


function Verification(PDO $BDD,$id_chambre,$arrive,$depart){
    $requete = $BDD->prepare("SELECT chambre_id  FROM `planning` 
                                        WHERE chambre_id=:chambre_id 
                                        AND depart=:depart and arrive=:arrive");
    $requete->execute(array("chambre_id"=>$id_chambre,
        "depart"=>$depart,
        "arrive"=>$arrive,
    ));
    $resultat = $requete->fetchAll();
    return $resultat;
}

function securisation($donnees){
    $donnees = trim($donnees);
    $donnees = stripslashes($donnees);
    $donnees = strip_tags($donnees);
    return $donnees;
}

function Base64(PDO $BDD,$base64,$id_chambre,$id_client,$depart,$arrive){
    $requete = $BDD->prepare("UPDATE planning SET facture=:base64 
                                        WHERE chambre_id=:chambre_id  and client_id=:client_id and depart=:depart and arrive=:arrive");
    $requete->execute(array("base64"=>$base64,
        "chambre_id"=>securisation($id_chambre),
        "client_id"=>$id_client,
        "depart"=>securisation($depart),
        "arrive"=>securisation($arrive)));

}


function Decode(PDO $BDD,$txt,$id_chambre,$id_client,$depart,$arrive){
    $requete = $BDD->prepare("SELECT base64 FROM factures WHERE base64=:txt AND token=:token");
    $requete->execute(array("txt"=>$txt,
        "chambre_id"=>securisation($id_chambre),
        "client_id"=>$id_client,
        "depart"=>securisation($depart),
        "arrive"=>securisation($arrive)));
    $resultat = $requete->fetchAll();
    return $resultat;
}
