<?php
    require "app/AbstractController.php";
    require "model/manager/ProductManager.php";

    class CartController extends AbstractController
    {
        public function __construct(){
            $this->manager = new ProductManager();
        }

        public function index(){
            
            return $this->render("cart/recap.php");
        }

        public function incart($id){
            if($id){
                    
                $isProd = false;//on part du principe que le produit n'est pas dans le panier

                if(Session::getCart()){//si des produits sont déja en session
                    //on filtre le tableau de session "cart" pour tenter d'y récupérer le produit
                    //correspondant à celui récupéré en base de données
                    $isProd = array_filter(Session::getCart(), function($line) use ($id){
                        //renvoie le produit si le if est true, false sinon
                        return $line["product"]->getId() == $id;
                    });
                }
                //si isProd a récupéré un produit
                if($isProd){//on incrémente seulement la quantité du produit récupéré
                    Session::setQuantityToLine(key($isProd), 1);
                    
                    //key($isProd) permet de récupérer l'index du tableau (la position du produit en session)
                    Session::addFlash(
                        'success', 
                        "Un autre exemplaire de ". 
                        Session::getCart()[key($isProd)]['product']->getName().
                        " a été ajouté au panier !"
                    );
                }
                else{
                    $product = $this->manager->getOneProduct($id);
                    //si le produit a été trouvé en base de données
                    if($product != null){
                        //on ajoute un nouveau produit dans le panier
                        $line = [
                            "product" => $product,
                            "qtt"     => 1
                        ];
                        Session::addLineToCart($line);
                        Session::addFlash('success', $product->getName()." ajouté(e) au panier avec succès !");
                    }
                    else Session::addFlash('error', "Le produit n'existe pas.");
                }
                
            }
            else Session::addFlash('error', "Un problème est survenu");

            $this->redirectToRoute("store");
        }

        public function deletecart($id){
            
            if(Session::getCart() && $id !== null){
                
                if(isset(Session::getCart()[$id])){
                    Session::removeCartLine($id);
                }
            }

            $this->redirectToRoute("cart");
        }

        public function updateqtt($id){
            
            if(Session::getCart() && $id !== null){
              
                if(isset(Session::getCart()[$id])){
                    if(isset($_GET['incr'])){
                        Session::setQuantityToLine($id, 1);
                      
                    }
                    if(isset($_GET['decr'])){
                        Session::setQuantityToLine($id, -1);
                        //si la qtt arrive à zéro, ciao le produit !!
                        if(Session::getCart()[$id]['qtt'] == 0){
                            Session::removeCartLine($id);
                        }
                    }
                }
            }

            $this->redirectToRoute("cart");
        }

        public function erasecart(){
            Session::removeCart();

            $this->redirectToRoute("cart");
        }
    }