<?php

    abstract class Router 
    {
        private static $defaultCtrl = "store";

        public static function handleRequest($params){

            $ctrlname = ucfirst(self::$defaultCtrl)."Controller";//par défaut !!
            $ctrlfile = $ctrlname.".php"; 
            $method = "index";

            if(isset($params['ctrl'])){
                $urlCtrl = $params['ctrl'];

                if(file_exists(CTRL_PATH.ucfirst($urlCtrl)."Controller.php")){
                    $ctrlname = ucfirst($urlCtrl)."Controller";
                    $ctrlfile = $ctrlname.".php";
                }
            }
            
            require CTRL_PATH.$ctrlfile;
            //eh oui, on peut mettre le nom de la classe à instancier dans une variable et faire new avec !!
            $ctrl = new $ctrlname();

            if(isset($params['action']) && method_exists($ctrl, $params['action'])){
                $method = $params['action'];
            }

            if(isset($params['id'])){
                $id = $params['id'];
            }
            else $id = null;
            
            return $ctrl->$method($id);
        }

        public static function redirect($arrayRoute){

            $route = "Location:";

            $route.= "?ctrl=".$arrayRoute['ctrl'];
            $route.= $arrayRoute['method'] ? "&action=".$arrayRoute['method'] : "";
            $route.= $arrayRoute['param'] !== null ? "&id=".$arrayRoute['param'] : "";

            header($route);
            die;
        }
    }

    