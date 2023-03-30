<?php
$title = 'Summary completed courses';
include '../inc/headerC.inc.php';
?>
<nav>
    <a href="training.php">My courses</a>
    <a href="#">Summary completed courses</a>
    <a href="training.php">Progress of training courses</a>
    <a href="accreditations.php">Accreditations</a>
    <a href="expiringTraining.php">Expiring training courses</a>
    <?php
    echo '<a href="logs.php">Logs</a>';
    ?>
</nav>
<main>
    <h1>Summary completed courses</h1>
    <?php
    //todo graph of the number of courses completed and hours per ... (month, year, etc.)
    ?>
</main>
<?php
include '../inc/footerC.inc.php';
?>
