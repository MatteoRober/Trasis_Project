<?php
session_start();

require('inc/db_functions.inc.php');

use Trasis\TrainingManagement;
use Trasis\TeamManagement;
use Trasis\LogsManagement;
use Trasis\TrainingStatus;
use Trasis\TrainingStatusManagement;
use Trasis\UserManagement;

if(!isset($_SESSION['user'])) {
    header("location: login.php");
}

$title = 'Team requests';
include 'inc/header.inc.php';

$message = "";
$uid = $_SESSION['user'];

$um = new UserManagement();
$tm = new TrainingManagement();
$tsm = new TrainingStatusManagement();
$ts = new TrainingStatus();

$user = $um->getUserById($uid,$message);

if(isset($_POST["accept"])) {
    $ts->__set('done', 0);
    $ts->__set('approved', 1);
    $tsm->storeTrainingstatus($ts, $uid, $_POST["form_id"], $message);
    $lm = new LogsManagement();
    $lm->addlog("training approuved by manager: ".$user->__get('mail')." in group id:".$_POST["form_id"],$message);
}
if(isset($_POST["refuse"])){
    $tsm->deleteTrainingstatus($uid, $_POST["form_id"], $message);
}
?>
    <main>
        <h1>Team requests</h1>
        <?php include 'inc/dashboardNav.inc.php';?>
        <table class="infos-table">
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
            foreach ($members as $member) {
                echo '<tr>';
                $trainings = $trainingManager->getNotApprovedTrainingsForUserWithId($member->__GET('user_id'), $message);
                foreach ($trainings as $training) {
                    '<td>' . $training->__GET("name") . '</td>
                     <td>' . $training->__GET("description") . '</td>
                     <td>' . $training->__GET("duration") . '</td>
                     <td>' . $member->__GET("surname") . '</td>
                     <!--todo implement accept or refuse a training for a team member-->
                     <td><form action="" method="post">
                         <button type="submit" name="accept" value="accept">Accept</button>
                         <button type="submit" name="refuse" value="refuse">Refuse</button>
                         </form>
                     </td>';
                }
                echo '</tr>';
            }
            ?>
    </main>
<?php
include 'inc/footer.inc.php';
?>
