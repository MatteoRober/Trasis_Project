<?php
$title = 'Progress of training courses';
include '../inc/header.php';
?>
    <nav>
        <a href="dashboard_training.php">My courses</a>
        <a href="dashboard_summary.php">Summary completed courses</a>
        <a href="#">Progress of training courses</a>
        <a href="dashboard_accreditations.php">Accreditations</a>
        <a href="dashboard_expiringTraining.php">Expiring training courses</a>
        <?php
        echo '<a href="dashboard_logs.php">Logs</a>';
        ?>
    </nav>
    <main>
        <h1>Progress of training courses</h1>
        <table>
            <tr>
                <th>Title</th>
                <th>Duration</th>
                <th>Duration left</th>
            </tr>
            <?php
            //For each course the user haven't completed yet, display the course title, duration and duration remaining
            echo '<tr>';
            for () {
                echo '<td></td><br>
                      <td></td><br>
                      <td></td><br>';
            }
            echo '</tr>';
            ?>
        </table>
    </main>
<?php
include '../inc/footer.php';
?>