<?php include('../lib/funciones.php'); ?>
<?php include('include_mysqli.php'); ?>
<?php
if(isset($_GET['id_tipo'])&&  is_numeric($_GET['id_tipo']) &&$_GET['id_tipo']!=""){
$condicion_principal .= " where comentario.id_tipo={$_GET['id_tipo']}";
}

$id=$_GET['id'];
$idr=$_GET['idr'];
$principal=$_GET['principal'];
$op=$_GET['op'];
$t1="comentario"; 
$modulo=" Comentarios ";

//fin identificacion de modulo tipos
if ($op=="1") { 
$sql = "UPDATE comentario set estado_comentario='1'";
$sql = $sql . " where id_comentario='" . sql_seguro($_GET['id']) . "'";

  $updatecontenido = $db->prepare($sql);
  $updatecontenido->execute();
  $updatecontenido->close();
?>
<script>window.location="<?= $_SERVER['PHP_SELF']?>?msg=2&idr=<?php echo $idr ?>&id_tipo=<?php echo $_GET['id_tipo']?>";</script>
<?php 
exit;
}?>

<?php if ($op=="2") { 
$sql = "UPDATE $t1 set estado_comentario=2";
$sql = $sql . " where id_comentario= '" . sql_seguro($_GET['id']) . "'";

  $updatecontenido = $db->prepare($sql);
  $updatecontenido->execute();
  $updatecontenido->close();

?>
	<script>window.location="<?= $_SERVER['PHP_SELF']?>?msg=1&idr=<?php echo $idr ?>&id_tipo=<?php echo $_GET['id_tipo']?>";</script>
<?php }?>
<?php if ($op=="3") { 
    $db->delete($t1,"where id_comentario='" . $_GET['idb'] . "'");
?>
   
    <script>window.location="<?= $_SERVER['PHP_SELF']?>?op=4&msg=3&idr=<?php echo $idr ?>&id_tipo=<?php echo $_GET['id_tipo']?>";</script>

<?php
exit;
 }
?>
<?php if ($op=="7") { 
$sql = "UPDATE $t1 set estado_comentario=1";
$sql = $sql . ", comentario= '" . sql_seguro($_POST['comentario']) . "'";
$sql = $sql . " where id_comentario= '" . sql_seguro($_POST['id']) . "'";

  $updatecontenido = $db->prepare($sql);
  $updatecontenido->execute();
  $updatecontenido->close();

?>
	<script>window.location="<?= $_SERVER['PHP_SELF']?>?msg=1&idr=<?php echo $idr ?>&id_tipo=<?php echo $_GET['id_tipo']?>";</script>
<?php }?>
<?php if ($id<>""  ) { $op=1; } else { $op=2;}?>
    <div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
        <?php include('header.php'); ?>
<?php include('menu_izq.php'); ?>
		
		<div id="main-content"> <!-- Main Content Section with everything -->
			
			<div id="miga">
              <noscript><!-- Show a notification if the user has disabled javascript -->
                    <div class="notification error png_bg">
                    <div><?php $valor=variable(22,2); echo $valor[1]; ?></div>
              </noscript>
<?php if ($msg<>"") {
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
<p class="punteado">
    <strong><?php $valor=variable(8,2); echo $valor[0]; ?>  <?php echo $_SESSION['nombre_usuario'] ?></strong></p>
	<div class="miga">
            <a href="#"><?php $valor=variable(9,2); echo $valor[0]; ?></a>  <a href="#" class="flecha_miga"><?php echo $modulo ?></a> <a href="<?= $_SERVER['PHP_SELF']?>?idr=<?php echo $idr ?>" class="flecha_miga"><?php $valor=variable(3,2); echo $valor[0]; ?> <?php echo $modulo ?></a>
            <div class="clear"></div>
            <h2>
                <?php if($id){$valor=variable(2,2); echo $valor[0];} else{$valor=variable(3,2); echo $valor[0];}?> 
                <span class="urgente"><?php echo $modulo ?></span>
            </h2>
         </div>
<div class="clear"></div>
             <div class="notification attention png_bg">
				<a href="#" class="close"><img src="imgs/cross_grey_small.png" title="Close this notification" alt="close" /></a>
				<div>Administracion de comentarios</div>
            </div>
              </div>
		  <div class="clear"></div> <!-- End .clear -->
			<div class="content-box"><!-- Start Content Box -->
				<div class="content-box-header">
					<h3><img src="imgs/comment_48.png" width="25" height="25" /><?php echo $modulo ?></h3>
					<div class="clear"></div>
				</div> <!-- End .content-box-header -->
                                    <?php  if ($_GET['id']<>''){ ?>
                                    <?php 
                                    $db->select("comentario","*","where id_comentario='".$_GET['id']."'"); 
                                    $rowm = $db->fetch_assoc();
                                    ?>
                                <form action="<?= $_SERVER['PHP_SELF']?>?op=7&amp;idr=<?= $idr ?>&id_tipo=<?php echo $_GET['id_tipo']?>" method="post" enctype="multipart/form-data" name="usuarios" id="usuarios">
                                  <fieldset>
                                   <div style="width:650px;">
                                      <p>
                                        <textarea name="comentario" id="comentario"  cols="90" rows="5"><?= $rowm['comentario']?> </textarea>
                                       <?php wysiwyg("comentario","full")?>
                                        <script language="javascript">
                                            CKEDITOR.replace('comentario', { filebrowserBrowseUrl: 'simogeo/index.html' });
                                       </script>
                                      </p>
                                    </div>
                                    <p>
                                      <input class="button" type="submit" value="<?php if($id){$valor=variable(2,2); echo $valor[0];} else{$valor=variable(3,2); echo $valor[0];}?> <?php echo $modulo ?>" />
                                      <input name="id" type="hidden" id="id" value="<?= $rowm["id_comentario"]?>" />
                                      <input name="idr" type="hidden" id="idr" value="<?= $idr ?>" />
                                    </p>
                                  </fieldset>
                                  <!-- End .clear -->
                                </form>
<?php } ?>
<div class="content-box-content">
<div class="content-box"><!-- Start Content Box -->
<div class="content-box-header">
    <h3 class="titu_secc"><a href="#" title="<?php echo $modulo ?>" class="txt_verde"><?php echo $modulo ?></a></h3>
    <div class="clear"></div>
</div> <!-- End .content-box-header -->
<div class="content-box-content">
    <div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
        <table>
            <tfoot>
                <tr>
                    <td colspan="5">&nbsp;</td>
                </tr>
            </tfoot>
            <tbody>
   <tr>
<td valign="top" class="txt_verde"><a href="#" title="title" class="txt_verde">Comentario <?php echo $miga ?>   <?php echo $modulo ?></a></td>
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
			
$db->select($t1,"*","$condicion_principal order by estado_comentario asc");
$num_total_registros = $db->num_rows();
//calculo el total de p&aacute;ginas 
$total_paginas = ceil($num_total_registros / $TAMANO_PAGINA); 

$db->select($t1,"*","$condicion_principal order by estado_comentario asc". " limit " . $inicio . "," . $TAMANO_PAGINA);

$cpadre = array();
//echo $sql;
$loop=0;

	/*$db->last_query();*/
    while ($arraypadre = $db->fetch_array()) {
		$cpadre[] = $arraypadre; 
    }
foreach ($cpadre as $row) { 
?>
                            
    <tr>
	<td valign="top">
            <a href="#" title="<?= $row['comentario']?>" ><?= $row['comentario']?> (
								    

              <?php  if($row['estado_comentario']==0){echo "Por Aprobar";} elseif($row['estado_comentario']==1){echo "Activo";} else{echo "pendiente";} ?> -   
              <?php
                 $db->select("registrado","nombre_registrado"," where id_registrado='".$row['id_maestra']."'");
                 $rowt = $db->fetch_assoc();
               ?>
              <?php echo $rowt['nombre_registrado']; ?>)
            </a>
        </td>
<td>
										<!-- Icons -->
<a class=Ntooltip href="<?= $_SERVER['PHP_SELF']?>?id=<?= $row['id_comentario']?>&id_tipo=<?php echo $_GET['id_tipo']?>" title="Edit">*Editar<span>
Editar este Comentario
</span>  </a><?php  if ($row['estado_comentario']==2 or $row['estado_comentario']==0 ){ ?><a class=Ntooltip href="<?= $_SERVER['PHP_SELF']?>?id=<?= $row['id_comentario']?>&amp;op=1&id_tipo=<?php echo $_GET['id_tipo']?>" title="Edit">*Activar<span>
<?php $valor=variable(2,2); echo $valor[0]; ?> <?= $modulo; ?>
</span>                                         </a> <?php } else { ?>  
<a class=Ntooltip href="<?= $_SERVER['PHP_SELF']?>?id=<?= $row['id_comentario']?>&amp;op=2&id_tipo=<?php echo $_GET['id_tipo']?>" title="Edit">*Inactivar<span>
<?php $valor=variable(2,2); echo $valor[0]; ?> <?= $modulo; ?>
</span>                                         </a> 

<?php }?>
<a class=Ntooltip href="javascript:deletex('<?= $row['id_comentario']?>')" title="Delete"><img src="imgs/cross.png" alt="Delete" /><span>
<?php $valor=variable(1,2); echo $valor[0]; ?><?= $modulo; ?>
</span></a></td>
								</tr>
                               <?php  }?>
							</tbody>
						</table>
<div class="pagination">
											
	<?php if (($total_paginas > 1)){ ?>
       
          <?php if ($pagina!=1){?>
          <a href='<?= $_SERVER['PHP_SELF']?>?pg=<?= ($pagina-1)?>&idr=<?php echo $idr ?>&id_tipo=<?php echo $_GET['id_tipo']?>' title="Previous Page"><?php $valor=variable(12,2); echo $valor[0]; ?></a>
          <?php }?>
      
    
    <?php for ($i=1;$i<=$total_paginas;$i++){ 

if ($pagina == $i) {?>
        
       <a href='#' class="number current" title="<?= $pagina?>"> <?= $pagina?></a>
        
        <?php } else {?>
        <a href='<?= $_SERVER['PHP_SELF']?>?pg=<?php echo $i?>&idr=<?php echo $idr ?>&id_tipo=<?php echo $_GET['id_tipo']?>' class="number" title="<?= $i ?>"><?= $i?></a>
        <?php } ?>
        <?php } ?>
      <?php if ($total_paginas!=$pagina){ ?>
      <a href='<?= $_SERVER['PHP_SELF']?>?pg=<?= ($pagina+1)?>&idr=<?php echo $idr ?>&id_tipo=<?php echo $_GET['id_tipo']?>' title="<?php $valor=variable(13,2); echo $valor[0]; ?>"><?php $valor=variable(13,2); echo $valor[0]; ?></a>
      <?php } ?>
      <?php } ?>
    </div>
</div> 
<form name="form" id="form">
  <?php $valor=variable(15,2); echo $valor[0]; ?>:
    <select name="jumpMenu" id="jumpMenu" onChange="MM_jumpMenu('parent',this,0)">
   <option value=""><?php $valor=variable(27,2); echo $valor[0]; ?></option>
   <?php 

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

<?php }?>

  </select>
</form>
        </div> <!-- End .content-box-content -->

        </div>  
    </div> 

    </div> <!-- End .content-box --><!-- End .content-box --><!-- End .content-box --><!-- Start Notifications --><!-- End Notifications -->
<script language="javascript">
    function deletex(id){
            if(confirm("<?php $valor=variable(43,2); echo $valor[0]; ?>")) {
                    window.location="<?= $_SERVER['PHP_SELF']?>?id_tipo=<?php echo $_GET['id_tipo']?>&op=3&idr=<?php echo $idr ?>&idb=" + id;
            }
    }
    </script>
    <!-- End #main-content -->
        <?php include('pie.php'); ?>
    </div> 
   
	</div>
    </body>
</html>