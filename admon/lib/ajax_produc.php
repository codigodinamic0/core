<?php
	header('Content-Type: application/json');
	require_once("../../Connections/database.php");
	require ("../../lib/functions.php");

	switch ($_POST['cod']) {
		case 1:
				
				$db->select("invetario_sede_productos","*","where cod_producto=$_POST[nump] and cod_sede=$_POST[numsd]");
				$datos = $db->fetch_array();
				$num = $db->num_rows();
				if ($num==0) {
					$sumiv = $_POST['numd'];				
					$db->consulta_s("INSERT into invetario_sede_productos(cod_producto,cod_sede) values('$_POST[nump]','$_POST[numsd]')");
					$db->consulta_s("UPDATE invetario_sede_productos set $_POST[camp]='$_POST[numd]' where cod_producto=$_POST[nump] and cod_sede=$_POST[numsd] ");
				} else{
					$sumiv = $datos[$_POST['camp']]+$_POST['numd'];
					$db->consulta_s("UPDATE invetario_sede_productos set $_POST[camp]=".$sumiv." where cod_producto=$_POST[nump] and cod_sede=$_POST[numsd] ");
				}
				$db->select("invetario_sede_productos","*","where cod_producto=$_POST[nump] and cod_sede=$_POST[numsd]");
				$datos = $db->fetch_array();
				$totalp = ($datos['dentran']+$datos['devoluciones'])-($datos['perdidos']+$datos['ventas']);
				$datosw = array(
						"un"=>$sumiv,
						"do"=>$totalp
					);
				echo json_encode($datosw);
			break;
		
		default:
			# code...
			break;
	}
?>