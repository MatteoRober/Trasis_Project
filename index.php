<?php
session_start();

// inc
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
include 'inc/header.inc.php';

echo $message;
?>
<main>
    <h1 hidden>Home</h1>
    <div class="home-pic">
        <img src="pics/home_picture.jpg" alt="">
    </div>
    <div class="info-panel">
        <h2>Get better, every day</h2>
        <p>You can start registering for any trainings right now. Learn new skills and test yourself.</p>
    </div>
</main>

<?php
include 'inc/footer.inc.php'
?>
