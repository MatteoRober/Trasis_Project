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
<nav>
    <a href="dashboardTraining.php">My courses</a>
    <a href="dashboardSummary.php">Summary completed courses</a>
    <a href="dashboardProgress.php">Progress of training courses</a>
    <a href="dashboardAccreditations.php">Accreditations</a>
    <a href="dashboardExpiringTraining.php">Expiring training courses</a>
    <?php
    if($role->__get('role_id') == 3) {
        echo '<li><a href="dashboardTeamRequests.php">Team Requests</a></li>';
    } elseif ($role->__get('role_id') == 2) {
        echo '<li><a href="dashboardTrainingManager.php">Team Requests</a></li>';
    }
    ?>
</nav>