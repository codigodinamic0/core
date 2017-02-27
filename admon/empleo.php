<?php include ('../lib/funciones.php'); ?>
<?php include ('include_mysqli.php'); ?>
<?

$maximo=getMaxUpload()*1024*1024;

$destacado_matrix = isset($_POST['destacado_matrix']) ? "1" : "0";

$estado_matrix = isset($_POST['estado_matrix']) ? "1" : "0";

$vendido_matrix = isset($_POST['vendido_matrix']) ? "1" : "0";

$nuevo_matrix = isset($_POST['nuevo_matrix']) ? "1" : "0";

$id = $_GET['id'];

$idr = $_GET['idr'];

$id_categoria = $_GET['id_categoria'];

$op = $_GET['op'];

$t1 = "matrix";

$valor = variable(101, 2);

$modulo = $valor[0];



if ($idr) {

    //identifico modulo

    $db->select("modulo, idmo, idioma","modulo.*, idioma.idioma","where idmo.idioma=idioma.id_idioma and idmo.modulo=modulo.id_modulo and  id_idmo='" . $idr . "'");
	$rowh = $db->fetch_assoc();

    $modulo =$rowh["nombre_modulo"];

	 $carpeta =$rowh["nombre_modulo"];

	$nivel =$rowh["nivel_modulo"];

}

//fin identificacion de modulo tipos

if ($op == "1") {

include ('valida_formatos.php');



    $sql = "UPDATE `matrix` SET 

`id_idmo`='" . sql_seguro($idr) . "',

`id_marca`='" .sql_seguro($_POST['id_marca']) . "', 

`id_icono`='" . sql_seguro($_POST['id_icono']) . "',

`id_categoria`='" .sql_seguro($_POST['id_categoria']) . "',

`id_subcategoria`='" .sql_seguro($_POST['id_subcategoria']) . "',

`nombre_matrix`='" . sql_seguro($_POST['nombre_matrix']) . "',

`descripcion_matrix`='" . sql_seguro($_POST['descripcion_matrix']) ."',

`seo_matrix`='" . (str_replace(chr(39),chr(34), sql_seguro($_POST['seo_matrix']))) . "',    

`contenido_matrix`='" . sql_seguro($_POST['contenido_matrix']) ."',
`adicional_matrix`='" . sql_seguro($_POST['adicional_matrix']) ."',  

`codigo_matrix`='" . sql_seguro($_POST['codigo_matrix']) . "',

`referencia_matrix`='" . sql_seguro($_POST['referencia_matrix']) ."', 

`url_matrix`='" . sql_seguro($_POST['url_matrix']) . "',
`abre_matrix`='" . sql_seguro($_POST['abre_matrix']) . "',

`mapa_matrix`='" . sql_seguro($_POST['mapa_matrix']) . "',

`video_matrix`='" . sql_seguro($_POST['video_matrix']) . "',

`precio_matrix`='" . sql_seguro($_POST['precio_matrix']) ."', 

`precio1_matrix`='" . sql_seguro($_POST['precio1_matrix']) . "',

`destacado_matrix`='" . sql_seguro($destacado_matrix) ."', 

`estado_matrix`='" . sql_seguro($estado_matrix) . "',

`inventario_matrix`='" . sql_seguro($_POST['inventario_matrix']) ."', 

`vendido_matrix`='" . sql_seguro($vendido_matrix) . "',

`nuevo_matrix`='" . sql_seguro($nuevo_matrix) . "',

`evento_matrix`='" . sql_seguro($_POST['evento_matrix']) ."', 

`fecha_matrix`='" . sql_seguro($_POST['fecha_matrix']) . "',

`ubica_matrix`='" . sql_seguro($_POST['ubica_matrix']) ."',
`id_tipo`='" . sql_seguro($_POST['id_tipo']) ."'

WHERE (`id_matrix`='" . sql_seguro($_POST['id_matrix']) . "')";

  $updatecontenido = $db->prepare($sql);
  $updatecontenido->execute();
  $updatecontenido->close();
//actualizacion archivo

if ($_FILES['archivo']['name'] != "") {

	$aux = explode(".",$_FILES['archivo']['name']);

	$nombre_cambiar=limpiar_url($_POST['nombre_matrix']).$_POST['id'] . "." . $aux[count($aux)-1];

	$nombre_archivo = strtolower($nombre_cambiar);

	copy ($_FILES['archivo']['tmp_name'], "../imagenes/".$modulo."/archivo/".$nombre_archivo) ;

	

	$sql = "UPDATE matrix set archivo_matrix='" . $nombre_archivo . "' where id_matrix='" . $_POST['id_matrix'] . "'";

	//echo $sql;

	  $updatecontenido = $db->prepare($sql);
  $updatecontenido->execute();
  $updatecontenido->close();

}



//actualizacion archivo

if ($_FILES['flash']['name'] != "") {

	$aux = explode(".",$_FILES['flash']['name']);

	$nombre_cambiar=limpiar_url($_POST['nombre_matrix']).$_POST['id'] . "." . $aux[count($aux)-1];

	$nombre_archivo = strtolower($nombre_cambiar);

	copy ($_FILES['flash']['tmp_name'], "../imagenes/".$modulo."/flash/".$nombre_archivo) ;

	

	$sql = "UPDATE matrix set flash_matrix='" . $nombre_archivo . "' where id_matrix='" . $_POST['id_matrix'] . "'";

	//echo $sql;

	  $updatecontenido = $db->prepare($sql);
  $updatecontenido->execute();
  $updatecontenido->close();
}



//actualizacion archivo

if ($_FILES['mp3']['name'] != "") {

	$aux = explode(".",$_FILES['mp3']['name']);

	$nombre_cambiar=limpiar_url($_POST['nombre_matrix']).$_POST['id'] . "." . $aux[count($aux)-1];

	$nombre_archivo = strtolower($nombre_cambiar);

	copy ($_FILES['mp3']['tmp_name'], "../imagenes/".$modulo."/mp3/".$nombre_archivo) ;

	

	$sql = "UPDATE matrix set mp3_matrix='" . $nombre_archivo . "' where id_matrix='" . $_POST['id_matrix'] . "'";

	//echo $sql;

	  $updatecontenido = $db->prepare($sql);
  $updatecontenido->execute();
  $updatecontenido->close();

}

	

//actualizacion imagen 2 

if ($_FILES['img1_matrix']['name'] != "") {

	$aux = explode(".",$_FILES['img1_matrix']['name']);

	$nombre_cambiar=limpiar_url($_POST['nombre_matrix']).$_POST['id'] . "." . $aux[count($aux)-1];

	$nombre_archivo = strtolower($nombre_cambiar);

	copy ($_FILES['img1_matrix']['tmp_name'], "../imagenes/".$modulo."/imagen2/".$nombre_archivo) ;

	include_once('thumbnail.inc.php');

//grandes	

	$thumb = new Thumbnail("../imagenes/".$modulo."/imagen2/".$nombre_archivo);

	if($thumb->getCurrentHeight() > $rowh['alto1g']) {

    $thumb->resize(0,$rowh['alto1g']);

	//$thumb->crop(0,0,720,252);

	$thumb->save("../imagenes/".$modulo."/imagen2/".$nombre_archivo);

	$thumb->destruct();

	

		}

		

					$thumb = new Thumbnail("../imagenes/".$modulo."/imagen2/".$nombre_archivo);

	if($thumb->getCurrentWidth() > $rowh['ancho1g']) {

    $thumb->resize($rowh['ancho1g'],0);

	//$thumb->crop(0,0,720,252);

	$thumb->save("../imagenes/".$modulo."/imagen2/".$nombre_archivo);

	$thumb->destruct();

	

		}

// medianas

	$thumb = new Thumbnail("../imagenes/".$modulo."/imagen2/".$nombre_archivo);

	if($thumb->getCurrentHeight() >$rowh['alto1m']) {

    $thumb->resize(0,$rowh['alto1m']);

	//$thumb->crop(0,0,720,252);

	$thumb->save("../imagenes/".$modulo."/imagen2/mediana/".$nombre_archivo);

	$thumb->destruct();

	

		}

		else {

$thumb->save("../imagenes/".$modulo."/imagen2/mediana/".$nombre_archivo);

$thumb->destruct();

}



	$thumb = new Thumbnail("../imagenes/".$modulo."/imagen2/mediana/".$nombre_archivo);

	if($thumb->getCurrentWidth() >$rowh['ancho1m']) {

    $thumb->resize($rowh['ancho1m'],0);

	//$thumb->crop(0,0,720,252);

	$thumb->save("../imagenes/".$modulo."/imagen2/mediana/".$nombre_archivo);

	$thumb->destruct();

	

		}

		

		// pequenas

	$thumb = new Thumbnail("../imagenes/".$modulo."/imagen2/".$nombre_archivo);

	if($thumb->getCurrentHeight() >$rowh['alto1p']) {

    $thumb->resize(0,$rowh['alto1p']);

	//$thumb->crop(0,0,720,252);

	$thumb->save("../imagenes/".$modulo."/imagen2/pequena/".$nombre_archivo);

	$thumb->destruct();

	

		}

		else {

$thumb->save("../imagenes/".$modulo."/imagen2/pequena/".$nombre_archivo);

$thumb->destruct();

}



	$thumb = new Thumbnail("../imagenes/".$modulo."/imagen2/pequena/".$nombre_archivo);

	if($thumb->getCurrentWidth() >$rowh['ancho1p']) {

    $thumb->resize($rowh['ancho1p'],0);

	//$thumb->crop(0,0,720,252);

	$thumb->save("../imagenes/".$modulo."/imagen2/pequena/".$nombre_archivo);

	$thumb->destruct();

	

		}

	

					

	$sql = "UPDATE matrix set img1_matrix='" . $nombre_archivo . "' where id_matrix='" . $_POST['id_matrix'] . "'";

	//echo $sql;

	  $updatecontenido = $db->prepare($sql);
  $updatecontenido->execute();
  $updatecontenido->close();
}



//actualizacion imagen 3

if ($_FILES['img2_matrix']['name'] != "") {

	$aux = explode(".",$_FILES['img2_matrix']['name']);

	$nombre_cambiar=limpiar_url($_POST['nombre_matrix']).$_POST['id'] . "." . $aux[count($aux)-1];

	$nombre_archivo = strtolower($nombre_cambiar);

	copy ($_FILES['img2_matrix']['tmp_name'], "../imagenes/".$modulo."/imagen3/".$nombre_archivo) ;

	include_once('thumbnail.inc.php');

//grandes	

	$thumb = new Thumbnail("../imagenes/".$modulo."/imagen3/".$nombre_archivo);

	if($thumb->getCurrentHeight() > $rowh['alto2g']) {

    $thumb->resize(0,$rowh['alto2g']);

	//$thumb->crop(0,0,720,252);

	$thumb->save("../imagenes/".$modulo."/imagen3/".$nombre_archivo);

	$thumb->destruct();

	

		}

		

					$thumb = new Thumbnail("../imagenes/".$modulo."/imagen3/".$nombre_archivo);

	if($thumb->getCurrentWidth() > $rowh['ancho2g']) {

    $thumb->resize($rowh['ancho2g'],0);

	//$thumb->crop(0,0,720,252);

	$thumb->save("../imagenes/".$modulo."/imagen3/".$nombre_archivo);

	$thumb->destruct();

	

		}

// medianas

	$thumb = new Thumbnail("../imagenes/".$modulo."/imagen3/".$nombre_archivo);

	if($thumb->getCurrentHeight() >$rowh['alto2m']) {

    $thumb->resize(0,$rowh['alto2m']);

	//$thumb->crop(0,0,720,252);

	$thumb->save("../imagenes/".$modulo."/imagen3/mediana/".$nombre_archivo);

	$thumb->destruct();

	

		}

		else {

$thumb->save("../imagenes/".$modulo."/imagen3/mediana/".$nombre_archivo);

$thumb->destruct();

}



	$thumb = new Thumbnail("../imagenes/".$modulo."/imagen3/mediana/".$nombre_archivo);

	if($thumb->getCurrentWidth() >$rowh['ancho2m']) {

    $thumb->resize($rowh['ancho2m'],0);

	//$thumb->crop(0,0,720,252);

	$thumb->save("../imagenes/".$modulo."/imagen3/mediana/".$nombre_archivo);

	$thumb->destruct();

	

		}

		

		// pequenas

	$thumb = new Thumbnail("../imagenes/".$modulo."/imagen3/".$nombre_archivo);

	if($thumb->getCurrentHeight() >$rowh['alto2p']) {

    $thumb->resize(0,$rowh['alto2p']);

	//$thumb->crop(0,0,720,252);

	$thumb->save("../imagenes/".$modulo."/imagen3/pequena/".$nombre_archivo);

	$thumb->destruct();

	

		}

		else {

$thumb->save("../imagenes/".$modulo."/imagen3/pequena/".$nombre_archivo);

$thumb->destruct();

}



	$thumb = new Thumbnail("../imagenes/".$modulo."/imagen3/pequena/".$nombre_archivo);

	if($thumb->getCurrentWidth() >$rowh['ancho2p']) {

    $thumb->resize($rowh['ancho2p'],0);

	//$thumb->crop(0,0,720,252);

	$thumb->save("../imagenes/".$modulo."/imagen3/pequena/".$nombre_archivo);

	$thumb->destruct();

	

		}

	

					

	$sql = "UPDATE matrix set img2_matrix='" . $nombre_archivo . "' where id_matrix='" . $_POST['id_matrix'] . "'";

	//echo $sql;

	  $updatecontenido = $db->prepare($sql);
  $updatecontenido->execute();
  $updatecontenido->close();
}













//actualizacion imagen principal

if ($_FILES['img_matrix']['name'] != "") {

	$aux = explode(".",$_FILES['img_matrix']['name']);

	$nombre_cambiar=limpiar_url($_POST['nombre_matrix']).$_POST['id'] . "." . $aux[count($aux)-1];

	$nombre_archivo = strtolower($nombre_cambiar);

	copy ($_FILES['img_matrix']['tmp_name'], "../imagenes/".$modulo."/imagen1/".$nombre_archivo) ;

	include_once('thumbnail.inc.php');

//grandes	

	$thumb = new Thumbnail("../imagenes/".$modulo."/imagen1/".$nombre_archivo);

	if($thumb->getCurrentHeight() > $rowh['altog']) {

    $thumb->resize(0,$rowh['altog']);

	//$thumb->crop(0,0,720,252);

	$thumb->save("../imagenes/".$modulo."/imagen1/".$nombre_archivo);

	$thumb->destruct();

	

		}

		

					$thumb = new Thumbnail("../imagenes/".$modulo."/imagen1/".$nombre_archivo);

	if($thumb->getCurrentWidth() > $rowh['anchog']) {

    $thumb->resize($rowh['anchog'],0);

	//$thumb->crop(0,0,720,252);

	$thumb->save("../imagenes/".$modulo."/imagen1/".$nombre_archivo);

	$thumb->destruct();

	

		}

// medianas

	$thumb = new Thumbnail("../imagenes/".$modulo."/imagen1/".$nombre_archivo);

	if($thumb->getCurrentHeight() >$rowh['altom']) {

    $thumb->resize(0,$rowh['altom']);

	//$thumb->crop(0,0,720,252);

	$thumb->save("../imagenes/".$modulo."/imagen1/mediana/".$nombre_archivo);

	$thumb->destruct();

	

		}

		else {

$thumb->save("../imagenes/".$modulo."/imagen1/mediana/".$nombre_archivo);

$thumb->destruct();

}



	$thumb = new Thumbnail("../imagenes/".$modulo."/imagen1/mediana/".$nombre_archivo);

	if($thumb->getCurrentWidth() >$rowh['anchom']) {

    $thumb->resize($rowh['anchom'],0);

	//$thumb->crop(0,0,720,252);

	$thumb->save("../imagenes/".$modulo."/imagen1/mediana/".$nombre_archivo);

	$thumb->destruct();

	

		}

		

		// pequenas

	$thumb = new Thumbnail("../imagenes/".$modulo."/imagen1/".$nombre_archivo);

	if($thumb->getCurrentHeight() >$rowh['altop']) {

    $thumb->resize(0,$rowh['altop']);

	//$thumb->crop(0,0,720,252);

	$thumb->save("../imagenes/".$modulo."/imagen1/pequena/".$nombre_archivo);

	$thumb->destruct();

	

		}

		else {

$thumb->save("../imagenes/".$modulo."/imagen1/pequena/".$nombre_archivo);

$thumb->destruct();

}



	$thumb = new Thumbnail("../imagenes/".$modulo."/imagen1/pequena/".$nombre_archivo);

	if($thumb->getCurrentWidth() >$rowh['anchop']) {

    $thumb->resize($rowh['anchop'],0);

	//$thumb->crop(0,0,720,252);

	$thumb->save("../imagenes/".$modulo."/imagen1/pequena/".$nombre_archivo);

	$thumb->destruct();

	

		}

	

					

	$sql = "UPDATE matrix set img_matrix='" . $nombre_archivo . "' where id_matrix='" . $_POST['id_matrix'] . "'";

	//echo $sql;

	  $updatecontenido = $db->prepare($sql);
  $updatecontenido->execute();
  $updatecontenido->close();


?>

            

            <script type="text/javascript">

            window.location="imagen_contenido.php?imagen=1&modulo=<?php echo $modulo ?>&nombre_tabla=matrix&nombre_archivo=<?= $nombre_archivo; ?>&width_thumb=<?= $rowh['anchop'] ?>&height_thumb=<?= $rowh['altop'] ?>&dest=<?= $_SERVER['PHP_SELF'] ?>?idr=<?= $_GET['idr'] ?>&id_categoria=<?php echo $_GET['id_categoria'] ?>&id_matrix=<?php echo $_GET['id_matrix'] ?>";

            

            </script>



            <?

        } else { ?>

    

<script>window.location="<?= $_SERVER['PHP_SELF']?>?op=&msg=1&idr=<?php echo $idr ?>&id=<?php echo $_POST['id'] ?>&id_categoria=<?php echo $_GET['id_categoria'] ?>&";</script>



<? }exit; }?>







<? if ($op == "2") {

include ('valida_formatos.php');





$sql = "INSERT INTO `matrix` (

`id_idmo`, 

`id_marca`,

`id_icono`, 

`id_categoria`,

`id_subcategoria`,

`nombre_matrix`,

`descripcion_matrix`,

`seo_matrix`,

`contenido_matrix`,
`adicional_matrix`,  

`codigo_matrix`,

`referencia_matrix`, 

`url_matrix`, `abre_matrix`,

`mapa_matrix`, 

`video_matrix`,

`precio_matrix`,

`precio1_matrix`,

`destacado_matrix`,

 `estado_matrix`,

`inventario_matrix`,

`vendido_matrix`,

`nuevo_matrix`,

`evento_matrix`, 

`fecha_matrix`, 

`ubica_matrix` , 

`id_tipo`) VALUES";

    $sql = $sql . " ('" . sql_seguro($idr) . "'";

    $sql = $sql . " ,'" . sql_seguro($_POST['id_marca']) . "'";

    $sql = $sql . " ,'" . sql_seguro($_POST['id_icono']) . "'";

    $sql = $sql . " ,'" . sql_seguro($_POST['id_categoria']) . "'";

    $sql = $sql . " ,'" . sql_seguro($_POST['id_subcategoria']) . "'";

    $sql = $sql . " ,'" . sql_seguro($_POST['nombre_matrix']) . "'";

    $sql = $sql . " ,'" . sql_seguro($_POST['descripcion_matrix']) . "'";

    $sql = $sql . " ,'" . sql_seguro($_POST['seo_matrix']) . "'";

    $sql = $sql . " ,'" . sql_seguro($_POST['contenido_matrix']) . "'";
	  $sql = $sql . " ,'" . sql_seguro($_POST['adicional_matrix']) . "'";

    $sql = $sql . " ,'" . sql_seguro($_POST['codigo_matrix']) . "'";

    $sql = $sql . " ,'" . sql_seguro($_POST['referencia_matrix']) . "'";

    $sql = $sql . " ,'" . sql_seguro($_POST['url_matrix']) . "'";
	$sql = $sql . " ,'" . sql_seguro($_POST['abre_matrix']) . "'";

    $sql = $sql . " ,'" . sql_seguro($_POST['mapa_matrix']) . "'";

    $sql = $sql . " ,'" . sql_seguro($_POST['video_matrix']) . "'";

    $sql = $sql . " ,'" . sql_seguro($_POST['precio_matrix']) . "'";

    $sql = $sql . " ,'" . sql_seguro($_POST['precio1_matrix']) . "'";

    $sql = $sql . " ,'" . sql_seguro($destacado_matrix) . "'";

    $sql = $sql . " ,'" . sql_seguro($estado_matrix) . "'";

    $sql = $sql . " ,'" . sql_seguro($_POST['inventario_matrix']) . "'";

    $sql = $sql . " ,'" . sql_seguro($vendido_matrix) . "'";

    $sql = $sql . " ,'" . sql_seguro($nuevo_matrix) . "'";

    $sql = $sql . " ,'" . sql_seguro($_POST['evento_matrix']) . "'";

	$sql = $sql . " ,'" . sql_seguro($_POST['fecha_matrix']) . "'";
	$sql = $sql . " ,'" . sql_seguro($_POST['ubica_matrix']) . "'";

    $sql = $sql . " ,'" . sql_seguro($_POST['id_tipo']) . "')";

      $insertmatrix = $db->prepare($sql);
  $insertmatrix->execute();
  $id_generado = $insertmatrix->insert_id;
  $insertmatrix->close();
//actualizacion archivo

if ($_FILES['archivo']['name'] != "") {

	$aux = explode(".",$_FILES['archivo']['name']);

	$nombre_cambiar=limpiar_url($_POST['nombre_matrix']).$id_generado . "." . $aux[count($aux)-1];

	$nombre_archivo = strtolower($nombre_cambiar);

	copy ($_FILES['archivo']['tmp_name'], "../imagenes/".$modulo."/archivo/".$nombre_archivo) ;

	

	$sql = "UPDATE matrix set archivo_matrix='" . $nombre_archivo . "' where id_matrix='" . $id_generado . "'";

	//echo $sql;

	  $updatecontenido = $db->prepare($sql);
  $updatecontenido->execute();
  $updatecontenido->close();
}



//actualizacion archivo

if ($_FILES['flash']['name'] != "") {

	$aux = explode(".",$_FILES['flash']['name']);

	$nombre_cambiar=limpiar_url($_POST['nombre_matrix']).$id_generado . "." . $aux[count($aux)-1];

	$nombre_archivo = strtolower($nombre_cambiar);

	copy ($_FILES['flash']['tmp_name'], "../imagenes/".$modulo."/flash/".$nombre_archivo) ;

	

	$sql = "UPDATE matrix set flash_matrix='" . $nombre_archivo . "' where id_matrix='" . $id_generado . "'";

	//echo $sql;

	  $updatecontenido = $db->prepare($sql);
  $updatecontenido->execute();
  $updatecontenido->close();
}



//actualizacion archivo

if ($_FILES['mp3']['name'] != "") {

	$aux = explode(".",$_FILES['mp3']['name']);

	$nombre_cambiar=limpiar_url($_POST['nombre_matrix']).$id_generado . "." . $aux[count($aux)-1];

	$nombre_archivo = strtolower($nombre_cambiar);

	copy ($_FILES['mp3']['tmp_name'], "../imagenes/".$modulo."/mp3/".$nombre_archivo) ;

	

	$sql = "UPDATE matrix set mp3_matrix='" . $nombre_archivo . "' where id_matrix='" . $id_generado . "'";

	//echo $sql;

	  $updatecontenido = $db->prepare($sql);
  $updatecontenido->execute();
  $updatecontenido->close();
}

	

	

//actualizacion imagen 2 

if ($_FILES['img1_matrix']['name'] != "") {

	$aux = explode(".",$_FILES['img1_matrix']['name']);

	$nombre_cambiar=limpiar_url($_POST['nombre_matrix']).$id_generado . "." . $aux[count($aux)-1];

	$nombre_archivo = strtolower($nombre_cambiar);

	copy ($_FILES['img1_matrix']['tmp_name'], "../imagenes/".$modulo."/imagen2/".$nombre_archivo) ;

	include_once('thumbnail.inc.php');

//grandes	

	$thumb = new Thumbnail("../imagenes/".$modulo."/imagen2/".$nombre_archivo);

	if($thumb->getCurrentHeight() > $rowh['alto1g']) {

    $thumb->resize(0,$rowh['alto1g']);

	//$thumb->crop(0,0,720,252);

	$thumb->save("../imagenes/".$modulo."/imagen2/".$nombre_archivo);

	$thumb->destruct();

	

		}

		

					$thumb = new Thumbnail("../imagenes/".$modulo."/imagen2/".$nombre_archivo);

	if($thumb->getCurrentWidth() > $rowh['ancho1g']) {

    $thumb->resize($rowh['ancho1g'],0);

	//$thumb->crop(0,0,720,252);

	$thumb->save("../imagenes/".$modulo."/imagen2/".$nombre_archivo);

	$thumb->destruct();

	

		}

// medianas

	$thumb = new Thumbnail("../imagenes/".$modulo."/imagen2/".$nombre_archivo);

	if($thumb->getCurrentHeight() >$rowh['alto1m']) {

    $thumb->resize(0,$rowh['alto1m']);

	//$thumb->crop(0,0,720,252);

	$thumb->save("../imagenes/".$modulo."/imagen2/mediana/".$nombre_archivo);

	$thumb->destruct();

	

		}

		else {

$thumb->save("../imagenes/".$modulo."/imagen2/mediana/".$nombre_archivo);

$thumb->destruct();

}



	$thumb = new Thumbnail("../imagenes/".$modulo."/imagen2/mediana/".$nombre_archivo);

	if($thumb->getCurrentWidth() >$rowh['ancho1m']) {

    $thumb->resize($rowh['ancho1m'],0);

	//$thumb->crop(0,0,720,252);

	$thumb->save("../imagenes/".$modulo."/imagen2/mediana/".$nombre_archivo);

	$thumb->destruct();

	

		}

		

		// pequenas

	$thumb = new Thumbnail("../imagenes/".$modulo."/imagen2/".$nombre_archivo);

	if($thumb->getCurrentHeight() >$rowh['alto1p']) {

    $thumb->resize(0,$rowh['alto1p']);

	//$thumb->crop(0,0,720,252);

	$thumb->save("../imagenes/".$modulo."/imagen2/pequena/".$nombre_archivo);

	$thumb->destruct();

	

		}

		else {

$thumb->save("../imagenes/".$modulo."/imagen2/pequena/".$nombre_archivo);

$thumb->destruct();

}



	$thumb = new Thumbnail("../imagenes/".$modulo."/imagen2/pequena/".$nombre_archivo);

	if($thumb->getCurrentWidth() >$rowh['ancho1p']) {

    $thumb->resize($rowh['ancho1p'],0);

	//$thumb->crop(0,0,720,252);

	$thumb->save("../imagenes/".$modulo."/imagen2/pequena/".$nombre_archivo);

	$thumb->destruct();

	

		}

	

					

	$sql = "UPDATE matrix set img1_matrix='" . $nombre_archivo . "' where id_matrix='" . $id_generado . "'";

	//echo $sql;

	  $updatecontenido = $db->prepare($sql);
  $updatecontenido->execute();
  $updatecontenido->close();
}



//actualizacion imagen 3

if ($_FILES['img2_matrix']['name'] != "") {

	$aux = explode(".",$_FILES['img2_matrix']['name']);

	$nombre_cambiar=limpiar_url($_POST['nombre_matrix']).$id_generado . "." . $aux[count($aux)-1];

	$nombre_archivo = strtolower($nombre_cambiar);

	copy ($_FILES['img2_matrix']['tmp_name'], "../imagenes/".$modulo."/imagen3/".$nombre_archivo) ;

	include_once('thumbnail.inc.php');

//grandes	

	$thumb = new Thumbnail("../imagenes/".$modulo."/imagen3/".$nombre_archivo);

	if($thumb->getCurrentHeight() > $rowh['alto2g']) {

    $thumb->resize(0,$rowh['alto2g']);

	//$thumb->crop(0,0,720,252);

	$thumb->save("../imagenes/".$modulo."/imagen3/".$nombre_archivo);

	$thumb->destruct();

	

		}

		

					$thumb = new Thumbnail("../imagenes/".$modulo."/imagen3/".$nombre_archivo);

	if($thumb->getCurrentWidth() > $rowh['ancho2g']) {

    $thumb->resize($rowh['ancho2g'],0);

	//$thumb->crop(0,0,720,252);

	$thumb->save("../imagenes/".$modulo."/imagen3/".$nombre_archivo);

	$thumb->destruct();

	

		}

// medianas

	$thumb = new Thumbnail("../imagenes/".$modulo."/imagen3/".$nombre_archivo);

	if($thumb->getCurrentHeight() >$rowh['alto2m']) {

    $thumb->resize(0,$rowh['alto2m']);

	//$thumb->crop(0,0,720,252);

	$thumb->save("../imagenes/".$modulo."/imagen3/mediana/".$nombre_archivo);

	$thumb->destruct();

	

		}

		else {

$thumb->save("../imagenes/".$modulo."/imagen3/mediana/".$nombre_archivo);

$thumb->destruct();

}



	$thumb = new Thumbnail("../imagenes/".$modulo."/imagen3/mediana/".$nombre_archivo);

	if($thumb->getCurrentWidth() >$rowh['ancho2m']) {

    $thumb->resize($rowh['ancho2m'],0);

	//$thumb->crop(0,0,720,252);

	$thumb->save("../imagenes/".$modulo."/imagen3/mediana/".$nombre_archivo);

	$thumb->destruct();

	

		}

		

		// pequenas

	$thumb = new Thumbnail("../imagenes/".$modulo."/imagen3/".$nombre_archivo);

	if($thumb->getCurrentHeight() >$rowh['alto2p']) {

    $thumb->resize(0,$rowh['alto2p']);

	//$thumb->crop(0,0,720,252);

	$thumb->save("../imagenes/".$modulo."/imagen3/pequena/".$nombre_archivo);

	$thumb->destruct();

	

		}

		else {

$thumb->save("../imagenes/".$modulo."/imagen3/pequena/".$nombre_archivo);

$thumb->destruct();

}



	$thumb = new Thumbnail("../imagenes/".$modulo."/imagen3/pequena/".$nombre_archivo);

	if($thumb->getCurrentWidth() >$rowh['ancho2p']) {

    $thumb->resize($rowh['ancho2p'],0);

	//$thumb->crop(0,0,720,252);

	$thumb->save("../imagenes/".$modulo."/imagen3/pequena/".$nombre_archivo);

	$thumb->destruct();

	

		}

	

					

	$sql = "UPDATE matrix set img2_matrix='" . $nombre_archivo . "' where id_matrix='" . $id_generado . "'";

	//echo $sql;

	  $updatecontenido = $db->prepare($sql);
  $updatecontenido->execute();
  $updatecontenido->close();
}













//actualizacion imagen principal

if ($_FILES['img_matrix']['name'] != "") {

	$aux = explode(".",$_FILES['img_matrix']['name']);

	$nombre_cambiar=limpiar_url($_POST['nombre_matrix']).$id_generado . "." . $aux[count($aux)-1];

	$nombre_archivo = strtolower($nombre_cambiar);

	copy ($_FILES['img_matrix']['tmp_name'], "../imagenes/".$modulo."/imagen1/".$nombre_archivo) ;

	include_once('thumbnail.inc.php');

//grandes	

	$thumb = new Thumbnail("../imagenes/".$modulo."/imagen1/".$nombre_archivo);

	if($thumb->getCurrentHeight() > $rowh['altog']) {

    $thumb->resize(0,$rowh['altog']);

	//$thumb->crop(0,0,720,252);

	$thumb->save("../imagenes/".$modulo."/imagen1/".$nombre_archivo);

	$thumb->destruct();

	

		}

		

					$thumb = new Thumbnail("../imagenes/".$modulo."/imagen1/".$nombre_archivo);

	if($thumb->getCurrentWidth() > $rowh['anchog']) {

    $thumb->resize($rowh['anchog'],0);

	//$thumb->crop(0,0,720,252);

	$thumb->save("../imagenes/".$modulo."/imagen1/".$nombre_archivo);

	$thumb->destruct();

	

		}

// medianas

	$thumb = new Thumbnail("../imagenes/".$modulo."/imagen1/".$nombre_archivo);

	if($thumb->getCurrentHeight() >$rowh['altom']) {

    $thumb->resize(0,$rowh['altom']);

	//$thumb->crop(0,0,720,252);

	$thumb->save("../imagenes/".$modulo."/imagen1/mediana/".$nombre_archivo);

	$thumb->destruct();

	

		}

		else {

$thumb->save("../imagenes/".$modulo."/imagen1/mediana/".$nombre_archivo);

$thumb->destruct();

}



	$thumb = new Thumbnail("../imagenes/".$modulo."/imagen1/mediana/".$nombre_archivo);

	if($thumb->getCurrentWidth() >$rowh['anchom']) {

    $thumb->resize($rowh['anchom'],0);

	//$thumb->crop(0,0,720,252);

	$thumb->save("../imagenes/".$modulo."/imagen1/mediana/".$nombre_archivo);

	$thumb->destruct();

	

		}

		

		// pequenas

	$thumb = new Thumbnail("../imagenes/".$modulo."/imagen1/".$nombre_archivo);

	if($thumb->getCurrentHeight() >$rowh['altop']) {

    $thumb->resize(0,$rowh['altop']);

	//$thumb->crop(0,0,720,252);

	$thumb->save("../imagenes/".$modulo."/imagen1/pequena/".$nombre_archivo);

	$thumb->destruct();

	

		}

		else {

$thumb->save("../imagenes/".$modulo."/imagen1/pequena/".$nombre_archivo);

$thumb->destruct();

}



	$thumb = new Thumbnail("../imagenes/".$modulo."/imagen1/pequena/".$nombre_archivo);

	if($thumb->getCurrentWidth() >$rowh['anchop']) {

    $thumb->resize($rowh['anchop'],0);

	//$thumb->crop(0,0,720,252);

	$thumb->save("../imagenes/".$modulo."/imagen1/pequena/".$nombre_archivo);

	$thumb->destruct();

	

		}

	

					

	$sql = "UPDATE matrix set img_matrix='" . $nombre_archivo . "' where id_matrix='" . $id_generado . "'";

	//echo $sql;

	  $updatecontenido = $db->prepare($sql);
  $updatecontenido->execute();
  $updatecontenido->close();


?>

            

            <script type="text/javascript">

            window.location="imagen_contenido.php?imagen=1&modulo=<?php echo $modulo ?>&nombre_tabla=matrix&nombre_archivo=<?= $nombre_archivo; ?>&width_thumb=<?= $rowh['anchop'] ?>&height_thumb=<?= $rowh['altop'] ?>&dest=<?= $_SERVER['PHP_SELF'] ?>?idr=<?= $_GET['idr'] ?>&id_categoria=<?php echo $_GET['id_categoria'] ?>&id_matrix=<?php echo $id_generado ?>";

            

            </script>



            <?

        } else { ?>

    

<script>window.location="<?= $_SERVER['PHP_SELF']?>?op=&msg=1&idr=<?php echo $idr ?>&id_matrix=<?php echo $id_generado ?>&id_categoria=<?php echo $_GET['id_categoria'] ?>";</script>



<? }exit; }?>







<? if ($op == "3") {





//empieza while de secundarias

 	$cpadre = array();
$db->select("matrix","*","where id_matrix='" . sql_seguro($_GET['idb']) . "'");
/*$db->last_query();*/
    while ($arraypadre = $db->fetch_array()) {
		$cpadre[] = $arraypadre; 
    }
foreach ($cpadre as $rows) {
	 

	 //imagen principal

	if($rows['img_matrix']!=""){

		if(file_exists("../imagenes/".$carpeta."/imagen1/" . $rows['img_matrix']))

			unlink("../imagenes/".$carpeta."/imagen1/" . $rows['img_matrix']);

			unlink("../imagenes/".$carpeta."/imagen1/mediana/" . $rows['img_matrix']);

			unlink("../imagenes/".$carpeta."/imagen1/pequena/" . $rows['img_matrix']);

	}

	 //imagen1

	if($rows['img1_matrix']!=""){

		if(file_exists("../imagenes/".$carpeta."/imagen2/" . $rows['img1_matrix']))

			unlink("../imagenes/".$carpeta."/imagen2/" . $rows['img1_matrix']);

			unlink("../imagenes/".$carpeta."/imagen2/mediana/" . $rows['img1_matrix']);

			unlink("../imagenes/".$carpeta."/imagen2/pequena/" . $rows['img1_matrix']);

	}

	

	

		 //imagen2

	if($rows['img2_matrix']!=""){

		if(file_exists("../imagenes/".$carpeta."/imagen3/" . $rows['img2_matrix']))

			unlink("../imagenes/".$carpeta."/imagen3/" . $rows['img2_matrix']);

			unlink("../imagenes/".$carpeta."/imagen3/mediana/" . $rows['img2_matrix']);

			unlink("../imagenes/".$carpeta."/imagen3/pequena/" . $rows['img2_matrix']);

	}

	

			 //flash

	if($rows['flash_matrix']!=""){

		if(file_exists("../imagenes/".$carpeta."/flash/" . $rows['flash_matrix']))

			unlink("../imagenes/".$carpeta."/flash/" . $rows['flash_matrix']);



	}

	

			 //archivo

	if($rows['archivo_matrix']!=""){

		if(file_exists("../imagenes/".$carpeta."/archivo/" . $rows['archivo_matrix']))

			unlink("../imagenes/".$carpeta."/archivo/" . $rows['archivo_matrix']);

	}

	

			 //mp3

	if($rows['mp3_matrix']!=""){

		if(file_exists("../imagenes/".$carpeta."/mp3/" . $rows['mp3_matrix']))

			unlink("../imagenes/".$carpeta."/mp3/" . $rows['mp3_matrix']);

	}



	//empieza while de secundarias

 	$cpadre = array();
$db->select("secundaria","*","where idr='" . sql_seguro($rows['id_matrix']) . "'");
/*$db->last_query();*/
    while ($arraypadre = $db->fetch_array()) {
		$cpadre[] = $arraypadre; 
    }
foreach ($cpadre as $row_secundarias) {

			 //imagen2

	if($row_secundarias['foto']!=""){

		if(file_exists("../imagenes/".$carpeta."/secundaria/" . $row_secundarias['foto']))

			unlink("../imagenes/".$carpeta."/secundaria/" . $row_secundarias['foto']);

			unlink("../imagenes/".$carpeta."/secundaria/thumb/" . $row_secundarias['foto']);

	} 

	

	

	//elimino los secundarias

	$db->delete("secundaria","where id='" . sql_seguro($row_secundarias['id']) . "'");
	

	 }





//elimino los productos o registros

	$db->delete("matrix","where id_matrix='" . sql_seguro($rows['id_matrix']) . "'");




//termina while de secundaria	

 }





?>

   

    <script>window.location="<?= $_SERVER['PHP_SELF'] ?>?op=4&msg=3&idr=<?php echo

    $idr ?>&id_categoria=<?php echo

    $id_categoria ?>";</script>



<? }



?>

<? if ($id <> "") {

    $op = 1;

} else {

    $op = 2;

} ?>

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

echo $valor[0]; ?> <?php echo $modulo ?> <?php echo $rowh['idioma'] ?> </a>

            

            <div class="clear"></div>

            <h2><?php if ($id) {

    $valor = variable(2, 2);

    echo $valor[0];

} else {

    $valor = variable(3, 2);

    echo $valor[0];

} ?> <span class="urgente"><?php echo $modulo ?>  <?php echo $rowh['idioma'] ?> 



<? 

$db->select("matrix","*","where id_matrix='" . $_GET['id'] . "'");
$rowm = $db->fetch_assoc();
 ?> <?= $rowm["nombre_matrix"] ?>
 <?php  


$db->select("categoria","*","where  id_categoria='" . $_GET['id_categoria'] . "'");
$row22 = $db->fetch_assoc();
?> 

<?php echo  $row22['nombre_categoria'] ?></span></h2>

              </div>

			  <div class="clear"></div>

			  <!-- End .clear -->

			

              <div class="notification attention png_bg">

				<a href="#" class="close"><img src="imgs/cross_grey_small.png" title="Close this notification" alt="close" /></a>

				<div>

					<?php $valor = variable(97, 2);

echo $valor[1]; ?> <?php echo  $row22['nombre_categoria'] ?>

		        </div>

			  </div>

              </div>

			

			

			

			

		  <div class="clear"></div> <!-- End .clear -->

			

			<div class="content-box"><!-- Start Content Box -->

				

				<div class="content-box-header">

					

					<h3><img src="imgs/comment_48.png" width="25" height="25" /><?php echo $modulo ?> <?php echo $rowh['idioma'] ?> <?php echo  $row22['nombre_categoria'] ?></h3>

					

					<!--<ul class="content-box-tabs">

						<li><a href="#tab1" class="default-tab">Table</a></li> <!-- href must be unique and match the id of target div 

						<li><a href="#tab2">Forms</a></li>

					</ul>-->

					

					<div class="clear"></div>

					

			  </div> <!-- End .content-box-header -->

				

				<div class="content-box-content"><!-- End #tab1 -->

					

<?php if ($nivel<1 or $id_categoria<>""){  ?>               

<form action="<?= $_SERVER['PHP_SELF'] ?>?op=<?php echo $op ?>&amp;idr=<?= $idr ?>&id_categoria=<?php echo $_GET['id_categoria'] ?>" method="post" enctype="multipart/form-data" name="usuarios" id="usuarios">

							

					<fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->

								     



<?php


$cpadre = array();
$db->select("modulo

        INNER JOIN moca ON modulo.id_modulo = moca.modulo

        INNER JOIN campo ON campo.id_campo = moca.campo

        INNER JOIN idmo ON idmo.modulo = modulo.id_modulo

        INNER JOIN idioma ON idioma.id_idioma = idmo.idioma","campo.nombre_campo,

        modulo.nombre_modulo,

        moca.campo,

        moca.modulo,

        modulo.id_modulo,

        moca.id_moca,

        idmo.idioma,

        idioma.idioma,

        idioma.id_idioma,

        idmo.id_idmo","WHERE id_idmo='".$idr."'

        ORDER BY id_moca ASC");
/*$db->last_query();*/
    while ($arraypadre = $db->fetch_array()) {
		$cpadre[] = $arraypadre; 
    }
foreach ($cpadre as $row2) { 

?>

<?php if ($row2['nombre_campo'] == 'video_matrix') {?>

         <p><label><?php $valor = variable(102, 2);

echo $valor[0]; ?> <?php echo $modulo; ?> 

            </label><textarea  class="text-input textarea" id="textarea" name="video_matrix" cols="40" rows="5" placeholder="<iframe width='560' height='315' src='http://www.youtube.com/embed/q-gTOAvEXPY?rel=0' frameborder='0' allowfullscreen></iframe>" ><?php echo

        $rowm['video_matrix'] ?></textarea></p>

    <?php }?>







<?php

    if ($row2['nombre_campo'] == 'mapa_matrix') {

?> 

        <p><label><?php $valor = variable(103, 2);

echo $valor[0]; ?> <?php echo $modulo; ?> 

            </label><textarea  class="text-input textarea" id="textarea" name="mapa_matrix" cols="40" rows="5" placeholder="<iframe width='425' height='350' frameborder='0' 033&amp;sspn=0.043827,0.084543&amp;ie=UTF8&amp;hq=&amp;hnear=175+SW+7th+St,+Miami,+Florida+33130,+United+States&amp;t=m&amp;view=map&amp;ll=25.767329,-80.196966&amp;spn=0.015981,0.01929&amp;z=14' style='color:#0000FF;text-align:left'>View Larger Map</a></small>"><?php echo

        $rowm['mapa_matrix'] ?></textarea></p>

    <?php

    }

?>





<?php if ($row2['nombre_campo'] == 'evento_matrix') { ?>

<p>

  <label><?php $valor = variable(124, 2);

echo $valor[0]; ?>  <?php echo $modulo; ?></label><input name="evento_matrix" type="text"  class="text-input small-input" id="evento_matrix" value="<?= $rowm["evento_matrix"]?>" size="32" readonly="readonly" /></p>

 <?php } ?>



<?php if ($row2['nombre_campo'] == 'url_matrix') { ?>

        

         

<p>

  <label><?php $valor = variable(65, 2);

echo $valor[0]; ?>  <?php echo $modulo; ?></label><input value="<?php echo $rowm['url_matrix'] ?>" class="text-input small-input" type="text" id="small-input" name="url_matrix" /></p>

  <p><label><?php $valor = variable(176, 2);

echo $valor[0]; ?>   <?php echo $modulo; ?> 

        </label><select name="abre_matrix" class="small-input" id="abre_matrix">

                                <?

$cpadre = array();
$db->select("tipo","*","where idr=11");
/*$db->last_query();*/
    while ($arraypadre = $db->fetch_array()) {
		$cpadre[] = $arraypadre; 
    }
foreach ($cpadre as $row_banco) { 
         ?>

                                          <?php if ($rowm["abre_matrix"] == $row_banco['id_tipo']) { ?>

                                                            <option value="<?= $row_banco['id_tipo'] ?>" selected="selected">

                                                            <?= $row_banco['nombre_tipo'] ?>

                                                  </option>

                                          <?php } else { ?>

                                                            <option value="<?= $row_banco['id_tipo'] ?>">

                                                            <?= $row_banco['nombre_tipo'] ?>

                                                  </option>

                                          <?php } ?>

                                          <? } ?>

                    </select></p>

    <?php

    }

?>



<?php

    if ($row2['nombre_campo'] == 'ubica_matrix') {

?>

        <p>

          <label><?php $valor = variable(136, 2);

echo $valor[0]; ?>  <?php echo $modulo; ?></label><input value="<?php echo $rowm['ubica_matrix'] ?>" class="text-input small-input" type="text" id="small-input" name="ubica_matrix" /></p>

    

    <?php

    }

?>







<?php

    if ($row2['nombre_campo'] == 'referencia_matrix') {

?>

        <p><label><?php $valor = variable(104, 2);

echo $valor[0]; ?> <?php echo $modulo; ?> 

            </label><input value="<?php echo $rowm['referencia_matrix'] ?>" class="text-input small-input" type="text" id="small-input" name="referencia_matrix" /></p>

    <?php

    }

?>









<?php
    if ($row2['nombre_campo'] == 'img_matrix') {
?>
        <p><label><?php if($rowm['img_matrix'] <> ""){ ?><img src="../imagenes/<?php echo $modulo ?>/imagen1/pequena/<?= $rowm['img_matrix']?>"  height="50"  style="margin:5px;"/><?php } ?><?php $valor = variable(110, 2);
echo $valor[0]; ?> <?php echo $modulo; ?> 
            </label><input name="img_matrix" type="file" class="text-input small-input" id="img_matrix" />
           (<?php echo getMaxUpload()?>mb max) <?php echo $rowh['anchog']  ?> por <?php echo $rowh['altog'] ?> de alto 
           
<?php if($rowm['img_matrix']){?>**<a href="imagen_contenido.php?modulo=<?php echo $modulo ?>&imagen=1&nombre_archivo=<?= $rowm['img_matrix']?>&width_thumb=<?php echo $rowh["anchop"] ?>&height_thumb=<?php echo $rowh["altop"] ?>&dest=contenido.php?idr=<?php echo $idr; ?>&id_categoria=<?php echo $_GET["id_categoria"] ?>" style="color: blue;"><?php $valor = variable(137, 2); echo $valor[0]; ?></a>**<?php }?></p>
    <?php
    }
?>



<?php
    if ($row2['nombre_campo'] == 'img1_matrix') {
?>
        <p>
          <label><?php if($rowm['img1_matrix'] <> ""){ ?><img src="../imagenes/<?php echo $modulo ?>/imagen2/pequena/<?= $rowm['img1_matrix']?>"  height="50"  style="margin:5px;"/><?php } ?><?php $valor = variable(111, 2);
echo $valor[0]; ?>  <?php echo $modulo; ?> 
            </label>
          <input name="img1_matrix" type="file" class="text-input small-input" id="img1_matrix" />
            (<?php echo getMaxUpload()?>mb max) <?php echo $rowh['ancho1p']  ?> por <?php echo $rowh['alto1p']  ?>  de alto ..
            <?php if($rowm['img1_matrix']){?>**<a href="imagen_contenido.php?modulo=<?php echo $modulo ?>&imagen=2&nombre_archivo=<?= $rowm['img1_matrix']?>&width_thumb=<?php echo $rowh["ancho1p"] ?>&height_thumb=<?php echo $rowh["alto1p"] ?>&dest=contenido.php?idr=<?php echo $idr; ?>&id_categoria=<?php echo $_GET["id_categoria"] ?>" style="color: blue;"><?php $valor = variable(137, 2); echo $valor[0]; ?></a>** <?php }?></p>
   
    <?php
    }
?>



<?php
    if ($row2['nombre_campo'] == 'img2_matrix') {
?>

        <p>
          <label> <?php if($rowm['img2_matrix'] <> ""){ ?><img src="../imagenes/<?php echo $modulo ?>/imagen3/pequena/<?= $rowm['img2_matrix']?>"  height="50"  style="margin:5px;"/><?php } ?> <?php $valor = variable(112, 2);
echo $valor[0]; ?> <?php echo $modulo; ?> 
           </label>
          <input name="img2_matrix" type="file" class="text-input small-input" id="img2_matrix" />
            (<?php echo getMaxUpload()?>mb max) <?php echo $rowh['ancho2g']  ?> por <?php echo $rowh['alto2g'] ?> de alto <?php if($rowm['img2_matrix']){?>**<a href="imagen_contenido.php?modulo=<?php echo $modulo ?>&imagen=3&nombre_archivo=<?= $rowm['img2_matrix']?>&width_thumb=<?php echo $rowh["ancho2p"] ?>&height_thumb=<?php echo $rowh["alto2p"] ?>&dest=contenido.php?idr=<?php echo $idr; ?>&id_categoria=<?php echo $_GET["id_categoria"] ?>" style="color: blue;"><?php $valor = variable(137, 2); echo $valor[0]; ?></a>** <?php }?>
      </p>
    <?php
    }
?>






<?php

    if ($row2['nombre_campo'] == 'flash_matrix') {

?>

        <p>

          <label><?php $valor = variable(143, 2);

echo $valor[0]; ?> <?php echo $modulo; ?> 

            </label>

          <input name="flash" type="file" class="text-input small-input" id="flash" />(<?php echo getMaxUpload()?>mb max)

          <span class="txt_verde"><?php echo $rowm['flash_matrix'] ?></span></p>

    <?php

    }

?>





<?php

    if ($row2['nombre_campo'] == 'archivo_matrix') {

?>

        <p>

          <label><?php $valor = variable(109, 2);

echo $valor[0]; ?> <?php echo $modulo; ?> 

            </label>

          <input name="archivo" type="file" class="text-input small-input" id="archivo" />

          <span class="txt_verde"><?php echo $rowm['archivo_matrix'] ?></span></p>

    <?php

    }

?>







<?php

    if ($row2['nombre_campo'] == 'mp3_matrix') {

?>

        <p>

          <label><?php $valor = variable(108, 2);

echo $valor[0]; ?> <?php echo $modulo; ?> 

            </label>

          <input name="mp3" type="file" class="text-input small-input" id="mp3" />

         <span class="txt_verde"><?php echo $rowm['mp3_matrix'] ?></span></p>

    <?php

    }

?>









<?php

    if ($row2['nombre_campo'] == 'codigo_matrix') {

?>

        <p><label><?php $valor = variable(28, 2);

echo $valor[0]; ?> <?php echo $modulo; ?> 

            </label><input value="<?php echo $rowm['codigo_matrix'] ?>" class="text-input small-input" type="text" id="small-input" name="codigo_matrix" /></p>

 <?php }?>







<?php if ($row2['nombre_campo'] == 'inventario_matrix') {?>

        <p><label><?php $valor = variable(147, 2);

echo $valor[0]; ?> <?php echo $modulo; ?> 

            </label><input value="<?php echo $rowm['inventario_matrix'] ?>" class="text-input small-input" type="text" id="small-input" name="inventario_matrix" onkeyup="this.value = this.value.replace(no_digito, '')"/></p>

 <?php  }?>

 

 

 <?php if ($row2['nombre_campo'] == 'destacado_matrix') {?>

        <p><label><?php $valor = variable(149, 2);

echo $valor[0]; ?> <?php echo $modulo; ?> <input  type="checkbox" name="destacado_matrix" id="destacado_matrix" <? if($rowm["destacado_matrix"]=="1") echo "checked";?> />

            </label></p>

 <?php  }?>

 

 <?php if ($row2['nombre_campo'] == 'estado_matrix') {?>

        <p>

          <label><?php $valor = variable(150, 2);

echo $valor[0]; ?> <?php echo $modulo; ?> 

            <input  type="checkbox" name="estado_matrix" id="estado_matrix" <? if($rowm["estado_matrix"]=="1") echo "checked";?> /></label></p>

 <?php  }?>

 

 

 <?php if ($row2['nombre_campo'] == 'vendido_matrix') {?>

        <p><label><?php $valor = variable(116, 2);

echo $valor[0]; ?> <?php echo $modulo; ?>  

            <input  type="checkbox" name="vendido_matrix" id="vendido_matrix" <? if($rowm["vendido_matrix"]=="1") echo "checked";?> /></label></p>

 <?php  }?>

 

 

 <?php if ($row2['nombre_campo'] == 'nuevo_matrix') {?>

        <p><label><?php $valor = variable(153, 2);

echo $valor[0]; ?> <?php echo $modulo; ?>  

            <input  type="checkbox" name="nuevo_matrix" id="nuevo_matrix" <? if($rowm["nuevo_matrix"]=="1") echo "checked";?> /></label></p>

 <?php  }?>

 

 

 

 



<?php if ($row2['nombre_campo'] == 'nombre_matrix') {?>

        <p><label><?php $valor = variable(10, 2);

echo $valor[0]; ?> <?php echo $modulo; ?> 

            </label><input value="<?php echo $rowm['nombre_matrix'] ?>" class="text-input small-input" type="text" id="small-input" name="nombre_matrix" placeholder="Campo requerido" required="" /></p>

 <?php  }?>













<?php

    if ($row2['nombre_campo'] == 'descripcion_matrix') {

?>

        <p><label><?php $valor = variable(46, 2);

echo $valor[0]; ?> <?php echo $modulo; ?> 

            </label><textarea  class="text-input textarea" id="textarea" name="descripcion_matrix" cols="40" rows="5"><?php echo

        $rowm['descripcion_matrix'] ?></textarea>

        </p>

   <?php

    }



    if ($row2['nombre_campo'] == 'seo_matrix') {

?>

        <p><label><?php $valor = variable(105, 2);

echo $valor[0]; ?> <?php echo $modulo; ?> 

            </label><input value="<?php echo $rowm['seo_matrix'] ?>" class="text-input small-input" type="text" id="small-input" name="seo_matrix" /></p>

    <?php

    }



    if ($row2['nombre_campo'] == 'contenido_matrix') {

?>

            <div style="width:650px;">

              <p><label><?php $valor = variable(101, 2);

echo $valor[0]; ?>  <?php echo $modulo; ?> 

                </label> <textarea name="contenido_matrix" id="contenido_matrix"  cols="90" rows="5"><?= $rowm['contenido_matrix']?>

                                </textarea>

              <script language="javascript">

                     CKEDITOR.replace('contenido_matrix', { filebrowserBrowseUrl: 'simogeo/index.html' });

                     </script></p>

            </div>

    <?php }?>
    
    
    <?php
    
     if ($row2['nombre_campo'] == 'adicional_matrix') {

?>

            <div style="width:650px;">

              <p><label><?php $valor = variable(178, 2);

echo $valor[0]; ?>  <?php echo $modulo; ?> 

                </label> <textarea name="adicional_matrix" id="adicional_matrix"  cols="90" rows="5"><?= $rowm['adicional_matrix']?>

                                </textarea>

              <script language="javascript">

                     CKEDITOR.replace('adicional_matrix', { filebrowserBrowseUrl: 'simogeo/index.html' });

                     </script></p>

            </div>

    <?php }?>





<?php

    if ($row2['nombre_campo'] == 'precio_matrix') {

?>

       <p><label><?php $valor = variable(107, 2);

echo $valor[0]; ?>  <?php echo $modulo; ?> 

            </label><input value="<?php echo $rowm['precio_matrix'] ?>" class="text-input small-input" type="text" id="small-input" name="precio_matrix" onkeyup="this.value = this.value.replace(no_digito, '')" /></p>

    <?php }?>

    

<?php

    if ($row2['nombre_campo'] == 'precio1_matrix') {

?>

       <p><label><?php $valor = variable(106, 2);

echo $valor[0]; ?>  <?php echo $modulo; ?> 

            </label><input value="<?php echo $rowm['precio1_matrix'] ?>" class="text-input small-input" type="text" id="small-input" name="precio1_matrix" /></p>

    <?php }?>

	

	

	<?php

    if ($row2['nombre_campo'] == 'id_marca') {

?>

         <p><label><?php $valor = variable(113, 2);

echo $valor[0]; ?> <?php echo $modulo; ?> 

</label><select name="id_marca" class="small-input" id="id_marca">

                                <?

        $cpadre = array();
$db->select("marca","*");
/*$db->last_query();*/
    while ($arraypadre = $db->fetch_array()) {
		$cpadre[] = $arraypadre; 
    }
foreach ($cpadre as $row_banco) {  ?>

                                          <?php if ($rowm["id_marca"] == $row_banco['id_marca']) { ?>

                                                            <option value="<?= $row_banco['id_marca'] ?>" selected="selected">

                                                            <?= $row_banco['nombre_marca'] ?>

                                                  </option>

                                          <?php } else { ?>

                                                            <option value="<?= $row_banco['id_marca'] ?>">

                                                            <?= $row_banco['nombre_marca'] ?>

                                                  </option>

                                          <?php } ?>

                                          <? } ?>

                    </select></p>

 <?php }?>

 

 

 

 

 <?php

    if ($row2['nombre_campo'] == 'id_icono') {

?>

         <p><label><?php $valor = variable(161, 2);

echo $valor[0]; ?>   <?php echo $modulo; ?> 

        </label><select name="id_marca" class="small-input" id="id_marca">

                                <?

        	$cpadre = array();
$db->select("icono","*");
/*$db->last_query();*/
    while ($arraypadre = $db->fetch_array()) {
		$cpadre[] = $arraypadre; 
    }
foreach ($cpadre as $row_banco) { 
        	?>

                                          <?php if ($rowm["id_icono"] == $row_banco['id_icono']) { ?>

                                                            <option value="<?= $row_banco['id_marca'] ?>" selected="selected">

                                                            <?= $row_banco['nombre_icono'] ?>

                                                  </option>

                                          <?php } else { ?>

                                                            <option value="<?= $row_banco['id_marca'] ?>">

                                                            <?= $row_banco['nombre_icono'] ?>

                                                  </option>

                                          <?php } ?>

                                          <? } ?>

                    </select></p>

 <?php }?>

 

 

 

 

 

 <?php

    if ($row2['nombre_campo'] == 'id_subcategoria') {

?>

         <p><label><?php $valor = variable(171, 2);

echo $valor[0]; ?>   <?php echo $modulo; ?> 

        </label><select name="id_subcategoria" class="small-input" id="id_subcategoria">

                                <?
$cpadre = array();
$db->select("tipo","*", "where idr=7");
/*$db->last_query();*/
    while ($arraypadre = $db->fetch_array()) {
		$cpadre[] = $arraypadre; 
    }
foreach ($cpadre as $row_banco) { 
        	?>

                                          <?php if ($rowm["id_subcategoria"] == $row_banco['id_tipo']) { ?>

                                                            <option value="<?= $row_banco['id_tipo'] ?>" selected="selected">

                                                            <?= $row_banco['nombre_tipo'] ?>

                                                  </option>

                                          <?php } else { ?>

                                                            <option value="<?= $row_banco['id_tipo'] ?>">

                                                            <?= $row_banco['nombre_tipo'] ?>

                                                  </option>

                                          <?php } ?>

                                          <? } ?>

                    </select></p>

 <?php }?>
 
 
 <?php

    if ($row2['nombre_campo'] == 'id_tipo') {

?>

         <p><label><?php $valor = variable(177, 2);

echo $valor[0]; ?>   <?php echo $modulo; ?> 

        </label><select name="id_tipo" class="small-input" id="id_tipo">

                                <?
$cpadre = array();
$db->select("tipo","*", "where idr=10");
/*$db->last_query();*/
    while ($arraypadre = $db->fetch_array()) {
		$cpadre[] = $arraypadre; 
    }
foreach ($cpadre as $row_banco) { 
        	?>

                                          <?php if ($rowm["id_tipo"] == $row_banco['id_tipo']) { ?>

                                                            <option value="<?= $row_banco['id_tipo'] ?>" selected="selected">

                                                            <?= $row_banco['nombre_tipo'] ?>

                                                  </option>

                                          <?php } else { ?>

                                                            <option value="<?= $row_banco['id_tipo'] ?>">

                                                            <?= $row_banco['nombre_tipo'] ?>

                                                  </option>

                                          <?php } ?>

                                          <? } ?>

                    </select></p>

 <?php }?>


 

 

 

 

 

 

 



<?php

    if ($row2['nombre_campo'] == 'id_categoria') {

?>

        <input name="id_categoria" type="hidden" class="text-input small-input" id="small-input" value="<?php echo $id_categoria ?>" />

    <?php

    }



    // if ($row2['nombre_campo'] == 'id_matrix') {



?>

        <input class="text-input small-input"  type="hidden" value="<?php echo $rowm['id_matrix']; ?>" id="small-input" name="id_matrix" />

    <?php

    //}





?>



                              <? } ?>

                              <input class="text-input small-input"  type="hidden" value="<?php echo $rowm['id_matrix']; ?>" id="small-input2" name="id" />



               

								

<p>

									<input class="button" type="submit" value="<?php if ($id) {

    $valor = variable(2, 2);

    echo $valor[0];

} else {

    $valor = variable(3, 2);

    echo $valor[0];

} ?> <?php echo $modulo ?>" />

<input name="idr" type="hidden" id="idr" value="<?= $idr ?>" />

                                    <input name="fecha_matrix" type="hidden" id="fecha_matrix" value="<?= $fecha2 ?>" />

            <br />

					  </p>

								

	      </fieldset><!-- End .clear -->

							

				  </form>

                  

                

                

                

                

                

                

 <!-- inicio lista -->  

<div class="clear"></div> <!-- End .clear -->

<div class="content-box"><!-- Start Content Box -->

				

				<div class="content-box-header">

					

					<h3 class="titu_secc"><a href="#" title="<?php echo $modulo ?>" class="txt_verde"><?php echo

$modulo ?></a></h3>

					

				

					

				  <div class="clear"></div>

					

				</div> <!-- End .content-box-header -->

				

				<div class="content-box-content">

					

					<div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->

						

						<!--<div class="notification attention png_bg">

							<a href="#" class="close"><img src="imgs/cross_grey_small.png" title="Close this notification" alt="close" /></a>

							<div>

								This is a Content Box. You can put whatever you want in it. By the way, you can close this notification with the top-right cross.

							</div>

						</div>-->

						

				  <table>

							

							<tfoot>

								<tr>

									<td colspan="6">&nbsp;</td>

							  </tr>

							</tfoot>

						 

							<tbody>

                            

   <tr>



<td width="459" valign="top" class="txt_verde"><a href="#" title="title" class="txt_verde"><?php $valor =

    variable(10, 2);

echo $valor[0]; ?>   <?php echo $modulo ?></a></td>

<td valign="top" class="txt_verde">&nbsp;</td>

<td width="177" class="txt_verde"><?php $valor = variable(14, 2);

echo $valor[0]; ?></td>

							  </tr>                         

<?php

if ($nivel>0){ $cordi=" where id_categoria='$id_categoria' ";} else{$cordi=" where id_idmo='$idr' ";}

$TAMANO_PAGINA = $_SESSION['paginador'];

$inicio = 0;

$pagina = 1;

$texto = "";

if ($_SESSION['pag']) {

    $pagina = $_SESSION['pag'];

    $inicio = ($pagina - 1) * $TAMANO_PAGINA;



}


$db->select("v$modulo","*","$cordi");
$num_total_registros = $db->num_rows();
//calculo el total de p&aacute;ginas

$total_paginas = ceil($num_total_registros / $TAMANO_PAGINA);

$db->select("v$modulo","*","$cordi". " limit " . $inicio . "," . $TAMANO_PAGINA);
//echo $sql;

$loop = 0;

	$cpadre = array();
/*$db->last_query();*/
    while ($arraypadre = $db->fetch_array()) {
		$cpadre[] = $arraypadre; 
    }
foreach ($cpadre as $row) { 
?>

                            

								<tr>

								  <td valign="top">

                                  <a href="#" title="<?= $row['nombre_matrix'] ?>" class="txt_verde">  <?php

 $db->select("tipo","*","where id_tipo='".$row['id_tipo']."'");
$row_detalle = $db->fetch_assoc();
   ?>
                                  &nbsp;
                                  <?= $row['nombre_matrix'] ?>(<?= $row['id_matrix'] ?>-<?= $row['id_subcategoria'] ?>) <?php echo $row_detalle['nombre_tipo']; ?> <?PHP echo ($row['estado_matrix']==1) ? "Activo" : ""; ?>

									</a>

                                </td>

								  <td width="50" valign="top"><?php if($row['img_matrix'] <> ""){ ?><img src="../imagenes/<?php echo $modulo ?>/imagen1/pequena/<?= $row['img_matrix']?>"  height="50"  style="margin:5px;"/><?php } ?></td>

								  <td>

										<!-- Icons -->

										 <a class=Ntooltip href="<?= $_SERVER['PHP_SELF'] ?>?id=<?= $row['id_matrix'] ?>&amp;op=4&amp;idr=<?php echo

    $idr ?>&amp;id_categoria=<?php echo

    $id_categoria ?>" title="Edit"><img src="imgs/pencil.png" alt="Edit" />

<span>

<?php $valor = variable(2, 2);

    echo $valor[0]; ?> <?= $modulo; ?>

</span>                                         </a>

<a class=Ntooltip href="javascript:deletex('<?= $row['id_matrix'] ?>')" title="Delete"><img src="imgs/cross.png" alt="Delete" width="16" height="16" /><span>

<?php $valor = variable(1, 2);

    echo $valor[0]; ?><?= $modulo; ?>

</span></a>	



<?php if($rowh["anchosg"]>0){?>


<a class=Ntooltip href="isecundaria.php?idr=<?php echo $idr; ?>&id=<?= $row['id_matrix'] ?>&id_categoria=<?php echo $id_categoria ?>" title="Edit"><img src="imgs/image_add_48.png" alt="Edit" width="16" height="16" />

<?php  

$db->select("secundaria","count(id) as total","where  idr='" . $row['id_matrix'] . "'");
$rowcs = $db->fetch_assoc();
 ?> 
<?php echo  $rowcs['total'] ?>
<span>
<?php $valor = variable(155, 2);
    echo $valor[0]; ?> <?= $modulo; ?>
</span></a>
<?php }?></td>

								</tr>

                               <?php } ?>

							</tbody>

						</table>

<div class="pagination">

											

										    <? if (($total_paginas > 1)) { ?>

       

          <? if ($pagina != 1) { ?>

          <a href='<?= $_SERVER['PHP_SELF'] ?>?pg=<?= ($pagina - 1) ?>&idr=<?php echo

        $idr ?>' title="Previous Page"><?php $valor = variable(12, 2);

        echo $valor[0]; ?></a>

          <? } ?>

      

      

      

      

      

      

      

      

    

    <? for ($i = 1; $i <= $total_paginas; $i++) {



        if ($pagina == $i) { ?>

        

       <a href='#' class="number current" title="<?= $pagina ?>"> <?= $pagina ?></a>

        

        <? } else { ?>

<a href='<?= $_SERVER['PHP_SELF'] ?>?pg=<?php echo $i ?>&idr=<?php echo $idr ?>' class="number" title="<?= $i ?>"><?= $i ?></a>

        <? } ?>

        <? } ?>

        

        

        

        

        

        

    

    

    

    

      <? if ($total_paginas != $pagina) { ?>

      <a href='<?= $_SERVER['PHP_SELF'] ?>?pg=<?= ($pagina + 1) ?>&idr=<?php echo

        $idr ?>' title="<?php $valor = variable(13, 2);

        echo $valor[0]; ?>"><?php $valor = variable(13, 2);

        echo $valor[0]; ?></a>

      <? } ?>

      <? } ?>

<br />

						</div>

						

				  </div> 

			<form name="form" id="form">

  <?php $valor = variable(15, 2);

echo $valor[0]; ?>:

    <select name="jumpMenu" id="jumpMenu" onChange="MM_jumpMenu('parent',this,0)">

   <option value=""><?php $valor = variable(27, 2);

echo $valor[0]; ?></option>

   <? 

$cpadre = array();
$db->select("pagina","*");
/*$db->last_query();*/
    while ($arraypadre = $db->fetch_array()) {
		$cpadre[] = $arraypadre; 
    }
foreach ($cpadre as $row) { 
?>

 <?php if ($row["numero"] == $_SESSION['pagina']) { ?>

<option value="<?= $_SERVER['PHP_SELF'] ?>?paginar=<?php echo utf8_encode($row['numero']) ?>&idr=<?php echo

        $idr ?>" selected="selected">

<?php echo utf8_encode($row['numero']) ?>

<?php } else { ?>

 <option value="<?= $_SERVER['PHP_SELF'] ?>?paginar=<?php echo utf8_encode($row['numero']) ?>&idr=<?php echo

        $idr ?>">

<?php echo utf8_encode($row['numero']) ?>

</option>

 <?php } ?>







<? } ?>



  </select>

</form>

				  <!-- End #tab1 -->

					

				      

					

				</div> <!-- End .content-box-content -->

				

			</div>  

             <!-- fin lista -->

    <?php } ?>          

             

             

             

             

      <?php   if($nivel>0){  ?>     

             

             

             <div class="content-box">

               <!-- Start Content Box -->

               <div class="content-box-header">

                 <h3 class="titu_secc"><a href="#" title="<?php echo $modulo ?>" class="txt_verde"><?php echo $modulo ?></a> <a href="categoria.php?idr=<?php echo $idr ?>&amp;nivel=<?php echo $nivel ?>&amp;op=4">&lt;&lt;

                   <?php $valor=variable(157,2); echo $valor[0]; ?>

                   &gt;&gt;</a></h3>

                 <div class="clear"></div>

               </div>

               <!-- End .content-box-header -->

               <div class="content-box-content">

                 <div class="tab-content default-tab" id="tab2">

                   <table>

                     <tfoot>

                       <tr>

                         <td colspan="6"><!-- End .pagination --></td>

                       </tr>

                     </tfoot>

                     <tbody>

                       <tr>

                         <td width="38%" valign="top" class="txt_verde"><a href="#" title="title" class="txt_verde">

                           <?php $valor=variable(10,2); echo $valor[0]; ?>

                           <?php echo $modulo ?></a></td>

                         <td width="25%" class="txt_verde"><?php $valor=variable(14,2); echo $valor[0]; ?></td>

                       </tr>

                       <?php

$TAMANO_PAGINA =$_SESSION['paginador']; 

$inicio = 0; 

$pagina=1; 

$texto="";

if ($_SESSION['pag']) {

$pagina = $_SESSION['pag'];

$inicio = ($pagina - 1) * $TAMANO_PAGINA; 



        } 

                    $db->select("categoria","*","where modulo='".$idr."' and nivel_categoria=1  order by  ubica_categoria asc");
                    $num_total_registros = $db->num_rows();
                    //calculo el total de p&aacute;ginas 

$total_paginas = ceil($num_total_registros / $TAMANO_PAGINA); 


                  	$db->select("categoria","*","where modulo='".$idr."' and nivel_categoria=1  order by  ubica_categoria asc". " limit " . $inicio . "," . $TAMANO_PAGINA);  

                     

                    //echo $sql;

                    $loop=0;

$cpadre = array();
/*$db->last_query();*/
    while ($arraypadre = $db->fetch_array()) {
		$cpadre[] = $arraypadre; 
    }
foreach ($cpadre as $row) { 
?>

                       <tr>

                         <td valign="top"><a href="#" title="<?= $row['nombre_variable']?>" class="destacado_verde">

                           <?= $row['nombre_categoria']?></a></td>

                         <td><?php if ($nivel==1) {?><span style="padding:3px;"><a class="Ntooltip" href="contenido.php?idr=<?= $idr ?>&amp;nivel=<?php echo $nivel ?>&amp;id_categoria=<?php echo $row['id_categoria'] ?>" title="<?php $valor = variable(139, 2);  echo $valor[0]; ?> <?= $modulo; ?>">

                         <?php $valor = variable(139, 2);

echo $valor[0]; ?>

                         <?= $modulo; ?>

                         (<?php echo $row['id_categoria'] ?>) <img src="imgs/hammer_screwdriver (1).png" alt="Edit" /> <span>

                         <?php $valor = variable(139, 2);  echo $valor[0]; ?>

                         <?= $modulo; ?>

                         </span></a></span><?php }?></td>

                       </tr>

                       <?php if ($nivel>1) {?>

                       <tr>

                         <td colspan="6"><table style="padding:3px;">

                           <tbody>

                             <? 

$cpadre = array();
$db->select("categoria","*","where de='".$row['id_categoria']."' and nivel_categoria=2  order by id_categoria asc");
/*$db->last_query();*/
    while ($arraypadre = $db->fetch_array()) {
		$cpadre[] = $arraypadre; 
    }
foreach ($cpadre as $row1) { 
 	?>

                             <tr style="padding:3px;">

                               <td width="16" valign="top" style="padding:3px;"><img src="imgs/black.png" width="16" height="16" /></td >

                               <td class="txt_verde" style="padding:3px;"><?= $row1['nombre_categoria']?> </td>

                               <td width="300" style="padding:3px;"><!-- Icons -->



                                 

                                 <a class="Ntooltip" href="contenido.php?idr=<?= $idr ?>&amp;nivel=<?php echo $nivel ?>&amp;id_categoria=<?php echo $row1['id_categoria'] ?>" title="<?php $valor = variable(139, 2);  echo $valor[0]; ?> <?= $modulo; ?>">

                                   <?php $valor = variable(139, 2);

echo $valor[0]; ?>

                                   <?= $modulo; ?>(<?php echo $row1['id_categoria'] ?>)

                                   <img src="imgs/hammer_screwdriver (1).png" alt="Edit" /> <span>

                                     <?php $valor = variable(139, 2);  echo $valor[0]; ?>

                                     <?= $modulo; ?>

                                     </span></a>

                                 </td>

                             </tr>

                             <?php } ?>

                           </tbody>

                         </table></td>

                       </tr>

                       <?php  }}?>

                     </tbody>

                   </table>

                 </div>

                 <!-- End #tab1 -->

               </div>

               <!-- End .content-box-content -->

             </div>

             

 <?php  }?>           

             

             

             

             

             

             

             

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

		window.location="<?= $_SERVER['PHP_SELF'] ?>?id_categoria=<?php echo

    $id_categoria ?>&op=3&idr=<?php echo $idr ?>&idb=" + id;

	}

}

    </script>

</html>



