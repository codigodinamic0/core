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

$db->select("tipifica","*","where id_tipifica='" . $idr . "'");
$rowh = $db->fetch_assoc();
$modulo=$row["nombre_tipifica"];
}
//fin identificacion de modulo tipos
if ($op=="1") { 
$sql = "UPDATE $t1 set nombre_tipo='" . sql_seguro($_POST['nombre_tipo']) . "'";
$sql = $sql . ", valor_tipo= '" . sql_seguro($_POST['valor_tipo']) . "'";
$sql = $sql . ", valor_numerico= '" . sql_seguro($_POST['valor_numerico']) . "'";
$sql = $sql . " where id_tipo= '" . sql_seguro($_POST['id']) . "'";

  $updatecontenido = $db->prepare($sql);
  $updatecontenido->execute();
  $updatecontenido->close();

if ($_FILES['img']['name'] != "") {
        $aux = explode(".", $_FILES['img']['name']);
        $nombre_cambiar=$_POST['id'] . "." . $aux[count($aux)-1];
	    $nombre_archivo = strtolower($nombre_cambiar);
        copy($_FILES['img']['tmp_name'], "../imagenes/tipo/" . $nombre_archivo);

        include_once ('thumbnail.inc.php');
        //grandes
        $thumb = new Thumbnail("../imagenes/tipo/" . $nombre_archivo);
        if ($thumb->getCurrentHeight() > $alto) {
            $thumb->resize(0, $alto);
            //$thumb->crop(0,0,720,252);
            $thumb->save("../imagenes/tipo/" . $nombre_archivo);
            $thumb->destruct();

        }

		
		
		        $thumb = new Thumbnail("../imagenes/tipo/" . $nombre_archivo);
        if ($thumb->getCurrentWidth() > $ancho) {
            $thumb->resize($ancho, 0);
            //$thumb->crop(0,0,720,252);
            $thumb->save("../imagenes/tipo/" . $nombre_archivo);
            $thumb->destruct();

        }
		

        $sql = "UPDATE tipo set img='" . $nombre_archivo .
            "' where id_tipo='" . $_POST['id'] . "'";
        //echo $sql;

          $updatecontenido = $db->prepare($sql);
  $updatecontenido->execute();
  $updatecontenido->close();
	}
?>
	<script>window.location="<?= $_SERVER['PHP_SELF']?>?msg=2&idr=<?php echo $idr ?>";</script>
<? 
exit;
}?>



<? if ($op=="3") { 

	$db->delete($t1,"where id_tipo='" . $_GET['idb'] . "'");
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

			  <div class="clear"></div>
			  <!-- End .clear -->
			
              <div class="notification attention png_bg">
				<a href="#" class="close"><img src="imgs/cross_grey_small.png" title="Close this notification" alt="close" /></a>
				<div>
					Pedidos</div>
			  </div>
              </div>
			
			
			
			
		  <div class="clear"></div> <!-- End .clear -->
			
			<div class="content-box"><!-- Start Content Box -->
				
				<div class="content-box-header">
					
					<h3 class="img_tipo">
                      <?php

 $db->select("tipifica","*","where id_tipifica='".$idr."'");
$row_detalle = $db->fetch_assoc();
   ?>
                    <?php echo $modulo ?> mysqli</h3>
					
					<!--<ul class="content-box-tabs">
						<li><a href="#tab1" class="default-tab">Table</a></li> <!-- href must be unique and match the id of target div 
						<li><a href="#tab2">Forms</a></li>
					</ul>-->
					
				  <div class="clear"></div>
					
			  </div> <!-- End .content-box-header -->
				
				<div class="content-box-content"><!-- End #tab1 -->
					
                    
                
                
                
                
                
                
 <!-- inicio lista -->  
<div class="clear"></div> <!-- End .clear -->
<div class="content-box"><!-- Start Content Box -->
				
				<div class="content-box-header">
					
					<h3 class="titu_secc"><a href="#" title="<?php echo $modulo ?>" class="txt_verde">Pedidos</a></h3>
					
				
					
				  <div class="clear"></div>
					
				</div> <!-- End .content-box-header -->
				
				<div class="content-box-content">
				<div class="filtrosp" >
					<form method="get" action="">
						<div>
							<span>Filtro por Estado</span>
							<select name="estado" >
								<option value="">-- Seleccionar filtro --</option>
								<option value="1" <?php if($_GET['estado']==1){ ?>selected<?php } ?> >Aprobado y despachado</option>
								<option value="2" <?php if($_GET['estado']==2){ ?>selected<?php } ?> >Aprobado</option>							
								<option value="5" <?php if($_GET['estado']==5){ ?>selected<?php } ?> >Pendiente</option>
								<option value="3" <?php if($_GET['estado']==3){ ?>selected<?php } ?> >Rechazado</option>	
							</select>

							<span>Filtro por usuario</span> <input type="text" name="usuario" >
							<input type="submit" value="Filtrar">
						</div>
						<br>
					</form>
				</div>
					
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
									<td colspan="5"> 
								  <!-- End .pagination --></td>
							  </tr>
							</tfoot>
						 
							<tbody>
                            
   <tr>
<td width="8%" valign="top"><a href="#" title="title" class="txt_verde">
									  </a><a href="#" title="title" class="txt_ingresar"><span class="txt_verde"><?php $valor=variable(35,2); echo $valor[0]; ?></span></a></td>
<td valign="top" class="txt_verde"><a href="#" title="title" class="txt_verde"><?php $valor=variable(10,2); echo $valor[0]; ?>  Usuario</a></td>
<td class="txt_verde"><a href="#" class="txt_verde">Nombre recibe</a></td>
<td class="txt_verde"><a href="#" class="txt_verde">Dirección</a></td>
<td class="txt_verde"><a href="#" class="txt_verde">Teléfono</a></td>
<td class="txt_verde"><a href="#" class="txt_verde">Celular</a></td>
<td class="txt_verde"><a href="#" class="txt_verde">Ciudad</a></td>
<td class="txt_verde"><a href="#" class="txt_verde">Precio total pedido</a></td>
<td class="txt_verde"><a href="#" class="txt_verde">Estado producto</a></td>
<td width="25%" class="txt_verde"><?php $valor=variable(14,2); echo $valor[0]; ?></td>
							  </tr>       
 <script type="text/javascript">
	$(document).ready(function(){
		$(".vedeta").click(function(){
			$(this).find("table").show("slow");
			$(this).find("table").click(function(){
				$(this).hide("show");
				return false;
			})
		})
		$(".estadochan").change(function(){
				id= $(this).attr("rel");
				parameters = {
	              "cod":3,
	              "es":$(this).val(),
	              "id":id
	            }
	            $.ajax({
	            data: parameters,
	                  url:   'php/ajax_hlo.php',
	                  type:  'POST',
	                  beforeSend: function () 
	                  {

	                  },
	                  success:  function (response) {
	                  	$(".msg"+id).html("Estado actualizado");
	                  	setTimeout(function(){
	                  		$(".msg"+id).html("");
	                  	},1000)
	                  }
	              });
			})

	})
</script>                 
<?php
$TAMANO_PAGINA =$_SESSION['paginador']; 
$inicio = 0; 
$pagina=1; 
$texto="";
if ($_SESSION['pag']) {
$pagina = $_SESSION['pag'];
$inicio = ($pagina - 1) * $TAMANO_PAGINA; 

        } 
$filtro = "";			
if ($_GET['estado']!="") 
{
	$filtro = "and pedido.estado_pedido=$_GET[estado] ";
}
if ($_GET['usuario']!="") 
{
	$filtro .= "and (registrado.nombre_registrado like '%$_GET[usuario]%' or pedido.empresa like '%$_GET[usuario]%' or pedido.persona like '%$_GET[usuario]%' or pedido.ciudad like '%$_GET[usuario]%')";
}

                    $db->select("pedido,registrado","pedido.*,registrado.nombre_registrado","where pedido.idCliente=registrado.id_registrado $filtro  order by  pedido.estado_pedido DESC");
                    $num_total_registros = $db->num_rows(); 
                    //calculo el total de p&aacute;ginas 
$total_paginas = ceil($num_total_registros / $TAMANO_PAGINA);              

                    $db->select("pedido,registrado","pedido.*,registrado.nombre_registrado","where pedido.idCliente=registrado.id_registrado $filtro  order by  pedido.estado_pedido DESC". " limit " . $inicio . "," . $TAMANO_PAGINA);
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
									<td valign="top"><a href="#" title="<?= $row['codigo_variable']?>" ><span class="urgente">
									  <?= $row['id_pedido']?>
									</span></a></td>
									<td valign="top"><?php if($row['img'] <> ""){ ?>
                              <img src="../imagenes/tipo/<?= $row['img']?>" width="40" />
                              <?php } ?><?= $row['nombre_registrado']?>
									</td>
									<td><?php echo $row['persona']; ?></td>
									<td><?php echo $row['direccion']; ?></td>
									<td><?php echo $row['telefono']; ?></td>
									<td><?php echo $row['celular']; ?></td>
									<td><?php echo $row['ciudad']; ?></td>
								<td>$<?php echo number_format($row['total']); ?></td>
								<td>
									<select rel="<?php echo $row['id_pedido']; ?>" <?php if($row['estado_pedido']==1){ ?>disabled="true"<?php } ?> class="estadochan" >
										<option value="1" <?php if($row['estado_pedido']==1){ ?>selected<?php } ?> >Aprobado y despachado</option>
										<option value="2" <?php if($row['estado_pedido']==2){ ?>selected<?php } ?> >Aprobado</option>							
										<option value="5" <?php if($row['estado_pedido']==5){ ?>selected<?php } ?> >Pendiente</option>
										<option value="3" <?php if($row['estado_pedido']==3){ ?>selected<?php } ?> >Rechazado</option>
									</select><span class="msg<?php echo $row['id_pedido']; ?>" style="position:absolute" ></span>
								</td>
								  <td>
								 
								  		<span style="cursor:pointer" class="vedeta">Ver detalle
								  		<table style="display:none">
								  		<tr>
								  			<td><b>Nombre</b></td><td><b>Cantidad</b></td><td><b>Precio</b></td>
								  		</tr>
								  		<?php

							  				$cpadre = array();
											$db->select("pedido_det,vproducto","vproducto.*,pedido_det.*","where vproducto.id_matrix=pedido_det.id_producto and pedido_det.id_pedido=$row[id_pedido]");
											/*$db->last_query();*/
											    while ($arraypadre = $db->fetch_array()) {
													$cpadre[] = $arraypadre; 
											    }
											foreach ($cpadre as $array) { 
								  		?>
								  			<tr>
								  				<td>
								  					<?php echo $array['nombre_matrix']; ?>
								  				</td>
								  				<td>
								  					<?php echo $array['cantidad']; ?>
								  				</td>
								  				<td>
								  					<?php echo $array['precio_pedido_det']; ?>
								  				</td>
								  			</tr>
								  		<?php
								  			}
								  		?>
								  		</table>
								  		</span>																
								  </td>
								</tr>
                               <?php  }?>
							</tbody>
						</table>
<div class="pagination">
											
										    <? if (($total_paginas > 1)){ ?>
       
          <? if ($pagina!=1){?>
          <a href='<?= $_SERVER['PHP_SELF']?>?pg=<?= ($pagina-1)?>&idr=<?php echo $idr ?>' title="Previous Page"><?php $valor=variable(12,2); echo $valor[0]; ?></a>
          <? } ?>
      
      
      
      
      
      
      
      
    
    <? for ($i=1;$i<=$total_paginas;$i++){ 

if ($pagina == $i) {?>
        
       <a href='#' class="number current" title="<?= $pagina?>"> <?= $pagina?></a>
        
        <? } else {?>
<a href='<?= $_SERVER['PHP_SELF']?>?pg=<?php echo $i?>&idr=<?php echo $idr ?>' class="number" title="<?= $i ?>"><?= $i?></a>
        <? } ?>
        <? } ?>
        
        
        
        
        
        
    
    
    
    
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

