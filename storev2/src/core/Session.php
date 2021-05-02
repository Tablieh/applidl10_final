<?php
    namespace App\Core;

    abstract class Session
    {
        /**
         * récupère tous les messages flash en session correspondant au type passé en paramètre
         * 
         * @param string $type - le type des messages à récupérer
         */
        public static function getFlashes($type){
            $messages = [];
            if(isset($_SESSION['messages'][$type])){
                $messages = $_SESSION['messages'][$type];
                unset($_SESSION['messages'][$type]);
            }
            return $messages;
        }

        /**
         * ajoute un message flash à la session
         * 
         * @param string $type - le type de message (ex: error, alert, success, notice...)
         * @param string $message - le message
         */
        public static function addFlash($type, $message){
            if(!isset($_SESSION["messages"])){
                $_SESSION["messages"] = [];
            }
            if(!isset($_SESSION["messages"][$type])){
                $_SESSION["messages"][$type] = [];
            }
            $_SESSION["messages"][$type][] = $message;
        }

        /**
         * récupère le contenu de l'entrée en session voulue
         * 
         * @param string $key - la clé de l'entrée de session 
         * 
         * @return mixed|null la valeur de l'entrée demandée
         */
        public static function get($key){
            if(isset($_SESSION[$key])){
                return $_SESSION[$key];
            }
            return null;
        }

        /**
         * crée une entrée en session correspondant à la clé et la valeur données
         * 
         * @param string $key - la clé à créer en session
         * @param mixed $value - la valeur à y associer
         * @return void
         */
        public static function set($key, $value){
            $_SESSION[$key] = $value;
        }

        public static function remove($key){
            unset($_SESSION[$key]);
        }
        /* CSRF PROTECTION */
        public static function generateKey(){
            if(!isset($_SESSION['key']) || $_SESSION['key'] === null){
                $_SESSION['key'] = bin2hex(random_bytes(32));
            }
            return $_SESSION['key'];
        }

        public static function eraseKey(){
            unset($_SESSION['key']);
            
        }
    }