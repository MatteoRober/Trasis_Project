<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title><?php echo "Trasis - " . $title ?></title>
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <link rel="icon" type="image/png" href="../pics/trasis_icon.ico">
</head>
<body>
<?php
if(isset($_SESSION['user'])) {
?>
    <header>
        <div class="header-box">
            <img class="header-logo" src="../pics/h_trasis_logo.png" alt="">
            <nav class="header-nav">
                <ul class="nav-bar">
                    <li><a href="dashboard/training.php">Dashboard</a></li>
                    <li><a href="available_trainings.php">Trainings</a></li>
                    <li><a href="profile.php">Profile</a></li>
                    <li><a href="php/logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>
<?php
}
?>