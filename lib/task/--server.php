<?php

session_start();

require_once("../Connections/database.php");

require ("../lib/functions.php");

header('Content-Type: application/json');

$dominio = "http://webmarket.com.co/mondongos/";



if (get('action')!=null&&get('action')=="locations") {

//cargar arreglo de direcciones por defecto he idioma

    $idioma=get('lang');

    $categoria=get('id_categoria');

   

    $db->select("vsede", "id_matrix,img_matrix,contenido_matrix,referencia_matrix,codigo_matrix,seo_matrix,nombre_matrix", "WHERE id_categoria={$categoria} AND idioma={$idioma}");

    $sedes = array();

    if ($db->num_rows() > 0) {

        while ($row = $db->fetch_object()) {

            $sedes[] = $row;

        }

    }

    if(get('id')!=null){

        $tmp=array();

        for($i=0;$i<count($sedes);$i++) {

            if ($sedes[$i]->id_matrix==get('id')) {

                $tmp[]=$sedes[$i];

                unset($sedes[$i]);

            }

        }

        $sedes=array_merge($tmp,$sedes);

    }

    

    response(array("status"=>"ok","data"=>$sedes),200);

}



/*datos de empresa*/

if (get('action')!=null&&get('action')=="company") {

    $id=get('id');

    $db->select("vempresa","contenido_matrix","WHERE id_matrix={$id}");

    if ($db->num_rows()>0) {

        $company =$db->fetch_object();

        response(array("status"=>"ok","data"=>$company->contenido_matrix),200);

    }else{

        response(array("status"=>"fail"),200);

    }

}

/*cargar momentos*/

if(get('action')!=null&&get('action')=="loadMagic"){

    

    $innerHtml='';    

    $page_number=filter_var(get("page"), FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);

    $item_per_page=6;

    $position = ($page_number * $item_per_page);

    $idioma =get('lang');

    $next=$page_number+1;

    $db->select("vmomento", "id_matrix,nombre_matrix,img_matrix,amigable_matrix", "WHERE idioma={$idioma} ORDER BY id_matrix DESC LIMIT {$position},{$item_per_page}");

  

    if($db->num_rows()){

        while($row = $db->fetch_object()){



            $innerHtml.='<div class = "col-md-6 items">

                            <label>'.$row->nombre_matrix.'

                            </label>
                            <a href="'.$dominio.$row->amigable_matrix."/".$row->id_matrix.'/'.$idioma.'/cod3/#moment_detail">
                            <div class="contimg"  style="background:url('.$dominio.'imagenes/momento/imagen1/pequena/'.$row->img_matrix.'); background-position: center; background-size: 100%;">

                                   <img src="'.$dominio.'img/hoverimg.png" alt="'.$row->nombre_matrix.'" title="'.$row->nombre_matrix.'" class="img-responsive">  

                            </div></a>

                            </div>';

        }

    }

    if($innerHtml!=''){

        response(array("status"=>"ok","data"=>$innerHtml,"next"=>$next), 200);

    }else{

        response(array("status"=>"fail","data"=>""), 200);

    }

}



/*cargar kids*/

if(get('action')!=null&&get('action')=="loadKids"){

    

    $innerHtml='';    

    $page_number=filter_var(get("page"), FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);

    $item_per_page=6;

    $position = ($page_number * $item_per_page);

    $idioma =get('lang');

    $categoria =get('categoria');

    $next=$page_number+1;

    $db->select("vkid","id_matrix,nombre_matrix,img_matrix,amigable_matrix","WHERE id_categoria={$categoria} AND idioma={$idioma} ORDER BY id_matrix DESC LIMIT {$position},{$item_per_page}");

                           

    if($db->num_rows()){

        while($row = $db->fetch_object()){



            $innerHtml.='<div class = "col-md-6 items">

                            <label>'.$row->nombre_matrix.'

                            </label>
                             <a href="'.$dominio.$row->amigable_matrix."/".$row->id_matrix.'/'.$categoria.'/'.$idioma.'/cod5/#kid_detail">
                            <div class="contimg" style="background:url('.$dominio.'imagenes/kid/imagen1/pequena/'.$row->img_matrix.'); background-position: center; background-size: 100%;">

                                  <img src="'.$dominio.'img/hoverimg.png" alt="'.$row->nombre_matrix.'" title="'.$row->nombre_matrix.'" class="img-responsive">   

                            </div>
                            </a>
                            <a href="javascript:void(0)" class="printImg btn btn-primary" rel="'.$row->id_matrix.'">Imprimir</a>

                            <div style="display:none" id="printable_'.$row->id_matrix.'">

                                <img src="'.$dominio.'imagenes/kid/imagen1/'.$row->img_matrix.'"  />

                            </div>

                            </div>';

        }

    }

    if($innerHtml!=''){

        response(array("status"=>"ok","data"=>$innerHtml,"next"=>$next), 200);

    }else{

        response(array("status"=>"fail","data"=>""), 200);

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



