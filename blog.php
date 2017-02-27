<?php include "include/includes.php"; ?>

</head>

<body >

	<?php include "include/header.php"; ?>

	<div class="conttitles">

		<div class="container"> 

			 <h1>BLOG</h1>

		</div>

	</div>

	<div class="concontenido">

		<div class="container">

			<div class="conbusca">	
				<?php
					$condition="";
					if ($_GET['id_categoria'] !=null && $_GET['id_categoria'] !="") {
					$condition=" and c.id_categoria = '{$_GET['id_categoria']}' ";
					}

					$ordenamiento="";
					if ($_GET['order'] !=null && $_GET['order'] !="") {
						$_SESSION['ordenamiento']=$_GET['order'];					

					}
					$db->select("tipo","valor_tipo"," where id_tipo = {$_SESSION['ordenamiento']}");
						$row = $db->fetch_assoc();
						$ordenamiento= $row['valor_tipo'];
					

				?>			
				<form>

					Ver categoría


					<select onchange="location = this.value">
					<option value="#">Categoria</option>

					<?php 

						$db->select("categoria","id_categoria, amigable_categoria, nombre_categoria","WHERE modulo=50");
						/*$db->last_query();*/
						while ($row = $db->fetch_array()) {
							?>
								<option value="<?php echo $dominio.$row['amigable_categoria'];?>/<?php echo $row['id_categoria'];?>/cod21/"
									<?php 
										if ($_GET['id_categoria'] !=null && $_GET['id_categoria'] !="" && $_GET['id_categoria'] == $row['id_categoria']) {
												echo 'selected';
										}
									?>

								><?php echo $row['nombre_categoria'];?></option>
							<?php
						} ?>


						

					</select>

					Ordenar por

					<select onchange="location = this.value">
					<?php 
					$db->select("tipo","id_tipo, nombre_tipo","WHERE idr=32");
						/*$db->last_query();*/
						while ($row = $db->fetch_array()) {
							?>
						<option value="<?php echo $dominio;?>blog.php?order=<?php echo $row['id_tipo'];?>"
							<?php if ($_SESSION['ordenamiento'] == $row['id_tipo']){

									echo 'selected';
								} ?>						

						><?php echo $row['nombre_tipo'];?></option>
						<?php
					}	
				?>

					</select>

				</form>

			</div>
	

			<ul class="listblog">
				<?php 
				
				$db->select("vblog v, categoria c","v.nombre_matrix, v.referencia_matrix, Date_format(v.evento_matrix,'%Y') year, Date_format(v.evento_matrix,'%d') day, Date_format(v.evento_matrix,'%c') month, v.descripcion_matrix, v.url_matrix, v.img_matrix, v.estado_matrix, v.abre_matrix, v.id_categoria, v.amigable_matrix, v.id_matrix"," WHERE v.id_categoria=c.id_categoria {$condition} {$ordenamiento}");
				
				while ($row = $db->fetch_array()) {
					$mes=$row['month'];
					?>
						<li class="items">

					<div class="row">

						<div class="col s12 m12 l5">

							<img src="<?php echo $dominio;?>imagenes/blog/imagen1/<?php echo $row['img_matrix'];?>" alt="<?php echo $row['nombre_matrix'];?>" title="<?php echo $row['nombre_matrix'];?>">


						</div>

						<div class="col s12 m12 l7">
						

							<h3><?php echo $row['nombre_matrix'];?></h3>

							<div class="conim">

								<img src="<?php echo $dominio;?>images/imguser.png" alt="" title=""> <?php echo $row['referencia_matrix'];?> <span><?php echo $row['day'].' '.$mesAbre[$mes].' '.$row['year'];?></span>

								<div class="plus">

									<img src="<?php echo $dominio;?>images/plusico.png" alt="" title="">

									<span>80</span>

								</div>

							</div>

							<p><?php echo $row['descripcion_matrix'];?> </p>

							<a href="<?php echo $dominio.$row['amigable_matrix'].'/'.$row['id_matrix'].'/cod23/';?>" class="link">Leer Más</a>

						</div>

					</div>

				</li>
					<?php
				}
				?>
				

			</ul>

			<div class="center-align">

		    	<a href="" class="link">Cargar Más Entradas</a>

		    </div>

		</div>

	</div>	



	<?php include "include/footer.php"; ?>

</body>

</html>