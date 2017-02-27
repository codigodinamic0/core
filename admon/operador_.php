<?php include('include.php'); ?> 
<?php 
//paguinador
 $TAMANO_PAGINA = 10; 
 $inicio = 0; 
 $pagina=1; 
  if (isset($_GET["pg"])) { 
  $pagina = $_GET["pg"];
  $inicio = ($pagina - 1) * $TAMANO_PAGINA; 
  } 
$id=$_GET['id'];
$idr=$_GET['idr'];
$op=$_GET['op'];
$t1="operador ";
//pregunto por el nombre

 //pregunto por la palabra
	
	if($_POST['palabra'] == true){
	
	$condicion = " where nombre like '%".$_POST[palabra]."%'";
	}
	
	
function echo_textarea($texto)
{
	$texto = strtr($texto, array("\r\n" => '<br />', "\r" => '<br />', "\n" => '<br />')); 
	return $texto;
}


if ($op=="1"  ) { 
 if (ValidaMail($_REQUEST['mail_ppal'])!=1){ ?>
<script>javascript:history.back(alert("Por favor ingrese un email valido"));</script>	
	<? 
	exit;
	}

$sql = "UPDATE $t1 set nombre='" . $_POST['nombre'] . "'";
$sql = $sql . ", apellido= '" . $_POST['apellido'] . "'";
$sql = $sql . ", fecha= '" . $_POST['fecha'] . "'";
$sql = $sql . ", empresa= '" . $_POST['empresa'] . "'";
$sql = $sql . ", direccion= '" . $_POST['direccion'] . "'";
$sql = $sql . ", pais= '" . $_POST['pais'] . "'";
$sql = $sql . ", barrio= '" . $_POST['barrio'] . "'";
$sql = $sql . ", ciudad= '" . $_POST['ciudad'] . "'";
$sql = $sql . ", telefono= '" . $_POST['telefono'] . "'";
$sql = $sql . ", mail_ppal= '" . $_POST['mail_ppal'] . "'";
$sql = $sql . ", celular= '" . $_POST['celular'] . "'";
$sql = $sql . ", contrasena= '" . $_POST['contrasena'] . "'";
$sql = $sql . " where id= '" . $_POST['id'] . "'";
//echo $sql;
$res = @mysql_query($sql); 
if (!$res) { exit(mysql_error()); }

//ingreso adicionales
mysql_query("delete from readi where operador = '" . $_POST['id'] . "'");
if(isset($_POST['adicional']))
foreach ($_POST['adicional'] as $adicional)
mysql_query("INSERT INTO readi (operador,adicional) values ('" . $_POST['id'] . "','" . $adicional . "')");	



//datos mensaje
//envio correo
$correo=$_POST['mail_ppal'];
$nombre=$_POST['nombre']."  ".$_POST['apellido'];
$contrasena=$_POST['contrasena'];


//cuerpo del correo	
mail("$correo", "Mensajes RegistradosGOLF 24/7", "Datos Suninistrados\n 
Les damos la bienvenida a nuestra plataforma de comercialización online golf.co
A partir de este momento pueden acceder a nuestra Página y gestionar sus productos  de forma ágil y practica.

INGRESO A LA PAGINA
http://www.folf.co
SU USUARIO ES: $correo
SU CONTRASENA ES: $contrasena
Cualquier otra inquietud puede escribirnos a santiago@colombiaesgolf.com o Cra. xxxxxx xxxxx xxxxx

  ", "From:santiago@colombiaesgolf.com");




//ingreso adicionales
mysql_query("delete from readi where operador = '" . $_POST['id'] . "'");
if(isset($_POST['adicional']))
foreach ($_POST['adicional'] as $adicional)
mysql_query("INSERT INTO readi (operador,adicional) values ('" . $_POST['id'] . "','" . $adicional . "')");		
		

	?>
    
<script>window.location="<?php echo $_SERVER['PHP_SELF']?>?op=4&msg=1&idr=<?php echo $idr ?>";</script>

<?php } ?>





<?php if ($op=="2") { 
 if (ValidaMail($_REQUEST['mail_ppal'])!=1){ ?>
<script>javascript:history.back(alert("Por favor ingrese un email valido"));</script>	
	<? 
	exit;
	}
	$sql = "INSERT INTO $t1 (nombre,apellido,fecha, empresa, direccion, pais, barrio, ciudad, telefono,mail_ppal,celular,contrasena) values ";
$sql = $sql . " ('" . $_POST['nombre'] . "'";
$sql = $sql . " ,'" . $_POST['apellido'] . "'";
$sql = $sql . " ,'" . $_POST['fecha'] . "'";
$sql = $sql . " ,'" . $_POST['empresa'] . "'";
$sql = $sql . " ,'" . $_POST['direccion'] . "'";
$sql = $sql . " ,'". $_POST['pais'] . "'";
$sql = $sql . " ,'". $_POST['barrio'] . "'";
$sql = $sql . " ,'". $_POST['ciudad'] . "'";
$sql = $sql . " ,'". $_POST['telefono'] . "'";
$sql = $sql . " ,'". $_POST['mail_ppal'] . "'";
$sql = $sql . " ,'". $_POST['celular'] . "'";
$sql = $sql . " ,'" . $_POST['contrasena'] . "')";
//echo $sql;
$res = @mysql_query($sql); if (!$res) { exit(mysql_error()); } 
$id_generado = mysql_insert_id();
//ingreso adicionales
mysql_query("delete from readi where operador = '" . $id_generado . "'");
if(isset($_POST['adicional']))
foreach ($_POST['adicional'] as $adicional)
mysql_query("INSERT INTO readi (operador,adicional) values ('" . $id_generado . "','" . $adicional . "')");

//datos mensaje
//envio correo
$correo=$_POST['mail_ppal'];
$nombre=$_POST['nombre']."  ".$_POST['apellido'];
$contrasena=$_POST['contrasena'];


//cuerpo del correo	
mail("$correo", "Mensajes RegistradosGOLF 24/7", "Datos Suninistrados\n 
Les damos la bienvenida a nuestra plataforma de comercialización online golf.co
A partir de este momento pueden acceder a nuestra Página y gestionar sus productos  de forma ágil y practica.

INGRESO A LA PAGINA
http://www.folf.co
SU USUARIO ES: $correo
SU CONTRASENA ES: $contrasena
Cualquier otra inquietud puede escribirnos a santiago@colombiaesgolf.com o Cra. xxxxxx xxxxx xxxxx

  ", "From:santiago@colombiaesgolf.com");
	

$msg="Registro realizado Satisfactoriamente, pronto podra disfrutar de los servicios de GOLF 24/7";







	?>
    
<script>window.location="<?php echo $_SERVER['PHP_SELF']?>?op=4&msg=2";</script>

<?php }?>


<?php if ($op=="3") { 

$sql = "SELECT img FROM $t1 where id='" . $_GET['idb'] . "'";
//echo $sql;
$res = @mysql_query($sql); if (!$res) { exit(mysql_error()); } 
$row = mysql_fetch_array($res);

$nombre_archivo=$row['img'];

echo "Foto: " . $nombre_archivo;

if ($nombre_archivo!="") {
	unlink("../imagenes/logos/" . $nombre_archivo );
}

$sql = "DELETE from $t1 where id='" . $_GET['idb'] . "'";
//echo $sql;
$res = @mysql_query($sql); if (!$res) { exit(mysql_error()); }
?>
   
<script>window.location="<?php echo $_SERVER['PHP_SELF']?>?op=&msg=3&idr=<?php echo $idr ?>";</script>

<?php }?>
<?php if ($id<>""  ) { $op=1; } else { $op=2;}?>

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

$sql = "SELECT * FROM menu order by menu.nombre";
	$res = @mysql_query($sql); if (!$res) { exit(mysql_error()); } 
	while ($row = mysql_fetch_array($res)) {?>
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
                              <? $sql2 = "SELECT * FROM menu_r where menu_r.idr='".$row['id']."'  order by menu_r.nombre_l";
                        $res2 = @mysql_query($sql2); if (!$res2) { exit(mysql_error()); } 
                        while ($row2 = mysql_fetch_array($res2)) {?>
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
                      <p class="titulos"> <img src="otros/iconos/User_add.png" width="64" height="64" />Bienvenido
                        <?php echo $_SESSION['nombre_usuario']; ?>
                      </p>
                     
                        <p class="rojos">
                          <?php
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
?><?php echo $msg ?></p>
                        <a href="operador.php" class="txt_url_vinculo"><img src="otros/pequenos/add.gif" width="16" height="16" />Ingresar nuevo Operador</a>
<div align="center" class="txt_titulo_vinculo"><img src="otros/iconos/47.png" width="64" height="64" />Administraci&oacute;n de registrados
  <?php $sql = "SELECT * FROM  $t1   where id='" . $_GET['id'] . "'";
$res = @mysql_query($sql); if (!$res) { exit(mysql_error()); }
$row = mysql_fetch_array($res)?>
  <form action="<?php echo $_SERVER['PHP_SELF']?>?op=<?php echo $op ?>&idr=<?php echo $idr ?>" method="post" enctype="multipart/form-data" name="form1" id="form1" onSubmit="return formValidation();">
                          <div align="center" class="txt_titulo_vinculo">
                            <table width="100%" border="2" cellpadding="0" cellspacing="0" bordercolor="#6CA223">
                              <tr>
                                <td align="center" valign="top"><table width="100%" align="center" cellspacing="5">
                                  <tr valign="baseline">
                                    <td align="right" nowrap="nowrap" class="campos_style"><div align="right">Nombres registrado:</div></td>
                                    <td width="457" align="left"><input name="nombre" type="text" class="campo" id="nombre" value="<?php echo $row["nombre"]?>" size="32" /></td>
                                  </tr>
                                  <tr valign="baseline">
                                    <td align="right" nowrap="nowrap" class="campos_style"><div align="right">Apellido registrado:</div></td>
                                    <td width="457" align="left"><input name="apellido" type="text" class="campo" id="apellido" value="<?php echo $row["apellido"]?>" size="32" /></td>
                                  </tr>
                                  <tr valign="baseline">
                                    <td align="right" nowrap="nowrap" class="campos_style"><div align="right">Cumplea&ntilde;os:</div></td>
                                    <td width="457" align="left"><input name="fecha" type="text" class="campo" id="fecha" value="<?= $row["fecha"]?>" size="32" readonly="readonly" /></td>
                                    
                                    
                                    
                                  </tr>
                                  
                                  
                                  
                                   <tr valign="baseline">
                                    <td align="right" nowrap="nowrap" class="campos_style"><div align="right" class="campos_style">Empresa:</div></td>
                                    <td><div align="left">
                                      <input name="empresa" type="text" class="campo" id="empresa" value="<?php echo $row["empresa"]?>" size="32"  />
                                    </div></td>
                                  </tr>
                                  
                                  
                                  
                                  <tr valign="baseline">
                                    <td align="right" nowrap="nowrap" class="campos_style"><div align="right" class="campos_style">Direcci&ograve;n:</div></td>
                                    <td><div align="left">
                                      <input name="direccion" type="text" class="campo" id="direccion" value="<?php echo $row["direccion"]?>" size="32"  />
                                    </div></td>
                                  </tr>
                                  <tr valign="baseline">
                                    <td align="right" nowrap="nowrap" class="campos_style"><div align="right" class="campos_style">
                                      <label for="checkbox_row_4">pais</label>
                                      :</div></td>
                                    <td><div align="left">
                                      <div align="left">
                                        <input name="pais" type="text" class="campo" id="pais" value="<?php echo $row["pais"]?>" size="32"  />
                                      </div>
                                    </div></td>
                                  </tr>
                                  <tr valign="baseline">
                                    <td align="right" nowrap="nowrap" class="campos_style"><div align="right" class="campos_style">
                                      <label for="checkbox_row_5">Barrio</label>
                                      :</div></td>
                                    <td align="left"><div id="iddepartamento" >
                                      <input name="barrio" type="text" class="campo" id="barrio" value="<?php echo $row["barrio"]?>" size="32"  />
                                    </div></td>
                                  </tr>
                                  <tr valign="baseline">
                                    <td align="right" nowrap="nowrap" class="campos_style"><div align="right" class="campos_style">ciudad :</div></td>
                                    <td align="left"><div id="id_ciudad" >
                                      <input name="ciudad" type="text" class="campo" id="ciudad" value="<?php echo $row["ciudad"]?>" size="32"  />
                                    </div></td>
                                  </tr>
                                  <tr valign="baseline">
                                    <td align="right" nowrap="nowrap" class="campos_style"><div align="right" class="campos_style">T&egrave;lefono :</div></td>
                                    <td><div align="left">
                                      <input name="telefono" type="text" class="campo" id="telefono" value="<?php echo $row["telefono"]?>" size="32"  />
                                      </div></td>
                                  </tr>
                                  <tr valign="baseline">
                                    <td align="right" nowrap="nowrap" class="campos_style"><div align="right" class="campos_style">Email (sera su usuario para ingresar) :</div></td>
                                    <td><div align="left">
                                      <input name="mail_ppal" type="text" class="campo" id="mail_ppal" value="<?php echo $row["mail_ppal"]?>" size="32"  />
                                      </div></td>
                                  </tr>
                                  <tr valign="baseline">
                                    <td align="right" nowrap="nowrap" class="campos_style"><div align="right" class="campos_style">Celular :</div></td>
                                    <td><div align="left">
                                      <input name="celular" type="text" class="campo" id="celular" value="<?php echo $row["celular"]?>" size="32"  />
                                      </div></td>
                                  </tr>
                                  <tr valign="baseline">
                                    <td align="right" nowrap="nowrap" class="campos_style"><div align="right" class="campos_style">Contrase&ntilde;a:</div></td>
                                    <td><div align="left">
                                      <input name="contrasena" type="text" class="campo" id="contrasena" value="<?php echo $row["contrasena"]?>" size="32"  />
                                    </div></td>
                                  </tr>
                                  <tr valign="baseline">
                                    <td align="right" nowrap="nowrap" class="campos_style"><div align="right" class="campos_style">Temas de interes:</div></td>
                                    <td><div align="left">
                                      <?
        $sql2 = "SELECT * FROM readicional  order by id_readicional";
		$res2 = @mysql_query($sql2); if (!$res2) { exit(mysql_error()); }
		while ($row2 = mysql_fetch_array($res2)) {
		
		$sqloso = "SELECT * from readi where operador='" . $id . "' and adicional='" . $row2["id_readicional"] . "'";
		$resoso= @mysql_query($sqloso); if (!$resoso) { exit(mysql_error()); }
		
		$checked="";
		if ($rowoso = mysql_fetch_array($resoso)) {
			$checked="checked";
		}
		
		?>
                                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                          <td width="20"><input name="adicional[]" type="checkbox" id="adicional[]"   value="<?= $row2["id_readicional"]?>" <?= $checked?> /></td>
                                          <td ><div align="left" class="vinculo_dos">
                                            <?= $row2["nombre_readicional"]?></div></td>
                                        </tr>
                                      </table>
                                      <?  }?>
                                    </div></td>
                                  </tr>
                                </table>
                                  <p>
                                    <input name="submit" type="submit" class="rojos" value="Enviar informaci&oacute;n" />
                                    <input name="idr" type="hidden" id="idr" value="<?php echo $idr ?>" />
                                    <input name="id" type="hidden" id="id" value="<?php echo $row["id"]?>" />
                                  </p></td>
                              </tr>
                            </table>
                          </div>
                         </form>
                         <form id="form2" name="form2" method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
                           <table width="100%" border="0" cellspacing="0" cellpadding="0">
                             <tr>
                               <td width="150">Buscar p&oacute;r nombre:</td>
                               <td width="200"><input name="palabra" type="text" class="campo" id="palabra" size="32"  /></td>
                               <td><input type="submit" name="button" id="button" value="buscar" /></td>
                             </tr>
                           </table>
                         </form>
                      </div>
                        <table width="100%" border="0" cellspacing="4" cellpadding="0">
                          <tr>
                             <td width="20%"><span class="titulos-bases">Usuarios Registrados</span></td>
                             <td width="20%"><span class="titulos-bases">mail</span></td>
                             <td width="11%"><span class="titulos-bases">contrase&ntilde;a</span></td>
                             <td width="30%"><span class="titulos-bases">Opcioness</span></td>
                           </tr>
                           <?php 
				



	$sql  = "SELECT * FROM $t1 $condicion  order by nombre asc";
//echo $sql;
                    $res = @mysql_query($sql); if (!$res) { exit(mysql_error()); } 
                    $num_total_registros = mysql_num_rows($res); 
                    //calculo el total de p&aacute;ginas 
                    $total_paginas = ceil($num_total_registros / $TAMANO_PAGINA); 
                    
                    $sql = $sql . " limit " . $inicio . "," . $TAMANO_PAGINA ;
                        
                    $res = @mysql_query($sql); if (!$res) { exit(mysql_error()); }  

                    while  ($row = mysql_fetch_array($res)) {
                     
                  
                    ?>
                           <tr onmouseover="javascript:style.backgroundColor='#C6E2FF'" onmouseout="javascript:style.backgroundColor=''" >
                             <td><span class="vinculo_dos"><img src="otros/pequenos/action_forward.gif" width="16" height="16" /> <?php echo $row['nombre']?></span></td>
                             <td><span class="vinculo_dos"><?php echo $row['mail_ppal']?></span></td>
                             <td><span class="vinculo_dos"><?php echo $row['contrasena']?></span></td>
                             <td><table width="100%" border="0" cellspacing="2" cellpadding="0">
                               <tr>
                                 <td><div align="left"><a href="<?php echo $_SERVER['PHP_SELF']?>?id=<?php echo $row["id"] ?>" class="campos_style"><img src="otros/pequenos/action_refresh_blue.gif" width="16" height="16" border="0" />Editar Registrado</a></div></td>
                                 </tr>
                               <tr>
                                 <td align="left"><div ><a href="javascript:deletex('<?php echo $row['id']?>')" class="campos_style"><img src="otros/pequenos/action_stop.gif" width="16" height="16" border="0" />Eliminar Registrado</a></div></td>
                                 </tr>
                             </table></td>
                           </tr>
                           <?php }?>
                     </table>
                         <div align="center">
                           <table border="0" align="center" cellpadding="0" cellspacing="0">
                             <tr>
                               <td width="10">
                                 <?php  //muestro los distintos &iacute;ndices de las p&aacute;ginas, si es que hay varias p&aacute;ginas 
if (($total_paginas > 1)){ ?>
                                 <div align="right">
                                   <?php if ($pagina!=1){?>
                                   <a href='<?php echo $_SERVER['PHP_SELF']?>?pg=<?php echo ($pagina-1)?>&amp;id_sublinea=<?php echo $_GET['id_sublinea'] ?>&amp;id_linea=<?php echo $_GET['id_linea'] ?>&amp;micro=<?php echo $micro ?>' title="Anteior" class="paginador"><img src="otros/pequenos/arrow1_w.gif" width="16" height="16" border="0" /></a>
                                   <?php }?>
                                 </div></td>
                               <td class="paginador" ><?php for ($i=1;$i<=$total_paginas;$i++){ 

if ($pagina == $i) {?>
                                 <span class="txt_titulo_vinculo">- <?php echo $pagina?> - </span>
                                 <?php } else {?>
                                 <a href='<?php echo $_SERVER['PHP_SELF']?>?pg=<?php echo $i?>&amp;id_sublinea=<?php echo $_GET['id_sublinea'] ?>&amp;id_linea=<?php echo $_GET['id_linea'] ?>&amp;micro=<?php echo $micro ?>' class="paginador"> <?php echo $i?> &nbsp; </a>
                                 <?php } ?>
                                 <?php }?></td>
                               <td width="10"><div align="left">
                                 <?php if ($total_paginas!=$pagina){?>
                                 <a href='<?php echo $_SERVER['PHP_SELF']?>?pg=<?php echo ($pagina+1)?>&amp;id_sublinea=<?php echo $_GET['id_sublinea'] ?>&amp;id_linea=<?php echo $_GET['id_linea'] ?>&amp;micro=<?php echo $micro ?>' title="Siguiente" class="paginador"><img src="otros/pequenos/arrow1_e.gif" width="16" height="16" border="0" /></a>
                                 <?php }?>
                                 <?php } ?>
                               </div></td>
                             </tr>
                           </table>
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

<script language="javascript">
function deletex(id){
	if(confirm("Esta seguro de eliminar el registro?")) {
		window.location="<?php echo $_SERVER['PHP_SELF']?>?idr=<?php echo $idr ?>&op=3&idb=" + id;
	}
}
    </script>
</body>
</html>
