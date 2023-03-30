<?php
session_start();

require('../../inc/db_functions.inc.php');

$title = 'Accreditations';
include '../inc/header.php';
include "dashboard_nav.php";
?>
<main>
    <h1>Accreditations</h1>
    <table>
        <tr>
            <th>Title</th>
        </tr>
        <?php
        //TODO import the list of accreditations the user has
        $accreditations = array();
        //Display the title of each accreditation the user has with the different courses he has completed
        echo '<tr>';
        foreach ($accreditations as $accreditation) {
            echo '<td></td><br>';
        }
        echo '</tr>';
        ?>
    </table>
</main>
<?php
include '../inc/footer.php';
?>
