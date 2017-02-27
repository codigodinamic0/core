<div class="container-fluid footer footerdos">
		<div class="container redes">
				<a href="<?php echo $dominio ?>"><img src="<?php echo $dominio?>img/logofoo.fw.png" alt="Mondongo's" title="Mondongo's" class="img-responsive" ></a><br>
				<a href="<?php $valor=variable(3,1); echo $valor[0]; ?>" target="_blank"><i class="fa fa-facebook"></i></a>
				<a href="<?php $valor=variable(4,1); echo $valor[0]; ?>" target="_blank"><i class="fa fa-twitter"></i></a>
				<a href="<?php $valor=variable(5,1); echo $valor[0]; ?>" target="_blank"><i class="fa fa-instagram"></i></a><br><br>
                                
				<?php
					$cpadre = array();
					$db->select("vsede","seo_matrix","WHERE idioma={$idioma} ORDER BY ubica_matrix LIMIT 1");
					/*$db->last_query();*/
				    while ($arraypadre = $db->fetch_array()) {
						$cpadre[] = $arraypadre; 
				    }
					foreach ($cpadre as $row){
				?>
						<i class="fa fa-map-marker"></i><?php echo $row['seo_matrix'];?><span class="tab"></span>
				<?php
					}
				?>
				<i class="fa fa-mobile-phone"></i><?php $valor=variable(1,1); echo $valor[0]; ?>
		</div>
		<div class="container copy">
			<?php
		    	$db->select("vayuda","contenido_matrix","WHERE id_subcategoria=15 AND idioma={$idioma}");
				$row = $db->fetch_assoc();
				echo $row['contenido_matrix'];
		    ?>
		</divi>
	</div>