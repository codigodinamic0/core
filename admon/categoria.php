<?php include('../lib/funciones.php'); ?>
<?php include('include_mysqli.php'); ?>
<?php 
include "crear_json.php";
crear_json_vistas("categoria","order by id_categoria asc");
?>
<?php
$id=$_GET['id'];
$nivel=$_GET['nivel'];
$idr=$_GET['idr'];
$op=$_GET['op'];
$t1="categoria";
$alto=260;
$ancho=1000;
$altoc=1000;
$anchoc=1000;

$menu_inferior = isset($_POST['menu_inferior']) ? "1" : "0";

/*arbol categorias*/
$arr_categorias = obtener_categorias($idr);
/*fin arbol categorias*/

if ($idr) {
//identifico modulo 

$db->select("idmo, idioma, modulo","idmo.nombre_idmo, idioma.idioma, modulo.nombre_modulo","where idioma.id_idioma=idmo.idioma and modulo.id_modulo=idmo.modulo and id_idmo='" . $idr . "'");
$row = $db->fetch_assoc();

$modulo=" categoria ".$row["nombre_idmo"]." ".$row["idioma"];
$carpeta=$row["nombre_modulo"];
}
//fin identificacion de modulo tipos
if ($op=="1") { 
$sql = "UPDATE $t1 set tipo='" . sql_seguro($_POST['tipo']) . "'";
$sql = $sql . ", nombre_categoria= '" . sql_seguro($_POST['nombre_categoria']) . "'";
$sql = $sql . ", amigable_categoria= '" . sql_seguro(limpiar_url($_POST['amigable_categoria'])) . "'";
$sql = $sql . ", descripcion_categoria= '" . sql_seguro($_POST['descripcion_categoria']) . "'";
$sql = $sql . ", ubica_categoria= '" . sql_seguro($_POST['ubica_categoria']) . "'";
$sql = $sql . ", menu_inferior= '" . sql_seguro($menu_inferior) . "'";
$sql = $sql . " where id_categoria= '" . sql_seguro($_POST['id']) . "'";

$updatecontenido = $db->prepare($sql);
  $updatecontenido->execute();
  $updatecontenido->close();

//ingreso tipos de especificaciones

$db->delete("cati","where categoria = '" . $_POST['id'] . "'");

if(isset($_POST['tipifica'])){
	foreach ($_POST['tipifica'] as $tipifica){

		$sql = "INSERT INTO cati (categoria,tipifica) values ('" . $_POST['id'] . "','" . $tipifica . "')";
		$insertmatrix = $db->prepare($sql);
		  $insertmatrix->execute();
		  //$id_generado = $insertmatrix->insert_id;
		  $insertmatrix->close();
	}
}
//actualizacion de registros
    if ($_FILES['img']['name'] != "") {
        $aux = explode(".", $_FILES['img']['name']);
        $nombre_cambiar=$_POST['id'] . "." . $aux[count($aux)-1];
	    $nombre_archivo = strtolower($nombre_cambiar);
        copy($_FILES['img']['tmp_name'], "../imagenes/categoria/" . $nombre_archivo);

        include_once ('thumbnail.inc.php');
        //grandes
        $thumb = new Thumbnail("../imagenes/categoria/" . $nombre_archivo);
        if ($thumb->getCurrentHeight() > $alto) {
            $thumb->resize(0, $alto);
            //$thumb->crop(0,0,720,252);
            $thumb->save("../imagenes/categoria/" . $nombre_archivo);
            $thumb->destruct();

        }

		
		
		        $thumb = new Thumbnail("../imagenes/categoria/" . $nombre_archivo);
        if ($thumb->getCurrentWidth() > $ancho) {
            $thumb->resize($ancho, 0);
            //$thumb->crop(0,0,720,252);
            $thumb->save("../imagenes/categoria/" . $nombre_archivo);
            $thumb->destruct();

        }
		

        $sql = "UPDATE categoria set img='" . $nombre_archivo .
            "' where id_categoria='" . $_POST['id'] . "'";
        //echo $sql;

        $updatecontenido = $db->prepare($sql);
  $updatecontenido->execute();
  $updatecontenido->close();
	}



//actualizacion de registros
    if ($_FILES['img1']['name'] != "") {
        $aux = explode(".", $_FILES['img1']['name']);
        $nombre_cambiar="c".$_POST['id'] . "." . $aux[count($aux)-1];
	    $nombre_archivo = strtolower($nombre_cambiar);
        copy($_FILES['img1']['tmp_name'], "../imagenes/categoria/c" . $nombre_archivo);

        include_once ('thumbnail.inc.php');
        //grandes
        $thumb = new Thumbnail("../imagenes/categoria/c" . $nombre_archivo);
        if ($thumb->getCurrentHeight() > $altoc) {
            $thumb->resize(0, $altoc);
            //$thumb->crop(0,0,720,252);
            $thumb->save("../imagenes/categoria/" . $nombre_archivo);
            $thumb->destruct();

        }

		
		
		        $thumb = new Thumbnail("../imagenes/categoria/c" . $nombre_archivo);
        if ($thumb->getCurrentWidth() > $anchoc) {
            $thumb->resize($anchoc, 0);
            //$thumb->crop(0,0,720,252);
            $thumb->save("../imagenes/categoria/c" . $nombre_archivo);
            $thumb->destruct();

        }
		

        $sql = "UPDATE categoria set img1='" . $nombre_archivo .
            "' where id_categoria='" . $_POST['id'] . "'";
        //echo $sql;

        $updatecontenido = $db->prepare($sql);
  $updatecontenido->execute();
  $updatecontenido->close();
	}

?>
	<script>window.location="<?= $_SERVER['PHP_SELF']?>?msg=2&idr=<?php echo $idr ?>&categoria=<?php echo $_GET['categoria'] ?>&nivel=<?php echo $nivel ?>";</script>
<? 
exit;
}?>

<? if ($op=="2") { 
$sql = "INSERT INTO $t1(modulo, de, tipo, nombre_categoria, amigable_categoria, descripcion_categoria, ubica_categoria, nivel_categoria,menu_inferior) values ";
$sql = $sql . " ('" . sql_seguro($idr) . "'";
$sql = $sql . " ,'" . sql_seguro($_POST['de']). "'";
$sql = $sql . " ,'" . sql_seguro($_POST['tipo']). "'";
$sql = $sql . " ,'" . sql_seguro($_POST['nombre_categoria']). "'";
$sql = $sql . " ,'" . sql_seguro(limpiar_url($_POST['nombre_categoria'])). "'";
$sql = $sql . " ,'" . sql_seguro($_POST['descripcion_categoria']). "'";
$sql = $sql . " ,'" . sql_seguro($_POST['ubica_categoria']). "'";
$sql = $sql . " ,'" . sql_seguro($_POST['nivel_categoria']). "'";
$sql = $sql . " ,'" . sql_seguro($menu_inferior) . "')";
	//echo $sql;

$insertmatrix = $db->prepare($sql);
  $insertmatrix->execute();
  $id_generado = $insertmatrix->insert_id;
  $insertmatrix->close();

//ingreso tipos de especificaciones

$db->delete("cati","where categoria = '" . $id_generado . "'");


if(isset($_POST['tipifica'])){
	foreach ($_POST['tipifica'] as $tipifica){

		$sql="INSERT INTO cati (categoria,tipifica) values ('" . $id_generado . "','" . $tipifica . "')";
		 $insertmatrix = $db->prepare($sql);
		  $insertmatrix->execute();
		  $id_generado = $insertmatrix->insert_id;
		  $insertmatrix->close();
	}
}
//actualizacion de registros
    if ($_FILES['img']['name'] != "") {
        $aux = explode(".", $_FILES['img']['name']);
        $nombre_cambiar=$id_generado . "." . $aux[count($aux)-1];
	    $nombre_archivo = strtolower($nombre_cambiar);
        copy($_FILES['img']['tmp_name'], "../imagenes/categoria/" . $nombre_archivo);

        include_once ('thumbnail.inc.php');
        //grandes
        $thumb = new Thumbnail("../imagenes/categoria/" . $nombre_archivo);
        if ($thumb->getCurrentHeight() > $alto) {
            $thumb->resize(0, $alto);
            //$thumb->crop(0,0,720,252);
            $thumb->save("../imagenes/categoria/" . $nombre_archivo);
            $thumb->destruct();

        }

		
		
		        $thumb = new Thumbnail("../imagenes/categoria/" . $nombre_archivo);
        if ($thumb->getCurrentWidth() > $ancho) {
            $thumb->resize($ancho, 0);
            //$thumb->crop(0,0,720,252);
            $thumb->save("../imagenes/categoria/" . $nombre_archivo);
            $thumb->destruct();

        }
		

        $sql = "UPDATE categoria set img='" . $nombre_archivo .
            "' where id_categoria='" . $id_generado . "'";
        //echo $sql;

        $updatecontenido = $db->prepare($sql);
  $updatecontenido->execute();
  $updatecontenido->close();
	}
	
	 if ($_FILES['img1']['name'] != "") {
        $aux = explode(".", $_FILES['img1']['name']);
        $nombre_cambiar="c".$id_generado . "." . $aux[count($aux)-1];
	    $nombre_archivo = strtolower($nombre_cambiar);
        copy($_FILES['img1']['tmp_name'], "../imagenes/categoria/c" . $nombre_archivo);

        include_once ('thumbnail.inc.php');
        //grandes
        $thumb = new Thumbnail("../imagenes/categoria/c" . $nombre_archivo);
        if ($thumb->getCurrentHeight() > $altoc) {
            $thumb->resize(0, $altoc);
            //$thumb->crop(0,0,720,252);
            $thumb->save("../imagenes/categoria/c" . $nombre_archivo);
            $thumb->destruct();

        }

		
		
		        $thumb = new Thumbnail("../imagenes/categoria/c" . $nombre_archivo);
        if ($thumb->getCurrentWidth() > $anchoc) {
            $thumb->resize($anchoc, 0);
            //$thumb->crop(0,0,720,252);
            $thumb->save("../imagenes/categoria/c" . $nombre_archivo);
            $thumb->destruct();

        }
		

        $sql = "UPDATE categoria set img1='" . $nombre_archivo .
            "' where id_categoria='" . $id_generado . "'";
        //echo $sql;

        $updatecontenido = $db->prepare($sql);
  $updatecontenido->execute();
  $updatecontenido->close();
	}



?>
	<script>window.location="<?= $_SERVER['PHP_SELF']?>?msg=1&idr=<?php echo $idr ?>&categoria=<?php echo $_GET['categoria'] ?>&nivel=<?php echo $nivel ?>";</script>
<? }?>


<?
if($op=="3"){
	/*buscar info de la categoria que se quiere borrar*/
	$db->select("categoria","*","WHERE id_categoria = '".sql_seguro($_GET['idb'])."'");
	$row = $db->fetch_assoc();
	obtener_hijos_categoria($row);
	borrar_categoria($row);
	/*exit;*/
?>
	<script>window.location="<?= $_SERVER['PHP_SELF']?>?op=4&msg=3&idr=<?php echo $idr ?>&categoria=&nivel=<?php echo $nivel ?>";</script>
<?php
}
?>
<? if ($id<>""  ) { $op=1; } else { $op=2;}?>
    <div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
	<?php include('menu_izq.php'); ?>
		<div id="main-content"> <!-- Main Content Section with everything -->
			<div id="miga">
				<noscript><!-- Show a notification if the user has disabled javascript -->
					<div class="notification error png_bg">
						<div><?php $valor=variable(22,2); echo $valor[1]; ?></div>
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
						<div><?php echo $msg ?>  <?php echo $modulo ?></div>
					</div>
				<?php }?>
				<p class="punteado"><strong><?php $valor=variable(8,2); echo $valor[0]; ?>  <?php echo $_SESSION['nombre_usuario'] ?></strong></p>
			  	<div class="miga">
			  		<a href="#"><?php $valor=variable(9,2); echo $valor[0]; ?></a>  <a href="#" class="flecha_miga"><?php echo $modulo ?></a> 
					<div class="clear"></div>
            		<h2>
            			<?php if($id){$valor=variable(2,2); echo $valor[0];} else{$valor=variable(3,2); echo $valor[0];}?> <span class="urgente"><?php echo $modulo ?>
            			<?php
            				$db->select($t1,"*"," where id_categoria='" . $_GET['id'] . "'");
							$row = $db->fetch_assoc();
						?> <?= $row["nombre_categoria"]?>  <?= $row["nivel_categoria"]?></span>
					</h2>
              	</div>
			  	<div class="clear"></div>
			  	<!-- End .clear -->			
				<div class="notification attention png_bg">
					<a href="#" class="close"><img src="imgs/cross_grey_small.png" title="Close this notification" alt="close" /></a>
					<div><?php $valor=variable(158,2); echo $valor[0]; ?></div>
				</div>
            </div>
            <div class="clear"></div> <!-- End .clear -->
            <div class="content-box"><!-- Start Content Box -->
            	<div class="content-box-header">
            		<h3 class="img_conf"><?php echo $modulo ?> 
						<?php
							$db->select("categoria","*"," where  id_categoria='" . $_GET['de'] . "'");
							$row22 = $db->fetch_assoc();
							echo $row22['nombre_categoria'];
						?>
					</h3>
					
					<!--<ul class="content-box-tabs">
						<li><a href="#tab1" class="default-tab">Table</a></li> <!-- href must be unique and match the id of target div 
						<li><a href="#tab2">Forms</a></li>
					</ul>-->
					<div class="clear"></div>
				</div> <!-- End .content-box-header -->
				<div class="content-box-content"><!-- End #tab1 -->
					<?php if($_GET['op']==4){ ?>
						<form action="<?= $_SERVER['PHP_SELF']?>?op=<?php echo $op ?>&amp;idr=<?= $idr ?>&amp;nivel=<?php echo $nivel ?>" method="post" enctype="multipart/form-data" name="usuarios" id="usuarios">
							<fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
								<p>
									<label><?php $valor=variable(10,2); echo $valor[0]; ?> <?php echo $modulo ?></label>
									<input name="nombre_categoria" type="text" class="text-input small-input"  id="nombre_categoria" value="<?= $row["nombre_categoria"]?>" size="32" />
								</p>
								<?php if ($_GET['id']){ ?>
									<p>
										<label><?php $valor=variable(182,2); echo $valor[0]; ?> <?php echo $modulo ?></label>
										<input name="amigable_categoria" type="text" class="text-input small-input"  id="amigable_categoria" value="<?= $row["amigable_categoria"]?>" size="32" />
									</p>
								<?php } ?>
								<p>
									<label><?php $valor=variable(136,2); echo $valor[0]; ?> <?php echo $modulo ?></label>
									<input name="ubica_categoria" type="text" class="text-input small-input"  id="ubica_categoria" value="<?= $row["ubica_categoria"]?>" size="32" />
								</p>
								<? if (!$_GET['de']){ ?>
									<p>
										<label>Tipo  <?php echo $modulo ?></label>
										<select name="tipo" class="small-input" id="tipo">
											<?php
												$cpadre = array();
												$db->select("tipo","*","where idr=8");
												/*$db->last_query();*/
												while ($arraypadre = $db->fetch_array()) {
													$cpadre[] = $arraypadre; 
												}
												foreach ($cpadre as $row_banco) {
											?>
										  		<?php if ($row["tipo"] == $row_banco['id_tipo']) { ?>
										  			<option value="<?= $row_banco['id_tipo'] ?>" selected="selected"><?= $row_banco['nombre_tipo'] ?></option>
										  		<?php } else { ?>
										  			<option value="<?= $row_banco['id_tipo'] ?>"><?= $row_banco['nombre_tipo'] ?></option>
										  		<?php } ?>
									  		<? } ?>
									  	</select>
								  	</p>
							  	<? } ?>
							  	<p>
							  		<label><?php $valor=variable(46,2); echo $valor[0]; ?> <?php echo $modulo ?></label>
							  		<textarea name="descripcion_categoria" id="descripcion_categoria"  cols="90" rows="5"><?= $row['descripcion_categoria']?></textarea>
							  		<?php wysiwyg("descripcion_categoria","full")?>
								</p>
								<? if (1==1){ ?>
								<p>
									<label> <?php $valor=variable(73,2); echo $valor[0]; ?> <?php echo $modulo ?></label>
									<input name="img" type="file" class="text-input small-input" id="img" />
									<?php if($row['img'] <> ""){ ?>
                              			<img src="../imagenes/categoria/<?= $row['img']?>" width="40" />
                              		<?php } ?>
                              		(<?= getMaxUpload()?>mb max)
                              	</p> <?php echo $ancho ?> x <?php echo $alto ?> de alto
                              	<p>
                              		<label> Imagen Cabezote <?php echo $modulo ?></label>
                              		<input name="img1" type="file" class="text-input small-input" id="img1" />
                              		<?php if($row['img'] <> ""){ ?>
                              			<img src="../imagenes/categoria/c<?= $row['img1']?>" width="40" />
                              		<?php } ?> (<?= getMaxUpload()?>mb max)
                              	</p> <?php echo $anchoc ?> x <?php echo $altoc ?> de alto 
                              	<?php } ?>  
  
							  	<!-- empieza los tipifica de esta ctegoria -->
							  	<?php  if ($_GET['de']=="" and $_GET['idr']==121){ ?>
							  	<p>
							  		<label> <?php $valor = variable(172, 2);  echo $valor[0]; ?> <?php echo $modulo ?></label>
									<input name="menu_inferior" id="menu_inferior" type="checkbox" <?php if($row['menu_inferior']==1){ ?> checked="" <?php } ?> />
								</p>
								<p>
									<label>Especificaciones propias de <?php echo $modulo ?></label>
									<?
										$cpadre = array();
										$db->select("tipifica","*","where id_tipo=28  order by id_tipifica asc");
										/*$db->last_query();*/
										while($arraypadre = $db->fetch_array()){
											$cpadre[] = $arraypadre;
										}
										foreach ($cpadre as $row2){
											$db->select("cati","*"," where categoria='" . $row['id_categoria'] . "' and tipifica='" . $row2["id_tipifica"] . "'");
											$checked="";
											if ($rowoso = $db->fetch_assoc()) {
												$checked="checked";
											}
									?>
											<table width="200" border="0" cellspacing="0" cellpadding="0">
			                                    <tr>
			                                    	<td width="20"><input name="tipifica[]" type="checkbox" id="tipifica[]" value="<?= $row2["id_tipifica"]?>" <?= $checked?> /></td>
			                                    	<td ><div align="left" class="campos_style"><?= $row2["nombre_tipifica"]?></div></td>
			                                    </tr>
	                                  		</table>
                                  		<? } ?>
                              	</p>
                              	<? } ?>
								<!-- termina los tipifica de esta ctegoria -->
								<p>
									<input class="button" type="submit" value="<?php if($id){$valor=variable(2,2); echo $valor[0];} else{$valor=variable(3,2); echo $valor[0];}?> <?php echo $modulo ?>" /> <input name="id" type="hidden" id="id" value="<?= $row["id_categoria"]?>" />
									<input name="idr" type="hidden" id="idr" value="<?= $idr ?>" />
						      		<input name="de" type="hidden" id="de" value="<?= $_GET['de'] ?>" />
							  		<input name="nivel_categoria" type="hidden" id="nivel_categoria" value="<?= $_GET['numero']+1 ?>" />
								</p>
							</fieldset><!-- End .clear -->
						</form>
					<?php }?>

					<!-- inicio lista -->  
					<div class="clear"></div> <!-- End .clear -->
					<div class="content-box"><!-- Start Content Box -->
						<div class="content-box-header">
							<h3 class="titu_secc"><a href="#" title="<?php echo $modulo ?>" class="txt_verde"><?php echo $modulo ?></a> <a href="categoria.php?idr=<?php echo $idr ?>&nivel=<?php echo $nivel ?>&op=4">&lt;&lt;<?php $valor=variable(157,2); echo $valor[0]; ?>&gt;&gt;</a></h3>
							<div class="clear"></div>
						</div> <!-- End .content-box-header -->
						<div class="content-box-content">
							<div class="tab-content default-tab" id="tab1">
								<table>
									<tfoot>
										<tr>
											<td colspan="6"><!-- End .pagination --></td>
										</tr>
									</tfoot>
									<tbody>
										<tr>
											<td width="79%" valign="top" class="txt_verde"><a href="#" title="title" class="txt_verde"><?php $valor=variable(10,2); echo $valor[0]; ?>   <?php echo $modulo ?></a></td>
											<td width="20%" class="txt_verde"><?php $valor=variable(14,2); echo $valor[0]; ?></td>
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
						                    $db->select($t1,"*","where modulo='".$idr."' and nivel_categoria=1  order by  ubica_categoria asc");
						                    $num_total_registros = $db->num_rows();
						                    //calculo el total de p&aacute;ginas 
											$total_paginas = ceil($num_total_registros / $TAMANO_PAGINA);
											$db->select($t1,"*","where modulo='".$idr."' and nivel_categoria=1  order by  ubica_categoria asc". " limit " . $inicio . "," . $TAMANO_PAGINA);
											//echo $sql;
											$loop=0;
											$cpadre = array();
											pintar_categorias($arr_categorias, 1);
               						?>
									</tbody>
								</table>
		                        <div class="pagination">
		                        	<? if (($total_paginas > 1)) { ?>
			                        	<? if ($pagina != 1) { ?>
			                        		<a href='<?= $_SERVER['PHP_SELF'] ?>?pg=<?= ($pagina - 1) ?>&idr=<?php echo $idr ?>&nivel=<?php echo $_GET['nivel'] ?>' title="Previous Page"><?php $valor = variable(12, 2); echo $valor[0]; ?></a>
			                        	<? } ?>
			                        	<? for ($i = 1; $i <= $total_paginas; $i++) {
			                        		if ($pagina == $i) { ?>
			                        			<a href='#' class="number current" title="<?= $pagina ?>"> <?= $pagina ?></a>
			                    			<? } else { ?>
			                    				<a href='<?= $_SERVER['PHP_SELF'] ?>?pg=<?php echo $i ?>&idr=<?php echo $idr ?>&nivel=<?php echo $_GET['nivel'] ?>' class="number" title="<?= $i ?>"><?= $i ?></a>
			                				<? } ?>
			            				<? } ?>
			            				<? if ($total_paginas != $pagina) { ?>
			            					<a href='<?= $_SERVER['PHP_SELF'] ?>?pg=<?= ($pagina + 1) ?>&idr=<?php echo $idr ?>&nivel=<?php echo $_GET['nivel'] ?>' title="<?php $valor = variable(13, 2); echo $valor[0]; ?>"><?php $valor = variable(13, 2); echo $valor[0]; ?></a>
			        					<? } ?>
		    						<? } ?>
		    						<br/>
		    					</div>
		    					<form name="form" id="form">
		    						<?php $valor = variable(15, 2); echo $valor[0]; ?>:
		    						<select name="jumpMenu" id="jumpMenu" onChange="MM_jumpMenu('parent',this,0)">
		    							<option value=""><?php $valor = variable(27, 2); echo $valor[0]; ?></option>
		    							<?
		    								$cpadre = array();
											$db->select("pagina","*");
											/*$db->last_query();*/
											while ($arraypadre = $db->fetch_array()) {
												$cpadre[] = $arraypadre; 
											}
											foreach ($cpadre as $row){
										?>
												<?php if ($row["numero"] == $_SESSION['pagina']) { ?>
													<option value="<?= $_SERVER['PHP_SELF'] ?>?paginar=<?php echo utf8_encode($row['numero']) ?>&idr=<?php echo $idr ?>&nivel=<?php echo $_GET['nivel'] ?>" selected="selected"><?php echo utf8_encode($row['numero']) ?>
												<?php } else { ?>
													<option value="<?= $_SERVER['PHP_SELF'] ?>?paginar=<?php echo utf8_encode($row['numero']) ?>&idr=<?php echo $idr ?>&nivel=<?php echo $_GET['nivel'] ?>"><?php echo utf8_encode($row['numero']) ?></option>
												<?php } ?>
										<? } ?>
									</select>
								</form>
				  			</div>
				  			<!-- End #tab1 -->
				  		</div> <!-- End .content-box-content -->
				  	</div><!-- fin lista -->
			  	</div> <!-- End .content-box-content -->
		  	</div> <!-- End .content-box --><!-- End .content-box --><!-- End .content-box --><!-- Start Notifications --><!-- End Notifications -->
		    <?php include('pie.php'); ?>
		</div> 
		<!-- End #main-content -->
	</div></body>
	<script language="javascript">
		function deletex(id){
			if(confirm("<?php $valor=variable(43,2); echo $valor[0]; ?>")) {
				window.location="<?= $_SERVER['PHP_SELF']?>?nivel=<?php echo $nivel ?>&categoria=<?php echo $_GET['categoria'] ?>&op=3&idr=<?php echo $idr ?>&idb=" + id;
			}
		}
    </script>
</html>
<?php
	function pintar_categorias(&$arreglo, $nivel_cat){
		$html = "";
		foreach ($arreglo as $row){

			/*echo $row['nombre_categoria'];*/
			$padding_left = $nivel_cat*20;
			$html = '<tr class="row-cat row-cat-'.$row['nivel_categoria'].'">
						<td valign="top" style="padding: 0px 10px 0px '.$padding_left.'px;" class="tree-icon tree-icon-'.$row['nivel_categoria'].'">
						<a href="categoria.php?id='.$row['id_categoria'].'&amp;op=4&amp;idr='.$_GET['idr'].'&categoria='.$_GET['categoria'].'&nivel='.$_GET['nivel'].'&op=4" title="'.$row['nombre_variable'].'" class="txt_ingresar">
						'.$row['nombre_categoria'].'('.$row['id_categoria'].') ubicado de ('.$row['ubica_categoria'].')';
			if($row['img'] <> ""){
				$html .= '<img src="../imagenes/categoria/'.$row['img'].'" width="40"/>';
			}
			$html .= '</a>
						</td>
						<td class="tree-settings tree-settings-'.$row['nivel_categoria'].'">
							<a class=Ntooltip href="categoria.php?id='.$row['id_categoria'].'&amp;op=4&amp;idr='.$_GET['idr'].'&categoria='.$_GET['categoria'].'&nivel='.$_GET['nivel'].'&op=4" title="Edit">
								<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
							</a>
							<a class=Ntooltip href="javascript:deletex(\''.$row['id_categoria'].'\')" title="Delete">
								<i class="fa fa-trash-o" style="color: #bf0000;" aria-hidden="true"></i>
							</a>';
			if($row['nivel_categoria'] < $_GET['nivel']){
				$html .= '<a class=Ntooltip href="categoria.php?idr='.$_GET['idr'].'&nivel='.$_GET['nivel'].'&de='.$row['id_categoria'].'&numero='.$row['nivel_categoria'].'&op=4" title="Añadir Sub-Categoría">
					<i class="fa fa-plus" style="color: #57a000;" aria-hidden="true"></i>
				</a>';
			}
			$html .= '</td>
					</tr>';
			echo $html;
			if(sizeof($row['hijos']) > 0){
				echo pintar_categorias($row['hijos'], $nivel_cat+1);
			}
			
		}
		
	}
?>