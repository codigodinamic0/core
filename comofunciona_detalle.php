<?php include "include/includes.php"; ?>

</head>

<body >

	<?php include "include/header.php"; ?>

	<div class="conttitles">

		<div class="container"> 
	<?php 				
	$db->select("vcomo","nombre_matrix"," order by ubica_matrix");
	$rowh = $db->fetch_assoc();
	?>
		<h1>Cómo funciona > <?php echo $rowh['nombre_matrix'];?></h1>
	<?php

	?>

	</div>
</div>

<div class="condetalecomofunciona">
	<?php
	$total="";
	$actual="";
	$siguiente="";
	$anterior="";
	$sig_amigable="";
	$ant_amigable="";
		
		if ($_GET['amigable_matrix']) {
		$consulta = " where amigable_matrix='" . $_GET['amigable_matrix'] . "'";
		}

		$db->select("vcomo","id_matrix, codigo_matrix, contenido_matrix, amigable_matrix, id_matrix","$consulta order by ubica_matrix asc");
		$rowh = $db->fetch_assoc();
		$id_matrix=$rowh['id_matrix'];

		$cpadre = array();
		$db->select("vcomo"," id_matrix"," order by ubica_matrix");
		/*$db->last_query();*/
		while ($arraypadre = $db->fetch_array()) {
		$cpadre[] = $arraypadre; 
		}

			foreach ($cpadre as $row_print) {
			$total=$total+1;

			if ($id_matrix==$row_print['id_matrix']) {
			$actual=$total;
			}

			$siguiente=$actual+1;
			$anterior=$actual-1;			

			}

			$cpadre2 = array();
			$db->select("vcomo","amigable_matrix, id_matrix"," order by ubica_matrix asc");
				/*$db->last_query();*/
				while ($arraypadre2 = $db->fetch_array()) {
				$cpadre2[] = $arraypadre2; 
				}
				foreach ($cpadre2 as $row_print2) {
				$conta=$conta+1;
					if($siguiente==$conta){$sig_amigable=$row_print2['amigable_matrix'];  $sig_id_matrix=$row_print2['id_matrix'];}
					if($anterior==$conta){$ant_amigable=$row_print2['amigable_matrix']; $ant_id_matrix=$row_print2['id_matrix'];}
			}
			?>

			<div class="container">
				<div class="ico"><?php echo $rowh['codigo_matrix']; ?></div>
					<p><?php echo $rowh['contenido_matrix']; ?></p>
					<div class="itempagina">
					
						<?php if ($anterior>0){?><a href="<?php echo $dominio.$ant_amigable;?>/<?php echo $ant_id_matrix;?>/cod31/">< Anterior</a><?php } ?>
						<?php if ($siguiente<=$total){?><a href="<?php echo $dominio.$sig_amigable;?>/<?php echo $sig_id_matrix;?>/cod31/" class="si">Siguiente ></a><?php } ?>
					</div>
			</div>
		</div>

		


	<?php include "include/suscribir.php"; ?>

	<?php include "include/footer.php"; ?>

</body>

</html>