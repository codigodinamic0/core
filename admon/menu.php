<?php include('../lib/funciones.php'); ?>
<?php include('include_mysqli.php'); ?>
<?php 
$id=$_GET['id'];
$idr=$_GET['idr'];
$op=$_GET['op'];
$t1="menu";
$valor=variable(62,2); 
$modulo=$valor[0];

	if ($op=="1" ) {

		$arrup = array(
		      "nombre"=>sql_seguro($_POST['nombre'])
		    );
		$db->update($t1, $arrup,"where id= '" . sql_seguro($_POST['id']) . "'");

		//ingreso roll
		$db->delete("tiro","where usuario='" . $_POST['id'] . "'");
		if(isset($_POST['tipo'])){
			foreach ($_POST['tipo'] as $tipo){

				$prepend = array(
    				"tipo"=>$tipo,
					"usuario"=>$_POST['id']
				);
				$db->insert("tiro",$prepend);
			}
		}

?>
    
		<script>window.location="<?= $_SERVER['PHP_SELF']?>?msg=2<?php echo $que ?>";</script>

<?php 
		exit;
	}
?>

<?php 
	if ($op=="2") {

		$arrayin = array(
    		"nombre"=>sql_seguro($_POST['nombre'])
		);
		$db->insert($t1,$arrayin);
		$id_generado = $db->insert_id;

		//ingreso roll
		$db->delete("tiro","where usuario='" . $id_generado . "'");
		if(isset($_POST['tipo'])){
			foreach ($_POST['tipo'] as $tipo){

				$prepend = array(
    				"tipo"=>$tipo,
					"usuario"=>$id_generado
				);
				$db->insert("tiro",$prepend);
			}
		}
?>
    
		<script>window.location="<?= $_SERVER['PHP_SELF']?>?msg=1";</script>

<?php
	}
?>


<?php
	if ($op=="3") {

		$db->delete($t1,"where id='" . $_GET['idb'] . "'");

		$db->delete("menu_r","where idr='" . $_GET['idb'] . "'");

		$db->delete("tiro","where usuario='" . $_GET['idb'] . "'");
	?>
   
    <script>window.location="<?= $_SERVER['PHP_SELF']?>?op=4&msg=3&idr=<?php echo $idr ?>";</script>

<?php
	}
?>
<?php if ($id<>""  ) { $op=1; } else { $op=2;}?>
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
              

<?php if ($msg<>"") {
if ($msg=="1"){ $valor=variable(16,2);$msg=$valor[0];}
if ($msg=="2") {$valor=variable(17,2);$msg=$valor[0];}
if ($msg=="3") {$valor=variable(18,2);$msg=$valor[0];}
if ($msg=="4") {$valor=variable(19,2);$msg=$valor[0];}
?>
<div class="notification success png_bg">
<a href="#" class="close"><img src="../imgs/cross_grey_small.png" title="Close this notification" alt="close" /></a>
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
            <h2>
            	<?php if($id){$valor=variable(2,2); echo $valor[0];} else{$valor=variable(3,2); echo $valor[0];}?> 
            	<span class="urgente"><?php echo $modulo ?>
        		<?php

					$db->select($t1, "*", "WHERE id='" . $_GET['id'] . "'");
            		$row = $db->fetch_assoc();
				?>
				<?php echo $row["nombre"]?></span></h2>
              </div>
			  <div class="clear"></div>
			  <!-- End .clear -->
			
              <div class="notification attention png_bg">
				<a href="#" class="close"><img src="imgs/cross_grey_small.png" title="Close this notification" alt="close" /></a>
				<div>
                  <?php $valor=variable(63,2); echo $valor[1]; ?></div>
			  </div>
              </div>
			
			
			
			
		  <div class="clear"></div> <!-- End .clear -->
			
			<div class="content-box"><!-- Start Content Box -->
				
				<div class="content-box-header">
					
					<h3 class="img_menuiz"><?php echo $modulo ?></h3>
					
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
									<input name="nombre" type="text" class="text-input small-input"  id="nombre" value="<?= $row["nombre"]?>" size="32" />
</p>


<p><label><?php $valor=variable(179,2); echo $valor[0]; ?> <?php echo $modulo; ?></label> 
        
       <?php

			$arr_tipo = array();
        	$db->select("tipo", "*", "WHERE idr=9 order by id_tipo");
        	while($arraypadre = $db->fetch_array()){
				$arr_tipo[] = $arraypadre; 
	    	}
	    	foreach ($arr_tipo as $row2){
	    		$db->select("tiro", "*", "WHERE usuario='". $id ."' and tipo='". $row2["id_tipo"] ."'");
	    		$checked="";
				if ($rowoso = $db->fetch_array()) {
					$checked="checked";
				}
		
		?>
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td width="20"><input name="tipo[]" type="checkbox" id="tipo[]"   value="<?= $row2["id_tipo"]?>" <?php echo $checked?> /></td>
						<td ><div align="left" class="destacado_verde">
						<?php echo $row2["nombre_tipo"]?></div></td>
					</tr>
				</table>
		<?php 
			}
		?>
                              
        </p>
        <p><input class="button" type="submit" value="<?php if($id){$valor=variable(2,2); echo $valor[0];} else{$valor=variable(3,2); echo $valor[0];}?> <?php echo $modulo ?>" />
			<input name="id" type="hidden" id="id" value="<?= $row["id"]?>" /><br />
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
							<a href="#" class="close"><img src="../imgs/cross_grey_small.png" title="Close this notification" alt="close" /></a>
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
	        <?php echo $modulo ?>
	    </a></td>
		<td class="txt_verde">
			<?php $valor=variable(14,2); echo $valor[0]; ?>
		</td>
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

		$db->select($t1, "*", "ORDER BY nombre ASC");
		$num_total_registros = $db->num_rows();

		//calculo el total de p&aacute;ginas 
		$total_paginas = ceil($num_total_registros / $TAMANO_PAGINA); 
		//echo $sql;
		$arr_menu = array();
		$db->select($t1, "*", "ORDER BY nombre ASC LIMIT ".$inicio.", ".$TAMANO_PAGINA);
		$loop=0;

		while ($arraypadre = $db->fetch_array()) {
			$arr_menu[] = $arraypadre; 
	    }
		foreach ($arr_menu as $row) {
?>
                            
			<tr>
				<td valign="top"><a href="#" title="<?php echo $row['nombre_usuario']?>" class="txt_ingresar">
			    <?php echo $row['nombre']?></a><a href="#" title="<?php echo $row['nombre']?>" class="txt_ingresar"> <?php if ($row['tipo']==2) {?> 
			    <span class="urgente">
			    <?php $valor=variable(172,2); echo $valor[0]; ?>
			    <?php }?></span></a></td>
		  <td>
										<!-- Icons -->
										 <a class=Ntooltip href="<?= $_SERVER['PHP_SELF']?>?id=<?= $row['id']?>&amp;op=4" title="Edit"><img src="imgs/pencil.png" alt="Edit" />
<span>
<?php $valor=variable(2,2); echo $valor[0]; ?> <?= $modulo; ?>
</span>                                         </a>
<a class=Ntooltip href="javascript:deletex('<?= $row['id']?>')" title="Delete"><img src="imgs/cross.png" alt="Delete" /><span>
<?php $valor=variable(1,2); echo $valor[0]; ?>  <?= $modulo; ?>
</span></a>	



 <a class=Ntooltip href="menu_detalle.php?idr=<?= $row['id']?>&amp;op=4" title="Edit"><img src="imgs/information.png" alt="Edit" />
<span>
<?php $valor=variable(66,2); echo $valor[0]; ?> <?php echo $row['nombre']?>
</span>                                         </a>																	</td>
							  </tr>
    <?php 
		}
	?>
							</tbody>
					  </table>
				  <div class="pagination">
											
										    <?php if (($total_paginas > 1)){ ?>
       
          <?php if ($pagina!=1){?>
          <a href='<?= $_SERVER['PHP_SELF']?>?pg=<?= ($pagina-1)?>' title="<?php $valor=variable(12,2); echo $valor[0]; ?>"><?php $valor=variable(12,2); echo $valor[0]; ?></a>
          <?php }?>
      
      
      
      
      
      
      
      
    
    <?php for ($i=1;$i<=$total_paginas;$i++){ 

if ($pagina == $i) {?>
        
       <a href='#' class="number current" title="<?= $pagina?>"> <?= $pagina?></a>
        
        <?php } else {?>
        <a href='<?= $_SERVER['PHP_SELF']?>?pg=<?= $i ?>' class="number" title="<?= $i ?>">
        <?= $i?>
         </a>
        <?php } ?>
        <?php }?>
        
        
        
        
        
        
    
    
    
    
      <?php if ($total_paginas!=$pagina){?>
      <a href='<?= $_SERVER['PHP_SELF']?>?pg=<?= ($pagina+1)?>' title="<?php $valor=variable(13,2); echo $valor[0]; ?>"><?php $valor=variable(13,2); echo $valor[0]; ?></a>
      <?php }?>
      <?php } ?>
      <br />
					  </div>
						
				  </div> 
                  
                  
			<form name="form" id="form">
  <?php $valor=variable(15,2); echo $valor[0]; ?>:
	<select name="jumpMenu" id="jumpMenu" onChange="MM_jumpMenu('parent',this,0)">
  		<option value=""><?php $valor=variable(27,2); echo $valor[0]; ?></option>
   <?php

		$arr_pag = array();
		$db->select("pagina", "*");
		while ($arraypadre = $db->fetch_array()) {
			$arr_pag[] = $arraypadre; 
	    }
		foreach ($arr_pag as $row){
	?>
		 	<?php
		 		if($row["numero"] == $_SESSION['pagina']) {
			?>
					<option value="<?= $_SERVER['PHP_SELF']?>?paginar=<?php echo utf8_encode($row['numero']) ?>&idr=<?php echo $idr ?>" selected="selected">
					<?php echo utf8_encode($row['numero']) ?>
			<?php
				} else {
			?>
		 			<option value="<?= $_SERVER['PHP_SELF']?>?paginar=<?php echo utf8_encode($row['numero']) ?>&idr=<?php echo $idr ?>">
						<?php echo utf8_encode($row['numero']) ?>
					</option>
		 	<?php
		 		}
			?>
	<?php
		}
	?>
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

