<?php
$title = "Trasis - trainings";
include '../inc/headerC.inc.php';
require ('../inc/db_functions.inc.php');

use Trasis\TrainingManagement;
Use Trasis\UserManagement;
$um = new UserManagement();
$tm = new TrainingManagement();
$id = 2; // TODO replace with SESSION_["user"]
$error = "";
$user = $um->getUserById($id,$error);

?>

<body>

<h1 class ="centered_titles push_top">My Trainings</h1>
<div class = "trainings_form">
            <section>
                <?php

                $trainings2 = $tm->getNotRegisteredTrainingsForUserWithId($id,$error);
                for($j = 0;$j<count($trainings2);$j++){
                    $training2 = $trainings2[$j];
                    $id2 = $training2->__get('training_id');
                    $title2 = $training2->__get('name');
                    $duration2 = $training2->__get('duration');
                    $validity2 = $training2->__get('validity');

                    echo
                        '<article>
                    <img src="../pics/1+1=3.jpeg" alt="1+1=3">
                    <h3>  '.$title2.' </h3>
                    <span>duration:'.$duration2.' hours</span>
                    <br>
                    <span>validity:'.$validity2.' days</span>
                    </article>';
                }
                ?>

            </section>
</div>
<h1 class ="centered_titles push_top">available trainings</h1>
<div class = "trainings_form">
    <section>
        <?php

        $error = "";
        $trainings = $tm->getNotDoneTrainingsForUserWithId($id,$error);
        for($i = 0;$i<count($trainings);$i++){
            $training = $trainings[$i];
            $id = $training->__get('training_id');
            $title = $training->__get('name');
            $duration = $training->__get('duration');
            $validity = $training->__get('validity');

            echo
                '<article>
                    <img src="../pics/1+1=3.jpeg" alt="1+1=3">
                    <h3>  '.$title.' </h3>
                    <span>duration:'.$duration.' hours</span>
                    <br>
                    <span>validity:'.$validity.' days</span>
                    </article>';
        }
        ?>
    </section>
</div>
</body>
</html>