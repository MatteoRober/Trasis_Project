<?php
session_start();

require('inc/db_functions.inc.php');

use Trasis\TrainingManagement;

if(!isset($_SESSION['user'])) {
    header("location: login.php");
}

$trainers = ['M. Davidson', 'Ms. Linka', 'M. Arter', 'Ms. Conor', 'Ms. Milsy'];
$i = 0;

$title = 'My courses';
include 'inc/header.inc.php';

$message = "";
$uid = $_SESSION['user'];
?>
    <main>
        <h1>Training courses</h1>
        <?php include 'inc/dashboardNav.inc.php';?>
        <table class="infos-table">
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
            $trainings = $trainingManager->getAllTrainingsForUserWithId($uid, $message);
            //For each course the user have planned or completed, display the course details in a table row
            foreach ($trainings as $training) {
                echo '<tr>';
                //TODO complete to have all the informations wanted
                echo '<td>' . $training->__GET("name") . '</td>
                      <td>'.$trainers[$i].'</td>
                      <td>' . $training->__GET("duration") . ' month(s)</td>
                      <td>' . $training->__GET("validity") . '</td>';
                $i++;
                if ($trainingManager->getCompletionDate($training->__GET("training_id"), $uid, $message) != null) {
                    echo '<td>' . $trainingManager->getCompletionDate($training->__GET("training_id"), $uid, $message) . '</td>';
                } else {
                    echo '<td>No date indicated</td>';
                }
                //If the course is planned, display "Planned" in the status column, otherwise display "Completed"
                $message = "";
                if (!$trainingManager->isDone($training->__GET("training_id"), $uid, $message)) {
                    echo '<td>Planned</td>';
                } else {
                    echo '<td>Completed</td>';
                }
                echo '</tr>';
            }
            ?>
        </table>
    </main>
<?php
include 'inc/footer.inc.php';
?>