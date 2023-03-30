<?php
$title = 'Summary completed courses';
include '../inc/header.inc.php';
?>
<nav>
    <a href="dashboard_training.php">My courses</a>
    <a href="#">Summary completed courses</a>
    <a href="dashboard_training.php">Progress of training courses</a>
    <a href="dashboard_accreditations.php">Accreditations</a>
    <a href="dashboard_expiringTraining.php">Expiring training courses</a>
    <?php
    echo '<a href="dashboard_logs.php">Logs</a>';
    ?>
</nav>
<main>
    <h1>Summary completed courses</h1>
    <?php
    //todo graph of the number of courses completed and hours per ... (month, year, etc.)
    ?>
</main>
<?php
include '../inc/footer.inc.php';
?>
