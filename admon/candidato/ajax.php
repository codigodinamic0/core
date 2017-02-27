<?php 
	session_start();
	include "../../Connections/database.php";
	switch ($_POST['cod']) {
		case 1:
			$db->select("tipo","*"," where idr=36 and nombre_tipo like '%$_POST[dato]%' order by nombre_tipo asc ");
			while ($dat = $db->fetch_array()) {
				echo "<span onclick='guardarrelacioncurso(".$dat['id_tipo'].",\" ".$dat['nombre_tipo']." \")'>".$dat['nombre_tipo']."</span>";
			}
			break;
		case 2:
			$db->consulta_s("INSERT INTO relacion(id_tipo,de,con) values(69,'$_POST[num]','$_POST[doc]')");
			break;
		case 3:
			$db->consulta_s("DELETE from relacion where id_tipo=69 and id_relacion='$_POST[num]'");
			break;
		case 4:
			$db->select("relacion,tipo","tipo.*,relacion.id_relacion","where relacion.id_tipo=69 and relacion.de=tipo.id_tipo and con='$_POST[doc]'");
			$reco = "";
			while ($dat = $db->fetch_array()) {
				$reco .= "<span onclick='eliminacursos(".$dat['id_relacion'].")'>".$dat['nombre_tipo']."</span>,";
			}
			$reco = substr($reco,0,-1);
			echo $reco;
			break;
		case 5:
			$db->select("tipo","*"," where idr=41 and nombre_tipo like '%$_POST[dato]%' order by nombre_tipo asc ");
			while ($dat = $db->fetch_array()) {
				echo "<span onclick='guardarrelacionoficio(".$dat['id_tipo'].",\" ".$dat['nombre_tipo']." \")'>".$dat['nombre_tipo']."</span>";
			}
			break;
		case 6:
			echo "INSERT INTO relacion(id_tipo,de,con) values(101,'$_POST[num]','$_POST[doc]')";
			$db->consulta_s("INSERT INTO relacion(id_tipo,de,con) values(101,'$_POST[num]','$_POST[doc]')");
			break;
		case 7:
			$db->consulta_s("DELETE from relacion where id_tipo=101 and id_relacion='$_POST[num]'");
			break;
		case 8:
			$db->select("relacion,tipo","tipo.*,relacion.id_relacion","where relacion.id_tipo=101 and relacion.de=tipo.id_tipo and con='$_POST[doc]'");
			$reco = "";
			while ($dat = $db->fetch_array()) {
				$reco .= "<span onclick='eliminaoficios(".$dat['id_relacion'].")'>".$dat['nombre_tipo']."</span>,";
			}
			$reco = substr($reco,0,-1);
			echo $reco;
			break;
		default:
			# code...
			break;
	}
?>