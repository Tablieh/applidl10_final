<?php
    namespace App\Core;
    
    abstract class AbstractController
    {

        /**
         * permet au contrôleur de renvoyer une vue et ses données
         * 
         * @param string $view - le chemin de la vue à afficher
         * @param array $data - le tableau contenant les données nécessaires à la vue
         * 
         * @return array tableau formaté contenant la vue et ses données
         */
        protected function render($view, $data = []){
            
            return [
                "view"  => "view/".$view,
                "data"  => $data
            ];
        }

        /**
         * permet au contrôleur de rediriger vers une nouvelle route (redirection HTTP 302)
         * 
         * @param string $ctrl - le contrôleur à appeler (si UserController, écrire "user")
         * @param string|null $method - la méthode du contrôleur à exécuter (si null, index() sera appelée)
         * @param string|null $param - le paramètre de requête id 
         * 
         * @return array tableau formaté contenant la vue et ses données
         */
        protected function redirectToRoute($ctrl, $method = null, array $param = []){
            Router::redirect([
                "ctrl"   => $ctrl,
                "method" => $method,
                "param"  => $param
            ]);
        }
    }