<?php
require('../../inc/db_functions.inc.php');

use Trasis\User;
use Trasis\UserManagement;

$title = 'My courses';
include '../../inc/header.php';
include 'dashboard_nav.php';
?>
    <main>
        <h1>Training courses</h1>
        <table>
            <tr>
                <th>Title</th>
                <th>Trainer</th>
                <th>Duration</th>
                <th>Validity (month)</th>
                <th>Date</th>
                <th>Status</th>
            </tr>
            <?php
            //For each course the user have planned or completed, display the course details in a table row
            echo '<tr>';
            for () {
                echo '<td></td><br>
                      <td></td><br>
                      <td></td><br>
                      <td></td><br>
                      <td></td><br>';
                //If the course is planned, display "Planned" in the status column, otherwise display "Completed"
                if (TRUE) {
                    echo '<td>Planned</td>';
                } else {
                    echo '<td>Completed</td>';
                }
            }
            '</tr>';
            ?>
        </table>
    </main>
<?php
include '../../inc/footer.php';
?>