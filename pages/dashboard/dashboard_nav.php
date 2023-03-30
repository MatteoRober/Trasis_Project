<nav>
    <a href="dashboard_training.php">My courses</a>
    <a href="dashboard_summary.php">Summary completed courses</a>
    <a href="dashboard_training.php">Progress of training courses</a>
    <a href="dashboard_accreditations.php">Accreditations</a>
    <a href="dashboard_expiringTraining.php">Expiring training courses</a>
    <?php
    //TODO move to profile page (todo in the other dashboard pages)
    //If the user is an administrator, display the link to the logs page
    echo '<a href="dashboard_logs.php">Logs</a>';
    ?>
</nav>