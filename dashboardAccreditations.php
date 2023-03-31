<?php
session_start();

require('inc/db_functions.inc.php');

use Trasis\AccreditationManager;
use Trasis\TrainingManagement;

if(!isset($_SESSION['user'])) {
    header("location: login.php");
}

$message = "";
$uid = $_SESSION['user'];

$am = new AccreditationManager();
$accreditations = $am->getAllAccreditations($message);

$tm = new TrainingManagement();

$title = 'Accreditations';
include 'inc/header.inc.php';
?>
<main>
    <h1>Accreditations</h1>
    <?php include 'inc/dashboardNav.inc.php';?>
    <table class="infos-table">
        <tr>
            <th>Title</th>
            <th>Needed Trainings</th>
        </tr>
        <?php
        //Display the title of each accreditation the user has with the different courses he has completed
        foreach ($accreditations as $accreditation) {
            $trainings = $tm->getAccreditationTrainings($accreditation->__get('accreditation_id'), $message);
            $neededTrainings = "";
            foreach ($trainings as $training) {
                $neededTrainings .= $training->__get('name') . ', ';
            }
            echo '<tr>
                    <td>' . $accreditation->__get('name') . '</td>
                    <td>'. substr($neededTrainings, 0, -2) .'</td>
            </tr>';
        }
        ?>
    </table>
</main>
<?php
include 'inc/footer.inc.php';
?>
