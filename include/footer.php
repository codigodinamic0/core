 <!-- Modal Structure -->
<div id="modalsesion" class="modalsesion modal">
	<div class="modal-content">
	  <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat"><i class="material-icons">clear</i></a>
	  <br><br>
	  <h3>Acceder con FACEBOOK <img src="<?php echo $dominio;?>images/red1.png" alt="" title=""></h3>
	  <div class="lin"><span><i class="material-icons">fiber_manual_record</i></span></div>
	  <p>Acceder con tu cuenta de <span>CORE+</span></p>

	  <form>
	    <div class="input-field">
	    	<img src="<?php echo $dominio;?>images/userlogin.png" alt="" title="">
	      	<input type="text" placeholder="Nombre">
	    </div>
	    <div class="input-field">
	    	<img src="<?php echo $dominio;?>images/userpass.png" alt="" title="" >
	      	<input type="text" placeholder="Contraseña" >
	    </div>
	    <div class="center-left">
	    	<a href="" class="contra">He olvidado mi contraseña</a>
	    </div>
	    <br>
	    <div class="bnt">
	    	<button class="btn">Iniciar sesión</button>
	    	<br>
	    	<a href="">Registrarme</a>
	    </div>
	   </form>
	</div>
</div>
<div class="confooter">
		<div class="container">
			<div class="contce" >
				<?php
					$cpadre = array();
					$db->select("categoria c, venlace e","c.id_categoria, c.nombre_categoria","WHERE c.id_categoria = e.id_categoria GROUP BY c.id_categoria ORDER BY c.ubica_categoria");
					/*$db->last_query();*/
					while ($arraypadre = $db->fetch_array()) {
						$cpadre[] = $arraypadre; 
					}
					foreach($cpadre as $row_cat){
				?>
						<div class="conts">
							<h4><?php echo $row_cat['nombre_categoria'] ?></h4>
							<ul>
								<?php
									$db->select("venlace","nombre_matrix, url_matrix, abre_matrix","WHERE id_categoria = '{$row_cat['id_categoria']}' ORDER BY ubica_matrix");
									/*$db->last_query();*/
									while ($row = $db->fetch_array()){
								?>
										<li><a href="<?php echo $row['url_matrix']; ?>" target="<?php if($row['abre_matrix']==25){echo '_blank';}else{echo '_self';} ?>"><?php echo $row['nombre_matrix']; ?></a></li>
								<?php
									}
								?>
							</ul>
						</div>
				<?php
					}
				?>
			</div>
			<hr>
			<div class="row">
				<div class="col s12 m6 l3">
					<a href="<?php echo $dominio;?>"><img src="<?php echo $dominio;?>images/logofoo.png" alt="core+" title="core+"></a>
					<?php
						$db->select("vayuda", "contenido_matrix", "WHERE id_subcategoria = 15");
						$row = $db->fetch_assoc();
						echo $row['contenido_matrix'];
				 	?>					
				</div>
				<div class="col s12 m6 l3">
				</div>
				<div class="col s12 m6 l6 rede">
					<a href="<?php $valor=variable(11,1); echo $valor[0]; ?>" target="_blank"><img src="<?php echo $dominio;?>images/red1.png" alt="facebook" title="facebook"></a>
					<a href="<?php $valor=variable(10,1); echo $valor[0]; ?>" target="_blank"><img src="<?php echo $dominio;?>images/red2.png" alt="twitter" title="twitter"></a>
					<a href="<?php $valor=variable(12,1); echo $valor[0]; ?>" target="_blank"><img src="<?php echo $dominio;?>images/red3.png" alt="youtube" title="youtube"></a>
					<a href="<?php $valor=variable(18,1); echo $valor[0]; ?>" target="_blank"><img src="<?php echo $dominio;?>images/red4.png" alt="linkedin" title="linkedin"></a>
				</div>
			</div>
		</div>
	</div>

  