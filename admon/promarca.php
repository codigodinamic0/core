<? include('include_mysqli.php'); ?> 
<? 
$id=$_GET['id'];
$idr=$_GET['idr'];
$op=$_GET['op'];
$t1="promarca";
$en="marca";
if ($op=="1"  ) { 


if ($_FILES['img1']['name'] != "") {
	$aux = explode(".",$_FILES['img1']['name']);
	$nombre_archivo=$_POST['id'] . "." . $aux[count($aux)-1];
	copy ($_FILES['img1']['tmp_name'], "../imagenes/".$en."/l" . $nombre_archivo ) ;
	
	include_once('thumbnail.inc.php');
	

	$thumb = new Thumbnail("../imagenes/".$en."/l" . $nombre_archivo);
	if($thumb->getCurrentHeight() > 95) {
    $thumb->resize(0,95);
	//$thumb->crop(0,0,$anchos,$altos);
	$thumb->save("../imagenes/".$en."/l" . $nombre_archivo);
	$thumb->destruct();
	
		}
		$thumb = new Thumbnail("../imagenes/".$en."/l" . $nombre_archivo);
	if($thumb->getCurrentWidth() > 187) {
    $thumb->resize(187,0);
	//$thumb->crop(0,0,350,252);
	$thumb->save("../imagenes/".$en."/l". $nombre_archivo);
	$thumb->destruct();
	
		}
	
	$sql = "UPDATE $t1 set logo_marca='" . $nombre_archivo . "' where id_marca='" . $_POST['id'] . "'";
	//echo $sql;

    $updatecontenido = $db->prepare($sql);
  $updatecontenido->execute();
  $updatecontenido->close();
}

$sql = "UPDATE $t1 set nombre_marca='" . $_POST['nombre_marca'] . "'";
$sql = $sql . ", tipo= '" .  $_POST['tipo']. "'";
$sql = $sql . ", descripcion_marca= '" . (str_replace(chr(39),chr(34), $_POST['descripcion_marca'])) . "'";
$sql = $sql . " where id_marca= '" . $_POST['id'] . "'";
//echo $sql;

  $updatecontenido = $db->prepare($sql);
  $updatecontenido->execute();
  $updatecontenido->close();
		
	?>
    
<script>window.location="<?= $_SERVER['PHP_SELF']?>?op=4&msg=1&idr=<?php echo $idr ?>&id=<?php echo $_POST['id'] ?>";</script>

<? } ?>


<? if ($op=="2") { 
	$sql = "INSERT INTO $t1 (nombre_marca, tipo, descripcion_marca) values ";
$sql = $sql . " ('" . $_POST['nombre_marca'] . "'";
$sql = $sql . " ,'" . $_POST['tipo'] . "'";
$sql = $sql . " ,'" . (str_replace(chr(39),chr(34), $_POST['descripcion_marca'])) . "')";
//echo $sql;

  $insertmatrix = $db->prepare($sql);
  $insertmatrix->execute();
  $id_generado = $insertmatrix->insert_id;
  $insertmatrix->close();


if ($_FILES['img1']['name'] != "") {	
	$aux = explode(".",$_FILES['img1']['name']);
	$nombre_archivo=$id_generado . "." . $aux[1];	
	copy ($_FILES['img1']['tmp_name'], "../imagenes/".$en."/l" . $nombre_archivo ) ;
	
include_once('thumbnail.inc.php');
	

	$thumb = new Thumbnail("../imagenes/".$en."/l" . $nombre_archivo);
	if($thumb->getCurrentHeight() > 95) {
    $thumb->resize(0,95);
	//$thumb->crop(0,0,$anchos,$altos);
	$thumb->save("../imagenes/".$en."/l" . $nombre_archivo);
	$thumb->destruct();
		}
		$thumb = new Thumbnail("../imagenes/".$en."/l" . $nombre_archivo);
	if($thumb->getCurrentWidth() > 187) {
    $thumb->resize(187,0);
	//$thumb->crop(0,0,350,252);
	$thumb->save("../imagenes/".$en."/l". $nombre_archivo);
	$thumb->destruct();
	
		}
	$sql = "UPDATE $t1 set logo_marca='" . $nombre_archivo . "' where id_marca='" . $id_generado . "'";
	//echo $sql;

    $updatecontenido = $db->prepare($sql);
  $updatecontenido->execute();
  $updatecontenido->close();
}


	?>
    
<script>window.location="<?= $_SERVER['PHP_SELF']?>?op=4&msg=2&idr=<?php echo $idr ?>";</script>

<? }?>


<? if ($op=="3") { 

 $db->select($t1,"img_marca, logo_marca","where id_marca='" . $_GET['idb'] . "'");
$row = $db->fetch_assoc();

$nombre_archivo=$row['img_marca'];
$nombre_archivo1=$row['logo_marca'];

echo "Foto: " . $nombre_archivo;
echo "Foto: " . $nombre_archivo1;

if ($nombre_archivo!="" or $nombre_archivo1!="") {
	unlink("../imagenes/marca/" . $nombre_archivo );
	unlink("../imagenes/marca/l" . $nombre_archivo1 );
}

$db->delete($t1,"where id_marca='" . $_GET['idb'] . "'");
?>
   
<script>window.location="<?= $_SERVER['PHP_SELF']?>?op=&msg=3&idr=<?php echo $idr ?>";</script>

<? }?>
<? if ($id<>""  ) { $op=1; } else { $op=2;}?>

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
                      <p class="titulos"> <img src="otros/iconos/PieChart.png" width="64" height="64" />Bienvenido
                        <?php echo $_SESSION['nombre_usuario']; ?>
                      </p>
                     
                        <p><span class="rojos">
                          <?
$msg="";
if (isset($_GET["msg"])) {
$msg=$_GET["msg"];
}
if ($msg=="1") {
	$msg="Actualización Correcta";
} 
if ($msg=="2") {
	$msg="Ingreso correcto";
} 
if ($msg=="3") {
	$msg="Eliminacion Correcta";
} 

if ($msg=="4") {
	$msg="Administracion de contenidos";
}
?><?php echo $msg ?></span></p>
                        <table width="100%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#EBEBEB" class="tabla">
                          <tr>
                            <th width="255" class="titulos-bases">Titulo marca</th>
                            <th width="254" class="titulos-bases">logo</th>
                            <th colspan="2" class="titulos-bases">Opciones</th>
                            </tr>
                          <?

    $cpadre = array();
$db->select($t1,"*","order by tipo");
/*$db->last_query();*/
    while ($arraypadre = $db->fetch_array()) {
    $cpadre[] = $arraypadre; 
    }
foreach ($cpadre as $row) { 
    ?>
                          <tr onMouseOver="javascript:style.backgroundColor='#F3FBEC'" onMouseOut="javascript:style.backgroundColor=''" >
                            <td align="left" class="vinculo_dos"><img src="otros/pequenos/action_forward.gif" width="16" height="16" />
                              <?= $row['nombre_marca']?>
                              <span class="rojos">
                              <?php 	if ($row['tipo']==1){
echo 'Marca';
	
	}
	else {
echo 'Cliente';
		}  
              ?></span></td>
                            <td width="254" valign="top" class="textos_bases"><?php if($row['logo_marca'] <> ""){ ?>
                              <img src="../imagenes/marca/l<?= $row['logo_marca']?>" />
                              
                                              
                              <?php } ?></td>
                            <td width="82" align="center" valign="middle" class="textos_bases"><div align="left"><a href="<?= $_SERVER['PHP_SELF']?>?id=<?= $row["id_marca"] ?>&amp;op=4&idr=<?= $idr ?>" class="campos_style"><img src="otros/pequenos/action_refresh_blue.gif" width="16" height="16" border="0" />Editar </a></div></td>
                            <td width="102" align="center" valign="middle" class="textos_bases"><div align="center"><a href="javascript:deletex('<?= $row['id_marca']?>')" class="campos_style"><img src="otros/pequenos/action_stop.gif" width="16" height="16" border="0" />Eliminar </a></div></td>
                            </tr>
                          <? }?>
                        </table>
                        
                         <hr>
                         <form action="<?= $_SERVER['PHP_SELF']?>?op=<?php echo $op ?>&idr=<?= $idr ?>" method="post" enctype="multipart/form-data" name="form1" id="form1" onSubmit="return formValidation();">
                           <div align="center" class="txt_titulo_vinculo"><img src="otros/iconos/Download.png" width="64" height="64" />marcas 
                             <?
$db->select($t1,"*","where id_marca='" . $_GET['id'] . "'");
$row = $db->fetch_assoc();
?>
                           </div>
                           <table width="100%" border="2" cellpadding="0" cellspacing="0" bordercolor="#6CA223">
                             <tr>
                               <td align="center" valign="top"><span class="rojos">El logo y la imagen se debe montar a la medida y en transparencia porque seran reflejadas en nuestras marca</span>
<table align="center" cellspacing="5">
  <tr valign="baseline">
                                   <td align="right" nowrap="nowrap" class="campos_style"><div align="right">Titulo del registro:</div></td>
                                   <td width="457" align="left"><input name="nombre_marca" type="text" class="campo" id="nombre_marca" value="<?= $row["nombre_marca"]?>" size="32" /></td>
                                   </tr>
                                 <tr valign="baseline">
                                   <td align="right" nowrap="nowrap" class="titulos-bases"><div align="right">
                                     <?php if($row['logo_marca'] <> ""){ ?>
                                     <img src="../imagenes/marca/l<?= $row['logo_marca']?>" />
                                     <?php } ?>
                                     Imagen:</div></td>
                                   <td><div align="left" class="celda">
                                     <input name="img1" type="file" class="campo" id="img1" />
                                     <br />
                                     <span class="txt_titulo_vinculo">imagen del logo a 120 de alto minimo</span></div></td>
                                 </tr>
                                 <tr valign="baseline">
                                   <td colspan="2" align="center" nowrap="nowrap" class="texto"><div >
                                     <span class="rojos">Descripcion Marca</span><br />
                                     <textarea name="descripcion_marca" cols="70" rows="15" class="campo" id="descripcion_marca"><?= $row["descripcion_marca"]?>
                                     </textarea>
                                     </div></td>
                                 </tr>
                                 </table>
                                 <p>
                                   <input name="submit" type="submit" class="rojos" value="Enviar informaci&oacute;n" />
                                   <input name="idr" type="hidden" id="idr" value="<?php echo $idr ?>" />
                                   <input name="id" type="hidden" id="id" value="<?= $row["id_marca"]?>" />
                                   </p></td>
                               </tr>
                             </table>
                           
                         </form>
                          <div align="left"></div>
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

<script language="javascript">
function deletex(id){
	if(confirm("Esta seguro de eliminar el registro?")) {
		window.location="<?= $_SERVER['PHP_SELF']?>?idr=<?php echo $idr ?>&op=3&idb=" + id;
	}
}
    </script>
</body>
</html>
