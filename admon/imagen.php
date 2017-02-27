<?php

include ('../lib/funciones.php');

?>
<?php

include ('include_mysqli.php');

?>
<?

$id = $_GET['id'];
$idr = $_GET['idr'];
$op = $_GET['op'];
$t1 = "idioma";
$valor = variable(173, 2);
$modulo = "Imagen";
//para verificar tamanos

$db->select("tamano","*"," where id=7");
$rowh = $db->fetch_assoc();
$alto = $row['hgrande'];
$ancho = $row['wgrande'];
$altop = $row['hpequena'];
$anchop = $row['wpequena'];


if ($op == "1")
{

    $sql = "UPDATE `idima` SET `idma_nombre`='" . sql_seguro($_POST['idioma']) .
        "' WHERE (`id_idma`='" . sql_seguro($_POST['id']) . "')";

    $updatecontenido = $db->prepare($sql);
    $updatecontenido->execute();
    $updatecontenido->close();
    if ($_FILES['img']['name'] != "")
    {
        $aux = explode(".", $_FILES['img']['name']);
        $nombre_archivo = $_POST['id'] . "." . $aux[count($aux) - 1];
        copy($_FILES['img']['tmp_name'], "../imagenes/idioma/{$_POST['idi']}/" . $nombre_archivo);

        include_once ('thumbnail.inc.php');
        //grandes
        $thumb = new Thumbnail("../imagenes/idioma/{$_POST['idi']}/" . $nombre_archivo);
        if ($thumb->getCurrentHeight() > $alto)
        {
            $thumb->resize(0, $alto);
            //$thumb->crop(0,0,720,252);
            $thumb->save("../imagenes/idioma/{$_POST['idi']}/" . $nombre_archivo);
            $thumb->destruct();

        }

        $thumb = new Thumbnail("../imagenes/idioma/{$_POST['idi']}/" . $nombre_archivo);
        if ($thumb->getCurrentWidth() > $ancho)
        {
            $thumb->resize($ancho, 0);
            //$thumb->crop(0,0,720,252);
            $thumb->save("../imagenes/idioma/{$_POST['idi']}/" . $nombre_archivo);
            $thumb->destruct();

        }
        $sql = "UPDATE `idima` SET `idma_imagen`='".$nombre_archivo."' WHERE (`id_idma`='" .
            sql_seguro($_POST['id']) . "')";

        $updatecontenido = $db->prepare($sql);
        $updatecontenido->execute();
        $updatecontenido->close();
    }

?>
    
	<script>window.location="<?=

    $_SERVER['PHP_SELF']

?>?msg=2";</script>

<?

    exit;
}

?>





<?

if ($op == "2")
{
    
    $sql = "INSERT INTO `imagen` (`imagen`, `nombre_imagen`) VALUES ('', '{$_POST['idioma']}')";

    $insertmatrix = $db->prepare($sql);
    $insertmatrix->execute();
    $id_generado = $insertmatrix->insert_id;
    $insertmatrix->close();

    //inserto en idmo cuantos modulos existan

    $cpadre = array();
    $db->select("idioma","*");
    /*$db->last_query();*/
    while ($arraypadre = $db->fetch_array()) {
        $cpadre[] = $arraypadre; 
    }
    foreach ($cpadre as $rowi) {

        $sql = "INSERT INTO `idima` (`id_imagen`, `id_idioma`,`idma_nombre`) VALUES " .
            " ('" . $id_generado . "'" . " ,'" . $rowi['id_idioma'] . "'" . " ,'" .
            sql_seguro($_POST['idioma']) . "')";

        $insertmatrix = $db->prepare($sql);
        $insertmatrix->execute();
        //$id_generado = $insertmatrix->insert_id;
        $insertmatrix->close();

        if ($_FILES['img']['name'] != "")
        {
            $aux = explode(".", $_FILES['img']['name']);
            $nombre_archivo = $id_generado . "." . $aux[count($aux) - 1];
            copy($_FILES['img']['tmp_name'], "../imagenes/idioma/{$rowi['id_idioma']}/" . $nombre_archivo);

            include_once ('thumbnail.inc.php');
            //grandes
            $thumb = new Thumbnail("../imagenes/idioma/{$rowi['id_idioma']}/" . $nombre_archivo);
            if ($thumb->getCurrentHeight() > $alto)
            {
                $thumb->resize(0, $alto);
                //$thumb->crop(0,0,720,252);
                $thumb->save("../imagenes/idioma/{$rowi['id_idioma']}/" . $nombre_archivo);
                $thumb->destruct();

            }

            $thumb = new Thumbnail("../imagenes/idioma/{$rowi['id_idioma']}/" . $nombre_archivo);
            if ($thumb->getCurrentWidth() > $ancho)
            {
                $thumb->resize($ancho, 0);
                //$thumb->crop(0,0,720,252);
                $thumb->save("../imagenes/idioma/{$rowi['id_idioma']}/" . $nombre_archivo);
                $thumb->destruct();

            }
            $sql = "UPDATE idima set idma_imagen='" . $nombre_archivo .
                "' where id_imagen='" . $id_generado . "'";

            $updatecontenido = $db->prepare($sql);
            $updatecontenido->execute();
            $updatecontenido->close();
        }


    }

?>
    
	<script>window.location="<?=

    $_SERVER['PHP_SELF']

?>?msg=1";</script>

<?

}

?>


<?

if ($op == "3")
{
    //Se Eliminan todas los Archivos Relacionados con el Modulo.
    //rm_recursive("../imagenes/idioma/{$_POST['idb']}");

    $db->select("idima","*"," WHERE id_idma='" . $_GET['idb'] . "'");
    $row = $db->fetch_assoc();

    $db->delete("idima","where id_imagen='" . $row['id_imagen'] . "'");

    $db->delete("imagen","where id_imagen='" . $row['id_imagen'] . "'");

?>
   
    <script>window.location="<?=

    $_SERVER['PHP_SELF']

?>";</script>

<?

}

?>
<?

if ($id <> "")
{
    $op = 1;
} else
{
    $op = 2;
}

?>
    <div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
<?php

include ('menu_izq.php');

?>
		
		<div id="main-content"> <!-- Main Content Section with everything -->
			
			<div id="miga">
              <noscript><!-- Show a notification if the user has disabled javascript -->
				<div class="notification error png_bg">
					<div>
                      <?php

$valor = variable(22, 2);
echo $valor[1];

?>
</div>
			  </div>
			  </noscript>
              

<?

if ($msg <> "")
{
    if ($msg == "1")
    {
        $valor = variable(16, 2);
        $msg = $valor[0];
    }
    if ($msg == "2")
    {
        $valor = variable(17, 2);
        $msg = $valor[0];
    }
    if ($msg == "3")
    {
        $valor = variable(18, 2);
        $msg = $valor[0];
    }
    if ($msg == "4")
    {
        $valor = variable(19, 2);
        $msg = $valor[0];
    }

?>
<div class="notification success png_bg">
<a href="#" class="close"><img src="imgs/cross_grey_small.png" title="Close this notification" alt="close" /></a>
<div>
<?php

    echo $msg

?></div>
</div>
<?php

}

?>
<p class="punteado"><strong>
<?php

$valor = variable(8, 2);
echo $valor[0];

?>&nbsp;   
<?php

echo $_SESSION['nombre_usuario']

?></strong></p>
			  <div class="miga">
            	
                <a href="panel.php"><?php

$valor = variable(9, 2);
echo $valor[0];

?></a>  <a href="#" class="flecha_miga"><?php

echo $modulo

?></a>   <a href="<?=

$_SERVER['PHP_SELF']

?>?idr=<?php

echo $idr

?>" class="flecha_miga"><?php

$valor = variable(3, 2);
echo $valor[0];

?> <?php

echo $modulo

?></a> 
            
            <div class="clear"></div>
            <h2><?php

if ($id)
{
    $valor = variable(2, 2);
    echo $valor[0];
} else
{
    $valor = variable(3, 2);
    echo $valor[0];
}

?> <span class="urgente"><?php

echo $modulo

?> <?

$db->select("idima INNER JOIN idioma ON idioma.id_idioma = idima.id_idioma","*"," where id_idma='" . $_GET['id'] . "'");
$row = $db->fetch_assoc();
?> <?=

$row["idioma"];

?></span></h2>
              </div>
			  <div class="clear"></div>
			  <!-- End .clear -->
			
              <div class="notification attention png_bg">
				<a href="#" class="close"><img src="imgs/cross_grey_small.png" title="Close this notification" alt="close" /></a>
				<div>
                  <?php

$valor = variable(38, 2);
echo $valor[1];

?>
			    .</div>
			  </div>
              </div>
			
			
			
			
		  <div class="clear"></div> <!-- End .clear -->
			
			<div class="content-box"><!-- Start Content Box -->
				
				<div class="content-box-header">
					
					<h3 class="img_idiom"><?php

echo $modulo

?> <?php echo $row["idioma"];  ?></h3>
					
					<!--<ul class="content-box-tabs">
						<li><a href="#tab1" class="default-tab">Table</a></li> <!-- href must be unique and match the id of target div 
						<li><a href="#tab2">Forms</a></li>
					</ul>-->
					
					<div class="clear"></div>
					
					
					
			  </div> <!-- End .content-box-header -->
				
				<div class="content-box-content"><!-- End #tab1 -->
					
                    
                  <form action="<?=

$_SERVER['PHP_SELF']

?>?op=<?php

echo $op

?>&amp;idr=<?=

$idr

?>" method="post" enctype="multipart/form-data" name="usuarios" id="usuarios">
							
					<fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
								
<p>
									<label>
                                    <?php

$valor = variable(10, 2);
echo $valor[0];

?>
            <?php

echo $modulo

?></label>
									<input name="idioma" type="text" class="text-input small-input"  id="idioma" value="<?=

$row["idma_nombre"]

?>" size="32" />
</p>
  
  
  

  
  
  
                                                           
								
                                    
<p>
									<label> <?php

$valor = variable(41, 2);
echo $valor[0];

?> <?php

echo $modulo

?></label>
			<input name="img" type="file" class="text-input small-input" id="img" /> 
			<?php

if ($row['idma_imagen'] <> "")
{

?>
                              <img src="../imagenes/idioma/<?php

    echo $row['id_idioma']

?>/<?=

    $row['idma_imagen']

?>" width="40" />
                              <?php

}

?>
                    (<?=

getMaxUpload()

?>mb max)</p>  								
							
								
								
							
								
						
								
								
								
	  <p>
									<input class="button" type="submit" value="<?php

if ($id)
{
    $valor = variable(2, 2);
    echo $valor[0];
} else
{
    $valor = variable(3, 2);
    echo $valor[0];
}

?> <?php

echo $modulo

?>" /> <input name="id" type="hidden" id="id" value="<?=

$row["id_idma"]

?>" />

<input name="idi" type="hidden" id="idi" value="<?=

$row["id_idioma"]

?>" />
<br />

                                   
                                    
								</p>
								
				    </fieldset><!-- End .clear -->
							
				  </form>
                    
                
                
                
                
                
                
 <!-- inicio lista -->  
<div class="clear"></div> <!-- End .clear -->
<div class="content-box"><!-- Start Content Box -->
				
				<div class="content-box-header">
					
					<h3 class="titu_secc">
					  <?php

$valor = variable(11, 2);
echo $valor[0];

?>
				    <a href="#" title="title" class="txt_verde"><?php

echo $modulo

?></a></h3>
					
				
					
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
						
				  <table>
							
							<tfoot>
								<tr>
									<td colspan="5"> 
								  <!-- End .pagination --></td>
							  </tr>
							</tfoot>
						 
							<tbody>
                            
   <tr>
<td valign="top"><a href="#" title="title" class="txt_verde">
									 <?php

$valor = variable(10, 2);
echo $valor[0];

?>
            <?php

echo $modulo

?></a></td>

									
									
					<td class="txt_verde"></td>
<td valign="top"><?php

$valor = variable(14, 2);
echo $valor[0];

?></td>
							  </tr>                         
<?php

$TAMANO_PAGINA = $_SESSION['paginador'];
$inicio = 0;
$pagina = 1;
$texto = "";
if ($_SESSION['pag'])
{
    $pagina = $_SESSION['pag'];
    $inicio = ($pagina - 1) * $TAMANO_PAGINA;

}

$db->select($t1,"*"," order by  idioma asc");
$num_total_registros = $db->num_rows();

//calculo el total de p&aacute;ginas
$total_paginas = ceil($num_total_registros / $TAMANO_PAGINA);

$db->select($t1,"*"," order by  idioma asc". " limit " . $inicio . "," . $TAMANO_PAGINA);

//echo $sql;
$loop = 0;
$cpadre = array();

/*$db->last_query();*/
while ($arraypadre = $db->fetch_array()) {
    $cpadre[] = $arraypadre; 
}
foreach ($cpadre as $row) {
?>
                            
								<tr>
									<td valign="top"><a href="#" title="<?php

    echo $row['nombre_usuario']

?>" class="txt_ingresar">
									  <?php

    echo $row['idioma']

?>
									</a></td>
									
									
									<td>

</td>
<td valign="top">&nbsp;</td>

							  </tr>
                              
                              
<?php

    //inserto en idmo cuantos modulos existan

    $cpadre = array();
    $db->select("idima","*","where id_idioma={$row['id_idioma']}");
    /*$db->last_query();*/
    while ($arraypadre = $db->fetch_array()) {
        $cpadre[] = $arraypadre; 
    }
    foreach ($cpadre as $rowi) { 

?>                              
<tr>
									<td valign="top">
			<?php

if ($rowi['idma_imagen'] <> "")
{

?>
                              <img src="../imagenes/idioma/<?php

    echo $rowi['id_idioma']

?>/<?=

    $rowi['idma_imagen']

?>" width="40" />
                              <?php

}

?>                                    
                                    
                                    </td>
									
									
									<td>
	  <?php

        echo $rowi['idma_nombre'];

?></td>
      <td>
      										<!-- Icons -->
										 <a class=Ntooltip href="<?=

        $_SERVER['PHP_SELF']

?>?id=<?=

        $rowi['id_idma']

?>&amp;op=4" title="Edit"><img src="imgs/pencil.png" alt="Edit" />
<span>
<?php

        $valor = variable(2, 2);
        echo $valor[0];

?> <?=

        $modulo;

?>
</span>                                         </a>
<a class=Ntooltip href="javascript:deletex('<?=

        $rowi['id_idma']

?>')" title="Delete"><img src="imgs/cross.png" alt="Delete" /><span>
<?php

        $valor = variable(1, 2);
        echo $valor[0];

?>  <?=

        $modulo;

?>
</span></a>	


      </td>
							  </tr>
                              
 <?php

    }

?>                             
                              
                               <?php

}

?>






							</tbody>
					  </table>
                      
                      <div class="pagination">
											
										    <?

if (($total_paginas > 1))
{

?>
       
          <?

    if ($pagina != 1)
    {

?>
          <a href='<?=

        $_SERVER['PHP_SELF']

?>?pg=<?=

        ($pagina - 1)

?>' title="<?php

        $valor = variable(12, 2);
        echo $valor[0];

?>"><?php

        $valor = variable(12, 2);
        echo $valor[0];

?></a>
          <?

    }

?>
      
      
      
      
      
      
      
      
    
    <?

    for ($i = 1; $i <= $total_paginas; $i++)
    {

        if ($pagina == $i)
        {

?>
        
       <a href='#' class="number current" title="<?=

            $pagina

?>"> <?=

            $pagina

?></a>
        
        <?

        } else
        {

?>
        <a href='<?=

            $_SERVER['PHP_SELF']

?>?pg=<?=

            $i

?>' class="number" title="<?=

            $i

?>">
        <?=

            $i

?>
         </a>
        <?

        }

?>
        <?

    }

?>
        
        
        
        
        
        
    
    
    
    
      <?

    if ($total_paginas != $pagina)
    {

?>
      <a href='<?=

        $_SERVER['PHP_SELF']

?>?pg=<?=

        ($pagina + 1)

?>' title="<?php

        $valor = variable(13, 2);
        echo $valor[0];

?>"><?php

        $valor = variable(13, 2);
        echo $valor[0];

?></a>
      <?

    }

?>
      <?

}

?>
      <br />
						</div>
						
				  </div> 
                  
                  
			<form name="form" id="form">
  <?php

$valor = variable(15, 2);
echo $valor[0];

?>:
    <select name="jumpMenu" id="jumpMenu" onChange="MM_jumpMenu('parent',this,0)">
   <option value=""><?php

$valor = variable(27, 2);
echo $valor[0];

?></option>
   <?

$cpadre = array();
$db->select("pagina","*");
/*$db->last_query();*/
while ($arraypadre = $db->fetch_array()) {
    $cpadre[] = $arraypadre; 
}
foreach ($cpadre as $row) { 
?>
 <?php

    if ($row["numero"] == $_SESSION['pagina'])
    {

?>
<option value="<?=

        $_SERVER['PHP_SELF']

?>?paginar=<?php

        echo utf8_encode($row['numero'])

?>&idr=<?php

        echo $idr

?>" selected="selected">
<?php

        echo utf8_encode($row['numero'])

?>
<?php

    } else
    {

?>
 <option value="<?=

        $_SERVER['PHP_SELF']

?>?paginar=<?php

        echo utf8_encode($row['numero'])

?>&idr=<?php

        echo $idr

?>">
<?php

        echo utf8_encode($row['numero'])

?>
</option>
 <?php

    }

?>



<?

}

?>

  </select>
</form>
				  <!-- End>
				  <!-- End #tab1 -->
					
				      
					
				</div> <!-- End .content-box-content -->
				
			</div>  
             <!-- fin lista -->   
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                    
					      
					
			  </div> <!-- End .content-box-content -->
				
			</div> <!-- End .content-box --><!-- End .content-box --><!-- End .content-box --><!-- Start Notifications --><!-- End Notifications -->
		    <?php

include ('pie.php');

?>
		</div> 
		<!-- End #main-content -->
		
	</div></body>
  <script language="javascript">
function deletex(id){
	if(confirm("<?php

$valor = variable(43, 2);
echo $valor[0];

?>")) {
		window.location="<?=

$_SERVER['PHP_SELF']

?>?op=3&idb=" + id;
	}
}
    </script>
</html>

