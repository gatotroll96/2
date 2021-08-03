<?php


class Router {
	
    function __construct() {        
        $actionName = (!isset($_GET['action'])) ? "index" : $_GET['action'];       
        $controller = new Action();
        $controller->$actionName();
    }
}

?>