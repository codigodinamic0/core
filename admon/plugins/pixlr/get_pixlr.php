<?php
$base_url="http://webmarket.com.co/maquinas/";
if(isset($_GET['image'])){
    $replaced =false;

    $image = $_GET['image'];
    $type = $_GET['type'];
    $state = $_GET['state'];
    $filename = $_GET['title'];

    if (strpos($image, "pixlr.com") == 0){
       //Si la URL no viene de pixlr
       echo "Referencia de la imagen incorrecta";
       exit;
    }
    $headers = get_headers($image, 1); //esto sólo funciona en PHP 5
    $content_type = explode("/", $headers['Content-Type']);
    if ($content_type[0] != "image"){
       echo "Tipo de archivo inválido";
       exit;
    }
    //Podrías necesitar asignar un identificador único a esta imagen
    //$filename = uniqid();

    //define el directorio donde se gardaría la imagen
    $save_path = "../imagenes/" .$modulo. "/imagen1/". $filename . "." . $type;
    

    //Copiar la imagen al servidor
    if(copy($image,$save_path)){
        
        $replaced=true;
    }else{
        $replaced=false;
    }
}