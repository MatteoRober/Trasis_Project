<?php
session_start();

require('inc/db_functions.inc.php');

if(!isset($_SESSION['user'])) {
    header("location: login.php");
}

$title = 'Summary completed courses';
include 'inc/header.inc.php';
?>
<main>
    <h1>Summary completed courses</h1>
    <?php include 'inc/dashboardNav.inc.php';?>
    <?php
    //todo graph of the number of courses completed and hours per ... (month, year, etc.)
    ?>
</main>
<?php
include 'inc/footer.inc.php';
?>