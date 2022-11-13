<?php

include_once "libs/router.php";
include_once "app/controller/controller.php";

$router=new Router();

$router->addRoute("canciones","GET","Controller","getAll");
$router->addRoute("canciones/:ID","GET","Controller","get");
$router->addRoute("canciones/:ID","PUT","Controller","editComent");
$router->addRoute("canciones","POST","Controller","addCancion");


$router->route($_GET['info'],$_SERVER['REQUEST_METHOD']);