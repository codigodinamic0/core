<?php include "include/includes.php"; ?>

<script type="text/javascript">
	$(document).ready(function(){
		$("#form-contacto").submit(function(){
			if (!vacios("#form-contacto")) {return false;}
			$.ajax({
				type: 'POST',
				url: dominio+"lib/task/server.php",
				data: $("#form-contacto").serialize(),
				success: function(data){
					var respuesta = data['msg'];
					if (respuesta == '1') {
						swal({
							title: "proceso Exitoso",
							text: "mensaje enviado correctamente",
							type: "success"	
						},function(){
							location.reload();
						});

					}else if(respuesta == '2'){
						swal('Error', 'captcha incorrecto','error');
					}else{
						swal('Error','Ocurrio un problema, intente mas tarde','error');
					}
				}
			});
			return false;
		})
	});
</script>

</head>

<body >

	<?php include "include/header.php"; ?>

	<div class="conttitles">

		<div class="container"> 

			 <h1>Contáctenos</h1>

		</div>

	</div>

	<div class="concontact">

		<div class="container">
			<?php $db->select("vayuda","contenido_matrix"," WHERE id_subcategoria = 16");
				$row = $db->fetch_assoc();
				?>
					<?php echo $row["contenido_matrix"]; ?>

			
	<script src='https://www.google.com/recaptcha/api.js'></script>
			<form id="form-contacto">
				<input type="hidden" name="action" value="contacto">

				<div class="row">

					<div class="col s12 m12 l12">

						<div class="input-field">

							<img src="<?php echo $dominio;?>images/conta1.png" alt="" title="">

							<select class="required" name="pregunta">
								
								<option value="">Elegir categoría de pregunta</option>
								<?php 
							
									$db->select("tipo","nombre_tipo","WHERE idr=36");
									/*$db->last_query();*/
									while ($row = $db->fetch_array()) {
									 ?>
									 <option value="<?php echo $row['nombre_tipo'];?>"><?php echo $row['nombre_tipo'];?></option>
									 <?php

									}
								 ?>
							</select>

						</div>

					</div>

					<div class="col s12 m12 l12">

						<div class="input-field">

							<img src="<?php echo $dominio;?>images/conta2.png" alt="" title="">

							<input type="text" placeholder="Tema" class="required" name="tema">

						</div>

					</div>

					<div class="col s12 m12 l6">

						<div class="input-field">

							<img src="<?php echo $dominio;?>images/conta3.png" alt="" title="">

							<input type="text" placeholder="Nombre" class="required" name="nombre">

						</div>

					</div>

					<div class="col s12 m12 l6">

						<div class="input-field">

							<img src="<?php echo $dominio;?>images/conta4.png" alt="" title="">

							<input type="text" placeholder="Correo" class="required" rel="email" name="email">

						</div>

					</div>

					<div class="col s12 m12 l12">

						<div class="input-field">

							<img src="<?php echo $dominio;?>images/conta5.png" alt="" title="">

							<textarea class="materialize-textarea required" placeholder="Mensaje" name="mensaje"></textarea>

						</div>

					</div>
					<div class="col s12 m12 l12">
						<div class="input-field">
							<div class="g-recaptcha" data-sitekey="<?php $valor=variable(13,1); echo $valor[0]; ?>"></div>
						</div>
					</div>
				</div>


				<div class="center-align">

					<button>ENVIAR</button>

				</div>

			</form>

		</div>

	</div>

<?php include "include/suscribir.php"; ?>

	<?php include "include/footer.php"; ?>


</body>

</html>