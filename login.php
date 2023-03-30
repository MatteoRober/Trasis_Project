<?php
session_start();

require('inc/db_functions.inc.php');
use Trasis\User;
use Trasis\UserManagement;

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
            $_SESSION['user'] = $user->__get("user_id");
            header('Location: index.php');
        }
    }
}

$title = "Login";
include 'inc/header.inc.php';
?>

<!-- <img class="" src="pics/h_trasis_logo.png" alt="Logo trasis"> -->
<div class="loginPannel">
    <div class="loginBackground"></div>
    <div class="formBox">
        <img class="loginFormLogo" src="pics/trasis_icon.png" alt="Logo trasis">
        <h1>Log in into Trasis LMS</h1>
        <form  action="<?php echo htmlentities($_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']); ?>" method="post">
            <label for="mail">Mail</label>
            <input type="email" name="mail" id="mail" placeholder="Mail" autocomplete="off" value="<?php echo $mail ?>">
            <label for="password">Password</label>
            <input type="password"  name="password" id="password" placeholder="Password" autocomplete="off">
            <p class=""><?php echo $message?></p>
            <button class="" name="validation">Log in</button>
            <button class="" name="validation">Forgot password</button>
        </form>
    </div>
</div>

<?php
include 'inc/footer.inc.php';
?>
