<?php
    require "app/AbstractController.php";
    require "model/manager/ProductManager.php";

    class AdminController extends AbstractController
    {
        public function __construct(){
            $this->manager = new ProductManager();
        }

        public function index(){
            $products = $this->manager->getProducts();

            return $this->render("admin/admin.php", [
                "products" => $products,
                "title"    => "Administration"
            ]);
        }

        public function addprod(){
            if(isset($_POST["submit"])){

                $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
                $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                $descr = filter_input(INPUT_POST, "descr", FILTER_SANITIZE_STRING);
                
                if($name && $price && $descr){
                    
                    if($this->manager->insertProduct($name, $descr, $price)){
                        Session::addFlash('success', "Produit ".$name." ajouté en base de données !");
                    }
                    else{
                        Session::addFlash('error', "Une erreur est survenue, contactez l'administrateur...");
                    }
                }
                else Session::addFlash('error', "Tous les champs doivent être remplis et respecter leur format...");
            }
            else Session::addFlash('error', "Petit malin, mais ça marche pas !! Nananèèèèreuh !");
            
            return $this->redirectToRoute("admin");
        }

        public function deleteprod($id){
            if($id){
                $product = $this->manager->getOneProduct($id);
                if($this->manager->deleteProduct($id)){
                    Session::addFlash('success', "Le produit ".$product->getName()." supprimé de la base de données !");
                }
                else{
                    Session::addFlash('error', "Une erreur est survenue, contactez l'administrateur...");
                }
            }
            else Session::addFlash('error', "Une erreur est survenue, contactez l'administrateur...");
            
            return $this->redirectToRoute("admin");
        }

        public function available($id){

            if($id){
                $product = $this->manager->getOneProduct($id);
                if($product->getAvailable()){
                    $this->manager->setAvailable($id, false);
                    Session::addFlash('error', "Produit desactivé !");
                }
                else{
                    $this->manager->setAvailable($id, true);
                    Session::addFlash('success', "Produit activé !");
                }
            }

            return $this->redirectToRoute("admin");
        }
    }