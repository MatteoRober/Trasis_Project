<?php
session_start();

require('inc/db_functions.inc.php');

use Trasis\TrainingManagement;
Use Trasis\UserManagement;
$um = new UserManagement();
$tm = new TrainingManagement();
$id = 4; // TODO replace with SESSION_["user"]
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
                    <img src="pics/1+1=3.jpeg" alt="1+1=3">
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

            echo
                '<article>
                    <img src="pics/1+1=3.jpeg" alt="1+1=3">
                    <h3>  ' .$title.' </h3>
                    <span>duration:'.$duration.' hours</span>
                    <span>validity:'.$validity.' days</span>
                   ';
            if($um->hasAccessToTraining($id,$tid,$error)){
                echo'<button>join Training</button>';
            }else{
                echo'<button>Ask to join Training</button>';
            }
                echo'</article>';
        }
        ?>
    </section>
</div>
<?php
include 'inc/footer.inc.php';
?>