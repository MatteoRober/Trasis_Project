<?php
session_start();

if(!isset($_SESSION['user'])) {
    header("location: login.php");
}

$title = 'Logs';
include 'inc/header.inc.php';
?>
<main>
    <h1>Logs</h1>
    <?php include 'inc/dashboardNav.inc.php';?>

</main>
<?php
include 'inc/footer.inc.php';
?>