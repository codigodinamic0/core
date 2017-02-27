<?php include('../Connections/database.php'); ?>
<div class="col-1 col-indent">
  <h2>Otras Galer&iacute;as</h2>
                        
                        <div class="galerias">
                        
                        <?php 
$cpadre = array();
$db->select("sublinea","*","where id_sublinea in (select producto.id_sublinea from producto)");
/*$db->last_query();*/
    while ($arraypadre = $db->fetch_array()) {
    $cpadre[] = $arraypadre; 
    }
foreach ($cpadre as $row_galeria) {
  ?>
                        
                        <a href="galeria.php?id_sublinea=<?php echo $row_galeria['id_sublinea']; ?>" >
					    <div class="gale">
                        	<div class="gale_mask"></div>
                            <img src="imagenes/sublinea/thumb/<?php echo $row_galeria['img']; ?>" width="90" height="86" alt="<?= $row_galeria['nombre_sublinea']?>"  title="<?= $row_galeria['nombre_sublinea']?>"><?= $row_galeria['nombre_sublinea']?>
                         </div>
                         </a>
                         
                         <?php } ?>
                         <div class="clear"></div>
                      
  </div>
                      
                      <span onclick="llama();" class="mano">Ver ubicaci&oacute;n</span>   
                            <div id="escondido">
                            <span onClick="desvanecer();" class="link2">Click aqu&iacute; para cerrar</span>
                      </div>
					</div>