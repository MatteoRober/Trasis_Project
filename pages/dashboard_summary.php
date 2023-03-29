<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Summary</title>
</head>
<body>
    <?php
    include '../inc/header.php';
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
            //TODO graph of the number of courses completed and hours per ... (month, year, etc.)
        ?>
    </main>
    <?php
    include '../inc/footer.php';
    ?>
</body>
</html>
