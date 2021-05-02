<?php
    require "app/AbstractController.php";
    require "model/manager/ProductManager.php";

    class StoreController extends AbstractController
    {
        public function __construct(){
            $this->manager = new ProductManager();
        }

        public function index()
        {
            $products = $this->manager->getAvailableProducts();

            return $this->render("store/home.php", [
                "products" => $products,
                "title"    => "Liste des produits"
            ]);
        }

        public function voirProduit($id)
        {
            if($id){
                
                $product = $this->manager->getOneProduct($id);

                return $this->render("store/voir.php", [
                    "product" => $product,
                    "title"   => $product->getName()
                ]);
            }  
            else $this->redirectToRoute("store");
        }
    }