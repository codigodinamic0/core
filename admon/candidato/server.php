<?php
session_start();
include '../../Connections/database.php';

/*

 * @function getCities

 * @param post id departamento

 * @return resultset cities

 */

if(isset($_POST['action'])&&$_POST['action']=="getCities"){

   if(is_numeric($_POST['depto'])){

        $innerResponse ='';

        $selected='';

       if(isset($_POST['selected'])){

           $selected=$_POST['selected'];

       }

        $db->select("ciudad",'id_ciudad,nombre_ciudad',"WHERE id_departamento={$_POST['depto']}");

        if($db->num_rows()){
            $innerResponse.='<option value="0" >Otra ciudad</option>';
            while($row = $db->fetch_object()){

                if($selected==$row->id_ciudad){

                    $innerResponse.='<option value="'.$row->id_ciudad.'" selected="selected" >'.$row->nombre_ciudad.'</option>';

                }else{

                    $innerResponse.='<option value="'.$row->id_ciudad.'" >'.$row->nombre_ciudad.'</option>';

                }

              

            }

        }else{

            $innerResponse='<option value="0">Otra ciudad</option>';

        }

        echo $innerResponse;

    }else{

        echo 'no esta permitido el acceso';

    }

}



/*

 * @function GetUserData|| create use if not exist

 * @param post cc

 * @return data if exist

 */

if(isset($_POST['action'])&&$_POST['action']=="checkUser"){

    header('Content-Type: application/json');

    if (is_numeric($_POST['cc'])) {

        $db->select("candidato","*","WHERE cedula='{$_POST['cc']}'");

        if($db->num_rows()){

            $user =$db->fetch_object();

            $db->select("candidato_laboral AS c","c.*,t.nombre_tipo AS motivo","LEFT JOIN tipo AS t ON t.id_tipo=c.motivo_laboral "

                        . "WHERE id_candidato={$user->id} ORDER BY id_laboral DESC");

            $work=array();

          

            while($row =$db->fetch_object()){

                

                 $work[]=array(

                    'id_laboral'=>$row->id_laboral,

                    'empresa_laboral'=>$row->empresa_laboral , 

                    'cargo_laboral'=>$row->cargo_laboral , 

                    'ingreso_laboral'=>$row->ingreso_laboral ,

                    'retiro_laboral' =>$row->retiro_laboral, 

                    'motivo_laboral'=>$row->motivo , 

                    'salario_laboral'=>$row->salario_laboral , 

                    'funciones_laboral'=>$row->funciones_laboral , 

                    'telefono_laboral'=>$row->telefono_laboral ,

                    'jefe_laboral'=>$row->jefe_laboral , 

                     );

              

            }

            $db->select("relacion AS r","r.con,t.nombre_tipo",

                        "INNER JOIN tipo AS t ON t.id_tipo=r.con "

                        ."WHERE de={$user->id} AND r.id_tipo IN(69,97,93)");

            $relacion =array();

            if($db->num_rows()){

                while($row = $db->fetch_object()){

                    $relacion[]=array(

                        'name'=>strtolower(str_replace(" ","-", $row->nombre_tipo)),

                        'id'=>$row->con

                    );

                }

            }

            echo json_encode(array("status"=>"ok","data"=>$user,"work"=>$work,"relacion"=>$relacion));

           

        }else{

           $insert =$db->insert("candidato",array('cedula'=>$_POST['cc'],'contrasena'=>hash_password($_POST['cc']),"id_registrado"=>$_SESSION['id_usuario']));

           $last =$db->insert_id;

           if($insert){

               echo json_encode(array("status"=>"ok","id"=>$last));

           }

        }

    }else{

        echo json_encode(array("status"=>"invalid"));

    }

}

//infromacion laboral del candidato

if(isset($_POST['action'])&&$_POST['action']=='addLabor'){

    header('Content-Type: application/json');

    if (is_numeric($_POST['candidato'])) {

        $data =  json_decode($_POST['data']);

        if(count($data)){

            $checkIfLaborExist =false;

            $prepend=array();

            

            if($_POST['id_labor']<>0){

                $checkIfLaborExist =true;

            }

            

            foreach ($data as $value){
                    $prepend[$value->name]=$value->value;                

            }

            $prepend=array_merge($prepend,array("id_candidato"=>$_POST['candidato']));

            $motivo='';

            

            if($checkIfLaborExist){

                    $update =$db->update('candidato_laboral',$prepend,"WHERE id_laboral={$_POST['id_labor']}");

                    if($prepend['motivo_laboral']!=''){

                     $db->select('tipo','nombre_tipo',"WHERE id_tipo={$prepend['motivo_laboral']}");

                        if($db->num_rows()){

                            $row =$db->fetch_object();

                            $motivo =$row->nombre_tipo;

                        }  

                    }

                    if($update){

                        echo json_encode(array("status"=>"ok","labor"=>$_POST['id_labor'],"motivo"=>$motivo));

                    }else{

                        echo json_encode(array("status"=>"fail"));

                    }

                }else{

                    $insert=$db->insert('candidato_laboral',$prepend);

                    if($prepend['motivo_laboral']!=''){

                     $db->select('tipo','nombre_tipo',"WHERE id_tipo={$prepend['motivo_laboral']}");

                        if($db->num_rows()){

                            $row =$db->fetch_object();

                            $motivo =$row->nombre_tipo;

                        }  

                    }

                    if($insert){

                    $lastInsert= $db->insert_id;

                        echo json_encode(array("status"=>"ok","labor"=>$lastInsert,"motivo"=>$motivo));

                    }else{

                        echo json_encode(array("status"=>"fail"));

                    }

                }

        }

    }

}

/*obtener la informacion existente de informacion laboral*/

if(isset($_POST['action'])&&$_POST['action']=='getLaborInfo'){

    header('Content-Type: application/json');

    

    if(is_numeric($_POST['id_labor'])){

        

        $db->select("candidato_laboral","*","WHERE id_laboral={$_POST['id_labor']}");

        if($db->num_rows()){

            echo json_encode(array("status"=>"ok","data"=>$db->fetch_object()));

        }else{

            echo json_encode(array("status"=>"fail"));

        }

    }

}

/*remover informacion laboral*/

if(isset($_POST['action'])&&$_POST['action']=='removeLaborInfo'){

    header('Content-Type: application/json');

     if(is_numeric($_POST['id_labor'])){

         $delete =$db->delete('candidato_laboral',"WHERE id_laboral={$_POST['id_labor']}");

         if ($delete) {

              echo json_encode(array("status"=>"ok"));

         }else{

              echo json_encode(array("status"=>"fail"));

         }

     }

}



/*agergar imagen del candidato*/

if(isset($_POST['action'])&&$_POST['action']=='addImage'){

    header('Content-Type: application/json');

    if(is_numeric($_POST['relation'])){

        

        $target_dir = "../../imagenes/foto/";

        $picName = explode('.',basename($_FILES["picture"]["name"]));

        $picName =$_POST['relation'].".".$picName[1];

    

        $target_file = $target_dir .$picName; //basename($_FILES["picture"]["name"]);

        $uploadOk = 1;

        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);



        if (isset($_POST["picture"])) {

            $check = getimagesize($_FILES["picture"]["tmp_name"]);

            if ($check !== false) {

               $uploadOk = 1;

            } else {

               $uploadOk = 0;

            }

        }

        if ($_FILES["picture"]["size"] > 500000) {



            $uploadOk = 0;

        }

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {



            $uploadOk = 0;

        }

        if ($uploadOk ==1) {

            if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {

               

               $update=$db->update('candidato',array('foto'=>$picName),"WHERE id={$_POST['relation']}");

                

                if($update){

                    

                     include_once ('../thumbnail.inc.php');

                    $thumb = new Thumbnail("../../imagenes/foto/" . $picName);

                    if ($thumb->getCurrentWidth() > 100) {

                        $thumb->resize(100,100);

                        $thumb->save("../../imagenes/foto/thumb/" . $picName);

                        $thumb->destruct();



                    }

                     echo json_encode(array("status"=>"ok","pic"=>"../../imagenes/foto/thumb/" . $picName));

                    

                }else{

                    echo json_encode(array("status"=>"fail"));

                }

            } else {

                echo json_encode(array("status"=>"fail"));

            }

        } else {

            echo json_encode(array("status"=>"fail"));

        }

    }//end numeric valid

}

if(isset($_POST['action'])&&$_POST['action']=='save'){

    header('Content-Type: application/json');

    if(is_numeric($_POST['candidato'])){

        

        /*agrego relaciones*/

        $courses =  json_decode($_POST['courses']);

        $interest =json_decode($_POST['interest']);

        $attitudes =json_decode($_POST['attitudes']);

        $db->delete("relacion","WHERE id_tipo IN(69,97,93) AND de={$_POST['candidato']}");

        

            if(count($courses)){

                $prependCourse =array();

                foreach ($courses as $value) {

                    $prependCourse=array(

                        'id_tipo'=>69,

                        'de'=>$_POST['candidato'],

                        'con'=>$value

                    );

                 $db->insert("relacion",$prependCourse);

                }

            }

             if(count($interest)){

                $prependInterest =array();

                foreach ($interest as $value) {

                    $prependInterest=array(

                        'id_tipo'=>97,

                        'de'=>$_POST['candidato'],

                        'con'=>$value

                    );

                 $db->insert("relacion",$prependInterest);

                }

            }

            if(count($attitudes)){

                $prependAttitudes =array();

                foreach ($attitudes as $value) {

                    $prependAttitudes=array(

                        'id_tipo'=>93,

                        'de'=>$_POST['candidato'],

                        'con'=>$value

                    );

                 $db->insert("relacion",$prependAttitudes);

                }

            }

        

        $data =  json_decode($_POST['data']);

        // if(isset($data->contrasena)){

        //     $data->contrasena=md5($data->contrasena);

        // }

        
        $update= $db->update("candidato",$data,"WHERE id={$_POST['candidato']}");
        

        if ($update) {

            echo json_encode(array("status"=>"ok"));

        }else{

            echo json_encode(array("status"=>"fail"));

        }

    }

}

if(isset($_POST['action'])&&$_POST['action']=='delete'){

    header('Content-Type: application/json');

    if (is_numeric($_POST['candidato'])) {

        

        $db->delete("relacion","WHERE id_tipo IN(69,97,93) AND de={$_POST['candidato']}");

        $db->delete("candidato_laboral","WHERE id_candidato={$_POST['candidato']}");

        $db->select("candidato","foto","WHERE id={$_POST['candidato']}");

        if($db->num_rows()){

            $row =$db->fetch_object();

            if($row->foto!=''){

                unlink("../../imagenes/foto/thumb/".$row->foto);

                unlink("../../imagenes/foto/".$row->foto);

            }

        }

        $candidato=$db->delete('candidato',"WHERE id={$_POST['candidato']}");

        if($candidato){

            echo json_encode(array("status"=>"ok"));

        }else{

           echo json_encode(array("status"=>"fail")); 

        }

        

    }

}



/*hash*/

function hash_password($s, $t = 2)

{

    for ($i = 0; $i < $t; $i++)

        $s = md5(sha1($s));

    return $s;

}