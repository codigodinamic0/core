<?php 
	include "../Connections/database.php";
	switch ($_POST['cod']) {
		case 'plato':
			$db->select("vmenu","*"," where idioma='".$_POST['idioma']."' and id_matrix='$_POST[id]'");
			echo json_encode($db->fetch_array());
			break;
		
		default:
			# code...
			break;
	}
?>