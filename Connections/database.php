<?php
/*ruta del directorio padre*/
define("APPPATH",dirname(__DIR__));
define("BASE_URL","http://desarrollosglobales.com/panel_administrativo/");
define("BASE_URL_ORIGINAL","http://desarrollosglobales.com/panel_administrativo/");
//echo APPPATH;
//require_once APPPATH.'/Connections/Crud.php';
require_once 'Crud.php';

$localhost="localhost";
$database="codigodi_core";
$username="codigodi_admin";
$password="91120158401";
$db="";
$db= new Crud($localhost,$username,$password,$database);
$db->connect();
$db->setNames("utf8");
$key = "core"
?>