<?php include ('../lib/funciones.php'); ?>
<?php include ('include_mysqli.php'); ?>
<?php

  $id = $_GET['id'];
  $idr = $_GET['idr'];
  $op = $_GET['op'];
  $t1 = "idmo";
  if ($id) {
    //identifico modulo 

    $db->select("idmo, idioma","idmo.nombre_idmo, idioma.idioma","where idmo.idioma=idioma.id_idioma and id_idmo='" . $_GET['id'] . "'");
    $row = $db->fetch_assoc();
    /*$db->last_query();*/
    $modulo= $row["nombre_idmo"]. " " .$row["idioma"];
  }
  if ($op == "1") {
    $sql = "UPDATE $t1 SET nombre_idmo='" . sql_seguro($_POST['nombre_idmo']). "' WHERE id_idmo= '" . sql_seguro($_POST['id']) . "'";
    $updatecontenido = $db->prepare($sql);
    $updatecontenido->execute();
    $updatecontenido->close();

?>    
  <script>window.location="<?= $_SERVER['PHP_SELF'] ?>?msg=2";</script>
<?php
    exit;
  }
?>





<?php
if ($op == "2") {
    $sql = "INSERT INTO $t1(nombre_idmo, modulo, idioma) VALUES";
    $sql = $sql . " ('" . sql_seguro($_POST['nombre_idmo']) . "'";
    $sql = $sql . " ,'" . sql_seguro($_POST['modulo']) . "'";
    $sql = $sql . " ,'" . sql_seguro($_POST['idioma']) . "')";
    //echo $sql;

    $insertmatrix = $db->prepare($sql);
    $insertmatrix->execute();
    $id_generado = $insertmatrix->insert_id;
    $insertmatrix->close();
	?>
    
<script>window.location="<?= $_SERVER['PHP_SELF'] ?>?msg=1";</script>

<?php 
}
?>


<?php
  if ($op == "3") {

    $db->delete($t1,"where id_idmo='" . $_GET['idb'] . "'");   
?>
   
<script>window.location="<?= $_SERVER['PHP_SELF'] ?>";</script>

<?php
  }
?>

<?php

  modulos();

  if ($id <> "") {
      $op = 1;
  } else {
      $op = 2;
  }
?>
    <div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
<?php include ('menu_izq.php'); ?>
		
		<div id="main-content"> <!-- Main Content Section with everything -->
			
			<div id="miga">
              <noscript><!-- Show a notification if the user has disabled javascript -->
				<div class="notification error png_bg">
					<div>
                      <?php $valor = variable(22, 2);
echo $valor[1]; ?>
</div>
			  </div>
			  </noscript>
              

<? if ($msg <> "") {
    if ($msg == "1") {
        $valor = variable(16, 2);
        $msg = $valor[0];
    }
    if ($msg == "2") {
        $valor = variable(17, 2);
        $msg = $valor[0];
    }
    if ($msg == "3") {
        $valor = variable(18, 2);
        $msg = $valor[0];
    }
    if ($msg == "4") {
        $valor = variable(19, 2);
        $msg = $valor[0];
    }
?>
<div class="notification success png_bg">
<a href="#" class="close"><img src="imgs/cross_grey_small.png" title="Close this notification" alt="close" /></a>
<div>
<?php echo $msg ?></div>
</div>
<?php } ?>
<p class="punteado"><strong>
<?php $valor = variable(8, 2);
echo $valor[0]; ?>&nbsp;   
<?php echo $_SESSION['nombre_usuario'] ?></strong></p>
			  <div class="miga">
            	
                <a href="panel.php"><?php $valor = variable(9, 2);
echo $valor[0]; ?></a>  <a href="#" class="flecha_miga"><?php echo $modulo; ?></a>   <a href="<?= $_SERVER['PHP_SELF'] ?>?idr=<?php echo $idr ?>" class="flecha_miga"><?php $valor = variable(3, 2);
echo $valor[0]; ?> <?php echo $modulo ?></a>
            
            <div class="clear"></div>
            <h2><?php if ($id) {
    $valor = variable(2, 2);
    echo $valor[0];
} else {
    $valor = variable(3, 2);
    echo $valor[0];
} ?> <span class="urgente">
<?php echo $modulo; ?> 
<?php

  $db->select($t1,"*"," where id_idmo='" . $_GET['id'] . "'");
  $row = $db->fetch_assoc();
?> 
<?php echo $row["nombre_idmo"]; ?></span></h2>
              </div>
			  <div class="clear"></div>
			  <!-- End .clear -->
			
              <div class="notification attention png_bg">
				<a href="#" class="close"><img src="imgs/cross_grey_small.png" title="Close this notification" alt="close" /></a>
				<div>
                  <?php $valor = variable(45, 2);
echo $valor[1]; ?></div>
			  </div>
              </div>
			
			
			
			
		  <div class="clear"></div> <!-- End .clear -->
			
			<div class="content-box"><!-- Start Content Box -->
				
				<div class="content-box-header">
					
					<h3 class="img_modulo"><?php echo $modulo; ?></h3>
					
					<!--<ul class="content-box-tabs">
						<li><a href="#tab1" class="default-tab">Table</a></li> <!-- href must be unique and match the id of target div 
						<li><a href="#tab2">Forms</a></li>
					</ul>-->
					
					<div class="clear"></div>
					
			  </div> <!-- End .content-box-header -->
				
				<div class="content-box-content"><!-- End #tab1 -->
					
               <?php if ($_GET['op']==4){?>     
                  <form action="<?= $_SERVER['PHP_SELF'] ?>?op=<?php echo $op ?>&amp;idr=<?= $idr ?>" method="post" enctype="multipart/form-data" name="usuarios" id="usuarios">
							
					<fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
								
<p>
									<label>
                                    <?php $valor = variable(10, 2);
echo $valor[0]; ?>
            <?php echo $modulo; ?></label>
									<input name="nombre_idmo" placeholder="Nombre Modulo" type="text" class="text-input small-input" required=""  id="nombre_idmo" value="<?= $row["nombre_idmo"] ?>" size="32" />
</p>

          
  
								
<p>
									<input class="button" type="submit" value="<?php if ($id) {
    $valor = variable(2, 2);
    echo $valor[0];
} else {
    $valor = variable(3, 2);
    echo $valor[0];
} ?> <?php echo $modulo ?>" /> <input name="id" type="hidden" id="id" value="<?= $row["id_idmo"] ?>" />
<br />

                                   
                                    
								</p>
								
				    </fieldset><!-- End .clear -->
							
				  </form>
                    
         <?php  }?>      
                
                
                
                
                
 <!-- inicio lista -->  
<div class="clear"></div> <!-- End .clear -->
<div class="content-box"><!-- Start Content Box -->
				
				<div class="content-box-header">
					
					<h3 class="titu_secc">
					  <?php $valor = variable(11, 2);
echo $valor[0]; ?>
				    <a href="#" title="title" class="txt_verde"><?php echo $modulo ?></a></h3>
					
				
					
				  <div class="clear"></div>
					
				</div> <!-- End .content-box-header -->
				
				<div class="content-box-content">
					
				  <?php

            $cpadre = array();
            $db->select("idioma","*","order by id_idioma asc");
            /*$db->last_query();*/
            while ($arraypadre = $db->fetch_array()) {
              $cpadre[] = $arraypadre; 
            }
            foreach ($cpadre as $row5) {
          ?>
                      
                  <div class="tab-content default-tab" id="tab1">
                        <!-- This is the target div. id must match the href of this div's tab -->
                        <!--<div class="notification attention png_bg">
							<a href="#" class="close"><img src="imgs/cross_grey_small.png" title="Close this notification" alt="close" /></a>
							<div>
								This is a Content Box. You can put whatever you want in it. By the way, you can close this notification with the top-right cross.
							</div>
						</div>-->
                        <span class="destacado_verde"><?php echo $row5['idioma'];?></span>
                        <table>
                          <tfoot>
                            <tr>
                              <td colspan="5"><!-- End .pagination --></td>
                            </tr>
                          </tfoot>
                          <tbody>
                            <tr>
                              <td valign="top"><a href="#" title="title" class="txt_verde">
                                <?php $valor = variable(10, 2);
echo $valor[0]; ?>
                              </a></td>
                              <td><a href="#" title="title" class="txt_ingresar"><span class="txt_verde">
                                <?php $valor = variable(140, 2);
echo $valor[0]; ?>
                                &nbsp; </span></a></td>
                              <td class="txt_verde"><?php $valor = variable(14, 2);
echo $valor[0]; ?></td>
                            </tr>
                            <?php
$TAMANO_PAGINA = $_SESSION['paginador'];
$inicio = 0;
$pagina = 1;
$texto = "";
if ($_SESSION['pag']) {
    $pagina = $_SESSION['pag'];
    $inicio = ($pagina - 1) * $TAMANO_PAGINA;

}


$db->select($t1,"*","where idioma='".$row5['id_idioma']."'  order by  nombre_idmo asc");

$num_total_registros = $db->num_rows();
//calculo el total de p&aacute;ginas
$total_paginas = ceil($num_total_registros / $TAMANO_PAGINA);


//echo $sql;
$cpadre = array();
$db->select($t1,"*","where idioma='".$row5['id_idioma']."'  order by  nombre_idmo asc". " limit " . $inicio . "," . $TAMANO_PAGINA);

$loop = 0;
  while ($arraypadre = $db->fetch_array()) {
    $cpadre[] = $arraypadre; 
  }
  foreach ($cpadre as $row) {
?>
                            <tr>
                              <td width="200" valign="top"><a href="#" title="<?php echo $row['nombre_modulo'] ?>" class="txt_ingresar"> <?php echo $row['nombre_idmo'] ?></a>
                                <?php
                                    $db->select("modulo","*"," where id_modulo='" . $row['modulo'] ."'");
                                    $rowx = $db->fetch_assoc();
                                ?>
                             
                                
                                </td>
                              <td width="200"><a href="#" title="<?= $rowx["nombre_modulo"] ?>" ><?= $rowx["nombre_modulo"] ?></a></td>
                              <td width="200"><!-- Icons -->
                                <a class=Ntooltip href="<?= $_SERVER['PHP_SELF'] ?>?id=<?= $row['id_idmo'] ?>&amp;op=4&idioma=<?= $row['idioma'] ?>" title="Edit"><?php $valor = variable(2, 2);
    echo $valor[0]; ?><img src="imgs/pencil.png" alt="Edit" /> <span>
                                  <?php $valor = variable(2, 2);
    echo $valor[0]; ?>
                                  <?php echo $modulo; ?>
                                  </span></a> 
                                  

<?php if ( $rowx["nivel_modulo"]>0) {?><a class=Ntooltip href="categoria.php?idr=<?= $row['id_idmo'] ?>&nivel=<?php echo $rowx["nivel_modulo"] ?>&op=4" title="<?php $valor = variable(159, 2);  echo $valor[0]; ?> <?= $modulo; ?>"><?php $valor = variable(159, 2);
echo $valor[0]; ?><img src="imgs/information.png" alt="Edit" /> <span>
                                      <?php $valor = variable(159, 2);  echo $valor[0]; ?><?= $modulo; ?></span></a><?php }?>
                                      
                                      
                                      </td>
                            </tr>
                            <?php } ?>
                          </tbody>
                        </table>
                      </div>
<?php } ?>
                  <!-- End>
				  <!-- End #tab1 -->
					
				      
					
			  </div> <!-- End .content-box-content -->
				
			</div>  
             <!-- fin lista -->   
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                    
					      
					
			  </div> <!-- End .content-box-content -->
				
			</div> <!-- End .content-box --><!-- End .content-box --><!-- End .content-box --><!-- Start Notifications --><!-- End Notifications -->
		    <?php include ('pie.php'); ?>
		</div> 
		<!-- End #main-content -->
		
	</div></body>
  <script language="javascript">
function deletex(id){
	if(confirm("<?php $valor = variable(43, 2);
echo $valor[0]; ?>")) {
		window.location="<?= $_SERVER['PHP_SELF'] ?>?op=3&idb=" + id;
	}
}
    </script>
</html>

