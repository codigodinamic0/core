<?php include ('../lib/funciones.php'); ?>
<?php //include ('include.php');

require_once("../Connections/database.php");
$matriz_url="http://codigodinamico.com/index.php"; 
 ?>
<?php
//require_once('general/funciones.php');
include_once ('thumbnail.inc.php');
//$link = Connect();
$dest = isset($_GET["dest"]) ? $_GET["dest"] : $_SERVER['PHP_SELF'];
$nombre_tabla = isset($_GET["nombre_tabla"]) ? $_GET["nombre_tabla"] : "";
$modulo = isset($_GET["modulo"]) ? $_GET["modulo"] : "";
$nombre_archivo = isset($_GET["nombre_archivo"]) ? $_GET["nombre_archivo"] : "";
$id_imagen="imagen".$_GET['imagen'];
$carpeta=$_GET['modulo'];
$ruta = "../imagenes/{$carpeta}/{$id_imagen}/" . $nombre_archivo;
$thumb = new Thumbnail($ruta);
$width_pic = $thumb->getCurrentWidth();
$height_pic = $thumb->getCurrentHeight();
$width_thumb = isset($_GET["width_thumb"]) ? $_GET["width_thumb"] : "";
$height_thumb = isset($_GET["height_thumb"]) ? $_GET["height_thumb"] : "";



$ratio = "0.75";

if ($height_thumb != "")

    $ratio = $height_thumb / $width_thumb;



header("Cache-Control: no-cache");



?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

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

<link rel="stylesheet" type="text/css" href="../js/panel/epoch/epoch_styles.css">

<script type="text/javascript" src="../js/panel/epoch/epoch_classes.js"></script>

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

$db->select("matrix","*"," where id_matrix='" . $_GET['id'] . "'");
$rowm = $db->fetch_assoc();

 ?> <?= $rowm["nombre_matrix"] ?></span></h2>

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

					

					<h3><img src="imgs/comment_48.png" width="25" height="25" /><?php echo $modulo ?></h3>

					

					<!--<ul class="content-box-tabs">

						<li><a href="#tab1" class="default-tab">Table</a></li> <!-- href must be unique and match the id of target div 

						<li><a href="#tab2">Forms</a></li>

					</ul>-->

					

					<div class="clear"></div>

					

			  </div> <!-- End .content-box-header -->

				

				<div class="content-box-content"><!-- End #tab1 -->

					

                    





                      <!-- This is the form that our event handler fills -->

                      

                  <table width="98%" align="center">

    <tr>

    	<td width="83%" valign="top" align="center"><span class="texto_verde">.</span><span class="texto_tabs"><?php $valor = variable(162, 2);

echo $valor[0]; ?></span></td>

    </tr>

</table>



<table align="center">

	<tr>

   		<td>    

            <div style="position: relative; width: <?= $width_pic?>px;height: <?= $height_pic?>px;background-color: #ffffff;background-position: center;background-repeat: no-repeat; border: 1px solid #000000; background-image: url('<?= $ruta?>');" id="prev_container">

                <div style="position: relative; width: <?= $width_thumb?>px; height: <?= $height_thumb?>px;  cursor: move; border: thin solid #666666;" id="area">

                    <div style="width: <?= $width_thumb?>px; height: <?= $height_thumb?>px; background: #000000; opacity: .4; filter: alpha(opacity=40);" id="area_interior"></div>

                    <div id="pointerSE"></div>

                    <div id="pointerNE"></div>

                    <div id="pointerNW"></div>

                    <div id="pointerSW"></div>

                </div>

            </div>

		</td>

	</tr>

</table>





                      

		<form name="form1" method="get" action="resize_corte_contenido.php">

<table>

<tr>

    <td valign="top">

        <table>

            <tr>

                <td align="right" class="titulo_seccion2"><?php $valor = variable(163, 2);

echo $valor[0]; ?></td>

              <td><div id="cargando" class="texto_verde2"></div>

        			<div id="prev_data" style="width:<?= $width_thumb ?>px; height:<?= $height_thumb?>px; border: 1px solid #000000;"></div></td>

            </tr>

        </table>

    </td>

<td>

<td>

<table>

	<tr>

    	<td align="right" class="texto_verde2"><?php $valor = variable(164, 2);

echo $valor[0]; ?></td>

        <td><input name="thumb_with" type="text" readonly="readonly" class="fomulario" value="<?= $width_thumb?>" size="5" /></td>

    </tr>

    <tr>

    	<td align="right" class="texto_verde2"><?php $valor = variable(165, 2);

echo $valor[0]; ?></td>

        <td><input name="thumb_height" type="text" readonly="readonly" class="fomulario" value="<?= $height_thumb?>" size="5"/></td>

    </tr>

</table>

</td>

<td>



<table>

	<tr>

    	<td align="right" class="texto_verde2">Pos X:</td>

        <td><input name="thumb_x" type="text" readonly="readonly" class="fomulario" value="0" size="5" /></td>

    </tr>

    <tr>

    	<td align="right" class="texto_verde2">Pos Y:</td>

        <td><input name="thumb_y" type="text" readonly="readonly" class="fomulario" value="0" size="5" /></td>

    </tr>

</table>

</td>





<td>



<table>

	<tr>

    	<td align="right" class="texto_verde2"><?php $valor = variable(166, 2);

echo $valor[0]; ?></td>

        <td class="texto_verde2"><input name="escala_width" type="text" readonly="readonly" class="fomulario" value="<?= round(($width_thumb * 100) / $width_pic)?>" size="1" />%</td>

    </tr>

    <tr>

    	<td align="right" class="texto_verde2"></td>

        <td></td>

    </tr>

</table>

</td>




</tr>

</table>



<p align="center"><input type="submit" value="<?php $valor = variable(167, 2);

echo $valor[0]; ?>" class="botom"/>
</p>

<input type="hidden" name="nombre_tabla" value="<?= $nombre_tabla?>" />

<input type="hidden" name="nombre_archivo" value="<?= $nombre_archivo?>" />

<input type="hidden" name="width_thumb" value="<?= $width_thumb?>" />

<input type="hidden" name="action" value="save" />
<input type="hidden" name="modulo" value="<?= $modulo; ?>" />

<input name="imagen" type="hidden" id="imagen" value="<?php echo $id_imagen ?>" />

<input name="id_categoria" type="hidden" id="id_categoria" value="<?php echo $_GET['id_categoria'] ?>" />

<input type="hidden" name="dest" value="<?= $dest?>" />







		</form>



<script type="text/javascript" src="../js/panel/jquery.js"></script>

<script type="text/javascript" src="../js/panel/interface.js"></script>

<link href="resize_style.css" rel="stylesheet" type="text/css" media="screen"/>



<script type="text/javascript">

$(document).ready( function() {

	$.fn.image = function(src, f){

		return this.each(function(){

			var i = new Image();

			i.src = src;

			this.appendChild(i);

		});

	}		

});

</script>



<script type="text/javascript">

function preview(){

	

	document.getElementById("cargando").innerHTML="cargando...";

	document.getElementById("prev_data").innerHTML="";

	

	$("#prev_data").image("resize_corte_contenido.php?modulo=<?php echo $carpeta; ?>&imagen=<?= $id_imagen?>&action=preview&nombre_tabla=<?= $nombre_tabla?>&nombre_archivo=<?= $nombre_archivo?>&thumb_with=" + document.form1.thumb_with.value + "&thumb_height=" + document.form1.thumb_height.value + "&thumb_x=" + document.form1.thumb_x.value + "&thumb_y=" + document.form1.thumb_y.value + "&width_thumb=<?= $width_thumb?>",document.getElementById("cargando").innerHTML="");

		

}



</script>

<script type="text/javascript">



$('#area').Resizable( {

		ratio: <?= $ratio?>,

		minWidth: <?= $width_thumb?>,

		minHeight: <?= $height_thumb?>,

		maxWidth: <?= $width_pic?>,

		maxHeight: <?= $height_pic?>,

		

		minTop:0.01,

		minLeft:0.01,

		

		maxBottom: <?= $height_pic?>,

		maxRight: <?= $width_pic?>,

		dragHandle: true,

		handlers: {

			se: '#pointerSE',

			e: '#pointerE',

			ne: '#pointerNE',

			n: '#pointerN',

			nw: '#pointerNW',

			w: '#pointerW',

			sw: '#pointerSW',

			s: '#pointerS'

		},

		onResize: function() {

			$("#area_interior").css( { width: $(this).css('width'), height: $(this).css('height') } );

				

			new_width=Math.round($(this).css('width').replace("px",""));

			new_height=Math.round($(this).css('height').replace("px",""));

			

			new_x=Math.round($(this).css('left').replace("px",""));

			new_y=Math.round($(this).css('top').replace("px",""));

			

			document.form1.thumb_with.value=new_width;

			document.form1.thumb_height.value=new_height;

			

			escala_width=Math.round((new_width * 100) / <?= $width_pic?>);

			escala_height=Math.round((new_height * 100) / <?= $height_pic?>);

			

			relative_width=Math.round(<?= $width_pic?> + ( <?= $width_thumb?> - (new_width)));

			relative_height=Math.round(<?= $height_pic?> + ( <?= $height_thumb?> - (new_height)));

			

			document.form1.escala_width.value=escala_width;

			

		},

		onDrag: function() {

			new_x=Math.round($(this).css('left').replace("px",""));

			new_y=Math.round($(this).css('top').replace("px",""));

			document.form1.thumb_x.value=new_x;

			document.form1.thumb_y.value=new_y;

		},

		

		onDragStop: function() {

			preview();

			

		},

		

		onStop: function() {

			preview();

			

		}

	});

	

</script>            

 <!-- inicio lista -->  

<div class="clear"></div> <!-- End .clear -->
				

			  </div> <!-- End .content-box-content -->

				

			</div> <!-- End .content-box --><!-- End .content-box --><!-- End .content-box --><!-- Start Notifications --><!-- End Notifications -->

		    <?php include ('pie.php'); ?>

		</div> 

		<!-- End #main-content -->

		

	</div></body>

</html>



