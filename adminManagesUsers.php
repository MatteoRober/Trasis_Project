<?php

require('inc/db_functions.inc.php');
use Trasis\User;
use Trasis\UserManagement;

session_start();

$title = "Manage Users";
include 'inc/header.inc.php';



if(isset($_POST['submit'])) {
    //you're here when clicking the submit button

    //Check if all values meet the requirements
    $noError = true;
    $message="";
    $mail = htmlentities($_POST['mail']);
    if (empty($mail) || empty($password)) {
        $message .= "Please fill all the boxes.";
        $noError = false;
    } elseif (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        $message .= "Mail is not valid.";
        $noError = false;
    } else { //if all values are valid
        //create new objects
        $user = new User();
        $userManagement = new UserManagement();

        //Generate new password
        $passwordArray = $userManagement->rand_password();
        $message = "You were not able to add a new user";

        //add data to user object
        $user->__set('name', $_POST['name']);
        $user->__set('surname', $_POST['surname']);
        $user->__set('email', $mail);
        $user->__set('password', $passwordArray[1]);

        //add user to database
        $user = $userManagement->storeUser($user, $message);
    }
}
?>

<div class="page-border">
    <h2>Add a new user</h2>

    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']); ?>" id="addUserForm" method="post"> <!--TODO: attach function to send data to DB-->
        <label for="name">Name:</label>
        <input class="inputfield" type="text" id="name" name="name" placeholder="enter the name" required>

        <label for="surname">Surname:</label>
        <input class="inputfield" type="text" id="surname" name="surname" placeholder="enter the surname" required>

        <label for="email">Email:</label>
        <input class="inputfield" type="email" id="email" name="mail" placeholder="example@example.com" required>

        <p> The password will be auto-generated and send to the user if you click on the submit button</p>


        <input type="submit" name="submit" id="addUser" value="Add a new user"> <!--//via php to the database -->
        <input type="button" id="cancel" value="Cancel" onclick="clearInputs()"> <!--via php empty the form fields-->
    </form>
</div>
<?php
include 'inc/footer.inc.php'
?>

