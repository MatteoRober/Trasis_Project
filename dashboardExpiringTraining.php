<?php
session_start();

require('inc/db_functions.inc.php');

use Trasis\TrainingManagement;

$message = "";

$title = 'Expiring training courses';
include 'inc/header.inc.php';
?>
<main>
    <h1>Expiring training courses</h1>
    <?php include 'inc/dashboardNav.inc.php';?>
    <table>
        <tr>
            <th>Title</th>
            <th>Duration</th>
            <th>Validity (month)</th>
            <th>Completion date</th>
            <th>Expiration date</th>
        </tr>
        <?php
        $uid = $_SESSION['user'];
        $trainingManager = new TrainingManagement();
        $trainings = $trainingManager->getDoneTrainingsForUserWithId($uid, $message);
        //For each course the user have completed and have an expiration date, display the course details in a table row
        $message = "";
        foreach ($trainings as $training) {
            echo '<tr>';
            $completionDate = $trainingManager->getCompletionDate($training->__GET("training_id"), $uid, $message);
            $duration = $training->__GET("duration");
            echo '<td>' . $training->__GET("name") . '</td><br>
                  <td>' . $duration . '</td><br>
                  <td>' . $training->__GET("validity") . '</td><br>
                  <td>' . $completionDate . '</td><br>
                  <td>' . strtotime($completionDate. '+'.$duration .'months') . '</td><br>';
            echo '</tr>';
        }
        ?>
    </table>
</main>
<?php
include 'inc/footer.inc.php';
?>