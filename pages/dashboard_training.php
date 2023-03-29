<?php
$title = 'My courses';
include '../inc/header.php';
?>
    <nav>
        <a href="#">My courses</a>
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
    <main>
        <h1>Training courses</h1>
        <table>
            <tr>
                <th>Title</th>
                <th>Trainer</th>
                <th>Duration</th>
                <th>Validity (month)</th>
                <th>Date</th>
                <th>Status</th>
            </tr>
            <?php
            //For each course the user have planned or completed, display the course details in a table row
            echo '<tr>';
            for () {
                echo '<td></td><br>
                      <td></td><br>
                      <td></td><br>
                      <td></td><br>
                      <td></td><br>';
                //If the course is planned, display "Planned" in the status column, otherwise display "Completed"
                if (TRUE) {
                    echo '<td>Planned</td>';
                } else {
                    echo '<td>Completed</td>';
                }
            }
            '</tr>';
            ?>
        </table>
    </main>
<?php
include '../inc/footer.php';
?>