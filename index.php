<?php include "include/includes.php"; ?>

</head>

<body >

	<?php include "include/header.php"; ?>

	<div class="owl-carousel owl-theme banner" id="bannerslider">	

		<?php 
			$db->select("vslide","nombre_matrix, descripcion_matrix, referencia_matrix, abre_matrix, url_matrix, img_matrix","ORDER BY ubica_matrix");
			/*$db->last_query();*/
			while ($row = $db->fetch_array()) {
				?>
		<div class="item" style="background-image: url(<?php echo $dominio;?>imagenes/slide/imagen1/<?php echo $row['img_matrix'];?>);">
	    	<div class="txtt">
		    	<div class="txt">
			    	<h3><?php echo $row['nombre_matrix'];?></h3>
			    	<p><?php echo $row['descripcion_matrix'];?></p>
			    	<a href="<?php echo $row['url_matrix'];?>"  target="<?php if($row['abre_matrix']==25){echo '_blank';}else{echo '_self';} ?>"><?php echo $row['referencia_matrix'];?></a>
			    </div>
			</div>
	    </div>	

				<?php
			}
		?>	

	  
	    <!--<div class="item" style="background-image: url(images/banner.png);">

	    	<div class="txtt">

		    	<div class="txt">

			    	<h3>materializa tus ideas y sueños</h3>

			    	<p>Convirtiéndolos en proyectos con futuro</p>

			    	<a href="">Comienza tu proyecto</a>

			    </div>

			</div>

	    </div>-->		    		

	</div>

	<div class="contenido contproyectos">

		<div class="container">

			<h3 class="titles">PROYECTOS</h3>

			<ul class="menupro">

		        <li class="active"><a href="#test1">Recientes</a></li>

		        <li class=""><a class="active" href="#test2">Destacados</a></li>

		        <li class=""><a href="#test3">Exitos</a></li>

		        <li class=""><a href="#test4">Categorías</a></li>

		    </ul>

		    <div class="listaproyectos" id="sliderproyecto">

		    	<?php for ($i=0; $i < 10; $i++) {  ?>

		    	<div class="items">

		    		<div class="cont">

		    			<div class="contimg">

		    				<img src="images/imgpro.png" alt="" title="">	

		    				<div class="contporc align-center">	    

		    					<div class="row">

		    						<div class="col s12 m12 l4 center-align">

		    							<br><br><br><br><br><br>

		    							<span><b>$500.000.000</b></span>

		    							<b>Recaudos</b>

		    						</div>

		    						<div class="col s12 m12 l3 center-align">

		    							<br><br><br>

		    							<div class="c100 p50 small">

						                    <span>50%</span>

						                    <div class="slice">

						                        <div class="bar"></div>

						                        <div class="fill"></div>

						                    </div>

						                </div>

						                <b>Restantes</b>

		    						</div>

		    						<div class="col s12 m12 l5 center-align">

		    							<br>

		    							<div class="c100 p25">

						                    <span>50%</span>

						                    <div class="slice">

						                        <div class="bar"></div>

						                        <div class="fill"></div>

						                    </div>

						                </div>

						                <b>Logrado</b>

		    						</div>

		    					</div>	

		    					<div class="pa">

			    					<h4><b>Título del proyecto</b></h4>

					    			<p><b>Por:</b> <span>Nombre</span></p>

					    			<p><img src="images/icomap.png" alt="" title=""> <b>Medellín, Antioquia</b></p>

					    			<p class="gray">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod

					    			tempor incididunt ut labore et dolore magna aliqua.</p>				    								                

					    		</div>

				            </div>				      

		    			</div>		    			

		    		</div>

		    	</div>

		    	<?php } ?>

		    </div>

		    <br><br>

		    <div class="center-align">

		    	<a href="" class="link">Ver Todos</a>

		    </div>

		    <br><br>

		</div>

	</div>

	<div class="contcalificados">

		<div class="container">

			<h3>CLASIFICADOS</h3>

			<br>

			<ul id="slidercalificados" class="listclasificados">

				<?php 
				
				$db->select("vclasificados","img_matrix, url_matrix, nombre_matrix, referencia_matrix, descripcion_matrix, abre_matrix","ORDER BY ubica_matrix ");
				/*$db->last_query();*/
				while ($row = $db->fetch_array()) {
					?>
					<li class="items">

						<div class="cont">

						<img src="<?php echo $dominio;?>imagenes/clasificados/imagen1/<?php echo $row['img_matrix'];?>" alt="<?php echo $row['nombre_matrix'];?>" title="<?php echo $row['nombre_matrix'];?>">

						<h4><?php echo  $row['nombre_matrix'];?></h4>

						<p><b>Por:</b> <span><?php echo  $row['referencia_matrix'];?></span></p>

						<p class="txt"><?php echo  $row['descripcion_matrix'];?></p>

					</div>

				</li>
					<?php
				}
				 ?>

			</ul>

			<br><br>

		    <div class="center-align">
				<a href="<?php echo $dominio.$row['amigable_matrix'];?>" target="_self" class="link">Ver Todos</a>
		    

		    </div>

		    <br>

		</div>

	</div>

	<div class="contcomofunciona">

		<div class="container">

			<h3>CÓMO FUNCIONA</h3>

			<div class="contb">
				<?php
					$db->select("vcomo","nombre_matrix, codigo_matrix, referencia_matrix, amigable_matrix, id_matrix","ORDER BY ubica_matrix limit 3");
						/*$db->last_query();*/
					$i=0;
						while ($row = $db->fetch_array()) {
							$i++;
					?>
				<div class="conn">

					<a href="<?php echo $dominio.$row['amigable_matrix'];?>/<?php echo $row['id_matrix'];?>/cod31/"><h4 <?php 
						if ($i==2 ) {
							echo "class='bg'";
						}
					?>
					><?php echo $row['codigo_matrix'];?></h4></a>
					<h5><?php echo $row['nombre_matrix'];?></h5>
					<p><?php echo $row['referencia_matrix'];?></p>
				</div>
				<?php 
					if ($i < 3) {
					?>
						<div class="conn fle">

							<img src="<?php echo $dominio;?>images/drfle.png" alt="" title="">

						</div>
					<?php
					}
				?>

			<?php
				}
			?>
			</div>	
		</div>

	</div>

	<div class="concomienza">

		<div class="container">

			<h3>COMIENZA HOY</h3>

			<p>Descubra nuevas campañas de crowdfunding o inicie su propia campaña para recaudar fondos.</p>

			<br>

			<div class="btnlin">

				<a href="" class="link">Explorar Proyectos</a>

				<a href="" class="link bg">Iniciar un Proyecto</a>

			</div>

		</div>

	</div>

	<div class="contsuscri">

		<div class="container">

			<div class="row">

				<div class="col s12 m12 l7">

				<?php $db->select("vayuda","contenido_matrix"," WHERE id_subcategoria=71");
				$rowh = $db->fetch_assoc();
				?>
				<?php echo $rowh["contenido_matrix"]; ?>

				</div>

				<div class="col s12 m12 l5">

					<form id="form-suscribir">
						<input type="hidden" value="suscribir" name="action">
						<input type="text" rel="email" name="suscribir" placeholder="Ingresa tu correo" class="required">
						<button>Suscribirse</button>

					</form>

				</div>

			</div>

		</div>

	</div>

	<div class="contpatrocina">

		<div class="container">

			<h3>PATROCINADORES</h3>


			<ul id="sliderpatrocina" class="patrocina">

			<?php 
				$db->select("vpatrocinantes","img_matrix, url_matrix, abre_matrix, nombre_matrix","ORDER BY ubica_matrix");
				/*$db->last_query();*/
				while ($row = $db->fetch_array()) {

					?>
					<li class="items"><a href="<?php echo $row['url_matrix']; ?>" target="<?php if($row['abre_matrix']==25){echo '_blank';}else{echo '_self';} ?>"><img src="<?php echo $dominio;?>imagenes/patrocinantes/imagen1/<?php echo $row['img_matrix'];?>" alt="<?php echo $row['nombre_matrix'];?>" title="<?php echo $row['nombre_matrix'];?>"></a></li>
					<?php	
				}
			 ?>


			</ul>

		</div>

	</div>

	<?php include "include/footer.php"; ?>

</body>

</html>