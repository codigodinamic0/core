<?php
$fileName="../../imagenes/".$_GET['folder']."/imagen1/".$_GET['ref'];

 require_once 'ThumbLib.inc.php';
$size=explode("x",$_GET['size']);
$thumb = PhpThumbFactory::create($fileName);
$thumb->adaptiveResize($size[0], $size[1]);
$thumb->show();
?>
