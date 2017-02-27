<?php include('../lib/funciones.php'); ?>
<?php include('include_mysqli.php'); ?>
<?php 
include "crear_json.php";
crear_json_vistas("tipo","order by id_tipo");
?>
<? 
$id=$_GET['id'];
$idr=$_GET['idr'];
$op=$_GET['op'];
$t1="tipo";
$alto=2000;
$ancho=2000;
if ($idr) {
	//identifico modulo 
	$db->select("tipifica","*"," where id_tipifica='" . $idr . "'");
	$row = $db->fetch_assoc();
	$modulo=$row["nombre_tipifica"];
}
//fin identificacion de modulo tipos
?>

<? if ($id<>""  ) { $op=1; } else { $op=2;}?>
    <div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
<?php include('menu_izq.php'); ?>
		
		<div id="main-content"> <!-- Main Content Section with everything -->
			
			<div id="miga">
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
$db->select($t1,"*"," where id_tipo='" . $_GET['id'] . "'");
$row = $db->fetch_assoc();
?> <?= $row["nombre_tipo"]?></span></h2>
              </div>
			  <div class="clear"></div>
			  <!-- End .clear -->
			
              <div class="notification attention png_bg">
				<a href="#" class="close"><img src="imgs/cross_grey_small.png" title="Close this notification" alt="close" /></a>
				<div>
					<?php $valor=variable(34,2); echo $valor[1]; ?></div>
			  </div>
              </div>
			
			
			
			
		  <div class="clear"></div> <!-- End .clear -->
			
			<div class="content-box"><!-- Start Content Box -->
				
				<div class="content-box-header">
					
					<h3 class="img_tipo">
                      <?php

						$db->select("tipifica","*"," where id_tipifica='".$idr."'");
						$row_detalle = $db->fetch_assoc();
					   ?>
                    <?php echo $modulo ?></h3>
					
					<!--<ul class="content-box-tabs">
						<li><a href="#tab1" class="default-tab">Table</a></li> <!-- href must be unique and match the id of target div 
						<li><a href="#tab2">Forms</a></li>
					</ul>-->
					
				  <div class="clear"></div>
					
			  </div> <!-- End .content-box-header -->
				
				<div class="content-box-content"><!-- End #tab1 -->
					
                    
                  <form action="<?= $_SERVER['PHP_SELF']?>" method="get" enctype="multipart/form-data">
							
						

                             
                             
                             
						<p>
							<label>Fecha desde</label>
							<input type="text" name="desde" id="fecha">
						</p>
						<p>
							<label>Fecha Hasta</label>
							<input type="text" name="hasta" id="nacio_registrado">
						</p>
						<p>
							<label>Seleccionar digitador</label>	
							<select name="digitador">
								<option value="">Todos los digitadores</option>
								<?php 
									$db->select("usuario","*","where tipo=100");
									while ($datos = $db->fetch_array()) {
								?>
								<option value="<?php echo $datos['id_usuario'] ?>"><?php echo $datos['nombre_usuario']; ?></option>
								<?php
									}
								?>
							</select>						
						</p>
									
						
								<p>
									<input class="button" type="submit" value="Generar informe" /> 
								</p>
								
				   
							
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
						<?php 
							$fecha = date("Y-m-d");
					   		$where =" and candidato.fecha like'$fecha%'";
					   		if (@$_GET['desde']!="" and @$_GET['hasta']!="") {
					   			$where = " and date_format(candidato.fecha,'%Y-%m-%d') between  '$_GET[desde]' and '$_GET[hasta]'";
					   		}
					   		if (@$_GET['digitador']!="") {
					   			$where .= " and candidato.id_registrado='$_GET[digitador]'";
					   		}
					   		$db->select("candidato,usuario","usuario.nombre_usuario,usuario.id_usuario"," where candidato.id_registrado=usuario.id_usuario and usuario.tipo=100 $where ");
					   		$numtotal = $db->num_rows();
						?>
						<div style="padding:20px;">
							<a href="excel_informe.php?desde=<?php echo $_GET['desde'] ?>&hasta=<?php echo $_GET['hasta'] ?>&candidato=&t=1">Descargar informe registros de todos </a> | <a href="excel_informe.php?desde=<?php echo $_GET['desde'] ?>&hasta=<?php echo $_GET['hasta'] ?>&candidato=&t=2">Descargar informe general de todos (<b><?php echo $numtotal ?></b>)</a>
						</div>
				  <table>												 
							<tbody>
                            
   <tr>
   		<td>Nombre</td>
   		<td>Total registros</td>
   		<td>Opciones</td>
   </tr>                         
   <?php 
   		$db->select("candidato,usuario","count(candidato.id) as total,usuario.nombre_usuario,usuario.id_usuario"," where candidato.id_registrado=usuario.id_usuario and usuario.tipo=100 $where group by candidato.id_registrado order by usuario.nombre_usuario");
   		// echo $db->last_query;
   		while ($dator = $db->fetch_array()) {
   	?>
   		<tr>
   			<td><?php echo $dator['nombre_usuario'] ?></td>
   			<td><?php echo $dator['total'] ?></td>
   			<td> <a href="excel_informe.php?desde=<?php echo $_GET['desde'] ?>&hasta=<?php echo $_GET['hasta'] ?>&candidato=<?php echo $dator['id_usuario'] ?>&t=2">Descargar informe Registros</a></td>
   		</tr>
   	<?php
   		}

   ?>
							</tbody>
						</table>

						
				  </div> 
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

