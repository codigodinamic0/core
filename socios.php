<?php include "include/includes.php"; ?>

</head>

<body >

	<?php include "include/header.php"; ?>

	<div class="conttitles">

		<div class="container"> 
		<h1>Socios Estratégicos</h1>
		</div>

	</div>

	<div class="contsocios">

		<div class="container">

			<ul class="listsocios row">

				<?php 

				$db->select("vsocios","nombre_matrix, url_matrix, img_matrix, abre_matrix","ORDER BY ubica_matrix");
				/*$db->last_query();*/
				while ($row = $db->fetch_array()) {

			
				?>
				<li class="col s12 m6 l3 items ">

					<a href="<?php echo $row['url_matrix']; ?>" target="<?php if($row['abre_matrix']==25){echo '_blank';}else{echo '_self';} ?>"><img src="<?php echo $dominio;?>imagenes/socios/imagen1/<?php echo $row['img_matrix'];?>" alt="<?php echo $row['nombre_matrix'];?>" title="<?php echo $row['nombre_matrix'];?>"></a>

				</li>

				<?php } ?>

			</ul>

		</div>

	</div>

	<?php include "include/suscribir.php"; ?>

	<?php include "include/footer.php"; ?>

</body>

</html>