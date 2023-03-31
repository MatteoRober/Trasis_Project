<?php
session_start();
$title = "Modify users";
include 'inc/header.inc.php';

?>
<style>
    label{
        display: flex;
        width: 100%;
    }
</style>

<h2>Modify a user profile</h2>

<div class="current">
    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']); ?>" class="adminForm" method="post"> <!--TODO: attach function to send data to DB-->
        <p>Which user do you want to modify?</p>
        <label for="email">Enter the email:</label>
        <input class="inputfield" type="email" id="email" name="mail" placeholder="example@example.com" required>

        <input type="submit" name="modify" id="modifyUser" value="Modify user" onclick="modifyUser()"> <!--TODO: search via php if user exists in DB -->
        <input type="submit" name="delete" id="deleteUser" value="Delete user"> <!--TODO: search via php if user exists in DB & Delete that user -->
        <input type="button" id="cancel" value="Cancel" onclick="clearInputs()">

    </form>
</div>



<?php

require('inc/db_functions.inc.php');
use Trasis\UserManagement;
use Trasis\RoleManagement;

//objects
$userManagement = new UserManagement();
$roleManagement = new RoleManagement();

function checkIfUserExists($email){
    $message = "";
    $userManagement = new UserManagement();
    $user = $userManagement->getUserByMail($email, $message);
    return $user;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlentities($_POST['mail']);
    if(isset($_POST['modify'])) {
        //you're here when clicking the modify button
        $user = checkIfUserExists($email);
        if($user != null){
            //fill in the form with the user's data
            $name = $user->__get('name');
            $surname = $user->__get('surname');
            $email = $user->__get('mail');
            $password = $user->__get('password');
            //show the form to modify the user data
            include 'inc/adminModifyUser.inc.php';

        } else {
            echo "User doesn't exist";
        }
    } elseif (isset($_POST['delete'])) {
        //you're here when clicking the delete button
        if(checkIfUserExists($email)){
            echo "<h2>Not yet implemented! User exist.</h2>";
        } else {
            echo "<h2>Not yet implemented! User does not exist.</h2>";
        }
    }
}

include 'inc/footer.inc.php'
?>