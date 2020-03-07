<html>
<link rel="stylesheet" href="../css/profil.css">
<meta charset="utf-8">
<head>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</head>
</html>
<?php
if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
$bdd = new PDO('mysql:host=127.0.0.1;dbname=hotel', 'root', '');

if(!empty($_SESSION['id_client'])){
    $getid = intval($_SESSION['id_client']);
    $requser = $bdd->prepare('SELECT * FROM clients WHERE id = ?');
    $requser->execute(array($getid));
    $userinfo = $requser->fetch();
    ?>
    <html lang="fr" dir="ltr">



    <head>
        <title>TEST</title>
        <meta charset="utf-8">
    </head>
    <body>
    <div align="center">
        <h2>Profil de <?php echo $userinfo['pseudo']; ?></h2>
        <br /><br />
        <?php
        if(!empty($userinfo['avatar'])){
            ?>
            <img src="membres/avatars/<?php echo $userinfo['avatar']; ?>"
            <?php
        }
        ?>

        <div class="profile-usermenu">
            <ul class="nav">
                <li class="active">
                    <a href="#">
                        <i class="glyphicon glyphicon-home"></i>
                        <?php echo $userinfo['pseudo']; ?> </a>
                </li>
                <li>
                    <a href="#">
                        <i class="glyphicon glyphicon-user"></i>
                        <?php echo $userinfo['mail']; ?> </a>
                </li>
                <li>
                    <a href="#" target="_blank">
                        <i class="glyphicon glyphicon-user"></i>
                        <?php echo $userinfo['nom']; ?> </a>
                </li>
                <li>
                    <a href="#">
                        <i class="glyphicon glyphicon-user"></i>
                        <?php echo $userinfo['prenom']; ?> </a>
                </li>
                <li>
                    <a href="#">
                        <i class="glyphicon glyphicon-home"></i>
                        <?php echo $userinfo['adresse']; ?> </a>
                </li>
                <li>
                    <a href="#">
                        <i class="glyphicon glyphicon-flag"></i>
                        <?php echo $userinfo['codePostal']; ?> </a>
                </li>
                <li>
                    <a href="#">
                        <i class="glyphicon glyphicon-home"></i>
                        <?php echo $userinfo['ville']; ?></a>
                </li>
            </ul>
        </div>

        <?php
        if(isset($_SESSION['id_client']) AND $userinfo['id'] == $_SESSION['id_client']) {
            ?>
            <br />
            <div class="profile-userbuttons">
                <a href="clients_reservations/visualisation_client.php"><button class="btn btn-success btn-sm" >Reservation</button></a>
                <br> <br>
                <a href="editionprofil.php"><button class="btn btn-success btn-sm" >Editer mon profil</button></a>
                <br> <br>
                <a href="deconnexion.php"><button class="btn btn-danger btn-sm">Se déconnecter</button></a>
                <br> <br>
                <a href='../index.php'><button class="btn btn-success btn-sm">Retournez à l'accueil</button></a><br>
                <br>
                <a href='supprimer.php'><button class="btn btn-danger btn-sm">Supprimer son compte</button></a>
            </div>

            <?php
        }
        ?>
    </div>
    <br>
    <br>
    </body>
    <footer>
        <center>
            <strong>Powered by <a href="" target="_blank">L'hotel Neptune</a></strong>
        </center>
    </footer>
    </html>
    <?php
}else {
    echo 'Vous n\'êtes pas connecté';
    echo '<li class="btn btn-success btn-sm"><a href="../index.php">Retourner à l\'accueil</a></li>';
}


?>