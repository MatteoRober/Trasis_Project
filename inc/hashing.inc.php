<?php
namespace Trasis;

setlocale(LC_TIME, 'en_EN.utf8','eng');

class hashing{
    public function hashPassword($password) {
        $hash = password_hash($password, PASSWORD_BCRYPT);
        return $hash;
    }

    public function verifyPassword($password, $hash) {
        $result = password_verify($password, $hash);
        return $result;
    }
}

?>