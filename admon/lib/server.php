<?php
header('Content-Type: application/json');
require_once("../../Connections/database.php");
require ("../../lib/functions.php");
require '../third_party/mailgun/autoload.php';
use Mailgun\Mailgun;

/*recuperar contraseña*/
if(post('action')!=null&&post('action')=="remember_psw"){
    $email = "";
    $email = trim(post("email"));    
    $db->select("usuario","id_usuario, login, email","WHERE email='{$email}'");   
    if ($db->num_rows() > 0) {
        $row = $db->fetch_assoc();
        
        /*generar nuevo psw*/
        $new_psw = get_random();
        $new_psw_hash = hash_password($new_psw);
		
        /*actualizar*/
        $prepend=array(
            "password"=>$new_psw_hash,
        );
        $update=$db->update('usuario',$prepend, 'WHERE id_usuario = '.$row['id_usuario']);
        $update = "ok";
        if($update){
            /*enviar correo*/
            $valor=variable(151,2); 
            $remitente = $valor[0];

            $valor=variable(148,2); 
            $mailgun_key = $valor[0];

            $valor=variable(183,2); 
            $domain = $valor[0];

            $subject = "Recordar Password Panel Administrativo";
            $body = '<html> 
                        <head> 
                           <title>Recordar Password Panel Administrativo</title> 
                        </head> 
                        <body> 
                            <h3>Recordar Password Panel Administrativo</h3> 
                            <p>Usuario :<strong> '.$row['login'].'</strong></p>
                            <p>Password :<strong> '.$new_psw.'</strong></p>
                            <p>Mensaje generado por el sistema, por favor no responder.</p>
                        </body> 
                    </html>';

            $mg = new Mailgun($mailgun_key);

            # Now, compose and send your message.
            $resultMsg=$mg->sendMessage($domain, array('from'    => $remitente, 
                                            'to'      => $row['email'], 
                                            'subject' => $subject, 
                                            'html'    => $body));
            
            if($resultMsg){
                response(array("msg"=>"1"), 200);
            }else{
                response(array("msg"=>"4"), 200);
            }
        }
        else{
            response(array("msg"=>"2"), 200);
        }            
    }else{
        response(array("msg"=>"3"), 200);
    }
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