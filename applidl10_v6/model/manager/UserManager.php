<?php
    require_once "app/AbstractManager.php";
    require_once "model/entity/User.php";

    class UserManager extends AbstractManager
    {
        public function __construct(){
            parent::connect();
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
                "User",
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
