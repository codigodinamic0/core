<?php include "include/includes.php"; ?>

</head>

<body >

	<?php include "include/header.php"; ?>

	<div class="conttitles">

		<div class="container"> 

			 <h1>Quienes Somos</h1>

		</div>

	</div>

	<div class="contquienes">

		<div class="container">

			<div class="logoc">

				<img src="images/logoquienes.png" alt="" title="">
				Un equipo trabajando por tus sueños
		</div>
		<?php $db->select("vquienes","referencia_matrix, contenido_matrix"," ORDER BY ubica_matrix");
					$rowh = $db->fetch_assoc();
					?>

					<?php echo $rowh['contenido_matrix'];?>



			<ul class="listquienes">

				<?php 
					/*recetas*/
					$db->select("vquienes","img_matrix, nombre_matrix, referencia_matrix, descripcion_matrix","ORDER BY ubica_matrix ");
					/*$db->last_query();*/
					while ($row = $db->fetch_array()) {
						?>
							<li class="items">

					<div class="cont animate">

						<div class="contimg">

							<img src="<?php echo $dominio;?>imagenes/quienes/imagen1/<?php echo $row['img_matrix'];?>" alt="<?php echo $row['nombre_matrix'];?>" title="<?php echo $row['nombre_matrix'];?>" class="circle">

						</div>

						<div class="contxt">

							<br>

							<h4><?php echo $row['nombre_matrix'];?></h4>

							<h5><span><i class="material-icons">fiber_manual_record</i></span></h5>

							<h4><?php echo $row['referencia_matrix'];?></h4>

							<p><?php echo $row['descripcion_matrix'];?></p>

						</div>

					</div>

				</li>
						<?php				
					}
				 ?>


				<!--<li class="items">

					<div class="cont animate">

						<div class="contimg">

							<img src="images/imgquienes.png" alt="" title="" class="circle">

						</div>

						<div class="contxt">

							<br>

							<h4>Nombre Persona</h4>

							<h5><span><i class="material-icons">fiber_manual_record</i></span></h5>

							<h4>Cargo</h4>

							<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis.</p>

						</div>

					</div>

				</li>-->


			</ul>



		</div>

	</div>

	<?php include "include/suscribir.php"; ?>

	<?php include "include/footer.php"; ?>

</body>

</html>