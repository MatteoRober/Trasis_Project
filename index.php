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
/*if(isset($_POST['validation'])) {
    $email = new PHPMailer(true);
    try {
        $email->CharSet = 'UTF-8';
        $email->setFrom('no-reply@trasis.be');
        $email->addAddress("n.docquier@student.helmo.be");
        $email->addReplyTo('no-reply@trasis.be');
        $email->isHTML(true);
        $email->Subject = 'Account Test';
        $email->Body = "Your account was created :<br><br> Just kidding";
        $email->send();
    } catch(Exception $e) {
        $message .= "Error while sending the email : " . $email->ErrorInfo;
    }
}*/

$title = "Home";
include 'inc/headerC.inc.php';

echo $message;
?>

<main>
    <h1 class="hover">Enjoying <span>by training</span></h1>
    <div class="home-pic">
        <img src="pics/home_picture.jpg" alt="">
    </div>
</main>

<?php
include 'inc/footerC.inc.php'
?>
