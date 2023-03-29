<?php
$title = 'Expiring training courses';
include '../inc/header.php';
?>
    <nav>
        <a href="dashboard_training.php">My courses</a>
        <a href="dashboard_summary.php">Summary completed courses</a>
        <a href="dashboard_progress.php">Progress of training courses</a>
        <a href="dashboard_accreditations.php">Accreditations</a>
        <a href="#">Expiring training courses</a>
        <?php
        echo '<a href="dashboard_logs.php">Logs</a>';
        ?>
    </nav>
    <main>
        <h1>Expiring training courses</h1>
        <table>
            <tr>
                <th>Title</th>
                <th>Duration</th>
                <th>Validity (month)</th>
                <th>Date</th>
            </tr>
            <?php
            //For each course the user have completed and have an expiration date, display the course details in a table row
            echo '<tr>';
            for () {
                echo '<td></td><br>
                      <td></td><br>
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