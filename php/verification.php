<?php

$bdd = new PDO('mysql:host=localhost;dbname=hotel;charset=utf8','root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

if(isset($_POST['forminscription'])) 
{

    $login = htmlspecialchars($_POST['pseudo']);
    $mail = htmlspecialchars($_POST['mail']);
    $mail2 = htmlspecialchars($_POST['mail2']);
    $password = sha1($_POST['password']);
    $password2 = sha1($_POST['password2']);
    $civilite = htmlspecialchars($_POST['civilite']);
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $adresse = htmlspecialchars($_POST['adresse']);
    $codePostal = htmlspecialchars($_POST['codePostal']);
    $ville = htmlspecialchars($_POST['ville']);
    $admin = 0;
    $avatar = 0;

    if(!empty($_POST['pseudo']) AND !empty($_POST['mail']) AND !empty($_POST['mail2']) AND !empty($_POST['password']) 
        AND !empty($_POST['password2']) AND !empty($_POST['civilite']) AND !empty($_POST['nom']) AND !empty($_POST['prenom']) 
        AND !empty($_POST['adresse']) AND !empty($_POST['codePostal']) AND !empty($_POST['ville'])) 
    {  
       $loginlength = strlen($login);
       if($loginlength <= 255) 
       {
          if($mail == $mail2)  // vérification des deux mail entré par l'utilisateur
          {
             if(filter_var($mail, FILTER_VALIDATE_EMAIL)) 
             {
                $reqmail = $bdd->prepare("SELECT * FROM clients WHERE mail = ?");
                $reqmail->execute(array($mail));
                $mailexist = $reqmail->rowCount(); //compter combien dinfo il y a avec ce mail
      
                if($mailexist == 0) 
                {
                   if($password == $password2) // vérification des deux password entré par l'utilisateur
                   {
                    $insertmbr = $bdd->prepare("INSERT INTO clients (civilite, pseudo, nom, prenom, mail, adresse, codePostal, ville, mot_de_passe, admin, avatar) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"); // jai edit les simple cote
                    $insertmbr->execute(array($civilite, $login, $nom, $prenom, $mail, $adresse , $codePostal, $ville, $password, $admin, $avatar));
                    $erreur = "Votre compte a bien été créé !" ;
                    echo "<a href='../index.php'><br><button>Retournez à l'accueil</button></a>";
                      echo"$erreur";
                   } else {
                      $erreur = "Vos mots de passes ne correspondent pas !";
                      echo"$erreur";
                    
                   }
                } else {
                   $erreur = "Adresse mail déjà utilisée !";
                   echo"$erreur";
                }
             } else {
                $erreur = "Votre adresse mail n'est pas valide !";
                echo"$erreur";
             }
          } else {
             $erreur = "Vos adresses mail ne correspondent pas !";
             echo"$erreur";
          }
       } else {
          $erreur = "Votre pseudo ne doit pas dépasser 255 caractères !";
          echo"$erreur";
       }
    } else {
       $erreur = "Tous les champs doivent être complétés !";
       echo"$erreur";
    }

}