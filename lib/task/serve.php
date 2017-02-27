<?php
session_start();
require '../third_party/mailgun/autoload.php';
use Mailgun\Mailgun;
header('Content-Type: application/json');
require_once("../Connections/database.php");
require ("../lib/functions.php");

if(get('action')!=null&&get('action')=="getActualities"){
  
    $data='';
    $id_categoria=get('category');
    $page_number=filter_var(get("page"), FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
    $item_per_page=10;
    $position = ($page_number * $item_per_page);
    $db->select("vactualidad","id_matrix,"
            . "amigable_matrix,"
            . "nombre_matrix"
            . ",referencia_matrix,"
            . "descripcion_matrix,"
            . "contenido_matrix,"
            . "img_matrix",
            "WHERE id_categoria={$id_categoria} ORDER BY id_matrix DESC LIMIT {$position},{$item_per_page}");
  
    
    if($db->num_rows()>0){
        while($row=$db->fetch_object()){
            $data.='<div class="items">
                    <div class="contimg">
                            <a href="'.BASE_URL.$row->amigable_matrix.'/'.$row->id_matrix.'/'.$row->id_categoria.'/cod2/">
                                <img src="'.BASE_URL.'imagenes/actualidad/imagen1/pequena/'.$row->img_matrix.'" alt="'.$row->nombre_matrix.'" title="'.$row->nombre_matrix.'">
                            <label><span>'.$row->nombre_matrix.'</span>'.$row->referencia_matrix.'</label></a>
                    </div>';
            $data.='<div class="txt">
                            <p>'.$row->descripcion_matrix.'</p>
                            </div>
                    </div>';
        }
    }
    if ($data!=""){
         response(array("msg"=>"ok","data"=>$data), 200);
    }else{
         response(array("msg"=>"fails"), 200);
    }
    
                            
}
/*obtener  anuncios por categoria y/o busqueda*/
if(get('action')!=null&&get('action')=="products"){
   
    $data='';
    $type=get('type');
    $filter=get('filter');
    $plusWhere='';
    switch($type){
        case"search":
            $plusWhere="WHERE descripcion_matrix LIKE '%{$filter}%' OR nombre_matrix LIKE '%{$filter}%'";
            break;
        case"category":
            
            $whereIn=array();
            $db->select("categoria","id_categoria","WHERE de={$filter}");
            if($db->num_rows()>0){
                while ($row=$db->fetch_object()){
                    $whereIn[]=$row->id_categoria;
                }
            }
           $plusWhere=(!empty($whereIn))?"WHERE id_categoria IN(".implode(",",$whereIn).")":"WHERE id_categoria=0";

            break;
        case"subcategory":
            $plusWhere="WHERE id_categoria={$filter}";
            break;
        
    }
    $page_number=filter_var(get("page"), FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
    $next=$page_number+1;
    $item_per_page=12;
    $position = ($page_number * $item_per_page);
    $db->select("vnegocio","id_matrix,nombre_matrix,amigable_matrix,img_matrix,descripcion_matrix","{$plusWhere} ORDER BY id_matrix DESC LIMIT {$position},{$item_per_page}");
   
    if($db->num_rows()>0){
        while($row=$db->fetch_object()){
            $imgProducto =($row->img_matrix!="")?"imagenes/negocio/imagen1/pequena/".$row->img_matrix:"assets/images/default.jpg";
            $data.='<div class="items col-md-4">
                        <div class="co">
                        <a href="'.BASE_URL.$row->amigable_matrix."/".$row->id_matrix.'/cod6/" title="'.$row->nombre_matrix.'">
                          <div class="contimg">
                              
                            <img src="'.BASE_URL.$imgProducto.'" alt="'.$row->nombre_matrix.'" title="'.$row->nombre_matrix.'">
                            <div class="hover"></div>
                          </div>
                            <p>'. substr($row->descripcion_matrix,0,100).'...</p>
                          </a>
                        </div>
                      </div>';
        }
    }
    if ($data!=""){
         response(array("msg"=>"ok","data"=>$data,"next"=>$next), 200);
    }else{
         response(array("msg"=>"fails"), 200);
    }
}

/*obtener datos de anunciosn en el menu del inicio*/
if(get('action')!=null&&get('action')=="getAdvertisement"){
    
    $data='';
    $title='';
    $detail='';
    $id_categoria=get('category');
    $page_number=filter_var(get("page"), FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
    
   $db->select("categoria AS c","c.id_categoria,c.nombre_categoria,"
                       ."c.amigable_categoria AS amigable_hija,cp.amigable_categoria AS amigable_padre ",
                        "INNER JOIN categoria AS cp ON cp.id_categoria=c.de WHERE c.modulo=7 AND c.de=".$id_categoria);
        
    if($db->num_rows()>0){
        while($row=$db->fetch_object()){

            $data.='<li><a href="'.BASE_URL.$row->amigable_padre."/".$row->amigable_hija."/".$row->id_categoria.'/cod5/">'.$row->nombre_categoria.'</a></li>';
        }
    }
        
    $db->select("categoria","nombre_categoria,img,descripcion_categoria","WHERE id_categoria={$id_categoria}");
    $row=$db->fetch_object();
    $title=$row->nombre_categoria;
    $detail.='<p>'.substr($row->descripcion_categoria,0,150).'<p>';
    $detail.='<img style="max-width:300px" src="'.BASE_URL.'imagenes/categoria/'.$row->img.'" alt="'.$row->nombre_categoria.'" title="'.$row->nombre_categoria.'">';

    response(array("msg"=>"ok","data"=>$data,"title"=>$title,"detail"=>$detail), 200);
}

/*obtener los evento por un mes especifico*/
if (get('action')!=null&&get('action')=="getEvents") {
    $month=get('month');
    $data='';
    $detail='';
    $firstEvent=array();
    $db->select("vevento","id_matrix,nombre_matrix,evento_matrix,referencia_matrix,img_matrix,contenido_matrix","WHERE MONTH(evento_matrix) = ".$month);
    if($db->num_rows()>0){
            while($row=$db->fetch_object()){
                $firstEvent['nombre_matrix'][]=$row->nombre_matrix;
                $firstEvent['img_matrix'][]=$row->img_matrix;
                $firstEvent['contenido_matrix'][]=$row->contenido_matrix;
                $day =explode("-",$row->evento_matrix);  
                
                $data.='<div class="items">
                                <div class="cont" id="event_'.$row->id_matrix.'">
                                        '.$day[2].'
                                        <span>'.$arrayShortMonth[$month].'</span>
                                </div>
                                <div class="txt">
                                        <label>'.$row->nombre_matrix.'</label>
                                         '.$row->referencia_matrix.'
                                        <br>
                                        <a href="javascript:void(0)" class="show_event_detail" rel="'.$row->id_matrix.'">Ver evento ></a>
                                </div>
                        </div>';
           }
    }
    if(!empty($firstEvent)){
        $detail='<img src="'.BASE_URL.'imagenes/evento/imagen1/pequena/'.$firstEvent['img_matrix'][0].'" alt="'.$firstEvent['nombre_matrix'][0].'" title="'.$firstEvent['nombre_matrix'][0].'">
                   <div class="txt">
                        <h4>'.$firstEvent['nombre_matrix'][0].'</h4>
                        '.$firstEvent['contenido_matrix'][0].'
                   </div>';
    }
    response(array("msg"=>"ok","data"=>$data,"detail"=>$detail), 200);
}
/*obtener evento especifico*/
if (get('action')!=null&&get('action')=="getEvent") {
    $id=get('id');
    $detail='';
    $db->select("vevento","id_matrix,nombre_matrix,evento_matrix,referencia_matrix,img_matrix,contenido_matrix","WHERE id_matrix = ".$id);
    if($db->num_rows()>0){
        $row=$db->fetch_object();
         $detail='<img src="'.BASE_URL.'imagenes/evento/imagen1/pequena/'.$row->img_matrix.'" alt="'.$row->nombre_matrix.'" title="'.$row->nombre_matrix.'">
                   <div class="txt">
                        <h4>'.$row->nombre_matrix.'</h4>
                        '.$row->contenido_matrix.'
                   </div>';
         response(array("msg"=>"ok","detail"=>$detail), 200);
    }else{
         response(array("msg"=>"fail"), 200);
    }
}

/*registro*/
if (post('action')!=null&&post('action')=="doRegistro") {
    
    
    $prepend=array(
        "idr"=>1,
        "nombre_registrado"=>post('nombre_registrado'),
        "apellido_registrado"=>post('apellido_registrado'),
        "correo_registrado"=>post('correo_registrado'),
        "contrasena_registrado"=>hash_password(post('contrasena_registrado')),
    );
    $insert=$db->insert('registrado',$prepend);
    $idinsert=$db->insert_id;
    
    /*Imagen usuario*/
        if ($_FILES['img_registrado']['name'] != "") {
            
            $aux = explode(".", $_FILES['img_registrado']['name']);
            $nombre_cambiar = $idinsert . "." . $aux[count($aux) - 1];
            $nombre_archivo = strtolower($nombre_cambiar);
            
            if(copy($_FILES['img_registrado']['tmp_name'], "../imagenes/registrado/" . $nombre_archivo)
              &&copy($_FILES['img_registrado']['tmp_name'], "../imagenes/registrado/thumb/" . $nombre_archivo)){
                
                    include_once ('../lib/thumbnail/thumb_plugins/thumbnail.inc.php');
                    //grandes
                    $thumb = new Thumbnail("../imagenes/registrado/" . $nombre_archivo);
                    if ($thumb->getCurrentHeight() > 203) {
                        $thumb->resize(0, 203);
                        $thumb->save("../imagenes/registrado/" . $nombre_archivo);
                        $thumb->destruct();
                    }
                     $thumb = new Thumbnail("../imagenes/registrado/" . $nombre_archivo);
                    if ($thumb->getCurrentWidth() > 203) {
                        $thumb->resize(203, 0);
                        $thumb->save("../imagenes/registrado/" . $nombre_archivo);
                        $thumb->destruct();
                    }
                    
                    //pequeña
                    $thumb = new Thumbnail("../imagenes/registrado/thumb/" . $nombre_archivo);
                    if ($thumb->getCurrentHeight() > 200) {
                        $thumb->resize(0, 200);
                        $thumb->save("../imagenes/registrado/thumb/" . $nombre_archivo);
                        $thumb->destruct();
                    }
                     $thumb = new Thumbnail("../imagenes/registrado/thumb/" . $nombre_archivo);
                    if ($thumb->getCurrentWidth() > 200) {
                        $thumb->resize(200, 0);
                        $thumb->save("../imagenes/registrado/thumb/" . $nombre_archivo);
                        $thumb->destruct();
                    }
                    $db->update("registrado",array("img_registrado"=>$nombre_archivo),"WHERE id_registrado={$idinsert}");
                    $_SESSION['image']=$nombre_archivo;
            }else{
                $updateImg=false;
            }
        }
    
     
    if ($insert) {
         response(array("msg"=>"ok"), 200);
        $_SESSION['is_logged']=true;
        $_SESSION['id']=$idinsert;
        $_SESSION['nombre']=post('nombre_registrado');
        $_SESSION['apellido']=post('apellido_registrado');
        $_SESSION['correo']=post('correo_registrado');
    }else{
         response(array("msg"=>"fail"), 200);
    }
}
/*acceder por el  login*/
if (post('action')!=null&&post('action')=="dologin") {
    $email=post('email');
    $password=hash_password(post('password'));
    $db->select("registrado","id_registrado,nombre_registrado,apellido_registrado,correo_registrado",
                "WHERE correo_registrado='{$email}' AND contrasena_registrado='{$password}' AND idr=1");
   
    if ($db->num_rows()>0) {
        $row=$db->fetch_object();
         response(array("msg"=>"ok"), 200);
         
        $_SESSION['is_logged']=true;
        $_SESSION['id']=$row->id_registrado;
        $_SESSION['nombre']=$row->nombre_registrado;
        $_SESSION['apellido']=$row->apellido_registrado;
        $_SESSION['correo']=$row->correo_registrado;
    }else{
         response(array("msg"=>"fail"), 200);
    }
}

/*verificar si el correo ya existe de un usuario*/
if (post('action')!=null&&post('action')=="checkEmail") {
    $email =post("email");
    $db->select("registrado","correo_registrado","WHERE correo_registrado='{$email}' AND idr=1");
    if ($db->num_rows()>0) {
        response(array("msg"=>"exist"), 200);
    }else{
        response(array("msg"=>"no exist"), 200);
    }
}
/*recuperar contraseña*/
if(post('action')!=null&&post('action')=="recoveryPassword"){
       
    $new = get_random();
    $email = trim(post("email"));
    
    $db->select("registrado","correo_registrado","WHERE correo_registrado='{$email}' AND idr=1");
    
    if ($db->num_rows()>0) {
        
		$destino = $email;
		$remitente = "info@doral.com";
                $asunto = "Recuperar contraseña";
		$mensaje = "
		<table>
		  <tr>
		    <td colspan='2' align='center'>Datos de contraseña</td>
		  </tr>
                  <tr>
                    <td><p>Se ha generado una nueva contraseña para que ingrese de nuevo al sitio ".BASE_URL." y no te pierdas de lo que pasa en Doral Digital</p></td>
		  </tr>
		  <tr>
                    <td>Nueva contraseña: <strong>{$new}</strong></td>
		  </tr>
                  <tr>
		    <td><p>Recuerda cambiar tu contraseña periodicamente para mayor seguridad en tu cuenta doral</p></td>
		  </tr>
		</table>
		";
              $mg = new Mailgun("key-6db384b68f7def3d424575b569e0cbd5");
              $domain = "sandbox8cc1e566070d455f81436b8197b23429.mailgun.org";

              $resultMsg=$mg->sendMessage($domain, array('from'=> $remitente, 
                                                'to'      => $destino, 
                                                'subject' => $asunto, 
                                                'html'    => $mensaje));
            
                if($resultMsg){

                    $new= hash_password($new);
                    $update =$db->update("registrado",array("contrasena_registrado"=>$new),"WHERE correo_registrado='{$email}' AND idr=1");
                  
                    if ($update) {
                        response(array("msg"=>"ok"), 200);
                        
                    }else{
                        response(array("msg"=>"fail"), 200);
                    }
                    
                }else{
                    response(array("msg"=>"fail","d"=>"error"), 200);
                }
               
     }else{
         response(array("msg"=>"not"), 200);
    }
}
/*obtener productos por filtro*/
if (get('action')!=null&&get('action')=="getProducts") {
    $q=get("term");
    $return =array();
    
            
    $db->select("vnegocio AS p",
             "p.id_matrix,"
            ."c.nombre_categoria AS categoria_hijo,"
            ."cp.nombre_categoria AS categoria_padre,"
            ."p.nombre_matrix,p.amigable_matrix",
             "INNER JOIN categoria as c ON c.id_categoria=p.id_categoria "
            ."INNER JOIN categoria as cp ON cp.id_categoria=c.de "
            ."WHERE p.nombre_matrix LIKE '%".$q."%' GROUP BY p.id_matrix");

    if($db->num_rows()>0){
        while($row=$db->fetch_object()){
             $return[]=array(
              "value"=>$row->categoria_padre."/".$row->categoria_hijo."/".$row->nombre_matrix,
              "id"=>$row->id_matrix,
              "amigable"=>$row->amigable_matrix
          );
        }
       
    }
    response($return,200);
}
/*votar por un porductor*/
if (post('action')!=null&&post('action')=="rating") {
    
        $start =post('starts');
        $id_product =post('product');
        $id_user =post('user');
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
            echo response(array("rating"=>ceil(($sum/$count)),"product"=>$id_product),200);
         }
         
}
/*comentar un producto*/
if (post('action')!=null&&post('action')=="doComment") {
    date_default_timezone_set('America/Bogota');
    $currentDate = date('Y-m-d H:i:s');
    $prepend=array(
        "id_maestra"=>post('product'),
        "id_registrado"=>post('user'),
        "comentario"=>post('comment'),
        "estado_comentario"=>0,
        "fecha_comentario"=>$currentDate
    );
    $insert=$db->insert("comentario",$prepend);
    if ($insert) {
        response(array("msg"=>"ok"),200);
    }else{
        response(array("msg"=>"fail"),200);
    }
}
/*obetenr comentario de un producto*/
if (get('action')!=null&&get('action')=='getComments') {
    $product=get('product');
    $page_number=filter_var(get("page"), FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
    $item_per_page=10;
    $position = ($page_number * $item_per_page);
    $render="";
    $db->select("comentario AS c","c.comentario,u.img_registrado,u.nombre_registrado",
            "INNER JOIN registrado AS u ON u.id_registrado=c.id_registrado "
            ."WHERE c.id_maestra={$product} AND estado_comentario=1 ORDER BY id_comentario DESC LIMIT {$position},{$item_per_page}");
    if($db->num_rows()>0){
        while($row_comm=$db->fetch_object()){
             if ($row_comm->img_registrado != "") {
                if (preg_match("%^((https?://)|(www\.)|(http?://))([a-z0-9-].?)+(:[0-9]+)?(/.*)?$%i", $row_comm->img_registrado)) {
                    $imgUserComm = $row_comm->img_registrado;
                } else {
                    $imgUserComm = BASE_URL . "imagenes/registrado/thumb/" . $row_comm->img_registrado;
                }
            } else {
                $imgUserComm = BASE_URL . "imagenes/registrado/default.jpg";
            }
             $render.=' <li><span><img src="'.$imgUserComm.'" alt="'.$row_comm->nombre_registrado.'" title="'.$row_comm->nombre_registrado.'"/></span><p>'.$row_comm->comentario.'</p></li>';
        }
    }
    if ($render!="") {
         response(array("msg"=>"ok","data"=>$render),200);
    }else{
         response(array("msg"=>"fail"),200);
    }
}


/*cerrar sesion*/
if (post('action')!=null&&post('action')=="logout") {
    @session_destroy();
    response(array("msg"=>"ok"), 200);
    
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