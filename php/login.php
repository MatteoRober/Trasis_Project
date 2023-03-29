<?php
session_start();

if (isset($_SESSION['uid'])){
    //TODO: if connected return to main page
}
session_destroy();
require('../inc/db_link.inc.php');
use DB\DBLink;


$message = "";
$bdd = DBLink::connect2db( $message);


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
        /*
        if ($email != null) {
            if ($count != 1) {
                echo '<p class="errormess">Il y a pas de compte pour cette adresse mail</p>';
            } elseif (!password_verify($mdp, $resultstring)) echo '<p class="errormess">le mot de passe est incorrect</p>';
        }
        */
        ?>
        <article>
            <button type="submit" class="buttinsc" name="buttco">Login</button>
            <input type="button" class="buttoubl" onclick="window.location.href='././mdp-oublie.php';" value="I forgot my password" />
        </article>

    </section>
</form>
</body>

</html>