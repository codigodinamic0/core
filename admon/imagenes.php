<?php 

require_once ('../Connections/database.php');
//require_once('general/funciones.php'); 
include_once('thumbnail.inc.php');

$dest= isset($_GET["dest"]) ? $_GET["dest"] : $_SERVER['PHP_SELF'];


$nombre_tabla= isset($_GET["nombre_tabla"]) ? $_GET["nombre_tabla"] : "";
$nombre_archivo= isset($_GET["nombre_archivo"]) ? $_GET["nombre_archivo"] : "";

$ruta="../imagenes/banco/" . $nombre_archivo;

$thumb = new Thumbnail($ruta);

$width_pic=$thumb->getCurrentWidth();
$height_pic=$thumb->getCurrentHeight();
$width_thumb= isset($_GET["width_thumb"]) ? $_GET["width_thumb"] : "";
$height_thumb = isset($_GET["height_thumb"]) ? $_GET["height_thumb"] : "";

$ratio="0.75";
if($height_thumb!="") $ratio = $height_thumb / $width_thumb;

header("Cache-Control: no-cache");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?= $site_title?></title>

<link href="css/admin_style.css" rel="stylesheet" type="text/css" />
</head>

<body class="bkg_style">
  
 <? 

$db->select("sublinea","*","where id_sublinea='" . $_GET['idr'] . "'");
$row5 = $db->fetch_assoc();


//para verificar tamanos

$db->select("tamano","*","where id=5");
$row = $db->fetch_assoc();

$altos = $row['hgrande'];
$anchos = $row['wgrande'];

//verifique tamanos


$t1 = "slide";
$t2 = "rotan";
$en = "slide";

?>

<table width="895" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="11" background="images/sombra_izq.png">&nbsp;</td>
        <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="438"><img src="images/logo_panel_admin.jpg" width="438" height="91" /></td>
                <td>&nbsp;</td>
                <td width="158"><a href="<?php echo $matriz_url ?>" target="_blank"><img src="images/logo_empresa.jpg" width="158" height="91" border="0" /></a></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td height="35" background="images/dina_menu.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td>&nbsp;</td>
                <td width="90"><a href="estado/close.php" target="_blank"><img src="images/btn_cerrar.jpg" width="90" height="22" border="0" /></a></td>
                <td width="10">&nbsp;</td>
                <td width="90"><a href="panel.php"><img src="images/btn_inicio.jpg" width="90" height="22" border="0" /></a></td>
                <td width="10">&nbsp;</td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td><table width="100%" border="0" cellspacing="10" cellpadding="0">
              <tr>
                <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="140" valign="top"><table width="140" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td><img src="images/menu_sup.jpg" width="140" height="28" /></td>
                      </tr>
                      <tr>
                        <td background="images/menu_bkg.jpg"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                            <!-- INICIO PLANTILLA-->
                            <?
$cpadre = array();
$db->select("menu","*","order by menu.nombre");
/*$db->last_query();*/
    while ($arraypadre = $db->fetch_array()) {
    $cpadre[] = $arraypadre; 
    }
foreach ($cpadre as $row) { 
?>
                            <tr>
                              <td height="10" valign="top" class="texto"><table width="100%" border="0" cellspacing="5" cellpadding="0">
                                  <tr>
                                    <td align="left" bgcolor="#F5F5F5" class="menu_style"><a href="javascript:disp<?= $row['id'] ?>()">
                                      <?= $row['nombre']; ?>
                                    </a></td>
                                  </tr>
                              </table></td>
                            </tr>
                            <script language="JavaScript" type="text/javascript">
			function disp<?= $row['id'] ?>()
			{
				if(document.getElementById("disp<?= $row['id'] ?>").style.display == "none")
					document.getElementById("disp<?= $row['id'] ?>").style.display = "";
				else
					document.getElementById("disp<?= $row['id'] ?>").style.display = "none";
			}
			        </script>
                            <tr>
                              <td valign="top"><div id="disp<?= $row['id'] ?>" style="display:none">
                                  <? 
$cpadre = array();
$db->select("menu_r","*","where menu_r.idr='" . $row['id'] .
"'  order by menu_r.nombre_l");
/*$db->last_query();*/
    while ($arraypadre = $db->fetch_array()) {
    $cpadre[] = $arraypadre; 
    }
foreach ($cpadre as $row2) { 
      ?>
                                  <table width="100%" border="0" cellpadding="0" cellspacing="2">
                                    <tr>
                                      <td width="5" bgcolor="#FFFFFF" ><img src="images/menu_task.jpg" width="11" height="11" /></td>
                                      <td align="left" ><span class="campos_style"> <a href="<?= $row2['url'] ?>">
                                        <?= $row2['nombre_l']; ?>
                                      </a></span></td>
                                    </tr>
                                  </table>
                                <? //FIN ROW2
    } ?>
                              </div></td>
                            </tr>
                            <? //FIN ROW
} ?>
                        </table></td>
                      </tr>
                      <tr>
                        <td background="images/menu_bkg.jpg">&nbsp;</td>
                      </tr>
                      <tr>
                        <td><img src="images/menu_inf.jpg" width="140" height="28" /></td>
                      </tr>
                    </table></td>
                    <td width="10" valign="top">&nbsp;</td>
                    <td align="left" valign="top"><div align="center" class="campos_style">
                      <p class="titulos"> <img src="otros/iconos/Picture.png" width="48" height="48" />Bienvenido
                        <?= $_SESSION['nombre_usuario']; ?>
                      </p>
                      <p class="rojos">
                        <?
$msg = "";
if (isset($_GET["msg"])) {
    $msg = $_GET["msg"];
}
if ($msg == "1") {
    $msg = "Actualizaci&oacute;n Correcta";
}
if ($msg == "2") {
    $msg = "Ingreso correcto";
}
if ($msg == "3") {
    $msg = "Eliminacion Correcta";
}

if ($msg == "4") {
    $msg = "Administracion de Subcategorias";
}
?>
                        <?php echo $msg ?> <br />
                          Administraci&oacute;n de imagenes </p>


                     

                      <!-- This is the form that our event handler fills -->
                      
                  <table width="98%" align="center">
    <tr>
    	<td width="83%" valign="top" align="center"><span class="texto_verde">.</span><span class="texto_tabs">: Seleccione la minutaura que representara a la imagen: </span></td>
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
                      
                      
		<form name="form1" method="get" action="resize_corte.php">
<table>
<tr>
    <td valign="top">
        <table>
            <tr>
                <td align="right" class="titulo_seccion2">Miniatura:</td>
              <td><div id="cargando" class="texto_verde2"></div>
        			<div id="prev_data" style="width:<?= $width_thumb ?>px; height:<?= $height_thumb?>px; border: 1px solid #000000;"></div></td>
            </tr>
        </table>
    </td>
<td>
<td>
<table>
	<tr>
    	<td align="right" class="texto_verde2">Ancho:</td>
        <td><input name="thumb_with" type="text" readonly="readonly" class="fomulario" value="<?= $width_thumb?>" size="5" /></td>
    </tr>
    <tr>
    	<td align="right" class="texto_verde2">Alto:</td>
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

<!--td>

<table>
	<tr>
    	<td align="right" w class="texto_verde2">New Width:</td>
        <td><input name="new_width" type="text" readonly="readonly" class="inputbox" value="0" size="5" /></td>
    </tr>
    <tr>
    	<td align="right" class="texto_verde2">New Height:</td>
        <td><input name="new_height" type="text" readonly="readonly" class="inputbox" value="0" size="5" /></td>
    </tr>
</table>
</td-->

<td>

<table>
	<tr>
    	<td align="right" class="texto_verde2">Escala:</td>
        <td class="texto_verde2"><input name="escala_width" type="text" readonly="readonly" class="fomulario" value="<?= round(($width_thumb * 100) / $width_pic)?>" size="1" />%</td>
    </tr>
    <tr>
    	<td align="right" class="texto_verde2"></td>
        <td></td>
    </tr>
</table>
</td>

<!--td>

<table>
	<tr>
    	<td align="right" w class="texto_verde2">Start X:</td>
        <td><input name="start_x" type="text" class="inputbox" value="0" size="5" /></td>
    </tr>
    <tr>
    	<td align="right" class="texto_verde2">Start Y:</td>
        <td><input name="start_y" type="text" class="inputbox" value="0" size="5" /></td>
    </tr>
</table>
</td-->

</tr>
</table>

<p align="center"><input type="submit" value="Siguiente" class="botom"/></p>
<input type="hidden" name="nombre_tabla" value="<?= $nombre_tabla?>" />
<input type="hidden" name="nombre_archivo" value="<?= $nombre_archivo?>" />
<input type="hidden" name="width_thumb" value="<?= $width_thumb?>" />
<input type="hidden" name="action" value="save" />
<input type="hidden" name="dest" value="<?= $dest?>" />

<input name="id" type="hidden" id="id" value="<?php echo $_GET['id'] ?>" />
		</form>
                      
                    </div>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/interface.js"></script>
<link href="resize_style.css" rel="stylesheet" type="text/css" media="screen"/>

<script language="javascript">
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

<script language="javascript">
function preview(){
	
	document.getElementById("cargando").innerHTML="cargando...";
	document.getElementById("prev_data").innerHTML="";
	
	$("#prev_data").image("resize_corte.php?action=preview&nombre_tabla=<?= $nombre_tabla?>&nombre_archivo=<?= $nombre_archivo?>&thumb_with=" + document.form1.thumb_with.value + "&thumb_height=" + document.form1.thumb_height.value + "&thumb_x=" + document.form1.thumb_x.value + "&thumb_y=" + document.form1.thumb_y.value + "&width_thumb=<?= $width_thumb?>",document.getElementById("cargando").innerHTML="");
		
}

</script>
<script language="javascript">

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
			//document.form1.escala_height.value=escala_height;
			
			//document.form1.new_width.value=relative_width;
			//document.form1.new_height.value=relative_height;

			//document.getElementById("thumb_preview").style.width=relative_width + "px";
			//document.getElementById("thumb_preview").style.height=relative_height + "px";
			
			//document.getElementById("preview_container2").style.width=relative_width + "px";
			//document.getElementById("preview_container2").style.height=relative_height + "px";
			
			/*start_x= (escala_width * new_x) /100;
			start_y= (escala_height * new_y) / 100;
			
			document.form1.start_x.value=start_x;
			document.form1.start_y.value=start_y;
			
			
			document.getElementById("preview_container2").style.top="-" + (new_x ) + "px";
			document.getElementById("preview_container2").style.left="-" + (new_y ) + "px";*/
			
		},
		onDrag: function() {
			new_x=Math.round($(this).css('left').replace("px",""));
			new_y=Math.round($(this).css('top').replace("px",""));
			
			document.form1.thumb_x.value=new_x;
			document.form1.thumb_y.value=new_y;
			
			/*document.getElementById("preview_container").style.backgroundPosition="-" + new_x + "px -" + new_y + "px";
			
			document.getElementById("preview_container2").style.top="-" + new_y + "px";
			document.getElementById("preview_container2").style.left="-" + new_x + "px";*/
			
			
			
			//document.form1.bg_position.value=document.getElementById("preview_container").style.backgroundPosition;
			
			//$("#preview_container").css( { background: '#8dd9ef url(../uploads/' + data + ') center 33px no-repeat' } );
			
		},
		
		onDragStop: function() {
			preview();
			
		},
		
		onStop: function() {
			preview();
			
		}
	});
	
</script>
                    </td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
        <td width="11" background="images/sombra_der.png">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><img src="images/pie.png" width="895" height="18" /></td>
  </tr>
</table>
</body>
</html>
