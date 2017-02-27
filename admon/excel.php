<? 
header("Content-type: application/vnd.ms-excel");  
header('Content-Disposition: attachment; filename="Reporte.xls"');

require_once('../Connections/database.php');

$sql = $_REQUEST['sql'];

$db->consulta_s($sql);
$num_total_registros=$db->num_rows();
$num_total_columnas = $db->field_count();
?>
<table border="1">
	<tr> 
    <? for($i=0 ; $i < $num_total_columnas ; $i++){?>
		<td><b><?= /*mysql_field_name($res,$i)*/$db->field_name($i);?></b></td>
    <? }?>
    </tr>
    
    <?php 

        $cpadre = array();
/*$db->last_query();*/
    while ($arraypadre = $db->fetch_array()) {
        $cpadre[] = $arraypadre; 
    }
foreach ($cpadre as $row) { 
    ?>
    <tr> 
    	<? for($i=0 ; $i < $num_total_columnas ; $i++){?>
            <td><?= $row[$i]?></td>
        <? }?>
    </tr>
    <? }?>
</table>