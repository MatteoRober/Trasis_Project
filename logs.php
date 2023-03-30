<?php
session_start();

require('inc/db_functions.inc.php');
$title = "logs";
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
$lm = new LogsManagement();
$id = $_SESSION['user'];
$error = "";
$user = $um->getUserById($id,$error);

?>

<section class="logsdiv">
    <?php
        $logs = $lm->getallogs();
        $logs = array_reverse( $logs);
    foreach ($logs as $log){
            $dateheure = $log->__get('dateheure');
            $description = $log->__get('description');
        echo"<p>[$dateheure] $description </p>";
        }

    ?>


</section>
