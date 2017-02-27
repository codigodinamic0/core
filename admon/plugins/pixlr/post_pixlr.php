<?php
if(isset($_POST['action'])&&$_POST['action']=="pixlr"){
   $base_url="http://".$_SERVER['HTTP_HOST']."/rosario/";
   
   $img_title=$_POST['title'];
   $idr = $_POST['idr'];
   $ruta_guardar = $_POST['imgpath'];
   //redirijo al navegador al servicio de edición de la foto en Pixlr
   //idioma de la interfaz de pixlr
   $parametros = "loc=es";
   //imagen que queremos poner para editar
   $parametros .= "&image=" . urlencode($base_url . $ruta_guardar);
   //título de la imagen
   $parametros .= "&title=" . urlencode($img_title);
   //página a la que redirigir en caso que se salgan de pixlr
   $parametros .= "&exit=" . urlencode($base_url);
   //method por el que me enviarán los datos de la imagen editada
   $parametros .= "&method=GET";
   //nombre de mi sitio web, que mostrar a la hora de guardar como
   $parametros .= "&referrer=en%20webmarket.com.co";
   //página a la que se enviarán los datos de la imagen editada
   $parametros .= "&target=" . urlencode($base_url."admon/contenido.php?idr=${idr}");
  
   echo "http://www.pixlr.com/editor/?".$parametros;
   //header("Location: http://www.pixlr.com/editor/?" . $parametros);

}