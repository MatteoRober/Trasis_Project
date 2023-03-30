<?php
session_start();

require('inc/db_functions.inc.php');
use Trasis\User;
use Trasis\UserManagement;
use DB\DBLink;
if(isset($_SESSION['user'])) {
    header('Location: index.php');
}

// parameters
$message = "";
$noError = true;

// objects
$userManagement = new UserManagement();
$user = new User();

// variables
$mail = "";
$password = "";
// form
if(isset($_POST['validation'])) {
    $mail = htmlentities($_POST['mail']);
    $password = htmlentities($_POST['password']);
    if (empty($mail) || empty($password)) {
        $message .= "Please fill all the boxes.";
        $noError = false;
    } elseif (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        $message .= "Mail is not valid.";
        $noError = false;
    } elseif (!$userManagement->existsInDB($mail, $message)) {
        $message .= "The account doesn't exist.";
        $noError = false;
    } else {
        $user = $userManagement->getUserByMail($mail, $message);
        if(!password_verify($password, $user->__get('password'))) {
            $message .= "Incorrect credentials.";
            $noError = false;
        } else {
            $_SESSION['user'] = $mail;
            header('Location: index.php');
        }
    }
}
?>
    <!DOCTYPE HTML>
    <html lang="fr" class="co">

    <head>
        <meta Charset="utf-8">
        <title>[trasis] login</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="shortcut icon" href="pics/trasis_icon.ico">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;500&display=swap" rel="stylesheet">
        <style>
            body {
                background: no-repeat center fixed url("pics/trasis_2022_web-14.webp");
                background-size: cover;
                height: auto;
            }
        </style>
    </head>

<body class="co">
<img class="logoco" src="pics/h_trasis_logo.png" alt="Logo trasis">
<section class="panelco">
    <form  action="<?php echo htmlentities($_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']); ?>" method="post">
        <img class="logocon" src="pics/trasis_icon.png" alt="Logo trasis">
        <input class="champs courriel" type="email" name="mail" id="mail" placeholder="Mail*" autocomplete="off" value="<?php echo $mail ?>">
        <input type="password" class ="champs motdepasse" name="password" id="password" placeholder="Password*" autocomplete="off">
        <p class="errormess"><?php echo $message?></p>
        <button class="buttinsc" name="validation">Log in</button>
        <button class="buttoubl" name="validation">Forgot password</button>
    </form>
    </body>
</html>
