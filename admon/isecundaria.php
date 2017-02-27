<? 
include ('../lib/funciones.php');

require_once("../Connections/database.php");
include "crear_json.php";
crear_json_vistas("secundaria","order by id asc");
 
$id = $_GET['id'];
$idr = $_GET['idr'];
$id_categoria = $_GET['id_categoria'];
$op = $_GET['op'];
$t1 = "mtipo";
$valor = variable(155, 2);
$modulo = $valor[0];
if ($idr) {
    //identifico modulo

    $db->select("modulo, idmo, idioma","modulo.*, idioma.idioma","where idmo.idioma=idioma.id_idioma and idmo.modulo=modulo.id_modulo and  id_idmo='" . $idr . "'");
	$rowh = $db->fetch_assoc();

    $tabla=$rowh["nombre_modulo"]."/secundaria";

}

session_start(); 





if (!isset($_SESSION["id_usuario"])) {?><script>window.location="logueo.php?msg=1"</script> <? }
$titulo_modulo = "Fotos";



$action= isset($_REQUEST['action']) ?  $_REQUEST['action'] : "";

$msg= isset($_REQUEST["msg"]) ? $_REQUEST["msg"] : "";

$id= isset($_REQUEST['id']) ?  $_REQUEST['id'] : "";




//tamaños de fotos secundarias

	$db->select("modulo, idmo, idioma","modulo.*, idioma.idioma","where idmo.idioma=idioma.id_idioma and idmo.modulo=modulo.id_modulo and  id_idmo='" . $_GET['idr'] . "'");
	$rowh = $db->fetch_assoc();




$width_thumb= isset($_REQUEST['width_thumb']) ?  $_REQUEST['width_thumb'] : $rowh['anchosp'];

$height_thumb= isset($_REQUEST['height_thumb']) ?  $_REQUEST['height_thumb'] : $rowh['altosp'];

$max_width_pic= isset($_REQUEST['max_width_pic']) ?  $_REQUEST['max_width_pic'] : $rowh['anchosg'];

$max_height_pic= isset($_REQUEST['max_height_pic']) ?  $_REQUEST['max_height_pic'] : $rowh['altosg'];
$tabla= isset($_REQUEST['tabla']) ?  $_REQUEST['tabla'] : $tabla;





function resize_foto($aux,$id_generado){


	global $db;
	$width_thumb = $GLOBALS['width_thumb'];
    $tabla=$GLOBALS['tabla'];
	$height_thumb = $GLOBALS['height_thumb'];

	$max_width_pic = $GLOBALS['max_width_pic'];

	$max_height_pic = $GLOBALS['max_height_pic'];
	$nombre_cambiar="pic_" . $id_generado . "_" . rand(1000,65000) . "." . $aux[count($aux)-1]  ;
	$nombre_archivo = strtolower($nombre_cambiar);
   copy($_FILES['Filedata']['tmp_name'], "../imagenes/".$tabla."/" . $nombre_archivo ) ;
	include_once('thumbnail.inc.php');



	if(strtoupper($aux[count($aux)-1])=="BMP"){

		$res = ImageCreateFromBMP("../imagenes/".$tabla."/" . $nombre_archivo);

		unlink("../imagenes/".$tabla."/" . $nombre_archivo );

		$nombre_archivo="ct" . $id_generado . "_" . rand(1000,65000) . ".jpg";

		imagejpeg($res, "../imagenes/".$tabla."/" . $nombre_archivo);

	}

	

	

	//Imagen Thumbnail

	$thumb = new Thumbnail("../imagenes/".$tabla."/" . $nombre_archivo);

	

	$ratio = $height_thumb / $width_thumb;



	$width = $thumb->getCurrentWidth();

	$height = $thumb->getCurrentHeight();

	

	$ratio = $height_thumb / $width_thumb;

	$padding = 0;

	

	$virtual_width = $width - ($padding * 2);

	$virtual_height = $virtual_width * $ratio;

	

	if($virtual_height > $height ){

		$virtual_height = $height - ($padding * 2);

		$virtual_width = $virtual_height / $ratio;

	}

	

	$x = ($width - $virtual_width)/2;

	$y = ($height - $virtual_height) /2;
    $thumb->crop($x,$y,$virtual_width,$virtual_height);
	$thumb->resize($width_thumb,0);
	//$thumb->resize($width_thumb,$height_thumb);

	$thumb->save("../imagenes/".$tabla."/thumb/" . $nombre_archivo);

	$thumb->destruct();

	

	$thumb = new Thumbnail("../imagenes/".$tabla."/" . $nombre_archivo);

	if($thumb->getCurrentWidth() > $max_width_pic) {

		$thumb->resize($max_width_pic,0);

		$thumb->save("../imagenes/".$tabla."/" . $nombre_archivo);

		$thumb->destruct();

	}

	

		$thumb = new Thumbnail("../imagenes/".$tabla."/" . $nombre_archivo);

	if($thumb->getCurrentHeight() > $max_height_pic) {

		$thumb->resize(0,$max_height_pic);

		$thumb->save("../imagenes/".$tabla."/" . $nombre_archivo);

		$thumb->destruct();

	}



	$sql = "UPDATE   secundaria SET foto='".$nombre_archivo."' WHERE id=" . sql_seguro($id_generado);
	/*
	$res = @mysql_query($sql); if (!$res) exit(mysql_error());
	*/
	  $updatecontenido = $db->prepare($sql);
  $updatecontenido->execute();
  $updatecontenido->close();


	return $nombre_archivo;

}





if ($action=="upload") { 

	if (!empty($_FILES)) {


			$sql = "INSERT INTO secundaria (idr) VALUES('" . sql_seguro($id) . "')";

			  $insertmatrix = $db->prepare($sql);
  $insertmatrix->execute();
  $id_generado = $insertmatrix->insert_id;
  $insertmatrix->close();

			resize_foto(explode(".",$_FILES['Filedata']['name']),$id_generado);

			echo "1";
	}

}

//elimino la imagen

if (!isset($_SESSION["id_usuario"])) {?><script>window.location="logueo.php?msg=1"</script> <? }



else{





if ($action=="delete_foto") { 

	$db->select("secundaria","*"," WHERE id='" . $_REQUEST['id_foto'] . "'");
$row = $db->fetch_assoc();
	

	if($row['foto']!=""){

		

		if(file_exists("../imagenes/".$tabla."/" . $row['foto']))

			unlink("../imagenes/".$tabla."/" . $row['foto'] );

		if(file_exists("../imagenes/".$tabla."/thumb/" . $row['foto']))

			unlink("../imagenes/".$tabla."/thumb/" . $row['foto'] );

	}

	$db->delete("secundaria","WHERE id='" . $_REQUEST['id_foto'] . "'");
	

	echo "1";

	

	return;

} //end - delete_foto



if ($action=="titulos_pic") { 

	$cpadre = array();
$db->select("secundaria","*","WHERE idr='" . sql_seguro($id) . "'");
/*$db->last_query();*/
    while ($arraypadre = $db->fetch_array()) {
		$cpadre[] = $arraypadre; 
    }
foreach ($cpadre as $row) {
		

		

		

		$sql2 = "UPDATE secundaria SET titulo='" . sql_seguro($_POST[$row['id']]) . "'";

		$sql2 .= " WHERE id='" . $row['id']. "'";

		  $updatecontenido = $db->prepare($sql2);
  $updatecontenido->execute();
  $updatecontenido->close();
		

		

		

	}

	?>



    <script>window.location="<?= $_SERVER['PHP_SELF']?>?idr=<?php echo $idr; ?>&tabla=<?= $tabla?>&id=<?= $id?>&id_categoria=<?= $id_categoria ?>&width_thumb=<?= $width_thumb?>&height_thumb=<?= $height_thumb?>&max_width_pic<?= $max_width_pic?>";</script>



<?	return; 

}



 

if ($action=="orden") { 



	$items = explode(",",$_REQUEST['orden']);

	$j=1;

	foreach($items as $item){

		

		if($item=="")

			continue;	

		

		$sql_items ="UPDATE secundaria SET orden_foto='". $j++ ."' WHERE id='". $item ."' ; ";

		  $updatecontenido = $db->prepare($sql_items);
  $updatecontenido->execute();
  $updatecontenido->close();
	}

	

	echo "1";

	

	return;

}?>





<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link rel="stylesheet" href="css/formato_textos.css" type="text/css" />

<link href="../js/panel/jquery/color_picker/color_picker.css" rel="stylesheet" type="text/css">

<link rel="stylesheet" href="css/reset.css" type="text/css" media="screen" />

<link rel="stylesheet" href="css/invalid.css" type="text/css" media="screen" />	



<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />

<script type="text/javascript" src="../js/panel/jquery-1.3.2.min.js"></script><br />

<script src="../js/panel/jquery/ifx.js" type="text/javascript"></script>

<script src="../js/panel/idrop.js" type="text/javascript"></script>

<script src="../js/panel/idrag.js" type="text/javascript"></script>

<script src="../js/panel/iutil.js" type="text/javascript"></script>

<script src="../js/panel/islider.js" type="text/javascript"></script>

<script src="../js/panel/color_picker/color_picker.js" type="text/javascript"></script>

<script type="text/javascript" src="../js/panel/simpla.jquery.configuration.js"></script>

<script type="text/javascript" src="../js/panel/facebox.js"></script>

<script type="text/javascript" src="../js/panel/jquery.wysiwyg.js"></script>

<script type="text/javascript" src="../js/panel/jquery.datePicker.js"></script>

<script type="text/javascript" src="../js/panel/jquery.date.js"></script>

<script type="text/javascript" src="ckeditor/ckeditor.js"></script>

<link rel="stylesheet" type="text/css" href="../js/panel/epoch/epoch_styles.css"/>

<script type="text/javascript" src="../js/panel/epoch/epoch_classes.js"></script>





<script src="../js/panel/jquery.js" type="text/javascript"></script>

<script src="../js/panel/jquery-ui.js" type="text/javascript"></script>

<link href="../js/panel/custom-theme/jquery-ui.css" rel="stylesheet" type="text/css" />

<link href="css/admin_style.css" rel="stylesheet" type="text/css" />





<style type="text/css">

	#sortable { list-style-type: none; margin: 0; padding: 0; }

	#sortable li {

	float: left;

	margin: 4px;

	padding: 1px;

	width:auto;

	height:auto;

	overflow:hidden;

	cursor:move;

	}

	#tabs{background:none; border:none;}



	

	</style>

	<script type="text/javascript">

	$(function() {

		$("#sortable").sortable({

		   update: function(event, ui) { guardar_orden(); }

		});

		$("#sortable").disableSelection();

	});

	</script>



<script type="text/javascript" src="../js/panel/swfobject.js"></script>

<script type="text/javascript" src="../js/panel/jquery.uploadify/jquery.uploadify.min.js"></script>

<script type="text/javascript">

$(document).ready(function() {

	$("#uploadify").uploadify({

		'uploader'       : '../js/panel/jquery.uploadify/uploadify.swf',

		'script'         : '<?= $_SERVER['PHP_SELF']?>',

		'scriptData'     : {'action': 'upload','tabla': '<?=$tabla?>','id': '<?=$id?>','width_thumb': '<?=$width_thumb?>','height_thumb': '<?=$height_thumb?>','max_width_pic': '<?=$max_width_pic?>','max_height_pic': '<?=$max_height_pic?>'},

		'cancelImg'      : '../js/panel/jquery.uploadify/cancel.png',

		'queueID'        : 'fileQueue',

		'auto'           : true,

		'multi'          : true,

		'onAllComplete'  : function(event, d) {

			window.location="<?= $_SERVER['PHP_SELF']?>?id_categoria=<?php echo $_GET['id_categoria']; ?>&idr=<?php echo $idr; ?>&msg=1&tabla=<?=$tabla?>&id=<?=$id?>&width_thumb=<?=$width_thumb?>&height_thumb=<?=$height_thumb?>&max_width_pic=<?=$max_width_pic?>&max_height_pic=<?=$max_height_pic?>"

          }

	});

	

	guardar_orden();

});

</script>







	</head>

  

	<body>

    <div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->

<?php include ('menu_izq.php'); ?>

		

		<div id="main-content"> <!-- Main Content Section with everything -->

			

			<div id="miga">

              <noscript><!-- Show a notification if the user has disabled javascript -->

				<div class="notification error png_bg">

					<div>

						 <?php $valor = variable(22, 2);

echo $valor[1]; ?>				</div>

				</div>

			  </noscript>

              



<? if ($msg <> "") {

    if ($msg == "1") {

        $valor = variable(16, 2);

        $msg = $valor[0];

    }

    if ($msg == "2") {

        $valor = variable(17, 2);

        $msg = $valor[0];

    }

    if ($msg == "3") {

        $valor = variable(18, 2);

        $msg = $valor[0];

    }

    if ($msg == "4") {

        $valor = variable(19, 2);

        $msg = $valor[0];

    }

?>

<div class="notification success png_bg">

<a href="#" class="close"><img src="imgs/cross_grey_small.png" title="Close this notification" alt="close" /></a>

<div>

<?php echo $msg ?>  <?php echo $modulo ?></div>

</div>

<?php } ?>

<p class="punteado"><strong><?php $valor = variable(8, 2);

echo $valor[0]; ?>  <?php echo $_SESSION['nombre_usuario'] ?></strong></p>

			  <div class="miga">

            	

                <a href="#"><?php $valor = variable(9, 2);

echo $valor[0]; ?></a>  <a href="#" class="flecha_miga"><?php echo $modulo ?></a> <a href="<?= $_SERVER['PHP_SELF'] ?>?idr=<?php echo

$idr ?>" class="flecha_miga"><?php $valor = variable(3, 2);

echo $valor[0]; ?> <?php echo $modulo ?></a>
                <div class="clear"></div>

            <h2><?php if ($id) {

    $valor = variable(2, 2);

    echo $valor[0];

} else {

    $valor = variable(3, 2);

    echo $valor[0];

} ?> <span class="urgente"><?php echo $modulo ?> 



<? 

$db->select("matrix","*","where id_matrix='" . $_GET['id'] . "'");
$rowm = $db->fetch_assoc();
?> <?= $rowm["nombre_matrix"] ?>
 a <?php echo $rowh['anchosg'] ?> pixeles  de ancho por <?php echo $rowh['altosg'] ?> de alto</span></h2>

              </div>

			  <div class="clear"></div>

			  <!-- End .clear -->

			

              <div class="notification attention png_bg">

				<a href="#" class="close"><img src="imgs/cross_grey_small.png" title="Close this notification" alt="close" /></a>

				<div>

					<?php $valor = variable(97, 2);

echo $valor[1]; ?></div>

			  </div>

              </div>

			

			

			

			

		  <div class="clear"></div> <!-- End .clear -->

			

			<div class="content-box"><!-- Start Content Box -->

				

				<div class="content-box-header">

					

					<h3><img src="imgs/comment_48.png" width="25" height="25" /><?php echo $modulo ?> mysqli</h3>

					

					<!--<ul class="content-box-tabs">

						<li><a href="#tab1" class="default-tab">Table</a></li> <!-- href must be unique and match the id of target div 

						<li><a href="#tab2">Forms</a></li>

					</ul>-->

					

					<div class="clear"></div>

					

			  </div> <!-- End .content-box-header -->

				

				<div class="content-box-content"><!-- End #tab1 -->

					

                    



                    

                

                

                

                

                

                

 <!-- inicio lista -->  

<div class="clear"></div> <!-- End .clear -->

<div class="content-box"><!-- Start Content Box -->

				

				<div class="content-box-header">

<?  

				$db->select("modulo","*"," WHERE id_modulo='".$id."'");
$row = $db->fetch_assoc();
				 ?>					

					<h3 class="titu_secc"><a href="#" title="<?php echo $row['nombre_modulo'] ?>" class="txt_verde"><?php echo $row['nombre_modulo'] ?></a> <a href="contenido.php?idr=<?php echo $_GET['idr'] ?>&amp;id_categoria=<?php echo $_GET['id_categoria'] ?>">&lt;&lt;<?php $valor = variable(138, 2);

echo $valor[0]; ?>&gt;&gt;</a></h3>

			

   

		

				

					

				  <div class="clear"></div>

					

				</div> <!-- End .content-box-header -->

				

				<div class="content-box-content">

                

                

                                      <? if ($action=="") {

	

?>

                      

                      

                      <form action="<?= $_SERVER['PHP_SELF']?>?action=titulos_pic&amp;tabla=<?php echo $tabla ?>&amp;id=<?= $id?>&amp;&amp;idr=<?= $idr ?>&id_categoria=<?= $id_categoria ?>" method="post" name="form1" id="form1">

                        <table align="center" cellpadding="3" cellspacing="3" class="borde_imagen" >

                          <tr>

                            <td class="tabla">

                            <input name="uploadify" type="file" class="fomulario" id="uploadify" value="Cargar" />                            <div id="fileQueue"></div></td>

                            <td><input type="submit" class="botom" value="Guardar Titulos" /></td>

                          </tr>

                        </table>

                        <div class="clear"></div>

                        <ul id="sortable">

                          <? 

    	$cpadre = array();
$db->select("secundaria","*","WHERE idr='".$id."' ORDER BY orden_foto");
/*$db->last_query();*/
    while ($arraypadre = $db->fetch_array()) {
		$cpadre[] = $arraypadre; 
    }
foreach ($cpadre as $row) {  
    	?>

                          <li class="ui-state-default border_radius" id="id_<?= $row['id']?>" style="160px;">

                            <table width="150" border="0" align="center" cellpadding="0" cellspacing="2" class="tabla2">

                              <tr>

                                <td height="<?php echo $height_thumb+6 ?>" colspan="2" style="text-align: center; padding:1px;"><img src="../imagenes/<?php echo $tabla ?>/thumb/<?= $row['foto']?>" class="borde_imagen" /></td>

                              </tr>

                              <tr>

                                <td align="center" bgcolor="#EFEFEF"><input name="<?= $row['id']?>" type="text" class="fomulario" value="<?= $row['titulo']?>" size="10" /></td>

                                <td align="center" bgcolor="#EFEFEF"><div class="btn_eliminar"><a href="javascript:delete_foto('<?= $row['id']?>')" title="Eliminar Foto"><img src="ico/Xion.png" width="25" height="25" border="0" /></a></div></td>

                              </tr>

                            </table>

                          </li>

                          <? }?>

                        </ul>

                        <div class="clear"></div>

                      </form>

                      

                      

                      

                      <script language="JavaScript" type="text/javascript">

function insert_foto(id){

	window.location="<?= $_SERVER['PHP_SELF']?>?action=insert_foto" ;

}



function update_foto(id){

	window.location="<?= $_SERVER['PHP_SELF']?>?action=update_foto&id_foto=" + id;

}



function fotos_foto(id){

	window.location="admin_fotos.php?tabla=foto&id_foto=" + id;

}



function delete_foto(id){

	if(confirm("Esta seguro de eliminar este foto?")) {

		$.ajax({

			type: "POST",

			url: "<?= $_SERVER['PHP_SELF']?>?action=delete_foto&tabla=producto&id=<?=$id?>&id_foto=" + id,

			success: function(msg){

			   	if(msg==1){$("#id_"+id).fadeOut(function(){guardar_orden();});}

				else{alert("Ha ocurrido un error, comuniquese con el administrador");}

			}

		 });

	}

}



function guardar_orden(){

	var a = $("#sortable > li");

	var orden = "";

	for (var i = 0; i < a.length; i++) {

		var id_item = a[i].id.replace("id_","") ;

		orden +=id_item + ","; 

	}

	

	$.ajax({

		type: "POST",

		url: "<?= $_SERVER['PHP_SELF']?>?action=orden&tabla=<?=$tabla?>",

		data: "orden=" + orden,

		success: function(msg){}

	});

}

                      </script>

                      <? }?>                                                

					

					<div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->

						

						<!--<div class="notification attention png_bg">

							<a href="#" class="close"><img src="imgs/cross_grey_small.png" title="Close this notification" alt="close" /></a>

							<div>

								This is a Content Box. You can put whatever you want in it. By the way, you can close this notification with the top-right cross.

							</div>

						</div>-->



						

				  </div> 



				  <!-- End #tab1 -->

					

				      

					

				</div> <!-- End .content-box-content -->

				

			</div>  

             <!-- fin lista -->   

                

                

                

                

                

                

                

                

                

                

                

                

                

                

                

                

                

                

                

                    

					      

					

			  </div> <!-- End .content-box-content -->

				

			</div> <!-- End .content-box --><!-- End .content-box --><!-- End .content-box --><!-- Start Notifications --><!-- End Notifications -->

		    <?php include ('pie.php'); ?>

		</div> 

		<!-- End #main-content -->

		

	</div></body>

  <script language="javascript">

function deletex(id){

	if(confirm("<?php $valor = variable(43, 2);

echo $valor[0]; ?>")) {

		window.location="<?= $_SERVER['PHP_SELF'] ?>?op=3&idr=<?php echo $idr ?>&idb=" + id;

	}

}

    </script>

</html>



  <? }?>