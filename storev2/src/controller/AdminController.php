<?php
namespace App\Controller;

use App\Core\AbstractController as AC;
use App\Core\Session;
use App\Model\Manager\ProductManager;
use App\Model\Manager\CategoryManager;

class AdminController extends AC
{
    public function __construct(){
        $this->pmanager = new ProductManager();
        $this->cmanager = new CategoryManager();
    }

    public function index(){
        $products = $this->pmanager->getAll();
        $categories = $this->cmanager->getAll();

        return $this->render("admin/admin.php", [
            "products"   => $products,
            "categories" => $categories,
            "title"      => "Administration"
        ]);
    }

    public function addprod(){
        if(isset($_POST["submit"])){

            $name  = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
            $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $descr = filter_input(INPUT_POST, "descr", FILTER_SANITIZE_STRING);
            $cat   = filter_input(INPUT_POST, "category", FILTER_VALIDATE_INT);
            
            if($name && $price && $descr && $cat){
                
                if($this->pmanager->insertProduct($name, $descr, $price, $cat)){
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
            $product = $this->pmanager->getOneById($id);
            if($this->pmanager->deleteProduct($id)){
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
            $product = $this->pmanager->getOneById($id);
            if($product->getAvailable()){
                $this->pmanager->setAvailable($id, false);
                Session::addFlash('error', "Produit desactivé !");
            }
            else{
                $this->pmanager->setAvailable($id, true);
                Session::addFlash('success', "Produit activé !");
            }
        }

        return $this->redirectToRoute("admin");
    }
}