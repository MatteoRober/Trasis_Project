<?php
session_start();
$title = "Manage users";
include 'inc/header.inc.php';

?>
<div class="page-border">
    <h2>Admin Page</h2>


    <ul>
        <li><a href="logs.php">Go to Logs</a></li>
        <li><a href="adminAddUser.php">Add a user</a></li>
        <li><a href="adminLookUpUser.php">Modify a user</a></li>
    </ul>
</div>
<?php

include 'inc/footer.inc.php'
?>

