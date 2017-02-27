<?php include "include/includes.php"; ?>

</head>

<body >

	<?php include "include/header.php"; ?>

	<div class="conttitles">

		<div class="container"> 

			 <h1>Contáctenos</h1>

		</div>

	</div>

	<div class="conteventos">

		<div class="container">

			<div class="conbusca">	

				<div class="contfo">			

					<form>

						Tipo evento

						<select>

							<option>Noticias</option>

						</select>

						Ordenar por

						<select>

							<option>Azar</option>

						</select>

					</form>

					<div class="vist">

						Vista: <span class="clvistas li" rel="list"></span> <span class="clvistas cua active" rel="cua"></span>

					</div>

				</div>

				<div class="contfo">

					<form>

						Filtrar por fecha: <span></span> desde

						<select>

							<option>01/01/1990</option>

						</select>

						hasta

						<select>

							<option>01/01/1990</option>

						</select>

					</form>

				</div>

			</div>

			<ul class="listeventos row cuaevento "> 

				<?php for ($i=0; $i < 21; $i++) {  ?>

				<li class="items col s12 m6 l4">

					<div class="cont">

						<div class="row">

							<div class="conimg col s12 m12 l4">

								<div class="imgbg" style="background-image: url(images/imgblog.png);"></div>

							</div>

							<div class="contxt col s12 m12 l8 animate">

								<h3>Título del evento</h3>

								<div class="contmacal">

									<div class="col s12 m12 l6">

										<img src="images/icomap1.png" alt="" title=""> <span>Nombre del lugar</span>

									</div>

									<div class="col s12 m12 l6">

										<img src="images/icomap2.png" alt="" title=""> 07 Feb 2017

									</div>

								</div>

								<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis.</p>

								<a href="" class="link">Leer Más</a>

								<div class="lifle">

									<a href="" ><img src="images/flecharara.png" alt="" title=""></a>

								</div>

							</div>

						</div>

					</div>

				</li>

				<?php } ?>

			</ul>

		</div>

	</div>

	<div class="creacalifica">

		<a href="" class="link">Cargas Más</a>

	</div>

	<?php include "include/suscribir.php"; ?>	

	<?php include "include/footer.php"; ?>

</body>

</html>