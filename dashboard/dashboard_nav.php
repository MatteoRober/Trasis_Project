<nav>
    <a href="dashboard_training.php">My courses</a>
    <a href="dashboard_summary.php">Summary completed courses</a>
    <a href="dashboard_training.php">Progress of training courses</a>
    <a href="dashboard_accreditations.php">Accreditations</a>
    <a href="dashboard_expiringTraining.php">Expiring training courses</a>
    <?php
    if ($user->getRole() == 'manager') {

    }
    ?>
</nav>