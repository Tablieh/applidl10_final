<?php
    namespace App\Core;

    interface ManagerInterface
    {
        public function getAll();

        public function getOneById($id);
    }