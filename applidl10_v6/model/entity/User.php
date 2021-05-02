<?php
    require_once "app/AbstractEntity.php";

    class User extends AbstractEntity
    {
        private $id;
        private $email;
        private $role;
        private $created_at;

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
         * Get the value of email
         */ 
        public function getEmail()
        {
            return $this->email;
        }

        /**
         * Set the value of email
         *
         * @return  self
         */ 
        public function setEmail($email)
        {
            $this->email = $email;

            return $this;
        }

        /**
         * Get the value of role
         */ 
        public function getRole()
        {
            return $this->role;
        }

        /**
         * Set the value of role
         *
         * @return  self
         */ 
        public function setRole($role)
        {
            $this->role = $role;

            return $this;
        }

        /**
         * Get the value of created_at
         */ 
        public function getCreated_at($format)
        {
            return $this->created_at->format($format);
        }

        /**
         * Set the value of created_at
         *
         * @return  self
         */ 
        public function setCreated_at($created_at)
        {
            $this->created_at = new \DateTime($created_at);

            return $this;
        }
        
    }