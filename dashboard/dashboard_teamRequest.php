<?php
session_start();

require('../inc/db_functions.inc.php');

use Trasis\Training;
use Trasis\TrainingManagement;

$message = "";

$title = 'Team requests';
include '../inc/header.inc.php';
include 'dashboard_nav.php';
?>
<main>
    <h1>Team requests</h1>
    <table>
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Duration</th>
            <th>Team member</th>
            <th>Accept / Refuse</th>
        </tr>
        <?php

        ?>
</main>
<?php
include '../inc/footer.inc.php';
?>
