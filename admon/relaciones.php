<?

require_once('../Connections/database.php');
$id = $_GET["id"];
$op = $_GET["op"];
session_start(); 
if (!isset($_SESSION["id_usuario"])) {?><script>window.location="logueo.php?msg=1"</script> <? }
 if ($op=="2") { 
	$sql = "INSERT INTO propro (de, con) values ";
    $sql = $sql . " ('" . $_POST['de'] . "'";
    $sql = $sql . " ,'" . $_POST['con'] . "')";

  $insertmatrix = $db->prepare($sql);
  $insertmatrix->execute();
  $id_generado = $insertmatrix->insert_id;
  $insertmatrix->close();
	?>
    
<script>window.location="<?= $_SERVER['PHP_SELF']?>?op=4&msg=2&id=<?php echo $_POST['de'] ?>";</script>

<? }?>


<? if ($op=="3") { 

$db->delete("propro","propro='" . $_GET['idb'] . "'");
?>
   
<script>window.location="<?= $_SERVER['PHP_SELF']?>?op=&msg=3&id=<?php echo $id ?>";</script>

<? }?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Panel Administrativo</title>
<link href="css/admin_style.css" rel="stylesheet" type="text/css" />


<style type="text/css">
	#sortable { list-style-type: none; margin: 0; padding: 0; }
	#sortable li {
	float: left;
	margin: 4px;
	padding: 1px;
	width:auto;
	height:auto;
	verflow:hidden;
	cursor:move;
	}
	#tabs{background:none; border:none;}
.clear { clear:both; }
	
	</style>
<table width="895" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="11" background="images/sombra_izq.png">&nbsp;</td>
        <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="438"><img src="images/logo_panel_admin.jpg" width="438" height="91" /></td>
                <td>&nbsp;</td>
                <td width="158"><a href="<?php echo $matriz_url ?>" target="_blank"><img src="images/logo_empresa.jpg" width="158" height="91" border="0" /></a></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td height="35" background="images/dina_menu.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td>&nbsp;</td>
                <td width="90"><a href="close.php"><img src="images/btn_cerrar.jpg" width="90" height="22" border="0" /></a></td>
                <td width="10">&nbsp;</td>
                <td width="90"><a href="panel.php"><img src="images/btn_inicio.jpg" width="90" height="22" border="0" /></a></td>
                <td width="10">&nbsp;</td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td><table width="100%" border="0" cellspacing="10" cellpadding="0">
              <tr>
                <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="140" valign="top"><table width="140" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td><img src="images/menu_sup.jpg" width="140" height="28" /></td>
                      </tr>
                      <tr>
                        <td background="images/menu_bkg.jpg"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                            <!-- INICIO PLANTILLA-->
                            <?
    $cpadre = array();
$db->select("menu","*","order by menu.nombre");
/*$db->last_query();*/
    while ($arraypadre = $db->fetch_array()) {
    $cpadre[] = $arraypadre; 
    }
foreach ($cpadre as $row) { 
  ?>
                            <tr>
                              <td height="10" valign="top" class="texto"><table width="100%" border="0" cellspacing="5" cellpadding="0">
                                  <tr>
                                    <td bgcolor="#F5F5F5" class="menu_style"><a href="javascript:disp<?= $row['id']?>()">
                                      <?= $row['nombre']; ?>
                                    </a></td>
                                  </tr>
                              </table></td>
                            </tr>
                            <script language="JavaScript" type="text/javascript">
			function disp<?= $row['id']?>()
			{
				if(document.getElementById("disp<?= $row['id']?>").style.display == "none")
					document.getElementById("disp<?= $row['id']?>").style.display = "";
				else
					document.getElementById("disp<?= $row['id']?>").style.display = "none";
			}
			        </script>
                            <tr>
                              <td valign="top"><div id="disp<?= $row['id']?>" style="display:none">
                                  <?
                          $cpadre = array();
$db->select("menu_r","*","where menu_r.idr='".$row['id']."'  order by menu_r.nombre_l");
/*$db->last_query();*/
    while ($arraypadre = $db->fetch_array()) {
    $cpadre[] = $arraypadre; 
    }
foreach ($cpadre as $row2) { 
  ?>
                                  <table width="100%" border="0" cellpadding="0" cellspacing="2">
                                    <tr>
                                      <td width="5" bgcolor="#FFFFFF" ><img src="images/menu_task.jpg" width="11" height="11" /></td>
                                      <td ><span class="campos_style"> <a href="<?= $row2['url']?>">
                                        <?= $row2['nombre_l']; ?>
                                      </a></span></td>
                                    </tr>
                                  </table>
                                <? //FIN ROW2
					}?>
                              </div></td>
                            </tr>
                            <? //FIN ROW
		    }?>
                        </table></td>
                      </tr>
                      <tr>
                        <td background="images/menu_bkg.jpg">&nbsp;</td>
                      </tr>
                      <tr>
                        <td><img src="images/menu_inf.jpg" width="140" height="28" /></td>
                      </tr>
                    </table></td>
                    <td width="10" valign="top">&nbsp;</td>
                    <td align="left" valign="top"><div align="center" class="campos_style">
                      <p class="titulos"> <img src="otros/iconos/125.png" width="64" height="64" />Bienvenido
                        <?=  $_SESSION['nombre_usuario'];?>
                      </p>
                      <p class="rojos"><br />
                          Administraci&oacute;n de Relaci&oacute;n de imagenes</p>
                      <table border="0" align="center" cellpadding="2" cellspacing="2">
                        <tr>
                          <td><span class="titulo_seccion2">MODULO:</span></td>
                          <td><span class="subtitulo2">
                            Relaci&oacute;n de productos
                          </span></td>
                          <td><span class="titulo_seccion2">TITULO:</span></td>
                          <td><span class="subtitulo2">
                            Productos
                          </span></td>
                        </tr>
                      </table>
                      <? 
	
if ($msg=="1") $msg="Insercion correcta";
if ($msg=="2") $msg="Modificacion correcta";
if ($msg=="3") $msg="Eliminacion correcta";
?>
                      <p align="center" class="texto_rojo">
                        <?
$db->select("producto","*","where id_producto='" . $_GET['id'] . "'");
$row = $db->fetch_assoc();

?><span class="rojos"><?= $row['nombre_producto']?></span>
                        <span class="textos_bases">
                        <?php if($row['img_producto'] <> ""){ ?>
                        <img src="../imagenes/bancop/<?= $row['img_producto']?>" width="150" />
                        <?php } ?>
                        </span>
                        <?= $msg?>
                      </p>
                      <form action="<?= $_SERVER['PHP_SELF']?>?op=2" method="post" name="form1" id="form1">
                        <table align="center" cellpadding="3" cellspacing="3" class="borde_imagen">
   <tr valign="baseline">
                            <td align="right" nowrap="nowrap" class="campos_style"><div align="right" class="campos_style">Relacionar con :</div></td>
                            <td><div align="left"><select name="con" class="bkg_style" id="con">
                                <?
echo $sql_banco;
$cpadre = array();
$db->select("producto","*","where id_producto not in (select con from propro where de='".$_GET['id']."' ) and id_producto<>'".$_GET['id']."'");
/*$db->last_query();*/
    while ($arraypadre = $db->fetch_array()) {
    $cpadre[] = $arraypadre; 
    }
foreach ($cpadre as $row_banco) {
?>
                                          <?php if($row["id_producto"] == $row_banco['id_producto']) {?>
                                                            <option value="<?= $row_banco['id_producto']?>" selected="selected">
                                                            <?= $row_banco['nombre_producto']?>
                                                  </option>
                                          <?php 	} else {?>
                                                            <option value="<?= $row_banco['id_producto']?>">
                                                            <?= $row_banco['nombre_producto']?>
                                                  </option>
                                          <?php 	}?>
                                          <? }?>
                              </select></div></td>
                          </tr>                       <tr>
                            <td class="tabla"><div id="fileQueue">
                              <input name="de" type="hidden" id="de" value="<?php echo $_GET['id'] ?>" />
                            </div></td>
                            <td><input type="submit" class="botom" value="Relacionar" /></td>
                          </tr>
                        </table>
                        <ul id="sortable">
                          <? 
      $cpadre = array();
$db->select("producto as p, propro as pp","*","WHERE pp.con=p.id_producto and pp.de='" . $_GET['id'] . "' group by p.id_producto");
/*$db->last_query();*/
    while ($arraypadre = $db->fetch_array()) {
    $cpadre[] = $arraypadre; 
    }
foreach ($cpadre as $row) {
  ?>
                          <li class="ui-state-default border_radius" id="id_<?= $row['id_producto']?>">
                            <table width="200" border="0" align="center" cellpadding="0" cellspacing="2" class="tabla2">
                              <tr>
                                <td colspan="2" align="center"><span class="textos_bases"><img src="../imagenes/bancop/<?= $row['img_producto']?>" /></span></td>
                              </tr>
                              <tr>
                                <td align="center" bgcolor="#EFEFEF"><?= $row['nombre_producto']?></td>
                                <td align="center" bgcolor="#EFEFEF"><div class="btn_eliminar"><a href="<?= $_SERVER['PHP_SELF']?>?op=3&idb=<?= $row['propro']?>&id=<?= $_GET['id']?>" title="Eliminar Foto"><img src="../template/ico/Xion.png" width="25" height="25" border="0" /></a></div></td>
                              </tr>
                            </table>
                          </li>
                          <? }?>
                        </ul>
                      </form>
                      <script language="JavaScript" type="text/javascript">




function delete_foto(id){
	if(confirm("Esta seguro de eliminar este foto?")) {
		$.ajax({
			type: "POST",
			url: "<?= $_SERVER['PHP_SELF']?>?action=delete_foto&tabla=producto&id=<?=$id?>&id_foto=" + id,
			success: function(msg){
			   	if(msg==1){$("#id_"+id).fadeOut(function(){guardar_orden();});}
				else{alert("Ha ocurrido un error, comuniquese con el administrador");}
			}
		 });
	}
}


                      </script>
                    
                      <div align="left"></div>
<p class="rojos">&nbsp;</p>
                      <div align="left"></div>
                      <div align="left">
                        <div align="left">
                          <div class="clear"></div>
                          <p>
                            <?
                      $cpadre = array();
                      $db->select("linea","*","order by id_linea asc");
                      /*$db->last_query();*/
                          while ($arraypadre = $db->fetch_array()) {
                          $cpadre[] = $arraypadre; 
                          }
                      foreach ($cpadre as $row) {
                      ?>
                          </p>
                          <table width="100%" border="0" cellpadding="0" cellspacing="5" bordercolor="#0066CC">
                            <tr>
                              <td width="52%" bgcolor="#F0F0F0"><span class="rojos"><img src="otros/pequenos/action_go.gif" width="16" height="16" border="0" />
                                <?= $row['nombre_linea']?>
                              </span></td>
                            </tr>
                        </table>
                          <br />
                          <?
                      $cpadre = array();
$db->select("sublinea","*","where id_linea='".$row['id_linea']."' order  by nombre_sublinea asc  ");
/*$db->last_query();*/
    while ($arraypadre = $db->fetch_array()) {
    $cpadre[] = $arraypadre; 
    }
foreach ($cpadre as $row2) {
  ?>
                        </div>
                        <table width="100%" border="1" cellpadding="0" cellspacing="2" bordercolor="#CCCCCC" bgcolor="#FBFBFB">
                          <tr>
                            <td width="11" bgcolor="#FFFFFF" ><img src="otros/pequenos/add-comment-red.gif" width="14" height="14" /></td>
                            <td width="460" class="campos_style" ><div align="left"> <span class="rojos">
                              <?= $row2['nombre_sublinea']?>
                              </span>
                              <?
     $db->select("producto","count(id_producto) as total_fotos"," where  id_sublinea='".$row2['id_sublinea']."' ");
      $rowconta = $db->fetch_assoc();
    	$resultado=$rowconta["total_fotos"];
?>
                              <span class="titulos">
                                <?= $resultado; ?>
                              </span> productos</div></td>
                            <td width="460" class="campos_style" ><a href="productos.php?idr=<?= $row2['id_sublinea']?>&amp;op=4" class="campos_style"><img src="otros/pequenos/add.gif" width="16" height="16" border="0" />Ingresar Productos a esta categoria</a></td>
                          </tr>
                        </table>
                        <div align="left">
                          <? //FIN ROW2
					}?>
                          <? //FIN ROW2
					}?>
                        </div>
                      </div>
</div></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
        <td width="11" background="images/sombra_der.png">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><img src="images/pie.png" width="895" height="18" /></td>
  </tr>
</table>


</body>
</html>
