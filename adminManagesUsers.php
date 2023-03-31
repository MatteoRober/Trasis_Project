<?php
session_start();

$title = "Manage users";
include 'inc/header.inc.php';

?>
<h2>Logs</h2>
<a href="logs.php">Go to Logs</a>

<ul>
    <li><a href="adminAddUser.php">Add a user</a></li>
    <li><a href="adminLookUpUser.php">Modify a user</a></li>
</ul>

<?php
include 'inc/footer.inc.php'
?>

