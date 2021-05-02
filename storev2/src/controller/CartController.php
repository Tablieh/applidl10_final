<?php
    namespace App\Controller;
    
    use App\Core\AbstractController as AC;
    use App\Core\Session;
    use App\Service\Cart;
    use App\Model\Manager\ProductManager;

    class CartController extends AC
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

                if($cart = Session::get("cart")){//si des produits sont déja en session
                    
                    //on filtre le tableau de session "cart" pour tenter d'y récupérer le produit
                    //correspondant à celui récupéré en base de données
                    $isProd = array_filter($cart->getLines(), function($line) use ($id){
                        //renvoie le produit si le if est true, false sinon
                        return $line["product"]->getId() == $id;
                    });
                }
                //si isProd a récupéré un produit
                if($isProd){//on incrémente seulement la quantité du produit récupéré
                    $num = key($isProd);
                    Session::get("cart")->setQuantityToLine($num, 1);
                    
                    //key($isProd) permet de récupérer l'index du tableau (la position du produit en session)
                    Session::addFlash(
                        'success', 
                        "Un autre exemplaire de ". 
                        Session::get("cart")->getLines()[$num]['product']->getName().
                        " a été ajouté au panier !"
                    );
                }
                else{
                    $product = $this->manager->getOneById($id);
                    //si le produit a été trouvé en base de données
                    if($product != null){
                        //on ajoute un nouveau produit dans le panier
                        Session::get("cart")->addToCart($product, 1);
                        Session::addFlash('success', $product->getName()." ajouté(e) au panier avec succès !");
                    }
                    else Session::addFlash('error', "Le produit n'existe pas.");
                }
                
            }
            else Session::addFlash('error', "Un problème est survenu");

            $this->redirectToRoute("store");
        }

        public function deletecart($id){
            
            if(Session::get("cart") && $id !== null){
                Session::get("cart")->removeCartLine($id);
            }

            return $this->redirectToRoute("cart");
        }

        public function updateqtt($id){
            
            if(Session::get("cart") && $id !== null){
              
                if(isset($_GET['incr'])){
                    Session::get("cart")->setQuantityToLine($id, 1);
                }
                if(isset($_GET['decr'])){
                    Session::get("cart")->setQuantityToLine($id, -1);
                }
                
            }

            return $this->redirectToRoute("cart");
        }

        public function erasecart(){
            Session::get("cart")->removeAll();

            return $this->redirectToRoute("cart");
        }
    }