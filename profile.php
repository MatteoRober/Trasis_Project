<?php
session_start();

require('inc/db_functions.inc.php');
$title = "logs";
include 'inc/header.inc.php';


use Trasis\AccreditationManager;
use Trasis\LogsManagement;
use Trasis\TrainingManagement;
use Trasis\TrainingStatus;
use Trasis\TrainingStatusManagement;
Use Trasis\UserManagement;
if(!isset($_SESSION['user'])) {
    header("location: login.php");
}
$um = new UserManagement();
$tm = new TrainingManagement();
$tsm = new TrainingStatusManagement();
$lm = new LogsManagement();
$id = $_SESSION['user'];
$error = "";
$user = $um->getUserById($id,$error);

?>

<section class="profile-div">
    <img src="pics/trasis_icon.png" alt="Profile Image" class="profile-image">
    <h3 class="profile-name"><?php echo $user->__get("name")?></h3>
    <h3 class="profile-surname"><?php echo $user->__get("surname")?></h3>
    <p class="profile-email"><?php echo $user->__get("mail")?></p>
    <p class="profile-name">accreditations:</p>
    <span class="profile-email">
    <?php
    $am = new AccreditationManager();
    $accreditations = $am->getUserAccreditations($id,$error);
    $accrstr = "";
    foreach($accreditations as $accreditation){
         $accrstr .= $accreditation->__get('name').', ';
    }
    echo substr($accrstr,0,-2);

    ?>
    </span>

</section>
<?php
include 'inc/footer.inc.php';
?>