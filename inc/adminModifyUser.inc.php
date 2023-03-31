<?php

$title = "Modify user";
include 'inc/header.inc.php';

//TODO: MODIFY USER DATA IN DB
?>

<style>
    label{
        display: flex;
        width: 100%;
    }
</style>

<div>
    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']); ?>" class="adminForm" method="post"> <!--TODO: attach function to send data to DB-->
        <label for="name">Name:</label>
        <input class="inputfield" type="text" id="name" name="name" value="<?php echo $name  ?>" >

        <label for="surname">Surname:</label>
        <input class="inputfield" type="text" id="surname" name="surname" value="<?php echo $surname ?>" >

        <label for="role">Role:</label>
        <select id="role" name="role">
            <option value="user" <?php if ($role == 'user') { echo 'selected'; } ?>>user</option>
            <option value="manager" <?php if ($role == 'manager') { echo 'selected'; } ?>>Manager</option>
            <option value="training-manager" <?php if ($role == 'training') { echo 'selected'; } ?>>Training Manager</option>
            <option value="admin" <?php if ($role == 'administrator') { echo 'selected'; } ?>>Admin</option>
        </select>

        <input type="submit" name="submit" id="addUser" value="Modify the user"> <!--TODO: via php send modifications to database -->
        <input type="button" id="cancel" value="Cancel" onclick="clearInputs()">
    </form>
</div>

<?php
include 'inc/footer.inc.php'
?>
