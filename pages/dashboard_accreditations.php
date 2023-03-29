<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Accreditations</title>
</head>
<body>
    <?php
    include '../inc/header.php';
    ?>
    <nav>
        <a href="dashboard_training.php">My courses</a>
        <a href="dashboard_summary.php">Summary completed courses</a>
        <a href="dashboard_progress.php">Progress of training courses</a>
        <a href="#">Accreditations</a>
        <a href="dashboard_expiringTraining.php">Expiring training courses</a>
        <?php
        echo '<a href="dashboard_logs.php">Logs</a>';
        ?>
    </nav>
    <main>
        <h1>Accreditations</h1>
        <table>
            <tr>
                <th>Title</th>
            </tr>
            <?php
                //Display the title of each accreditation the user has with the different courses he has completed
                echo'<tr>';
                for () {
                    echo '<td></td><br>';
                }
                echo '</tr>';
            ?>
        </table>
    </main>
    <?php
    include '../inc/footer.php';
    ?>
</body>
</html>