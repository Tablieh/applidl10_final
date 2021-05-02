<?php
    require "app/Router.php";
    require "app/Session.php";

    session_start();

    define("CTRL_PATH", "controller/"); //le dossier contenant les contrôleurs

    $result = Router::handleRequest($_GET);
    //var_dump($_SESSION);
    ob_start();

    include $result['view'];
    $page = ob_get_contents();

    ob_end_clean();
    
    include "view/layout.php";