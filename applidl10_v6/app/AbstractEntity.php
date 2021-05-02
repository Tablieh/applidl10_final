<?php

    abstract class AbstractEntity
    {
        protected static function hydrate($data, $object){
            /*
            $data['id'] >> $object->setId()
            $data['name'] >> $object->setName()
            */
            foreach($data as $field => $value){
                $setter = "set".ucfirst($field);
                if(method_exists($object, $setter)){
                    $object->$setter($value);
                }
            }
        }
    }