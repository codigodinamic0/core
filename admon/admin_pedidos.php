<?php include('../lib/funciones.php'); ?>
<?php include('include_mysqli.php'); ?>
<?php


if(isset($_POST['cambiar_estado']))
{
    
    $sql = "UPDATE `pedido` SET `estado_pedido`='".$_POST['estado']."' WHERE (`id_pedido`='".$_POST['idp']."')";

      $updatecontenido = $db->prepare($sql);
  $updatecontenido->execute();
  $updatecontenido->close();


    $db->select("pedido","*","INNER JOIN registrado ON pedido.idCliente = registrado.id_registrado
            where id_pedido = '" . $_POST['idp']. "'");
$row = $db->fetch_assoc();
    
    // m?ltiples recipientes
    $para = $row['correo_registrado'];

    // asunto
    $asunto = variables(23, $idioma, 30);

    // Para enviar correo HTML, la cabecera Content-type debe definirse
    $cabeceras = 'MIME-Version: 1.0' . "\r\n";
    $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    

        $db->select("estado_pedido","*","where idestado_pedido='".$_POST['estado']."'");
$rowpanel = $db->fetch_assoc();
    
    $mensajepanel='
    <table style="font-family: Tahoma;

	font-size: 15px;

	color: #333333; width:500px; background:#F2F2F2; margin:15px;">

		<tbody>
        
        <tr>

        <td width="500">

        <div  style="background-color: #F33; font-family: tahoma; font-size: 14px; font-weight: bold; text-transform: uppercase; color: #FFFFFF;">su pedido cambio a estado:'.$rowpanel['estado_pedido'].'</div>

        </td>

        </tr>
		</tbody>

     </table><br />';
    mail($para, $asunto,$mensajepanel.$row['mensaje'], $cabeceras);
        
 ?>
 <script type="text/javascript">
    alert("Cambio de estado Realizado Correctamente");
 </script>
 <?php   
    
}
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
$modulo="PEDIDOS";
$estado_pregistrado = isset($_POST['estado_registrado']) ? "1" : "2";
?>
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
            	
                <a href="panel.php"><?php $valor=variable(9,2); echo $valor[0]; ?></a>  <a href="#" class="flecha_miga"><?php echo $modulo ?></a> <a href="<?= $_SERVER['PHP_SELF']?>?idr=<?php echo $idr ?>" class="flecha_miga"> </a> 
            
            <div class="clear" style="padding-top:15px;"></div>
            
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
					
					<h3><img src="imgs/pencil (1).png" width="16" height="16" style="padding:5px;" /><?php echo $modulo ?></h3>
					
		      <!--<ul class="content-box-tabs">
						<li><a href="#tab1" class="default-tab">Table</a></li> <!-- href must be unique and match the id of target div 
						<li><a href="#tab2">Forms</a></li>
					</ul>-->
					
					<div class="clear"></div>
					
			  </div> <!-- End .content-box-header -->
				
				<div class="content-box-content"><!-- End #tab1 -->
					
                    
                  <!---------------Contenido Aqui------------------------>
                    
                
                
                <?php if(isset($_GET['id_pedido'])){?>
<div class="content-box"><!-- Start Content Box -->
				<div class="content-box-header">
					<h3 class="titu_secc">
                     <a href="#" title="title" class="txt_verde">Detalle <?php echo $modulo ?></a></h3>
				  <div class="clear"></div>	
				</div> <!-- End .content-box-header -->
				<div class="content-box-content">
					
					<div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
<table>
							
							<tfoot>
								<tr>
									<td colspan="7"> 
								  <!-- End .pagination --></td>
							  </tr>
							</tfoot>
						 
							<tbody>
                            
   <tr>
    <td valign="top"><a href="#" title="title" class="txt_verde">Nombre</a></td>
    <td valign="top"><a href="#" title="title" class="txt_verde">Talla</a></td>
    <td valign="top"><a href="#" title="title" class="txt_verde">Cantidad</a></td>
    <td valign="top"><a href="#" title="title" class="txt_verde">Precio</a></td>
    <td valign="top"><a href="#" title="title" class="txt_verde">Total</a></td>
    </tr>                         
<?php	
                    $db->select("pedido_det
                        INNER JOIN matrix ON matrix.id_matrix = pedido_det.id_producto","pedido_det.id_pedido_det,
                        pedido_det.id_pedido,
                        pedido_det.id_producto,
                        pedido_det.cantidad,
                        precio_pedido_det,
                        matrix.id_matrix,
                        img_matrix,
                        id_talla,
                        matrix.descripcion_matrix,
                        matrix.nombre_matrix,
                        matrix.referencia_matrix"," WHERE
            pedido_det.id_pedido = '" . $_GET['id_pedido'] . "'");
                    $loop=0;
                    $num_total_registros = $db->num_rows();

$cpadre = array();
    while ($arraypadre = $db->fetch_array()) {
    $cpadre[] = $arraypadre; 
    }
foreach ($cpadre as $row) { 
?>
                            
								<tr>
									<td valign="top"><a href="#" title="<?php echo $row['nombre_matrix']?>" class="txt_ingresar">
								    <?php echo $row['nombre_matrix']?></a></td>
                                    <td valign="top"><?php echo mostrar_nombre_tipo($row['id_talla']); ?></a></td>
							        <td valign="top"><?php echo $row['cantidad'];?></a></td>
							        <td valign="top"><?php echo number_format($row['precio_pedido_det']); ?></a></td>
							        <td valign="top"><?php echo number_format($row['precio_pedido_det']*$row['cantidad'])?></a></td>
								</tr>
                               <?php  }?>
							</tbody>
					  </table>

						
				  </div> 
                  
                  
		
				  <!-- End>
				  <!-- End #tab1 -->
					
				      
					
				</div> <!-- End .content-box-content -->
				
			</div>  
            <br />
            <br />
            <div class="content-box"><!-- Start Content Box -->
				<div class="content-box-header">
					<h3 class="titu_secc">
                     <a href="#" title="title" class="txt_verde">DATOS USUARIO</a></h3>
				  <div class="clear"></div>	
				</div> <!-- End .content-box-header -->
				<div class="content-box-content">
           <?php
                $db->select("pedido","*"," where id_pedido='{$_GET['id_pedido']}'");
$row1 = $db->fetch_assoc();
           ?>     
                <table >

		<tbody>

        <tr>

         <td width="196" height="34"><div  style="padding:5px; text-align:right;">
         <?php echo variables(1, 1, 4);   ?>
         :</div></td>

        <td width="304"><?php echo $row1['nombre_registrado']; ?></td>

        </tr>

        <tr>

         <td><div  style="padding:5px; text-align:right;"><?php echo variables(14, 1, 30);   ?>:</div></td>

        <td><?php echo $row1['apellido_registrado']; ?></td>

        </tr>

        <tr>

         <td><div  style="padding:5px; text-align:right;"><?php echo variables(3, 1, 4);   ?>:</div></td>

        <td><?php echo $row1['correo_registrado']; ?></td>

        </tr>

          <tr>

         <td><div  style="padding:5px; text-align:right;"><?php echo variables(17, 1, 30);   ?>:</div></td>

        <td><?php echo $row1['telefono_registrado']; ?></td>

        </tr> 

          <tr>

         <td><div  style="padding:5px; text-align:right;"><?php echo variables(18, 1, 30);   ?>:</div></td>

        <td><?php echo  $row1['celular_registrado'] ?></td>  

        </tbody>

        </table>
                
                </div>
            </div>
            <br />
            <br />
            <div class="content-box"><!-- Start Content Box -->
				<div class="content-box-header">
					<h3 class="titu_secc">
                     <a href="#" title="title" class="txt_verde">DATOS PEDIDO</a></h3>
				  <div class="clear"></div>	
				</div> <!-- End .content-box-header -->
				<div class="content-box-content">
<?php
                   
                    $db->select("pedido","*","where id_pedido='{$_GET['id_pedido']}'");
$rowdt = $db->fetch_assoc();

?>                
<table>


    <tbody>

        <tr>

         <td width="196" height="34"><div  style="padding:5px; text-align:right;"><?php echo variables(13, 1, 30); ?>:</div></td>

        <td width="304"><?php echo $rowdt['persona']; ?></td>

        </tr>

        <tr>

         <td><div  style="padding:5px; text-align:right;"><?php echo variables(15, 1, 30); ?>:</div></td>

        <td><?php echo $rowdt['ciudad']; ?></td>

        </tr>

        <tr>

         <td><div  style="padding:5px; text-align:right;"><?php echo variables(16, 1, 30); ?>:</div></td>

        <td><?php echo $rowdt['direccion']; ?></td>

        </tr>

          <tr>

         <td><div  style="padding:5px; text-align:right;"><?php echo variables(17, 1, 30); ?>:</div></td>

        <td><?php echo $rowdt['telefono']; ?></td>

        </tr>

        

        <tr>

         <td><div  style="padding:5px; text-align:right;"><?php echo variables(18, 1, 30); ?>:</div></td>

        <td><?php echo $rowdt['celular']; ?></td>  

        </tr>
        
        
        <tr>

         <td><div  style="padding:5px; text-align:right;">ESTADO:</div></td>

        <td>
        
        <form name="frm_cambiar_estado" action="" method="post" id="">
        
        <select name="estado">
        
        <?php 
      
          $cpadre = array();
$db->select("estado_pedido","*");
/*$db->last_query();*/
    while ($arraypadre = $db->fetch_array()) {
    $cpadre[] = $arraypadre; 
    }
foreach ($cpadre as $rowss) { 
            ?>
                    <option <?php if($rowss['idestado_pedido']==$rowdt['estado_pedido']){?>selected=""<?php } ?> value="<?php echo $rowss['idestado_pedido']; ?>"><?php echo $rowss['estado_pedido']; ?></option>
            <?php
            
        }        
         ?>      
        </select>
        <input type="hidden" value="<?php echo $_GET['id_pedido']; ?>" name="idp" />
        <input type="submit" name="cambiar_estado" value="CAMBIAR ESTADO" />
        
        </form>
        
        </td>  

        </tr>
        
        </tbody>

        </table>
                </div>
            </div>
             <!-- fin lista -->                      
                <?php } ?>
                
                
                
 <!-- inicio lista -->  
<div class="clear"></div> <!-- End .clear -->
<div class="content-box"><!-- Start Content Box -->
				
				<div class="content-box-header">
				  
					
					<h3 class="titu_secc">
                     <a href="#" title="title" class="txt_verde"><?php echo $modulo ?></a>   </h3>
					
				
					
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
            </a></td>
<td valign="top"><a href="#" title="title" class="txt_verde">
  Persona que Recibe
  </a></td>
<td valign="top"><a href="#" title="title" class="txt_verde">
  <?php $valor=variable(83,2); echo $valor[0]; ?>
  </a></td>
<td valign="top"><a href="#" title="title" class="txt_verde">
  Telefono
  </a></td>
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
			

$db->select("pedido
INNER JOIN registrado ON registrado.id_registrado = pedido.idCliente","registrado.nombre_registrado,
registrado.apellido_registrado,
registrado.id_registrado,
registrado.direccion_registrado,
registrado.correo_registrado,
registrado.telefono_registrado,
pedido.id_pedido,
pedido.idCliente,
pedido.tipo_pago,
pedido.total,
pedido.estado_pedido,
pedido.fecha_pedido,
pedido.persona,
pedido.ciudad,
pedido.direccion,
pedido.telefono,
pedido.celular,
pedido.flete,
pedido.subtotal,
pedido.empresa,
pedido.numeroguia,
pedido.comentario","order by fecha_pedido asc");

$num_total_registros = $db->num_rows(); 
//calculo el total de p&aacute;ginas 
$total_paginas = ceil($num_total_registros / $TAMANO_PAGINA);
                  
                    $db->select("pedido
INNER JOIN registrado ON registrado.id_registrado = pedido.idCliente","registrado.nombre_registrado,
registrado.apellido_registrado,
registrado.id_registrado,
registrado.direccion_registrado,
registrado.correo_registrado,
registrado.telefono_registrado,
pedido.id_pedido,
pedido.idCliente,
pedido.tipo_pago,
pedido.total,
pedido.estado_pedido,
pedido.fecha_pedido,
pedido.persona,
pedido.ciudad,
pedido.direccion,
pedido.telefono,
pedido.celular,
pedido.flete,
pedido.subtotal,
pedido.empresa,
pedido.numeroguia,
pedido.comentario","order by fecha_pedido asc". " limit " . $inicio . "," . $TAMANO_PAGINA); 
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
							        <td valign="top"><a href="#" title="<?php echo $row['persona']?>" class="txt_ingresar"><?php echo $row['persona']?></a></td>
							        <td valign="top"><a href="#" title="<?php echo $row['correo_registrado']?>" class="txt_ingresar"><?php echo $row['correo_registrado']?></a></td>
							        <td valign="top"><a href="#" title="<?php echo $row['telefono_registrado']?>" class="txt_ingresar"><?php echo $row['telefono_registrado']?></a></td>
						          <td>
										<!-- Icons -->
										 <a class=Ntooltip href="<?= $_SERVER['PHP_SELF']?>?id_pedido=<?= $row['id_pedido']?>&amp;op=4&idr=<?php echo $idr ?>" title="Edit"><img src="imgs/tag.png" alt="Ver Pedido" />
<span>
Ver Pedido
</span>                                         </a>
<a class=Ntooltip href="javascript:deletex('<?= $row['id_pedido']?>')" title="Delete"><img src="imgs/cross.png" alt="Delete" /><span>
<?php $valor=variable(1,2); echo $valor[0]; ?>  
</span></a>																		</td>
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

