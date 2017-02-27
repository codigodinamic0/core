<?php
require_once('../../Connections/database.php');
?>

<?php
	switch ($_POST['cod']) {
		case 1:
			$db->select("palabra","codigo_palabra","where idr='$_POST[idr]' order by codigo_palabra DESC");
			$num = $db->num_rows();
			$array = $db->fetch_array();

			$codigo = $array['codigo_palabra']+1;
			for ($i=1; $i < $array['codigo_palabra'] ; $i++) 
			{
				$db->select("palabra","codigo_palabra","where idr='$_POST[idr]' and codigo_palabra=$i order by codigo_palabra DESC");
				$numn = $db->num_rows();
				if($numn==0)
				{
					$arrayn = $db->fetch_array();
					$codigo=$i;
				}
			}
			echo $codigo;
			break;
		case 2:
			$db->select("variable","codigo_variable","where idr='$_POST[idr]' order by codigo_variable DESC");
			$num = $db->num_rows();
			$array = $db->fetch_array();

			$codigo = $array['codigo_variable']+1;
			for ($i=1; $i < $array['codigo_variable'] ; $i++) 
			{
				$db->select("variable","codigo_variable","where idr='$_POST[idr]' and codigo_variable=$i order by codigo_variable DESC");
				$numn = $db->num_rows();

				if($numn==0)
				{
					$arrayn = $db->fetch_array();
					$codigo=$i;
				}
			}
			echo $codigo;
			break;
		case 3:
			$sql = "UPDATE pedido set estado_pedido=$_POST[es] where id_pedido=$_POST[id]";
			$updatecontenido = $db->prepare($sql);
			$updatecontenido->execute();
			$updatecontenido->close();
			echo 1;
			break;
		default:
			# code...
			break;
	}
?>