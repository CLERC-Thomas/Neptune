<!DOCTYPE html>
<html lang=fr dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="Language" content="fr">
    <title>Hôtel Neptune</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="stickyMain">
    <div class="sticky">
        <div class="menu">
            <nav>
                <ul>
                    <li class="navi"><a class="boutton" href="?page=welcome">Accueil</a></li>
                    <li class="navi"><a href="../Neptune/Reservation/index.php">Reservation</a></li>
                    <li class="navi"><a href="html/chambre/index.html">Chambres</a></li>
                    <li class="navi"><a href="../Neptune/php/profil.php">Profil</a></li>

                    <?php
                    includePhp('dao_user');
                    if(isLogged()){
                    // Connected
                        global $VAR_LOGGED;
                        $id = sessionVar($VAR_LOGGED);
                        $clients = getUserById($id);
                        if ($clients['admin'] == 1){
                            echo '<li class="navi"><a href="php/admin_reservations/visualisation_admin.php">Reservations Admin</a></li>';
                            echo '<li class="navi"><a href="php/admin_chambres/afficherChambre.php">Chambres Admin</a></li>';
                            echo '<li class="navi"><a href="php/admin_clients/afficherClient.php">Clients Admin</a></li>';
                        }
                    echo '<li class="navi"><a href="?action=logout">Déconnexion</a></li>';

                    echo 'Bonjour ' . $clients['nom'];

                    }else if(getPage() != 'form_login'){
                    // Pas connected
                    echo '<li class="navi"><a href="?page=form_login">Connexion</a></li>';
                    echo '<li class="navi"><a href="../Neptune/html/form_inscription.html">Inscription</a></li>';
                    }
                    ?>
                </ul>
            </nav>
        </div>
    </div>
</div>
