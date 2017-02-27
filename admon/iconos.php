<? include('include_mysqli.php'); ?>

 <? 
$anchos=48;
$altos=48;
$t1="icono";
$en="logo";
$id=$_GET['id'];
$idr=$_GET['idr'];
$op=$_GET['op'];
if ($op=="1"  ) { 
if ($_FILES['img_p']['name'] != "") {
	$aux = explode(".",$_FILES['img_p']['name']);
	$nombre_archivo=$_POST['id'] . "." . $aux[count($aux)-1];
	copy ($_FILES['img_p']['tmp_name'], "../imagenes/".$en."/" . $nombre_archivo ) ;
		
	$sql = "UPDATE $t1 set img_icono='" . $nombre_archivo . "' where id_icono='" . $_POST['id'] . "'";
	//echo $sql;

    $updatecontenido = $db->prepare($sql);
  $updatecontenido->execute();
  $updatecontenido->close();
}

$sql = "UPDATE $t1 set nombre_icono='" . $_POST['nombre_icono'] . "'";
$sql = $sql . " where id_icono= '" . $_POST['id'] . "'";
//echo $sql;

  $updatecontenido = $db->prepare($sql);
  $updatecontenido->execute();
  $updatecontenido->close();
	?>
    
	<script>window.location="<?= $_SERVER['PHP_SELF']?>?op=&msg=1&idr=<?php echo $idr ?>";</script>

<? }?>

<? if ($op=="2") { 
	$sql = "INSERT INTO $t1(nombre_icono) values ";
	$sql = $sql . " ('" . $_POST['nombre_icono']  . "')";

	//echo $sql;

    $insertmatrix = $db->prepare($sql);
  $insertmatrix->execute();
  $id_generado = $insertmatrix->insert_id;
  $insertmatrix->close();
if ($_FILES['img_p']['name'] != "") {	
	$aux = explode(".",$_FILES['img_p']['name']);
	$nombre_archivo=$id_generado . "." . $aux[1];	
	copy ($_FILES['img_p']['tmp_name'], "../imagenes/".$en."/" . $nombre_archivo ) ;
	$sql = "UPDATE $t1 set img_icono='" . $nombre_archivo . "' where id_icono='" . $id_generado . "'";
	//echo $sql;

  $updatecontenido = $db->prepare($sql);
  $updatecontenido->execute();
  $updatecontenido->close();
}
	?>
    
	

<? }?>


<? if ($op=="3") { 

$db->select($t1,"img_icono","where id_icono='" . $_GET['idb'] . "'");
$row = $db->fetch_assoc();

$nombre_archivo=$row['img_icono'];

echo "Foto: " . $nombre_archivo;

if ($nombre_archivo!="") {
	unlink("../imagenes/".$en."/" . $nombre_archivo );
}

  $db->delete($t1,"where id_icono='" . $_GET['idb'] . "'");
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
                <td width="90"><a href="estado/close.php" target="_blank"><img src="images/btn_cerrar.jpg" width="90" height="22" border="0" /></a></td>
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
                                    <td align="left" bgcolor="#F5F5F5" class="menu_style"><a href="javascript:disp<?= $row['id']?>()">
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
                                      <td align="left" ><span class="campos_style"> <a href="<?= $row2['url']?>">
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
                      <p class="titulos"> <img src="otros/iconos/Picture.png" width="48" height="48" />Bienvenido
                        <?=  $_SESSION['nombre_usuario'];?>
                      </p>
                      <p class="rojos">
                        <?
$msg="";
if (isset($_GET["msg"])) {
$msg=$_GET["msg"];
}
if ($msg=="1") {
	$msg="Actualizaci&oacute;n Correcta";
} 
if ($msg=="2") {
	$msg="Ingreso correcto";
} 
if ($msg=="3") {
	$msg="Eliminacion Correcta";
} 

if ($msg=="4") {
	$msg="Administracion de Subcategorias";
}
?>
                        <?php echo $msg ?> <br />
                          Administraci&oacute;n de iconos de los archivos descargables</p>
                        <form action="<?= $_SERVER['PHP_SELF']?>?op=<?php echo $op ?>&idr=<?= $idr ?>" method="post" enctype="multipart/form-data" name="form1" id="form1" onSubmit="return formValidation();">
                          <div align="center" class="txt_titulo_vinculo"><img src="otros/iconos/48.png" width="64" height="64" />iconos 
                            <span class="titulos-bases">
                            <?= $row5['nombre_rotan']?>
                            </span></div>
                          <table width="500" border="2" cellpadding="0" cellspacing="0" bordercolor="#6CA223">
                          <tr>
                            <td valign="top"><table align="center" cellspacing="8">
                              <tr valign="baseline">
                                <td align="right" nowrap="nowrap" class="campos_style"><div align="right">
				<?
$db->select($t1,"*","where id_icono='" . $_GET['id'] . "'");
$row = $db->fetch_assoc();
?>
                                  <span class="vinculo_dos">Titulo :</span></div></td>
                                <td width="457"><div align="left">
                                    <input name="nombre_icono" type="text" class="vinculo_dos" id="nombre_icono" value="<?= $row["nombre_icono"]?>" size="32" />
                                </div></td>
                              </tr>
							  <tr valign="baseline">
							    <td align="right" nowrap="nowrap" class="titulos-bases"><?php if($row['img_icono'] <> ""){ ?>
							      <img src="../imagenes/logo/<?= $row["img_icono"]?>" />
							      <?php } ?>
							      <span class="vinculo_dos">							      Imagen:</span></td>
							    <td align="left"><span class="celda">
							      <input name="img_p" type="file" class="vinculo_dos" id="img_p" />
							      </span></td>
							    </tr>
                              <tr valign="baseline">
                                <td align="right" nowrap="nowrap" class="titulos-bases">&nbsp;</td>
                                <td>
                                  
                                  
                                      <input name="submit" type="submit" class="rojos" value="Enviar informaci&oacute;n" />
                                      <input name="idr" type="hidden" id="idr" value="<?php echo $idr ?>" />
                                      <input name="id" type="hidden" id="id" value="<?= $row["id_icono"]?>" />
                                    </p></td>
                              </tr>
                            </table></td>
                          </tr>
                          
                        </table>
                        <p class="titulos">Iconos disponibles</p>
                        </form>
                        <table width="90%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC" class="tabla">
                          <tr class="vinculo_dos">
                            <th width="283" class="vinculo_dos">titulo</th>
                            <th width="107" class="vinculo_dos">imagen</th>
                            <th colspan="2" class="vinculo_dos">Opciones</th>
                          </tr>
                          <?
    $cpadre = array();
$db->select($t1,"*");
/*$db->last_query();*/
    while ($arraypadre = $db->fetch_array()) {
    $cpadre[] = $arraypadre; 
    }
foreach ($cpadre as $row) {
    ?>
                          <tr>
                            <td class="campos_style"><?= $row['nombre_icono']?></td>
                            <td valign="top" class="textos_bases"><?php if($row['img_icono'] <> ""){ ?>
							      <img src="../imagenes/logo/<?= $row["img_icono"]?>" />
							      <?php } ?></td>
                            <td width="118" align="center" valign="middle" class="textos_bases"><a href="<?= $_SERVER['PHP_SELF']?>?rand=<?= rand(1,65000)?>&amp;id=<?= $row['id_icono']?>&amp;idr=<?= $idr ?>" class="campos_style"><img src="otros/pequenos/action_refresh.gif" width="16" height="16" border="0" />Editar</a></td>
                            <td width="115" align="center" valign="middle" class="textos_bases"><div align="center"><a href="javascript:deletex('<?= $row['id_icono']?>')" class="campos_style"><img src="otros/pequenos/action_stop.gif" width="16" height="16" border="0" />Eliminar </a></div></td>
                            </tr>
                          <? }?>
                        </table>
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
	if(confirm("Esta seguro de eliminar el registro")) {
		window.location="<?= $_SERVER['PHP_SELF']?>?idr=<?php echo $idr ?>&op=3&idb=" + id;
	}
}
    </script>
</body>
</html>
