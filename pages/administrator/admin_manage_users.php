<?php
session_start();

$title = "Trasis - Manage Users";
include '../../inc/headerC.inc.php';

?>
<style>
    /** ADMIN PAGE **/
    #addUserForm{
        display: flex;
        flex-direction: column;
    }
</style>
<!--form to enter the information of the new user
// Submit button => sends data to the database
// Cancel button => redirects to the admin_manage_users.php page => makes all the form fields empty-->

<form id="addUserForm" method="post"> <!--TODO: attach function to send data to DB-->
    <label for="name">Name:</label>
    <input class="inputfield" type="text" id="name" name="name" placeholder="enter the name" required>

    <label for="surname">Surname:</label>
    <input class="inputfield" type="text" id="surname" name="surname" placeholder="enter the surname" required>

    <label for="email">Email:</label>
    <input class="inputfield" type="email" id="email" name="email" placeholder="example@example.com" required>

    <p> The password will be auto-generated and send to the user if you click on the submit button</p>


    <input type="submit" id="addUser" value="Add a new user" > <!--//via php to the database -->
    <input type="button" id="cancel" value="Cancel" onclick="clearForm()"> <!--via php empty the form fields-->
</form>




<?php
include '../../inc/footerC.inc.php'
?>

