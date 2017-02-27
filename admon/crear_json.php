<?php	
	function crear_json_vistas($modulo,$condicion)
	{
		global $db;
		if (!file_exists("../json/".$modulo.".json")) 
		{
			$archivo = fopen("../json/".$modulo.".json", "x");
		}
		else
		{
			$archivo = fopen("../json/".$modulo.".json", "w");
		}

		$cpadre = array();
		$db->select($modulo,"*",$condicion);
		
		$recoge = "";
		$n=0;
		$vector = array();

		/*$db->last_query();*/
	    while ($arraypadre = $db->fetch_array()) {
			$cpadre[] = $arraypadre; 
	    }
		foreach ($cpadre as $row) {
			for ($i = 0; $i < $db->field_count(); ++$i) {
			    $campo = $db->field_name($i);
			    $info = $array[$i];
			    $vector[$n][$campo] = $array[$i];
			    // echo  "$tabla: $campo : $info<br>";
			}
		}
		// Escribir en el archivo
		fwrite($archivo,json_encode($vector));
		fclose($archivo); 
		
	}
?>