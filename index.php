<?php
require_once 'vendor/session.php';
require_once 'vendor/Connection.php';

if(isset($_SESSION,$_SESSION['cod_acceso']) and $_SESSION['auth']=='OK')
{
    require_once "vendor/FrontController.php";
    
    if(isset($_GET['route']))
    {
        $route=$_GET['route'];
    }
    else
    {
        $route='';
    }
    
    $FrontController=new FrontController($route);

} 
else if (isset($_POST['email'], $_POST['password']))
{
    require_once "controllers/AccessController.php";
    $AccessController=new AccessController();
    $AccessController->validateFormSession($_POST);
} 
else 
{
    require_once "controllers/AccessController.php";
    $AccessController=new AccessController();
    $AccessController->showFormSession();
}






?>