<? include ('include_mysqli.php'); ?> 
<?php
$id = $_GET['id'];
$idr = $_GET['idr'];
$op = $_GET['op'];
$t1 = "usuario";

if (isset($_POST['envio'])) {
      $cpadre = array();
$db->select("suscripcion","*","WHERE estado_suscripcion=1");
/*$db->last_query();*/
    while ($arraypadre = $db->fetch_array()) {
    $cpadre[] = $arraypadre; 
    }
foreach ($cpadre as $row) {

        $para = $row['correo_suscripcion'];
        
       // echo $row['correo_suscripcion'];

        // subject
        $titulo = $_POST['titulo'];

        // Mensaje
        $mensaje = $_POST['contenido'];

        // Para enviar un correo HTML mail, la cabecera Content-type debe fijarse
        $cabeceras = 'MIME-Version: 1.0' . "\r\n";
        $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

        //Envio de Mail
        mail($para, $titulo, $mensaje, $cabeceras);

    }
    ?>
    <script type="text/javascript">
     alert("Enviado Correctamente");
     window.location="suscripcion.php";
    </script>
    <?php

}

?>
<? if ($id <> "") {
    $op = 1;
} else {
    $op = 2;
} ?>
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
                                    <td bgcolor="#F5F5F5" class="menu_style"><a href="javascript:disp<?= $row['id'] ?>()">
                                      <?= $row['nombre']; ?>
                                    </a></td>
                                  </tr>
                              </table></td>
                            </tr>
                            <script language="JavaScript" type="text/javascript">
			function disp<?= $row['id'] ?>()
			{
				if(document.getElementById("disp<?= $row['id'] ?>").style.display == "none")
					document.getElementById("disp<?= $row['id'] ?>").style.display = "";
				else
					document.getElementById("disp<?= $row['id'] ?>").style.display = "none";
			}
			        </script>
                            <tr>
                              <td valign="top"><div id="disp<?= $row['id'] ?>" style="display:none">
                                  <?
      $cpadre = array();
$db->select("menu_r","*","where menu_r.idr='" . $row['id'] .
        "'  order by menu_r.nombre_l");
/*$db->last_query();*/
    while ($arraypadre = $db->fetch_array()) {
    $cpadre[] = $arraypadre; 
    }
foreach ($cpadre as $row2) {
     ?>
                                  <table width="100%" border="0" cellpadding="0" cellspacing="2">
                                    <tr>
                                      <td width="5" bgcolor="#FFFFFF" ><img src="images/menu_task.jpg" width="11" height="11" /></td>
                                      <td ><span class="campos_style"> <a href="<?= $row2['url'] ?>">
                                        <?= $row2['nombre_l']; ?>
                                      </a></span></td>
                                    </tr>
                                  </table>
                                <? //FIN ROW2
    } ?>
                              </div></td>
                            </tr>
                            <? //FIN ROW
} ?>
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
                        <?= $_SESSION['nombre_usuario']; ?>
                      </p>
                      <span class="txt_titulo_vinculo">
                      <?
$msg = "";
if (isset($_GET["msg"])) {
    $msg = $_GET["msg"];
}
if ($msg == "1") {
    $msg = "Actualización Correcta";
}
if ($msg == "2") {
    $msg = "Ingreso correcto";
}
if ($msg == "3") {
    $msg = "Eliminacion Correcta";
}

if ($msg == "4") {
    $msg = "Administracion de categorias de contenidos";
}
?>
                      <?php echo $msg ?>Correo Suscritos</span>l
<table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                          <td background="otros/raya.jpg"><img src="otros/raya.jpg" width="7" height="4" /></td>
                        </tr>
                      </table>
                        <table width="90%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
                          <tr>
                            <td><table width="100%" border="0"  cellpadding="0" cellspacing="4" bordercolor="#666666" class="tabla">
                              <tr>
                                <th width="" class="vinculo_dos">ID</th>
                                <th width="" class="vinculo_dos">Correo</th>
                              </tr>
                               <?
$cpadre = array();
$db->select("suscripcion","*"," WHERE 1 order by correo_suscripcion asc");
/*$db->last_query();*/
    while ($arraypadre = $db->fetch_array()) {
    $cpadre[] = $arraypadre; 
    }
foreach ($cpadre as $row) {
 ?>
                              <tr>
                                <td bgcolor="#F8F8F8" class="titulos-bases"><img src="otros/pequenos/action_forward.gif" width="16" height="16" />
                                (<?= $row['id_suscripcion'] ?>)
                                </td>
                                <td bgcolor="#F8F8F8" class="titulos-bases">
                                  <?= $row['correo_suscripcion'] ?>
                                </td>
                                   </tr>
  <?php } ?>
                                    
                         
                            </table></td>
                          </tr>
                        </table>  
                        <hr/>
                  
                      <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data" name="form1" id="form1">
                        <div align="center" class="txt_titulo_vinculo"><img src="otros/messages.gif" width="150" height="113" />Enviar Mensaje a Suscritos
                        </div>
                        <table width="100%" border="2" cellpadding="0" cellspacing="0" bordercolor="#6CA223">
                          
                          <tr>
                            <td><table align="center">
                            <tr valign="baseline">
                                <td align="right" nowrap="nowrap" class="campos_style"><div align="right">Titulo del Mensaje:</div></td>
                                <td width="457" align="left"><input name="titulo" type="text" class="campo" id="titulo" value="<?= $row["titulo"] ?>" size="32" /></td>
                              </tr>
                              <tr valign="baseline">
                                <td align="right" nowrap="nowrap" class="campos_style"><div align="right" class="hlday"></div></td>
                                <td width="457"><div align="left"><span class="titulos-bases">Contenido:</span>
                                <textarea name="contenido" id="contenido"  cols="50" rows="5"><?= $row['contenido'] ?>
                                </textarea>
							<script language="javascript">
                     CKEDITOR.replace('contenido', { filebrowserBrowseUrl: 'simogeo/index.html' });
                     </script>
                                  </div></td>
                              </tr>
                              <tr valign="baseline">
                                <td align="right" nowrap="nowrap" class="titulos-bases">&nbsp;</td>
                                <td><input name="envio" type="submit" class="rojos" value="Enviar Mensaje" />
                                  </td>
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
		window.location="<?= $_SERVER['PHP_SELF'] ?>?op=3&idb=" + id;
	}
}
    </script>
</body>
</html>
