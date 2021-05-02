<?php
    namespace App\Controller;
    
    use App\Core\AbstractController as AC;
    use App\Model\Manager\ProductManager;

    class StoreController extends AC
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
                
                $product = $this->manager->getOneById($id);

                return $this->render("store/voir.php", [
                    "product" => $product,
                    "title"   => $product->getName()
                ]);
            }  
            else $this->redirectToRoute("store");
        }
    }