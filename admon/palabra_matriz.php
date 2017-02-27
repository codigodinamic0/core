<?php include('../lib/funciones.php'); ?>
<?php include('include_mysqli.php'); ?>
<?php 
include "crear_json.php";
crear_json_vistas("idpa","order by id_idpa");
crear_json_vistas("palabra","order by id_palabra");
?>
<? 
$id=$_GET['id'];
$idr=$_GET['idr'];
$idp=$_GET['idp'];
$op=$_GET['op'];
$t1=" idpa";
if ($idr) {
	//identifico modulo

	$db->select("idioma","*"," where id_idioma='" . $idr . "'");
	$row = $db->fetch_assoc();

	$modulo=$row["idioma"];
}
//fin identificacion de modulo tipos

if ($idp) {
	//identifico modulo 

	$db->select("palabra","*"," where codigo_palabra='" . $idp . "'");
	$row = $db->fetch_assoc();

	$modulo=$row["nombre_palabra"];
}
//fin identificacion de modulo tipos
if ($op=="1") { 

	
	$sql = "UPDATE $t1 SET nombre_idpa='" . sql_seguro($_POST['nombre_idpa']) . "'" . 
	        ", titulo_idpa= '" . sql_seguro($_POST['titulo_idpa'])  . "'" . 
			", nota_idpa= '" . sql_seguro($_POST['nota_idpa'])  . "'" . 
			" WHERE id_idpa= '" . sql_seguro($_POST['id']) . "'";

	$updatecontenido = $db->prepare($sql);
	$updatecontenido->execute();
	$updatecontenido->close();
	
	?>
    
<script>window.location="<?= $_SERVER['PHP_SELF']?>?msg=2&idr=<?php echo $idr ?>&idp=<?php echo $idp ?>&grupo=<?php echo $_GET['grupo'] ?>";</script>

<? 
exit;
}?>


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
<?php $valor=variable(8,2); echo $valor[0]; ?>&nbsp;   
<?php echo $_SESSION['nombre_usuario'] ?></strong></p>
			  <div class="miga">
            	
                <a href="panel.php"><?php $valor=variable(9,2); echo $valor[0]; ?></a>  <a href="#" class="flecha_miga"><?php echo $modulo ?></a>  
            
            <div class="clear"></div>
            <h2><?php if($id){$valor=variable(2,2); echo $valor[0];} else{$valor=variable(3,2); echo $valor[0];}?> <span class="urgente"><?php echo $modulo ?> 
			
			
			

<?php 

	$db->select($t1,"*"," where id_idpa='" . $_GET['id'] . "'");
	$row = $db->fetch_assoc();
?> <?= $row["nombre_idpa"]?> 
<?php 

	$db->select("idioma","*"," where id_idioma='" . $row['idioma'] . "'");
	$rowe = $db->fetch_assoc();
?> <?= $rowe["idioma"]?>
</span></h2>
              </div>
			  <div class="clear"></div>
			  <!-- End .clear -->
			
              <div class="notification attention png_bg">
				<a href="#" class="close"><img src="imgs/cross_grey_small.png" title="Close this notification" alt="close" /></a>
				<div>
                  <?php $valor=variable(50,2); echo $valor[1]; ?>
			    .</div>
			  </div>
              </div>
			
			
			
			
		  <div class="clear"></div> <!-- End .clear -->
			
			<div class="content-box"><!-- Start Content Box -->
				
				<div class="content-box-header">
					
					<h3><img src="imgs/comment_48.png" width="25" height="25" /><?php echo $modulo ?> <?= $rowe["idioma"]?></h3>
					
					<!--<ul class="content-box-tabs">
						<li><a href="#tab1" class="default-tab">Table</a></li> <!-- href must be unique and match the id of target div 
						<li><a href="#tab2">Forms</a></li>
					</ul>-->
					
					<div class="clear"></div>
					
			  </div> <!-- End .content-box-header -->
				
				<div class="content-box-content"><!-- End #tab1 -->
					
                  <?php if($id){?>  
                  <form action="<?= $_SERVER['PHP_SELF']?>?op=<?php echo $op ?>&amp;idr=<?= $idr ?>&amp;idp=<?= $idp ?>&grupo=<?php echo $_GET['grupo'] ?>" method="post" enctype="multipart/form-data" name="usuarios" id="usuarios">
							
					<fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
								
<p>
									<label>
									<?php $valor=variable(10,2); echo $valor[0]; ?>
									<?php echo $modulo ?> <?= $rowe["idioma"]?></label>
									<input name="nombre_idpa" type="text" class="text-input small-input"  id="nombre_idpa" value="<?= $row["nombre_idpa"]?>" size="32" />
</p>
                             
                             
                             
<p>
									<label><?php $valor=variable(29,2); echo $valor[0]; ?> <?php echo $modulo ?></label>
                                    <input name="titulo_idpa" type="text" class="text-input small-input"  id="titulo_idpa" value="<?= $row["titulo_idpa"]?>" size="32" />
</p>
									
                                    
                                    
                                    
<p>
									<label> <?php $valor=variable(170,2); echo $valor[0]; ?> <?php echo $modulo ?></label>
<input name="nota_idpa" type="text" class="text-input large-input" id="nota_idpa" value="<?= $row["nota_idpa"]?>" />
									
</p>    
                                
								
                                    
 								
							

								
	  <p>
									<input class="button" type="submit" value="<?php if($id){$valor=variable(2,2); echo $valor[0];} else{$valor=variable(3,2); echo $valor[0];}?> <?php echo $modulo ?>" /> <input name="id" type="hidden" id="id" value="<?= $row["id_idpa"]?>" />
</p>
								
				    </fieldset><!-- End .clear -->
							
				  </form>
                   <?php   } ?>
                
                
                
                
                
                
 <!-- inicio lista -->  
<div class="clear"></div> <!-- End .clear -->
<div class="content-box"><!-- Start Content Box -->
				
				<div class="content-box-header">
					
					<h3 class="titu_secc">
					  <?php $valor=variable(11,2); echo $valor[0]; ?>
				    <a href="#" title="title" class="txt_verde"><?php echo $modulo ?></a></h3>
					
				
					
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
									<td colspan="9"> 
								  <!-- End .pagination --></td>
							  </tr>
							</tfoot>
						 
							<tbody>
                            
   <tr>
<td valign="top"><a href="#" title="title" class="txt_verde">
									 <?php $valor=variable(10,2); echo $valor[0]; ?>
            <?php echo $modulo ?></a></td>
<td valign="top">&nbsp;</td>
<td><a href="#" title="title" ><span class="txt_verde">
                                   <?php $valor=variable(29,2); echo $valor[0]; ?>&nbsp;<?php echo $modulo ?>
                                  </span></a></td>
									
									
					<td><a href="#" title="title" ><span class="txt_verde">
					  <?php $valor=variable(28,2); echo $valor[0]; ?>
				   </span></a></td>
					<td><a href="#" title="title" ><span class="txt_verde">
					  <?php $valor=variable(145,2); echo $valor[0]; ?></span></a></td>
					<td><a href="#" title="title" ><span class="txt_verde">
					  <?php $valor=variable(52,2); echo $valor[0]; ?></span></a></td>
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
                    $db->select("$t1, idioma, tipo","idpa.*, idioma.id_idioma, idioma.idioma, tipo.nombre_tipo"," where idpa.idr=tipo.id_tipo and idioma.id_idioma=idpa.idioma and  (idioma.id_idioma='".$idr."' or (idpa.palabra='".$idp."' and idpa.idr='".$_GET['grupo']."' )) order by  idioma.id_idioma, idpa.idr asc");
                    $num_total_registros = $db->num_rows();
                    //calculo el total de p&aacute;ginas 
$total_paginas = ceil($num_total_registros / $TAMANO_PAGINA); 


                    $cpadre = array();
                    $db->select("$t1, idioma, tipo","idpa.*, idioma.id_idioma, idioma.idioma, tipo.nombre_tipo"," where idpa.idr=tipo.id_tipo and idioma.id_idioma=idpa.idioma and  (idioma.id_idioma='".$idr."' or (idpa.palabra='".$idp."' and idpa.idr='".$_GET['grupo']."' )) order by  idioma.id_idioma, idpa.idr asc". " limit " . $inicio . "," . $TAMANO_PAGINA);
                    //echo $sql;
                    $loop=0;
	while ($arraypadre = $db->fetch_array()) {
		$cpadre[] = $arraypadre; 
    }
foreach ($cpadre as $row) {
?>
                            
								<tr>
									<td valign="top"><a href="#" title="<?php echo $row['titulo_idpa']?>" ><?php echo $row['nombre_idpa']?></a></td>
									<td valign="top"><a href="#" title="<?php echo $row['titulo_idpa']?>" ><span class="destacado_verde"><?php echo $row['nombre_tipo']?> - <?php echo $row['idioma']?></span></a></td>
								  <td><?php echo $row['titulo_idpa']?></td>
									
									
							        <td class="urgente">
	<?php  

		$db->select("palabra","codigo_palabra"," where  id_palabra='" . $row['palabra'] . "'");
		$row22 = $db->fetch_assoc();
?> 
<?php echo  $row22['codigo_palabra'] ?></td>
							        <td class="urgente"><?php echo $row['id_idioma']?></td>
							        <td class="urgente"><?php echo $row['idr']?></td>
						          <td>
										<!-- Icons -->
										 <a class=Ntooltip href="<?= $_SERVER['PHP_SELF']?>?id=<?= $row['id_idpa']?>&amp;op=4&idr=<?php echo $idr ?>&idp=<?php echo $idp ?>&grupo=<?php echo $_GET['grupo'] ?>" title="Edit"><img src="imgs/pencil.png" alt="Edit" />
<span>
<?php $valor=variable(2,2); echo $valor[0]; ?> <?= $modulo; ?>
</span>                                         </a></td>
								</tr>
                               <?php  }?>
							</tbody>
					  </table>
<div class="pagination">
											
										    <? if (($total_paginas > 1)){ ?>
       
          <? if ($pagina!=1){?>
          <a href='<?= $_SERVER['PHP_SELF']?>?pg=<?= ($pagina-1)?>&idr=<?php echo $idr ?>&idp=<?php echo $idp ?>&grupo=<?php echo $_GET['grupo'] ?>' title="<?php $valor=variable(12,2); echo $valor[0]; ?>"><?php $valor=variable(12,2); echo $valor[0]; ?></a>
          <? }?>
      
      
      
      
      
      
      
      
    
    <? for ($i=1;$i<=$total_paginas;$i++){ 

if ($pagina == $i) {?>
        
       <a href='#' class="number current" title="<?= $pagina?>"> <?= $pagina?></a>
        
        <? } else {?>
        <a href='<?= $_SERVER['PHP_SELF']?>?pg=<?= $i ?>&idr=<?php echo $idr ?>&idp=<?php echo $idp ?>&grupo=<?php echo $_GET['grupo'] ?>' class="number" title="<?= $i ?>">
        <?= $i?>
         </a>
        <? } ?>
        <? }?>
        
        
        
        
        
        
    
    
    
    
      <? if ($total_paginas!=$pagina){?>
      <a href='<?= $_SERVER['PHP_SELF']?>?pg=<?= ($pagina+1)?>&idr=<?php echo $idr ?>&idp=<?php echo $idp ?>&grupo=<?php echo $_GET['grupo'] ?>' title="<?php $valor=variable(13,2); echo $valor[0]; ?>"><?php $valor=variable(13,2); echo $valor[0]; ?></a>
      <? }?>
      <? } ?>
<br />
						</div>
						
				  </div> 
                  
                  
			<form name="form" id="form">
  <?php $valor=variable(15,2); echo $valor[0]; ?>:
    <select name="jumpMenu" id="jumpMenu" onChange="MM_jumpMenu('parent',this,0)">
   <option value=""><?php $valor=variable(27,2); echo $valor[0]; ?></option>
   <?php 

		$db->select("pagina","*");
		/*$db->last_query();*/
	    while ($arraypadre = $db->fetch_array()) {
			$cpadre[] = $arraypadre; 
	    }
		foreach ($cpadre as $row) {
	?>
 <?php if($row["numero"] == $_SESSION['pagina']) {?>
<option value="<?= $_SERVER['PHP_SELF']?>?paginar=<?php echo utf8_encode($row['numero']) ?>&idr=<?php echo $idr ?>&idp=<?php echo $idr ?>&grupo=<?php echo $_GET['grupo'] ?>" selected="selected">
<?php echo utf8_encode($row['numero']) ?>
<?php 	} else {?>
 <option value="<?= $_SERVER['PHP_SELF']?>?paginar=<?php echo utf8_encode($row['numero']) ?>&idr=<?php echo $idr ?>&idp=<?php echo $idr ?>&grupo=<?php echo $_GET['grupo'] ?>">
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
		window.location="<?= $_SERVER['PHP_SELF']?>?op=3&idb=" + id;
	}
}
    </script>
</html>

