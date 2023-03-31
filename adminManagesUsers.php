<?php
session_start();

$title = "Manage users";
include 'inc/header.inc.php';

?>

<ul>
    <li><a href="adminAddUser.php">Add a user</a></li>
    <li><a href="adminLookUpUser.php">Modify a user</a></li>
</ul>

<?php
include 'inc/footer.inc.php'
?>

