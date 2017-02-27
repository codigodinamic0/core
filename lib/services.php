<?php
//enviar correo de contacto
if(isset($_POST["action"])&&$_POST["action"]=="contacto"){
    
                $to =  variable(2, 1);    
                $toAttend = $to[0];
                $subject = "Mensaje contacto Juana Francisca";
                $body = '<html> 
                            <head> 
                               <title>Mensaje contacto desde la pagina web Juana Francisca</title> 
                            </head> 
                            <body> 
                            <h3>Mensaje contacto Juana Francisca</h3> 
                            <p>Nombre:<strong> '.$_POST['nombre'].'</strong></p>
                            <p>Asunto:<strong> '.$_POST['asunto'].'</strong></p> 
                            <p>Correo Electronico:<strong> '.$_POST['correo'].'</strong></p>
                            <p>Comentario:<strong> '.$_POST['msg'].'</strong></p>
                            <p>Este mensaje fue generado por el sistema, Por favor no responda a este</p>
                            </body> 
                            </html>';
                $headers = "MIME-Version: 1.0\r\n";
                $headers .= "Content-type: text/html; charset=utf-8\r\n";
                $headers .= "From: Juana Francisca Pagina web <info@juanafrancisca.com>\r\n";
              
                if(mail($toAttend, $subject, $body, $headers)){
                    $msg="El mensaje se envio satisfactoriamente!!";
                }else{
                    $msg=false;
                }
}   

//newsletter 

if(isset($_POST['action'])&&$_POST['action']=="newsletter"){
    
    $email = sql_seguro($_POST['correo']);
    //verificar si existe correo
    if($email!=""){
        $db->select("registrado","correo_registrado" ,"WHERE correo_registrado='{$email}'");
        if($db->num_rows()>0){
            $msg ="registro exitoso";
        }else{
            $prependNews =array(
            'idr'=>3,
            'correo_registrado'=>$email
            );
            $insert =$db->insert("registrado",$prependNews);
            if($insert){
                $msg ="Registro exitoso";
            }else{
                $msg=false;
            }
        }
    }
}


//registro de usuario nuevo
if(isset($_POST["action"])&&$_POST["action"]=="registro"){
    
    $correo_registrado = sql_seguro($_POST['correo_registrado']);
    $contrasena_registrado = sql_seguro($_POST['contrasena_registrado']);
    $nacio_registrado = sql_seguro($_POST['nacio_registrado']);
    $boletin_registrado = isset($_POST['boletin_registrado'])?sql_seguro($_POST['boletin_registrado']):0;
    list($day,$month,$year) =explode("-",$nacio_registrado);
    $nacio_registrado =$year."-".$month."-".$day;
    $db->select("registrado","correo_registrado" ,"WHERE correo_registrado='{$correo_registrado}' AND idr=1");
    if($db->num_rows()>0){
         $msg_r=false;
         $msg_ex="El correo ya esta asociado a un usuario";
    }else{
        $prependUser =array(
            'idr'=>1,
            'contrasena_registrado'=>md5($contrasena_registrado),
            'correo_registrado'=>$correo_registrado,
            'nacio_registrado'=>$nacio_registrado,
            'boletin_registrado'=>$boletin_registrado
            );
            $insert =$db->insert("registrado",$prependUser);
        if($insert){
            $msg_r=true;
            $msg_ex="Registro exitoso";
        }else{
            $msg_r=false;
            $msg_ex="Ha ocurrido un error inesperado, vuelve a intentarlos mas tarde";
        }
    }
}
//login
if(isset($_POST['action'])&&$_POST['action']=="login"){
    
    $email = sql_seguro($_POST['email']);
    $pass = sql_seguro($_POST['password']);
    
    $db->select("registrado","id_registrado,correo_registrado","WHERE correo_registrado='{$email}' AND contrasena_registrado='".md5($pass)."' AND idr=1");
    if($db->num_rows()>0){
        $user = $db->fetch_assoc();
        $_SESSION['id']=$user['id_registrado'];
        $_SESSION['email']=$user['correo_registrado'];
        $msg_r=true;
        $msg_ex="Bienvenido!!";
        echo"<script>window.location=window.location.href</script>";
    }else{
        $msg_r=false;
        $msg_ex="El correo o la contraseña no son correctas, comprueba los datos y vuelve a intentarlo";
    }
}
//rating de productos
if(isset($_POST['action'])&&$_POST['action']=='rating'){
        include "Crud.php";
        $db =  new Crud("localhost","webmarp8_web","aaaa1111","webmarp8_rosario");
        $db->connect();
        $start =$_POST['starts'];
        $id_product =$_POST['product'];
        $id_user =$_POST['user'];
        $prepend=array(
            'idUser'=>$id_user,
            'idProduct'=>$id_product,
            'value'=>$start
        );
        $insert = $db->insert("rating",$prepend);
        if($insert){
           $count=0;
           $sum=0;
            $db->select("rating","idProduct,value","WHERE idProduct={$id_product}");
            while($rows =$db->fetch_object()){
                $sum+=$rows->value;
                $count++;
            }
            echo json_encode(array("rating"=>ceil(($sum/$count)),"product"=>$id_product));
         }
}
?>
