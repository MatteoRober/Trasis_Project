<?php
session_start();

require('inc/db_functions.inc.php');

$message = "";

$title = 'Team requests';
include 'inc/header.inc.php';
include 'inc/dashboardNav.inc.php';
?>
<div class="page-border">
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
</div>
<?php
include 'inc/footer.inc.php';
?>
