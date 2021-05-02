<?php
namespace App\Model\Manager;

use App\Core\AbstractManager as AM;
use App\Core\ManagerInterface;

class ProductManager extends AM implements ManagerInterface
{
    public function __construct(){
        parent::connect();
    }

    public function getAvailableProducts(){
        return $this->getResults(
            "App\Model\Entity\Product",
            "SELECT * FROM product WHERE available IS TRUE"
        );
    }

    public function getAll(){
        return $this->getResults(
            "App\Model\Entity\Product",
            "SELECT * FROM product"
        );
    }

    public function getOneById($id){
        return $this->getOneOrNullResult(
            "App\Model\Entity\Product",
            "SELECT * FROM product WHERE id = :num", 
            [
                "num" => $id
            ]
        );
    }

    public function setAvailable($id, $activate){
        return $this->executeQuery( 
            "UPDATE product SET available = :activ WHERE id = :num",
            [
                "num"   => $id,
                "activ" => $activate ? 1 : 0
            ]
        );
    }

    public function insertProduct($name, $descr, $price, $catid){
        $this->executeQuery( 
            "INSERT INTO product (name, description, price, category_id) VALUES (:name, :descr, :price, :catid)",
            [
                "name"  => $name,
                "descr" => $descr,
                "price" => $price,
                "catid" => $catid
            ]
        );
        return $this->getLastInsertId();
    }

    public function deleteProduct($id){
        return $this->executeQuery( 
            "DELETE FROM product WHERE id = :id",
            [
                "id" => $id 
            ]
        );
    }
}