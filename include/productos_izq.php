<script type="text/javascript">
	$(document).ready(function(){
		/*select*/
		$("#select-marca").change(function() {
			var valor = $("#select-marca").val();
			console.log("valor = "+valor);
			if(valor != ""){
				$(location).attr('href', '<?php echo $dominio; ?>'+valor+'/cod24/');
			}
		});
	});
</script>
<div class="col-xs-12 col-sm-3 col-md-3 izquierda">
	<div class="contens">
		<h3>MARCAS</h3>
		<div class="cont">
			<hr>
			<select id="select-marca">
				<option value="">Selecione una marca</option>
				<?php
					$db->select("vmarca m, vproducto p","m.id_matrix, m.nombre_matrix, m.amigable_matrix","WHERE p.id_marca = m.id_matrix GROUP BY m.id_matrix ORDER BY m.ubica_matrix");
					/*$db->last_query();*/
					while ($row_marca = $db->fetch_array()){
				?>
						<option value="<?php echo $row_marca['amigable_matrix']; ?>" <?php if($_GET['amigable_marca'] == $row_marca['amigable_matrix']){ echo "selected"; } ?>><?php echo $row_marca['nombre_matrix']; ?></option>
				<?php
					}
				?>				
			</select>
		</div>
	</div>
	<div class="contens">
		<h3>PRODUCTOS</h3>
		<div class="cont">
			<ul>
				<?php
					/*buscar grupos*/
					$cpadre = array();
					$db->select("categoria g, categoria c, vproducto p","g.id_categoria, g.nombre_categoria","WHERE p.id_categoria = c.id_categoria AND c.de = g.id_categoria AND g.nivel_categoria = 1 GROUP BY g.id_categoria ORDER BY g.id_categoria");
					/*$db->last_query();*/
					while ($arraypadre = $db->fetch_array()) {
						$cpadre[] = $arraypadre; 
					}
					foreach ($cpadre as $row_grupo){
				?>
						<li <?php if($_GET['grupo'] == $row_grupo['id_categoria']){ echo "class='active'";} ?>>
							<a><i class="fa fa-angle-right"></i> <?php echo $row_grupo['nombre_categoria']; ?>  <i class="fa fa-angle-down"></i></a>
							<ul>
								<?php
									$db->select("categoria","id_categoria, nombre_categoria, amigable_categoria","WHERE modulo = 31 AND nivel_categoria = 2 AND de = '{$row_grupo['id_categoria']}' ORDER BY ubica_categoria");
									/*$db->last_query();*/
									while ($row_categoria = $db->fetch_array()){
								?>
										<li>
											<a href="<?php echo $dominio.$row_categoria['amigable_categoria']; ?>/<?php echo $row_grupo['id_categoria']; ?>/cod22/">
												<i class="fa fa-angle-right"></i> <?php echo $row_categoria['nombre_categoria']; ?> 
											</a>
										</li>
								<?php
									}
								?>
							</ul>
						</li>
				<?php
					}
				?>
			</ul>
		</div>
	</div>
	<?php
		$db->select("vinformacion","nombre_matrix, img_matrix, url_matrix, abre_matrix","ORDER BY RAND() LIMIT 1");
		$row = $db->fetch_assoc();
	?>
	<img src="<?php echo $dominio; ?>imagenes/informacion/imagen1/<?php echo $row['img_matrix'] ?>" alt="<?php echo $row['nombre_matrix']; ?>" title="<?php echo $row['nombre_matrix']; ?>" class="img-responsive">
</div>