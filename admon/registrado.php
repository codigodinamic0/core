<?php include('../lib/funciones.php'); ?>
<?php include('include_mysqli.php'); ?>
<?php 
include "crear_json.php";
crear_json_vistas("registrado","order by id_registrado");
?>
<script type="text/javascript" src="function.js"></script>
<?
//para verificar tamanos

$db->select("tamano","*","where id=11");
$row = $db->fetch_assoc();

$alto = $row['hgrande'];
$ancho = $row['wgrande'];
$altop = $row['hpequena'];
$anchop = $row['wpequena']; 
$id=$_GET['id'];
$idr=$_GET['idr'];
$op=$_GET['op'];
$t1="registrado";
$valor=variable(74,2); 
$modulo=$valor[0];
$estado_pregistrado = isset($_POST['estado_registrado']) ? "1" : "2";
if ($op=="1" ) { 

	$sql = "UPDATE $t1 SET nombre_registrado='" . sql_seguro($_POST['nombre_registrado']) . "'" . 
	        ", apellido_registrado= '" . sql_seguro($_POST['apellido_registrado'])  . "'" .
			", estado_registrado= '" . sql_seguro($estado_pregistrado)  . "'" .  
			", direccion_registrado= '" . sql_seguro($_POST['direccion_registrado'])  . "'" . 
			", telefono_registrado= '" . sql_seguro($_POST['telefono_registrado']) . "'" . 
			", celular_registrado= '" . sql_seguro($_POST['celular_registrado']) . "'" . 
			", contacto_registrado= '" . sql_seguro($_POST['contacto_registrado']) . "'" . 
			", cargo_registrado= '" . sql_seguro($_POST['cargo_registrado']) . "'" . 
			", empresa_registrado= '" . sql_seguro($_POST['empresa_registrado']) . "'" .
			", pais_registrado= '" . sql_seguro($_POST['pais_registrado']) . "'" . 
			", departamento_registrado= '" . sql_seguro($_POST['departamento_registrado']) . "'" . 
			", ciudad_registrado= '" . sql_seguro($_POST['ciudad_registrado']) . "'" .  
			", perfil_registrado= '" . sql_seguro($_POST['perfil_registrado']) . "'" . 
			", correo_registrado= '" . sql_seguro($_POST['correo_registrado']) . "'" . 
			", skype_registrado= '" . sql_seguro($_POST['skype_registrado']) . "'" . 
			", twitter_registrado= '" . sql_seguro($_POST['twitter_registrado']) . "'" . 
			", nit_registrado= '" . sql_seguro($_POST['nit_registrado']) . "'" . 
			", nacio_registrado= '" . sql_seguro($_POST['nacio_registrado']) . "'" . 
			", usuario_registrado= '" . sql_seguro($_POST['usuario_registrado']) . "'" . 
			", contrasena_registrado= '" . sql_seguro($_POST['contrasena_registrado']) . "'" . 
			", tipo_registrado= '" . sql_seguro($_POST['tipo_registrado']) . "'" .
			", esposa_registrado= '" . sql_seguro($_POST['esposa_registrado']) . "'" .
			", mensaje_registrado= '" . sql_seguro($_POST['mensaje_registrado']) . "'" . 
			", hijos_registrado= '" . sql_seguro($_POST['hijos_registrado']) . "'" .  
			" WHERE id_registrado= '" . sql_seguro($_POST['id']) . "'";

	  $updatecontenido = $db->prepare($sql);
  $updatecontenido->execute();
  $updatecontenido->close();
	
	
		
if ($_FILES['img']['name'] != "") {
	$aux = explode(".",$_FILES['img']['name']);
	$nombre_archivo=$_POST['id'] . "." . $aux[count($aux)-1];
	copy ($_FILES['img']['tmp_name'], "../imagenes/registrado/" . $nombre_archivo ) ;
	
	include_once('thumbnail.inc.php');
//grandes	
	$thumb = new Thumbnail("../imagenes/registrado/" . $nombre_archivo);
	if($thumb->getCurrentHeight() > $alto) {
    $thumb->resize(0,$alto);
	//$thumb->crop(0,0,720,252);
	$thumb->save("../imagenes/registrado/" . $nombre_archivo);
	$thumb->destruct();
	
		}
		
					$thumb = new Thumbnail("../imagenes/registrado/" . $nombre_archivo);
	if($thumb->getCurrentWidth() > $ancho) {
    $thumb->resize($ancho,0);
	//$thumb->crop(0,0,720,252);
	$thumb->save("../imagenes/registrado/" . $nombre_archivo);
	$thumb->destruct();
	
		}
	$sql = "UPDATE $t1 set img_registrado='" . $nombre_archivo . "' where id_registrado='" . $_POST['id'] . "'";

	  $updatecontenido = $db->prepare($sql);
  $updatecontenido->execute();
  $updatecontenido->close();
	}
	
	
	?>
    
	<script>window.location="<?= $_SERVER['PHP_SELF']?>?msg=2&idr=<?php echo $idr ?>";</script>

<? 
exit;
}?>

<? if ($op=="2") { 
	$sql = "INSERT INTO $t1 (`idr`, `nombre_registrado` ,`apellido_registrado` ,`estado_registrado` ,`direccion_registrado` ,`telefono_registrado` ,`celular_registrado` ,`contacto_registrado` ,`cargo_registrado` ,`empresa_registrado`,`pais_registrado`,`departamento_registrado`,`ciudad_registrado` ,`perfil_registrado` ,`correo_registrado` ,`skype_registrado` ,`twitter_registrado` ,`nit_registrado` ,`fecha_registrado` ,`nacio_registrado` ,`usuario_registrado` ,`contrasena_registrado` ,`tipo_registrado` ,`esposa_registrado` ,`mensaje_registrado` ,`hijos_registrado`) values " . 
			" ('" . sql_seguro($_POST['idr']) . "'" . 
			" ,'" . sql_seguro($_POST['nombre_registrado']) . "'" .
			" ,'" . sql_seguro($_POST['apellido_registrado']) . "'" .
			" ,'" . sql_seguro($estado_pregistrado) . "'" .  
			" ,'" . sql_seguro($_POST['direccion_registrado']) . "'" . 
			" ,'" . sql_seguro($_POST['telefono_registrado']) . "'" . 
			" ,'" . sql_seguro($_POST['celular_registrado']) . "'" . 
			" ,'" . sql_seguro($_POST['contacto_registrado']) . "'" . 
			" ,'" . sql_seguro($_POST['cargo_registrado']) . "'" . 
			" ,'" . sql_seguro($_POST['empresa_registrado']) . "'" . 
			" ,'" . sql_seguro($_POST['pais_registrado']) . "'" .
			" ,'" . sql_seguro($_POST['departamento_registrado']) . "'" .
			" ,'" . sql_seguro($_POST['ciudad_registrado']) . "'" .
			" ,'" . sql_seguro($_POST['perfil_registrado']) . "'" . 
			" ,'" . sql_seguro($_POST['correo_registrado']) . "'" . 
			" ,'" . sql_seguro($_POST['skype_registrado']) . "'" . 
			" ,'" . sql_seguro($_POST['twitter_registrado']) . "'" . 
			" ,'" . sql_seguro($_POST['nit_registrado']) . "'" . 
			" ,'" . sql_seguro($_POST['fecha_registrado']) . "'" . 
			" ,'" . sql_seguro($_POST['nacio_registrado']) . "'" . 
			" ,'" . sql_seguro($_POST['usuario_registrado']) . "'" . 
			" ,'" . sql_seguro($_POST['contrasena_registrado']) . "'" . 
			" ,'" . sql_seguro($_POST['tipo_registrado']) . "'" . 
			" ,'" . sql_seguro($_POST['esposa_registrado']) . "'" . 
			" ,'" . sql_seguro($_POST['mensaje_registrado']) . "'" . 
			" ,'" . sql_seguro($_POST['hijos_registrado']) . "')";
	//echo $sql;

	  $insertmatrix = $db->prepare($sql);
  $insertmatrix->execute();
  $id_generado = $insertmatrix->insert_id;
  $insertmatrix->close();
	
	
	if ($_FILES['img']['name'] != "") {
	$aux = explode(".",$_FILES['img']['name']);
	$nombre_archivo=$id_generado . "." . $aux[count($aux)-1];
	copy ($_FILES['img']['tmp_name'], "../imagenes/registrado/" . $nombre_archivo ) ;
	
	include_once('thumbnail.inc.php');
//grandes	
	$thumb = new Thumbnail("../imagenes/registrado/" . $nombre_archivo);
	if($thumb->getCurrentHeight() > $alto) {
    $thumb->resize(0,$alto);
	//$thumb->crop(0,0,720,252);
	$thumb->save("../imagenes/registrado/" . $nombre_archivo);
	$thumb->destruct();
	
		}
		
					$thumb = new Thumbnail("../imagenes/registrado/" . $nombre_archivo);
	if($thumb->getCurrentWidth() > $ancho) {
    $thumb->resize($ancho,0);
	//$thumb->crop(0,0,720,252);
	$thumb->save("../imagenes/registrado/" . $nombre_archivo);
	$thumb->destruct();
	
		}
	$sql = "UPDATE $t1 set img_registrado='" . $nombre_archivo . "' where id_registrado='" . $id_generado . "'";

	  $updatecontenido = $db->prepare($sql);
  $updatecontenido->execute();
  $updatecontenido->close();
	}
	
	
	
	?>
    
	<script>window.location="<?= $_SERVER['PHP_SELF']?>?msg=1&idr=<?php echo $idr ?>";</script>

<? }?>


<? if ($op=="3") {

	$db->select($t1,"*","WHERE id_registrado='" . $_POST['idb'] . "'");
$row = $db->fetch_assoc();

	if($row['img_registrado']!=""){
		if(file_exists("../imagenes/registrado/" . $row['img_registrado']))
			unlink("../imagenes/registrado/" . $row['img_registrado']);
	}

$db->delete($t1,"where id_registrado='" . $_GET['idb'] . "'");
		
	
	?>
   
    <script>window.location="<?= $_SERVER['PHP_SELF']?>?op=4&msg=3&idr=<?php echo $idr ?>";</script>

<? }?>
<? if ($id<>""  ) { $op=1; } else { $op=2;}?>
    <div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
<?php include('menu_izq.php'); ?>
		
		<div id="main-content"> <!-- Main Content Section with everything -->
			
			<div id="miga">
              <noscript><!-- Show a notification if the user has disabled javascript -->
				<div class="notification error png_bg">
					<div>
                      <?php $valor=variable(22,2); echo $valor[1]; ?>
</div>
			  </div>
			  </noscript>
              

<? if ($msg<>"") {
if ($msg=="1"){ $valor=variable(16,2);$msg=$valor[0];}
if ($msg=="2") {$valor=variable(17,2);$msg=$valor[0];}
if ($msg=="3") {$valor=variable(18,2);$msg=$valor[0];}
if ($msg=="4") {$valor=variable(19,2);$msg=$valor[0];}
?>
<div class="notification success png_bg">
<a href="#" class="close"><img src="imgs/cross_grey_small.png" title="Close this notification" alt="close" /></a>
<div>
<?php echo $msg ?></div>
</div>
<?php }?>
<p class="punteado"><strong>
<?php $valor=variable(8,2); echo $valor[0]; ?> &nbsp;
<?php echo $_SESSION['nombre_usuario'] ?></strong></p>
			  <div class="miga">
            	
                <p><a href="panel.php">
                <?php $valor=variable(9,2); echo $valor[0]; ?>
                  </a>  <a href="#" class="flecha_miga"><?php echo $modulo ?></a> <a href="<?= $_SERVER['PHP_SELF']?>?idr=<?php echo $idr ?>" class="flecha_miga">
                  <?php $valor=variable(3,2); echo $valor[0]; ?> 
                <?php echo $modulo ?></a></p>
                <p>&nbsp; 
                  
                </p>
                <div class="clear" style="padding-top:15px;"></div>
            <h2><?php if($id){$valor=variable(2,2); echo $valor[0];} else{$valor=variable(3,2); echo $valor[0];}?> <span class="urgente"><?php echo $modulo ?> 
            	<? 

$db->select($t1 ,"*","where id_registrado='" . $idr . "'");
$rowg = $db->fetch_assoc();
?> <?= $rowg["nombre_registrado"]?>  
<?

$db->select($t1 ,"*","where id_registrado='" . $_GET['id'] . "'");
$row = $db->fetch_assoc();

?> <?= $row["nombre_registrado"]?> <?= $row["apellido_registrado"]?>
            </span></h2>
              </div>
			  <div class="clear"></div>
			  <!-- End .clear -->
			
              <div class="notification attention png_bg">
				<a href="#" class="close"><img src="imgs/cross_grey_small.png" title="Close this notification" alt="close" /></a>
				<div>
                  <?php $valor=variable(95,2); echo $valor[1]; ?></div>
			  </div>
              </div>
			
			
			
			
		  <div class="clear"></div> <!-- End .clear -->
			
			<div class="content-box"><!-- Start Content Box -->
				
				<div class="content-box-header">
					
					<h3><img src="imgs/pencil (1).png" width="16" height="16" style="padding:5px;" /><?php echo $modulo ?> mysqli</h3>
					
		      <!--<ul class="content-box-tabs">
						<li><a href="#tab1" class="default-tab">Table</a></li> <!-- href must be unique and match the id of target div 
						<li><a href="#tab2">Forms</a></li>
					</ul>-->
					
					<div class="clear"></div>
					
			  </div> <!-- End .content-box-header -->
				
				<div class="content-box-content"><!-- End #tab1 -->
					
                    
                  <form action="<?= $_SERVER['PHP_SELF']?>?op=<?php echo $op ?>&amp;idr=<?= $idr ?>" method="post" enctype="multipart/form-data" name="usuarios" id="usuarios">
							
					<fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
								




<?php
$consultare="";

$db->select($t1,"*","where  id_registrado='".$idr."'");
$row9 = $db->fetch_assoc();
?>

<?php if ($row9["nombre_registrado"]){
$consultare=$consultare." nombre_registrado ";
 ?>
<p>
									<label>
                                    <?php $valor=variable(10,2); echo $valor[0]; ?>
            <?php echo $modulo ?></label>
									<input name="nombre_registrado" type="text" class="text-input small-input"  id="nombre_registrado" value="<?= $row["nombre_registrado"]?>" size="32" />
</p>
<?php }?>




<?php if ($row9["apellido_registrado"]){ $consultare=$consultare.", apellido_registrado "; ?>
<p>
<label> <?php $valor=variable(75,2); echo $valor[0]; ?> <?php echo $modulo ?></label>
<input name="apellido_registrado" type="text" class="text-input small-input"  id="apellido_registrado" value="<?= $row["apellido_registrado"]?>" size="32" />
</p>
<?php }?>



<?php if ($row9["direccion_registrado"]){ $consultare=$consultare.", direccion_registrado "; ?>
<p>
<label><?php $valor=variable(76,2); echo $valor[0]; ?><?php echo $modulo ?></label>
<input name="direccion_registrado" type="text" class="text-input small-input"  id="direccion_registrado" value="<?= $row["direccion_registrado"]?>" size="32" />
</p>
<?php }?>




<?php if ($row9["telefono_registrado"]){ $consultare=$consultare.", telefono_registrado "; ?><p>
<label><?php $valor=variable(77,2); echo $valor[0]; ?><?php echo $modulo ?></label>
<input name="telefono_registrado" type="text" class="text-input small-input"  id="telefono_registrado" value="<?= $row["telefono_registrado"]?>" size="32" onKeyUp="this.value = this.value.replace(no_digito, '')"   />
</p>
<?php }?>




<?php if ($row9["celular_registrado"]){ $consultare=$consultare.", celular_registrado "; ?><p>
<label><?php $valor=variable(78,2); echo $valor[0]; ?><?php echo $modulo ?></label>
<input name="celular_registrado" type="text" class="text-input small-input"  id="celular_registrado" value="<?= $row["celular_registrado"]?>" size="32" onKeyUp="this.value = this.value.replace(no_digito, '')"  />
</p><?php }?>



<?php if ($row9["contacto_registrado"]){ $consultare=$consultare.", contacto_registrado "; ?><p>
<label> Registro <?php echo $modulo ?></label><input name="contacto_registrado" type="text" class="text-input small-input"  id="contacto_registrado" value="<?= $row["contacto_registrado"]?>" size="32" />
</p><?php }?>



<?php if ($row9["cargo_registrado"]){ $consultare=$consultare.", cargo_registrado "; ?><p>
<label>Estilo <?php echo $modulo ?></label>
<input name="cargo_registrado" type="text" class="text-input small-input"  id="cargo_registrado" value="<?= $row["cargo_registrado"]?>" size="32" />
</p><?php }?>
                             
	
    
    
<?php if ($row9["empresa_registrado"]){ $consultare=$consultare.", empresa_registrado "; ?>    <p>
<label><?php $valor=variable(81,2); echo $valor[0]; ?><?php echo $modulo ?></label>
<input name="empresa_registrado" type="text" class="text-input small-input"  id="empresa_registrado" value="<?= $row["empresa_registrado"]?>" size="32" /></p><?php }?>
                             
								
	
    

                             
								
	
    
    
<?php if ($row9["correo_registrado"]){ $consultare=$consultare.", correo_registrado "; ?>    <p>
<label>página web <?php echo $modulo ?></label><input name="correo_registrado" type="text" class="text-input small-input"  id="correo_registrado" value="<?= $row["correo_registrado"]?>" size="32" /></p>
<?php }?>                      
								
	
    
    
<?php if ($row9["skype_registrado"]){ $consultare=$consultare.", skype_registrado "; ?>    <p><label>
<?php $valor=variable(84,2); echo $valor[0]; ?>
<?php echo $modulo ?></label><input name="skype_registrado" type="text" class="text-input small-input"  id="skype_registrado" value="<?= $row["skype_registrado"]?>" size="32" />
</p><?php }?>
                             
								
	
    
<?php if ($row9["twitter_registrado"]){ $consultare=$consultare.", twitter_registrado"; ?>    <p><label>
Facebook <?php echo $modulo ?></label>
<input name="twitter_registrado" type="text" class="text-input small-input"  id="twitter_registrado" value="<?= $row["twitter_registrado"]?>" size="32" />
</p><?php }?>
                             
								
	
    
<?php if ($row9["nit_registrado"]){ $consultare=$consultare.", nit_registrado "; ?>    <p><label><?php $valor=variable(86,2); echo $valor[0]; ?> <?php echo $modulo ?></label>
<input name="nit_registrado" type="text" class="text-input small-input"  id="nit_registrado" value="<?= $row["nit_registrado"]?>" size="32" onKeyUp="this.value = this.value.replace(no_digito, '')"  /></p> <?php }?>                        
								
	
    
 
									

                             
								
	
    
<?php if ($row9["nacio_registrado"]<>'0000-00-00'){ $consultare=$consultare.", nacio_registrado "; ?>    <p>
<label>Fecha nacimiento  <?php echo $modulo ?></label>
<input name="nacio_registrado" type="text" class="text-input small-input"  id="nacio_registrado" value="<?= $row["nacio_registrado"]?>" size="32" readonly="readonly" /></p><?php }?>
                             
								
	
    
<?php if ($row9["usuario_registrado"]){ $consultare=$consultare.", usuario_registrado "; ?>    <p>
<label> <?php $valor=variable(89,2); echo $valor[0]; ?><?php echo $modulo ?></label>
<input name="usuario_registrado" type="text" class="text-input small-input"  id="usuario_registrado" value="<?= $row["usuario_registrado"]?>" size="32" /></p><?php }?>
                             
								
	
    
<?php if ($row9["contrasena_registrado"]){ $consultare=$consultare.", contrasena_registrado "; ?>    <p>
<label><?php $valor=variable(90,2); echo $valor[0]; ?><?php echo $modulo ?></label>
<input name="contrasena_registrado" type="text" class="text-input small-input"  id="contrasena_registrado" value="<?= $row["contrasena_registrado"]?>" size="32" /></p><?php }?>
                             
								
	
    
<?php if ($row9["tipo_registrado"]){ $consultare=$consultare.", tipo_registrado "; ?>    <p><label>
<?php $valor=variable(52,2); echo $valor[0]; ?> <?php echo $modulo ?></label>
<select name="tipo_registrado" class="small-input"  id="tipo_registrado">
 <?

$cpadre = array();
$db->select("tipo","*","where idr=12");
/*$db->last_query();*/
    while ($arraypadre = $db->fetch_array()) {
		$cpadre[] = $arraypadre; 
    }
foreach ($cpadre as $row_banco) { 
?>
 <?php if($row["tipo_registrado"] == $row_banco['id_tipo']) {?>
<option value="<?= $row_banco['id_tipo']?>" selected="selected"><?= $row_banco['nombre_tipo']?></option>
<?php 	} else {?><option value="<?= $row_banco['id_tipo']?>"> <?= $row_banco['nombre_tipo']?></option>
 <?php 	}?> <? }?></select> </p><?php }?>
                             
								
<!--<?php if ($row9["pais_registrado"]){ $consultare=$consultare.", pais_registrado "; ?>    





<p><label>
<?php $valor=variable(179,2); echo $valor[0]; ?> <?php echo $modulo ?></label>
<select name="pais_registrado" class="small-input"  id="pais_registrado" onchange="Showdepartamento(this.value)" >



 <?
$sql_banco = "SELECT * FROM pais order by nombre_pais asc";
$res_banco = @mysql_query($sql_banco); if (!$res_banco) { exit(mysql_error()); } 
while ($row_banco = mysql_fetch_array($res_banco)) {?>
 <?php if($row["pais_registrado"] == $row_banco['codigo_pais']) {?>
<option value="<?= $row_banco['codigo_pais']?>" selected="selected"><?= $row_banco['nombre_pais']?></option>
<?php 	} else {?><option value="<?= $row_banco['codigo_pais']?>"> <?= $row_banco['nombre_pais']?></option>
 <?php 	}?> <? }?></select> 
</p>

  <p><label>
    <?php $valor=variable(180,2); echo $valor[0]; ?> <?php echo $modulo ?></label>
   <div id="iddepartamento">     <input name="departamento_registrado" type="hidden" id="departamento_registrado" value="<?php echo $row[departamento_registrado] ?>" />
                                      <? 
$sqlc = "SELECT * FROM  departamento where id_departamento='" . $row['departamento_registrado'] . "'";
$resc = @mysql_query($sqlc); if (!$resc) { exit(mysql_error()); }
$rowc = mysql_fetch_array($resc)?> 
                                      <span class="destacado_verde"><?php echo $rowc['nombre_departamento'] ?></span></div>
  </p>


  <p><label>
    <?php $valor=variable(181,2); echo $valor[0]; ?> <?php echo $modulo ?></label>
    
  <div id="idciudad" >  
<input name="ciudad_registrado" type="hidden" id="ciudad_registrado" value="<?php echo $row[ciudad_registrado] ?>" />
                                      <? 
$sqlc = "SELECT * FROM  ciudad where id_ciudad='" . $row['ciudad_registrado'] . "'";
$resc = @mysql_query($sqlc); if (!$resc) { exit(mysql_error()); }
$rowc = mysql_fetch_array($resc)?> 
                                      <span class="destacado_verde"><?php echo $rowc['nombre_ciudad'] ?></span></div>
  </p>





<?php }?>-->
    
   <?php if ($row9["pais_registrado"]){ $consultare=$consultare.", pais_registrado "; ?>    
<label>País <?php echo $modulo ?></label>
<input name="pais_registrado" type="text" class="text-input small-input"  id="pais_registrado" value="<?= $row["pais_registrado"]?>" size="32" />
<?php }?>
    
                       
<?php if ($row9["ciudad_registrado"]){ $consultare=$consultare.", ciudad_registrado "; ?>    
<label>Ciudad <?php echo $modulo ?></label>
<input name="ciudad_registrado" type="text" class="text-input small-input"  id="ciudad_registrado" value="<?= $row["ciudad_registrado"]?>" size="32" /><?php }?>	                    
								
	
    



<?php if ($row9["estado_registrado"]){ $consultare=$consultare.", estado_registrado "; ?>  <p>
<label><?php $valor=variable(94,2); echo $valor[0]; ?> <?php echo $modulo ?></label><input  type="checkbox" name="estado_registrado" id="estado_registrado" <? if($row["estado_registrado"]=="1") echo "checked";?> /> <br /></p>
<?php }?>

<?php if ($row9["mensaje_registrado"]){ $consultare=$consultare.", mensaje_registrado "; ?>  <p>
<label>Mensaje <?php echo $modulo ?></label><textarea name="mensaje_registrado" cols="32" class="text-input large-input" id="mensaje_registrado"><?= $row["mensaje_registrado"]?></textarea> <br /></p>
<?php }?>


<?php if ($row9["img_registrado"]){ $consultare=$consultare.", img_registrado "; ?><p>
<label> <?php $valor=variable(41,2); echo $valor[0]; ?> <?php echo $modulo ?></label>
<input name="img" type="file" class="text-input small-input" id="img" /> 
<?php if($row['img_registrado'] <> ""){ ?>
<img src="../imagenes/registrado/<?= $row['img_registrado']?>" width="40" />
 <?php } ?>
(<?PHP echo getMaxUpload()?>mb max)</p>
<?php if ($row9["perfil_registrado"]){ $consultare=$consultare.", perfil_registrado "; ?>    <p><?php }?>
<label> <?php $valor=variable(82,2); echo $valor[0]; ?> <?php echo $modulo ?></label>
<textarea name="perfil_registrado" cols="32" class="text-input large-input" id="perfil_registrado"><?= $row["perfil_registrado"]?></textarea>
</p><?php }?>




<p><input class="button" type="submit" value="<?php if($id){$valor=variable(2,2); echo $valor[0];} else{$valor=variable(3,2); echo $valor[0];}?> <?php echo $modulo ?>" />
<input name="id" type="hidden" id="id" value="<?= $row["id_registrado"]?>" /><input name="fecha_registrado" type="hidden" class="text-input small-input"  id="fecha_registrado" value="<?php echo $fecha2 ?>" size="32" />
<input name="idr" type="hidden" id="idr" value="<?= $idr ?>" />
<br />
</p>

							
				    </fieldset><!-- End .clear -->
							
				  </form>
                    
                
                
                
                
                
                
 <!-- inicio lista -->  
<div class="clear"></div> <!-- End .clear -->
<div class="content-box"><!-- Start Content Box -->
				
				<div class="content-box-header">
				  
					
					<h3 class="titu_secc">
                      <?php $valor=variable(11,2); echo $valor[0]; ?> <a href="#" title="title" class="txt_verde"><?php echo $modulo ?></a>   </h3>
					
				
					
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
						
				  <form action="excel.php" method="post" target="_blank">
                    <input type="hidden" name="sql" value="SELECT <?php echo $consultare ?> FROM registrado where id_registrado>12 order by nombre_registrado asc" />
				    <input type="submit" class="botom2" value="<?php $valor=variable(96,2); echo $valor[0]; ?>"/>
				  </form><table>
							
							<tfoot>
								<tr>
									<td colspan="7"> 
								  <!-- End .pagination --></td>
							  </tr>
							</tfoot>
						 
							<tbody>
                            
   <tr>
<td valign="top"><a href="#" title="title" class="txt_verde">
									 <?php $valor=variable(10,2); echo $valor[0]; ?>
            <?php echo $modulo ?></a></td>
<td valign="top"><a href="#" title="title" class="txt_verde">
  <?php $valor=variable(77,2); echo $valor[0]; ?>
  <?php echo $modulo ?></a></td>
<td valign="top"><a href="#" title="title" class="txt_verde">
  <?php $valor=variable(83,2); echo $valor[0]; ?>
  <?php echo $modulo ?></a></td>
<td valign="top"><a href="#" title="title" class="txt_verde">
  <?php $valor=variable(81,2); echo $valor[0]; ?>
  <?php echo $modulo ?></a></td>
<td class="txt_verde"><?php $valor=variable(14,2); echo $valor[0]; ?></td>
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

                    $db->select($t1,"*","where id_registrado>12 and idr='".$_GET['idr']."'  order by  nombre_registrado asc");
                    $num_total_registros = $db->num_rows();
                    //calculo el total de p&aacute;ginas 
$total_paginas = ceil($num_total_registros / $TAMANO_PAGINA); 

                    $db->select($t1,"*","where id_registrado>12 and idr='".$_GET['idr']."'  order by  nombre_registrado asc". " limit " . $inicio . "," . $TAMANO_PAGINA);
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
									<td valign="top"><a href="#" title="<?php echo $row['nombre_usuario']?>" class="txt_ingresar">
								    <?php echo $row['nombre_registrado']?> <?php echo $row['apellido_registrado']?></a></td>
							        <td valign="top"><a href="#" title="<?php echo $row['nombre_usuario']?>" class="txt_ingresar"><?php echo $row['telefono_registrado']?></a></td>
							        <td valign="top"><a href="#" title="<?php echo $row['nombre_usuario']?>" class="txt_ingresar"><?php echo $row['correo_registrado']?></a></td>
							        <td valign="top"><a href="#" title="<?php echo $row['nombre_usuario']?>" class="txt_ingresar"><?php echo $row['empresa_registrado']?></a></td>
						          <td>
										<!-- Icons -->
										 <a class=Ntooltip href="<?= $_SERVER['PHP_SELF']?>?id=<?= $row['id_registrado']?>&amp;op=4&idr=<?php echo $idr ?>" title="Edit"><img src="imgs/pencil.png" alt="Edit" />
<span>
<?php $valor=variable(2,2); echo $valor[0]; ?> <?= $modulo; ?>
</span>                                         </a>
<a class=Ntooltip href="javascript:deletex('<?= $row['id_registrado']?>')" title="Delete"><img src="imgs/cross.png" alt="Delete" /><span>
<?php $valor=variable(1,2); echo $valor[0]; ?>  <?= $modulo; ?>
</span></a></td>
								</tr>
                               <?php  }?>
							</tbody>
					  </table>
<div class="pagination">
											
										    <? if (($total_paginas > 1)){ ?>
       
          <? if ($pagina!=1){?>
          <a href='<?= $_SERVER['PHP_SELF']?>?pg=<?= ($pagina-1)?>&idr=<?php echo $idr ?>' title="<?php $valor=variable(12,2); echo $valor[0]; ?>"><?php $valor=variable(12,2); echo $valor[0]; ?></a>
          <? }?>
      
      
      
      
      
      
      
      
    
    <? for ($i=1;$i<=$total_paginas;$i++){ 

if ($pagina == $i) {?>
        
       <a href='#' class="number current" title="<?= $pagina?>"> <?= $pagina?></a>
        
        <? } else {?>
        <a href='<?= $_SERVER['PHP_SELF']?>?pg=<?= $i ?>&idr=<?php echo $idr ?>' class="number" title="<?= $i ?>">
        <?= $i?>
         </a>
        <? } ?>
        <? }?>
        
        
        
        
        
        
    
    
    
    
      <? if ($total_paginas!=$pagina){?>
      <a href='<?= $_SERVER['PHP_SELF']?>?pg=<?= ($pagina+1)?>&idr=<?php echo $idr ?>' title="<?php $valor=variable(13,2); echo $valor[0]; ?>"><?php $valor=variable(13,2); echo $valor[0]; ?></a>
      <? }?>
      <? } ?>
      <br />
					  </div>
						
				  </div> 
                  
                  
			<form name="form" id="form">
  <?php $valor=variable(15,2); echo $valor[0]; ?>:
    <select name="jumpMenu" id="jumpMenu" onChange="MM_jumpMenu('parent',this,0)">
   <option value=""><?php $valor=variable(27,2); echo $valor[0]; ?></option>
   <? 

$cpadre = array();
$db->select("pagina","*");
/*$db->last_query();*/
    while ($arraypadre = $db->fetch_array()) {
		$cpadre[] = $arraypadre; 
    }
foreach ($cpadre as $row) {
?>
 <?php if($row["numero"] == $_SESSION['pagina']) {?>
<option value="<?= $_SERVER['PHP_SELF']?>?paginar=<?php echo utf8_encode($row['numero']) ?>&idr=<?php echo $idr ?>" selected="selected">
<?php echo utf8_encode($row['numero']) ?>
<?php 	} else {?>
 <option value="<?= $_SERVER['PHP_SELF']?>?paginar=<?php echo utf8_encode($row['numero']) ?>&idr=<?php echo $idr ?>">
<?php echo utf8_encode($row['numero']) ?>
</option>
 <?php 	}?>



<? }?>

  </select>
</form>
				  <!-- End>
				  <!-- End #tab1 -->
					
				      
					
				</div> <!-- End .content-box-content -->
				
			</div>  
             <!-- fin lista -->   
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                    
					      
					
			  </div> <!-- End .content-box-content -->
				
			</div> <!-- End .content-box --><!-- End .content-box --><!-- End .content-box --><!-- Start Notifications --><!-- End Notifications -->
		    <?php include('pie.php'); ?>
		</div> 
		<!-- End #main-content -->
		
	</div></body>
  <script language="javascript">
function deletex(id){
	if(confirm("<?php $valor=variable(43,2); echo $valor[0]; ?>")) {
		window.location="<?= $_SERVER['PHP_SELF']?>?idr=<?php echo $idr ?>&op=3&idb=" + id;
	}
}
    </script>
</html>

