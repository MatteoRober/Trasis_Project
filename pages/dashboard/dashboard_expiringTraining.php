<?php
session_start();

require('../../inc/db_functions.inc.php');

use Trasis\Training;
use Trasis\TrainingManagement;

$title = 'Expiring training courses';
include '../inc/header.php';
include 'dashboard_nav.php';
?>
    <main>
        <h1>Expiring training courses</h1>
        <table>
            <tr>
                <th>Title</th>
                <th>Duration</th>
                <th>Validity (month)</th>
                <th>Completion date</th>
                <th>Expiration date</th>
            </tr>
            <?php
            $uid = $_SESSION['user_id'];
            $trainingManager = new TrainingManagement();
            $trainings = $trainingManager->getAllTrainingsForUserWithId($uid);
            //For each course the user have completed and have an expiration date, display the course details in a table row
            echo '<tr>';
            foreach ($trainings as $training) {
                echo '<td>' . $training->__GET("name") . '</td><br>
                      <td>' . $training->__GET("duration") . '</td><br>
                      <td>' . $training->__GET("validity") . '</td><br>
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