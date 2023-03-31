<?php

session_start();

require('inc/db_functions.inc.php');
use Trasis\User;
use Trasis\UserManagement;

$title = "Add user";
include 'inc/header.inc.php';

// objects
$userManagement = new UserManagement();
$user = new User();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['submit'])) {
        //you're here when clicking the submit button

        //Check if all values meet the requirements
        $noError = true;
        $message="";
        $mail = htmlentities($_POST['mail']);
        $name = htmlentities($_POST['name']);
        $surname = htmlentities($_POST['surname']);
        if (empty($mail) || empty($name) || empty($surname)) {
            $message .= "Please fill all the boxes.";
            $noError = false;
        } elseif (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            $message .= "Mail is not valid. Use an email from the format: example@example.com";
            $noError = false;
        } elseif (!($userManagement->existsInDB($mail, $message))) {
            $message .= "The account already exists. You need another email address.";
            $noError = false;
        } else {
            //Generate new password
            $passwordArray = $userManagement->rand_password();

            //add data to user object
            $user->__set('name', $name);
            $user->__set('surname',$surname);
            $user->__set('email', $mail);
            $user->__set('password', $passwordArray[1]);

            //add user to database
            if($userManagement->storeUser($user, $message)) {
                $message .= "User added successfully.";
            } else {
                $message .= "Error adding user.";
            }

            //TODO: send email to user with password
        }
    }
}
?>
<style>
    label{
        display: flex;
        width: 100%;
    }
</style>

<h2>Add a new user</h2>

<form action="<?php echo htmlentities($_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']); ?>" class="adminForm" method="post"> <!--TODO: attach function to send data to DB-->
    <label for="email">Email:</label>
    <input class="inputfield" type="email" id="email" name="mail" placeholder="example@example.com" required>

    <label for="name">Name:</label>
    <input class="inputfield" type="text" id="name" name="name" placeholder="enter the name" required>

    <label for="surname">Surname:</label>
    <input class="inputfield" type="text" id="surname" name="surname" placeholder="enter the surname" required>

    <p> The password will be auto-generated and send to the user if you click on the "add a new user" button</p>

    <input type="submit" name="submit" id="addUser" value="Add a new user"> <!--TODO: via php adding a user to the database -->
    <input type="button" id="cancel" value="Cancel" onclick="clearInputs()">
</form>
