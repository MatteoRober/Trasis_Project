<?php
session_start();

require('inc/db_functions.inc.php');

use Trasis\TrainingManagement;

if (!isset($_SESSION['user'])) {
    header("location: login.php");
}

$title = 'Manage trainings';
include 'inc/header.inc.php';

$message = "";
$uid = $_SESSION['user'];

$tm = new TrainingManagement();

if (isset($_POST['submit'])) {
    if (!(empty($_POST['name']) || empty($_POST['description']) || empty($_POST['duration']) || empty($_POST['validity']))) {
        $tm->addTraining($_POST['name'], $_POST['description'], $_POST['duration'], $_POST['validity'], $message);
    }
}

?>
<main>
    <h1>Manage trainings</h1>
    <?php include 'inc/dashboardNav.inc.php'; ?>
    <h2>Add training</h2>
    <form class="addUser" action="" method="post">
        <label for="name" hidden>name</label>
        <input type="text" name="name" id="name" placeholder="Training name" autocomplete="off" value="">
        <label for="description" hidden>description</label>
        <input type="text" name="description" id="description" placeholder="Training description" autocomplete="off" value="">
        <label for="duration" hidden>duration</label>
        <input type="text" name="duration" id="duration" placeholder="Training duration" autocomplete="off" value="">
        <label for="validity" hidden>validity</label>
        <input type="text" name="validity" id="validity" placeholder="Training validity" autocomplete="off" value="">
        <button class="addForm" name="submit">Add training</button>
    </form>
    <table class="infos-table">
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Duration</th>
            <th>Validity</th>
            <th>Number students</th>
        </tr>
    <?php
    $trainings = $tm->getAllTrainings($message);
    foreach ($trainings as $training) {
        echo '<tr>';
        echo '<td>' . $training->__GET("name") . '</td>
              <td>' . $training->__GET("description") . '</td>
              <td>' . $training->__GET("duration") . '</td>
              <td>' . $training->__GET("validity") . '</td>
              <td>' . $tm->getNumberStudent($training->__GET("training_id"), $message) . '</td>';
        echo '</tr>';
    }
    ?>
    </table>
</main>
<?php
include 'inc/footer.inc.php';
?>
