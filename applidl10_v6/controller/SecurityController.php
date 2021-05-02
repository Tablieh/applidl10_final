<?php
    require_once "app/AbstractController.php";
    require_once "model/manager/UserManager.php";

    class SecurityController extends AbstractController
    {
        public function __construct(){
            $this->manager = new UserManager();
        }
        /**
         * display the login form or compute the login action with post data
         * 
         * @return mixed the render of the login view or a Router redirect (if login action succeeded)
         */
        public function login(){
            if(isset($_POST["submit"])){
                sleep(1);
                $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
                $password = filter_input(INPUT_POST, "password", FILTER_VALIDATE_REGEXP, [
                    "options" => [
                        "regexp" => "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,}$/"
                        //au moins 6 caractères, MAJ, min et chiffre obligatoires
                    ]
                ]);

                if($email && $password){
                    if($user = $this->manager->getUserByEmail($email)){//on récupère l'user si l'email saisi correspond en BDD
                        if(password_verify($password, $this->manager->getPasswordByEmail($email))){
                            Session::setUser($user);
                            Session::addFlash('success', "Bienvenue !");
                            
                            return $this->redirectToRoute("store");
                        }
                        else Session::addFlash('error', "Le mot de passe est erroné");
                    }
                    else Session::addFlash('error', "E-mail inconnu !");
                }
                else Session::addFlash('error', "Tous les champs sont obligatoires et doivent respecter...");

            }

            return $this->render("user/login.php");
        }

        public function logout(){
            Session::removeUser();
            Session::addFlash('success', "Déconnexion réussie, à bientôt !");
            return $this->redirectToRoute("store");
        }

        public function register(){
            if(isset($_POST["submit"])){
                sleep(1);
                $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
                $password = filter_input(INPUT_POST, "password", FILTER_VALIDATE_REGEXP, [
                    "options" => [
                        "regexp" => "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,}$/"
                        //au moins 6 caractères, MAJ, min et chiffre obligatoires
                    ]
                ]);
                $password_repeat = filter_input(INPUT_POST, "password_repeat", FILTER_DEFAULT);
                
                if($email && $password){
                    if(!$this->manager->getUserByEmail($email)){
                        if($password === $password_repeat){

                            $hash = password_hash($password, PASSWORD_ARGON2I);

                            if($this->manager->insertUser($email, $hash)){
                                Session::addFlash('success', "Inscription réussie, connectez-vous !");
                                
                                return $this->redirectToRoute("security", "login");
                            }
                            else Session::addFlash('error', "Une erreur est survenue...");
                        }
                        else{
                            Session::addFlash('error', "Les mots de passe ne correspondent pas !");
                            Session::addFlash('notice', "Tapez les mêmes mots de passe dans les deux champs !");
                        }
                    }
                    else Session::addFlash('error', "Cette adresse mail est déjà liée à un compte...");
                }
                else Session::addFlash('notice', "Les champs saisis ne respectent pas les valeurs attendues !");
            }

            return $this->render("user/register.php");
        }

        public function profile(){
            if(Session::getUser()){
                return $this->render("user/profile.php");
            }
            Session::addFlash('error', 'Access denied !');
            return $this->redirectToRoute("store");
        }
    }