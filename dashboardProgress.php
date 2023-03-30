<?php
session_start();

require('inc/db_functions.inc.php');

use Trasis\TrainingManagement;

$message = "";

$title = 'Progress of training courses';
include 'inc/header.inc.php';
include 'inc/dashboardNav.inc.php';
?>
<div class="page-border">
    <main>
        <h1>Progress of training courses</h1>
        <table>
            <tr>
                <th>Title</th>
                <th>Duration</th>
                <th>Duration left</th>
            </tr>
            <?php
            $uid = $_SESSION['user_id'];
            $trainingManager = new TrainingManagement();
            $trainings = $trainingManager->getNotDoneTrainingsForUserWithId($uid, $message);
            //For each course the user haven't completed yet, display the course title, duration and duration remaining
            echo '<tr>';
            foreach ($trainings as $training) {
                //TODO edit to know how many hours the user has already done for this course
                $hoursDone = 0;
                $hoursLeft = $training->__GET("duration")->diff($hoursDone);
                echo '<td>' . $training->__GET("name") . '</td><br>
                      <td>' . $training->__GET("duration") . '</td><br>
                      <td>' . $hoursLeft->format('%a hours remaining').'</td><br>';
            }
            echo '</tr>';
            ?>
        </table>
    </main>
</div>
<?php
include 'inc/footer.inc.php';
?>