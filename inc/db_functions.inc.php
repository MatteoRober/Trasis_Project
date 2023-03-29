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

    public function existsInDB($mail, &$message){
        $result = false;
        $bdd    = null;
        try {
            $bdd  = DBLink::connect2db(MYDB, $message);
            $stmt = $bdd->prepare("SELECT * FROM tasis_user WHERE mail = :mail");
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
}