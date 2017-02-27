<?php include "include/includes.php"; ?>

</head>

<body >

	<?php include "include/header.php"; ?>

	<div class="conttitles">

		<div class="container"> 

			 <h1>Cómo funciona</h1>

		</div>

	</div>

	

	<div class="divbanner"></div>	

	<div class="conpasopaso">

		<div class="container">

			<h3>PASO A PASO</h3>

			<div class="center-align">

				<br>

				<a href="" class="link">Empezar Guía</a>

			</div>

			<br><br>

			<ul class="row listcomofunciona">

				<?php 	
						$db->select("vcomo","nombre_matrix, descripcion_matrix, codigo_matrix, url_matrix, abre_matrix","ORDER BY ubica_matrix");
						/*$db->last_query();*/
						while ($row = $db->fetch_array()) {
							?>
							<li class="col s12 m6 l3 items">					
								<div class="cont">
									<h4><?php echo $row['codigo_matrix'];?></h4>
									<h5><?php echo $row['nombre_matrix'];?></h5>
									<p><?php echo $row['descripcion_matrix'];?></p>
									<a href="<?php echo $row['url_matrix']; ?>" target="<?php if($row['abre_matrix']==25){echo '_blank';}else{echo '_self';} ?>"><img src="<?php echo $dominio;?>images/imgpluscircle.png" alt="<?php echo $row['nombre_matrix'];?>" title="<?php echo $row['nombre_matrix'];?>"></a>
								</div>

							</li>
							<?php
						}
						
					 ?>
			</ul>

		</div>

	</div>

	<?php include "include/suscribir.php"; ?>

	<?php include "include/footer.php"; ?>

</body>

</html>