<?php
session_start();

// inc
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/Exception.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'inc/db_functions.inc.php';
use Trasis\UserManagement;
use Trasis\User;

// access
if(!isset($_SESSION['user'])) {
    header('Location: login.php');
}

// parameters
$message = "";
$noError = true;

// objects
$userManagement = new UserManagement();
$user = new User();

// mail
if(isset($_POST['validation'])) {
    $email = new PHPMailer(true);
    try {
        $email->CharSet = 'UTF-8';

        $email->SMTPDebug = 2;                                       // Enable verbose debug output
        $email->isSMTP();                                            // Set mailer to use SMTP
        $email->Host       = 'smtp1.example.com;smtp2.example.com';  // Specify main and backup SMTP servers
        $email->SMTPAuth   = true;                                   // Enable SMTP authentication
        $email->Username   = 'user@example.com';                     // SMTP username
        $email->Password   = 'secret';                               // SMTP password
        $email->SMTPSecure = 'tls';                                  // Enable TLS encryption, [ICODE]ssl[/ICODE] also accepted
        $email->Port       = 587;

        $email->setFrom('no-reply@trasis.be');
        $email->addAddress("n.docquier@student.helmo.be");
        $email->addReplyTo('no-reply@trasis.be');
        $email->isHTML(true);
        $email->Subject = 'Account Test';
        $email->Body = "Your account was created :<br><br> Just kidding";
        $email->send();
    } catch(Exception $e) {
        $message .= "Error while sending the email" . $email->ErrorInfo;
    }
}

$title = "Home Page";
include 'inc/headerC.inc.php';

echo $message;
?>

<form method="post">
    <button name="validation">Send mail</button>
</form>
