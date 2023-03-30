<?php
$title = 'Summary completed courses';
include 'inc/header.inc.php';
include 'inc/dashboardNav.php';
?>
<nav>
    <a href="dashboardTraining.php">My courses</a>
    <a href="#">Summary completed courses</a>
    <a href="dashboardTraining.php">Progress of training courses</a>
    <a href="dashboardAccreditations.php">Accreditations</a>
    <a href="dashboardExpiringTraining.php">Expiring training courses</a>
    <?php
    echo '<a href="dashboardLogs.php">Logs</a>';
    ?>
</nav>
<main>
    <h1>Summary completed courses</h1>
    <?php
    //todo graph of the number of courses completed and hours per ... (month, year, etc.)
    ?>
</main>
<?php
include 'inc/footer.inc.php';
?>
