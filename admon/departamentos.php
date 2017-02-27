<? 

require_once('../Connections/database.php');
?>
<div align="left">
	
  <select name="departamento_registrado" id="departamento_registrado" onChange="Showciudad(this.value)" type="text">
    <?php 
		$cpadre = array();
$db->select("departamento","*","where codigo_pais='".$_GET['pais_registrado']."' ORDER BY nombre_departamento asc");
/*$db->last_query();*/
    while ($arraypadre = $db->fetch_array()) {
		$cpadre[] = $arraypadre; 
    }
foreach ($cpadre as $row3) { 
?>
    <option value="<?php echo $row3['id_departamento'] ?>"><?php echo  utf8_encode($row3['nombre_departamento']); ?></option>
    <?php }?>
  </select>
</div>
