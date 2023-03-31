<?php

use Trasis\RoleManagement;
use Trasis\UserManagement;
$user = "";
$role = "";

if (isset($_SESSION['user'])) {
    $um = new UserManagement();
    $user = $um->getUserById($_SESSION['user'], $message);

    $rm = new RoleManagement();
    $role = $rm->getRoleById($user->__get('role_id'), $message);
}
?>
<nav class="nav-dashboard">
    <a href="dashboardTraining.php">My courses</a>
    <a href="dashboardProgress.php">Progress of training courses</a>
    <a href="dashboardAccreditations.php">Accreditations</a>
    <a href="dashboardExpiringTraining.php">Expiring training courses</a>
    <?php
    if($role->__get('role_id') == 3) {
        echo '<a href="dashboardTeamRequest.php">Team requests</a>';
    } elseif ($role->__get('role_id') == 2) {
        echo '<a href="dashboardTrainingManager.php">Training manager</a>';
    }
    ?>
</nav>