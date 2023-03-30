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

$title = "Trasis - Trainings";
include 'inc/headerC.inc.php';
?>

<h1 class ="centered_titles push_top">My Trainings</h1>
<div class = "trainings_form">
        <section>
            <?php
            //TODO: get all my trainings

            $error = "";
            $trainings = $tm->getNotRegisteredTrainingsForUserWithId($id,$error);
            for($i = 0;$i<count($trainings);$i++){
                $id = $trainings[$i][0];
                $title = $trainings[$i][1];
                $duration = $trainings[$i][2];
                $validity = $trainings[$i][3];

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
        //TODO: get all available trainings

        $length = 5;//to change to amount of trainings i have
        for($i = 0;$i<$length;$i++){
            $title = "to change";
            $description = "to change but longer";
            echo
            '<article>
                <img src="pics/1+1=3.jpeg" alt="1+1=3">
                <h3>Quantum Physics</h3>
                <p>so easy to learn quantum Physics</p>
            </article>';
        }
        ?>
    </section>
</div>

<?php
include 'inc/footerC.inc.php';
?>