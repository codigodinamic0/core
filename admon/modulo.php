<?php include ('../lib/funciones.php'); ?>
<?php include ('include_mysqli.php'); ?>
<?php
$id = $_GET['id'];
$idr = $_GET['idr'];
$op = $_GET['op'];
$t1 = "modulo";
$valor = variable(44, 2);
$modulo = $valor[0];

/*validar*/
$nivel_modulo = $_POST['nivel_modulo'] != "" ? $_POST['nivel_modulo'] : 0;
$codigo_modulo = $_POST['codigo_modulo'] != "" ? $_POST['codigo_modulo'] : 0;
$anchog = $_POST['anchog'] != "" ? $_POST['anchog'] : 0;
$altog = $_POST['altog'] != "" ? $_POST['altog'] : 0;
$anchom = $_POST['anchom'] != "" ? $_POST['anchom'] : 0;
$altom = $_POST['altom'] != "" ? $_POST['altom'] : 0;
$anchop = $_POST['anchop'] != "" ? $_POST['anchop'] : 0;
$altop = $_POST['altop'] != "" ? $_POST['altop'] : 0;
$ancho1g = $_POST['ancho1g'] != "" ? $_POST['ancho1g'] : 0;
$alto1g = $_POST['alto1g'] != "" ? $_POST['alto1g'] : 0;
$ancho1m = $_POST['ancho1m'] != "" ? $_POST['ancho1m'] : 0;
$alto1m = $_POST['alto1m'] != "" ? $_POST['alto1m'] : 0;
$ancho1p = $_POST['ancho1p'] != "" ? $_POST['ancho1p'] : 0;
$alto1p = $_POST['alto1p'] != "" ? $_POST['alto1p'] : 0;
$ancho2g = $_POST['ancho2g'] != "" ? $_POST['ancho2g'] : 0;
$alto2g = $_POST['alto2g'] != "" ? $_POST['alto2g'] : 0;
$ancho2m = $_POST['ancho2m'] != "" ? $_POST['ancho2m'] : 0;
$alto2m = $_POST['alto2m'] != "" ? $_POST['alto2m'] : 0;
$ancho2p = $_POST['ancho2p'] != "" ? $_POST['ancho2p'] : 0;
$alto2p = $_POST['alto2p'] != "" ? $_POST['alto2p'] : 0;
$anchosg = $_POST['anchosg'] != "" ? $_POST['anchosg'] : 0;
$altosg = $_POST['altosg'] != "" ? $_POST['altosg'] : 0;
$anchosp = $_POST['anchosp'] != "" ? $_POST['anchosp'] : 0;
$altosp = $_POST['altosp'] != "" ? $_POST['altosp'] : 0;
/*validar*/

if ($op == "1") {
    $sql = "UPDATE $t1 SET descripcion_modulo='" . sql_seguro($_POST['descripcion_modulo']) .
        "'" . ", nivel_modulo= '" . sql_seguro($nivel_modulo) . "'" .
        ", codigo_modulo= '" . sql_seguro($codigo_modulo) . "'" . ", anchog= '" .
        sql_seguro($anchog) . "'" . ", altog= '" . sql_seguro($altog) .
        "'" . ", anchom= '" . sql_seguro($anchom) . "'" . ", altom= '" .
        sql_seguro($altom) . "'" . ", anchop= '" . sql_seguro($anchop) .
        "'" . ", altop= '" . sql_seguro($altop) . "'" . ", ancho1g= '" .
        sql_seguro($ancho1g) . "'" . ", alto1g= '" . sql_seguro($alto1g) .
        "'" . ", ancho1m= '" . sql_seguro($ancho1m) . "'" . ", alto1m= '" .
        sql_seguro($alto1m) . "'" . ", ancho1p= '" . sql_seguro($ancho1p) .
        "'" . ", alto1p= '" . sql_seguro($alto1p) . "'" . ", ancho2g= '" .
        sql_seguro($ancho2g) . "'" . ", alto2g= '" . sql_seguro($alto2g) .
        "'" . ", ancho2m= '" . sql_seguro($ancho2m) . "'" . ", alto2m= '" .
        sql_seguro($alto2m) . "'" . ", ancho2p= '" . sql_seguro($ancho2p) .
        "'" . ", alto2p= '" . sql_seguro($alto2p) . "'" . ", anchosg= '" .
        sql_seguro($anchosg) . "'" . ", altosg= '" . sql_seguro($altosg) .
        "'" . ", anchosp= '" . sql_seguro($anchosp) . "'" . ", altosp= '" .
        sql_seguro($altosp) . "' WHERE id_modulo= '" . sql_seguro($_POST['id']) .
        "'";

    $updatecontenido = $db->prepare($sql);
    $updatecontenido->execute();
    $updatecontenido->close();


    //ingreso campos al modulo
    $db->delete("moca","where modulo = '" . $_POST['id'] . "'");

    if (isset($_POST['campo'])){
        foreach ($_POST['campo'] as $campo){
            $sql="INSERT INTO moca (modulo,campo) values ('" . $_POST['id'] . "','" .$campo . "')";
            $insertmatrix = $db->prepare($sql);
            $insertmatrix->execute();
            $id_generado = $insertmatrix->insert_id;
            $insertmatrix->close();
        }
    }

?>
    
<script>window.location="<?= $_SERVER['PHP_SELF'] ?>?msg=2";</script>

<?php
    exit;
} ?>





<?php 

if ($op == "2") {


    //Borrado de Todas Las Vistas

    $cpadre = array();
    $db->select("modulo","*");
    /*$db->last_query();*/
    while ($arraypadre = $db->fetch_array()) {
        $cpadre[] = $arraypadre; 
    }
    foreach ($cpadre as $row) {
        if ($_POST['nombre_modulo'] == $row['nombre_modulo']) {
?>
            <script type="text/javascript">
                alert("Modulo Con Este Nombre Ya Existe");
                history.back();
            </script>
            <?php
            exit;
        }
    }


    $sql = "INSERT INTO $t1(nombre_modulo, descripcion_modulo,nivel_modulo, codigo_modulo, anchog, altog, anchom, altom, anchop, altop, ancho1g, alto1g, ancho1m, alto1m, ancho1p, alto1p, ancho2g, alto2g, ancho2m, alto2m, ancho2p, alto2p, anchosg, altosg, anchosp, altosp) VALUES";
    $sql = $sql . " ('" . sql_seguro($_POST['nombre_modulo']) . "'";
    $sql = $sql . " ,'" . sql_seguro($_POST['descripcion_modulo']) . "'";
    $sql = $sql . " ,'" . sql_seguro($nivel_modulo) . "'";
    $sql = $sql . " ,'" . sql_seguro($codigo_modulo) . "'";
    $sql = $sql . " ,'" . sql_seguro($anchog) . "'";
    $sql = $sql . " ,'" . sql_seguro($altog) . "'";
    $sql = $sql . " ,'" . sql_seguro($anchom) . "'";
    $sql = $sql . " ,'" . sql_seguro($altom) . "'";
    $sql = $sql . " ,'" . sql_seguro($anchop) . "'";
    $sql = $sql . " ,'" . sql_seguro($altop) . "'";
    $sql = $sql . " ,'" . sql_seguro($ancho1g) . "'";
    $sql = $sql . " ,'" . sql_seguro($alto1g) . "'";
    $sql = $sql . " ,'" . sql_seguro($ancho1m) . "'";
    $sql = $sql . " ,'" . sql_seguro($alto1m) . "'";
    $sql = $sql . " ,'" . sql_seguro($ancho1p) . "'";
    $sql = $sql . " ,'" . sql_seguro($alto1p) . "'";
    $sql = $sql . " ,'" . sql_seguro($ancho2g) . "'";
    $sql = $sql . " ,'" . sql_seguro($alto2g) . "'";
    $sql = $sql . " ,'" . sql_seguro($ancho2m) . "'";
    $sql = $sql . " ,'" . sql_seguro($alto2m) . "'";
    $sql = $sql . " ,'" . sql_seguro($ancho2p) . "'";
    $sql = $sql . " ,'" . sql_seguro($alto2p) . "'";
    $sql = $sql . " ,'" . sql_seguro($anchosg) . "'";
    $sql = $sql . " ,'" . sql_seguro($altosg) . "'";
    $sql = $sql . " ,'" . sql_seguro($anchosp) . "'";
    $sql = $sql . " ,'" . sql_seguro($altosp) . "')";
    /*echo $sql; exit;*/

    $insertmatrix = $db->prepare($sql);
    $insertmatrix->execute();
    $id_generado = $insertmatrix->insert_id;
    $insertmatrix->close();

    mkdir("../imagenes/" . $_POST['nombre_modulo'], 0777);
    mkdir("../imagenes/" . $_POST['nombre_modulo'] . "/iconos", 0777);
    mkdir("../imagenes/" . $_POST['nombre_modulo'] . "/imagen1", 0777);
    mkdir("../imagenes/" . $_POST['nombre_modulo'] . "/imagen1/mediana", 0777);
    mkdir("../imagenes/" . $_POST['nombre_modulo'] . "/imagen1/pequena", 0777);
    mkdir("../imagenes/" . $_POST['nombre_modulo'] . "/imagen2", 0777);
    mkdir("../imagenes/" . $_POST['nombre_modulo'] . "/imagen2/mediana", 0777);
    mkdir("../imagenes/" . $_POST['nombre_modulo'] . "/imagen2/pequena", 0777);
    mkdir("../imagenes/" . $_POST['nombre_modulo'] . "/imagen3", 0777);
    mkdir("../imagenes/" . $_POST['nombre_modulo'] . "/imagen3/mediana", 0777);
    mkdir("../imagenes/" . $_POST['nombre_modulo'] . "/imagen3/pequena", 0777);
    mkdir("../imagenes/" . $_POST['nombre_modulo'] . "/archivo", 0777);
    mkdir("../imagenes/" . $_POST['nombre_modulo'] . "/mp3", 0777);
    mkdir("../imagenes/" . $_POST['nombre_modulo'] . "/flash", 0777);
    mkdir("../imagenes/" . $_POST['nombre_modulo'] . "/secundaria", 0777);
    mkdir("../imagenes/" . $_POST['nombre_modulo'] . "/secundaria/thumb", 0777);


    //inserto en idmo cuantos modulos existan

    $cpadre = array();
    $db->select("idioma","*");
    /*$db->last_query();*/
    while ($arraypadre = $db->fetch_array()) {
        $cpadre[] = $arraypadre; 
    }
    foreach ($cpadre as $rowi) {
        $sqlw = "INSERT INTO idmo(nombre_idmo, modulo, idioma) values " . " ('" .
            sql_seguro($_POST['nombre_modulo']) . "(" . sql_seguro($rowi['abreviatura_idioma']) .
            ")', '" . sql_seguro($id_generado) . "'" . " ,'" . sql_seguro($rowi['id_idioma']) .
            "')";
        //echo $sql;

        $insertmatrix = $db->prepare($sqlw);
        $insertmatrix->execute();
        $id_idmo = $insertmatrix->insert_id;
        $insertmatrix->close();
    }


    //ingreso campos al modulo
    $db->delete("moca","where modulo = '" . $id_generado . "'");

    if (isset($_POST['campo'])){
        foreach ($_POST['campo'] as $campo){
            $sql="INSERT INTO moca (modulo,campo) values ('" . $id_generado . "','" .$campo . "')";
            $insertmatrix = $db->prepare($sql);
            $insertmatrix->execute();
            $insertmatrix->close();
        }
    }
?>
    
<script>window.location="<?= $_SERVER['PHP_SELF'] ?>?msg=1";</script>

<? } ?>


<? if ($op == "3") {

    $cpadre = array();
    $db->select("modulo","*","where id_modulo='" . $_GET['idb'] . "'");
    /*$db->last_query();*/
    while ($arraypadre = $db->fetch_array()) {
        $cpadre[] = $arraypadre; 
    }
    foreach ($cpadre as $row) {
        //Se Elimina la Vista de Modulo.
        
        $sqlbv = "DROP VIEW IF EXISTS v{$row['nombre_modulo']}";

        $db->consulta_s($sqlbv);

        //Se Eliminan todas los Archivos Relacionados con el Modulo.
        rm_recursive("../imagenes/{$row['nombre_modulo']}");
    }

    //Se eliminan las Categorias Relacionadas con el idmo

    $db->delete("categoria","WHERE modulo in(SELECT
            idmo.id_idmo
            FROM
            idmo WHERE modulo='" . $_GET['idb'] . "'
            )");
    

    //se eliminan las secundarias relacionadas a la  matrix

    $db->delete("secundaria", "WHERE idr in(SELECT
            matrix.id_matrix
            FROM
            idmo
            INNER JOIN matrix ON idmo.id_idmo = matrix.id_idmo
            WHERE modulo='" . $_GET['idb'] . "'
            )");

    

    //Se eliminan las matrices que tiene relacionado un id_mo qe asu ves estan relacionados con el modulo 

    $db->delete("matrix","where id_idmo IN (SELECT id_idmo FROM idmo WHERE modulo='" .$_GET['idb'] . "')");


    //Se Eliminan el Modulo

    $db->delete($t1,"where id_modulo='" . $_GET['idb'] . "'");

    //elimino modulos relacionados con este idioma

    $db->delete("idmo","where modulo='" . $_GET['idb'] . "'");

    //elimino campos relacionados con este modulo

    $db->delete("moca","where modulo='" . $_GET['idb'] . "'");

    //elimino campos relacionados con este modulo
 
    $db->delete("mtipo","where id_modulo='" . $_GET['idb'] . "'");

?>
   
<script>window.location="<?= $_SERVER['PHP_SELF'] ?>";</script>

<? } ?>
<?

modulos();

if ($id <> "") {
    $op = 1;
} else {
    $op = 2;
} ?>
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
echo $valor[0]; ?></a>  <a href="#" class="flecha_miga"><?php echo $modulo ?></a>   <a href="<?= $_SERVER['PHP_SELF'] ?>?idr=<?php echo
$idr ?>" class="flecha_miga"><?php $valor = variable(3, 2);
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

    $db->select($t1,"*"," where id_modulo='" .$_GET['id'] . "'");
    $row = $db->fetch_assoc();
?> <?php echo $row["nombre_modulo"]; ?></span></h2>
              </div>
			  <div class="clear"></div>
			  <!-- End .clear -->
			
              <div class="notification attention png_bg">
				<a href="#" class="close"><img src="imgs/cross_grey_small.png" title="Close this notification" alt="close" /></a>
				<div>
                  <?php $valor = variable(45, 2);
echo $valor[1]; ?>
			    .</div>
			  </div>
              </div>
			
			
			
			
		  <div class="clear"></div> <!-- End .clear -->
			
			<div class="content-box"><!-- Start Content Box -->
				
				<div class="content-box-header">
					
					<h3 class="img_modulo"><?php echo $modulo ?></h3>
					
					<!--<ul class="content-box-tabs">
						<li><a href="#tab1" class="default-tab">Table</a></li> <!-- href must be unique and match the id of target div 
						<li><a href="#tab2">Forms</a></li>
					</ul>-->
					
					<div class="clear"></div>
					
			  </div> <!-- End .content-box-header -->
				
				<div class="content-box-content"><!-- End #tab1 -->
					
                    
                  <form action="<?= $_SERVER['PHP_SELF'] ?>?op=<?php echo $op ?>&amp;idr=<?= $idr ?>" method="post" enctype="multipart/form-data" name="usuarios" id="usuarios">
							
					<fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
								
<p>
									<label>
                                    <?php $valor = variable(10, 2);
echo $valor[0]; ?>
            <?php echo $modulo ?></label>
									<input name="nombre_modulo" placeholder="Nombre Modulo" type="text" class="text-input small-input" required=""  id="nombre_modulo" value="<?= $row["nombre_modulo"] ?>" size="32" />
</p>


<p>
			  <label>
                                    <?php $valor = variable(125, 2);
echo $valor[0]; ?>
            <?php echo $modulo ?></label>
									<input name="nivel_modulo" type="text" class="text-input small-input"  id="nivel_modulo" value="<?= $row["nivel_modulo"] ?>" size="32" />
</p>
<p>
			  <label>
                                    <?php $valor = variable(146, 2);
echo $valor[0]; ?>
              <?php echo $modulo ?></label>
									<input name="codigo_modulo" type="text" class="text-input small-input"  id="codigo_modulo" value="<?= $row["codigo_modulo"] ?>" size="32" />
</p>

<p>
			  <label>
                                    <?php $valor = variable(129, 2);
echo $valor[0]; ?>  <?php $valor = variable(131, 2);
echo $valor[0]; ?> <?php $valor = variable(126, 2);
echo $valor[0]; ?>
            <?php echo $modulo ?></label>
									<input name="anchog" type="text" class="text-input small-input"  id="anchog" value="<?= $row["anchog"] ?>" size="32" />
</p>

<p>
			  <label>
                                    <?php $valor = variable(130, 2);
echo $valor[0]; ?>  <?php $valor = variable(131, 2);
echo $valor[0]; ?> <?php $valor = variable(126, 2);
echo $valor[0]; ?>
            <?php echo $modulo ?></label>
									<input name="altog" type="text" class="text-input small-input"  id="altog" value="<?= $row["altog"] ?>" size="32" />
</p>


<p>
			  <label>
                                    <?php $valor = variable(129, 2);
echo $valor[0]; ?>  <?php $valor = variable(131, 2);
echo $valor[0]; ?> <?php $valor = variable(127, 2);
echo $valor[0]; ?>
            <?php echo $modulo ?></label>
									<input name="anchom" type="text" class="text-input small-input"  id="anchom" value="<?= $row["anchom"] ?>" size="32" />
</p>


<p>
			  <label>
                                    <?php $valor = variable(130, 2);
echo $valor[0]; ?>  <?php $valor = variable(131, 2);
echo $valor[0]; ?> <?php $valor = variable(127, 2);
echo $valor[0]; ?>
            <?php echo $modulo ?></label>
									<input name="altom" type="text" class="text-input small-input"  id="altom" value="<?= $row["altom"] ?>" size="32" />
</p>
<p>
			  <label>
                                    <?php $valor = variable(129, 2);
echo $valor[0]; ?>  <?php $valor = variable(131, 2);
echo $valor[0]; ?> <?php $valor = variable(128, 2);
echo $valor[0]; ?>
            <?php echo $modulo ?></label>
									<input name="anchop" type="text" class="text-input small-input"  id="anchop" value="<?= $row["anchop"] ?>" size="32" />
</p>


<p>
			  <label>
                                    <?php $valor = variable(130, 2);
echo $valor[0]; ?>  <?php $valor = variable(131, 2);
echo $valor[0]; ?> <?php $valor = variable(128, 2);
echo $valor[0]; ?>
            <?php echo $modulo ?></label>
									<input name="altop" type="text" class="text-input small-input"  id="altop" value="<?= $row["altop"] ?>" size="32" />
</p>


<p>
			  <label>
                                    <?php $valor = variable(129, 2);
echo $valor[0]; ?>  <?php $valor = variable(132, 2);
echo $valor[0]; ?> <?php $valor = variable(126, 2);
echo $valor[0]; ?>
            <?php echo $modulo ?></label>
									<input name="ancho1g" type="text" class="text-input small-input"  id="ancho1g" value="<?= $row["ancho1g"] ?>" size="32" />
</p>


<p>
			  <label>
                                    <?php $valor = variable(130, 2);
echo $valor[0]; ?>  <?php $valor = variable(132, 2);
echo $valor[0]; ?> <?php $valor = variable(126, 2);
echo $valor[0]; ?>
            <?php echo $modulo ?></label>
									<input name="alto1g" type="text" class="text-input small-input"  id="alto1g" value="<?= $row["alto1g"] ?>" size="32" />
</p>


<p>
			  <label>
                                    <?php $valor = variable(129, 2);
echo $valor[0]; ?>  <?php $valor = variable(132, 2);
echo $valor[0]; ?> <?php $valor = variable(127, 2);
echo $valor[0]; ?>
            <?php echo $modulo ?></label>
									<input name="ancho1m" type="text" class="text-input small-input"  id="ancho1m" value="<?= $row["ancho1m"] ?>" size="32" />
</p>

<p>
			  <label>
                                    <?php $valor = variable(130, 2);
echo $valor[0]; ?>  <?php $valor = variable(132, 2);
echo $valor[0]; ?> <?php $valor = variable(127, 2);
echo $valor[0]; ?>
            <?php echo $modulo ?></label>
									<input name="alto1m" type="text" class="text-input small-input"  id="alto1m" value="<?= $row["alto1m"] ?>" size="32" />
</p>

<p>
			  <label>
                                    <?php $valor = variable(129, 2);
echo $valor[0]; ?>  <?php $valor = variable(132, 2);
echo $valor[0]; ?> <?php $valor = variable(128, 2);
echo $valor[0]; ?>
            <?php echo $modulo ?></label>
									<input name="ancho1p" type="text" class="text-input small-input"  id="ancho1p" value="<?= $row["ancho1p"] ?>" size="32" />
</p>

<p>
			  <label>
                                    <?php $valor = variable(130, 2);
echo $valor[0]; ?>  <?php $valor = variable(132, 2);
echo $valor[0]; ?> <?php $valor = variable(128, 2);
echo $valor[0]; ?>
            <?php echo $modulo ?></label>
									<input name="alto1p" type="text" class="text-input small-input"  id="alto1p" value="<?= $row["alto1p"] ?>" size="32" />
</p>

<p>
			  <label>
                                    <?php $valor = variable(129, 2);
echo $valor[0]; ?>  <?php $valor = variable(133, 2);
echo $valor[0]; ?> <?php $valor = variable(126, 2);
echo $valor[0]; ?>
            <?php echo $modulo ?></label>
									<input name="ancho2g" type="text" class="text-input small-input"  id="ancho2g" value="<?= $row["ancho2g"] ?>" size="32" />
</p>


<p>
			  <label>
                                    <?php $valor = variable(130, 2);
echo $valor[0]; ?>  <?php $valor = variable(133, 2);
echo $valor[0]; ?> <?php $valor = variable(126, 2);
echo $valor[0]; ?>
            <?php echo $modulo ?></label>
									<input name="alto2g" type="text" class="text-input small-input"  id="alto2g" value="<?= $row["alto2g"] ?>" size="32" />
</p>

<p>
			  <label>
                                    <?php $valor = variable(129, 2);
echo $valor[0]; ?>  <?php $valor = variable(133, 2);
echo $valor[0]; ?> <?php $valor = variable(127, 2);
echo $valor[0]; ?>
            <?php echo $modulo ?></label>
									<input name="ancho2m" type="text" class="text-input small-input"  id="ancho2m" value="<?= $row["ancho2m"] ?>" size="32" />
</p>

<p>
			  <label>
                                    <?php $valor = variable(130, 2);
echo $valor[0]; ?>  <?php $valor = variable(133, 2);
echo $valor[0]; ?> <?php $valor = variable(127, 2);
echo $valor[0]; ?>
            <?php echo $modulo ?></label>
									<input name="alto2m" type="text" class="text-input small-input"  id="alto2m" value="<?= $row["alto2m"] ?>" size="32" />
</p>

<p>
			  <label>
                                    <?php $valor = variable(129, 2);
echo $valor[0]; ?>  <?php $valor = variable(133, 2);
echo $valor[0]; ?> <?php $valor = variable(128, 2);
echo $valor[0]; ?>
            <?php echo $modulo ?></label>
									<input name="ancho2p" type="text" class="text-input small-input"  id="ancho2p" value="<?= $row["ancho2p"] ?>" size="32" />
</p>

<p>
			  <label>
                                    <?php $valor = variable(130, 2);
echo $valor[0]; ?>  <?php $valor = variable(133, 2);
echo $valor[0]; ?> <?php $valor = variable(128, 2);
echo $valor[0]; ?>
            <?php echo $modulo ?></label>
									<input name="alto2p" type="text" class="text-input small-input"  id="alto2p" value="<?= $row["alto2p"] ?>" size="32" />
</p>

<p>
			  <label>
                                    <?php $valor = variable(129, 2);
echo $valor[0]; ?>  <?php $valor = variable(134, 2);
echo $valor[0]; ?> <?php $valor = variable(126, 2);
echo $valor[0]; ?>
            <?php echo $modulo ?></label>
									<input name="anchosg" type="text" class="text-input small-input"  id="anchosg" value="<?= $row["anchosg"] ?>" size="32" />
</p>

<p>
			  <label>
                                    <?php $valor = variable(130, 2);
echo $valor[0]; ?>  <?php $valor = variable(134, 2);
echo $valor[0]; ?> <?php $valor = variable(126, 2);
echo $valor[0]; ?>
            <?php echo $modulo ?></label>
									<input name="altosg" type="text" class="text-input small-input"  id="altosg" value="<?= $row["altosg"] ?>" size="32" />
</p>

<p>
			  <label>
                                    <?php $valor = variable(129, 2);
echo $valor[0]; ?>  <?php $valor = variable(134, 2);
echo $valor[0]; ?> <?php $valor = variable(128, 2);
echo $valor[0]; ?>
            <?php echo $modulo ?></label>
									<input name="anchosp" type="text" class="text-input small-input"  id="anchosp" value="<?= $row["anchosp"] ?>" size="32" />
</p>

<p>
			  <label>
                                    <?php $valor = variable(130, 2);
echo $valor[0]; ?>  <?php $valor = variable(134, 2);
echo $valor[0]; ?> <?php $valor = variable(128, 2);
echo $valor[0]; ?>
            <?php echo $modulo ?></label>
									<input name="altosp" type="text" class="text-input small-input"  id="altosp" value="<?= $row["altosp"] ?>" size="32" />
</p>
                             
                             
                             
<p>
									<label>
                                    <?php $valor = variable(46, 2);
echo $valor[0]; ?>
             <?php echo $modulo ?></label>
                                    <textarea name="descripcion_modulo" cols="32" class="text-input small-input" id="descripcion_modulo"><?= $row["descripcion_modulo"] ?></textarea>
</p>
									
                                    
     
     
<p>
<label><?php $valor = variable(47, 2);
echo $valor[0]; ?></label>
<?php

    $cpadre = array();
    $db->select("campo","*","order by id_campo");
    /*$db->last_query();*/
    while ($arraypadre = $db->fetch_array()) {
        $cpadre[] = $arraypadre; 
    }
    foreach ($cpadre as $row2) {

        $db->select("moca","*","where modulo='" . $id . "' and campo='" . $row2["id_campo"] ."'");
        /*$db->last_query();
        exit;*/
        $checked = "";

        if ($rowoso = $db->fetch_array()) {
            $checked = "checked";
        }

?>|
  <input name="campo[]" type="checkbox" id="campo[]"   value="<?= $row2["id_campo"] ?>" <?php echo $checked; ?> />
       <?php echo $row2["nombre_campo"]; ?>
                              <? } ?>

</p>                
  
								
<p>
									<input class="button" type="submit" value="<?php if ($id) {
    $valor = variable(2, 2);
    echo $valor[0];
} else {
    $valor = variable(3, 2);
    echo $valor[0];
} ?> <?php echo $modulo ?>" /> <input name="id" type="hidden" id="id" value="<?= $row["id_modulo"] ?>" />
<br />

                                   
                                    
								</p>
								
				    </fieldset><!-- End .clear -->
							
				  </form>
                    
                
                
                
                
                
                
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
									 <?php $valor = variable(10, 2);
echo $valor[0]; ?>
            <?php echo $modulo ?></a></td>
<td><a href="#" title="title" class="txt_ingresar"><span class="txt_verde">
                                   <?php $valor = variable(46, 2);
echo $valor[0]; ?>&nbsp;<?php echo $modulo ?>
                                  </span></a></td>
									
									
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

$db->select($t1,"*","order by nombre_modulo asc");
$num_total_registros = $db->num_rows();

//calculo el total de p&aacute;ginas
$total_paginas = ceil($num_total_registros / $TAMANO_PAGINA);

$cpadre = array();

$db->select($t1,"*","order by nombre_modulo asc". " limit " . $inicio . "," . $TAMANO_PAGINA);
//echo $sql;
$loop = 0;
/*$db->last_query();*/
while ($arraypadre = $db->fetch_array()) {
    $cpadre[] = $arraypadre; 
}
foreach ($cpadre as $row) {
?>
                            
								<tr>
									<td valign="top"><a href="#" title="<?php echo $row['nombre_usuario'] ?>" class="txt_ingresar">
									  <?php echo $row['nombre_modulo'] ?></a> 

<?php 

    $db->select("moca","count(modulo) as total"," where modulo='" . $row['id_modulo'] ."'");
    $rowx = $db->fetch_assoc();
 ?> (<?php echo $row['id_modulo'] ?> - <?php echo $rowx["total"] ?>)</td>
									<td><a href="#" title="<?php echo $row['nombre_usuario'] ?>" ><?php echo
        $row['descripcion_modulo'] ?></a></td>
									
									
							  <td>
										<!-- Icons -->
										 <a class=Ntooltip href="<?= $_SERVER['PHP_SELF'] ?>?id=<?= $row['id_modulo'] ?>&amp;op=4" title="Edit"><img src="imgs/pencil.png" alt="Edit" />
<span>
<?php $valor = variable(2, 2);
    echo $valor[0]; ?> <?= $modulo; ?>
</span>                                         </a>
<a class=Ntooltip href="javascript:deletex('<?= $row['id_modulo'] ?>')" title="Delete"><img src="imgs/cross.png" alt="Delete" /><span>
<?php $valor = variable(1, 2);
    echo $valor[0]; ?>  <?= $modulo; ?>
</span></a>	


<a class=Ntooltip href="modulo_configura.php" title="<?php $valor = variable(159,
    2);
    echo $valor[0]; ?> <?= $modulo; ?>"><img src="imgs/information.png" alt="Edit" />
<span>
<?php $valor = variable(159, 2);
    echo $valor[0]; ?> <?= $modulo; ?>
</span>                                         </a>																	</td>
							  </tr>
                               <?php } ?>
							</tbody>
					  </table><div class="pagination">
											
										    <? if (($total_paginas > 1)) { ?>
       
          <? if ($pagina != 1) { ?>
          <a href='<?= $_SERVER['PHP_SELF'] ?>?pg=<?= ($pagina - 1) ?>' title="<?php $valor =
        variable(12, 2);
        echo $valor[0]; ?>"><?php $valor = variable(12, 2);
        echo $valor[0]; ?></a>
          <? } ?>
      
      
      
      
      
      
      
      
    
    <? for ($i = 1; $i <= $total_paginas; $i++) {

        if ($pagina == $i) { ?>
        
       <a href='#' class="number current" title="<?= $pagina ?>"> <?= $pagina ?></a>
        
        <? } else { ?>
        <a href='<?= $_SERVER['PHP_SELF'] ?>?pg=<?= $i ?>' class="number" title="<?= $i ?>">
        <?= $i ?>
         </a>
        <? } ?>
        <? } ?>
        
        
        
        
        
        
    
    
    
    
      <? if ($total_paginas != $pagina) { ?>
      <a href='<?= $_SERVER['PHP_SELF'] ?>?pg=<?= ($pagina + 1) ?>' title="<?php $valor =
        variable(13, 2);
        echo $valor[0]; ?>"><?php $valor = variable(13, 2);
        echo $valor[0]; ?></a>
      <? } ?>
      <? } ?>
      <br />
						</div>
						
				  </div> 
                  
                  
			<form name="form" id="form">
  <?php $valor = variable(15, 2);
echo $valor[0]; ?>:
    <select name="jumpMenu" id="jumpMenu" onChange="MM_jumpMenu('parent',this,0)">
   <option value=""><?php $valor = variable(27, 2);
echo $valor[0]; ?></option>
   <?php 

        $cpadre = array();
        $db->select("pagina","*");
        /*$db->last_query();*/
        while ($arraypadre = $db->fetch_array()) {
            $cpadre[] = $arraypadre; 
        }
        foreach ($cpadre as $row) {  
?>
 <?php if ($row["numero"] == $_SESSION['pagina']) { ?>
<option value="<?= $_SERVER['PHP_SELF'] ?>?paginar=<?php echo utf8_encode($row['numero']) ?>&idr=<?php echo
        $idr ?>" selected="selected">
<?php echo utf8_encode($row['numero']) ?>
<?php } else { ?>
 <option value="<?= $_SERVER['PHP_SELF'] ?>?paginar=<?php echo utf8_encode($row['numero']) ?>&idr=<?php echo
        $idr ?>">
<?php echo utf8_encode($row['numero']) ?>
</option>
 <?php } ?>



<? } ?>

  </select>
</form>
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

