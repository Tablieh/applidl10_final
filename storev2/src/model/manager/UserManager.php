<?php
namespace App\Model\Manager;

use App\Core\AbstractManager as AM;
use App\Core\ManagerInterface;

class UserManager extends AM implements ManagerInterface
{
    public function __construct(){
        parent::connect();
    }

    public function getAll(){
        return;
    }

    public function getOneById($id){
        return;
    }

    public function insertUser($mail, $pass){
        return $this->executeQuery(
            "INSERT INTO user (email, password, role) VALUES (:mail, :pass, 'ROLE_USER')",
            [
                "mail" => $mail,
                "pass" => $pass
            ]
        );
    }

    function getUserByEmail($mail){
        return $this->getOneOrNullResult(
            "App\Model\Entity\User",
            "SELECT * FROM user WHERE email = :mail",
            [
                "mail" => $mail
            ]
        );
    }

    function getPasswordByEmail($mail){
        return $this->getOneValue(
            "SELECT password FROM user WHERE email = :mail",
            [
                "mail" => $mail
            ]
        );
    }

}
