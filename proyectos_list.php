<?php include "include/includes.php"; ?>

</head>

<body >

	<?php include "include/header.php"; ?>

	<div class="conttitles">

		<div class="container"> 

			 <h1>Cómo funciona > Título del paso</h1>

		</div>

	</div>

	<div class="contproyectos">

		<div class="container">

			

			<ul class="menupro">

		        <li class="active"><a href="#test1">Recientes</a></li>

		        <li class=""><a class="active" href="#test2">Destacados</a></li>

		        <li class=""><a href="#test3">Exitos</a></li>

		        <li class=""><a href="#test4">Categorías</a></li>

		    </ul>

		    <div class="conbusca">		

					<form>

						Ordenar por

						<select>

							<option>Azar</option>

						</select>

					</form>	

			</div>

			<div class="listaproyectos">

				<div class="row">

			    	<?php for ($i=0; $i < 12; $i++) {  ?>

			    	<div class="col s12 m6 l3 items">

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

		    </div>

		    <div class="creacalifica">

				<a href="" class="link">Cargas Más</a>

			</div>

		</div>

	</div>

	<?php include "include/suscribir.php"; ?>

	<?php include "include/footer.php"; ?>

</body>

</html>