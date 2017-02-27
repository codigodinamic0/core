<footer class="android-footer mdl-mega-footer">
<div class="container">
	<div class="row elemtsform">
		<div class="col-md-10 col-md-offset-1 col-xs-12">
			<div class="col-xs-12 logo_text_footer">
				<div id="sliderfooter" style="text-align: center;">
					<?php
						$db->select("vmarca","nombre_matrix, img_matrix, url_matrix, abre_matrix","ORDER BY ubica_matrix");
						/*$db->last_query();*/
						while ($row = $db->fetch_array()){
					?>
							<div class="items">
								<a href="<?php echo $row['url_matrix']; ?>" target="<?php if($row['abre_matrix']==25){echo '_blank';}else{echo '_self';} ?>">
									<img src="<?php echo $dominio; ?>imagenes/marca/imagen1/<?php echo $row['img_matrix']; ?>" class="logo-footer" alt="<?php echo $row['nombre_matrix']; ?>" title="<?php echo $row['nombre_matrix']; ?>">
								</a>
							</div>
					<?php
						}
					?>
	            </div>
	         </div>
	         <div class="col-xs-12 col-md-7">
	         	<div class="textdesx">
	         		<?php
	         			$db->select("vayuda","nombre_matrix, contenido_matrix","WHERE id_subcategoria = 71 ORDER BY id_matrix DESC LIMIT 1");
						$row = $db->fetch_assoc();
						echo $row['contenido_matrix'];
	         		?>
	                <div class="newsletter">
	                    <form class="row" id="form-suscribir">
	                        <div class="col-xs-12 col-md-9">
	                            <input type="text" name="email-newsletter" id="email-newsletter" class="required" rel="email" placeholder="Escribe tu correo electrónico">
	                        </div>
	                        <div class="col-xs-12 col-md-3">
	                            <button type="submit" id="newsletter-btn">Suscribirme</button>
	                        </div>
	                    </form>
	                </div>
	                <script>
						$(document).ready(function() {
							$("#form-suscribir").submit(function(){
								console.log("suscribir");
								if (!vacios("#form-suscribir")) { return false; }
								var input_email = $("#form-suscribir").find("input");
								var suscribir_email = input_email.val();
								if(suscribir_email != null && suscribir_email != ""){
									$.ajax({
							           type: "POST",
							           url: "<?php echo $dominio; ?>lib/task/server.php",
							           data: {
							           		action : "suscribir",
							           		suscribir_email : suscribir_email 
							           }, // Adjuntar los campos del formulario enviado.
							           success: function(data)
							           {
							               if(data["msg"]==1){
							               		input_email.val('');
							               		swal('Proceso Exitoso', 'La suscripción se realizó de forma correcta.', 'success');
							               }else if(data["msg"]==2){
							               		swal('Error', 'Ocurrió un problema, inténtelo luego.', 'error');
							               }else if(data["msg"]==3){
							               		input_email.val('');
							               		swal('Proceso Exitoso', 'La suscripción se realizó de forma correcta.', 'success');
							               }
							           }
							        });
						        }else{
						        	swal('Error', 'Debe diligenciar el formulario.', 'error');
						        } 
						    	return false; // Evitar ejecutar el submit del formulario.
					 		});

							$(".owl-carousel-gallery").owlCarousel({ 
								autoplay:true,
								autoplayTimeout:5000,
								loop:true,
								autoplayHoverPause:false,
								items : 4,
								dots: false,
								itemsDesktop : [1199,3],
								itemsDesktopSmall : [979,3]
							});
						});
					</script>
	            </div>
	         </div>
	         <div class="col-xs-12 col-md-5 contpagos">
	         	<div class="row">
	         		<div class="col-xs-6 redes">
		                <!-- <h5>Descarga la App</h5> -->
		                <a href="#"><b>Registrese</b></a><br>
		                <a href="#"><b>Mis pedidos</b></a>
	            	</div>
	            	<div class="col-xs-6 applinks">
		                <h5>Formas de Pago</h5>
		                <img src="<?php echo $dominio; ?>img/payment_methods.png" alt="Metodos de pago"><br><br>
		                <p><strong>Pago Contra Entrega</strong></p>
	            	</div>
	            </div>
	         </div>
		</div>
	</div>
	<div class="row linksfooter">
		<div class="row col-md-10 col-md-offset-1 ">
			<div class="col-xs-12 col-md-7 categorialist">
				<div class="col-xs-6 col-md-3 linkscat">
	                <h5><a href="<?php echo $dominio; ?>">Merca Ahorro</a></h5>
	                <ul>
	                	<?php
	                		$db->select("vproducto p, categoria ch, categoria cp","cp.id_categoria, cp.amigable_categoria, cp.nombre_categoria","WHERE p.id_categoria = ch.id_categoria AND ch.de = cp.id_categoria GROUP BY cp.id_categoria ORDER BY cp.ubica_categoria");
							/*$db->last_query();*/
							while ($row = $db->fetch_array()){
						?>
								<li><a href="<?php echo $dominio.$row['amigable_categoria']; ?>/<?php echo $row['id_categoria']; ?>/cod1/">- <?php echo $row['nombre_categoria']; ?></a></li>
						<?php
							}
	                	?>
	                </ul>
	            </div>
	            <div class="col-xs-6 col-md-3 linkscat">
	                <h5><a href="https://merqueo.com/bogota/domicilios-surtifruver">Surtifruver</a></h5>
	                <ul>
                        <li><a href="https://merqueo.com/bogota/domicilios-surtifruver/organicos-y-premium">- Organicos y Premium</a></li>
                        <li><a href="https://merqueo.com/bogota/domicilios-surtifruver/frutas-y-verduras">- Frutas y Verduras</a></li>
                        <li><a href="https://merqueo.com/bogota/domicilios-surtifruver/carnes-y-pollos">- Carnes y Pollos</a></li>
                        <li><a href="https://merqueo.com/bogota/domicilios-surtifruver/pescados-y-mariscos">- Pescados y Mariscos</a></li>
	                               
	                </ul>
	            </div>
	            <div class="col-xs-6 col-md-3 linkscat">
	                <h5><a href="https://merqueo.com/bogota/domicilios-colsubsidio">Colsubsidio</a></h5>
	                <ul>
                        <li><a href="https://merqueo.com/bogota/domicilios-colsubsidio/promociones">- Promociones</a></li>
                        <li><a href="https://merqueo.com/bogota/domicilios-colsubsidio/panaderia">- Panaderia</a></li>
                        <li><a href="https://merqueo.com/bogota/domicilios-colsubsidio/despensa">- Despensa</a></li>
                        <li><a href="https://merqueo.com/bogota/domicilios-colsubsidio/encurtidos-y-enlatados">- Encurtidos y Enlatados</a></li>
	                               
	                </ul>
	            </div>
	            <div class="col-xs-6 col-md-3 linkscat">
	                <h5><a href="https://merqueo.com/bogota/domicilios-locatel">Locatel</a></h5>
	                <ul>
                        <li><a href="https://merqueo.com/bogota/domicilios-locatel/promociones">- Promociones</a></li>
                        <li><a href="https://merqueo.com/bogota/domicilios-locatel/cuidado-personal">- Cuidado personal</a></li>
                        <li><a href="https://merqueo.com/bogota/domicilios-locatel/cuidado-de-la-piel">- Cuidado de la piel</a></li>
                        <li><a href="https://merqueo.com/bogota/domicilios-locatel/botiquin">- Botiquin</a></li>
	                               
	                </ul>
	            </div>
			</div>
			<div class="col-xs-12 col-md-5 redescont">
				<div class="col-xs-6 redes">
                <div class="linksfijos">
                    <h5>Legal</h5>
                    <ul>
                        <li>
                            <a href="faq.php">- Preguntas Frecuentes</a>
                        </li>
                        <li>
                            <a href="terms.php">- Terminos y Condiciones</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-xs-6 applinks">
                <h5>Síguenos</h5>
                <a rel="" title="Facebook" href="<?php $valor=variable(11,1); echo $valor[0]; ?>" target="_blank"><img src="<?php echo $dominio; ?>img/facebook.png" alt="facebook"></a>
                <a rel="" title="Twitter" href="<?php $valor=variable(10,1); echo $valor[0]; ?>" target="_blank"><img src="<?php echo $dominio; ?>img/twitter.png" alt="twitter"></a> 
                <a rel="" title="Instagram" href="<?php $valor=variable(12,1); echo $valor[0]; ?>" target="_blank" ><img src="<?php echo $dominio; ?>img/instagram.png" alt="instagram"></a>
            </div>
			</div>
		</div>		
	</div>
</div>
</footer>
<script>
	$('#sliderfooter').owlCarousel({
	    loop:true,
	    margin:10,
	    nav:false,
	    dots: false,
	    animateOut: 'fadeOut',
	    responsive:{
	        450:{
	            items:1
	        },
	        600:{
	            items:3
	        },
	        1000:{
	            items:7
	        }
	    }
	});
</script>
<!--
<script src="<?php echo $dominio; ?>js/scripts/home.js"> </script>
-->
<!--SCRIPTS-->

			

        