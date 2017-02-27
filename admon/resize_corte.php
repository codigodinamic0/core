<?php

$nombre_tabla=$_GET['nombre_tabla'];
$nombre_archivo=$_GET['nombre_archivo'];

$ruta="../imagenes/contenido/" . $nombre_archivo;
$thumb_with=$_GET['thumb_with'];
$thumb_height=$_GET['thumb_height'];
$thumb_x=$_GET['thumb_x'];
$thumb_y=$_GET['thumb_y'];
$width_thumb=$_GET['width_thumb'];

$action="";
if (isset($_GET['action']) ) $action = $_GET['action'];

$dest="";
if (isset($_GET['dest']) ) $dest = $_GET['dest'];
$id="";
if (isset($_GET['id']) ) $id = $_GET['id'];


include_once('thumbnail.inc.php');
$thumb = new Thumbnail($ruta);

$thumb->crop($thumb_x,$thumb_y,$thumb_with,$thumb_height);
$thumb->resize($width_thumb,0);

if($action=="preview"){
	$thumb->show();
}

if($action=="save"){
	//chmod("../uploads/" . $nombre_tabla . "/thumb/" . $nombre_archivo,0777);
	//unlink("../uploads/" . $nombre_tabla . "/thumb/" . $nombre_archivo);
	$thumb->save("../imagenes/contenido/imagen1/pequena/" . $nombre_archivo);?>
    <script>window.location="<?= $dest?>&id=<?= $id ?>";</script>
<? }

$thumb->destruct();

?>