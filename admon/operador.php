<? include('include_mysqli.php'); ?> 

<? 

$id=$_GET['id'];

$idr=$_GET['idr'];

$op=$_GET['op'];

$t1="operador";



if ($op=="1"  ) { 



	

	$sql = "UPDATE `operador` SET `cedula_operador`='".$_POST['cedula_operador']."',

     `nombre_operador`='".$_POST['nombre_operador']."', `apellido_operador`='".$_POST['apellido_operador']."',

      `direccion_operador`='".$_POST['direccion_operador']."', `telefono_operador`='".$_POST['telefono_operador']."',

       `correo_operador`='".$_POST['correo_operador']."', `estado_operador`='".$_POST['estado_operador']."',

        `contrasena`='".$_POST['contrasena']."' ,

        `usuario`='".$_POST['usuario']."'  where id_operador='".$_POST['id']."'";

//echo $sql;

    $updatecontenido = $db->prepare($sql);
  $updatecontenido->execute();
  $updatecontenido->close();


	?>

    

	<script>window.location="<?= $_SERVER['PHP_SELF']?>?op=&msg=1&idr=<?php echo $idr ?>";</script>



<? }?>



<? if ($op=="2") { 

    $sql = "INSERT INTO `operador` (`cedula_operador`, `nombre_operador`, `apellido_operador`,

      `direccion_operador`, `telefono_operador`,

       `correo_operador`, `estado_operador`, `contrasena`, `usuario`) VALUES

          ('".$_POST['cedula_operador']."', '".$_POST['nombre_operador']."', '".$_POST['apellido_operador']."',

          '".$_POST['direccion_operador']."', '".$_POST['telefono_operador']."', '".$_POST['correo_operador']."',

           '".$_POST['estado_operador']."','".$_POST['contrasena']."','".$_POST['usuario']."')";

	//echo $sql;

    $insertmatrix = $db->prepare($sql);
  $insertmatrix->execute();
  $id_generado = $insertmatrix->insert_id;
  $insertmatrix->close();


	?>

    

	<script>window.location="<?= $_SERVER['PHP_SELF']?>?op=&msg=2&idr=<?php echo $idr ?>";</script>



<? }?>





<? if ($op=="3") { 

  $db->delete($t1,"where id_operador='" . $_GET['idb'] . "'");
	?>

   

    <script>window.location="<?= $_SERVER['PHP_SELF']?>?op=&msg=3";</script>



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
foreach ($cpadre as $row) { ?>

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

                      <p class="titulos"><img src="otros/iconos/Home.png" width="64" height="64" />Bienvenido

                        <?=  $_SESSION['nombre_usuario'];?>

                      </p>
                      <p class="titulos"><form action="excel.php" method="post" target="_blank">
                        <input type="hidden" name="sql" value="SELECT * FROM operador order by nombre_operador asc" />
                        <input type="submit" class="botom2" value="Descargar en Excel"/>
                      </form></p>

                      <span class="rojos">

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

                      <?php echo $msg ?></span>

                      <form action="<?= $_SERVER['PHP_SELF']?>?op=<?php echo $op ?>&amp;idr=<?= $idr ?>" method="post" enctype="multipart/form-data" name="form1" id="form1" onsubmit="return formValidation();">

                        <div align="center" class="txt_titulo_vinculo">

                          <p><img src="otros/iconos/16.png" width="64" height="64" />Usuarios Registrados
                            <? 

$db->select($t1,"*","where id_operador='" . $_GET['id'] . "'");
$row = $db->fetch_assoc();
?>

                            </p>

                          </div>

                        <table width="500" border="2" cellpadding="0" cellspacing="0" bordercolor="#6CA223">

                          <tr>

                            <td><table align="center">

                              <tr valign="baseline">

                                <td align="right" nowrap="nowrap" class="campos_style"><div align="right">Nombre:</div></td>

                                <td width="457"><div align="left">

                                  <input name="nombre_operador" type="text" class="campos_style" id="titulo" value="<?= $row["nombre_operador"]?>" size="32" />

                                  </div></td>

                                </tr>

                                

                                                       <tr valign="baseline">

                                <td align="right" nowrap="nowrap" class="campos_style"><div align="right">Apellidos:</div></td>

                                <td width="457"><div align="left">

                                  <input name="apellido_operador" type="text" class="campos_style" id="titulo" value="<?= $row["apellido_operador"]?>" size="32" />

                                  </div></td>

                                </tr>

                                

                                

                                                                     <tr valign="baseline">

                                <td align="right" nowrap="nowrap" class="campos_style"><div align="right">Cedula:</div></td>

                                <td width="457"><div align="left">

                                  <input name="cedula_operador" type="text" class="campos_style" id="titulo" value="<?= $row["cedula_operador"]?>" size="32" />

                                  </div></td>

                                </tr>

                                

                                

                                  <tr valign="baseline">
                                    
                                    <td align="right" nowrap="nowrap" class="campos_style"><div align="right">Direccion:</div></td>
                                    
                                    <td width="457"><div align="left">
                                      
                                      <input name="direccion_operador" type="text" class="campos_style" id="direccion_operador" value="<?= $row["direccion_operador"]?>" />
                                      
                                      </div></td>
                                    
                                  </tr>

                                

                                

                                                                                          <tr valign="baseline">

                                <td align="right" nowrap="nowrap" class="campos_style"><div align="right">Telefono:</div></td>

                                <td width="457"><div align="left">

                                  <input name="telefono_operador" type="text" class="campos_style" id="telefono_operador" value="<?= $row["telefono_operador"]?>" />

                                  </div></td>

                                </tr>

                                

                                <tr>                           <td align="right" nowrap="nowrap" class="campos_style"><div align="right">Correo Electronico:</div></td>
                                  
                                  <td width="457"><div align="left">
                                    
                                    <input name="correo_operador" type="text" class="campos_style" id="correo_operador" value="<?= $row["correo_operador"]?>" />
                                    
                                    </div></td>
                                  
                                </tr>

                                

                                  <tr>                           <td align="right" nowrap="nowrap" class="campos_style"><div align="right">usuario:</div></td>
                                  
                                  <td width="457"><div align="left">
                                    
                                    <input name="usuario" type="text" class="campos_style" id="usuario" value="<?= $row["usuario"]?>" />
                                    
                                    </div></td>
                                  
                                </tr> 

                                <tr>                           <td align="right" nowrap="nowrap" class="campos_style"><div align="right">Contrase&ntilde;a:</div></td>
                                  
                                  <td width="457"><div align="left">
                                    
                                    <input name="contrasena" type="text" class="campos_style" id="contrasena" value="<?= $row["contrasena"]?>" />
                                    
                                    </div></td>
                                  
                                </tr>

                                <tr valign="baseline">
                                  
                                  <td align="right" nowrap="nowrap" class="titulos-bases">&nbsp;</td>
                                  
                                  <td><input name="submit" type="submit" class="rojos" value="Enviar informaci&oacute;n" />
                                    
                                    <input name="idr" type="hidden" id="idr" value="<?php echo $idr ?>" />
                                    
                                    <input name="id" type="hidden" id="id" value="<?= $row["id_operador"]?>" /></td>
                                  
                                </tr>

                              </table></td>

                            </tr>

                          </table>

                      </form>

                      <div align="left">

                       

                      </div>

                      <table width="100%" border="1" cellpadding="0" cellspacing="2" bordercolor="#CCCCCC" bgcolor="#FBFBFB">

                      <tr>

                      <td></td>

                      <td>Nombre</td>

                      <td>Correo</td>

                      <td>Telefono</td>

                      <td colspan="2">Opciones</td>

                      </tr>

                                             <? 

                      $cpadre = array();
$db->select($t1,"*");
/*$db->last_query();*/
    while ($arraypadre = $db->fetch_array()) {
    $cpadre[] = $arraypadre; 
    }
foreach ($cpadre as $row2) { 
                      ?>

                        <tr align="center">

                          <td width="" height="20" bgcolor="#FFFFFF" ><img src="otros/pequenos/add-comment-red.gif" width="14" height="14" /></td>

                          <td width="" class="campos_style" ><div align="left"> <span class="rojos">

                            <?= $row2['nombre_operador']?>

                            </span></div></td>

                                    <td width="" class="campos_style" ><div align="left"> <span class="rojos">

                            <?= $row2['correo_operador']?>

                            </span></div></td>

                            

                            <td width="" class="campos_style" ><div align="left"> <span class="rojos">

                            <?= $row2['telefono_operador']?>

                            </span></div></td>

                            

                          <td width="" ><div align="center"><a href="<?= $_SERVER['PHP_SELF']?>?id=<?= $row2['id_operador']?>&op=4" class="campos_style"><img src="otros/pequenos/action_refresh_blue.gif" width="16" height="16" border="0" />Editar </a></div></td>

                       <td align="left"><div ><a href="javascript:deletex('<?= $row2['id_operador']?>')" class="campos_style"><img src="otros/pequenos/action_stop.gif" width="16" height="16" border="0" />Eliminar</a></div></td>

                        </tr>

                                                <? //FIN ROW2

					}?>

                      </table>

                      <div align="left">



                      </div>

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

	if(confirm("Esta seguro de eliminar el registro, recuerde que al eliminarlo se borraran los productos relacionados?")) {

		window.location="<?= $_SERVER['PHP_SELF']?>?op=3&idb=" + id;

	}

}

    </script>

</body>

</html>

