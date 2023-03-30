<?php
session_start();

require('inc/db_functions.inc.php');

use Trasis\TrainingManagement;

$message = "";

$title = 'My courses';
include 'inc/header.inc.php';
include 'inc/dashboardNav.php';
?>
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
            $uid = $_SESSION['user_id'];
            $trainingManager = new TrainingManagement();
            $trainings = $trainingManager->getAllTrainingsForUserWithId($uid, $message);
            //For each course the user have planned or completed, display the course details in a table row
            echo '<tr>';
            foreach ($trainings as $training) {
                //TODO complete to have all the informations wanted
                echo '<td>' . $training->__GET("name") . '</td><br>
                      <td></td><br>
                      <td>' . $training->__GET("duration") . '</td><br>
                      <td>' . $training->__GET("validity") . '</td><br>
                      <td></td><br>';
                //TODO logical condition to check if the course is planned or completed
                //If the course is planned, display "Planned" in the status column, otherwise display "Completed"
                $message = "";
                if (!$trainingManager->isDone($training->__GET("training_id"), $uid, $message)) {
                    echo '<td>Planned</td>';
                } else {
                    echo '<td>Completed</td>';
                }
            }
            echo '</tr>';
            ?>
        </table>
    </main>
<?php
include 'inc/footer.inc.php';
?>