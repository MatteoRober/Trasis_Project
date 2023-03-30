<?php
session_start();

require('../inc/db_functions.inc.php');

use Trasis\Training;
use Trasis\TrainingManagement;

$message = "";
$user_id = $_SESSION['user_id'];
$user_id->

$title = 'My courses';
include '../inc/header.inc.php';
include 'dashboard_nav.php';
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
            $trainingManager = new TrainingManagement();
            $trainings = $trainingManager->getAllTrainingsForUserWithId($user_id, $message);
            //For each course the user have planned or completed, display the course details in a table row
            echo '<tr>';
            foreach ($trainings as $training) {
                //todo add the trainer in the db and use it here
                echo '<td>' . $training->__GET("name") . '</td><br>
                      <td> Not implemented yet</td><br>
                      <td>' . $training->__GET("duration") . '</td><br>
                      <td>' . $training->__GET("validity") . '</td><br>
                      <td>' . $trainingManager->getCompletionDate($training->__GET("training_id"), $user_id, $message) . '</td><br>';
                //If the course is planned, display "Planned" in the status column, otherwise display "Completed"
                $message = "";
                if (!$trainingManager->isDone($training->__GET("training_id"), $user_id, $message)) {
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
include '../inc/footer.inc.php';
?>