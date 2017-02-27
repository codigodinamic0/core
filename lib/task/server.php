<?php
header('Content-Type: application/json');
require_once("../../Connections/database.php");
require_once("../recaptchalib.php");
require ("../functions.php");

$valor=variable(4,1); 
$dominio = $valor[0];

// Register API keys at https://www.google.com/recaptcha/admin
$valor=variable(13,1);
$siteKey = $valor[0];

$valor=variable(19,1);
$secret = $valor[0];
// reCAPTCHA supported 40+ languages listed here: https://developers.google.com/recaptcha/docs/language
$lang = "es-419";
// The response from reCAPTCHA
$resp = null;
// The error code from reCAPTCHA, if any
$error = null;
$reCaptcha = new ReCaptcha($secret);

/*recuperar contraseña*/
if(post('action')!=null&&post('action')=="suscribir"){
    $email = "";
    $email = trim(post("suscribir"));    
    $db->select("registrado","correo_registrado","WHERE correo_registrado='{$email}' AND idr=2");   
    if ($db->num_rows() < 1) {        
		$prepend=array(
            "idr"=>2,
            "correo_registrado"=>$email,
        );
        $insert=$db->insert('registrado',$prepend);
        
        if($insert){
            response(array("msg"=>"1"), 200);
        }
        else{
            response(array("msg"=>"2"), 200);
        }            
    }else{
        response(array("msg"=>"3"), 200);
    }
}

/*contactenos*/
if(post('action')!=null && post('action')=="contacto"){
    $resp = $reCaptcha->verifyResponse($_SERVER["REMOTE_ADDR"], $_POST["g-recaptcha-response"]);    
    if($resp != null && $resp->success){

        $valor=variable(6,1); 
        $toAttend = $valor[0];

        $valor=variable(7,1); 
        $remitente = $valor[0];

        $subject = "Mensaje de Contacto desde Core +";
        $body = "<html>
                    <head>
                        <meta charset='utf-8'>
                        <title>".$subject."</title>
                    </head>
                    <body>
                        <div class='container' style = ' padding: 10px 50px; font-family: sans-serif; color: #757575; '>
                            <h2 class='titles' style=' display: block; color: #000; font-weight: 700; font-size: 30px; font-family: sans-serif;'>".$subject."
                            <span style = 'display: block; width: 100px; border: 0; border-top: 3px solid #35C0BD; margin-top: 0; margin-bottom: 0; margin-top: 5px;'></span></h2>
                            <h4 class='subtitle' style = 'font-size: 24px; margin: 5px 0px;'>".post('nombre')."</h4>
                            <span class='correo' style = 'color: #35C0BD; font-size: 16px; font-style: italic;'>".post('email')."</span><br>
                            <span class='correo' style = 'color: #35C0BD; font-size: 16px; font-style: italic;'>".post('tema')."</span><br>
                            <br>
                            <h3 style = 'color: #35C0BD; font-size: 18px; font-style: italic;'>".post('pregunta')."</h3>
                            <p style = 'margin: 0px;'>".post('mensaje')."</p>
                            <br>
                            <p class='foot'>Este mensaje fue generado por el sistema, por favor no responder</p>
                        </div>
                    </body>
                    </html>";

        $resultMsg = sendPHPMailer($toAttend, $subject, $body);
        
        if($resultMsg){
            response(array("msg"=>"1"), 200);
        }else{
            response(array("msg"=>"3"), 200);
        }
    }else{
        response(array("msg"=>"2"), 200);
    }
}

/**/
if(post('action')!=null && post('action')=="last-productos"){
    $page_number=filter_var(post('page'), FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
    $item_per_page = 12;
    $ordenamiento = post('ordenamiento');
    $condicion = post('condicion');
    $position = ($page_number * $item_per_page);
    $db->select("vproducto p, categoria c, categoria g","p.id_matrix, p.nombre_matrix, p.img_matrix, p.precio_matrix, p.descripcion_matrix, p.amigable_matrix, p.nuevo_matrix, c.amigable_categoria, c.de","WHERE p.id_categoria = c.id_categoria AND c.de = g.id_categoria $condicion $ordenamiento LIMIT ".$position." ,".$item_per_page);
    /*$db->select("vblog b, categoria c","b.nombre_matrix, b.img_matrix, b.fecha_matrix, b.amigable_matrix, c.amigable_categoria","WHERE b.id_categoria=c.id_categoria ORDER BY b.fecha_matrix DESC LIMIT ".$position." ,".$item_per_page);*/
    /*$db->last_query();*/
    $innerHtml = "";
    while ($arraypadre = $db->fetch_array()) {
        $cpadre[] = $arraypadre; 
    }    
    if(!empty($cpadre)){
        foreach ($cpadre as $row) {
            $innerHtml.='<li class="col-xs-12 col-sm-3 col-md-3 items">
                            <div class="cont">
                                <div class="contimg">
                                    <a href="'.$dominio.$row['amigable_matrix'].'/'.$row['id_matrix'].'/cod23/">
                                        <img src="'.$dominio.'imagenes/producto/imagen1/pequena/'.$row['img_matrix'].'" alt="'.$row['nombre_matrix'].'" title="'.$row['nombre_matrix'].'">
                                    </a>
                                    <div class="animate option">
                                        <a href=""><i class="fa fa-plus"></i></a>
                                        <a href="" class="mit"><i class="fa fa-heart-o"></i></a>
                                        <a href=""><i class="fa fa-random"></i></a>
                                    </div>                          
                                </div>
                                <p>'.$row['nombre_matrix'].' <br>'.$row['referencia_matrix'].'</p>
                                <span>$'.number_format($row['precio_matrix']).'</span>
                                <a href="'.$dominio.$row['amigable_matrix'].'/'.$row['id_matrix'].'/cod23/" class="animate add">Ver producto</a>
                            </div>
                        </li>';            
        }
    }       
    /*echo $innerHtml;*/
    response(array("news"=>$innerHtml), 200);
}

/*
 * function de recibido y respuesta de datos asincronicos.
 * functiones necesarias para el funcionamiento del api rest de
 * recibido y respuesta del servidor
 */
function post($key){
    if ($_SERVER['REQUEST_METHOD']=='POST') {
      
        $toArray= _toArray(json_decode(file_get_contents("php://input")));
        if(is_null($toArray))
            $toArray= _toArray($_POST);
        
        if(array_key_exists($key, $toArray)){
            return _toArray($toArray[$key]);
        }else{
            return null;
        }
        
    }else{
        return null;
    }
}

function get($key){
    if ($_SERVER['REQUEST_METHOD']=='GET') {
        $toArray= $_GET;
        if(array_key_exists($key, $toArray)){
           
            return $toArray[$key];
        }else{
            return null;
        }
        
    }else{
        return null;
    }
}

function _toArray($obj){
    if (is_array($obj)) {
        foreach ($obj as $key => $value) {
            if (is_array($value)) {
                $obj[$key] = _toArray($value);
            }
            if ($value instanceof stdClass) {
                $obj[$key] = _toArray((array)$value);
            }
        }
    }
    if ($obj instanceof stdClass) {
        return _toArray((array)$obj);
    }
    return $obj;
}

function response($array,$code){
    
    http_response_code($code);
    echo  json_encode($array);
}