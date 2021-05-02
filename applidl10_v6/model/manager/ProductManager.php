<?php
    require_once "app/AbstractManager.php";
    require_once "model/entity/Product.php";

    class ProductManager extends AbstractManager
    {
        public function __construct(){
            parent::connect();
        }

        public function getAvailableProducts(){
            return $this->getResults(
                "Product",
                "SELECT * FROM product WHERE available IS TRUE"
            );
        }

        public function getProducts(){
            return $this->getResults(
                "Product",
                "SELECT * FROM product"
            );
        }

        public function getOneProduct($id){
            return $this->getOneOrNullResult(
                "Product",
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

        public function insertProduct($name, $descr, $price){
            return $this->executeQuery( 
                "INSERT INTO product (name, description, price) VALUES (:name, :descr, :price)",
                [
                    "name" => $name,
                    "descr" => $descr,
                    "price" => $price
                ]
            );
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