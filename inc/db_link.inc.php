<?php
namespace DB;
require 'config.inc.php';
use PDO;
use PDOException;

/**
 * Classe DBLink : gestionnaire de la connexion à la base de données
 * @author Vincent MARTIN
 * @version 2.0
 */
class DBLink {
    /**
     * connect to database
     * @var string $message message to return to the user if error, will be concatenated with PDO message
     * @return PDO|false pdo object | error message if error
     */
    public static function connect2db(&$message){
        try {

            $link = new PDO('mysql:host=' . MYHOST . ';dbname=' . MYDB . ';charset=UTF8', MYUSER, MYPASS);
            $link->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
            $link->exec("set names utf8");
            $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            $message .= $e->getMessage().'<br>';
            $link = false;
        }
        return $link;
    }

    /**
     * disconnect from database
     * @var PDO $link database link object
     */
    public static function disconnect (&$link) {
        $link = null;
    }
}

?>