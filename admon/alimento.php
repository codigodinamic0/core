<?php include('../lib/funciones.php'); ?>
<?php include('include_mysqli.php'); ?>
<? 
$id=$_GET['id'];
$idr=$_GET['idr'];
$principal=$_GET['principal'];
$op=$_GET['op'];
$t1="alimento";
if ($idr) {
//identifico modulo 
$db->select("mtipo","*","where id_mtipo='" . $idr . "'");
$row = $db->fetch_assoc();

$modulo=" Campos ".$row["nombre_mtipo"];
}
//fin identificacion de modulo tipos
if ($op=="1") { 

$sql = "UPDATE $t1 set id_mtipo='" . sql_seguro($_POST['idr']) . "'";
$sql = $sql . ", nombre_alimento= '" . sql_seguro($_POST['nombre_alimento']) . "'";
$sql = $sql . ", valor_alimento= '" . sql_seguro($_POST['valor_alimento']) . "'";
$sql = $sql . " where id_alimento= '" . sql_seguro($_POST['id']) . "'";

  $updatecontenido = $db->prepare($sql);
  $updatecontenido->execute();
  $updatecontenido->close();


if ($_FILES['img']['name'] != "") {
	$aux = explode(".",$_FILES['img']['name']);
		$nombre_cambiar=$_POST['id'] . "." . $aux[count($aux)-1];
	$nombre_archivo = strtolower($nombre_cambiar);
	copy ($_FILES['img']['tmp_name'], "../imagenes/alimento/" . $nombre_archivo ) ;

	$sql = "UPDATE $t1 set img_alimento='" . $nombre_archivo . "' where id_alimento='" . $_POST['id'] . "'";

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
$sql = "INSERT INTO $t1(id_mtipo, nombre_alimento, valor_alimento) values ";
$sql = $sql . " ('" . sql_seguro($_POST['idr']) . "'";
$sql = $sql . " ,'" . $_POST['nombre_alimento'] . "'";
$sql = $sql . " ,'" . sql_seguro($_POST['valor_alimento']) . "')";
	//echo $sql;

  $insertmatrix = $db->prepare($sql);
  $insertmatrix->execute();
  $id_generado = $insertmatrix->insert_id;
  $insertmatrix->close();


if ($_FILES['img']['name'] != "") {
	$aux = explode(".",$_FILES['img']['name']);
		$nombre_cambiar=$id_generado . "." . $aux[count($aux)-1];
	$nombre_archivo = strtolower($nombre_cambiar);
	copy ($_FILES['img']['tmp_name'], "../imagenes/alimento/" . $nombre_archivo ) ;

	$sql = "UPDATE $t1 set img_alimento='" . $nombre_archivo . "' where id_alimento='" . $id_generado . "'";

	  $updatecontenido = $db->prepare($sql);
  $updatecontenido->execute();
  $updatecontenido->close();
	}

?>
	<script>window.location="<?= $_SERVER['PHP_SELF']?>?msg=1&idr=<?php echo $idr ?>";</script>
<? }?>


<? if ($op=="3") { 

	$db->select($t1,"*","WHERE id_alimento='" . $_POST['idb'] . "'");
$row = $db->fetch_assoc();
	if($row['img_idioma']!=""){
		if(file_exists("../imagenes/alimento/" . $row['img_alimento']))
			unlink("../imagenes/alimento/" . $row['img_alimento']);
	}

	$db->delete($t1,"WHERE id_alimento='" . $_POST['idb'] . "'");

	?>
   
    <script>window.location="<?= $_SERVER['PHP_SELF']?>?op=4&msg=3&idr=<?php echo $idr ?>";</script>

<?
exit;
 }
?>
<? if ($id<>""  ) { $op=1; } else { $op=2;}?>
    <div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
<?php include('menu_izq.php'); ?>
		
		<div id="main-content"> <!-- Main Content Section with everything -->
			
			<div id="miga">mysqli
              <noscript><!-- Show a notification if the user has disabled javascript -->
				<div class="notification error png_bg">
					<div>
						 <?php $valor=variable(22,2); echo $valor[1]; ?>				</div>
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
<?php echo $msg ?>  <?php echo $modulo ?></div>
</div>
<?php }?>
<p class="punteado"><strong><?php $valor=variable(8,2); echo $valor[0]; ?>  <?php echo $_SESSION['nombre_usuario'] ?></strong></p>
			  <div class="miga">
            	
                <a href="#"><?php $valor=variable(9,2); echo $valor[0]; ?></a>  <a href="#" class="flecha_miga"><?php echo $modulo ?></a> <a href="<?= $_SERVER['PHP_SELF']?>?idr=<?php echo $idr ?>" class="flecha_miga"><?php $valor=variable(3,2); echo $valor[0]; ?> <?php echo $modulo ?></a>
            
            <div class="clear"></div>
            <h2><?php if($id){$valor=variable(2,2); echo $valor[0];} else{$valor=variable(3,2); echo $valor[0];}?> <span class="urgente"><?php echo $modulo ?> 

<? 

$db->select($t1,"*","where id_alimento='" . $_GET['id'] . "'");
$row = $db->fetch_assoc();

?> <?= $row["nombre_alimento"]?></span></h2>
              </div>
			  <div class="clear"></div>
			  <!-- End .clear -->
			
              <div class="notification attention png_bg">
				<a href="#" class="close"><img src="imgs/cross_grey_small.png" title="Close this notification" alt="close" /></a>
				<div>
				  <?php $valor=variable(100,2); echo $valor[1]; ?>
				</div>
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
					
                    
                  <form action="<?= $_SERVER['PHP_SELF']?>?op=<?php echo $op ?>&amp;idr=<?= $idr ?>" method="post" enctype="multipart/form-data" name="usuarios" id="usuarios">
							
					<fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
								

                             
                             
                             
<p>
<label><?php $valor=variable(10,2); echo $valor[0]; ?>&nbsp; <?php echo $modulo ?></label>
<input name="nombre_alimento" type="text" class="text-input small-input"  id="nombre_alimento" value="<?= $row["nombre_alimento"]?>" size="32" />
</p>

<p>
<label><?php $valor=variable(29,2); echo $valor[0]; ?>&nbsp; <?php echo $modulo ?></label>
<input name="valor_alimento" type="text" class="text-input small-input"  id="valor_alimento" value="<?= $row["valor_alimento"]?>" size="32" />
</p>


                                    
<p><label> <?php $valor=variable(41,2); echo $valor[0]; ?> <?php echo $modulo ?></label>
<input name="img" type="file" class="text-input small-input" id="img" /><?php if($row['img_alimento'] <> ""){ ?><img src="../imagenes/alimento/<?= $row['img_alimento']?>" width="40" /><?php } ?>(<?= getMaxUpload()?>mb max)</p>  
									
                                    
                                    
								
								
								<p>
								  <input class="button" type="submit" value="<?php if($id){$valor=variable(2,2); echo $valor[0];} else{$valor=variable(3,2); echo $valor[0];}?> <?php echo $modulo ?>" />
								  <input name="id" type="hidden" id="id" value="<?= $row["id_alimento"]?>" />
									<input name="idr" type="hidden" id="idr" value="<?= $idr ?>" />
								</p>
								
				    </fieldset><!-- End .clear -->
							
				  </form>
                    
                
                
                
                
                
                
 <!-- inicio lista -->  
<div class="clear"></div> <!-- End .clear -->
<div class="content-box"><!-- Start Content Box -->
				
				<div class="content-box-header">
					
					<h3 class="titu_secc"><a href="#" title="<?php echo $modulo ?>" class="txt_verde"><?php echo $modulo ?></a></h3>
					
				
					
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
									<td colspan="5">&nbsp;</td>
							  </tr>
							</tfoot>
						 
							<tbody>
                            
   <tr>

<td valign="top" class="txt_verde"><a href="#" title="title" class="txt_verde"><?php $valor=variable(10,2); echo $valor[0]; ?>   <?php echo $modulo ?></a></td>
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
			

                    $db->select($t1,"*","where id_mtipo='".$idr."'  order by  id_mtipo asc");
                    $num_total_registros = $db->num_rows();
                    //calculo el total de p&aacute;ginas 
$total_paginas = ceil($num_total_registros / $TAMANO_PAGINA); 

                    $db->select($t1,"*","where id_mtipo='".$idr."'  order by  id_mtipo asc". " limit " . $inicio . "," . $TAMANO_PAGINA);
                                             
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
								  <td valign="top"><a href="#" title="<?= $row['nombre_mtipo']?>" ><?php if($row['img_alimento'] <> ""){ ?><img src="../imagenes/alimento/<?= $row['img_alimento']?>" width="40" /><?php } ?><?= $row['nombre_alimento']?> (
								    <?
	
$db->select("alimento","count(id_alimento) as valor","where  id_mtipo='" . $row['id_mtipo'] . "'");
$row22 = $db->fetch_assoc();
?>

                                  <?= $row22['valor']?>)
</a></td>
<td>
										<!-- Icons -->
										 <a class=Ntooltip href="<?= $_SERVER['PHP_SELF']?>?id=<?= $row['id_alimento']?>&amp;op=4&amp;idr=<?php echo $idr ?>" title="Edit"><img src="imgs/pencil.png" alt="Edit" />
<span>
<?php $valor=variable(2,2); echo $valor[0]; ?> <?= $modulo; ?>
</span>                                         </a>
<a class=Ntooltip href="javascript:deletex('<?= $row['id_alimento']?>')" title="Delete"><img src="imgs/cross.png" alt="Delete" /><span>
<?php $valor=variable(1,2); echo $valor[0]; ?><?= $modulo; ?>
</span></a></td>
								</tr>
                               <?php  }?>
							</tbody>
						</table>
<div class="pagination">
											
										    <? if (($total_paginas > 1)){ ?>
       
          <? if ($pagina!=1){?>
          <a href='<?= $_SERVER['PHP_SELF']?>?pg=<?= ($pagina-1)?>&idr=<?php echo $idr ?>' title="Previous Page"><?php $valor=variable(12,2); echo $valor[0]; ?></a>
          <? }?>
      
      
      
      
      
      
      
      
    
    <? for ($i=1;$i<=$total_paginas;$i++){ 

if ($pagina == $i) {?>
        
       <a href='#' class="number current" title="<?= $pagina?>"> <?= $pagina?></a>
        
        <? } else {?>
<a href='<?= $_SERVER['PHP_SELF']?>?pg=<?php echo $i?>&idr=<?php echo $idr ?>' class="number" title="<?= $i ?>"><?= $i?></a>
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
		window.location="<?= $_SERVER['PHP_SELF']?>?op=3&idr=<?php echo $idr ?>&idb=" + id;
	}
}
    </script>
</html>

