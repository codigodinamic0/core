<div id="sidebar">
	<div id="sidebar-wrapper"> <!-- Sidebar with logo and menu -->
		<h1 id="sidebar-title"><a href="#"><?php $valor=variable(26,2); echo $valor[0]; ?></a></h1>
		<!-- Logo (221px wide) -->
		<a href="<?php echo $matriz_url ?>" target="_blank">
			<img src="imgs/logo-codigo.png" name="logo" width="77" border="0" id="logo" />
		</a>
		<!-- Sidebar Profile links -->
		<div id="profile-links">
			<?php $valor=variable(20,2); echo $valor[0]; ?>, <a href="#" title="<?php echo $_SESSION['nombre_usuario'] ?>"><?php echo $_SESSION['nombre_usuario'] ?></a>
			<a href="panel.php" class="home"><?php $valor=variable(9,2); echo $valor[0]; ?></a> | 
			<a href="close.php" class="salir" title="Sign Out"><?php $valor=variable(25,2); echo $valor[0]; ?></a>
		</div>

		<ul id="main-nav">  <!-- Accordion Menu -->
			<!-- INICIO PLANTILLA-->
			<?php

				$arr_menu = array();
				$db->select("menu, tiro", "menu.*", "WHERE tiro.usuario=menu.id and tiro.tipo='".$_SESSION['roll']."' order by menu.nombre");
				while($arraypadre = $db->fetch_array()){
					$arr_menu[] = $arraypadre; 
		    	}
		    	foreach ($arr_menu as $row){
			?>
			<li><a href="#" class="nav-top-item"><?php echo $row['nombre'];?></a>
				<ul>
					<?php

						$arr_opt = array();
						$db->select("menu_r", "*", "WHERE menu_r.idr='".$row['id']."' ORDER BY menu_r.nombre_l");
						while($arraypadre = $db->fetch_array()){
							$arr_opt[] = $arraypadre; 
					    }
					    foreach ($arr_opt as $row_opt){
					?>
					<li>
						<a href="<?php echo $row_opt['url']?>"><?php echo $row_opt['nombre_l']; ?></a>
					</li>
					<?php //FIN ROW2
						}
					?>
				</ul>
			</li>
			<?php //FIN ROW
				}
			?>
			<?php
				if($_SESSION['roll']==19){
			?>            
			<!-- tipos de??? -->
			<li>
				<a href="#" class="nav-top-item">
					<?php $valor=variable(33,2); echo $valor[0];?>
				</a>
				<ul>
					<?php

						$arr_tip = array();
						$db->select("tipifica", "*", "ORDER BY nombre_tipifica  ASC");
						while($arraypadre = $db->fetch_array()){
							$arr_tip[] = $arraypadre; 
					    }
					    foreach ($arr_tip as $row){
					?>
					<li>
						<a href="tipo.php?idr=<?php echo $row['id_tipifica']; ?>"><?php echo $row['nombre_tipifica']; ?></a>
					</li>
					<? //FIN ROW2
						}
					?>
				</ul>
			</li>
			<!-- fin tipos de  -->
			<!-- fin tipos de  -->
			<?php
			//por si no es super usuario
				}
			?>

			<?php

				$arr_idm = array();
				$db->select("idioma", "*", "ORDER BY idioma  ASC");
				while($arraypadre = $db->fetch_array()){
					$arr_idm[] = $arraypadre; 
			    }
			    foreach ($arr_idm as $row){
			?>
			<li>
				<a href="#" class="nav-top-item"> <?php echo $row['idioma']; ?></a>
				<ul>
					<?php

						$arr_idmo = array();
						$db->select("idmo", "*", "WHERE idioma='".$row['id_idioma']."' ORDER BY nombre_idmo ASC");
						while($arraypadre = $db->fetch_array()){
							$arr_idmo[] = $arraypadre; 
				    }
				    foreach ($arr_idmo as $row_idmo){
					?>
					<li><a href="contenido.php?idr=<?php echo $row_idmo['id_idmo']?>"><?php echo $row_idmo['nombre_idmo'];?></a></li>
					<? //FIN ROW2
					}
					?>
				</ul>
			</li>
			<?php //FIN ROW
		    }
	    ?>
	  </ul>
	</li>
	<!-- fin departamentos para ver ciudades  -->
</ul> <!-- End #main-nav -->
</div>
</div>