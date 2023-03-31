<?php
session_start();

require('inc/db_functions.inc.php');
include 'inc/header.inc.php';


use Trasis\LogsManagement;
use Trasis\TrainingManagement;
use Trasis\TrainingStatus;
use Trasis\TrainingStatusManagement;
Use Trasis\UserManagement;
if(!isset($_SESSION['user'])) {
    header("location: login.php");
}
$um = new UserManagement();
$tm = new TrainingManagement();
$tsm = new TrainingStatusManagement();
$id = $_SESSION['user'];
$error = "";
$user = $um->getUserById($id,$error);

$title = "Trainings";

$ts = new TrainingStatus();
if(isset($_POST["jointraining"])) {
    $ts->__set('done', 0);
    $ts->__set('approved', 1);
    $tsm->storeTrainingstatus($ts, $id, $_POST["form_id"], $error);
    $lm = new LogsManagement();
    $lm->addlog("user joined training: ".$user->__get('mail')." in group id:".$_POST["form_id"],$error);
}
if(isset($_POST["asktraining"])){
    $ts->__set('done',0);
    $ts->__set('approved',0);
    $tsm->storeTrainingstatus($ts, $id, $_POST["form_id"], $error);
    $lm = new LogsManagement();
    $lm->addlog("user asked training: ".$user->__get('mail')." for group id:".$_POST["form_id"],$error);
}

?>
<main>

    <h1>Trainings</h1>
    <h2 class ="centered_titles push_top">My Trainings</h2>
    <div class = "trainings_form">
        <section>
            <?php
            //TODO: get all my trainings

            $error = "";
            $trainings = $tm->getNotDoneTrainingsForUserWithId($id,$error);
            for($i = 0;$i<count($trainings);$i++){
                $training = $trainings[$i];
                $tid = $training->__get('training_id');
                $title = $training->__get('name');
                $duration = $training->__get('duration');
                $validity = $training->__get('validity');
                $description = $training->__get('description');
                echo
                    '<article>
                    <div class ="lilbar activebar" ></div>
                    <h2>  ' .$title.' </h2>
                    <div class ="flex1">
                    <span>duration:</span>
                    <span>'.$duration.' hours</span>
                    <br>
                    <span>validity:</span>
                    <span>'.$validity.' days</span>
                    <br>
                    <br>
                    <span >'.$description.'</span>
                    </div>
                </article>';
            }
            ?>
        </section>
    </div>
    <h2 class ="centered_titles push_top">Available trainings</h2>
    <div class = "trainings_form">
        <section>
            <?php
            $error = "";
            $trainings = $tm->getNotRegisteredTrainingsForUserWithId($id,$error);
            for($i = 0;$i<count($trainings);$i++){
                $training = $trainings[$i];
                $tid = $training->__get('training_id');
                $title = $training->__get('name');
                $duration = $training->__get('duration');
                $validity = $training->__get('validity');
                $description = $training->__get('description');
                $access = $um->hasAccessToTraining($id,$tid,$error);
                $lilbar = $access? "toactivebar":"inactivebar";
                echo
                    '<article  >
                    <div class ="lilbar '.$lilbar.'" ></div>
                    <h2>  ' .$title.' </h2>
                    <div class ="flex1">
                    <span>duration:</span>
                    <span>'.$duration.' hours</span>
                    <br>
                    <span>validity:</span>
                    <span>'.$validity.' days</span>
                    <br>
                    <br>
                    <span >'.$description.'</span>
                    </div>
                    <form class ="buttgroupeprepair"  method="post">
                    <input type="hidden" name="form_id" value="'.$tid. '"/>';
                if($access){
                    echo'<button type="submit"  class = "buttgroupe" name="jointraining">join Training</button>';
                }else{
                    echo'<button type="submit" class = "buttgroupe" name="asktraining">Ask to join Training</button>';
                }
                echo'</form>
                </article>';


            }
            ?>
        </section>
    </div>

</main>
<?php
include 'inc/footer.inc.php';
?>