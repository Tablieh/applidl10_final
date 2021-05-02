<?php
    require_once "app\AbstractEntity.php";

    class Product extends AbstractEntity
    {
        private $id;
        private $name;
        private $description;
        private $price;
        private $available;
        private $image;

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

        /**
         * Get the value of description
         */ 
        public function getDescription()
        {
            return $this->description;
        }

        /**
         * Set the value of description
         *
         * @return  self
         */ 
        public function setDescription($description)
        {
            $this->description = $description;

            return $this;
        }

        /**
         * Get the value of price
         */ 
        public function getPrice($format = true)
        {
            return $format == true ? number_format($this->price, 2, ",", "&nbsp;") : $this->price;
        }

        /**
         * Set the value of price
         *
         * @return  self
         */ 
        public function setPrice($price)
        {
            $this->price = $price;

            return $this;
        }

        /**
         * Get the value of available
         */ 
        public function getAvailable()
        {
            return $this->available;
        }

        /**
         * Set the value of available
         *
         * @return  self
         */ 
        public function setAvailable($available)
        {
            $this->available = $available;

            return $this;
        }

        /**
         * Get the value of image
         */ 
        public function getImage()
        {
            $image = $this->image;
            if($this->image == null){
                $image = "<img src='https://place-hold.it/50x50'>";
            }
            return $image;
        }

        /**
         * Set the value of image
         *
         * @return  self
         */ 
        public function setImage($image)
        {
            $this->image = $image;

            return $this;
        }
    }