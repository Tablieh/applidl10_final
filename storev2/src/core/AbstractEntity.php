<?php
    namespace App\Core;

    abstract class AbstractEntity
    {
        /**
         * hydrate un objet avec les données voulues
         * 
         * @param array $data - les données sortant de la base de données
         * @param Object $object - l'objet à hydrater
         */
        protected static function hydrate($data, $object){
            
            foreach($data as $field => $value){
                $explodedField = explode("_", $field);
                if(count($explodedField) > 1 && $explodedField[1] == "id"){
                    $field = $explodedField[0];
                    $managerClass = 'App\\Model\\Manager\\'.ucfirst($field).'Manager';
                    $manager = new $managerClass;
                    $value = $manager->getOneById($value);
                }
                
                $setter = "set".ucfirst($field);
                if(method_exists($object, $setter)){
                    $object->$setter($value);
                }
            }
        }
    }