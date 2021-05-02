<?php
namespace App\Service;

use App\Core\Session;
use App\Model\Entity\Product;
use App\Model\Entity\User;

class Cart
{
    private $lines = [];// a line is : ['product' => Product, 'qtt' => int]

    public function addToCart($product, $qtt){
        $this->lines[] = ["product" => $product, "qtt" => $qtt];
    }
    
    public function setQuantityToLine($num, $value){
        if(isset($this->lines[$num])){
            $this->lines[$num]['qtt']+= $value;
            if($this->lines[$num]['qtt'] == 0){
                $this->removeCartLine($num);
            }
        }
    }

    public function removeCartLine($num){
        if(isset($this->lines[$num])){
            unset($this->lines[$num]);
        }
    }

    public function removeAll(){
        $this->lines = [];
    }

    public function getLines(){
        return $this->lines;
    }

    public function isEmpty(){
        return empty($this->lines);
    }

    public function getTotalOfLine($num){
        $line = $this->lines[$num];
        return number_format($line["product"]->getPrice(false) * $line["qtt"], 2, ",", " ");
    }

    public function getWholeQuantity(){
        
        $wqtt = array_reduce($this->lines, function($accumulator, $line) {
            return $accumulator+= $line["qtt"];
        });

        return $wqtt ? $wqtt : 0;
    }

    public function getTotalAmount(){
        
        $total = array_reduce($this->lines, function($accumulator, $line) {
            return $accumulator+= ($line["product"]->getPrice(false) * $line["qtt"]);
        });

        return number_format($total, 2, ",", " ");
    }

    public function __destruct()
    {
        Session::set("cart", $this);
    }

}