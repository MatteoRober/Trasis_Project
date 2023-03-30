<?php
session_start();

require('inc/db_functions.inc.php');

use Trasis\TrainingManagement;
use Trasis\TrainingStatus;
use Trasis\TrainingStatusManagement;
Use Trasis\UserManagement;
$um = new UserManagement();
$tm = new TrainingManagement();
$tsm = new TrainingStatusManagement();
$id = $_SESSION['user'];
$error = "";
$user = $um->getUserById($id,$error);

$title = "Trainings";
include 'inc/header.inc.php';
?>

<h1 class ="centered_titles push_top">My Trainings</h1>
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

                echo
                '<article>
                    <div class = "lilbar activebar"></div>
                    <h3>  ' .$title.' </h3>
                    <span>duration:'.$duration.' hours</span>
                    <span>validity:'.$validity.' days</span>
                </article>';
            }
            ?>
        </section>
</div>
<h2 class ="centered_titles push_top">Available trainings</h2>
<div class = "trainings_form">
    <section>
        <?php
        //TODO: get all my trainings

        $error = "";
        $trainings = $tm->getNotRegisteredTrainingsForUserWithId($id,$error);
        for($i = 0;$i<count($trainings);$i++){
            $training = $trainings[$i];
            $tid = $training->__get('training_id');
            $title = $training->__get('name');
            $duration = $training->__get('duration');
            $validity = $training->__get('validity');
            $access = $um->hasAccessToTraining($id,$tid,$error);
            $lilbar = $access? "toactivebar":"inactivebar";
            echo
                '<article>
                    <div class ="lilbar '.$lilbar.'"></div>
                    <h3>  ' .$title.' </h3>
                    <span>duration:'.$duration.' hours</span>
                    <span>validity:'.$validity.' days</span>
                    <form action="'. htmlentities($_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']) .'" method="post">
                   ';
            if($access){
                echo'<button name="jointraining'.$i.'">join Training</button>';
            }else{
                echo'<button name="asktraining'.$i.'">Ask to join Training</button>';
            }
                echo'</form>
                </article>';
            $ts = new TrainingStatus();
            if(isset($_POST["jointraining".$i])) {
                $ts->__set('done', 0);
                $ts->__set('approved', 1);
                $tsm->storeTrainingstatus($ts, $id, $tid, $error);
            }
            if(isset($_POST["asktraining".$i])){
                $ts->__set('done',0);
                $ts->__set('approved',0);
                $tsm->storeTrainingstatus($ts, $id, $tid, $error);
            }

        }
        ?>
    </section>
</div>

<?php
include 'inc/footer.inc.php';
?>