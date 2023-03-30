<?php
session_start();

require('inc/db_functions.inc.php');

use Trasis\TrainingManagement;
use Trasis\TeamManagement;

$message = "";
$uid = $_SESSION['user_id'];

$title = 'Team requests';
include 'inc/header.inc.php';
include 'inc/dashboardNav.inc.php';
?>
    <main>
        <h1>Team requests</h1>
        <table>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Duration</th>
                <th>Team member</th>
                <th>Accept / Refuse</th>
            </tr>
            <?php
            $teamManager = new TeamManagement();
            $members = $teamManager->getTeamMembers($uid, $message);
            $trainingManager = new TrainingManagement();
            echo '<tr>';
            foreach ($members as $member) {
                $trainings = $trainingManager->getNotApprovedTrainingsForUserWithId($member->__GET('user_id'), $message);
                foreach ($trainings as $training) {
                    '<td>' . $training->__GET("name") . '</td><br>
                     <td>' . $training->__GET("description") . '</td><br>
                     <td>' . $training->__GET("duration") . '</td><br>
                     <td>' . $member->__GET("surname") . '</td><br>
                     <td> <!--todo implement accept or refuse a training for a team member--> </td><br>';
                }
            }
            ?>
    </main>
<?php
include 'inc/footer.inc.php';
?>
