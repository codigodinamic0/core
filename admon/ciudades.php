<? 

require_once('../Connections/database.php');

?>
<div align="left">
  <select name="ciudad_registrado" id="ciudad_registrado"  type="text">
    <?php 

	$cpadre = array();
	$db->select("ciudad","*","where id_departamento='".$_GET['id_departamento']."' ORDER BY nombre_ciudad asc");
	/*$db->last_query();*/
	    while ($arraypadre = $db->fetch_array()) {
			$cpadre[] = $arraypadre; 
	    }
	foreach ($cpadre as $row3) {
?>
    <option value="<?php echo $row3[id_ciudad] ?>"><?php echo  utf8_encode($row3[nombre_ciudad]); ?></option>
    <?php }?>
  </select> 
  
</div>
