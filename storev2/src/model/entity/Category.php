<?php
    namespace App\Model\Entity;
 
    use App\Core\AbstractEntity as AE;
    use App\Core\EntityInterface;

    class Category extends AE implements EntityInterface
    {

        private $id;
        private $name;

        public function __construct($data){
            parent::hydrate($data, $this);
        }

        /**
         * Get the value of id
         */ 
        public function getId()
        {
                return $this->id;
        }

        /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }

        /**
         * Get the value of name
         */ 
        public function getName()
        {
                return $this->name;
        }

        /**
         * Set the value of name
         *
         * @return  self
         */ 
        public function setName($name)
        {
                $this->name = $name;

                return $this;
        }

        public function __toString(){
                return $this->name;
        }
    }