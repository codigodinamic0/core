<?php require_once('../../Connections/connection.php'); 
$link = Connect(); ?>

<?php
	switch ($_POST['cod']) {
		case 1:
			$sql = "SELECT codigo_palabra from palabra where idr='$_POST[idr]' order by codigo_palabra DESC";
			$cons =  mysql_query($sql);
			$num = mysql_num_rows($cons);
			$array = mysql_fetch_array($cons);
			$codigo = $array['codigo_palabra']+1;
			for ($i=1; $i < $array['codigo_palabra'] ; $i++) 
			{ 
				$sqln = "SELECT codigo_palabra from palabra where idr='$_POST[idr]' and codigo_palabra=$i order by codigo_palabra DESC";
				$consn = mysql_query($sqln);
				$numn = mysql_num_rows($consn);
				if($numn==0)
				{
					$arrayn = mysql_fetch_array($consn);
					$codigo=$i;
				}
			}
			echo $codigo;
			break;
		case 2:
			$sql = "SELECT codigo_variable from variable where idr='$_POST[idr]' order by codigo_variable DESC";
			$cons =  mysql_query($sql);
			$num = mysql_num_rows($cons);
			$array = mysql_fetch_array($cons);
			$codigo = $array['codigo_variable']+1;
			for ($i=1; $i < $array['codigo_variable'] ; $i++) 
			{ 
				$sqln = "SELECT codigo_variable from variable where idr='$_POST[idr]' and codigo_variable=$i order by codigo_variable DESC";
				$consn = mysql_query($sqln);
				$numn = mysql_num_rows($consn);
				if($numn==0)
				{
					$arrayn = mysql_fetch_array($consn);
					$codigo=$i;
				}
			}
			echo $codigo;
			break;
		case 3:
			$sql = "UPDATE pedido set estado_pedido=$_POST[es] where id_pedido=$_POST[id]";
			mysql_query($sql);
			echo 1;
			break;
		default:
			# code...
			break;
	}
?>