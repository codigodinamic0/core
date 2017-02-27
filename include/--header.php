<header>
		<?php include('include/top.php') ?>
		<nav class="pro navbar navbar-default">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
		          	<span class="sr-only">Toggle navigation</span>
		          	<span class="icon-bar"></span>
		          	<span class="icon-bar"></span>
		          	<span class="icon-bar"></span>
	        	</button>
	        	<a id="_brand3" itemprop="brand" class="navbar-brand border-right" href="<?php echo $dominio; ?>"><img itemprop="logo" alt="logo" src="<?php echo $dominio; ?>img/logo-footer.png"></a>
	      	</div>
	      	<div id="navbar" class="navbar-collapse collapse headerlogo" aria-expanded="false" style="height: 1px; height: 60px !important;">
		        <div class="col-md-5 col-sm-3 col-xs-12 search_form">
		          	<form id="header-search-form" class="navbar-form navbar-left" role="search" >
		            	<div class="input-group">
		              		<input type="text" class="form-control required" autocomplete="off" placeholder="Buscar en Merca Ahorro" name="q">
		              		<div class="input-group-btn">
		                		<button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
		             	 	</div>
		            	</div>
		          	</form>
		        </div>

		        <ul class="nav navbar-nav navbar-right">
		        	<li class="user-credit"></li>
		          	<li><a data-toggle="modal" href="<?php echo $dominio; ?>" class="btn link change-city-modal">Inicio</a></li>
		          	<li><a class="fancybox btn link" href="">Nosotros</a></li>
		          	<li><a class="fancybox btn link" href="<?php echo $dominio; ?>noticias/cod3/">Noticias</a></li>
		          	<li><a class="fancybox btn link" href="" style="margin-right: 0">Contáctenos</a></li>
		          	<li class="dropdown user-account-header">
		          		<a data-toggle="modal" data-target="#login" class="btn link next-link signin">Ingresar</a>
	          		</li>
	          	</ul>
	        </div><!--/.nav-collapse -->
	    </nav>
	    <?php
	    	$db->select("vsede","nombre_matrix, img_matrix","ORDER BY ubica_matrix");
			/*$db->last_query();*/
			if($db->num_rows()){
		?>
				<div class="container-fluid">
				    <div class="row">
					  	<div class="sub-menu">
					  		<div class="col-md-8 col-sm-6 col-xs-12 left">
					  			<div class="dropdown" id="change-store">
					  				<a href="#" class="dropdown-toggle a border-right" data-toggle="dropdown" role="button" aria-expanded="false">
					  					<img class="pro-logo" src="<?php echo $dominio; ?>img/logo-footer.png" alt="super-merqueo-logo"> Merca Ahorro <span class="caret"></span>
				  					</a>
				  					<ul class="dropdown-menu dropdown-menu-large row">
				  						<li class="col-sm-12">
				  							<span>ESCOGE UNA TIENDA <button class="close">×</button></span>
			  							</li>
			  							<li class="divider"></li>
			  							<?php
			  								while ($row = $db->fetch_array()){
	  									?>
	  											<li class="col-sm-3 menu-img">
					  								<div>
					  									<a href="#">
					  										<img src="<?php echo $dominio; ?>imagenes/sede/imagen1/<?php echo $row['img_matrix']; ?>" alt="<?php echo $row['nombre_matrix']; ?>" class="<?php echo $row['nombre_matrix']; ?>">
				  										</a>
													</div>
												</li>	
	  									<?php
			  								}
			  							?>
				                    </ul>
					        	</div>
					        	<a class="estado closed" href="">Cerrado</a>
					        	<p class="disp-tienda"><b>Entrega: </b>Mañana</p>
				        	</div>
					        <div class="col-md-4 col-sm-6 col-xs-12 right cart-close" id="cart-btn">
					  			<i id="arrow-icon" class="fa fa-chevron-right"></i>
					  			<span class="count"><i class="fa fa-shopping-cart"></i> <span class="cart-total-quantity">0</span> productos</span>
					  			<div class="btn-group">
					  				<button type="button" class="btn lef btn-default">$<span class="cart-total-amount">0</span></button>
					  				<button type="button" class="btn rig btn-default">MI PEDIDO</button>
					            </div>
					  		</div>
					  	</div>
				    </div>
			  	</div>
		<?php
			}			
	    ?>
	</header>