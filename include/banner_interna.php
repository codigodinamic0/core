<div class="container" id="banner">
	<div class="items">
		<?php
			$db->select("vbanner","nombre_matrix, img_matrix","WHERE ubica_matrix='{$banner}' ORDER BY id_matrix DESC LIMIT 1");
			$row = $db->fetch_assoc();
		?>
		<a href="#">
			<img src="<?php echo $dominio; ?>imagenes/banner/imagen1/<?php echo $row['img_matrix']; ?>" alt="<?php echo $row['nombre_matrix']; ?>" title="<?php echo $row['nombre_matrix']; ?>">
		</a>
	</div>
</div>