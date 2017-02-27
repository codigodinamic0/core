<?php include "include/includes.php"; ?>

</head>

<body >

	<?php include "include/header.php"; ?>

	<div class="conttitles">

		<div class="container"> 

			 <h1>Blog</h1>

		</div>

	</div>

	<div class="detalleblog">

		<div class="container">

			<div class="row">
			<?php 
				
				$db->select("vblog v, categoria c","v.nombre_matrix, v.contenido_matrix, v.referencia_matrix, Date_format(v.evento_matrix,'%Y') year, Date_format(v.evento_matrix,'%d') day, Date_format(v.evento_matrix,'%c') month, v.descripcion_matrix, v.url_matrix, v.img_matrix, v.estado_matrix, v.abre_matrix, v.id_categoria, v.amigable_matrix, v.id_matrix, c.nombre_categoria, v.inventario_matrix"," WHERE v.id_categoria=c.id_categoria and id_matrix={$_GET['id']}");
				
				while ($row = $db->fetch_array()) {
					$mes=$row['month'];
					?>

				<div class="col s12 m12 l8">

					<h2><?php echo $row['nombre_matrix'];?></h2>

					<p class="text"><b>Categoría:</b><?php echo $row['nombre_categoria'];?></p>

					<div class="conim">

						<img src="<?php echo $dominio;?>images/imguser.png" alt="<?php echo $row['nombre_matrix'];?>" title="<?php echo $row['nombre_matrix'];?>"> <?php echo $row['referencia_matrix'];?> <span><?php echo $row['day'].' '.$mesAbre[$mes].' '.$row['year'];?></span>						

					</div>

					<br><br>

					<div class="conim">

						<div class="conu">

							Compartir

							<img src="images/redeimg.png" alt="" title="" >

						</div>

						<div class="plus">

							<img src="<?php echo $dominio;?>images/plusico.png" alt="<?php echo $row['nombre_matrix'];?>" title="<?php echo $row['nombre_matrix'];?>">

							<span>80</span>

						</div>

					</div>

					<br><br><br><br>

					<div class="txt">

						<div class="center-align">

							<img src="<?php echo $dominio;?>imagenes/blog/imagen1/<?php echo $row['img_matrix'];?>" alt="<?php echo $row['nombre_matrix'];?>" title="<?php echo $row['nombre_matrix'];?>">

						</div>

						<p><?php echo $row['contenido_matrix'];?></p>

						<br><br>

					</div>

				</div>

				<?php
				}
				?>
				<div class="col s12 m12 l4">

					<div class="conizq">

						<h4>CATEGORÍAS</h4>
						<ul>
						<?php 				
							$db->select("categoria","id_categoria, amigable_categoria, nombre_categoria","WHERE modulo=50");	
							while ($row = $db->fetch_array()) {
						?>
							<li><a href="<?php echo $dominio.$row['amigable_categoria'];?>/<?php echo $row['id_categoria'];?>/cod21/"><i class="material-icons">fiber_manual_record</i><?php echo $row['nombre_categoria'];?></a></li>
						
						<?php
						}
						?>
						</ul>
					</div>

					<div class="conizq">

						<h4>ENTRADAS RECIENTES</h4>
						<ul>
						<?php 				
							$db->select("vblog","evento_matrix, nombre_matrix, amigable_matrix, id_matrix", "ORDER BY evento_matrix desc limit 6");	
							while ($row = $db->fetch_array()) {
						?>
							<li><a href="<?php echo $dominio.$row['amigable_matrix'];?>/<?php echo $row['id_matrix'];?>/cod23/"><i class="material-icons">fiber_manual_record</i><?php echo $row['nombre_matrix'];?></a></li>

						<?php
						}
						?>
						</ul>

					</div>

				</div>

			</div>

		</div>

	</div>

	<?php include "include/suscribir.php"; ?>

	<?php include "include/footer.php"; ?>

</body>

</html>