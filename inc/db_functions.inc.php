<?php
namespace Trasis;
require 'db_link.inc.php';

use DB\DBLink;
use Exception;
use PDO;

setlocale(LC_TIME, 'en_EN.utf8','eng');

/**
 * Class User : User registered in Trasis
 * @author Noa DOCQUIER
 * @version 1.0
 */
class User {
    private $user_id;
    private $name;
    private $surname;
    private $password;
    private $enabled;
    private $mail;

    public function __get($prop){
        return $this->$prop;
    }
    public function __set($prop, $val){
        $this->$prop = $val;
    }
}

/**
 * Class UserManagement : User Manager of Trasis
 * @author Noa DOCQUIER
 * @version 1.0
 */
class UserManagement {

    public function hasAccessToTraining($user_id,$training_id,&$message){
        $result = false;
        $bdd = null;
        try {
            $bdd = DBLink::connect2db(MYDB, $message);
            $stmt = $bdd->prepare("SELECT * FROM authorises WHERE training_id = :training_id");
            $stmt->bindValue(":training_id",$training_id);
            $stmt->execute();
            if(!$stmt->fetch()){
                return true;
            }
            $stmt = $bdd->prepare("SELECT * FROM `trasis_training` 
            JOIN authorises ON trasis_training.training_id = authorises.training_id 
            JOIN trasis_function on trasis_function.function_id = authorises.function_id 
            JOIN identifies on trasis_function.function_id = identifies.function_id 
            JOIN trasis_user on identifies.user_id = trasis_user.user_id
            WHERE trasis_training.training_id = :training_id AND trasis_user.user_id = :user_id");
            $stmt->bindValue(':training_id', $training_id);
            $stmt->bindValue(':user_id', $user_id);
            if ($stmt->execute()) {
                if ($stmt->fetch() !== false) {
                    $result = true;
                }
            } else {
                $message .= 'An error has occured.<br> Please try again later or try to contact the administrator of the website (Error code E: ' . $stmt->errorCode() . ')<br>';
            }
            $stmt = null;
        } catch (Exception $e) {
            $message .= $e->getMessage() . '<br>';
        }
        DBLink::disconnect($bdd);
        return $result;
    }
    public function getUserById($uid, &$message){
        $result = null;
        $bdd    = null;
        try {
            $bdd  = DBLink::connect2db(MYDB, $message);
            $stmt = $bdd->prepare("SELECT * FROM nd5_utilisateurs WHERE uid = :uid;");
            $stmt->bindValue(':uid', $uid);
            if ($stmt->execute()){
                $result = $stmt->fetchObject("NoDebt\User");
            } else {
                $message .= 'Une erreur système est survenue.<br> Veuillez essayer à nouveau plus tard ou contactez l\'administrateur du site. (Code erreur: ' . $stmt->errorCode() . ')<br>';
            }
            $stmt = null;
        } catch (Exception $e) {
            $message .= $e->getMessage().'<br>';
        }
        DBLink::disconnect($bdd);
        return $result;
    }
    public function existsInDB($mail, &$message){
        $result = false;
        $bdd    = null;
        try {
            $bdd  = DBLink::connect2db(MYDB, $message);
            $stmt = $bdd->prepare("SELECT * FROM trasis_user WHERE mail = :mail");
            $stmt->bindValue(':mail', $mail);
            if ($stmt->execute()){
                if($stmt->fetch() !== false){
                    $result = true;
                }
            } else {
                $message .= 'An error has occured.<br> Please try again later or try to contact the administrator of the website (Error code E: ' . $stmt->errorCode() . ')<br>';
            }
            $stmt = null;
        } catch (Exception $e) {
            $message .= $e->getMessage().'<br>';
        }
        DBLink::disconnect($bdd);
        return $result;
    }

    public function storeUser($user, &$message)
    {
        $noError = false;
        $bdd = null;
        try {
            $bdd = DBLink::connect2db(MYDB, $message);
            $stmt = $bdd->prepare("INSERT INTO trasis_user (name, surname, password, enabled, mail) VALUES (:name, :surname, :password, :enabled, :mail)");
            $stmt->bindValue(':name', $user->__get('name'));
            $stmt->bindValue(':surname', $user->__get('surname'));
            $stmt->bindValue(':password', $user->__get('password'));
            $stmt->bindValue(':enabled', $user->__get('enabled'));
            $stmt->bindValue(':mail', $user->__get('mail'));
            if ($stmt->execute()) {
                $message .= "Your account was created successfully.<br>";
                $noError = true;
            } else {
                $message .= 'An error has occured.<br> Please try again later or try to contact the administrator of the website (Error code E: ' . $stmt->errorCode() . ')<br>';
            }
            $stmt = null;
        } catch (Exception $e) {
            $message .= $e->getMessage() . '<br>';
        }
        DBLink::disconnect($bdd);
        return $noError;
    }

    public function getUserByMail($mail, &$message){
        $result = null;
        $bdd    = null;
        try {
            $bdd  = DBLink::connect2db(MYDB, $message);
            $stmt = $bdd->prepare("SELECT * FROM trasis_user WHERE mail = :mail;");
            $stmt->bindValue(':mail', $mail);
            if ($stmt->execute()){
                $result = $stmt->fetchObject("Trasis\User");
            } else {
                $message .= 'An error has occured.<br> Please try again later or try to contact the administrator of the website (Error code E: ' . $stmt->errorCode() . ')<br>';
            }
            $stmt = null;
        } catch (Exception $e) {
            $message .= $e->getMessage().'<br>';
        }
        DBLink::disconnect($bdd);
        return $result;
    }

    function rand_password(){
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
        $password = substr( str_shuffle( $chars ), 0, 12);
        $hashedpassword= password_hash($password, PASSWORD_BCRYPT);
        //returned in array this way you can send the
        //plain text password to the user
        //add the hashed password to the database
        return array($password, $hashedpassword);
    }
}

/**
 * Classe Training : Training of Trasis
 * @author Noa DOCQUIER
 * @version 1.0
 */
class Training {
    private $training_id;
    private $name;
    private $duration;
    private $validity;

    public function __get($prop){
        return $this->$prop;
    }

    public function __set($prop, $val){
        $this->$prop = $val;
    }
}
/**
 * Classe GroupManagement : Gestionnaire des groupes de NoDebt
 * @author Noa DOCQUIER
 * @version 1.0
 */
class TrainingManagement
{

    public function existsInDB($training_id, &$message)
    {
        $result = false;
        $bdd = null;
        try {
            $bdd = DBLink::connect2db(MYDB, $message);
            $stmt = $bdd->prepare("SELECT * FROM trasis_training WHERE training_id = :training_id");
            $stmt->bindValue(':training_id', $training_id);
            if ($stmt->execute()) {
                if ($stmt->fetch() !== false) {
                    $result = true;
                }
            } else {
                $message .= 'An error has occured.<br> Please try again later or try to contact the administrator of the website (Error code E: ' . $stmt->errorCode() . ')<br>';
            }
            $stmt = null;
        } catch (Exception $e) {
            $message .= $e->getMessage() . '<br>';
        }
        DBLink::disconnect($bdd);
        return $result;
    }

    public function getTrainingById($training_id, &$message)
    {
        $result = null;
        $bdd = null;
        try {
            $bdd = DBLink::connect2db(MYDB, $message);
            $stmt = $bdd->prepare("SELECT * FROM trasis_training WHERE training_id = :training_id;");
            $stmt->bindValue(':training_id', $training_id);
            if ($stmt->execute()) {
                $result = $stmt->fetchObject("Trasis\Training");
            } else {
                $message .= 'An error has occured.<br> Please try again later or try to contact the administrator of the website (Error code E: ' . $stmt->errorCode() . ')<br>';
            }
            $stmt = null;
        } catch (Exception $e) {
            $message .= $e->getMessage() . '<br>';
        }
        DBLink::disconnect($bdd);
        return $result;
    }

    /**
     * Return all the trainings of the user
     * @param $id : id of the user
     * @param $message : message to display
     * @return array : array of trainings
     */
    public function getAllTrainingsForUserWithId($user_id, $message) {
        $result = array();
        $bdd = null;
        try {
            $bdd = DBLink::connect2db(MYDB, $message);
            $stmt = $bdd->prepare("SELECT * FROM trasis_training WHERE training_id IN (SELECT training_id FROM trasis_training_status WHERE user_id = :user_id AND approved = 1)");
            $stmt->bindValue(':user_id', $user_id);
            if ($stmt->execute()) {
                $result = $stmt->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "Trasis\Training");
            }
        } catch (Exception $e) {
            $message .= $e->getMessage() . '<br>';
        }
        DBLink::disconnect($bdd);
        return $result;
    }

    public function getDoneTrainingsForUserWithId($user_id, $message) {
        $result = array();
        $bdd = null;
        try {
            $bdd = DBLink::connect2db(MYDB, $message);
            $stmt = $bdd->prepare("SELECT * FROM trasis_training WHERE training_id IN (SELECT training_id FROM trasis_training_status WHERE user_id = :user_id AND done = 1 AND approved = 1)");
            $stmt->bindValue(':user_id', $user_id);
            if ($stmt->execute()) {
                $result = $stmt->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "Trasis\Training");
            }
        } catch (Exception $e) {
            $message .= $e->getMessage() . '<br>';
        }
        DBLink::disconnect($bdd);
        return $result;
    }

    public function getNotDoneTrainingsForUserWithId($user_id, $message) {
        $result = array();
        $bdd = null;
        try {
            $bdd = DBLink::connect2db(MYDB, $message);
            $stmt = $bdd->prepare("SELECT * FROM trasis_training WHERE training_id IN (SELECT training_id FROM trasis_training_status WHERE user_id = :user_id AND done = 0 AND approved = 1)");
            $stmt->bindValue(':user_id', $user_id);
            if ($stmt->execute()) {
                $result = $stmt->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "Trasis\Training");
            }
        } catch (Exception $e) {
            $message .= $e->getMessage() . '<br>';
        }
        DBLink::disconnect($bdd);
        return $result;
    }
    public function getNotRegisteredTrainingsForUserWithId($user_id, $message) {
        $result = array();
        $bdd = null;
        try {
            $bdd = DBLink::connect2db(MYDB, $message);
            $stmt = $bdd->prepare("SELECT * FROM trasis_training WHERE training_id NOT IN (SELECT training_id FROM trasis_training WHERE training_id IN (SELECT training_id FROM trasis_training_status WHERE user_id = :user_id))");
            $stmt->bindValue(':user_id', $user_id);
            if ($stmt->execute()) {
                $result = $stmt->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "Trasis\Training");
            }
        } catch (Exception $e) {
            $message .= $e->getMessage() . '<br>';
        }
        DBLink::disconnect($bdd);
        return $result;
    }
    public function isDone($training_id, $user_id, &$message) {
        $result = false;
        $bdd = null;
        try {
            $bdd = DBLink::connect2db(MYDB, $message);
            $stmt = $bdd->prepare("SELECT * FROM trasis_training_status WHERE training_id = :training_id AND user_id = :user_id AND done = 1");
            $stmt->bindValue(':training_id', $training_id);
            $stmt->bindValue(':user_id', $user_id);
            if ($stmt->execute()) {
                if ($stmt->fetch() !== false) {
                    $result = true;
                }
            } else {
                $message .= 'An error has occured.<br> Please try again later or try to contact the administrator';
            }
        } catch (Exception $e) {
            $message .= $e->getMessage() . '<br>';
        }
        DBLink::disconnect($bdd);
        return $result;
    }

    public function getCompletionDate($training_id, $user_id, $message) {
        $result = null;
        $bdd = null;
        try {
            $bdd = DBLink::connect2db(MYDB, $message);
            $stmt = $bdd->prepare("SELECT finishing_date FROM trasis_training_status WHERE training_id = :training_id AND user_id = :user_id");
            $stmt->bindValue(':training_id', $training_id);
            $stmt->bindValue(':user_id', $user_id);
            if ($stmt->execute()) {
                $result = $stmt->fetch();
            } else {
                $message .= 'An error has occured.<br> Please try again later or try to contact the administrator';
            }
        } catch (Exception $e) {
            $message .= $e->getMessage() . '<br>';
        }
        DBLink::disconnect($bdd);
        return $result;
    }
}

/**
 * Class Role : Role of the User
 * @author Noa DOCQUIER
 * @version 1.0
 */
class Role {
    private $role_id;
    private $name;

    public function __get($prop){
        return $this->$prop;
    }
    public function __set($prop, $val){
        $this->$prop = $val;
    }
}

/**
 * Class RoleManagement : Role Manager of Users
 * @author Noa DOCQUIER
 * @version 1.0
 */
class RoleManagement {

}

/**
 * Class Team : Team of the User
 * @author Noa DOCQUIER
 * @version 1.0
 */
class Team {
    private $team_id;
    private $name;

    public function __get($prop){
        return $this->$prop;
    }
    public function __set($prop, $val){
        $this->$prop = $val;
    }
}

/**
 * Class TeamManagement : Team Manager of Users
 * @author Noa DOCQUIER
 * @version 1.0
 */
class TeamManagement {

}

/**
 * Class UserFunction : Function of the User
 * @author Noa DOCQUIER
 * @version 1.0
 */
class UserFunction {
    private $function_id;
    private $name;

    public function __get($prop){
        return $this->$prop;
    }
    public function __set($prop, $val){
        $this->$prop = $val;
    }
}

/**
 * Class FunctionManagement : Function Manager of Users
 * @author Noa DOCQUIER
 * @version 1.0
 */
class FunctionManagement {

}

/**
 * Class TrainingStatus : Status of a Training
 * @author Noa DOCQUIER
 * @version 1.0
 */
class TrainingStatus {
    /*
    private $status_id;
    private $done;
    private $approved;
    private $finished_date;
    private $user_id;
    private $training_id;
    */
    private $trainingStatus_id;
    private $done;
    private $approved;

    public function __get($prop){
        return $this->$prop;
    }
    public function __set($prop, $val){
        $this->$prop = $val;
    }
}

/**
 * Class TrainingStatusManagement : Status Manager of Trainings
 * @author Noa DOCQUIER
 * @version 1.0
 */
class TrainingStatusManagement {
    public function storeTrainingstatus($trainingstatus,$userid,$trainingid,$message){
        $noError = false;
        $bdd = null;
        try {
            $bdd = DBLink::connect2db(MYDB, $message);
            $stmt = $bdd->prepare("INSERT INTO trasis_training_status ( done, approved, training_id, user_id) VALUES (:done, :approved, :training_id, :user_id)");
            $stmt->bindValue(':done', $trainingstatus->__get('done'));
            $stmt->bindValue(':approved', $trainingstatus->__get('approved'));
            $stmt->bindValue(':training_id', $trainingid);
            $stmt->bindValue(':user_id', $userid);
            if ($stmt->execute()) {
                $message .= "TrainingStatus created successfully.<br>";
                $noError = true;
            } else {
                $message .= 'An error has occured.<br> Please try again later or try to contact the administrator of the website (Error code E: ' . $stmt->errorCode() . ')<br>';
            }
            $stmt = null;
        } catch (Exception $e) {
            $message .= $e->getMessage() . '<br>';
        }
        DBLink::disconnect($bdd);
        return $message;
    }
}