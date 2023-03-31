<?php

use Trasis\RoleManagement;
use Trasis\UserManagement;
$user = "";
$role = "";

if (isset($_SESSION['user'])) {
    $um = new UserManagement();
    $user = $um->getUserById($_SESSION['user'], $message);

    $rm = new RoleManagement();
    $role = $rm->getRoleById($user->__get('role_id'), $message);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title><?php echo "Trasis - " . $title ?></title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link rel="icon" type="image/ico" href="pics/trasis_icon.ico">
    <script src="js/script.js"></script>
</head>
<body>
<?php
if(isset($_SESSION['user'])) {
?>
<div class="page-border">
    <header>
        <div class="header-box">
            <img class="header-logo" src="pics/h_trasis_logo.png" alt="">
            <nav class="header-nav">
                <ul class="nav-bar">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="dashboardtraining.php">Dashboard</a></li>
                    <li><a href="availableTrainings.php">Trainings</a></li>
                    <li><a href="profile.php">Profile</a></li>
                    <?php if(isset($_SESSION['user']) && $role->__get('role_id') == 4) {?>
                        <li><a href="adminManagesUsers.php">Admin</a></li>
                    <?php } ?>
                    <li><a href="php/logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>
<?php
}
?>