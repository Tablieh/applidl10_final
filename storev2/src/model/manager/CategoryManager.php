<?php
namespace App\Model\Manager;
    
use App\Core\AbstractManager as AM;
use App\Core\ManagerInterface;

class CategoryManager extends AM implements ManagerInterface
{
    public function __construct(){
        parent::connect();
    }

    public function getAll(){
        return $this->getResults(
            "App\Model\Entity\Category",
            "SELECT * FROM category"
        );
    }

    public function getOneById($id){
        return $this->getOneOrNullResult(
            "App\Model\Entity\Category",
            "SELECT * FROM category WHERE id = :num", 
            [
                "num" => $id
            ]
        );
    }
}