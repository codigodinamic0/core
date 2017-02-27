<div class="contsuscri bggri">

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