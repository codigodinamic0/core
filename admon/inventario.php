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
                     Inventario</h3>
												
				  <div class="clear"></div>
					
			  </div> <!-- End .content-box-header -->
				
				<div class="content-box-content"><!-- End #tab1 -->
					
                 <!-- Crear contenido -->
                 <table>

                <?php 
                	$db->select("vsede","*","order by ubica_matrix asc");
                	$datosr = array();
                	while ($datos = $db->fetch_array()) {
                		$datosr[] = $datos;
                	}
                	foreach ($datosr as $datos) {
                ?>
                	<tr>
                		<td colspan="">
                			<a><b><?php echo $datos['nombre_matrix'] ?></b></a>
                		<table>
	                		<tr>
	                			<td><b>Nombre</b></td>
	                			<td><b>Dentran</b></td>
	                			<td><b>Devoluciones</b></td>
	                			<td><b>Perdidos</b></td>
	                			<td><b>Ventas</b></td>
	                			<td><b>Total productos</b></td>
	                		</tr>
                	
                <?php
                		$db->select("vproducto","*","order by nombre_matrix asc");
                		while ($datosp = $db->fetch_array()) {
                			$db->select("invetario_sede_productos","*"," where cod_producto='$datosp[id_matrix]' and cod_sede='$datos[id_matrix]'");
                			$datosiv = $db->fetch_array();

                			$totalp = ($datosiv['dentran']+$datosiv['devoluciones'])-($datosiv['perdidos']+$datosiv['ventas']);
                			$semaforo = "";
                			if ($totalp<=10) {
                				$semaforo = "#FF7D48";
                			}
                			if ($totalp<=5) {
                				$semaforo = "#E84D31";
                			}
                			
                			if ($totalp<=1) {
                				$semaforo = "#FF0000";
                			}
                ?>
                		<tr <?php if($semaforo!=""){ ?>style="background: <?php echo $semaforo; ?>; color: #fff; font-weight: bold;"<?php } ?> >
                			<td><?php echo $datosp['nombre_matrix'] ?></td>
                			<td>
                			<span id="txtdentran<?php echo $datosp['id_matrix'].''.$datos['id_matrix']; ?>"><?php echo $datosiv['dentran'] ?></span>
                			<input type="text" class="guardan" data-idp="<?php echo $datosp['id_matrix']; ?>" data-sede="<?php echo $datos['id_matrix']; ?>" data-camp="dentran" value="" id="" style="width: 40px;" ></td>
                			<td>
                				<span id="txtdevoluciones<?php echo $datosp['id_matrix'].''.$datos['id_matrix']; ?>"><?php echo $datosiv['devoluciones'] ?></span>
                				<input type="text" class="guardan" data-idp="<?php echo $datosp['id_matrix']; ?>" data-sede="<?php echo $datos['id_matrix']; ?>" data-camp="devoluciones" value="" id="" style="width: 40px;" ></td>
                			<td>
                				<span id="txtperdidos<?php echo $datosp['id_matrix'].''.$datos['id_matrix']; ?>"><?php echo $datosiv['perdidos'] ?></span>
                				<input type="text" class="guardan" data-idp="<?php echo $datosp['id_matrix']; ?>" data-sede="<?php echo $datos['id_matrix']; ?>" data-camp="perdidos" value="" id="" style="width: 40px;" ></td>
                			<td>
                				<span id="txtventas<?php echo $datosp['id_matrix'].''.$datos['id_matrix']; ?>"><?php echo $datosiv['ventas'] ?></span>
                				<input type="text" class="guardan" data-idp="<?php echo $datosp['id_matrix']; ?>" data-sede="<?php echo $datos['id_matrix']; ?>" data-camp="ventas" value="" id="" style="width: 40px;" ></td>
                			<td><span id="totalv<?php echo $datosp['id_matrix'].''.$datos['id_matrix']; ?>"><?php echo $totalp; ?></span></td>
                		</tr>
                <?php
                		}
                ?>
                		</table>
                		</td>
                	</tr>
                <?php
                	}
                ?>
                </table>
                <script type="text/javascript">
                	$(function(){
                		$(".guardan").blur(function(){
                			var t = $(this);
                			var nump = $(this).attr("data-idp");
                			var numsd = $(this).attr("data-sede");
                			var numd = $(this).val();
                			var camp = $(this).attr("data-camp");

                			$.post("lib/ajax_produc.php",{"cod":"1", "nump":nump, "numsd":numsd, "numd":numd, "camp":camp  },function(data){
                				$("#txt"+camp+""+nump+""+numsd).html(data.un);
                				console.log(data.do);
                				$("#totalv"+nump+""+numsd).html(data.do);
                				t.val("");
                			})
                		})
                	})
                </script>
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

