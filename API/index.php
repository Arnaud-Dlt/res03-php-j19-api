<?php

require "./autoload.php";

try {

    $router = new Router();

    if(isset($_GET['path']))
    {
        $request = "/".$_GET['path'];
    }
    else
    {
        $request = "/";
    }
    
    $router->route($routes, $request);
}

catch(Exception $e)
{
    if($e->getCode() === 404)
    {
        "./templates/404.phtml";
    }
}
$newuser=new User(null,"Arnaud-Dlt","Arnaud","Deletre","arnaud.deletre@3wa.io");
$um=new UserManager();
$newusers=$um->createUser($newuser);