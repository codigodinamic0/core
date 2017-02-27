<?php include('../lib/funciones.php'); ?>
<?php include('include_mysqli.php'); ?>
<script type="text/javascript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>
<? 
$id=$_GET['id'];
$idr=$_GET['idr'];
$op=$_GET['op'];
$t1="tipifica";
$valor=variable(31,2); 
$modulo=$valor[0];

if ($op=="1" ) { 
	$sql = "UPDATE $t1 set nombre_tipifica='" . sql_seguro($_POST['nombre_tipifica']) . "'";
	$sql = $sql . ", valor= '" . sql_seguro($_POST['valor']) . "'";
	$sql = $sql . ", valor1= '" . sql_seguro($_POST['valor1']) . "'";
	$sql = $sql . ", imagen= '" . sql_seguro($_POST['imagen']) . "'";
	$sql = $sql . ", id_tipo= '" . sql_seguro($_POST['id_tipo']) . "'";
	$sql = $sql . " where id_tipifica= '" . sql_seguro($_POST['id']) . "'";

		$updatecontenido = $db->prepare($sql);
	  $updatecontenido->execute();
	  $updatecontenido->close();
	?>
    
	<script>window.location="<?= $_SERVER['PHP_SELF']?>?msg=2";</script>

<? 
exit;
}?>

<? if ($op=="2") { 
	$sql = "INSERT INTO $t1(nombre_tipifica, valor, valor1, imagen,  id_tipo) values ";
	$sql = $sql . " ('" . sql_seguro($_POST['nombre_tipifica']). "'";
	$sql = $sql . " ,'" . sql_seguro($_POST['valor']) . "'";
	$sql = $sql . " ,'" . sql_seguro($_POST['valor1']) . "'";
	$sql = $sql . " ,'" . sql_seguro($_POST['imagen']) . "'";
	$sql = $sql . " ,'" . sql_seguro($_POST['id_tipo']) . "')";

	//echo $sql;

	$insertmatrix = $db->prepare($sql);
  $insertmatrix->execute();
  $id_generado = $insertmatrix->insert_id;
  $insertmatrix->close();
	?>
    
	<script>window.location="<?= $_SERVER['PHP_SELF']?>?msg=1";</script>

<? }?>


<? if ($op=="3") { 

$db->delete($t1,"where id_tipifica='" . $_GET['idb'] . "'");
	
//borro los tipos de esta categoria

$db->delete("tipo","where idr='" . $_GET['idb'] . "'");
	
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
            	
                <a href="panel.php"><?php $valor=variable(9,2); echo $valor[0]; ?></a>  <a href="#" class="flecha_miga"><?php echo $modulo ?></a> <a href="<?= $_SERVER['PHP_SELF']?>" class="flecha_miga"><?php $valor=variable(3,2); echo $valor[0]; ?> <?php echo $modulo ?></a> 
            
            <div class="clear" style="padding-top:15px;"></div>
            <h2><?php if($id){$valor=variable(2,2); echo $valor[0];} else{$valor=variable(3,2); echo $valor[0];}?> <span class="urgente"><?php echo $modulo ?> 
            	<? 

$db->select($t1,"*","where id_tipifica='" . $_GET['id'] . "'");
$row = $db->fetch_assoc();
?> <?= $row["nombre_tipifica"]?></span></h2>
              </div>
			  <div class="clear"></div>
			  <!-- End .clear -->
			
              <div class="notification attention png_bg">
				<a href="#" class="close"><img src="imgs/cross_grey_small.png" title="Close this notification" alt="close" /></a>
				<div>
                  <?php $valor=variable(32,2); echo $valor[1]; ?>
			    .</div>
			  </div>
              </div>
			
			
			
			
		  <div class="clear"></div> <!-- End .clear -->
			
			<div class="content-box"><!-- Start Content Box -->
				
				<div class="content-box-header">
					
					<h3 class="img_tipif"><?php echo $modulo ?></h3>
					
			    <!--<ul class="content-box-tabs">
						<li><a href="#tab1" class="default-tab">Table</a></li> <!-- href must be unique and match the id of target div 
						<li><a href="#tab2">Forms</a></li>
					</ul>-->
					
					<div class="clear"></div>
					
			  </div> <!-- End .content-box-header -->
				
				<div class="content-box-content"><!-- End #tab1 -->
					
                    
                  <form action="<?= $_SERVER['PHP_SELF']?>?op=<?php echo $op ?>&amp;idr=<?= $idr ?>" method="post" name="usuarios" id="usuarios">
							
					<fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
								
<p>
									<label>
                                    <?php $valor=variable(10,2); echo $valor[0]; ?>
            <?php echo $modulo ?></label>
									<input name="nombre_tipifica" type="text" class="text-input small-input"  id="nombre_tipifica" value="<?= $row["nombre_tipifica"]?>" size="32" />
</p>


<p>
			  <label>
                                   Valor
            <?php echo $modulo ?></label>
									<input name="valor" type="text" class="text-input small-input"  id="valor" value="<?= $row["valor"]?>" size="32" />
</p>

<p>
<label>
                                   Valor1
            <?php echo $modulo ?></label>
									<input name="valor1" type="text" class="text-input small-input"  id="valor1" value="<?= $row["valor1"]?>" size="32" />
</p>


<p>
<label>
                                   Imagen 
            <?php echo $modulo ?></label>
									<input name="imagen" type="text" class="text-input small-input"  id="imagen" value="<?= $row["imagen"]?>" size="32" />
</p>



  <p><label>Clase    <?php echo $modulo; ?> 

        </label><select name="id_tipo" class="small-input" id="id_tipo">

                                <?
        	$cpadre = array();
			$db->select("tipo","*","where idr=12 order by id_tipo desc ");
			/*$db->last_query();*/
			    while ($arraypadre = $db->fetch_array()) {
					$cpadre[] = $arraypadre; 
			    }
			foreach ($cpadre as $row_banco) { 

    	?>

                                          <?php if ($row["id_tipo"] == $row_banco['id_tipo']) { ?>

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
                             
								
								
								<p><input class="button" type="submit" value="<?php if($id){$valor=variable(2,2); echo $valor[0];} else{$valor=variable(3,2); echo $valor[0];}?> <?php echo $modulo ?>" />
								  <input name="id" type="hidden" id="id" value="<?= $row["id_tipifica"]?>" /><br />

                                   
                                    
								</p>
								
				    </fieldset><!-- End .clear -->
							
				  </form>
                    
                
                
                
                
                
                
 <!-- inicio lista -->  
<div class="clear"></div> <!-- End .clear -->
<div class="content-box"><!-- Start Content Box -->
				
				<div class="content-box-header">
				  
					
					<h3 class="titu_secc">
                      <?php $valor=variable(11,2); echo $valor[0]; ?> <a href="#" title="title" class="txt_verde"><?php echo $modulo ?></a></h3>
					
				
					
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
									<td colspan="4"> 
								  <!-- End .pagination --></td>
							  </tr>
							</tfoot>
						 
							<tbody>
                            
   <tr>
<td valign="top"><a href="#" title="title" class="txt_verde">
									 <?php $valor=variable(10,2); echo $valor[0]; ?>
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

                    $db->select($t1,"*","order by  id_tipo desc");
                    $num_total_registros = $db->num_rows(); 

                    //calculo el total de p&aacute;ginas 
$total_paginas = ceil($num_total_registros / $TAMANO_PAGINA); 

                    $db->select($t1,"*","order by  id_tipo desc". " limit " . $inicio . "," . $TAMANO_PAGINA);

                    //echo $sql;
                    $loop=0;                    
	$cpadre = array();
	while ($arraypadre = $db->fetch_array()) {
		$cpadre[] = $arraypadre; 
    }
	foreach ($cpadre as $row) { 
?>
                            
								<tr>
									<td valign="top"><a href="#" title="<?php echo $row['nombre_usuario']?>" class="txt_ingresar">
									  <?php echo $row['nombre_tipifica']?>
									(<?php echo $row['id_tipifica']?>)</a>   
									<?php

 $db->select("tipo","*"," where id_tipo='".$row['id_tipo']."'");
$row1 = $db->fetch_assoc();
   ?>
                        <span class="destacado"><?php echo $row1['nombre_tipo']; ?></span></td>
									<td>
										<!-- Icons -->
										 <a class=Ntooltip href="<?= $_SERVER['PHP_SELF']?>?id=<?= $row['id_tipifica']?>&amp;op=4" title="Edit"><img src="imgs/pencil.png" alt="Edit" />
<span>
<?php $valor=variable(2,2); echo $valor[0]; ?> <?= $modulo; ?>
</span>                                         </a>
<a class=Ntooltip href="javascript:deletex('<?= $row['id_tipifica']?>')" title="Delete"><img src="imgs/cross.png" alt="Delete" /><span>
<?php $valor=variable(1,2); echo $valor[0]; ?>  <?= $modulo; ?>
</span></a>																		</td>
								</tr>
                               <?php  }?>
							</tbody>
					  </table>
				  <div class="pagination">
											
										    <? if (($total_paginas > 1)){ ?>
       
          <? if ($pagina!=1){?>
          <a href='<?= $_SERVER['PHP_SELF']?>?pg=<?= ($pagina-1)?>' title="<?php $valor=variable(12,2); echo $valor[0]; ?>"><?php $valor=variable(12,2); echo $valor[0]; ?></a>
          <? }?>
      
      
      
      
      
      
      
      
    
    <? for ($i=1;$i<=$total_paginas;$i++){ 

if ($pagina == $i) {?>
        
       <a href='#' class="number current" title="<?= $pagina?>"> <?= $pagina?></a>
        
        <? } else {?>
        <a href='<?= $_SERVER['PHP_SELF']?>?pg=<?= $i ?>' class="number" title="<?= $i ?>">
        <?= $i?>
         </a>
        <? } ?>
        <? }?>
        
        
        
        
        
        
    
    
    
    
      <? if ($total_paginas!=$pagina){?>
      <a href='<?= $_SERVER['PHP_SELF']?>?pg=<?= ($pagina+1)?>' title="<?php $valor=variable(13,2); echo $valor[0]; ?>"><?php $valor=variable(13,2); echo $valor[0]; ?></a>
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
		window.location="<?= $_SERVER['PHP_SELF']?>?op=3&idb=" + id;
	}
}
    </script>
</html>

