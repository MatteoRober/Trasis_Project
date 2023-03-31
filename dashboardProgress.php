<?php
session_start();

require('inc/db_functions.inc.php');

use Trasis\TrainingManagement;

if(!isset($_SESSION['user'])) {
    header("location: login.php");
}

$message = "";

$title = 'Progress of training courses';
include 'inc/header.inc.php';
?>
<main>
    <h1>Progress of training courses</h1>
    <?php include 'inc/dashboardNav.inc.php';?>
    <table>
        <tr>
            <th>Title</th>
            <th>Duration</th>
            <th>Duration left</th>
        </tr>
        <?php
        $uid = $_SESSION['user'];
        $trainingManager = new TrainingManagement();
        $trainings = $trainingManager->getNotDoneTrainingsForUserWithId($uid, $message);
        //For each course the user haven't completed yet, display the course title, duration and duration remaining
        foreach ($trainings as $training) {
            echo '<tr>';
            //TODO edit to know how many hours the user has already done for this course
            $hoursDone = 0;
            //$hoursLeft = $training->__GET("duration")->diff($hoursDone);
            echo '<td>' . $training->__GET("name") . '</td><br>
                  <td>' . $training->__GET("duration") . '</td><br>';
                  //<td>' . $hoursLeft->format('%a hours remaining').'</td><br>';
            echo '</tr>';
        }
        ?>
    </table>
</main>
<?php
include 'inc/footer.inc.php';
?>