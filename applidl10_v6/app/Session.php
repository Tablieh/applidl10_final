<?php
    require_once "model/entity/User.php";
    require_once "model/entity/Product.php";

    abstract class Session
    {
        public static function getFlashes(){
            if(isset($_SESSION['messages'])){
                var_dump($_SESSION['messages']);
                unset($_SESSION['messages']);
            }
        }

        public static function addFlash($type, $message){
            if(!isset($_SESSION["messages"])){
                $_SESSION["messages"] = [];
            }
            if(!isset($_SESSION["messages"][$type])){
                $_SESSION["messages"][$type] = [];
            }
            $_SESSION["messages"][$type][] = $message;
        }

        public static function getUser(){
            if(isset($_SESSION["user"])){
                return $_SESSION["user"];
            }
            return null;
        }

        /**
         * Put the user param in session (aka. connect the user in the app)
         * 
         * @param User $user the user object to put in session         * 
         * @return void
         */
        public static function setUser($user){
            $_SESSION["user"] = $user;
        }

        public static function removeUser(){
            unset($_SESSION["user"]);
        }

        public static function hasRole($role){
            return isset($_SESSION["user"]) && $_SESSION["user"]->getRole() === $role;
        }

        public static function getCart(){
            return (isset($_SESSION["cart"]) && !empty($_SESSION["cart"])) ? $_SESSION["cart"] : null;
        }

        public static function addLineToCart($line){
            $_SESSION["cart"][] = $line;
        }
        
        public static function setQuantityToLine($num, $value){
            $_SESSION["cart"][$num]['qtt']+= $value;
            
        }
        public static function removeCartLine($num){
            unset($_SESSION["cart"][$num]);
        }

        public static function removeCart(){
            unset($_SESSION["cart"]);
        }

        public static function getCartQtt(){
            $qttTotal = 0;
    
            if(isset($_SESSION['cart'])){
                foreach($_SESSION['cart'] as $line){
                    $qttTotal+= $line['qtt'];
                }
            }
            return $qttTotal;
        }

    }