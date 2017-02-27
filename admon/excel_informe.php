<?php
header("Content-type: application/vnd.ms-excel");  
header('Content-Disposition: attachment; filename="Reporte.xls"');

require_once('../Connections/database.php');

$fecha = date("Y-m-d");
$where =" and candidato.fecha like'$fecha%'";
if (@$_GET['desde']!="" and @$_GET['hasta']!="") {
    $where = " and date_format(candidato.fecha,'%Y-%m-%d') between  '$_GET[desde]' and '$_GET[hasta]'";
}
if (@$_GET['digitador']!="") {
    $where .= " and candidato.id_registrado='$_GET[digitador]'";
}
if (@$_GET['t']==1) {
    $db->select("candidato,usuario","usuario.nombre_usuario,count(candidato.id) as total"," where candidato.id_registrado=usuario.id_usuario and usuario.tipo=100 $where group by candidato.id_registrado order by usuario.nombre_usuario");
}else{
    $db->select("candidato,usuario","usuario.nombre_usuario,usuario.id_usuario,candidato.*"," where candidato.id_registrado=usuario.id_usuario and usuario.tipo=100 $where  order by usuario.nombre_usuario");
}
$num_total_registros=$db->num_rows();
$num_total_columnas = $db->field_count();

$campos = "";

?>
<table border="1">
	<tr> 
    <?php 
        for($i=0 ; $i < $num_total_columnas ; $i++){
            $campos .= $db->field_name($i).",";
    ?>
		<td><b><?php echo $db->field_name($i);?></b></td>
    <?php }
    $campos = substr($campos, 0,-1);
    $campos = explode(",", $campos);
    ?>
     <?php if(@$_GET["t"]==2){ ?>
        <td><b>cursos</b></td>
        <td><b>oficios</b></td>
        <td><b>informacion_laboral</b></td>
    <?php } ?>
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
    	<?php 
            for($i=0 ; $i < $num_total_columnas ; $i++){
                if ($campos[$i]=="estado_civil") {
                    $db->select("tipo","*","where id_tipo='".$row[$i]."'");
                    $datost = $db->fetch_array();
                    $row[$i]=utf8_decode($datost['nombre_tipo']);
                }
                if ($campos[$i]=="departamento") {
                    $db->select("departamento","*","where id_departamento='".$row[$i]."'");
                    $datost = $db->fetch_array();
                    $row[$i]=utf8_decode($datost['nombre_departamento']);
                }
                if ($campos[$i]=="ciudad") {
                    $db->select("ciudad","*","where id_ciudad='".$row[$i]."'");
                    $datost = $db->fetch_array();
                    $row[$i]=utf8_decode($datost['nombre_ciudad']);
                }
                if ($campos[$i]=="academico") {
                    $db->select("tipo","*","where id_tipo='".$row[$i]."'");
                    $datost = $db->fetch_array();
                    $row[$i]=$datost['nombre_tipo'];
                }
                if ($campos[$i]=="academico1") {
                    $db->select("tipo","*","where id_tipo='".$row[$i]."'");
                    $datost = $db->fetch_array();
                    $row[$i]=$datost['nombre_tipo'];
                }
                if ($campos[$i]=="estudia" or $campos[$i]=="estudia1") {
                    if ($row[$i]==1) {
                        $row[$i]="Si";
                    }
                    if ($row[$i]==2) {
                        $row[$i]="No";
                    }
                }
                if ($campos[$i]=="descripcion_llamar") {
                     $db->select("tipo","*","where id_tipo='".$row[$i]."'");
                    $datost = $db->fetch_array();
                    $row[$i]=$datost['nombre_tipo'];
                }
        ?>
            <td><?php echo utf8_decode($row[$i])?></td>
        <?php } ?>
        <?php if(@$_GET["t"]==2){ ?>
        <td>
            <?php 
                $db->select("tipo,relacion","tipo.nombre_tipo","where relacion.de=tipo.id_tipo and tipo.idr=36 and relacion.con='".$row['cedula']."'");
                $recocu = "";
                while ($datoscu = $db->fetch_array()) {
                    $recocu .= $datoscu['nombre_tipo'].",";
                }
                $recocu = substr($recocu, 0,-1);
                echo $recocu;
            ?>
        </td>
        <td>
            <?php 
                $db->select("tipo,relacion","tipo.nombre_tipo","where relacion.de=tipo.id_tipo and tipo.idr=41 and relacion.con='".$row['cedula']."'");
                $recocu = "";
                while ($datoscu = $db->fetch_array()) {
                    $recocu .= $datoscu['nombre_tipo'].",";
                }
                $recocu = substr($recocu, 0,-1);
                echo $recocu;
            ?>
        </td>
        <td>
            <?php 
                $db->select("candidato_laboral","*","where id_candidato='".$row['id']."'");
                $datoslab = "";
                while ($datoslb = $db->fetch_array()) {
                    $datoslab .= "
                    Empresa: ".utf8_decode($datoslb['empresa_laboral'])."
                    \r\n
                    Cargo: ".utf8_decode($datoslb['cargo_laboral'])."
                    \r\n
                    Fecha ingreso: ".$datoslb['ingreso_laboral']."
                    \r\n
                    Fecha retiro: ".$datoslb['retiro_laboral']."
                    \r\n
                    \r\n
                    ";
                }
                echo $datoslab;
            ?>            
        </td>
        <?php } ?>
    </tr>
    <?php }?>
</table>