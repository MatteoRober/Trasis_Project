<?php
session_start();

if (isset($_SESSION['uid'])){
    //TODO: if connected return to main page
}
session_destroy();
require('../inc/db_functions.inc.php');
use DB\DBLink;
use Trasis\User;
use Trasis\UserManagement;



$message = "";
$bdd = DBLink::connect2db(MYDB, $message);
$user= new User();
$um = new UserManagement();
// déclaration des données
$email = isset($_POST['courriel']) ? $_POST['courriel'] : null;
$mdp = isset($_POST['mdp']) ? $_POST['mdp'] : null;

$msg = 'error: ';

// vérifie si l'adresse mail existe


if ($email != null && $mdp!=null && $um->existsInDB($email,$msg)) {
    //TODO: get user password;
    $resultstring = "wow a wonderful password";
    if (password_verify($mdp, $resultstring)) {
        //TODO: get uid;
        $userId = 1;
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['uid'] = $userId;
        $bdd = DBLink::disconnect($bdd);
        //TODO: replace to mainpage
        header('Location: mainpage.php');
    }
}

?>
<!DOCTYPE HTML>
<html lang="fr" class="co">

<head>
    <meta Charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="shortcut icon" href="../pics/trasis_icon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;500&display=swap" rel="stylesheet">
    <style>
        body {
            background: no-repeat center fixed url("../pics/trasis_2022_web-14.webp");
            background-size: cover;
            height: auto;
        }
    </style>
</head>

<body class="co">
<form class="textco">
    <section>
        <img class="logoco" src="../pics/h_trasis_logo.png" alt="Logo trasis">
    </section>

    <section class="infosupco">
        <p> @2023 Trasis </p>
    </section>
</form>
<form class="panelco" action="connexion.php" method="post">
    <section>
        <article>
            <img class="logocon"  src="../pics/trasis_icon.png" alt="Logo Trasis">
        </article>
        <article>
            <h2>Login to Trasis LMS</h2>
        </article>
        <article>
            <input class="champs courriel" placeholder="E-Mail*" name="courriel" type="email" value="">
        </article>
        <article>
            <input class="champs" placeholder="Password*" name="mdp" type="password">
        </article>
        <?php

        if ($email != null) {
            if (!$um->existsInDB($email,$msg)) {
                echo '<p class="errormess">no account for this email</p>';
            } elseif (!password_verify($mdp, $resultstring)) echo '<p class="errormess">bad password</p>';
        }

        ?>
        <article>
            <button type="submit" class="buttinsc" name="buttco">Login</button>
            <input type="button" class="buttoubl" onclick="window.location.href='././mdp-oublie.php';" value="I forgot my password" />
        </article>

    </section>
</form>
</body>

</html>