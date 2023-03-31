<?php
session_start();

require('inc/db_functions.inc.php');

use Trasis\AccreditationManager;
Use Trasis\UserManagement;
use Trasis\RoleManagement;
use Trasis\FunctionManagement;

if(!isset($_SESSION['user'])) {
    header("location: login.php");
}

$message = "";
$accreditaitons = "";

$um = new UserManagement();
$user = $um->getUserById($_SESSION['user'],$message);

$am = new AccreditationManager();
$userAccreditations = $am->getUserAccreditations($_SESSION['user'], $message);

$rm = new RoleManagement();
$role = $rm->getRoleById($user->__get('role_id'), $message);

$fm = new FunctionManagement();
$functions = $fm->getUserFunctions($_SESSION['user'], $message);

$title = "Profile";
include 'inc/header.inc.php';
?>
<main>
    <h1>Profile</h1>
    <div class="profile-box">
        <form class="profile-form">
            <label for="name">Name :</label>
            <input id="name" type="text" value="<?php echo $user->__get("name")?>" disabled>
            <label for="surname">Surname :</label>
            <input id="surname" type="text" value="<?php echo $user->__get("surname")?>" disabled>
            <label for="mail">Mail :</label>
            <input id="mail" type="text" value="<?php echo $user->__get("mail")?>" disabled>
            <label for="role">Role :</label>
            <input id="role" type="text" value="<?php echo $role->__get("name")?>" disabled>
            <label for="functions">Function(s) :</label>
            <div class="profile-functions">
                <?php foreach($functions as $function) { ?>
                    <input type="text" id="functions" value="<?php echo $function->__get('name'); ?>" disabled>
                <?php } ?>
            </div>
            <label for="accreditations">Accreditation(s) :</label>
            <div class="profile-accreditations">
                <?php foreach($userAccreditations as $userAccreditation) { ?>
                    <input type="text" id="accreditations" value="<?php echo $userAccreditation->__get('name'); ?>" disabled>
                <?php } ?>
            </div>
        </form>
    </div>
</main>
<?php
include 'inc/footer.inc.php';
?>