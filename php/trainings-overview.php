<?php
$title = "Trasis - Trainings overview";
include '../inc/header.php'
?>

<div class="flex-trainigscards">
    <?php
    //mockdata:
    $titleOfTraining = "Title of training";
    $decription = "Description of training";
    $trainer = "Trainer of training";
    $prerequisites = "Prerequisites of training";
    $duration = "Duration of training";
    $accreditation = "Accreditation of training";
    include '../inc/trainingcard.php'?>
    <?php
    //mockdata:
    $titleOfTraining = "HR Training";
    $decription = "Description of training";
    $trainer = "Trainer of training";
    $prerequisites = "Prerequisites of training";
    $duration = "Duration of training";
    $accreditation = "Accreditation of training";
    include '../inc/trainingcard.php'?>
</div>


<?php include '../inc/footer.php'?>
