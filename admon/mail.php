<? include('include_mysqli.php'); ?> 
<? 
$id=$_GET['id'];
$idr=$_GET['idr'];
$op=$_GET['op'];
$t1="mail";
if ($op=="1"  ) { 

	$sql = "UPDATE $t1 set titulo='" . $_POST['titulo'] . "'";
	$sql = $sql . ", mail= '" . $_POST['mail'] . "'";
	$sql = $sql . " where id= '" . $_POST['id'] . "'";
	
	//echo $sql;

    $updatecontenido = $db->prepare($sql);
  $updatecontenido->execute();
  $updatecontenido->close();
	?>
    
	<script>window.location="<?= $_SERVER['PHP_SELF']?>?op=4&msg=1&idr=<?php echo $idr ?>";</script>

<? }?>

<? if ($op=="2") { 
	$sql = "INSERT INTO $t1(titulo, mail) values ";
	$sql = $sql . " ('" . $_POST['titulo'] . "'";
	$sql = $sql . " ,'" . $_POST['mail'] . "')";

	//echo $sql;

    $insertmatrix = $db->prepare($sql);
  $insertmatrix->execute();
  $id_generado = $insertmatrix->insert_id;
  $insertmatrix->close();
	?>
    
	<script>window.location="<?= $_SERVER['PHP_SELF']?>?op=4&msg=2&idr=<?php echo $idr ?>";</script>

<? }?>


<? if ($op=="3") { 

  $db->delete($t1,"where id='" . $_GET['idb'] . "'");
  ?>
   
    <script>window.location="<?= $_SERVER['PHP_SELF']?>?op=4&msg=3&idr=<?php echo $idr ?>";</script>

<? }?>
<? if ($id<>""  ) { $op=1; } else { $op=2;}?>
mysqli
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
                    <td valign="top"><div align="center" class="campos_style">
                      <p class="titulos"> <img src="otros/iconos/Chat.png" width="64" height="64" />Bienvenido
                        <?=  $_SESSION['nombre_usuario'];?>
                      </p>
                     
                        <span class="rojos">
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
	$msg="Administracion de categorias de contenidos";
}
?><?php echo $msg ?></span><span class="titulos-bases">mail dirigidos</span>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
                          <td background="otros/raya.jpg"><img src="otros/raya.jpg" width="7" height="4" /></td>
                        </tr>
                      </table>
                        <table width="90%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
                          <tr>
                            <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="4" bordercolor="#666666" class="tabla">
                              <tr>
                                <th width="36%" class="vinculo_dos">asunto</th>
                                <th width="14%" class="vinculo_dos">mail</th>
                                <th colspan="2" class="vinculo_dos">Opciones</th>
                              </tr>
                               <?
$cpadre = array();
$db->select($t1,"*","order by  id asc");
/*$db->last_query();*/
    while ($arraypadre = $db->fetch_array()) {
    $cpadre[] = $arraypadre; 
    }
foreach ($cpadre as $row) { 
  ?>
                              <tr>
                                <td align="left" bgcolor="#F8F8F8" class="vinculo_dos"><img src="otros/pequenos/action_forward.gif" width="16" height="16" />(
                                  <?= $row['id']?>
                                  )                                  <?= $row['titulo']?></td>
                                <td bgcolor="#F8F8F8" class="vinculo_dos"><?= $row['mail']?></td>
                                <td width="11%" align="center" valign="middle" bgcolor="#F8F8F8" class="textos_bases"><div align="left" class="campos_style"><a href="<?= $_SERVER['PHP_SELF']?>?id=<?= $row['id']?>&amp;op=4"><img src="otros/pequenos/action_refresh.gif" width="16" height="16" border="0" />Editar</a></div>
                                    <div align="center" class="campos_style"></div></td>
                                <td width="39%" align="center" valign="middle" bgcolor="#F8F8F8" class="campos_style"><div align="center"><a href="javascript:deletex('<?= $row['id']?>')" class="campos_style"><img src="otros/pequenos/action_stop.gif" width="16" height="16" border="0" />Eliminar </a></div></td>
                              </tr>
  <?php } ?>
                                    
                         
                            </table></td>
                          </tr>
                        </table>  
                        <hr>
                  
                      <form action="<?= $_SERVER['PHP_SELF']?>?op=<?php echo $op ?>&idr=<?= $idr ?>" method="post" enctype="multipart/form-data" name="form1" id="form1" onSubmit="return formValidation();">
                        <div align="center" class="txt_titulo_vinculo"><img src="otros/messages.gif" width="150" height="113" />Mail
<? 
$db->select($t1,"*","where id='" . $_GET['id'] . "'");
$row = $db->fetch_assoc();
?>
                        </div>
                        <table width="100%" border="2" cellpadding="0" cellspacing="0" bordercolor="#6CA223">
                          <tr>
                            <td><table align="center">
                              <tr valign="baseline">
                                <td align="right" nowrap="nowrap" class="campos_style"><div align="right">Asunto :</div></td>
                                <td width="457"><div align="left">
                                    <input name="titulo" type="text" class="campo" id="titulo" value="<?= $row["titulo"]?>" size="32" />
                                </div></td>
                              </tr>
                              <tr valign="baseline">
                                <td align="right" nowrap="nowrap" class="campos_style"><div align="right">Mail :</div></td>
                                <td width="457"><div align="left">
                                    <input name="mail" type="text" class="campo" id="mail" value="<?= $row["mail"]?>" size="32" />
                                </div></td>
                              </tr>
                              <tr valign="baseline">
                                <td align="right" nowrap="nowrap" class="titulos-bases">&nbsp;</td>
                                <td><input name="submit" type="submit" class="rojos" value="Enviar informaci&oacute;n" />
                                  <input name="id" type="hidden" id="id" value="<?= $row["id"]?>" /></td>
                              </tr>
                            </table></td>
                          </tr>
                        </table>
                        </form>
                    
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
		window.location="<?= $_SERVER['PHP_SELF']?>?op=3&idb=" + id;
	}
}
    </script>
</body>
</html>
