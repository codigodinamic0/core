<?php include "include/includes.php"; ?>

</head>

<body >

	<?php include "include/header.php"; ?>

	<div class="conttitles">

		<div class="container"> 

			 <h1>Clasificados</h1>

		</div>

	</div>

	<div class="creacalifica">

		<a href="" class="link">Crear mi clasificado ></a>

	</div>

	<div class="contcalificados">

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

			<ul class="row listclasificados">

			<?php for ($i=0; $i < 4 ; $i++) {  ?>

				<li class="col s12 m6 l3 items">

					<div class="cont">

						<img src="images/ico1.png" alt="" title="">

						<h4>Título del Clasificado</h4>

						<p><b>Por:</b> <span>Nombre del Equipo</span></p>

						<p class="txt">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod

						tempor incididunt ut labore et dolore magna aliqua.1</p>

					</div>

				</li>

				<li class="col s12 m6 l3 items">

					<div class="cont">

						<img src="images/ico2.png" alt="" title="">

						<h4>Título del Clasificado</h4>

						<p><b>Por:</b> <span>Nombre del Equipo</span></p>

						<p class="txt">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod

						tempor incididunt ut labore et dolore magna aliqua.1</p>

					</div>

				</li>

				<li class="col s12 m6 l3 items">

					<div class="cont">

						<img src="images/ico3.png" alt="" title="">

						<h4>Título del Clasificado</h4>

						<p><b>Por:</b> <span>Nombre del Equipo</span></p>

						<p class="txt">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod

						tempor incididunt ut labore et dolore magna aliqua.1</p>

					</div>

				</li>

				<li class="col s12 m6 l3 items">

					<div class="cont">

						<img src="images/ico4.png" alt="" title="">

						<h4>Título del Clasificado</h4>

						<p><b>Por:</b> <span>Nombre del Equipo</span></p>

						<p class="txt">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod

						tempor incididunt ut labore et dolore magna aliqua.1</p>

					</div>

				</li>

			<?php } ?>

			</ul>

			<br><br>

		    <div class="center-align">

		    	<a href="" class="link">Ver Todos</a>

		    </div>

		    <br>

		</div>

	</div>	

	<div class="creacalifica">

		<h3>¿Tienes alguna oferta o requerimiento?</h3>

		<a href="" class="link">Crear mi clasificado ></a>

	</div>

	<?php include "include/suscribir.php"; ?>

	<?php include "include/footer.php"; ?>

</body>

</html>