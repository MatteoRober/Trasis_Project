<?php
session_start();

$title = "Manage Users";
include 'inc/header.inc.php';

?>

<h2>Add a new user</h2>

<form id="addUserForm" method="post"> <!--TODO: attach function to send data to DB-->
    <label for="name">Name:</label>
    <input class="inputfield" type="text" id="name" name="name" placeholder="enter the name" required>

    <label for="surname">Surname:</label>
    <input class="inputfield" type="text" id="surname" name="surname" placeholder="enter the surname" required>

    <label for="email">Email:</label>
    <input class="inputfield" type="email" id="email" name="email" placeholder="example@example.com" required>

    <p> The password will be auto-generated and send to the user if you click on the submit button</p>


    <input type="submit" id="addUser" value="Add a new user" > <!--//via php to the database -->
    <input type="button" id="cancel" value="Cancel" onclick="clearInputs()"> <!--via php empty the form fields-->
</form>

<?php
include 'inc/footer.inc.php'
?>

