<?php
session_start();

require('inc/db_functions.inc.php');

use Trasis\AccreditationManager;

if(!isset($_SESSION['user'])) {
    header("location: login.php");
}

$message = "";
$uid = $_SESSION['user'];

$title = 'Accreditations';
include 'inc/header.inc.php';
?>
<main>
    <h1>Accreditations</h1>
    <?php include 'inc/dashboardNav.inc.php';?>
    <table>
        <tr>
            <th>Title</th>
        </tr>
        <?php
        $accreditationManager = new AccreditationManager();
        $accreditations = $accreditationManager->getUserAccreditations($uid, $message);
        //Display the title of each accreditation the user has with the different courses he has completed
        foreach ($accreditations as $accreditation) {
            echo '<tr>';
            echo '<td>' . $accreditation->__GET('name') . '</td><br>';
            echo '</tr>';
        }
        ?>
    </table>
</main>
<?php
include 'inc/footer.inc.php';
?>
