<?php

define("URL","/school/");
require_once "app/controllers/errorescontroller.php";
require_once "app/controllers/controller.php";
$url=$_GET["action"] ?? null;
$url=rtrim($url,"/");
$url=explode("/",$url);
//print_r($url);
if (empty($url[0])) {
    $archivoController="app/controllers/login";
    $url[0]="login";
} else {
    $archivoController="app/controllers/{$url[0]}";
}
$archivoController.="controller.php";
//echo $archivoController;
if (file_exists($archivoController)) {
    require_once $archivoController; 
    $url[0].="controller";
    $parametro=$url[1] ?? "";
    $controller=new $url[0]($parametro);
} else {
    $controller= new ErroresController();
}




